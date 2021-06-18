<?php

namespace app\core;

class View
{
	public function render($tpl, $pageData)
	{
		include $_SERVER['DOCUMENT_ROOT'] . $tpl;
	}
	public function redirect($url)
	{
		header('location: ' . $url);
		exit;
	}
	// Страница ошибки 404 в случае если нужная нам страница не найдена
	public static function errorPage($code)
	{
		http_response_code($code);
		echo "Страница 404";
	}
	//переход по страницам (дефолтная страница - layout.php)
	public function gotoPage()
	{
		
		if (!empty($_POST)) {
			$action = strip_tags(trim($_POST['action']));
			switch ($action) {
				case 'login':
					header("Location: /login");
					break;
				case 'registr':
					header("Location: /registr");
					break;
				case 'featured':
					header("Location: /featured");
					break;
					case '':
						header("Location: /");
						break;
				case 'logout':
					session_destroy();
					header("Location: /");
					break;
			}
		}
		// else {
		// 	echo "_POST is empty!";
		// }
	}
	//Проверяем, была ли авторизация, если нет то перенаправляем на страницу регистрации (авторизации)
	public function checkAuthorization()
	{
		if (!$_SESSION['authorization'])
			header("Location: /login");
	}
}
