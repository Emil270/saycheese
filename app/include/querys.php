<?php

	require 'connection.php';
	require 'path.php';

	/*
		Отладочная функция
	*/

	function test($data){
		echo '<pre>';
		print_r($data);
		echo '<pre>';
		exit();
	}

	/*
		Функция для преобразования массива типа [ key(столбец таблицы) => [ key(знак, напр. = или >) => value(значение) ] ] в SQL-условие WHERE ...
	*/

	function GetSqlWhere($params){
		$sql = "";
		$i = 0;
		foreach ($params as $column => $operation) {			
			if ($i === 0) {
				$j = 0;
				foreach($operation as $key => $value) {
					if($j === 0){
						$sql = $sql . " WHERE $column $value";
					}
					else{
						if (!is_numeric($value) && $value != "NULL") {
							$value = "'" . $value . "'";
						}
						if(is_null($value)){
							$value = "NULL";
						}
						$sql = $sql . " $value";
					}
					$j++;
				}
			} 
			else {
				$j = 0;
				foreach($operation as $key => $value) {
					if($j === 0){
						$sql = $sql . " AND $column $value";
					}
					else{
						if (!is_numeric($value) && $value != "NULL") {
							$value = "'" . $value . "'";
						}
						if($value == "NULL"){
							$value = "NULL";
						}
						$sql = $sql . " $value";
						$j = -1;
					}
					$j++;
				}
			}
			$i++;
		}
		return $sql;
	}

	/*
		SQL-запрос SELECT с возможностью многократных выборок WHERE, использования Лимита и Офсета
	*/

	function Select($table, $params = [],  $limit = 0, $offset = 0, $desc = 0, $asc = 0)
	{
		global $connection;
		$sql = "SELECT * FROM $table";

		if (!empty($params)) {
			$sql = $sql . GetSqlWhere($params);
		}
		if($desc !== 0){
			$sql = $sql . " ORDER BY $desc DESC";
		}
		if($asc !== 0){
			$sql = $sql . " ORDER BY $asc";
		}
		if ($limit !== 0) {
			$sql = $sql . " LIMIT $limit";
		}
		if($offset !== 0){
			$sql = $sql . " OFFSET $offset";
		}
		$query = $connection->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}

	/*
		Выборка товаров с условием фильтрации и пагинации
	*/

	function SelectProductsWithFilterAndPagination($table1, $table2, $params, $limit = 0, $offset = 0, $desc = 0){
		global $connection;
		$sql = "SELECT t1.* FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_charact = t2.id";
		$sql = $sql . GetSqlWhere($params);
		if($desc !== 0){
			$sql = $sql . " ORDER BY $desc DESC";
		}
		if ($limit !== 0) {
			$sql = $sql . " LIMIT $limit";
		}
		if($offset !== 0){
			$sql = $sql . " OFFSET $offset";
		}
		$query = $connection->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}

	/*
		Получение всей информации о конкретном товаре
	*/

	function SelectAllInfoAboutProduct($table1, $table2, $table3, $id){
		global $connection;
		$sql = "SELECT p.*, c.id_type, c.num_megapix, c.max_resolution, c.shooting_video, 
		c.sensitivity, c.excerpt, c.focusing, c.shooting_mode, c.screen, c.security, c.interfaces, c.battary_capacity, 
		t.type FROM $table1 AS p JOIN $table2 AS c ON p.id_charact = c.id JOIN $table3 AS t ON c.id_type = t.id WHERE p.id = $id";
		$query = $connection->prepare($sql);
		$query->execute();
		$result = $query->fetch();
		return $result;
	}

	/*
		Получение информации о товарах с корзины конкретного пользователя
	*/

	function SelectProductsFromBasket($table1, $table2, $id_user){
		global $connection;
		$sql = "SELECT b.*, p.name, p.price, p.photo FROM $table1 AS b JOIN $table2 AS p ON b.id_product = p.id WHERE b.id_user = $id_user";
		$query = $connection->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}

	/*
		Выборка товаров конкретного заказа
	*/

	function SelectProductsFromOrder($table1, $table2, $id_order){
		global $connection;
		$sql = "SELECT t1.count, t2.id, t2.name FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_product = t2.id WHERE t1.id_order = $id_order";
		$query = $connection->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}

	/*
		Выборка отзывов с инфорацией о пользователях, оставивших отзывы 
	*/

	function SelectReviewsAndClients($table1, $table2, $table3, $limit = 0, $offset = 0){
		global $connection;
		$sql = "SELECT t1.*, t3.name, t3.surname, t3.avatar FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_user = t2.id JOIN $table3 AS t3 ON t2.id = t3.id_user ORDER BY t1.id DESC";
		if($limit !== 0){
			$sql = $sql . " LIMIT $limit";
		}
		if($offset !== 0){
			$sql = $sql . " OFFSET $offset";
		}
		$query = $connection->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}

	function SelectClientOfOrder($table1, $table2, $id){
		global $connection;
		$sql = "SELECT t2.name, t2.surname, t1.email, t1.phone FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id = t2.id_user WHERE t1.id = $id";
		$query = $connection->prepare($sql);
		$query->execute();
		$result = $query->fetch();
		return $result;
	}

	function SelectAllStaff($table1, $table2, $params = []){
		global $connection;
		$sql = "SELECT t1.id, t1.email, t1.role, t2.name, t2.surname, t2.avatar 
		FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id = t2.id_user";
		if(!empty($params)){
			$sql = $sql . GetSqlWhere($params);
		}
		$sql = $sql . " ORDER BY t2.id DESC";
		$query = $connection->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}

	/*
		SQL-запрос INSERT
	*/

	function Insert($table, $params){
		global $connection;
		$i = 0;
		$columns = "";
		$values = "";
		foreach($params as $key => $value){
			if($i === 0){
				$columns = "$key";
				$values = ":$key";
			}
			else{
				$columns = $columns . ", $key";
				$values = $values . ", :$key";	
			}
			$i++;
		}
		$sql =  "INSERT INTO $table ($columns) VALUES ($values)";
		$query = $connection->prepare($sql);
		$query->execute($params);
		return $connection->lastInsertId(); 
	}

	/*
		SQL-запрос UPDATE
	*/

	function Update($table, $params, $params2){
		global $connection;
		$sql = "UPDATE $table SET ";
		$i = 0;
		foreach($params as $key => $value){
			if(!is_numeric($value)){
				$value = "'" . $value . "'";
			}
			if($i === 0){
				$sql = $sql . "$key = $value";
			}
			else{
				$sql = $sql . ", $key = $value";
			}
			$i++;
		}
		$sql = $sql . GetSqlWhere($params2);
		$query = $connection->prepare($sql);
		$query->execute();
	}

	/*
		SQL-запрос DELETE
	*/

	function Delete($table, $params){
		global $connection;
		$sql = "DELETE FROM $table";
		$sql = $sql . GetSqlWhere($params);
		$query = $connection->prepare($sql);
		$query->execute();
	}

?>
