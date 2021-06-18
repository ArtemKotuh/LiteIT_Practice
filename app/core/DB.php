<?php

namespace app\core;

use PDO;
use PDOException;

class DB
{
	private static $instance = null; //Создаём только один экземпляр подключения
	private $connection;

	//Объявляем приватный конструктор чтобы предотвратить создание нового экземпляра вне класса
	private function __construct()
	{
		$dbConf = require 'app/config/db.php';
		try {
			$this->connection = new PDO(
				"mysql:host=" . $dbConf['host'] . ";
				dbname=" . $dbConf['name'],
				$dbConf['user'],
				$dbConf['pass'],
				array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
			);
		} catch (PDOException $exception) {
			print_r($exception);
		}
	}

	public static function getInstance()
	{
		if (!self::$instance) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function getConnection()
	{
		return $this->connection;
	}

	//Объявляем защищенный метод чтобы предотвратить клонирование экземпляра класса
	protected function __clone()
	{
	}
	//Объявляем защищенный метод для предотвращения десериализации экземпляра класса
	protected function __wakeup()
	{
	}
}
