<?php 

	session_start();
	require '../../../app/include/querys.php';

	/*
		Добавление нового товара
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add-product'])){

		$response = array();

		$name = $_POST['name'];
		$description = $_POST['description'];
		$price = $_POST['price'];
		$count = $_POST['count'];
		$type = $_POST['type'];
		$num_megapix = $_POST['num_megapix'];
		$max_resolution = $_POST['max_resolution'];
		$shooting_video = $_POST['shooting_video'];
		$sensitivity = $_POST['sensitivity'];
		$excerpt = $_POST['excerpt'];
		$focusing = $_POST['focusing'];
		$shooting_mode = $_POST['shooting_mode'];
		$screen = $_POST['screen'];
		$security = $_POST['security'];
		$interfaces = $_POST['interfaces'];
		$battary_capacity = $_POST['battary_capacity'];

		if($name === "" || $description === "" || $price === "" || $count === "" || $type === "" || $num_megapix === "" ||
		$max_resolution === "" || $shooting_video === "" || $sensitivity === "" || $excerpt === "" || $focusing === "" || $shooting_mode === "" ||
		$screen === "" || $security === "" || $interfaces === "" || $battary_capacity === ""){
			$response['status'] = "0";
			$response['error'] = "Вы ввели не все данные";
			echo json_encode($response);
			exit();
		}
		if($price < 0 || $price == 0){
			$response['status'] = "0";
			$response['error'] = "Вы некорректно ввели цену товара";
			echo json_encode($response);
			exit();
		}
		if($count < 0){
			$response['status'] = "0";
			$response['error'] = "Вы некорректно ввели количество товара";
			echo json_encode($response);
			exit();
		}
		if($count < 0){
			$response['status'] = "0";
			$response['error'] = "Вы некорректно ввели количество товара";
			echo json_encode($response);
			exit();
		}
		if($num_megapix < 0 || $num_megapix == 0){
			$response['status'] = "0";
			$response['error'] = "Вы некорректно ввели число мегапикселей";
			echo json_encode($response);
			exit();
		}
		if($battary_capacity < 0 || $battary_capacity == 0){
			$response['status'] = "0";
			$response['error'] = "Вы некорректно ввели емкость аккумулятора";
			echo json_encode($response);
			exit();
		}

		foreach($_FILES as $image){
			$imgName = time() . "_" . $image['name'];
			$tmpFileName = $image['tmp_name'];
		}
	
		if(empty($imgName)){
			$response['status'] = "0";
			$response['error'] = "Ошибка получения изображения";
			echo json_encode($response);
			exit();
		}				

		$photo = $imgName;
		$path = SITE_ROOT . "/saycheese/assets/images/catalog/" . $imgName;
		$result = move_uploaded_file($tmpFileName, $path);

		if(!$result){
			$response['status'] = "0";
			$response['error'] = "Вы не выбрали фотографию";
			echo json_encode($response);
			exit();
		}

		$params = [
			"id_type" => $type,
			"num_megapix" => $num_megapix,
			"max_resolution" => $max_resolution,
			"shooting_video" => $shooting_video,
			"sensitivity" => $sensitivity,
			"excerpt" => $excerpt,
			"focusing" => $focusing,
			"shooting_mode" => $shooting_mode,
			"screen" => $screen,
			"security" => $security,
			"interfaces" => $interfaces,
			"battary_capacity" => $battary_capacity
		];
		$id_charact = Insert("charact_product", $params);
		$params = [
			"id_charact" => $id_charact,
			"name" => $name,
			"description" => $description,
			"price" => $price,
			"count" => $count,
			"photo" => $photo
		];
		Insert("product", $params);
		$response['status'] = "1";
		echo json_encode($response);
		exit();
	}

	/*
		Изменение информации о товаре
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit-product'])){

		$response = array();

		$id_product_to_edit = $_POST['id_product_to_edit'];
		$name = $_POST['name'];
		$description = $_POST['description'];
		$price = $_POST['price'];
		$count = $_POST['count'];
		$type = $_POST['type'];
		$num_megapix = $_POST['num_megapix'];
		$max_resolution = $_POST['max_resolution'];
		$shooting_video = $_POST['shooting_video'];
		$sensitivity = $_POST['sensitivity'];
		$excerpt = $_POST['excerpt'];
		$focusing = $_POST['focusing'];
		$shooting_mode = $_POST['shooting_mode'];
		$screen = $_POST['screen'];
		$security = $_POST['security'];
		$interfaces = $_POST['interfaces'];
		$battary_capacity = $_POST['battary_capacity'];

		if($name === "" || $description === "" || $price === "" || $count === "" || $type === "" || $num_megapix === "" ||
		$max_resolution === "" || $shooting_video === "" || $sensitivity === "" || $excerpt === "" || $focusing === "" || $shooting_mode === "" ||
		$screen === "" || $security === "" || $interfaces === "" || $battary_capacity === ""){
			$response['status'] = "0";
			$response['error'] = "Вы ввели не все данные";
			echo json_encode($response);
			exit();
		}
		if($price < 0 || $price == 0){
			$response['status'] = "0";
			$response['error'] = "Вы некорректно ввели цену товара";
			echo json_encode($response);
			exit();
		}
		if($count < 0){
			$response['status'] = "0";
			$response['error'] = "Вы некорректно ввели количество товара";
			echo json_encode($response);
			exit();
		}
		if($count < 0){
			$response['status'] = "0";
			$response['error'] = "Вы некорректно ввели количество товара";
			echo json_encode($response);
			exit();
		}
		if($num_megapix < 0 || $num_megapix == 0){
			$response['status'] = "0";
			$response['error'] = "Вы некорректно ввели число мегапикселей";
			echo json_encode($response);
			exit();
		}
		if($battary_capacity < 0 || $battary_capacity == 0){
			$response['status'] = "0";
			$response['error'] = "Вы некорректно ввели емкость аккумулятора";
			echo json_encode($response);
			exit();
		}

		$imgName = "";
		$tmpFileName = "";

		foreach($_FILES as $image){
			$imgName = $image['name'];
			$tmpFileName = $image['tmp_name'];
		}
	
		if(empty($imgName)){
			$product_to_edit = Select("product", ["id" => ["=", $id_product_to_edit]]);
			$id_charact_to_edit = $product_to_edit[0]['id_charact'];
			$params1 = [
				"id_type" => $type,
				"num_megapix" => $num_megapix,
				"max_resolution" => $max_resolution,
				"shooting_video" => $shooting_video,
				"sensitivity" => $sensitivity,
				"excerpt" => $excerpt,
				"focusing" => $focusing,
				"shooting_mode" => $shooting_mode,
				"screen" => $screen,
				"security" => $security,
				"interfaces" => $interfaces,
				"battary_capacity" => $battary_capacity
			];
			Update("charact_product", $params1, ["id" => ["=", $id_charact_to_edit]]);
			$params1 = [
				"name" => $name,
				"description" => $description,
				"price" => $price,
				"count" => $count
			];
			Update("product", $params1, ["id" => ["=", $id_product_to_edit]]);
			$response['status'] = "1";
			echo json_encode($response);
			exit();
		}

		$photo = time() . "_" . $imgName;				
		$path = SITE_ROOT . "/saycheese/assets/images/catalog/" . $photo;
		$result = move_uploaded_file($tmpFileName, $path);
		if($result){
			$product_to_edit = Select("product", ["id" => ["=", $id_product_to_edit]]);
			$id_charact_to_edit = $product_to_edit[0]['id_charact'];
			$params1 = [
				"id_type" => $type,
				"num_megapix" => $num_megapix,
				"max_resolution" => $max_resolution,
				"shooting_video" => $shooting_video,
				"sensitivity" => $sensitivity,
				"excerpt" => $excerpt,
				"focusing" => $focusing,
				"shooting_mode" => $shooting_mode,
				"screen" => $screen,
				"security" => $security,
				"interfaces" => $interfaces,
				"battary_capacity" => $battary_capacity
			];
			Update("charact_product", $params1, ["id" => ["=", $id_charact_to_edit]]);
			unlink(SITE_ROOT . "/saycheese/assets/images/catalog/" . $product_to_edit[0]['photo']);
			$params1 = [
				"name" => $name,
				"description" => $description,
				"price" => $price,
				"count" => $count,
				"photo" => $photo
			];
			Update("product", $params1, ["id" => ["=", $id_product_to_edit]]);
			$response['status'] = "1";
			echo json_encode($response);
			exit();
		}
		else{
			$response['status'] = "0";
			$response['error'] = "Вы не выбрали фотографию";
			echo json_encode($response);
			exit();
		}
	}

?>