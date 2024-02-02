<?php
require_once "Libs/Controller.php";

class Error extends Controller
{
	public function IndexAction()
	{
		$this->view->message = "The controller does not found!";
		$this->view->render("error");
	}
}