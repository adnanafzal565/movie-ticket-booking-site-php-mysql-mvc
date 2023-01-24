<?php

/**
 * MovieModel
 */
class MovieModel extends Model
{
    
    function __construct()
    {
        parent::__construct();
    }

    public function add()
    {
        $name = $_POST["name"];
        $description = mysqli_real_escape_string($this->connection, $_POST["description"]);
        $categories = isset($_POST["categories"]) ? $_POST["categories"] : [];
        $cinemas = isset($_POST["cinemas"]) ? $_POST["cinemas"] : [];
        $cinema_time = isset($_POST["cinema_time"]) ? $_POST["cinema_time"] : [];
        $writer = $_POST["writer"];
        $director = $_POST["director"];
        $duration = $_POST["duration"];
        $release_date = $_POST["release_date"];
        $languages = $_POST["languages"];
        $price_per_ticket = $_POST["price_per_ticket"];
        $casts = isset($_POST["casts"]) ? $_POST["casts"] : [];

        $thumbnail = $_FILES["thumbnail"];
        $trailers = $_FILES["trailers"];

        for ($a = 0; $a < count($thumbnail["name"]); $a++)
        {
            if ($thumbnail["error"][$a] != 0)
            {
                return array(
                    "status" => "error",
                    "message" => "Please select a thumbnail image.",
                    "input" => $_POST
                );
            }

            $image_info = getimagesize($thumbnail['tmp_name'][$a]);
            if($image_info == false)
            {
                return array(
                    "status" => "error",
                    "message" => "Please upload valid image file.",
                    "input" => $_POST
                );
            }
        }

        for ($a = 0; $a < count($trailers["name"]); $a++)
        {
            if ($trailers["error"][$a] != 0)
            {
                return array(
                    "status" => "error",
                    "message" => "Please select a trailer.",
                    "input" => $_POST
                );
            }

            if (!preg_match('/video\/*/', $trailers['type'][$a]))
            {
                return array(
                    "status" => "error",
                    "message" => "Please upload valid video trailer file.",
                    "input" => $_POST
                );
            }
        }

        // Save movie
        $sql = "INSERT INTO `movies`(`name`, `description`, `writer`, `director`, `duration`, `release_date`, `languages`, `price_per_ticket`) VALUES ('" . $name . "','" . $description . "','" . $writer . "','" . $director . "','" . $duration . "','" . $release_date . "','" . $languages . "','" . $price_per_ticket . "')";
        mysqli_query($this->connection, $sql);
        $movie_id = mysqli_insert_id($this->connection) or die(mysqli_error($this->connection));

        // Save movie thumbnails
        for ($a = 0; $a < count($thumbnail["name"]); $a++)
        {
            $file_path = "uploads/movie_thumbnails/" . time() . "-" . $thumbnail["name"][$a];
            move_uploaded_file($thumbnail["tmp_name"][$a], $file_path);

            $sql = "INSERT INTO `movie_thumbnails`(`movie_id`, `file_path`) VALUES ('" . $movie_id . "','" . $file_path . "')";
            mysqli_query($this->connection, $sql);
        }

        // Save movie trailers
        for ($a = 0; $a < count($trailers["name"]); $a++)
        {
            $file_path = "uploads/movie_trailers/" . time() . "-" . $trailers["name"][$a];
            move_uploaded_file($trailers["tmp_name"][$a], $file_path);

            $sql = "INSERT INTO `trailers`(`movie_id`, `file_path`) VALUES ('" . $movie_id . "','" . $file_path . "')";
            mysqli_query($this->connection, $sql);
        }

        // Save categories
        for ($a = 0; $a < count($categories); $a++)
        {
            $sql = "INSERT INTO `movie_categories`(`movie_id`, `category_id`) VALUES ('" . $movie_id . "','" . $categories[$a] . "')";
            mysqli_query($this->connection, $sql);
        }

        // Save cinemas
        for ($a = 0; $a < count($cinemas); $a++)
        {
            $sql = "INSERT INTO `movie_cinemas`(`movie_id`, `cinema_id`, `movie_time`) VALUES ('" . $movie_id . "','" . $cinemas[$a] . "', '" . $cinema_time[$a] . "')";
            mysqli_query($this->connection, $sql);
        }

        // Save casts
        for ($a = 0; $a < count($casts); $a++)
        {
            $sql = "INSERT INTO `movie_cast`(`movie_id`, `cast_id`) VALUES ('" . $movie_id . "','" . $casts[$a] . "')";
            mysqli_query($this->connection, $sql);
        }

        return array(
            "status" => "success",
            "message" => "Movie has been added",
            "movie_id" => $movie_id
        );
    }

