<?php

	/* 
		Подключение к базе данных
	*/

	$driver = 'mysql';
	$host = 'localhost';
	$dbname = 'saycheese_db';
	$charset = 'utf8';
	$db_user = 'root';
	$db_pass = '';
	$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
							PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
	try{
		$connection = new PDO("$driver:host=$host;dbname=$dbname;charset=$charset", $db_user, $db_pass, $options);
	}
	catch (PDOException $pdoExc){
		die("Ошибка подключения к базе данных");
	}
	
?>