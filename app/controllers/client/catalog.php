<?php 

	$error = "";

	// Обработка фильтрации товаров вместе с пагинацией //

	$name_filter = (isset($_GET['name_filter']))? $_GET['name_filter'] : "";
	$type_filter = (isset($_GET['type_filter']))? $_GET['type_filter'] : "0";
	$page = (isset($_GET['page'])) ? $_GET['page'] : 1;

	if($type_filter == "" || $type_filter < 0 || $type_filter > 3 || !is_numeric($type_filter)) { header("Location: /saycheese/pages/general/error404.php"); }
	if($page == "" || !is_numeric($page)) { header("Location: /saycheese/pages/general/error404.php"); }

	if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['filter'])){
		header("Location: ?name_filter=$name_filter&type_filter=$type_filter&page=1");
	};

	$limit = 16;
	$offset = $limit * ($page - 1);
	$max_page = ceil(count(Select("product")) / $limit);

	if($page < 0 || $page > $max_page || $page == "" || !is_numeric($page)) { 
		//header("Location: ?name_filter=$name_filter&type_filter=$type_filter&page=1");
		header("Location: /saycheese/pages/general/error404.php");
	};

	if($type_filter === '0'){
		$params = [
			'name' => ['LIKE', "%$name_filter%"], 
			"count" => [">", 0]
		];
		$max_product = Select("product", $params);
		$max_page = ceil(count($max_product) / $limit);
		if($max_page == 0) { $max_page = 1; };
		$product = Select("product", $params, $limit, $offset, "id");
	}
	else{
		$params = [
			'id_type' => ['=', $type_filter], 
			'name' => ['LIKE', "%$name_filter%"], 
			'count' => [">", 0]
		];
		$max_product = SelectProductsWithFilterAndPagination("product", "charact_product", $params);
		$max_page = ceil(count($max_product) / $limit);
		if($max_page == 0) { $max_page = 1; };
		$product = SelectProductsWithFilterAndPagination("product", "charact_product", $params, $limit, $offset, "id");
	}

	if(empty($product)){
		$error = "Нет ни одного товара";
	}

	// Выборка информации для страницы с один товаром //

	if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_product'])){
		$id_product = isset($_GET['id_product']) ?	$_GET['id_product'] : 0;
		if($id_product == 0 || $id_product == "" || !is_numeric($id_product)){
			header("Location: /saycheese/pages/general/error404.php");
			exit();
		}
		$selected_product = SelectAllInfoAboutProduct("product", "charact_product", "type", $id_product);
		if(empty($selected_product)){
			header("Location: /saycheese/pages/general/error404.php");
			exit();
		}

	}

?>