    public function edit($movie_id)
    {
        $name = $_POST["name"];
        $description = mysqli_real_escape_string($this->connection, $_POST["description"]);
        $categories = isset($_POST["categories"]) ? $_POST["categories"] : [];
        $cinemas = isset($_POST["cinemas"]) ? $_POST["cinemas"] : [];
        $cinema_time = isset($_POST["cinema_time"]) ? $_POST["cinema_time"] : [];
        $writer = $_POST["writer"];
        $director = $_POST["director"];
        $duration = $_POST["duration"];
        $release_date = $_POST["release_date"];
        $languages = $_POST["languages"];
        $price_per_ticket = $_POST["price_per_ticket"];
        $casts = isset($_POST["casts"]) ? $_POST["casts"] : [];

        $thumbnail = $_FILES["thumbnail"];
        $trailers = $_FILES["trailers"];

        // Save movie thumbnails
        for ($a = 0; $a < count($thumbnail["name"]); $a++)
        {
            $file_path = "uploads/movie_thumbnails/" . time() . "-" . $thumbnail["name"][$a];
            $is_saved = move_uploaded_file($thumbnail["tmp_name"][$a], $file_path);

            if ($is_saved)
            {
                $sql = "INSERT INTO `movie_thumbnails`(`movie_id`, `file_path`) VALUES ('" . $movie_id . "','" . $file_path . "')";
                mysqli_query($this->connection, $sql);
            }
        }

        // Save movie trailers
        for ($a = 0; $a < count($trailers["name"]); $a++)
        {
            $trailers["name"][$a] = $this->secure_input($trailers["name"][$a]);
            
            $file_path = "uploads/movie_trailers/" . time() . "-" . $trailers["name"][$a];
            $is_saved = move_uploaded_file($trailers["tmp_name"][$a], $file_path);

            if ($is_saved)
            {
                $sql = "INSERT INTO `trailers`(`movie_id`, `file_path`) VALUES ('" . $movie_id . "','" . $file_path . "')";
                mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
            }
        }

        // Save movie
        $sql = "UPDATE `movies` SET `name` = '" . $name . "', `description` = '" . $description . "', `writer` = '" . $writer . "', `director` = '" . $director . "', `duration` = '" . $duration . "', `release_date` = '" . $release_date . "', `languages` = '" . $languages . "', `price_per_ticket` = '" . $price_per_ticket . "' WHERE id = '" . $movie_id . "'";
        mysqli_query($this->connection, $sql);

        // delete previous categories
        $sql = "DELETE FROM `movie_categories` WHERE `movie_id` = '" . $movie_id . "'";
        mysqli_query($this->connection, $sql);

        // Save new categories
        for ($a = 0; $a < count($categories); $a++)
        {
            $sql = "INSERT INTO `movie_categories`(`movie_id`, `category_id`) VALUES ('" . $movie_id . "','" . $categories[$a] . "')";
            mysqli_query($this->connection, $sql);
        }

        // delete previous cinemas
        $sql = "DELETE FROM `movie_cinemas` WHERE `movie_id` = '" . $movie_id . "'";
        mysqli_query($this->connection, $sql);
        
        // Save new cinemas
        for ($a = 0; $a < count($cinemas); $a++)
        {
            $sql = "INSERT INTO `movie_cinemas`(`movie_id`, `cinema_id`, `movie_time`) VALUES ('" . $movie_id . "','" . $cinemas[$a] . "', '" . $cinema_time[$a] . "')";
            mysqli_query($this->connection, $sql);
        }

        // delete previous casts
        $sql = "DELETE FROM `movie_cast` WHERE `movie_id` = '" . $movie_id . "'";
        mysqli_query($this->connection, $sql);
        
        // Save new casts
        for ($a = 0; $a < count($casts); $a++)
        {
            $sql = "INSERT INTO `movie_cast`(`movie_id`, `cast_id`) VALUES ('" . $movie_id . "','" . $casts[$a] . "')";
            mysqli_query($this->connection, $sql);
        }

        return array(
            "status" => "success",
            "message" => "Movie has been updated"
        );
    }

    public function get_all()
    {
        $sql = "SELECT * FROM movies ORDER BY id DESC";
        $result = mysqli_query($this->connection, $sql);

        $data = array();
        while ($row = mysqli_fetch_object($result))
        {
            array_push($data, $row);
        }
        return $data;
    }

