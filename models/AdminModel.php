<?php
/**
 * Created by PhpStorm.
 * User: Adnan Afzal
 * Date: 29/04/2018
 * Time: 8:08 AM
 */

class AdminModel extends Model
{
    private $table = "admins";

    public function login($email, $password)
    {
        $response = array();
        $response["error"] = "";
        $response["msg"] = "";

        $sql = "SELECT * FROM `" . $this->table . "` WHERE `email` = '$email'";
        $result = mysqli_query($this->connection, $sql);

        if (mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_object($result);
            if (password_verify($password, $row->password))
            {
                $response["msg"] = $row;
            }
            else
            {
                $response["error"] = "Password does not match";
            }
        }
        else
        {
            $response["error"] = "Admin does not exists";
        }

        return $response;
    }

    public function get_admin($admin_id)
    {
        $sql = "SELECT * FROM `" . $this->table . "` WHERE `id` = '" . $admin_id . "'";
        $result = mysqli_query($this->connection, $sql);

        if (mysqli_num_rows($result) > 0)
            return mysqli_fetch_object($result);
        else
            return null;
    }
}