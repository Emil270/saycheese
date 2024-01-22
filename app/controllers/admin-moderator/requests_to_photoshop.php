<?php 

	/*
		Обработка POST-запроса для перенаправления выбранной услуги выбранному специалисту
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_request'])){

		require '../../include/querys.php';

		$response = array();
		$id_request = $_POST['id_request'];
		$id_specialist = $_POST['specialist'];

		if($id_specialist == 0){
			$response['status'] = "0";
			$response['error'] = "Вы не выбрали специалиста";
			echo json_encode($response);
			exit();
		}

		Update("request_to_photoshop", ["id_specialist" => $id_specialist, "status" => "В процессе"], ["id" => ["=", $id_request]]);
		$response['status'] = "1";
		echo json_encode($response);

	}

	/*
		Фильтрация
	*/

	$style = isset($_GET['style']) ? $_GET['style'] : 0;
	$empty = "";

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
			"id_specialist" => ["IS", "NULL"]
		];
		$requests = Select("request_to_photoshop", $params, 0, 0, "id");
	}
	else{
		$params = [
			"style" => ["=", $photoshop_style],
			"id_specialist" => ["IS", "NULL"]
		];
		$requests = Select("request_to_photoshop", $params, 0, 0, "id");
	}

	if(empty($requests)){
		$empty = "1";
	}

		/*
		Получение списка фотографов и количества их текущих невыполненных и выполненных работ
	*/

	$specialists_list = array();
	$count_processing = 0;
	$count_completed = 0;
	$id_specialist = 0;
	$specialist_name = "";
	$specialists = Select("user", ["role" => ["=", "Специалист по обработке фотографий"]]);
	for($i = 0; $i < count($specialists); $i++){
		$count_processing = 0;
		$count_completed = 0;
		$id_specialist = $specialists[$i]['id'];
		$staff = Select("staff", ["id_user" => ["=", $id_specialist]]);
		$specialist_name = $staff[0]['surname'] . " " . $staff[0]['name'];
		$params = [
			"id_specialist" => ["=", $id_specialist],
			"status" => ["=", "В процессе"]
		];
		$processing_works = Select("request_to_photoshop", $params);
		$count_processing += count($processing_works);
		$params = [
			"id_specialist" => ["=", $id_specialist],
			"status" => ["=", "Завершена"]
		];
		$completed_works = Select("request_to_photoshop", $params);
		$count_completed += count($completed_works);
		$specialists_list[$i]['id'] = $id_specialist;
		$specialists_list[$i]['name'] = $specialist_name;
		$specialists_list[$i]['count_processing'] = $count_processing;
		$specialists_list[$i]['count_completed'] = $count_completed;
	}

?>