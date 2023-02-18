<?php 

	$error = "";
	$success = "";

	/*
		Удаление товара
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['del_product'])){
		$id_product = $_POST['del_product'];
		$check_product = Select("product", ["id" => ["=", $id_product]]);
		$id_chatact = $check_product[0]['id_charact'];
		unlink(SITE_ROOT . "/saycheese/assets/images/catalog/" . $check_product[0]['photo']);
		Delete("product", ["id" => ["=", $id_product]]);
		Delete("charact_product", ["id" => ["=", $id_chatact]]);
		$success = "1";
	}

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
		$max_product = Select("product", ['name' => ['LIKE', "%$name_filter%"]]);
		$max_page = ceil(count($max_product) / $limit);
		if($max_page == 0) { $max_page = 1; };
		$product = Select("product", ['name' => ['LIKE', "%$name_filter%"]], $limit, $offset, "id");
	}
	else{
		$max_product = SelectProductsWithFilterAndPagination("product", "charact_product", ['id_type' => ['=', $type_filter], 'name' => ['LIKE', "%$name_filter%"]]);
		$max_page = ceil(count($max_product) / $limit);
		if($max_page == 0) { $max_page = 1; };
		$product = SelectProductsWithFilterAndPagination("product", "charact_product", ['id_type' => ['=', $type_filter], 'name' => ['LIKE', "%$name_filter%"]], $limit, $offset, "id");
	}

	if(empty($product)){
		$error = "Нет ни одного товара";
	}

	// Выборка информации для страницы с один товаром //

	if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_product'])){
		$id_product = isset($_GET['id_product']) ?	$_GET['id_product'] : 0;
		if($id_product == 0 || $id_product == "" || !is_numeric($id_product)){
			header("Location: ../../general/error404.php");
			exit();
		}
		$selected_product = SelectAllInfoAboutProduct("product", "charact_product", "type", $id_product);
		if(empty($selected_product)){
			header("Location: ../../general/error404.php");
			exit();
		}
	}

?>