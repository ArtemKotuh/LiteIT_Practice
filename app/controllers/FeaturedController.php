<?php

namespace app\controllers;

use app\core\Controller;
use app\models\FeaturedModel;
use app\core\View;

class FeaturedController extends Controller
{
	//подключаем файл с версткой
	private $pageTpl =  '/app/views/pages/Featured.php';
	
	public function __construct()
	{
		$this->model = new FeaturedModel();
		$this->view = new View();
	}

	public function index()
	{
		$this->view->checkAuthorization();
		$this->pageData['title'] = 'Featured';
		$current_user = $_SESSION['current_user'];
		$videos_date = [];
		// Записываем данные о избранных видео в базу данных
		if (!empty($_POST['title']) && !empty($_POST['url']) && !empty($_POST['publishedAt']) && !empty($_POST['video_id']) && !!empty($current_user)) {
			$this->featured($current_user);
		}
		// Получаем список избранных видео текущего пользователя с базы данных и выводим на Front-end
		$this->pageData['videos_date'] = $this->model->getAllFeaturedVideo($current_user);
		// Записываем текущего пользователя
		$this->pageData['current_user'] = $current_user;
		$this->view->gotoPage();
		$this->view->render($this->pageTpl, $this->pageData);
	}
	public function featured($current_user)
	{
		// Сохраняем введённые данные в переменные для дальнейшей коректной работы
		$title= strip_tags(trim($_POST['title']));
		$url = strip_tags(trim($_POST['url']));
		$video_id = strip_tags(trim($_POST['video_id']));
		$data = date("d.m.Y G:i", strtotime(strip_tags(trim($_POST['publishedAt']))));

		$this->model->addNewFeatured($title, $url, $video_id, $data, $current_user);
		return true;
	}
}
