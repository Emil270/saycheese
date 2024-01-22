<?php 

	$error = "";
	$success = "";

	/*
		Удаление отзыва
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_review'])){
		$id_review = $_POST['delete_review'];
		Delete("review", ["id" => ["=", $id_review]]);
		$success = "1"; 
	}

	/*
		Пагинация для отзывов
	*/

	$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
	if($page == "" || !is_numeric($page)) { header("Location: /saycheese/pages/general/error404.php"); }
	$limit = 12;
	$offset = $limit * ($page - 1);
	$max_page = ceil(count(Select("review")) / $limit);

	if($page < 0 || $page > $max_page || $page == "" || !is_numeric($page)) { 
		header("Location: /saycheese/pages/general/error404.php");
		exit();
	};

	$reviews = SelectReviewsAndClients("review", "user", "client", $limit, $offset);



?>