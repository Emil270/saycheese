<?php 

	/*
		Проверка, авторизован ли пользователь + заполнение сессий данными авторизованного пользователя
	*/

	if (!isset($_COOKIE['user_login'])) {
		header("Location: /saycheese/pages/general/login.php");
	}
	else{
		$user = Select("user", ["pass" => ["=", $_COOKIE['user_login']]]);
		if($user[0]['role'] == "Клиент"){
			$user_info = Select("client", ["id_user" => ["=", $user[0]['id']]]);
		}
		elseif($user[0]['role'] == "Модератор"){
			$user_info = Select("moderator", ["id_user" => ["=", $user[0]['id']]]);
		}
		elseif($user[0]['role'] == "Администратор"){
			$user_info = Select("admin", ["id_user" => ["=", $user[0]['id']]]);
		}
		$_SESSION['id'] = $user[0]['id'];
		$_SESSION['name'] = $user_info[0]['name'];
		$_SESSION['surname'] = $user_info[0]['surname'];
		$_SESSION['avatar'] = $user_info[0]['avatar'];
		$_SESSION['email'] = $user[0]['email'];
		$_SESSION['role'] = $user[0]['role'];
}

?>