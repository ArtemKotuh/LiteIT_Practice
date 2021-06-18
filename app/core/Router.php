<?php

namespace app\core;

class Router
{
	function buildRoute()
	{
		// Страница по умолчанию
		$controllerName = "LayoutController";
		$action = "index";

		//Получаем адресную строку
		$route = explode("/", $_SERVER['REQUEST_URI']);

		//Определяем контроллер
		if (!empty($route[1])) {
			$controllerName = ucfirst($route[1] . "Controller");
		}

		if (!empty($_GET)) {
			$controllerName = "LayoutController";
		}
		//Формируем путь к контроллеру (класу)
		$pathController = "app\controllers\\" . $controllerName;
		if (isset($route[2]) && $route[2] != '')
			$action = $route[2];
		//Проверяем наличие класса
		if (class_exists($pathController)) {
			//Проверяем существование метода (екшена)
			if (method_exists($pathController, $action)) {
				$controller = new $pathController();
				$controller->$action();
			} else {
				View::errorPage(405);
			}
		} else {
			View::errorPage(404);
		}
	}
}
