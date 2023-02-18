<?php require '../../app/controllers/general/user.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Say Cheese - Войти</title>
	<link rel="icon" href="/saycheese/saycheese.ico">
	<link rel="stylesheet" href="/saycheese/assets/styles/general/log_reg/login.css">
</head>

<body>

	<!-- Подключение разметки блока с ошибкой -->

	
	<?php if ($error !== "") : ?>
		<?php require '../include/message_error.php' ?>
		<?php $error = "" ?>
	<?php endif; ?>

	<!-- Форма авторизации -->
	
	<div class="wrapper">
		<div class="form-action">
			<form action="login.php" method="post">
				<div class="headline-block">
					<h1 class="headline">Войти</h1>
				</div>
				<div class="inputs-block">
					<input type="email" value="<?=$email?>" name="email" placeholder="Эл. почта">
					<br><input type="password" name="pass" placeholder="Пароль">
					<div class="create-account-block">
						<p class="create-account">Нет аккаунта? - <a href="create_account.php"><strong>Создать</strong></a></p>
					</div>
					<br><button type="submit" class="btn-log" name="btn-log">Войти</button>
				</div>
			</form>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	<script src="/saycheese/assets/scripts/close_error.js" defer></script>
</body>

</html>