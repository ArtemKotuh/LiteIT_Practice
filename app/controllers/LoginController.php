<?php

namespace app\controllers;

use app\core\Controller;
use app\models\LoginModel;
use app\core\View;

class LoginController extends Controller
{
	//подключаем файл с версткой
	private $pageTpl = '/app/views/pages/login.php';

	public function __construct()
	{
		$this->model = new LoginModel();
		$this->view = new View();
	}
	
	public function index()
	{
		// Заголовок страницы
		$this->pageData['title'] = "Вход";
		// Проверяем были ли заполнены необходимые поля
		if (!empty($_POST['email']) && !empty($_POST['password']))
		{
			$this->login();
			$_SESSION['authorization'] = 'yes';
			$_POST['action'] = '';
			
			$_SESSION['current_user'] = $_POST['email'];
		}
		$this->view->gotoPage();
		$this->view->render($this->pageTpl, $this->pageData);
	}
	
	public function login()
	{
		// Сохраняем значения логина и пароля
		$email = strip_tags(trim($_POST['email']));
		$password = strip_tags(trim(md5($_POST['password'])));
		// Проверяем, есть ли этот пользователь в базе зарегистрированных пользователей
		if (!($this->model->checkUser($email, $password)))
		{
			$this->pageData['errorlogin'] = "Неправильный логин или пароль";
			// return false;
		}
		
	}
}
