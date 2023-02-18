<?php 
	
	session_start();
	require '../../app/include/querys.php';

	$error = "";

	// Обработка формы регистрации //

	if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['btn-reg'])){
		$name = trim($_POST['name']);
		$surname = trim($_POST['surname']);
		$email = trim($_POST['email']);
		$pass = trim($_POST['pass']);
		if($name === "" || $surname === "" || $email === "" || $pass === ""){
			$error = "Вы ввели не все даныне";
		}
		elseif(strlen($pass) < 7){
			$error = "Пароль не может быть меньше 7 символов";
		}
		else{
			$checking = Select("user", ['email'=>['=',$email]]);
			if(!empty($checking)){
				$error = "Эл. почта используется другим пользователем!";
			}
			else{
				$options = [
					'cost' => 12
				];
				$pass = password_hash($pass, PASSWORD_BCRYPT, $options);
				$params = [
					'email' => $email,
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
				header("Location: login.php");
			}
		}
	}
	else{
		$name = "";
		$surname = "";
		$email = "";
	}

	// Обработка формы авторизации //

	if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['btn-log'])){
		$email = trim($_POST['email']);
		$pass = trim($_POST['pass']);
		if($email === "" || $pass === ""){
			$error = "Вы ввели не все данные!";
		}
		else{
			$user = Select("user", ['email' => ['=', $email]]);
			if(empty($user)){
				$error = "Неправильный логин или пароль";
			}
			elseif(!password_verify($pass, $user[0]['pass'])){
				$error = "Неправильный логин или пароль";
			}
			else{
				setcookie('user_login', $user[0]['pass'], time() + 3600, '/');
				if($user[0]['role'] == "Клиент"){
					header("Location: /saycheese/");
				}
				elseif($user[0]['role'] == "Модератор" || $user[0]['role'] == "Администратор"){
					header("Location: /saycheese/pages/admin-moderator/profile/profile.php");
				}
			}
		}
	}
	else{
		$email = "";
	}

?>