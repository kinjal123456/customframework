<?php 
require_once "Libs/View.php";

class Controller
{
	public function __construct()
	{
		$this->view = new view();
		$viewSeparator = explode("/", rtrim($_SERVER["REQUEST_URI"], "/"));
		$this->view->resourcePath = (isset($viewSeparator[3]))?"../Resource/":"Resource/";
	}
}