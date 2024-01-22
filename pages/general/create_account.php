<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Say Cheese - Создать аккаунт</title>
	<link rel="icon" href="/saycheese/saycheese.ico">
	<link rel="stylesheet" href="/saycheese/assets/styles/general/log_reg/create_account.css">
</head>

<body>

	<!-- Подключение разметки блока с ошибкой -->

	<?php require '../include/message_error.php' ?>

	<!-- Форма регистрации -->

	<div class="wrapper">
		<div class="form-action">
			<form id="create-account-form" method="post" onsubmit="return false">
				<div class="headline-block">
					<h1 class="headline">Создать аккаунт</h1>
				</div>
				<div class="inputs-block">
					<input type="text" name="name" placeholder="Имя">
					<br><input type="text" name="surname" placeholder="Фамилия">
					<br><input required="" type="email" name="email" placeholder="Эл. почта">
					<br><input type="text" name="phone" placeholder="Номер телефона">
					<br><input type="password" name="pass" placeholder="Пароль">
					<br><input type="hidden" name="create-account">
					<div class="login-block">
						<p class="login">Уже есть акканут? - <a href="login.php"><strong>Войти</strong></a></p>
					</div>
					<br><button type="submit" class="btn-reg" name="btn-reg">Создать</button>
				</div>
			</form>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	<script src="/saycheese/assets/scripts/close_error.js" defer></script>
	<script src="/saycheese/assets/scripts/ajax/create_account.js"></script>

</body>

</html>