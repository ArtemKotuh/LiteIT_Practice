<?php
//Подключаем автозагрузку
require_once __DIR__ . '/app/services/vendor/autoload.php';

//Указываем что мы будем использовать класс Router
use app\core\Router;

//Функция автозагрузки
spl_autoload_register(function ($class) {
	//Формируем путь заменяя \\
	$path = str_replace('\\', '/', $class . '.php');
	//Если файл есть то мы его подключаем
	if (file_exists($path))
		require_once $path;
});
//Включаем сесии
session_start();

$router = new Router;
$router->buildRoute();
