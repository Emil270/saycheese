<?php

session_start();
require '../../app/include/querys.php';
require '../../app/controllers/general/user_login_check.php';
require '../../app/controllers/general/edit_profile.php';

?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Say Cheese - Редактировать профиль</title>
	<link rel="icon" href="/saycheese/saycheese.ico">
	<link rel="stylesheet" href="/saycheese/assets/styles/general/profile/edit_profile.css">
	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
</head>

<body>

	<!-- Подключение разметки навигационной панели -->

	<?php if($_SESSION['role'] == "Клиент"): ?>
		<?php require '../include/nav.php' ?>
	<?php elseif($_SESSION['role'] == "Модератор" || $_SESSION['role'] == "Администратор"): ?>
		<?php require '../include/nav_am.php' ?>
	<?php endif; ?>

	<!-- Подключение разметки блока с сообщением об ошибки -->

	<?php if ($error !== "") : ?>
		<?php require '../include/message_error.php' ?>
		<?php $error = ""; ?>
	<?php endif; ?>

	<!-- Получение разметки блока с сообщением о статусе операции -->

	<?php require '../include/message.php' ?>

	<!-- Проверка успешности операции (вывод сообщения об успехе) -->

	<?php if($success !== ""): ?>
		<script>
			$('.message-block').fadeOut(0);
			$('.message-block').css('display', 'flex');
			$('.message').text("Успешно!");
			$('.message-block').delay(800).fadeOut();
		</script>
		<?php $success = ""; ?>
	<?php endif; ?>

	<!-- Окно для выбора изображения -->

	<div class="select-img-wrapper">
		<div class="select-img-block">
			<p class="btn-close-input-file">×</p>
			<div class="select-img-headline-block">
				<h2 class="select-img-headline">Выберите изображение</h2>
			</div>
			<form method="post" class="form-select-img" action="edit_profile.php" enctype="multipart/form-data">
				<label class="input-file">
					<input type="file" accept=".jpg,.jpeg,.png" name="avatar">
					<span>Выберите файл</span>
				</label>
				<button type="submit" name="edit_avatar" class="btn_edit">
					<p class="btn-text">Изменить аватар</p>
				</button>
			</form>
		</div>
	</div>

	<!-- Основной контент -->

	<main class="edit-profile-content">
		<div class="edit-profile-wrapper">
			<div class="edit-profile-headline-block">
				<h1 class="edit-profile-headline">Редактировать профиль</h1>
			</div>
			<div class="edit-profile-card-block">
				<div class="profile-avatar-block">
					<div class="profile-avatar-wrapper">
						<?php if ($_SESSION['avatar'] == "") : ?>
							<div class="profile-avatar" style="background-image:url(/saycheese/assets/images/avatars/no_avatar.png);"></div>
						<?php else : ?>
							<div class="profile-avatar" style="background-image:url(/saycheese/assets/images/avatars/<?= $_SESSION['avatar'] ?>);"></div>
						<?php endif; ?>
					</div>
					<div class="btns-edit-avatar-block">
						<a class="btn-link">
							<button class="btn_edit_avatar">
								<p class="btn-text">Изменить аватар</p>
							</button>
						</a>
						<form class="btn-link" method="post" action="edit_profile.php">
							<button type="submit" name="del_avatar" class="btn_delete_avatar">
								<p class="btn-text">Удалить аватар</p>
							</button>
						</form>
					</div>
				</div>
				<div class="edit-profile-forms">
					<div class="edit-profile-forms-wrapper">
						<div class="edit-fullname-block">
							<div class="edit-form-headline-block">
								<h2 class="edit-form-headline">Изменить имя и фамилию</h2>
							</div>
							<form class="edit-form" id="edit_fullname" method="post" action="edit_profile.php">
								<input class="input-edit" type="text" name="name" value="<?= $_SESSION['name'] ?>" placeholder="Имя">
								<br><input class="input-edit" type="text" name="surname" value="<?= $_SESSION['surname'] ?>" placeholder="Фамилия">
								<button class="btn_edit" name="edit_fullname" type="submit">
									<p class="btn-text">Сохранить</p>
								</button>
							</form>
						</div>
						<div class="edit-email-block">
							<div class="edit-form-headline-block">
								<h2 class="edit-form-headline">Изменить электронную почту</h2>
							</div>
							<form class="edit-form" id="edit_email" method="post" action="edit_profile.php">
								<input class="input-edit" type="text" name="email" value="<?= $_SESSION['email'] ?>" placeholder="Эл. почта">
								<br><input class="input-edit" type="password" name="pass" value="" placeholder="Пароль для подтверждения">
								<button class="btn_edit" name="edit_email" type="submit">
									<p class="btn-text">Сохранить</p>
								</button>
							</form>
						</div>
						<div class="edit-password-block">
							<div class="edit-form-headline-block">
								<h2 class="edit-form-headline">Изменить пароль</h2>
							</div>
							<form class="edit-form" id="edit_pass" method="post" action="edit_profile.php">
								<input class="input-edit" type="password" name="new_pass" value="" placeholder="Новый пароль">
								<br><input class="input-edit" type="password" name="old_pass" value="" placeholder="Текущий пароль">
								<button class="btn_edit" name="edit_pass" type="submit">
									<p class="btn-text">Сохранить</p>
								</button>
							</form>
						</div>				
					</div>
				</div>
			</div>
		</div>
	</main>

	<!-- Подключение разметки навигационной панели -->

	<?php if($_SESSION['role'] == "Клиент"): ?>
		<?php require '../include/footer.php' ?>
	<?php elseif($_SESSION['role'] == "Модератор" || $_SESSION['role'] == "Администратор"): ?>
		<?php require '../include/footer_am.php' ?>
	<?php endif; ?>

	<script src="/saycheese/assets/scripts/close_error.js" defer></script>
	<script src="/saycheese/assets/scripts/open_nav.js" defer></script>
	<script src="/saycheese/assets/scripts/input_file.js" defer></script>

</body>

</html>