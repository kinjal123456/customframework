<?php 

class View
{
	public function __construct()
	{
		
	}
	
	public function render($viewScript)
	{
		require("Views/".$viewScript.".php");
	}
}