<?php
/**
 * Created by PhpStorm.
 * User: Adnan Afzal
 * Date: 28/04/2018
 * Time: 2:06 PM
 */

class UsersModel extends Model
{
    private $table = "users";

    public function register()
    {
        $name = $_POST["name"];
        $mobile_number = $_POST["mobile_number"];
        $email = $_POST["email"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        $sql = "INSERT INTO `" . $this->table . "`(`name`, `email`, `password`, mobile_number) VALUES ('$name', '$email', '$password', '$mobile_number')";
        mysqli_query($this->connection, $sql);
    }

    public function is_exists($email)
    {
        $sql = "SELECT * FROM `" . $this->table . "` WHERE `email` = '$email'";
        $result = mysqli_query($this->connection, $sql);

        return mysqli_num_rows($result) > 0;
    }

    public function login()
    {
        $response = array();
        $response["error"] = "";
        $response["msg"] = "";

        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM `" . $this->table . "` WHERE `email` = '$email'";
        $result = mysqli_query($this->connection, $sql);

        if (mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_object($result);
            if (password_verify($password, $row->password))
            {
                if ($row->verified_at == NULL)
                {
                    $response["error"] = "Please verify your account in order to activate.";
                }
                else
                {
                    $response["message"] = $row;
                }
            }
            else
            {
                $response["error"] = "Password does not match";
            }
        }
        else
        {
            $response["error"] = "Email does not exists";
        }

        return $response;
    }

    public function get($user_id)
    {
        $sql = "SELECT * FROM `" . $this->table . "` WHERE `id` = '$user_id'";
        $result = mysqli_query($this->connection, $sql);

        if (mysqli_num_rows($result) > 0)
            return mysqli_fetch_object($result);
        else
            return null;
    }

    public function get_all()
    {
        $sql = "SELECT * FROM `" . $this->table . "` ORDER BY id DESC";
        $result = mysqli_query($this->connection, $sql);

        $data = array();
        while ($row = mysqli_fetch_object($result))
        {
            array_push($data, $row);
        }
        return $data;
    }

    public function get_by_email($email)
    {
        $sql = "SELECT * FROM `" . $this->table . "` WHERE `email` = '$email'";
        $result = mysqli_query($this->connection, $sql);

        if (mysqli_num_rows($result) > 0)
            return mysqli_fetch_object($result);
        else
            return null;
    }
}