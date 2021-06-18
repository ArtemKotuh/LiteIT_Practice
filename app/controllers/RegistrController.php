<?php

namespace app\controllers;

use app\core\Controller;
use app\models\RegistrModel;
use app\core\View;

class RegistrController extends Controller
{
	//подключаем файл с версткой
	private $pageTpl = '/app/views/pages/registr.php';

	public function __construct()
	{
		$this->model = new RegistrModel();
		$this->view = new View();
	}

	public function index()
	{
		
		// Заголовок страницы
		$this->pageData['title'] = "Регистрация";
		if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])) 
		{
			if ($this->registr())
			{
				$this->pageData['registrMsg'] = "Вы успешно зарегистрированы. Пожалуйста, авторизуйтесь";
				$_POST['action'] = 'login';
			}
				
			else
				$this->pageData['registrMsg'] = "Произошла ошибка во время регистрации";
		}
		$this->view->gotoPage();
		$this->view->render($this->pageTpl, $this->pageData);
	}

	public function registr()
	{
		// Сохраняем введённые данные в переменные для дальнейшей коректной работы
		$regName = strip_tags(trim($_POST['name']));
		$regEmail = strip_tags(trim($_POST['email']));
		$regPassword = strip_tags(trim(md5($_POST['password'])));
		// echo $regName . '<br>' . $regName . '<br>' . $regPassword . '<br>';
		$this->model->registrNewUser($regName, $regEmail, $regPassword);
		return true;
	}
}