    public function get_all_for_home()
    {
        $sql = "SELECT * FROM movies ORDER BY id DESC LIMIT 10";
        $result = mysqli_query($this->connection, $sql);

        $data = array();
        while ($row = mysqli_fetch_object($result))
        {
            $sql = "SELECT * FROM movie_thumbnails WHERE movie_id = '" . $row->id . "'";
            $result_thumbnails = mysqli_query($this->connection, $sql);
            $thumbnails = array();
            while ($row_thumbnail = mysqli_fetch_object($result_thumbnails))
            {
                array_push($thumbnails, $row_thumbnail);
            }

            $sql = "SELECT * FROM trailers WHERE movie_id = '" . $row->id . "'";
            $result_trailers = mysqli_query($this->connection, $sql);
            $trailers = array();
            while ($row_trailer = mysqli_fetch_object($result_trailers))
            {
                array_push($trailers, $row_trailer);
            }

            $sql = "SELECT * FROM movie_cinemas WHERE movie_id = '" . $row->id . "'";
            $result_cinemas = mysqli_query($this->connection, $sql);
            $cinemas = array();
            while ($row_cinema = mysqli_fetch_object($result_cinemas))
            {
                array_push($cinemas, $row_cinema);
            }

            $object = new stdClass();
            $object->movie = $row;
            $object->thumbnails = $thumbnails;
            $object->trailers = $trailers;
            $object->cinemas = $cinemas;

            array_push($data, $object);
        }
        return $data;
    }

    public function get_comming_soon()
    {
        $sql = "SELECT * FROM movies WHERE release_date > NOW() ORDER BY id DESC";
        $result = mysqli_query($this->connection, $sql);

        $data = array();
        while ($row = mysqli_fetch_object($result))
        {
            array_push($data, $row);
        }
        return $data;
    }

