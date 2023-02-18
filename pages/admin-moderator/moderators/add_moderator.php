<?php

session_start();
require '../../../app/include/querys.php';
require '../../../app/controllers/general/user_login_check.php';


require '../../../app/controllers/admin-moderator/moderators.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Say Cheese - Добавить модератора</title>
	<link rel="icon" href="/saycheese/saycheese.ico">
	<link rel="stylesheet" href="/saycheese/assets/styles/admin-moderator/moderators/add_moderator.css">
	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
</head>

<body>

	<!-- Подключение разметки навигационной панели -->

	<?php require '../../include/nav_am.php' ?>

	<!-- Получение разметки блока с сообщением об ошибке -->

	<?php if ($error != "") : ?>
		<?php require '../../include/message_error.php' ?>
		<?php $error = ""; ?>
	<?php endif; ?>

	<!-- Получение разметки блока с сообщением о статусе операции -->

	<?php require '../../include/message.php' ?>

	<!-- Проверка успешности операции (вывод сообщения об успехе) -->

	<?php if ($success !== "") : ?>
		<script>
			$('.message-block').fadeOut(0);
			$('.message-block').css('display', 'flex');
			$('.message').text("Успешно!");
			$('.message-block').delay(800).fadeOut();
		</script>
		<?php $success = ""; ?>
	<?php endif; ?>

	<!-- Основной контент -->

	<main class="content">
		<div class="wrapper">
			<div class="headline-block">
				<h1 class="headline">Добавить нового модератора</h1>
			</div>
			<div class="add-moderator-form-block">
				<div class="add-moderator-form-wrapper">
					<form method="post" action="add_moderator.php">
						<input type="text" name="name" value="<?=$name?>" placeholder="Имя">
						<br><input type="text" name="surname" value="<?=$surname?>" placeholder="Фамилия">
						<br><input type="email" name="email" value="<?=$email?>" placeholder="Эл. почта">
						<br><input type="password" name="pass" placeholder="Пароль">
						<button type="submit" name="add_moderator" class="btn_add_moderator">
							<p class="btn-text">Добавить</p>
						</button>
					</form>
				</div>
			</div>
		</div>
	</main>

	<!-- Подключение разметки футера -->

	<?php require '../../include/footer_am.php' ?>

	<script src="/saycheese/assets/scripts/open_nav.js" defer></script>
	<script src="/saycheese/assets/scripts/close_error.js" defer></script>

</body>

</html>