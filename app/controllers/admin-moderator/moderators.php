<?php 

	$surname = "";
	$error = "";
	$success = "";
	$name = "";
	$surname = "";
	$email = "";
	$surname_search = "";

	/*
		Удаление модератора
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['moderator_delete'])){
		$id_user = $_POST['moderator_delete'];
		$moderator = Select("moderator", ["id_user" => ["=", $id_user]]);
		$id_moderator = $moderator[0]['id'];
		$avatar = $moderator[0]['avatar'];
		if($avatar != ""){
			unlink(SITE_ROOT . "/saycheese/assets/images/avatars/" . $avatar);
		}
		Delete("moderator", ["id" => ["=", $id_moderator]]);
		Delete("user", ["id" => ["=", $id_user]]);
		$success = "1";
	}

	/*
		Добавление модератора
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_moderator'])){
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
					'role' => "Модератор"
				];
				$id_current_user = Insert("user", $params);
				$params = [
					'id_user' => $id_current_user,
					'name' => $name,
					'surname' => $surname
				];
				Insert("moderator", $params);
				$success = "1";
			}
		}
	}

	$moderators = SelectAllModerators("user", "moderator");

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['moderators_search'])){
		$surname_search = $_POST['surname'];
		$moderators = SelectAllModerators("user", "moderator", ["t2.surname" => ["LIKE", "%".$surname_search."%"]]);
	}

?>