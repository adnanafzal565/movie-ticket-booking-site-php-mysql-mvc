<?php

/**
 * CinemaModel
 */
class CinemaModel extends Model
{
    
    function __construct()
    {
        parent::__construct();
    }

    public function add()
    {
        $name = $_POST["name"];

        $sql = "INSERT INTO `cinemas`(`name`) VALUES ('" . $name . "')";
        mysqli_query($this->connection, $sql);

        return array(
            "status" => "success",
            "message" => "Cinema has been added"
        );
    }

    public function get_all()
    {
        $sql = "SELECT * FROM cinemas ORDER BY name ASC";
        $result = mysqli_query($this->connection, $sql);

        $data = array();
        while ($row = mysqli_fetch_object($result))
        {
            array_push($data, $row);
        }
        return $data;
    }

    public function do_delete($cinema_id)
    {
        $sql = "DELETE FROM `cinemas` WHERE id = '" . $cinema_id . "'";
        mysqli_query($this->connection, $sql);

        return array(
            "status" => "error",
            "message" => "Cinema has been deleted"
        );
    }

    public function delete_movies($movie_id)
    {
        $sql = "DELETE FROM `movie_cinemas` WHERE movie_id = '" . $movie_id . "'";
        mysqli_query($this->connection, $sql);

        return array(
            "status" => "error",
            "message" => "Movies cinemas has been deleted"
        );
    }

    public function get($cinema_id)
    {
        $sql = "SELECT * FROM cinemas WHERE id = '" . $cinema_id . "'";
        $result = mysqli_query($this->connection, $sql);
        $row = mysqli_fetch_object($result);
        return $row;
    }

    public function edit($cinema_id)
    {
        $name = $_POST["name"];

        $sql = "UPDATE `cinemas` SET `name` = '" . $name . "' WHERE id = '" . $cinema_id . "'";
        mysqli_query($this->connection, $sql);

        return array(
            "status" => "success",
            "message" => "Cinema has been updated"
        );
    }
}