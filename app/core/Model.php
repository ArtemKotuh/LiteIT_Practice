<?php

namespace app\core;

class Model
{
	public $db;

	public function __construct()
	{
		$this->db = DB::getInstance()->getConnection();
	}
}




