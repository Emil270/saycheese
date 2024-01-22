<?php

session_start();
require '../../app/include/querys.php';
if($_SESSION['role'] == "Клиент"){
require '../../app/controllers/general/user_login_check.php';
}
if($_SESSION['role'] == ""){
	header("Location: /saycheese/pages/general/login.php");
}
if($_SESSION['role'] != "Клиент" && $_SESSION['role'] != ""){
	require '../../app/controllers/general/staff_login_check.php';
}

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
</head>

<body>

	<!-- Подключение разметки навигационной панели -->

	<?php if($_SESSION['role'] == "Клиент"): ?>
		<?php require '../include/nav.php' ?>
	<?php elseif($_SESSION['role'] == "Модератор" || $_SESSION['role'] == "Администратор"): ?>
		<?php require '../include/nav_am.php' ?>
	<?php elseif($_SESSION['role'] == "Фотограф" || $_SESSION['role'] == "Специалист по обработке фотографий"): ?>
		<?php require '../include/nav_s.php' ?>
	<?php endif; ?> 

	<!-- Подключение разметки блока с сообщением об ошибки -->

	<?php require '../include/message_error.php' ?>

	<!-- Получение разметки блока с сообщением о статусе операции -->

	<?php require '../include/message.php' ?>

	<!-- Окно для выбора изображения -->

	<div class="select-img-wrapper">
		<div class="select-img-block">
			<p class="btn-close-input-file">×</p>
			<div class="select-img-headline-block">
				<h2 class="select-img-headline">Выберите изображение</h2>
			</div>

			<form method="post" id="edit_avatar" class="form-select-img" enctype="multipart/form-data" onsubmit="return false">
				<input type="hidden" name="edit-avatar">
				<label class="input-file">
					<input type="file" accept=".jpg,.jpeg,.png" name="avatar">
					<span>Выберите файл</span>
				</label>
				<button type="submit" class="btn_edit">
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
						<form class="btn-link" method="post" onsubmit="return false" id="delete_avatar">
						<input type="hidden" name="delete-avatar">
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
							<form class="edit-form" id="edit_fullname" method="post" onsubmit="return false">
								<input class="input-edit" type="text" name="name" value="<?= $_SESSION['name'] ?>" placeholder="Имя">
								<br><input class="input-edit" type="text" name="surname" value="<?= $_SESSION['surname'] ?>" placeholder="Фамилия">
								<input type="hidden" name="edit-fullname">
								<button class="btn_edit" name="edit_fullname" type="submit">
									<p class="btn-text">Сохранить</p>
								</button>
							</form>
						</div>

						<div class="edit-email-block">
							<div class="edit-form-headline-block">
								<h2 class="edit-form-headline">Изменить электронную почту</h2>
							</div>
							<form class="edit-form" id="edit_email" method="post" onsubmit="return false">
								<input class="input-edit" type="text" name="email" value="<?= $_SESSION['email'] ?>" placeholder="Эл. почта">
								<br><input class="input-edit" type="password" name="pass" value="" placeholder="Пароль для подтверждения">
								<input type="hidden" name="edit-email">
								<button class="btn_edit" name="edit_email" type="submit">
									<p class="btn-text">Сохранить</p>
								</button>
							</form>
						</div>

						<div class="edit-phone-block">
							<div class="edit-form-headline-block">
								<h2 class="edit-form-headline">Изменить номер телефона</h2>
							</div>
							<form class="edit-form" id="edit_phone" method="post" onsubmit="return false">
								<input class="input-edit" type="text" name="phone" value="<?= $_SESSION['phone'] ?>" placeholder="Номер телефона">
								<br><input class="input-edit" type="password" name="pass" value="" placeholder="Пароль для подтверждения">
								<input type="hidden" name="edit-phone">
								<button class="btn_edit" name="edit_phone" type="submit">
									<p class="btn-text">Сохранить</p>
								</button>
							</form>
						</div>

						<div class="edit-password-block">
							<div class="edit-form-headline-block">
								<h2 class="edit-form-headline">Изменить пароль</h2>
							</div>
							<form class="edit-form" id="edit_pass" method="post" onsubmit="return false">
								<input class="input-edit" type="password" name="new_pass" value="" placeholder="Новый пароль">
								<br><input class="input-edit" type="password" name="old_pass" value="" placeholder="Текущий пароль">
								<input type="hidden" name="edit-pass">
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
	<?php elseif($_SESSION['role'] == "Фотограф" || $_SESSION['role'] == "Специалист по обработке фотографий"): ?>
		<?php require '../include/footer_s.php' ?>
	<?php endif; ?>

	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	<script src="/saycheese/assets/scripts/close_error.js"></script>
	<script src="/saycheese/assets/scripts/open_nav.js"></script>
	<script src="/saycheese/assets/scripts/input_file.js"></script>
	<script src="/saycheese/assets/scripts/ajax/edit_profile.js"></script>

</body>

</html>