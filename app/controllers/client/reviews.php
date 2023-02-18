<?php 

	$error = "";
	$success = "";

	/*
		Добавление нового отзыва
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_review'])){
		$text = $_POST['text'];
		$id_user = $_SESSION['id'];

		if($text === ""){
			$error = "Вы не написали отзыв!";
		}
		else{
			$params = [
				"id_user" => $id_user,
				"text" => $text
			];
			Insert("review", $params);
			$success = "1";
		}
	}

	/*
		Пагинация и вывод отзывов
	*/

	$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
	if($page == "" || !is_numeric($page)) { header("Location: /saycheese/pages/general/error404.php"); }
	$limit = 12;
	$offset = $limit * ($page - 1);
	$max_page = ceil(count(Select("review")) / $limit);

	$reviews = SelectReviewsAndClients("review", "user", "client", $limit, $offset);

	if($page < 0 || $page > $max_page || $page == "" || !is_numeric($page)) { 
		//header("Location: ?name_filter=$name_filter&type_filter=$type_filter&page=1");
		header("Location: /saycheese/pages/general/error404.php");
	};

?>