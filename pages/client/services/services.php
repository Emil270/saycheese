<?php
session_start();
require '../../../app/include/querys.php';
require '../../../app/controllers/general/user_login_check.php';
$dateNow = date("Y-m-d");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Say Cheese - Услуги</title>
	<link rel="icon" href="/saycheese/saycheese.ico">
	<link rel="stylesheet" href="/saycheese/assets/styles/client/services/services.css">
</head>

<body>

	<!-- Подключение разметки навигационной панели -->

	<?php require '../../include/nav.php'; ?> 

	<!-- Получение разметки блока с сообщением о статусе операции -->

	<?php require '../../include/message.php' ?>

	<!-- Подключение разметки блока с ошибкой -->

	<?php require '../../include/message_error.php' ?>

	<main class="services-content">
		<div class="photographer-service-img-block">
			<div class="photographer-service-img-text-block">
				<p class="photographer-service-text1">Нужен хороший фотограф?</p>
				<p class="photographer-service-text2">Заполни форму и мы перезвоним вам <br>в течении 10 минут</p>
			</div>
		</div>
		<div class="photographer-service-form-wrapper">
			<div class="photographer-service-form-block">
				<form method="POST" onsubmit="return false" class="photographer-service-form">
					<div class="photographer-service-input-wrapper"> 
						<div class="photographer-service-input-block">
							<input required="" type="text" name="date" min="<?=$dateNow?>" class="service-input service-input-date" placeholder="Дата" onfocus="(this.type='date')">
							<br><input required="" type="text" name="time_start" min="06:00:00" max="22:00:00" class="service-input service-input-time" placeholder="Время начала" onfocus="(this.type='time')">
							<br><input required="" type="text" name="time_end" min="06:00:00" max="22:00:00" class="service-input service-input-time" placeholder="Время окончания" onfocus="(this.type='time')">
							<br><input type="text" name="place" class="service-input service-input-place" placeholder="Место проведения фотосъемки">
							<br><select class="photographer-style" name="style">
								<option value="null">Выберите стилистику</option>
								<option value="question">Обсужу с фотографом</option>
								<option value="portrait">Портретная фотография</option> 
								<option value="lifestyle">Фотосессия в стиле Lifestyle</option>
								<option value="lovestory">Фотосессия в стиле Love Story</option>
								<option value="fashion">Фотосессия в стиле Fashion</option>
								<option value="retro">Фотосессия в ретро стиле</option>
								<option value="glamour">Фотосессия в стиле гламур</option>
								<option value="art">Арт фотосессия</option>
								<option value="wedding">Свадебная фотосессия</option>
								<option value="country">Фотосессия в стиле кантри</option>
								<option value="fantasy">Фотосессия в стиле фэнтези</option>
							</select>
							<input type="hidden" name="photographer">
						</div>
					</div>
					<?php if(isset($_COOKIE['user_login'])): ?>
						<button type="submit" class="photographer-servie-btn-send">
							<p class="btn-text">Отправить</p>
						</button>
					<?php else: ?>
						<div class="no-login">
							<p class="btn-text">Отправить</p>
						</div>
					<?php endif; ?>
				</form> 
			</div>
		</div>
		<div class="photoshop-service-img-block">
			<div class="photoshop-service-img-text-block">
				<p class="photoshop-service-text1">Нужна качественная обработка фото?</p>
				<p class="photoshop-service-text2">Заполни форму и мы перезвоним вам <br>в течении 10 минут</p>
			</div>
		</div>
		<div class="photoshop-service-form-wrapper">
			<div class="photoshop-service-form-block">
				<form method="POST" onsubmit="return false" class="photoshop-service-form">
					<div class="photoshop-service-input-wrapper">
						<div class="photoshop-service-input-block">
							<select class="photoshop-style" name="style">
								<option value="null">Выберите стилистику</option>
								<option value="retouch">Ретушь</option>
								<option value="background-replace">Замена фона</option>
								<option value="remove-objects">Удаление объектов</option>
								<option value="collages">Коллажи</option>
								<option value="art">Художественная обработка</option>
								<option value="restoration">Реставрация</option>
							</select>
							<br><input type="text" name="description" class="service-input service-input-description" placeholder="Описание работы">
							<br><label class="input-file">
								<input type="file" name="images" accept=".jpg,.jpeg,.png" multiple>
								<span>Выберите фотографии</span>
							</label>
							<input type="hidden" name="photoshop">
						</div>
					</div>
					<?php if(isset($_COOKIE['user_login'])): ?>
						<button type="submit" class="photoshop-servie-btn-send">
							<p class="btn-text">Отправить</p>
						</button>
					<?php else: ?>
						<div class="no-login">
							<p class="btn-text">Отправить</p>
						</div>
					<?php endif; ?>
				</form>
			</div>
		</div>
	</main>

	<!-- Подключение разметки футера -->

	<?php require '../../include/footer.php' ?>


	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	<script src="/saycheese/assets/scripts/open_nav.js" defer></script>
	<script src="/saycheese/assets/scripts/close_error.js" defer></script>
	<script src="/saycheese/assets/scripts/ajax/create_request_to_service.js" defer></script>
	<script src="/saycheese/assets/scripts/no-login-btn.js" defer></script>

</body>

</html>