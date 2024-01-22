<?php 

	session_start();
	require '../../include/querys.php';

	/*
		Бронирование фотостудии
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book-studio'])){

		$response = array(); 

		if (!isset($_COOKIE['user_login'])){
			$response['status'] = "2";
			echo json_encode($response);
			exit();
		}

		$id_user = $_SESSION['id'];
		$id_photostudio = $_POST['book-studio'];
		$date = $_POST['date_book'];
		$time_start = $_POST['time_book_start'];
		$time_end = $_POST['time_book_end'];

		$params = [
			"id_photostudio" => ["=", $id_photostudio],
			"date" => ["=", $date]
		]; 

		$booksAtCurrentDate = Select("booking", $params);

		for($i = 0; $i < count($booksAtCurrentDate); $i++){
			if(($time_start > $booksAtCurrentDate[$i]['time_start'] && $time_start < $booksAtCurrentDate[$i]['time_end']) || 
			($time_end > $booksAtCurrentDate[$i]['time_start'] && $time_end < $booksAtCurrentDate[$i]['time_end'])){
				$response['status'] = "0";
				$response['error'] = "Выбранные вами дата и время уже заняты";
				echo json_encode($response);
				exit();
			}
			if($time_start < $booksAtCurrentDate[$i]['time_start'] && $time_end > $booksAtCurrentDate[$i]['time_end']){
				$response['status'] = "0";
				$response['error'] = "Выбранные вами дата и время уже заняты";
				echo json_encode($response);
				exit();
			}
		}

		$current_photostudio = Select("photostudio", ["id" => ["=", $id_photostudio]]);
		$duration = round((strtotime($time_end) - strtotime($time_start))/3600, 1);

		$total_price = $current_photostudio[0]['price'] * $duration;

		$params = [
			"id_user" => $id_user,
			"id_photostudio" => $id_photostudio,
			"date" => date('Y-m-d', strtotime($date)),
			"time_start" => date('H:i:s', strtotime($time_start)),
			"time_end" => date('H:i:s', strtotime($time_end)),
			"price" => $total_price,
			"status" => "Новая" 
		];

		Insert("booking", $params);

		$response['status'] = "1";
		echo json_encode($response);
		exit();

	}

	/* 
		Получение занятого времени брони выбранного дня
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['get-busy-time'])){
		$response = array();
		$date = $_POST['date'];
		$busy_time_string = "";
		$busy_time_array = array();
		$id_photostudio = $_POST['id_photostudio'];
		$params = [
			"id_photostudio" => ["=", $id_photostudio],
			"date" => ["=", $date],
			"status" => "Новая"
		];
		$books = Select("booking", $params);
		for($i = 0; $i < count($books); $i++){
			$time_start = new DateTime($books[$i]['time_start']);
			$time_end = new DateTime($books[$i]['time_end']);
			$busy_time_string = date_format($time_start, 'H:i') . " - " . date_format($time_end, 'H:i');
			array_push($busy_time_array, $busy_time_string);
		}
		$date = new DateTime($date);
		$date_book = date_format($date, 'd.m.Y');
		$response['busy_time'] = $busy_time_array;
		$response['date'] = $date_book;
		$response['status'] = "1";
		echo json_encode($response);
		exit();
	}

?>