<?php 

	// Выход из аккаунта //

	session_start();
	unset($_SESSION['id']);
	unset($_SESSION['name']);
	unset($_SESSION['surname']);
	unset($_SESSION['avatar']);
	unset($_SESSION['email']);
	unset($_SESSION['role']);
	setcookie('user_login', '', -1, '/');

	header("Location: /saycheese/");

?>