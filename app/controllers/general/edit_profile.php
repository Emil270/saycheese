<?php 

	$error = "";
	$success = "";

	/*
		Изменение аватара
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_avatar'])){
		if(!empty($_FILES['avatar']['name'])){
			$imgName = time() . "_" . $_FILES['avatar']['name'];
			$tmpFileName = $_FILES['avatar']['tmp_name'];
			$avatar = $imgName;
			$path = SITE_ROOT . "/saycheese/assets/images/avatars/" . $imgName;
			$result = move_uploaded_file($tmpFileName, $path);
			if($_SESSION['avatar'] != ""){
				unlink(SITE_ROOT . "/saycheese/assets/images/avatars/" . $_SESSION['avatar']);
			}
			if($result){
				if($_SESSION['role'] == "Клиент"){
					Update("client", ["avatar" => $avatar], ["id_user" => ["=", $_SESSION['id']]]);
				}
				elseif($_SESSION['role'] == "Модератор"){
					Update("moderator", ["avatar" => $avatar], ["id_user" => ["=", $_SESSION['id']]]);
				}
				elseif($_SESSION['role'] == "Администратор"){
					Update("admin", ["avatar" => $avatar], ["id_user" => ["=", $_SESSION['id']]]);
				}
				$_SESSION['avatar'] = $avatar;
				$success = "1";
			}
			else{
				$error = "Ошибка загрузки изображения на сервер";
			}
		}
		else{
			$error = "Ошибка получения изображения";
		}
	}

	/*
		Удаление аватара
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['del_avatar'])){
		if($_SESSION['avatar'] == ""){
			$error = "У вас нет аватарки - нечего удалять :D";
		}
		else{
			if($_SESSION['role'] == "Клиент"){
				Update("client", ["avatar" => ""], ["id_user" => ["=", $_SESSION['id']]]);
			}
			elseif($_SESSION['role'] == "Модератор"){
				Update("moderator", ["avatar" => ""], ["id_user" => ["=", $_SESSION['id']]]);
			}
			elseif($_SESSION['role'] == "Администратор"){
				Update("admin", ["avatar" => ""], ["id_user" => ["=", $_SESSION['id']]]);
			}
			unlink(SITE_ROOT . "/saycheese/assets/images/avatars/" . $_SESSION['avatar']);
			$_SESSION['avatar'] = "";
			$success = "1";
		}
	}

	/*
		Изменение имени и фамилии
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_fullname'])){
		$name = $_POST['name'];
		$surname = $_POST['surname'];

		if($name == "" || $surname == ""){
			$error = "Вы ввели не все данные";
		}
		else{
			if($_SESSION['role'] == "Клиент"){
				Update("client", ["name" => $name, "surname" => $surname], ["id_user" => ["=",$_SESSION['id']]]);
			}
			elseif($_SESSION['role'] == "Модератор"){
				Update("moderator", ["name" => $name, "surname" => $surname], ["id_user" => ["=",$_SESSION['id']]]);
			}
			elseif($_SESSION['role'] == "Администратор"){
				Update("admin", ["name" => $name, "surname" => $surname], ["id_user" => ["=",$_SESSION['id']]]);
			}
			$_SESSION['name'] = $name;
			$_SESSION['surname'] = $surname;
			$success = "1";
		}
	}

	/*
		Изменение эл. почты
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_email'])){
		$email = $_POST['email'];
		$pass = $_POST['pass'];
		if($email == "" || $pass == ""){
			$error = "Вы ввели не все данные";
		}
		else{
			$user = Select("user", ["id" => ["=", $_SESSION['id']]]);
			if(!password_verify($pass, $user[0]['pass'])){
				$error = "Неправильный пароль!";
			}
			else{
				$check_email = Select("user", ["email" => ["=", $email]]);
				if(!empty($check_email)){
					$error = "Эл. почта используется другим пользователем!";
				}
				else{
					Update("user", ["email" => $email], ["id" => ["=", $_SESSION['id']]]);
					$_SESSION['email'] = $email;
					$success = "1";
				}
			}
		}
	}

	/*
		Изменение пароля
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_pass'])){
		$new_pass = $_POST['new_pass'];
		$old_pass = $_POST['old_pass'];
		if($new_pass === "" || $old_pass === ""){
			$error = "Вы ввели не все данные";
		}
		elseif(strlen($new_pass) < 7){
			$error = "Пароль не может быть меньше 7 символов";
		}
		else{
			$user = Select("user", ["id" => ["=", $_SESSION['id']]]);
			if(!password_verify($old_pass, $user[0]['pass'])){
				$error = "Неправильный пароль";
			}
			else{
				$options = [
					'cost' => 12
				];
				$hash = password_hash($new_pass, PASSWORD_BCRYPT, $options);
				Update("user", ["pass" => $hash], ["id" => ["=", $_SESSION['id']]]);
				setcookie("user_login", $hash, time() + 3600, "/");
				$success = "1";
			}
		}
	}

?>