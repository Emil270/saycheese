<?php 

	session_start();
	require '../../include/querys.php';

	//$error = "";

	// Обработка формы регистрации //

	if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['create-account'])){
		$response = array();
		$name = trim($_POST['name']);
		$surname = trim($_POST['surname']);
		$email = trim($_POST['email']);
		$phone = trim($_POST['phone']);
		$pass = trim($_POST['pass']);
		if($name === "" || $surname === "" || $email === "" || $pass === "" || $phone === ""){
			$response['status'] = "0";
			$response['error'] = "Вы ввели не все даныне";
			echo json_encode($response);
			exit();
		}
		if(strlen($phone) < 11 || strlen($phone) > 12){
			$response['status'] = "0";
			$response['error'] = "Вы некорректно ввели номер телефона";
			echo json_encode($response);
			exit();
		}
		if(strlen($pass) < 7){
				$response['status'] = "0";
				$response['error'] = "Пароль не может быть меньше 7 символов";
				echo json_encode($response);
				exit();
		}
		$checking_email = Select("user", ['email'=>['=',$email]]);
		if(!empty($checking_email)){
			$response['status'] = "0";
			$response['error'] = "Эл. почта используется другим пользователем!";
			echo json_encode($response);
			exit();
		}
		$checking_phone = Select("user", ['phone'=>['=',$phone]]);
		if(!empty($checking_phone)){
			$response['status'] = "0";
			$response['error'] = "Номер телефона используется другим пользователем!";
			echo json_encode($response);
			exit();
		}
		$options = [
			'cost' => 12
		];
		$pass = password_hash($pass, PASSWORD_BCRYPT, $options);
		$params = [
			'email' => $email,
			'phone' => $phone,
			'pass' => $pass,
			'role' => "Клиент"
		];
		$id_current_user = Insert("user", $params);
		$params = [
			'id_user' => $id_current_user,
			'name' => $name,
			'surname' => $surname
		];
		Insert("client", $params);
		$response['status'] = "1";
		echo json_encode($response);
	}

	// Обработка формы авторизации //

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])){
		$response = array();
		$email = trim($_POST['email']);
		$pass = trim($_POST['pass']);
		if($email === "" || $pass === ""){
			$response['status'] = "0";
			$response['error'] = "Вы ввели не все данные";
			echo json_encode($response);
			exit();
		}
		$user = Select("user", ['email' => ['=', $email]]);
		if(empty($user)){
			$response['status'] = "0";
			$response['error'] = "Неправильная эл. почта или пароль";
			echo json_encode($response);
			exit();
		}
		if(!password_verify($pass, $user[0]['pass'])){
			$response['status'] = "0";
			$response['error'] = "Неправильный логин или пароль";
			echo json_encode($response);
			exit();
		}
		$response['status'] = "1";
		if($user[0]['role'] == "Клиент"){
			$response['role'] = "client";
			setcookie('user_login', $user[0]['pass'], time() + 3600, '/');
		}
		if($user[0]['role'] == "Модератор" || $user[0]['role'] == "Администратор"){
			$response['role'] = "admin_moderator";
			setcookie('staff_login', $user[0]['pass'], time() + 3600, '/');
		}
		if($user[0]['role'] == "Фотограф" || $user[0]['role'] == "Специалист по обработке фотографий"){
			$response['role'] = "specialist";
			setcookie('staff_login', $user[0]['pass'], time() + 3600, '/');
		}
		echo json_encode($response);
	}
