<?php 

	function getRndNum(){
		$result = "";
		for($i = 0; $i < 7; $i++){
			$result .=  mt_rand(0, 9);
		}
		return $result;
	}

	/*
	Оформление заказа
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create-order'])){

		session_start();
		require '../../include/querys.php';
		$id_user = $_SESSION['id'];

		$response = array();
		$city = $_POST['city'];
		$street = $_POST['street'];
		$house = $_POST['house'];
		$apartament = $_POST['apartament'];
		$flat = $_POST['flat'];
		$intercom = $_POST['intercom'];
		$index = $_POST['index'];
		$total_price = 0;
		$type_of_pay = $_POST['type_of_pay'];
		if($city === "" || $street === "" || $house === "" || $apartament === "" || $type_of_pay === "" || $flat === "" || $index === ""){
			$response['status'] = "0";
			$response['error'] = "Вы ввели не все данные";
			echo json_encode($response);
			exit();
		}
		elseif($apartament < 0){
			$response['status'] = "0";
			$response['error'] = "Вы некорректно ввели номер квартиры";
			echo json_encode($response);
			exit();
		}
		elseif($flat < 0){
			$response['status'] = "0";
			$response['error'] = "Вы некорректно ввели номер этажа";
			echo json_encode($response);
			exit();
		}
		elseif($apartament < 0 && $flat < 0){
			$response['status'] = "0";
			$response['error'] = "Вы некорректно ввели номер квартиры и этажа";
			echo json_encode($response);
			exit();
		}
		elseif(strlen($index) !== 6){
			$response['status'] = "0";
			$response['error'] = "Вы некорректно ввели почтовый индекс";
			echo json_encode($response);
			exit();
		}
		else{
			$products = SelectProductsFromBasket("basket", "product", $id_user);
			$code = getRndNum();
			for ($i = 0; $i < count($products); $i++) {
				$total_price += $products[$i]['price'] * $products[$i]['count'];
			}
			$params = [
				"code" => $code,
				"id_user" => $id_user,
				"city" => $city,
				"street" => $street,
				"house" => $house,
				"apartament" => $apartament,
				"flat" => $flat,
				"intercom" => $intercom,
				"indexx" => $index,
				"total_price" => $total_price,
				"type_of_pay" => $type_of_pay,
				"status" => "Новый"
			];
			$id_order = Insert("orderr", $params);
			for($i = 0; $i < count($products); $i++){
				Insert("orders_product", ["id_order" => $id_order, "id_product" => $products[$i]['id_product'], "count" => $products[$i]['count']]);
				$product_after_order = Select("product", ["id" => ["=", $products[$i]['id_product']]]);
				$new_count = $product_after_order[0]['count'] - $products[$i]['count'];
				Update("product", ["count" => $new_count], ["id" => ["=", $products[$i]['id_product']]]);
			}
			Delete("basket", ["id_user" => ["=", $id_user]]);
			$response['status'] = "1";
			echo json_encode($response);
			exit();
		}
	}
	
	/*
		Поиск заказа по номеру
	*/

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search_order_by_code'])){
		$code = $_POST['code'];
		$myorders = Select("orderr", ["id_user" => ["=", $id_user], "code" => ["LIKE", $code."%"]], 0, 0, "id");
	}
	else{
		$code = "";
	}

?>