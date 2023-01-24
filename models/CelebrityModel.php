<?php

/**
 * CelebrityModel
 */
class CelebrityModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function add()
    {
        $name = $_POST["name"];
        $description = mysqli_real_escape_string($this->connection, $_POST["description"]);
        $height = $_POST["height"];
        $weight = $_POST["weight"];
        $eye_color = $_POST["eye_color"];
        $hair_color = $_POST["hair_color"];
        $birthday = $_POST["birthday"];
        $facebook = $_POST["facebook"];
        $twitter = $_POST["twitter"];
        $youtube = $_POST["youtube"];

        $picture = $_FILES["picture"];
        if ($picture["error"] != 0)
        {
            return array(
                "status" => "error",
                "message" => "Please select picture of celebrity.",
                "input" => $_POST
            );
        }

        $image_info = getimagesize($picture['tmp_name']);
        if($image_info == false)
        {
            return array(
                "status" => "error",
                "message" => "Please upload valid image file.",
                "input" => $_POST
            );
        }

        $file_path = "uploads/celebrities/" . time() . "-" . $picture["name"];
        move_uploaded_file($picture["tmp_name"], $file_path);

        // Save celebrity
        $sql = "INSERT INTO `celebrities`(`name`, `picture`, `description`, `height`, `weight`, `eye_color`, `hair_color`, `birthday`, `facebook`, `twitter`, `youtube`) VALUES ('" . $name . "', '" . $file_path . "', '" . $description . "', '" . $height . "', '" . $weight . "', '" . $eye_color . "', '" . $hair_color . "', '" . $birthday . "', '" . $facebook . "', '" . $twitter . "', '" . $youtube . "')";
        mysqli_query($this->connection, $sql);
        $celebrity_id = mysqli_insert_id($this->connection);

        return array(
            "status" => "success",
            "message" => "Celebrity has been added"
        );
    }

    public function get_all()
    {
        $sql = "SELECT * FROM celebrities ORDER BY id DESC";
        $result = mysqli_query($this->connection, $sql);

        $data = array();
        while ($row = mysqli_fetch_object($result))
        {
            array_push($data, $row);
        }
        return $data;
    }

    public function get_all_with_movies($id = 0)
    {
        if ($id > 0)
        {
            $sql = "SELECT * FROM celebrities ORDER BY FIELD(id, " . $id . ") DESC";
        }
        else
        {
            $sql = "SELECT * FROM celebrities ORDER BY id DESC";
        }
        $result = mysqli_query($this->connection, $sql);

        $data = array();
        while ($row = mysqli_fetch_object($result))
        {
            $sql = "SELECT *, movies.name AS movie_name FROM celebrities INNER JOIN movie_cast ON celebrities.id = movie_cast.cast_id INNER JOIN movies ON movies.id = movie_cast.movie_id WHERE celebrities.id = '" . $row->id . "'";
            $result_movies = mysqli_query($this->connection, $sql);

            $data_movies = array();
            while ($row_movies = mysqli_fetch_object($result_movies))
            {
                array_push($data_movies, $row_movies);
            }
            $row->movies = $data_movies;
            array_push($data, $row);
        }
        return $data;
    }

    public function get_detail($id)
    {
        $sql = "SELECT * FROM celebrities WHERE id = '" . $id . "'";
        $result = mysqli_query($this->connection, $sql);
        
        if (mysqli_num_rows($result) == 0)
        {
            die("Movie does not exists.");
        }

        return mysqli_fetch_object($result);
    }

    public function edit($celebrity_id)
    {
        $name = $_POST["name"];
        $description = mysqli_real_escape_string($this->connection, $_POST["description"]);
        $height = $_POST["height"];
        $weight = $_POST["weight"];
        $eye_color = $_POST["eye_color"];
        $hair_color = $_POST["hair_color"];
        $birthday = $_POST["birthday"];
        $facebook = $_POST["facebook"];
        $twitter = $_POST["twitter"];
        $youtube = $_POST["youtube"];

        $data = $this->get_detail($celebrity_id);

        $file_path = $data->picture;
        $picture = $_FILES["picture"];

        if ($picture["error"] == 0)
        {
            $image_info = getimagesize($picture['tmp_name']);
            if($image_info == false)
            {
                return array(
                    "status" => "error",
                    "message" => "Please upload valid image file.",
                    "input" => $_POST
                );
            }

            if (file_exists($data->picture))
            {
                unlink($data->picture);
            }

            $file_path = "uploads/celebrities/" . time() . "-" . $picture["name"];
            move_uploaded_file($picture["tmp_name"], $file_path);
        }

        // Save celebrity
        $sql = "UPDATE `celebrities` SET `name` = '" . $name . "', `picture` = '" . $file_path . "', `description` = '" . $description . "', `height` = '" . $height . "', `weight` = '" . $weight . "', `eye_color` = '" . $eye_color . "', `hair_color` = '" . $hair_color . "', `birthday` = '" . $birthday . "', `facebook` = '" . $facebook . "', `twitter` = '" . $twitter . "', `youtube` = '" . $youtube . "' WHERE id = '" . $celebrity_id . "'";
        mysqli_query($this->connection, $sql);

        return array(
            "status" => "success",
            "message" => "Celebrity has been updated"
        );
    }

    public function do_delete($celebrity_id)
    {
        $data = $this->get_detail($celebrity_id);

        if (file_exists($data->picture))
        {
            unlink($data->picture);
        }

        $sql = "DELETE FROM movie_cast WHERE cast_id = '" . $celebrity_id . "'";
        mysqli_query($this->connection, $sql);

        $sql = "DELETE FROM celebrities WHERE id = '" . $celebrity_id . "'";
        mysqli_query($this->connection, $sql);
    }
}
