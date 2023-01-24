<?php

/**
 * CelebrityController
 */
class CelebrityController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $celebrities = $this->load_model("CelebrityModel")->get_all_with_movies();

        require_once VIEW . "layout/header.php";
        require_once VIEW . 'celebrities.php';
        require_once VIEW . "layout/footer.php";
    }

    public function detail($id)
    {
        $celebrities = $this->load_model("CelebrityModel")->get_all_with_movies($id);

        require_once VIEW . "layout/header.php";
        require_once VIEW . 'celebrities.php';
        require_once VIEW . "layout/footer.php";
    }
}
