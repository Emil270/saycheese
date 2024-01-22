<?php 

	session_start();
	require '../../include/querys.php'; 

	/*
		Изменение аватара
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit-avatar'])){

		$response = array();
		$imgName = "";
		$tmpFileName = "";

		foreach($_FILES as $image){
			$imgName = time() . "_" . $image['name'];
			$tmpFileName = $image['tmp_name'];
		}

		if(empty($imgName)){
			$response['status'] = "0";
			$response['error'] = "Ошибка получения изображения";
			echo json_encode($response);
			exit();
		}
		
		$avatar = $imgName;
		$path = SITE_ROOT . "/saycheese/assets/images/avatars/" . $imgName;
		$result = move_uploaded_file($tmpFileName, $path);

		if($_SESSION['avatar'] != ""){
			unlink(SITE_ROOT . "/saycheese/assets/images/avatars/" . $_SESSION['avatar']);
		}

		if(!$result){
			$response['status'] = "0";
			$response['error'] = "Ошибка загрузки изображения на сервер";
			echo json_encode($response);
			exit();
		}

		if($_SESSION['role'] == "Клиент"){
			Update("client", ["avatar" => $avatar], ["id_user" => ["=", $_SESSION['id']]]);
		}
		elseif($_SESSION['role'] == "Модератор" || $_SESSION['role'] == "Фотограф" || $_SESSION['role'] == "Специалист по обработке фотографий"){
			Update("staff", ["avatar" => $avatar], ["id_user" => ["=", $_SESSION['id']]]);
		}
		elseif($_SESSION['role'] == "Администратор"){
			Update("admin", ["avatar" => $avatar], ["id_user" => ["=", $_SESSION['id']]]);
		}

		$_SESSION['avatar'] = $avatar;
		$response['status'] = "1";
		echo json_encode($response);
		exit();

	}

	/*
		Удаление аватара
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete-avatar'])){

		$response = array();

		if($_SESSION['avatar'] == ""){
			$response['status'] = "0";
			$response['error'] = "У вас нет аватарки - нечего удалять :D";
			echo json_encode($response);
			exit();
		}
		if($_SESSION['role'] == "Клиент"){
			Update("client", ["avatar" => ""], ["id_user" => ["=", $_SESSION['id']]]);
		}
		elseif($_SESSION['role'] == "Модератор" || $_SESSION['role'] == "Фотограф" || $_SESSION['role'] == "Специалист по обработке фотографий"){
			Update("staff", ["avatar" => ""], ["id_user" => ["=", $_SESSION['id']]]);
		}
		elseif($_SESSION['role'] == "Администратор"){
			Update("admin", ["avatar" => ""], ["id_user" => ["=", $_SESSION['id']]]);
		}
		unlink(SITE_ROOT . "/saycheese/assets/images/avatars/" . $_SESSION['avatar']);
		$_SESSION['avatar'] = "";
		$response['status'] = "1";
		echo json_encode($response);
		exit();
	}

	/*
		Изменение имени и фамилии
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit-fullname'])){

		$response = array();

		$name = $_POST['name'];
		$surname = $_POST['surname'];

		if($name == "" || $surname == ""){
			$response['status'] = "0";
			$response['error'] = "Вы ввели не все данные!";
			echo json_encode($response);
			exit();
		}
		if($_SESSION['role'] == "Клиент"){
			Update("client", ["name" => $name, "surname" => $surname], ["id_user" => ["=",$_SESSION['id']]]);
		}
		elseif($_SESSION['role'] == "Модератор" || $_SESSION['role'] == "Фотограф" || $_SESSION['role'] == "Специалист по обработке фотографий"){
			Update("staff", ["name" => $name, "surname" => $surname], ["id_user" => ["=",$_SESSION['id']]]);
		}
		elseif($_SESSION['role'] == "Администратор"){
			Update("admin", ["name" => $name, "surname" => $surname], ["id_user" => ["=",$_SESSION['id']]]);
		}
		$_SESSION['name'] = $name;
		$_SESSION['surname'] = $surname;
		$response['status'] = "1";
		echo json_encode($response);
		exit();
	}

	/*
		Изменение эл. почты
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit-email'])){

		$response = array();

		$email = $_POST['email'];
		$pass = $_POST['pass'];
		if($email == "" || $pass == ""){
			$response['status'] = "0";
			$response['error'] = "Вы ввели не все данные";
			echo json_encode($response);
			exit();
		}
		$user = Select("user", ["id" => ["=", $_SESSION['id']]]);
		if(!password_verify($pass, $user[0]['pass'])){
			$response['status'] = "0";
			$response['error'] = "Неправильный пароль!";
			echo json_encode($response);
			exit();
		}
		$check_email = Select("user", ["email" => ["=", $email]]);
		if(!empty($check_email)){
			$response['status'] = "0";
			$response['error'] = "Эл. почта используется другим пользователем!";
			echo json_encode($response);
			exit();
		}
		Update("user", ["email" => $email], ["id" => ["=", $_SESSION['id']]]);
		$_SESSION['email'] = $email;
		$response['status'] = "1";
		echo json_encode($response);
		exit();
	}

	/*
		Изменение номера телефона
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit-phone'])){

		$response = array();

		$phone = $_POST['phone'];
		$pass = $_POST['pass'];
		if($phone == "" || $pass == ""){
			$response['status'] = "0";
			$response['error'] = "Вы ввели не все данные";
			echo json_encode($response);
			exit();
		}
		$user = Select("user", ["id" => ["=", $_SESSION['id']]]);
		if(!password_verify($pass, $user[0]['pass'])){
			$response['status'] = "0";
			$response['error'] = "Неправильный пароль!";
			echo json_encode($response);
			exit();
		}
		$check_phone = Select("user", ["phone" => ["=", $phone]]);
		if(!empty($check_phone)){
			$response['status'] = "0";
			$response['error'] = "Номер телефона используется другим пользователем!";
			echo json_encode($response);
			exit();
		}
		Update("user", ["phone" => $phone], ["id" => ["=", $_SESSION['id']]]);
		$_SESSION['phone'] = $phone;
		$response['status'] = "1";
		echo json_encode($response);
		exit();
	}

	/*
		Изменение пароля
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit-pass'])){

		$response = array();

		$new_pass = $_POST['new_pass'];
		$old_pass = $_POST['old_pass'];
		if($new_pass === "" || $old_pass === ""){
			$response['status'] = "0";
			$response['error'] = "Вы ввели не все данные";
			echo json_encode($response);
			exit();
		}
		elseif(strlen($new_pass) < 7){
			$response['status'] = "0";
			$response['error'] = "Пароль не может быть меньше 7 символов";
			echo json_encode($response);
			exit();
		}
		$user = Select("user", ["id" => ["=", $_SESSION['id']]]);
		if(!password_verify($old_pass, $user[0]['pass'])){
			$response['status'] = "0";
			$response['error'] = "Неправильный пароль";
			echo json_encode($response);
			exit();
		}
		$options = [
			'cost' => 12
		];
		$hash = password_hash($new_pass, PASSWORD_BCRYPT, $options);
		Update("user", ["pass" => $hash], ["id" => ["=", $_SESSION['id']]]);
		if($_SESSION['role'] == "Клиент"){
			setcookie("user_login", $hash, time() + 3600, "/");
		}
		else{
			setcookie("staff_login", $hash, time() + 3600, "/");
		}
		$response['status'] = "1";
		echo json_encode($response);
		exit();
	}

?>