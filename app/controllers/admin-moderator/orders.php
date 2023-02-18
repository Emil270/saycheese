<?php 
	
	session_start();
	require '../../../app/include/querys.php';

	/*
		Пагинация для заказов
	*/

	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	if(!is_numeric($page) || $page == "" || $page < 0){
		header("Location: /saycheese/pages/general/error404.php");
		exit();
	}
	$limit = 8;
	$offset = $limit * ($page - 1);
	$orders = Select("orderr");
	$max_page = ceil(count($orders) / $limit);
	if($page > $max_page){
		header("Location: /saycheese/pages/general/error404.php");
		exit();
	}
	$orders = Select("orderr", [], $limit, $offset, "id");

	/*
		Поиск заказа по его коду
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search_order_by_code'])){
		$code = $_POST['code'];
		$orders = Select("orderr", ["code" => ["LIKE", $code."%"]]);
		$max_page = ceil(count($orders) / $limit);
		if($page > $max_page){
			header("Location: /saycheese/pages/general/error404.php");
			exit();
		}
		$orders = Select("orderr", ["code" => ["LIKE", $code."%"]], $limit, $offset, "id");
	}
	else{
		$code = "";
	}

	/*
		Изменение статуса заказа
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status'])){
		$status = $_POST['status'];
		$id = (int)$_POST['id'];
		Update("orderr", ["status" => $status], ["id" => ["=", $id]]);
		$response = ["success" => "Успешно!"];
		echo json_encode($response);
	}

?>