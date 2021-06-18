<?php

namespace app\models;

use app\core\Model;
use PDO;

class RegistrModel extends Model
{
	public function registrNewUser($regName, $regEmail, $regPassword)
	{
		// echo 'registerNewUser';
		//Добавляем в базу данных информацию о зарегистрированом пользователе
		$sql = "INSERT INTO users(name, email, password)
				VALUES (:name, :email, :password)";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":name", $regName, PDO::PARAM_STR);
		$stmt->bindValue(":email", $regEmail, PDO::PARAM_STR);
		$stmt->bindValue(":password", $regPassword, PDO::PARAM_STR);
		$stmt->execute();
	}
}
