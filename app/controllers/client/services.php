<?php 
	session_start();
	require '../../include/querys.php';
	$id_user = $_SESSION['id'];

	/*
		Обработка POST-запроса для создания заявки на услугу фотографа 
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['photographer'])){

		$response = array();

		if (!isset($_COOKIE['user_login'])){
			$response['status'] = "2";
			echo json_encode($response);
			exit();
		}

		$date = $_POST['date'];
		$time_start = $_POST['time_start'];
		$time_end = $_POST['time_end'];
		$place = $_POST['place'];
		$style = $_POST['style'];
		$price = 0;
		$duration = round((strtotime($time_end) - strtotime($time_start))/3600, 1);
		$photosession_style = "";
		if($place == ""){
			$response['status'] = "0";
			$response['error'] = "Вы ввели не все данные";
			echo json_encode($response);
			exit();
		}
		if($style == "null"){
			$response['status'] = "0";
			$response['error'] = "Вы не выбрали стилистику фотосессии";
			echo json_encode($response);
			exit();
		}
		switch ($style){
			case "question": $photosession_style = "Обсужу с фотографом"; $price = $duration * 2000; break;
			case "portrait": $photosession_style = "Портретная фотография"; $price = $duration * 3000; break;
			case "lifestyle": $photosession_style = "Фотосессия в стиле Lifestyle"; $price = $duration * 2000; break;
			case "lovestory": $photosession_style = "Фотосессия в стиле Love Story"; $price = $duration * 3000; break;
			case "fashion": $photosession_style = "Фотосессия в стиле Fashion"; $price = $duration * 4000; break;
			case "retro": $photosession_style = "Фотосессия в ретро стиле"; $price = $duration * 2000; break;
			case "glamour": $photosession_style = "Фотосессия в стиле гламур"; $price = $duration * 3000; break;
			case "art": $photosession_style = "Арт фотосессия"; $price = $duration * 5000; break;
			case "wedding": $photosession_style = "Свадебная фотосессия"; $price = $duration * 6000; break;
			case "country": $photosession_style = "Фотосессия в стиле кантри"; $price = $duration * 3000; break;
			case "fantasy": $photosession_style = "Фотосессия в стиле фэнтези"; $price = $duration * 4000; break;
			default: break;
		}
		$params = [
			"id_user" => $id_user,
			"date" => date('Y-m-d', strtotime($date)),
			"time_start" => date('H:i:s', strtotime($time_start)),
			"time_end" => date('H:i:s', strtotime($time_end)),
			"place" => $place,
			"style" => $photosession_style,
			"price" => $price,
			"status" => "Новая"
		];
		Insert("request_to_photographer", $params);
		$response['status'] = "1";
		echo json_encode($response);
		exit();
	}

	/*
		Обработка POST-запроса для создания заявки на услуги обработки фото
	*/
	
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['photoshop'])){

		$response = array();

		if (!isset($_COOKIE['user_login'])){
			$response['status'] = "2";
			echo json_encode($response);
			exit();
		}

		$style = $_POST['style'];
		$description = $_POST['description'];
		$photoshop_style = "";
		$price = 0;
		if($style == "null"){
			$response['status'] = "0";
			$response['error'] = "Вы не выбрали стилистику обработки";
			echo json_encode($response);
			exit();
		}
		if($description == ""){
			$response['status'] = "0";
			$response['error'] = "Вы ввели не все данные";
			echo json_encode($response);
			exit();
		}
		switch ($style){
			case "retouch": $photoshop_style = "Ретушь"; $price = 1000; break;
			case "background-replace": $photoshop_style = "Замена фона"; $price = 800; break;
			case "remove-objects": $photoshop_style = "Удаление объектов"; $price = 800; break;
			case "collages": $photoshop_style = "Коллажи"; $price = 700; break;
			case "art": $photoshop_style = "Художественная обработка"; $price = 3000; break;
			case "restoration": $photoshop_style = "Реставрация"; $price = 1000; break;
			default: break;
		}

		$price = $price * (count($_FILES) - 1);

		foreach($_FILES as $image){
			if(($image['size'] == 0)){
				$response['status'] = "0";
				$response['error'] = "Вы не выбрали фотографии";
				echo json_encode($response);
				exit();
			}
		}

		$params = [
			"id_user" => $id_user,
			"style" => $photoshop_style,
			"description" => $description,
			"price" => $price,
			"status" => "Новая"
		];

		$id_request = Insert("request_to_photoshop", $params);

		$imgName = "";
		$tmpFileName = "";
		$step = 0;
		$max_step = count($_FILES) - 1;

		foreach($_FILES as $image){
			if($step == $max_step) break;
			$imgName = time() . "_" . $image['name'];
			$tmpFileName = $image['tmp_name'];

			$path = SITE_ROOT . "/saycheese/assets/images/photoshop/" . $imgName;
			$result = move_uploaded_file($tmpFileName, $path);

			if(!$result){
				$response['status'] = "0";
				$response['error'] = "Ошибка загрузки изображения на сервер";
				echo json_encode($response);
				exit();
			}
			$params = [
				"id_request" => $id_request,
				"image" => $imgName
			];
			Insert("images_to_photoshop", $params);
			$step++;
		}

		$response['status'] = 1;
		echo json_encode($response);
		exit();

	}
?>