<?php 

	/*
		Проверка, авторизован ли пользователь + заполнение сессий данными авторизованного пользователя
	*/

	if (!isset($_COOKIE['user_login'])) {
		//header("Location: /saycheese/pages/general/login.php");
		$_SESSION['id'] = "";
		$_SESSION['name'] = "";
		$_SESSION['surname'] = "";
		$_SESSION['avatar'] = "";
		$_SESSION['email'] = "";
		$_SESSION['phone'] = "";
		$_SESSION['role'] = "";
	}
	else{
		$user = Select("user", ["pass" => ["=", $_COOKIE['user_login']]]);
		if($user[0]['role'] == "Клиент"){
			$user_info = Select("client", ["id_user" => ["=", $user[0]['id']]]);
		}
		elseif($user[0]['role'] == "Модератор" || $user[0]['role'] == "Фотограф" || $user[0]['role'] == "Специалист по обработке фотографий"){
			$user_info = Select("staff", ["id_user" => ["=", $user[0]['id']]]);
		}
		elseif($user[0]['role'] == "Администратор"){
			$user_info = Select("admin", ["id_user" => ["=", $user[0]['id']]]);
		}
		$_SESSION['id'] = $user[0]['id'];
		$_SESSION['name'] = $user_info[0]['name'];
		$_SESSION['surname'] = $user_info[0]['surname'];
		$_SESSION['avatar'] = $user_info[0]['avatar'];
		$_SESSION['email'] = $user[0]['email'];
		$_SESSION['phone'] = $user[0]['phone'];
		$_SESSION['role'] = $user[0]['role'];
}

?>