<?php 
	
	session_start();
	require '../../../app/include/querys.php';

	/*
		Пагинация для заказов и поиск по коду заказа
	*/

	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$code = isset($_GET['code']) ? $_GET['code'] : "";

	if(!is_numeric($page) || $page == "" || $page < 0){
		header("Location: /saycheese/pages/general/error404.php");
		exit();
	}

	$limit = 8;
	$offset = $limit * ($page - 1);
	$orders = Select("orderr");
	$max_page = ceil(count($orders) / $limit);

	if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search_order_by_code'])){
		header("Location: ?code=$code&page=1");
	}

	$orders = Select("orderr", ["code" => ["LIKE", $code."%"]]);
	$max_page = ceil(count($orders) / $limit);
	if($page > $max_page){
		header("Location: /saycheese/pages/general/error404.php");
		exit();
	}
	$orders = Select("orderr", ["code" => ["LIKE", $code."%"]], $limit, $offset, "id");

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