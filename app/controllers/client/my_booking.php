<?php

	session_start();
	require '../../../app/include/querys.php';

	$date = "";
	$empty = "";
	$id_user = $_SESSION['id'];

	/*
		Обработка POST-запроса для отмены брони
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_booking'])){
		$response = array();
		$id_booking = $_POST['id_booking'];
		DELETE("booking", ["id" => ["=", $id_booking]]);
		$response['status'] = "1";
		echo json_encode($response);
	}

	/*
		Фильтрация 
	*/

	$date = isset($_GET['date']) ? $_GET['date'] : "";

	if (DateTime::createFromFormat('Y-m-d', $date) == false && $date != ""){
		header("Location: /saycheese/pages/general/error404.php");
		exit();
	}

	if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['booking_search'])){
		header("Location: ?date=$date");
	}

	if($date != ""){
		$params = [
			"date" => ["=", $date],
			"id_user" => ["=", $id_user]
		];
		$booking = Select("booking", $params, 0, 0, "date");
	}
	else{
		$params = [
			"id_user" => ["=", $id_user]
		];
		$booking = Select("booking", $params, 0, 0, "date");
	}

	if(empty($booking)){
		$empty = "1";
	}

?>