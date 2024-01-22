<?php 

	$success = "";
	$surname_search = "";
	$role_search = "all";

	/*
		Удаление модератора
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['staff_delete'])){
		$id_user = $_POST['staff_delete'];
		$staff = Select("staff", ["id_user" => ["=", $id_user]]);
		$id_staff = $staff[0]['id'];
		$avatar = $staff[0]['avatar'];
		if($avatar != ""){
			unlink(SITE_ROOT . "/saycheese/assets/images/avatars/" . $avatar);
		}
		Delete("staff", ["id" => ["=", $id_staff]]);
		Delete("user", ["id" => ["=", $id_user]]);
		$success = "1";
	}

	/*
		Добавление модератора
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add-staff'])){

		session_start();
		require '../../../app/include/querys.php';

		$response = array();

		$name = trim($_POST['name']);
		$surname = trim($_POST['surname']);
		$email = trim($_POST['email']);
		$phone = trim($_POST['phone']);
		$pass = trim($_POST['pass']);
		$role = $_POST['role'];

		if($name === "" || $surname === "" || $email === "" || $pass === "" || $phone === ""){
			$response['status'] = "0";
			$response['error'] = "Вы ввели не все данные!";
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
		$checking = Select("user", ['email'=>['=',$email]]);
		if(!empty($checking)){
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
		else{
			$options = [
				'cost' => 12
			];
			$pass = password_hash($pass, PASSWORD_BCRYPT, $options);
			$params = [
				'email' => $email,
				'phone' => $phone,
				'pass' => $pass,
				'role' => $role
			];
			$id_current_user = Insert("user", $params);
			$params = [
				'id_user' => $id_current_user,
				'name' => $name,
				'surname' => $surname
			];
			Insert("staff", $params);
			$response['status'] = "1";
			echo json_encode($response);
			exit();
		}
	}

	$staff = SelectAllStaff("user", "staff"); 

	/*
		Фильтрация
	*/

	$surname_search = (isset($_GET['surname'])) ? $_GET['surname'] : "";
	$role_search = (isset($_GET['role'])) ? $_GET['role'] : "all";

	if($role_search != "all" && $role_search != "Модератор" && $role_search != "Фотограф" && $role_search != "Специалист по обработке фотографий"){
		header("Location: /saycheese/pages/general/error404.php");
		exit();
	}

	if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['staff_search'])){
		header("Location: ?surname=$surname_search&role=$role_search");
	}

	if($surname_search == "" && $role_search != "all"){
		$staff = SelectAllStaff("user", "staff", ["t1.role" => ["=", $role_search]]);
	}
	if($surname_search != "" && $role_search == "all"){
		$staff = SelectAllStaff("user", "staff", ["t2.surname" => ["LIKE", "%".$surname_search."%"]]);
	}
	if($surname_search != "" && $role_search != "all"){
		$staff = SelectAllStaff("user", "staff", ["t2.surname" => ["LIKE", "%".$surname_search."%"], "t1.role" => ["=", $role_search]]);
	}
	if($surname_search == "" && $role_search == "all"){
		$staff = SelectAllStaff("user", "staff");
	}

?>