    public function get($movie_id)
    {
        $sql = "SELECT * FROM movies WHERE id = '" . $movie_id . "'";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) == 0)
        {
            die("Movie does not exists.");
        }
        $movie = mysqli_fetch_object($result);
        return $movie;
    }

    public function get_thumbnail($movie_id)
    {
        $sql = "SELECT * FROM movie_thumbnails WHERE movie_id = '" . $movie_id . "'";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) == 0)
        {
            return "";
        }
        return mysqli_fetch_object($result)->file_path;
    }

    public function get_detail($movie_id)
    {
        $sql = "SELECT * FROM movies WHERE id = '" . $movie_id . "'";
        $result = mysqli_query($this->connection, $sql);
        
        if (mysqli_num_rows($result) == 0)
        {
            die("Movie does not exists.");
        }

        $movie = mysqli_fetch_object($result);
        
        $sql = "SELECT * FROM movie_thumbnails WHERE movie_id = '" . $movie_id . "'";
        $result = mysqli_query($this->connection, $sql);
        $thumbnails = array();
        while ($row = mysqli_fetch_object($result))
        {
            array_push($thumbnails, $row);
        }

        $sql = "SELECT * FROM trailers WHERE movie_id = '" . $movie_id . "'";
        $result = mysqli_query($this->connection, $sql);
        $trailers = array();
        while ($row = mysqli_fetch_object($result))
        {
            array_push($trailers, $row);
        }

        $sql = "SELECT categories.* FROM movie_categories INNER JOIN categories ON movie_categories.category_id = categories.id WHERE movie_categories.movie_id = '" . $movie_id . "'";
        $result = mysqli_query($this->connection, $sql);
        $categories = array();
        while ($row = mysqli_fetch_object($result))
        {
            array_push($categories, $row);
        }

        $sql = "SELECT * FROM movie_cinemas INNER JOIN cinemas ON movie_cinemas.cinema_id = cinemas.id WHERE movie_cinemas.movie_id = '" . $movie_id . "'";
        $result = mysqli_query($this->connection, $sql);
        $cinemas = array();
        while ($row = mysqli_fetch_object($result))
        {
            array_push($cinemas, $row);
        }

        $sql = "SELECT *, celebrities.name AS celebrity_name FROM movie_cast INNER JOIN celebrities ON celebrities.id = movie_cast.cast_id WHERE movie_cast.movie_id = '" . $movie_id . "' ORDER BY movie_cast.id DESC";
        $result = mysqli_query($this->connection, $sql);
        $casts = array();
        while ($row = mysqli_fetch_object($result))
        {
            array_push($casts, $row);
        }

        $object = new stdClass();
        $object->movie = $movie;
        $object->thumbnails = $thumbnails;
        $object->trailers = $trailers;
        $object->categories = $categories;
        $object->cinemas = $cinemas;
        $object->casts = $casts;

        return $object;
    }

    public function do_delete($movie_id)
    {
        $sql = "SELECT * FROM movie_thumbnails WHERE movie_id = '" . $movie_id . "'";
        $result = mysqli_query($this->connection, $sql);

        while ($row = mysqli_fetch_object($result))
        {
            if (file_exists($row->file_path))
            {
                unlink($row->file_path);
            }
        }

        $sql = "DELETE FROM movie_thumbnails WHERE movie_id = '" . $movie_id . "'";
        mysqli_query($this->connection, $sql);

        $sql = "SELECT * FROM trailers WHERE movie_id = '" . $movie_id . "'";
        $result = mysqli_query($this->connection, $sql);

        while ($row = mysqli_fetch_object($result))
        {
            if (file_exists($row->file_path))
            {
                unlink($row->file_path);
            }
        }

        $sql = "DELETE FROM trailers WHERE movie_id = '" . $movie_id . "'";
        mysqli_query($this->connection, $sql);

        $sql = "DELETE FROM movie_cast WHERE movie_id = '" . $movie_id . "'";
        mysqli_query($this->connection, $sql);

        $sql = "DELETE FROM movies WHERE id = '" . $movie_id . "'";
        mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
    }

    public function delete_thumbnail($thumbnail_id)
    {
        $sql = "SELECT * FROM movie_thumbnails WHERE id = '" . $thumbnail_id . "'";
        $result = mysqli_query($this->connection, $sql);

        if (mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_object($result);
            if (file_exists($row->file_path))
            {
                unlink($row->file_path);
            }
        }

        $sql = "DELETE FROM movie_thumbnails WHERE id = '" . $thumbnail_id . "'";
        mysqli_query($this->connection, $sql);
    }

    public function delete_trailer($trailer_id)
    {
        $sql = "SELECT * FROM trailers WHERE id = '" . $trailer_id . "'";
        $result = mysqli_query($this->connection, $sql);

        if (mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_object($result);
            if (file_exists($row->file_path))
            {
                unlink($row->file_path);
            }
        }

        $sql = "DELETE FROM trailers WHERE id = '" . $trailer_id . "'";
        mysqli_query($this->connection, $sql);
    }

    public function get_next($movie_id)
    {
        $sql = "SELECT * FROM movies WHERE id = '" . ($movie_id + 1) . "'";
        $result = mysqli_query($this->connection, $sql);
        
        if (mysqli_num_rows($result) == 0)
        {
            return null;
        }

        return mysqli_fetch_object($result);
    }

    public function get_previous($movie_id)
    {
        $sql = "SELECT * FROM movies WHERE id = '" . ($movie_id - 1) . "'";
        $result = mysqli_query($this->connection, $sql);
        
        if (mysqli_num_rows($result) == 0)
        {
            return null;
        }

        return mysqli_fetch_object($result);
    }

    public function played_so_far()
    {
        $sql = "SELECT COUNT(DISTINCT(movie_id)) AS total FROM movie_cinemas";
        $result = mysqli_query($this->connection, $sql);
        return mysqli_fetch_object($result)->total;
    }

    public function get_played_so_far()
    {
        $sql = "SELECT DISTINCT(movie_id) AS movie_id FROM movie_cinemas";
        $result = mysqli_query($this->connection, $sql);
        
        $data = array();
        while ($row = mysqli_fetch_object($result))
        {
            array_push($data, $this->get($row->movie_id));
        }
        return $data;
    }

    public function get_currently_playing()
    {
        $sql = "SELECT * FROM movie_cinemas INNER JOIN movies ON movie_cinemas.movie_id = movies.id WHERE DATE(movie_time) > DATE(NOW()) OR DATE(movie_time) = DATE(NOW())";
        $result = mysqli_query($this->connection, $sql);

        $data = array();
        while ($row = mysqli_fetch_object($result))
        {
            array_push($data, $row);
        }
        return $data;
    }

    public function is_currently_playing($movie_id)
    {
        $sql = "SELECT * FROM movie_cinemas WHERE (DATE(movie_time) > DATE(NOW()) OR DATE(movie_time) = DATE(NOW())) AND movie_id = '" . $movie_id . "'";
        $result = mysqli_query($this->connection, $sql);
        return mysqli_num_rows($result) > 0;
    }
}