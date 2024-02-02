<?php

class Bootstrap
{
	public function __construct()
	{
		// 1. Router
		$getRoute = explode("/", rtrim($_SERVER["REQUEST_URI"], "/"));

		// 2. Dispatcher
		if(isset($getRoute[2])){
			$controllerName = ucfirst($getRoute[2]);
			if(file_exists("Controllers/".$controllerName.".php")){
				require_once "Controllers/".$controllerName.".php";
				$controller = new $controllerName;
				if(isset($getRoute[3])){
					$actionName = $getRoute[3]."Action";
					$controller->{$actionName}();
				}
				else{//set default action
					$controller->leadAction();
				}
			}
			else{
				require_once "Controllers/Error/error.php";
				$controller = new Error();
				$controller->IndexAction();
			}
		}else {
			require_once "Controllers/index.php";
			$controller = new Index();
			$controller->leadAction();
		}
	}
}