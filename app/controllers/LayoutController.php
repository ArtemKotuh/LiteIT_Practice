<?php

namespace app\controllers;

use app\core\Controller;
use app\models\LayoutModel;
use app\core\View;
use app\services\YouTubeVideo;

class LayoutController extends Controller
{
	//подключаем файл с версткой
	private $pageTpl =  '/app/views/pages/layout.php';

	public function __construct()
	{
		$this->model = new LayoutModel();
		$this->view = new View();
	}

	public function index()
	{
		$videos_date = [];
		$this->pageData['title'] = 'Главная страница';
		// Если был сделан запрос на поиск видео
		if (!empty($_GET)) {
			$search_word = $_GET['search'];

			// Проверяем на наличие поискового запроса в базе данных
			if ($this->model->checkSearchWord($search_word)) 
			{
				// Для дальнейшей проверки, какой файл с версткой подлючать
				$_SESSION['YouTubeAPI'] = 'no';
				// Если уже был поиск по введенному слову, получим данные о видео с базы данных
				$videos_date = $this->model->getQueryResult($search_word);
			} 
			else {
				// Если поиск слова был впервые, делаем запрос к YouTube API и добавляем информацию в базу данных
				$video = new YouTubeVideo();
				// Выполняем поиск введённого слова на YouTube
				$dataById = $video->search($search_word);
				// Получаем массив необходимых данных который будем выводить на Front end
				$res = $this->getDataVideo($dataById->getItems());
				foreach ($res as $value) 
				{
					$id = $value['id']->videoId;
					$videos_date[$id]['title'] = $this->removeEmoji(strip_tags(trim($value['title'])));;
					$videos_date[$id]['url'] = strip_tags(trim($value['thumbnails']['default']));
					$videos_date[$id]['publishedAt'] = date("d.m.Y G:i", strtotime(strip_tags(trim($value['publishedAt']))));;
				}

				// $this->model->addNewSearchWordAndData($videos_date);
			}
			$this->pageData['videos_date'] = $videos_date;
			$this->pageData['search_word'] = $search_word;
		}
		$this->view->gotoPage();
		$this->view->render($this->pageTpl, $this->pageData);
	}

	protected function removeEmoji($string)
	{
		// Match Emoticons
		$regex_emoticons = '/[\x{1F600}-\x{1F64F}]/u';
		$clear_string = preg_replace($regex_emoticons, '', $string);
		// Match Miscellaneous Symbols and Pictographs
		$regex_symbols = '/[\x{1F300}-\x{1F5FF}]/u';
		$clear_string = preg_replace($regex_symbols, '', $clear_string);
		// Match Transport And Map Symbols
		$regex_transport = '/[\x{1F680}-\x{1F6FF}]/u';
		$clear_string = preg_replace($regex_transport, '', $clear_string);
		// Match Miscellaneous Symbols
		$regex_misc = '/[\x{2600}-\x{26FF}]/u';
		$clear_string = preg_replace($regex_misc, '', $clear_string);
		// Match Dingbats
		$regex_dingbats = '/[\x{2700}-\x{27BF}]/u';
		$clear_string = preg_replace($regex_dingbats, '', $clear_string);
		return $clear_string;
	}


	protected function getDataVideo(array $videos)
	{
		$dataset = [];

		array_walk($videos, function ($value) use (&$dataset) {
			$dataset[] = [
				'id' => $value->toSimpleObject()->id,
				'title' => $value->toSimpleObject()->snippet->title,
				'publishedAt' => $value->toSimpleObject()->snippet->publishedAt,
				'thumbnails' => [
					'default' =>  $value->toSimpleObject()->snippet->thumbnails->default->url
				],
			];
		});
		return $dataset;
	}
}
