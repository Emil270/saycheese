<?php 

	/*
		Добавление нового отзыва
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add-review'])){
		session_start();
		require '../../../app/include/querys.php';
		$response = array();

		if (!isset($_COOKIE['user_login'])){
			$response['status'] = "2";
			echo json_encode($response);
			exit();
		}

		$text = $_POST['text'];
		$id_user = $_SESSION['id'];

		if($text === ""){
			$response['status'] = "0";
			$response['error'] = "Вы не написали отзыв!";
			echo json_encode($response);
			exit();
		}
		else{
			$params = [
				"id_user" => $id_user,
				"text" => $text
			];
			Insert("review", $params);
			$response['status'] = "1";
			echo json_encode($response);
			exit();
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