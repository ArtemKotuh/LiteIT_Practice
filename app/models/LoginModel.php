<?php

namespace app\models;

use app\core\Model;
use PDO;

class LoginModel extends Model
{
	//Проверяем правельность введённых данных
	public function checkUser($email, $password)
	{
		$sql = "SELECT * FROM users WHERE email = :email AND password = :password";
		
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":email", $email, PDO::PARAM_STR);
		$stmt->bindValue(":password", $password, PDO::PARAM_STR);
		$stmt->execute();

		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		// return !empty($res) ? true : false;
		if (!empty($res)) 
		{
			return true;
		} else
			return false;
	}
}