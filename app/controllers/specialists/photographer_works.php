<?php 

	/*
		Обработка POST-запроса для завершения работы над заявкой клиента
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_request'])){
		session_start();
		require '../../include/querys.php';

		$response = array();
		$id_request = $_POST['id_request'];
		$dateNow = date("Y-m-d"); 

		Update("request_to_photographer", ["date_complete" => $dateNow, "status" => "Завершена"], ["id" => ["=", $id_request]]);
		$response['status'] = "1";
		echo json_encode($response);
	}

	/*
		Фильтрация
	*/

	$date = isset($_GET['date']) ? $_GET['date'] : "";
	$id_specialist = $_SESSION['id'];
	$empty = "";
	$no_works = "";

	$params = [
		"id_specialist" => ["=", $id_specialist]
	];
	$check_requests = Select("request_to_photographer", $params, 0, 0, "id");

	if (DateTime::createFromFormat('Y-m-d', $date) == false && $date != ""){
		header("Location: /saycheese/pages/general/error404.php");
		exit();
	}

	if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['requests_search'])){
		header("Location: ?date=$date");
	}


	if($date != ""){
		$params = [
			"date" => ["=", $date],
			"id_specialist" => ["=", $id_specialist]
		];
		$requests = Select("request_to_photographer", $params, 0, 0, 0, "status");
	}
	if($date == ""){
		$params = [
			"id_specialist" => ["=", $id_specialist]
		];
		$requests = Select("request_to_photographer", $params, 0, 0, 0, "status");
	}

	if(empty($requests)){
		$empty = "1";
	}

	if(empty($check_requests)){
		$empty = "";
		$no_works = "1";
	}

?>