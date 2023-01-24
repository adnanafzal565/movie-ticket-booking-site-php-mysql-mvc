<?php
/**
 * Created by PhpStorm.
 * User: Adnan Afzal
 * Date: 29/04/2018
 * Time: 8:03 AM
 */

class AdminController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->header = ADMIN_VIEW . "header.php";
        $this->footer = ADMIN_VIEW . "footer.php";
    }

    public function index()
    {
        if ($this->is_admin_logged_in())
        {
            header("Location: " . URL . "admin/dashboard");
        }
        else
        {
            $this->goto_admin_login();
        }
    }

    public function login()
    {
        $error = "";
        $message = "";

        if ($_POST)
        {
            $token = $_POST["token"];

            if (Security::is_valid_token($token))
            {
                $email = $_POST["email"];
                $password = $_POST["password"];

                $model_response = $this->load_model("AdminModel")->login($email, $password);
                $error = $model_response["error"];

                if (empty($error))
                {
                    $admin_data = $model_response["msg"];
                    $_SESSION["admin"] = $admin_data->id;
                    header("Location: " . URL . "admin");
                }
            }
            else
            {
                $error = "Token mismatch";
            }

            require_once ADMIN_VIEW . 'login.php';
        }
        else
        {
            require_once ADMIN_VIEW . 'login.php';
        }
    }

    public function dashboard()
    {
        if ($this->is_admin_logged_in())
        {
            $MovieModel = $this->load_model("MovieModel");
            $comming_soon = $MovieModel->get_comming_soon();
            $played_so_far = $MovieModel->played_so_far();
            $currently_playing = $MovieModel->get_currently_playing();

            require_once $this->get_header();
            require_once ADMIN_VIEW . 'dashboard.php';
            require_once $this->get_footer();
        }
        else
        {
            $this->goto_admin_login();
        }
    }

    public function category($page_type, $category_id = 0)
    {
        $error = "";
        $message = "";

        if ($this->is_admin_logged_in())
        {
            
            if ($page_type == "add")
            {
                if ($_POST)
                {
                    $token = $_POST["token"];
                    
                    if (Security::is_valid_token($token))
                    {
                        $response = $this->load_model("CategoryModel")->add();
                        if ($response["status"] == "success")
                        {
                            $message = $response["message"];
                        }
                        else
                        {
                            $error = $response["message"];
                        }
                    }
                    else
                    {
                        $error = "Token mismatch";
                    }
                }
            }

            if ($page_type == "delete")
            {
                $response = $this->load_model("CategoryModel")->do_delete($category_id);
                if ($response["status"] == "success")
                {
                    $message = $response["message"];
                }
                else
                {
                    $error = $response["message"];
                }
            }

            if ($page_type == "edit")
            {
                if ($_POST)
                {
                    $token = $_POST["token"];
                    
                    if (Security::is_valid_token($token))
                    {
                        $response = $this->load_model("CategoryModel")->edit($category_id);
                        if ($response["status"] == "success")
                        {
                            $message = $response["message"];
                        }
                        else
                        {
                            $error = $response["message"];
                        }
                    }
                    else
                    {
                        $error = "Token mismatch";
                    }
                }

                $category = $this->load_model("CategoryModel")->get($category_id);

                require_once ADMIN_VIEW . "header.php";
                if ($category == null)
                {
                    require_once ADMIN_VIEW . '404.php';
                }
                else
                {
                    require_once ADMIN_VIEW . 'categories/edit.php';
                }
                require_once ADMIN_VIEW . "footer.php";
            }
            else
            {
                $categories = $this->load_model("CategoryModel")->get_all();

                require_once ADMIN_VIEW . "header.php";
                require_once ADMIN_VIEW . 'categories/add.php';
                require_once ADMIN_VIEW . "footer.php";
            }
        }
        else
        {
            $this->goto_admin_login();
        }
    }

    public function cinema($page_type, $cinema_id = 0)
    {
        $error = "";
        $message = "";

        if ($this->is_admin_logged_in())
        {
            
            if ($page_type == "add")
            {
                if ($_POST)
                {
                    $token = $_POST["token"];
                    
                    if (Security::is_valid_token($token))
                    {
                        $response = $this->load_model("CinemaModel")->add();
                        if ($response["status"] == "success")
                        {
                            $message = $response["message"];
                        }
                        else
                        {
                            $error = $response["message"];
                        }
                    }
                    else
                    {
                        $error = "Token mismatch";
                    }
                }
            }

            if ($page_type == "delete")
            {
                $response = $this->load_model("CinemaModel")->do_delete($cinema_id);
                if ($response["status"] == "success")
                {
                    $message = $response["message"];
                }
                else
                {
                    $error = $response["message"];
                }
            }

            if ($page_type == "edit")
            {
                if ($_POST)
                {
                    $token = $_POST["token"];
                    
                    if (Security::is_valid_token($token))
                    {
                        $response = $this->load_model("CinemaModel")->edit($cinema_id);
                        if ($response["status"] == "success")
                        {
                            $message = $response["message"];
                        }
                        else
                        {
                            $error = $response["message"];
                        }
                    }
                    else
                    {
                        $error = "Token mismatch";
                    }
                }

                $cinema = $this->load_model("CinemaModel")->get($cinema_id);

                require_once ADMIN_VIEW . "header.php";
                if ($cinema == null)
                {
                    require_once ADMIN_VIEW . '404.php';
                }
                else
                {
                    require_once ADMIN_VIEW . 'cinemas/edit.php';
                }
                require_once ADMIN_VIEW . "footer.php";
            }
            else
            {
                $cinemas = $this->load_model("CinemaModel")->get_all();

                require_once ADMIN_VIEW . "header.php";
                require_once ADMIN_VIEW . 'cinemas/add.php';
                require_once ADMIN_VIEW . "footer.php";
            }
        }
        else
        {
            $this->goto_admin_login();
        }
    }

    public function movie($page_type, $movie_id = 0)
    {
        $error = "";
        $message = "";

        if ($this->is_admin_logged_in())
        {
            
            if ($page_type == "add")
            {
                $input = array();

                if ($_POST)
                {
                    $token = $_POST["token"];
                    
                    if (Security::is_valid_token($token))
                    {
                        $MovieModel = $this->load_model("MovieModel");
                        $response = $MovieModel->add();

                        if ($response["status"] == "success")
                        {
                            $message = $response["message"];
                        }
                        else
                        {
                            $input = $response["input"];
                            $error = $response["message"];
                        }
                    }
                    else
                    {
                        $error = "Token mismatch";
                    }
                }

                $categories = $this->load_model("CategoryModel")->get_all();
                $cinemas = $this->load_model("CinemaModel")->get_all();
                $casts = $this->load_model("CelebrityModel")->get_all();

                require_once ADMIN_VIEW . "header.php";
                require_once ADMIN_VIEW . 'movies/add.php';
                require_once ADMIN_VIEW . "footer.php";
            }

            if ($page_type == "delete")
            {
                $this->load_model("CategoryModel")->delete_movies($movie_id);
                $this->load_model("CinemaModel")->delete_movies($movie_id);
                $this->load_model("MovieModel")->do_delete($movie_id);

                $error = "Movie has been deleted.";
            }

            if ($page_type == "edit")
            {
                if ($_POST)
                {
                    $token = $_POST["token"];
                    
                    if (Security::is_valid_token($token))
                    {
                        $response = $this->load_model("MovieModel")->edit($movie_id);
                        if ($response["status"] == "success")
                        {
                            $message = $response["message"];
                        }
                        else
                        {
                            $error = $response["message"];
                        }
                    }
                    else
                    {
                        $error = "Token mismatch";
                    }
                }

                $data = $this->load_model("MovieModel")->get_detail($movie_id);
                $categories = $this->load_model("CategoryModel")->get_all();
                $cinemas = $this->load_model("CinemaModel")->get_all();
                $casts = $this->load_model("CelebrityModel")->get_all();

                require_once ADMIN_VIEW . "header.php";
                require_once ADMIN_VIEW . 'movies/edit.php';
                require_once ADMIN_VIEW . "footer.php";
            }

            if ($page_type == "detail")
            {
                $data = $this->load_model("MovieModel")->get_detail($movie_id);

                require_once ADMIN_VIEW . "header.php";
                require_once ADMIN_VIEW . 'movies/detail.php';
                require_once ADMIN_VIEW . "footer.php";
            }

            if ($page_type == "all" || $page_type == "delete")
            {
                $movies = $this->load_model("MovieModel")->get_all();

                require_once ADMIN_VIEW . "header.php";
                require_once ADMIN_VIEW . 'movies/all.php';
                require_once ADMIN_VIEW . "footer.php";
            }
        }
        else
        {
            $this->goto_admin_login();
        }
    }

    public function delete_thumbnail($thumbnail_id)
    {
        $this->load_model("MovieModel")->delete_thumbnail($thumbnail_id);
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    public function delete_trailer($trailer_id)
    {
        $this->load_model("MovieModel")->delete_trailer($trailer_id);
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    public function celebrities($page_type, $celebrity_id = 0)
    {
        $error = "";
        $message = "";

        if ($this->is_admin_logged_in())
        {
            if ($page_type == "add")
            {
                $input = array();

                if ($_POST)
                {
                    $token = $_POST["token"];
                    
                    if (Security::is_valid_token($token))
                    {
                        $response = $this->load_model("CelebrityModel")->add();
                        if ($response["status"] == "success")
                        {
                            $message = $response["message"];
                        }
                        else
                        {
                            $input = $response["input"];
                            $error = $response["message"];
                        }
                    }
                    else
                    {
                        $error = "Token mismatch";
                    }
                }

                require_once ADMIN_VIEW . "header.php";
                require_once ADMIN_VIEW . 'celebrities/add.php';
                require_once ADMIN_VIEW . "footer.php";
            }

            if ($page_type == "delete")
            {
                $this->load_model("CelebrityModel")->do_delete($celebrity_id);

                $error = "Celebrity has been deleted.";
            }

            if ($page_type == "edit")
            {
                if ($_POST)
                {
                    $token = $_POST["token"];
                    
                    if (Security::is_valid_token($token))
                    {
                        $response = $this->load_model("CelebrityModel")->edit($celebrity_id);
                        if ($response["status"] == "success")
                        {
                            $message = $response["message"];
                        }
                        else
                        {
                            $error = $response["message"];
                        }
                    }
                    else
                    {
                        $error = "Token mismatch";
                    }
                }

                $data = $this->load_model("CelebrityModel")->get_detail($celebrity_id);

                require_once ADMIN_VIEW . "header.php";
                require_once ADMIN_VIEW . 'celebrities/edit.php';
                require_once ADMIN_VIEW . "footer.php";
            }

            if ($page_type == "detail")
            {
                $data = $this->load_model("CelebrityModel")->get_detail($celebrity_id);

                require_once ADMIN_VIEW . "header.php";
                require_once ADMIN_VIEW . 'celebrities/detail.php';
                require_once ADMIN_VIEW . "footer.php";
            }

            if ($page_type == "all" || $page_type == "delete")
            {
                $celebrities = $this->load_model("CelebrityModel")->get_all();

                require_once ADMIN_VIEW . "header.php";
                require_once ADMIN_VIEW . 'celebrities/all.php';
                require_once ADMIN_VIEW . "footer.php";
            }
        }
        else
        {
            $this->goto_admin_login();
        }
    }

    public function upcoming_movies()
    {
        if ($this->is_admin_logged_in())
        {
            $movies = $this->load_model("MovieModel")->get_comming_soon();

            require_once ADMIN_VIEW . "header.php";
            require_once ADMIN_VIEW . 'movies/all.php';
            require_once ADMIN_VIEW . "footer.php";
        }
        else
        {
            $this->goto_admin_login();
        }
    }

    public function currently_playing()
    {
        if ($this->is_admin_logged_in())
        {
            $movies = $this->load_model("MovieModel")->get_currently_playing();

            require_once ADMIN_VIEW . "header.php";
            require_once ADMIN_VIEW . 'movies/all.php';
            require_once ADMIN_VIEW . "footer.php";
        }
        else
        {
            $this->goto_admin_login();
        }
    }

    public function movies_played_so_far()
    {
        if ($this->is_admin_logged_in())
        {
            $movies = $this->load_model("MovieModel")->get_played_so_far();

            require_once ADMIN_VIEW . "header.php";
            require_once ADMIN_VIEW . 'movies/all.php';
            require_once ADMIN_VIEW . "footer.php";
        }
        else
        {
            $this->goto_admin_login();
        }
    }

    public function logout()
    {
        unset($_SESSION["admin"]);
        header("Location: " . URL . "admin");
    }
}