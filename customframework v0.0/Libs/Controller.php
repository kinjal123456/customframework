<?php 
require_once "Libs/View.php";

class Controller
{
	public function __construct()
	{
		$this->view = new view();
		$this->view->resourcePath = "../Views/";
	}
}