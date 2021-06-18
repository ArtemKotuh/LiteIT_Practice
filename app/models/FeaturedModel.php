<?php

namespace app\models;

use app\core\Model;
use PDO;

class FeaturedModel extends Model
{
	// Выбрать избранные видео для текущего авторизированого пользователя
	public function getAllFeaturedVideo($email)
	{
		//Выборка данных из таблицы 
		$sql = 'SELECT users.email, video_details.title, video_details.url_img AS url, video_details.url_video AS video_id, video_details.data
		FROM users
		JOIN featured
		ON featured.users_email = users.email
		JOIN video_details
		ON video_details.id = featured.video_details_id
		WHERE users.email = :email';

		$featured = $this->AllFeaturedVideo($sql, $email);
		return $featured;
	}

	public function AllFeaturedVideo($sql, $email)
	{
		$stmt = $this->db->prepare($sql,);
		$stmt->bindValue(":email", $email, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
	}
	public function addNewFeatured($title, $url, $video_id, $data, $users_email)
	{
		// Добавляем почту пользователя, который добавил видео в избранное
		$sql = "INSERT INTO featured(users_email)
				VALUES (:users_email)";

		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":users_email", $users_email, PDO::PARAM_STR);
		$stmt->execute();
	}
}
