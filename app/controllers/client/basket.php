<?php 

	session_start();
	require '../../include/querys.php';
	$id_user = $_SESSION['id'];

	/*
		Добавление товара в корзину 
	*/

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_product'])) {

		$response = array();

		if (!isset($_COOKIE['user_login'])){
			$response = ["status" => "Ошибка авторизации"]; 
			echo json_encode($response);
			exit();
		}

		$id_product = $_POST['id_product'];
		$product = Select("product", ["id" => ["=", $id_product]]);

		$basket = Select("basket", ["id_user" => ["=", $id_user], "id_product" => ["=", $id_product]]);
		if ($product[0]['count'] == 0) {
			$response = ["status" => "Ошибка"]; 
			echo json_encode($response);
			exit();
		} 
		else {
			if (empty($basket)) {
				Insert("basket", ["id_user" => $id_user, "id_product" => $id_product, "count" => 1]);
				$response = ["status" => "+ 1 товар в корзине :)"];
				echo json_encode($response);
				exit();
			} 
			else {
				$count = $basket[0]['count'] + 1;
				if ($product[0]['count'] >= $count) {
					$id_basket = $basket[0]['id'];
					Update("basket", ["count" => $count], ["id" => ["=", $id_basket]]);
					$response = ["status" => "+ 1 товар в корзине :)"];
					echo json_encode($response);
					exit();
				} 
				else {
					$response = ["status" => "Ошибка"];
					echo json_encode($response);
					exit();
				}
			}
		}

	}

	/*
		Добавление единицы существующего товара в корзину (+1 к количеству) 
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_basket_add'])){

		$id_basket = $_POST['id_basket_add'];
		$basket = Select("basket", ["id" => ["=", $id_basket]]);
		$count = $basket[0]['count'] + 1;
		$product = Select("product", ["id" => ["=", $basket[0]['id_product']]]);
		if($product[0]['count'] >= $count){
			Update("basket", ["count" => $count],  ["id" => ["=", $id_basket]]);
			$response = ["success" => "Успешно"];
			echo json_encode($response);
		}
		else{
			$response = ["success" => "Ошибка"];
			echo json_encode($response);
		}

	}

	/*
		Удаление единицы существующего товара из корзину (-1 от количества) 
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_basket_remove'])){
		
		$id_basket = $_POST['id_basket_remove'];
		$basket = Select("basket", ["id" => ["=", $id_basket]]);
		$count = $basket[0]['count'] - 1;
		if($count == 0){
			Delete("basket", ["id" => ["=", $id_basket]]);
		}
		else{
			Update("basket", ["count" => $count],  ["id" => ["=", $id_basket]]);
		}
		$response = ["success" => "Успешно"];
		echo json_encode($response);

	}

	/*
		Удаление всех товаров из корзины конкретного клиента
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['del_all_basket'])){
		Delete("basket", ["id_user" => ["=", $id_user]]);
		$response = ["success" => "Успешно"];
		echo json_encode($response);
	}

?>