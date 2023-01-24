<?php

    class HomeController extends Controller
    {
        public function index($message = "")
        {
            $movies = $this->load_model("MovieModel")->get_all_for_home();
            $comming_soon = $this->load_model("MovieModel")->get_comming_soon();

        	require_once VIEW . "layout/header.php";
            require_once VIEW . 'home.php';
            require_once VIEW . "layout/footer.php";
        }
    }

?>