<?php 

	/*
		Обработка POST-запроса для перенаправления выбранной услуги выбранному специалисту
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_request'])){

		require '../../include/querys.php';

		$response = array();
		$id_request = $_POST['id_request'];
		$id_specialist = $_POST['photographer'];

		if($id_specialist == 0){
			$response['status'] = "0";
			$response['error'] = "Вы не выбрали фотографа";
			echo json_encode($response);
			exit();
		}

		Update("request_to_photographer", ["id_specialist" => $id_specialist, "status" => "В процессе"], ["id" => ["=", $id_request]]);
		$response['status'] = "1";
		echo json_encode($response);

	}

	/*
		Фильтрация
	*/
 
	$date = isset($_GET['date']) ? $_GET['date'] : "";
	$style = isset($_GET['style']) ? $_GET['style'] : 0;
	$empty = "";

	if (DateTime::createFromFormat('Y-m-d', $date) == false && $date != ""){
		header("Location: /saycheese/pages/general/error404.php");
		exit();
	}

	if(is_numeric($style) == false || $style < 0 || $style > 11){
		header("Location: /saycheese/pages/general/error404.php");
		exit();
	}

	if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['requests_search'])){
		header("Location: ?date=$date&style=$style");
	}

	switch($style){
		case 0: $photosession_style = 0; break;
		case 1: $photosession_style = "Обсужу с фотографом"; break;
		case 2: $photosession_style = "Портретная фотография"; break;
		case 3: $photosession_style = "Фотосессия в стиле Lifestyle"; break;
		case 4: $photosession_style = "Фотосессия в стиле Love Story"; break;
		case 5: $photosession_style = "Фотосессия в стиле Fashion"; break;
		case 6: $photosession_style = "Фотосессия в ретро стиле"; break;
		case 7: $photosession_style = "Фотосессия в стиле гламур"; break;
		case 8: $photosession_style = "Арт фотосессия"; break;
		case 9: $photosession_style = "Свадебная фотосессия"; break;
		case 10: $photosession_style = "Фотосессия в стиле кантри"; break;
		case 11: $photosession_style = "Фотосессия в стиле фэнтези"; break;
	}

	if($date != "" && $style == 0){
		$params = [
			"date" => ["=", $date],
			"id_specialist" => ["IS", "NULL"]
		];
		$requests = Select("request_to_photographer", $params, 0, 0, "id");
	}
	else{
		$params = [
			"style" => ["=", $photosession_style],
			"date" => ["=", $date],
			"id_specialist" => ["IS", "NULL"]
		];
		$requests = Select("request_to_photographer", $params, 0, 0, "id");
	}
	if($date == "" && $style != 0){
		$params = [
			"style" => ["=", $photosession_style],
			"id_specialist" => ["IS", "NULL"]
		];
		$requests = Select("request_to_photographer", $params, 0, 0, "id");
	}
	if($date == "" && $style == 0){
		$params = [
			"id_specialist" => ["IS", "NULL"]
		];
		$requests = Select("request_to_photographer", $params, 0, 0, "id");
	}

	if(empty($requests)){
		$empty = "1";
	}

	/*
		Получение списка фотографов и количества их текущих невыполненных и выполненных работ
	*/

	$photographers_list = array();
	$count_processing = 0;
	$count_completed = 0;
	$id_photographer = 0;
	$photographer_name = "";
	$photographers = Select("user", ["role" => ["=", "Фотограф"]]);
	for($i = 0; $i < count($photographers); $i++){
		$count_processing = 0;
		$count_completed = 0;
		$id_photographer = $photographers[$i]['id'];
		$staff = Select("staff", ["id_user" => ["=", $id_photographer]]);
		$photographer_name = $staff[0]['surname'] . " " . $staff[0]['name'];
		$params = [
			"id_specialist" => ["=", $id_photographer],
			"status" => ["=", "В процессе"]
		];
		$processing_works = Select("request_to_photographer", $params);
		$count_processing += count($processing_works);
		$params = [
			"id_specialist" => ["=", $id_photographer],
			"status" => ["=", "Завершена"]
		];
		$completed_works = Select("request_to_photographer", $params);
		$count_completed += count($completed_works);
		$photographers_list[$i]['id'] = $id_photographer;
		$photographers_list[$i]['name'] = $photographer_name;
		$photographers_list[$i]['count_processing'] = $count_processing;
		$photographers_list[$i]['count_completed'] = $count_completed;
	}

?>