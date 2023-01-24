<?php

class Security {

	public static function csrf_token() {
		$token = md5(time());
		$_SESSION["token"] = $token;
		return "<input type='hidden' name='token' id='token' value='$token' />";
	}

	public static function is_valid_token($token) {
		return (isset($_SESSION["token"]) && $_SESSION["token"] == $token);
	}

	public static function free_token() {
		unset($_SESSION["token"]);
	}

}