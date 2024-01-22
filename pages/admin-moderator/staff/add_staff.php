<?php

session_start();
require '../../../app/include/querys.php';
require '../../../app/controllers/general/staff_login_check.php';


//require '../../../app/controllers/admin-moderator/moderators.php';

?>

<!DOCTYPE html> 
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Say Cheese - Добавить сотрудника</title>
	<link rel="icon" href="/saycheese/saycheese.ico">
	<link rel="stylesheet" href="/saycheese/assets/styles/admin-moderator/staff/add_staff.css">
</head>

<body>

	<!-- Подключение разметки навигационной панели -->

	<?php require '../../include/nav_am.php' ?>

	<!-- Получение разметки блока с сообщением об ошибке -->

	<?php require '../../include/message_error.php' ?>

	<!-- Получение разметки блока с сообщением о статусе операции -->

	<?php require '../../include/message.php' ?>
 

	<!-- Основной контент -->

	<main class="content">
		<div class="wrapper">
			<div class="headline-block">
				<h1 class="headline">Добавить нового сотрудника</h1>
			</div>
			<div class="add-staff-form-block">
				<div class="add-staff-form-wrapper">
					<form method="post" id="add_staff" onsubmit="return false">
					<input type="hidden" name="add-staff">
						<select name="role">
							<option value="Модератор">Модератор</option>
							<option value="Фотограф">Фотограф</option>
							<option value="Специалист по обработке фотографий">Специалист по обработке фотографий</option>
						</select>
						<br><input type="text" name="name" placeholder="Имя">
						<br><input type="text" name="surname" placeholder="Фамилия">
						<br><input type="email" name="email" placeholder="Эл. почта">
						<br><input type="text" name="phone" placeholder="Номер телефона">
						<br><input type="password" name="pass" placeholder="Пароль">
						<button type="submit" class="btn_add_staff">
							<p class="btn-text">Добавить</p>
						</button>
					</form>
				</div>
			</div>
		</div>
	</main>

	<!-- Подключение разметки футера -->

	<?php require '../../include/footer_am.php' ?>

	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	<script src="/saycheese/assets/scripts/open_nav.js"></script>
	<script src="/saycheese/assets/scripts/close_error.js"></script>
	<script src="/saycheese/assets/scripts/ajax/add_staff.js"></script>

</body>

</html>