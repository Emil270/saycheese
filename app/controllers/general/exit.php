<?php 

	// Выход из аккаунта //

	session_start();
	$_SESSION['id'] = "";
	$_SESSION['name'] = "";
	$_SESSION['surname'] = "";
	$_SESSION['avatar'] = "";
	$_SESSION['email'] = "";
	$_SESSION['phone'] = "";
	$_SESSION['role'] = ""; 
	unset($_SESSION['id']);
	unset($_SESSION['name']);
	unset($_SESSION['surname']);
	unset($_SESSION['avatar']);
	unset($_SESSION['email']);
	unset($_SESSION['phone']);
	unset($_SESSION['role']);
	unset($_COOKIE['user_login']); 
	setcookie('user_login', null, -1, '/');
	unset($_COOKIE['staff_login']); 
	setcookie('staff_login', null, -1, '/');

	header("Location: /saycheese/");

?>