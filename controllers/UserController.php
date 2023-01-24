<?php
/**
 * Created by PhpStorm.
 * User: Adnan Afzal
 * Date: 28/04/2018
 * Time: 1:55 PM
 */

class UserController extends Controller
{
    public function login($message = "")
    {
        $token = $_POST["token"];

        if (Security::is_valid_token($token))
        {
            $model_response = $this->load_model("UsersModel")->login();
            $response["error"] = $model_response["error"];

            if (empty($response["error"]))
            {
                $_SESSION["user"] = $model_response["message"];
                header("Location: " . URL);
            }
            else
            {
                $_SESSION["login_error"] = $response["error"];
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }
        }
        else
        {
            $_SESSION["login_error"] = "Token mismatch";
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

    public function register()
    {
        $token = $_POST["token"];

        if (Security::is_valid_token($token))
        {
            $UsersModel = $this->load_model("UsersModel");
            if ($UsersModel->is_exists($_POST["email"]))
            {
                $_SESSION["login_error"] = "Email already exists";
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }
            else
            {
                $UsersModel->register();

                $_SESSION["login_success"] = "Account has been created. Please login now.";
                header("Location: " . URL);
            }
        }
        else
        {
            $_SESSION["login_error"] = "Token mismatch";
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

    public function goto_login()
    {
        header("Location: " . URL . "user/login");
    }

    public function logout()
    {
        unset($_SESSION["user"]);
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}