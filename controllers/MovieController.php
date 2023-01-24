<?php

class MovieController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add()
    {
        if ($this->is_admin_logged_in())
        {
            require_once ADMIN_VIEW . "header.php";
            require_once ADMIN_VIEW . 'movies/add.php';
            require_once ADMIN_VIEW . "footer.php";
        }
        else
        {
            $this->goto_admin_login();
        }
    }

    public function detail($movie_id)
    {
        $movie = $this->load_model("MovieModel")->get_detail($movie_id);
        $next_movie = $this->load_model("MovieModel")->get_next($movie_id);
        $previous_movie = $this->load_model("MovieModel")->get_previous($movie_id);

        $is_currently_playing = $this->load_model("MovieModel")->is_currently_playing($movie_id);

        $cinemas = array();
        foreach ($movie->cinemas as $movie_cinema)
        {
            $flag = false;
            foreach ($cinemas as $cinema)
            {
                if ($movie_cinema->id == $cinema->id)
                {
                    array_push($cinema->times, date("M/d/Y h:i A", strtotime($movie_cinema->movie_time)));
                    $flag = true;
                    break;
                }
            }
            if (!$flag)
            {
                $cinema_obj = new stdClass();
                $cinema_obj->id = $movie_cinema->id;
                $cinema_obj->name = $movie_cinema->name;
                $cinema_obj->times = array(
                    date("M/d/Y h:i A", strtotime($movie_cinema->movie_time))
                );
                array_push($cinemas, $cinema_obj);
            }
        }

        require_once VIEW . "layout/header.php";
        require_once VIEW . 'movies/movie-detail.php';
        require_once VIEW . "layout/footer.php";
    }

    public function all()
    {
        $movies = $this->load_model("MovieModel")->get_all_for_home();
        $comming_soon = $this->load_model("MovieModel")->get_comming_soon();

        require_once VIEW . "layout/header.php";
        require_once VIEW . 'movies/all.php';
        require_once VIEW . "layout/footer.php";
    }
}