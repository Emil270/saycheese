<?php

	session_start();
	require '../../../app/include/querys.php';

	$date = "";
	$photostudio = 0;
	$empty = "";

	$photostudios = Select("photostudio");

	/*
		Завершение брони
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_booking'])){
		$response = array();
		$id_booking = $_POST['id_booking'];
		Update("booking", ["status" => "Завершена"], ["id" => ["=", $id_booking]]);
		$response['status'] = "1";
		echo json_encode($response);
	}

	/*
		Фильтрация
	*/

	$date = isset($_GET['date']) ? $_GET['date'] : "";
	$photostudio = isset($_GET['photostudio']) ? $_GET['photostudio'] : 0;

	if (DateTime::createFromFormat('Y-m-d', $date) == false && $date != ""){
		header("Location: /saycheese/pages/general/error404.php");
		exit();
	}
	if(is_numeric($photostudio) == false || $photostudio < 0 || $photostudio > 12){
		header("Location: /saycheese/pages/general/error404.php");
		exit();
	}

	if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['booking_search'])){
		header("Location: ?date=$date&photostudio=$photostudio");
	}

	if($date != "" && $photostudio == 0){
		$params = [
			"date" => ["=", $date],
			"status" => ["=", "Новая"]
		];
		$booking = Select("booking", $params, 0, 0, "id");
	}
	else{
		$params = [
			"id_photostudio" => ["=", $photostudio],
			"date" => ["=", $date],
			"status" => ["=", "Новая"]
		];
		$booking = Select("booking", $params, 0, 0, "id");
	}
	if($date == "" && $photostudio != 0){
		$params = [
			"id_photostudio" => ["=", $photostudio],
			"status" => ["=", "Новая"]
		];
		$booking = Select("booking", $params, 0, 0, "id");
	}
	if($date == "" && $photostudio == 0){
		$params = [
			"status" => ["=", "Новая"]
		];
		$booking = Select("booking", $params, 0, 0, "id");
	}

	if(empty($booking)){
		$empty = "1";
	}

?>