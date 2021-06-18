<?php

namespace app\models;

use app\core\Model;
use PDO;

class LayoutModel extends Model
{
	// Проверяем на наличие поискового запроса
	public function checkSearchWord($word)
	{
		$sql = "SELECT * FROM search_query WHERE word = :word";
		
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":word", $word, PDO::PARAM_STR);
		$stmt->execute();

		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return !empty($res) ? true : false;
	}
	// Выбираем данные о видео из базы данных
	public function getQueryResult($word)
	{
		$sql = 'SELECT 
		search_query.word, search_query.user_email, 
		video_details.title, video_details.url_img AS url, video_details.url_video AS video_id, video_details.data
		FROM search_query
		JOIN search_details
		ON search_details.search_query_id = search_query.id
		JOIN video_details
		ON video_details.id = search_details.video_details_id
		WHERE search_query.word = :word';
		$search_details = $this->queryResult($sql, $word);
		return $search_details;
	}

	public function queryResult($sql, $word)
	{
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":word", $word, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
	}
	public function addNewSearchWordAndData($videos_date)
	{
		//INSERT
	}
}