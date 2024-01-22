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

		Update("request_to_photoshop", ["date_complete" => $dateNow, "status" => "Завершена"], ["id" => ["=", $id_request]]);
		$response['status'] = "1";
		echo json_encode($response);
	}

	/*
		Фильтрация
	*/

	$style = isset($_GET['style']) ? $_GET['style'] : 0;
	$id_specialist = $_SESSION['id'];
	$empty = "";
	$no_works = "";

	$params = [
		"id_specialist" => ["=", $id_specialist]
	];
	$check_requests = Select("request_to_photoshop", $params, 0, 0, "id");

	if(is_numeric($style) == false || $style < 0 || $style > 11){
		header("Location: /saycheese/pages/general/error404.php");
		exit();
	}

	if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['requests_search'])){
		header("Location: ?date=$date&style=$style");
	}

	switch($style){
		case 0: $photoshop_style = 0; break;
		case 1: $photoshop_style = "Ретушь"; break;
		case 2: $photoshop_style = "Замена фона"; break;
		case 3: $photoshop_style = "Удаление объектов"; break;
		case 4: $photoshop_style = "Коллажи"; break;
		case 5: $photoshop_style = "Художественная обработка"; break;
		case 6: $photoshop_style = "Реставрация"; break;
	}

	if($style == 0){
		$params = [
			"id_specialist" => ["=", $id_specialist]
		];
		$requests = Select("request_to_photoshop", $params, 0, 0, 0, "status");
	}
	else{
		$params = [
			"style" => ["=", $photoshop_style],
			"id_specialist" => ["=", $id_specialist]
		];
		$requests = Select("request_to_photoshop", $params, 0, 0, 0, "status");
	}

	if(empty($requests)){
		$empty = "1";
	}
	if(empty($check_requests)){
		$empty = "";
		$no_works = "1";
	}

?>