<?php 

	$error = "";
	$success = "";
	$name = "";
	$description = "";
	$price = "";
	$count = "";
	$type = "";
	$num_megapix = "";
	$max_resolution = "";
	$shooting_video = "";
	$sensitivity = "";
	$excerpt = "";
	$focusing = "";
	$shooting_mode = "";
	$screen = "";
	$security = "";
	$interfaces = "";
	$battary_capacity = "";

	/*
		Добавление нового товара
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])){
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
			$error = "Вы ввели не все данные";
		}
		else{
			if($price < 0 || $price == 0){
				$error = "Вы некорректно ввели цену товара";
			}
			else{
				if($count < 0){
					$error = "Вы некорректно ввели количество товара";
				}
				else{
					if($num_megapix < 0 || $num_megapix == 0){
						$error = "Вы некорректно ввели число мегапикселей";
					}
					else{
						if($battary_capacity < 0 || $battary_capacity == 0){
							$error = "Вы некорректно ввели емкость аккумулятора";
						}
						else{
							if(!empty($_FILES['photo']['name'])){
								$imgName = time() . "_" . $_FILES['photo']['name'];
								$tmpFileName = $_FILES['photo']['tmp_name'];
								$photo = $imgName;
								$path = SITE_ROOT . "/saycheese/assets/images/catalog/" . $imgName;
								$result = move_uploaded_file($tmpFileName, $path);
								if($result){
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
									$success = "1";
								}
								else{
									$error = "Ошибка загрузки изображения на сервер";
								}
							}
							else{
								$error = "Ошибка получения изображения";
							}
						}
					}
				}
			}
		}
	}

	/*
		Получение информации об изменяемом товаре
	*/

	if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_product_to_edit'])){
		$id_product_to_edit = $_GET['id_product_to_edit'];
		if(!is_numeric($id_product_to_edit) || $id_product_to_edit < 0 || $id_product_to_edit == ""){
			header("Location: /saycheese/pages/general/error404.php");
			exit();
		}
		$product_to_edit = Select("product", ["id" => ["=", $id_product_to_edit]]);
		if(empty($product_to_edit)){
			header("Location: /saycheese/pages/general/error404.php");
			exit();
		}
		$id_charact_to_edit = $product_to_edit[0]['id_charact'];
		$charact_to_edit = Select("charact_product", ["id" => ["=", $id_charact_to_edit]]);
		$name = $product_to_edit[0]['name'];
		$description = $product_to_edit[0]['description'];
		$price = $product_to_edit[0]['price'];
		$count = $product_to_edit[0]['count'];
		$type = $charact_to_edit[0]['id_type'];
		$num_megapix = $charact_to_edit[0]['num_megapix'];
		$max_resolution = $charact_to_edit[0]['max_resolution'];
		$shooting_video = $charact_to_edit[0]['shooting_video'];
		$sensitivity = $charact_to_edit[0]['sensitivity'];
		$excerpt = $charact_to_edit[0]['excerpt'];
		$focusing = $charact_to_edit[0]['focusing'];
		$shooting_mode = $charact_to_edit[0]['shooting_mode'];
		$screen = $charact_to_edit[0]['screen'];
		$security = $charact_to_edit[0]['security'];
		$interfaces = $charact_to_edit[0]['interfaces'];
		$battary_capacity = $charact_to_edit[0]['battary_capacity'];
	}

	/*
		Изменение информации о товаре
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_product'])){
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
			$error = "Вы ввели не все данные";
		}
		else{
			if($price < 0 || $price == 0){
				$error = "Вы некорректно ввели цену товара";
			}
			else{
				if($count < 0){
					$error = "Вы некорректно ввели количество товара";
				}
				else{
					if($num_megapix < 0 || $num_megapix == 0){
						$error = "Вы некорректно ввели число мегапикселей";
					}
					else{
						if($battary_capacity < 0 || $battary_capacity == 0){
							$error = "Вы некорректно ввели емкость аккумулятора";
						}
						else{							
							if(empty($_FILES['photo']['name'])){
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
								$success = "1";
							}
							else{
								$imgName = time() . "_" . $_FILES['photo']['name'];
								$tmpFileName = $_FILES['photo']['tmp_name'];
								$photo = $imgName;
								$path = SITE_ROOT . "/saycheese/assets/images/catalog/" . $imgName;
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
									$success = "1";
								}
								else{
									$error = "Ошибка загрузки изображения на сервер";
								}
							}
						}
					}
				}
			}
		}
	}

?>