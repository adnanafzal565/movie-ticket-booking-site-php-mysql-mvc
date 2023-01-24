<?php
	ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    session_start();
	
	require_once("system/config.php");
	require_once("system/Security.php");
	require_once("controllers/Controller.php");
	require_once("models/Model.php");
	
	if(isset($_GET["url"]))
	{
		$parts = explode("/", $_GET["url"]);
		if(file_exists("controllers/" . ucfirst($parts[0]) . "Controller.php"))
		{
			require_once("controllers/" . ucfirst($parts[0]) . "Controller.php");
			$controller_name = ucfirst($parts[0]) . "Controller";
			$controller = new $controller_name();
		}
		else
		{
			show_404();
		}
		if(isset($parts[1]) && !empty($parts[1]))
		{
			if(method_exists($controller, $parts[1]))
			{
				$action_name = $parts[1];
				if(isset($parts[4]))
					$controller->{$action_name}($parts[2], $parts[3], $parts[4]);
				else if(isset($parts[3]))
					$controller->{$action_name}($parts[2], $parts[3]);
				else if(isset($parts[2]))
					$controller->{$action_name}($parts[2]);
				else
					$controller->{$action_name}();
			}
			else
			{
				show_404();
			}
		}
		else
		{
			$controller->index();
		}
	}
	else
	{
		require_once("controllers/HomeController.php");
		$controller = new HomeController();
		$controller->index();
	}
	
	function show_404()
	{
		require_once(VIEW . "404/404-index.php");
	}
?>