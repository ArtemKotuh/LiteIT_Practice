<?php

namespace app\core;

class Controller
{
	public $model, $view;
	protected $pageData = array();
	
	public function __construct()
	{
		$this->view = new View();
		$this->model = new Model();
	}
}
