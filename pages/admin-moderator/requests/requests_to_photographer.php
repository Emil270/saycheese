<?php

session_start();
require '../../../app/include/querys.php';
require '../../../app/controllers/general/staff_login_check.php';
require '../../../app/controllers/admin-moderator/requests_to_photographer.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Say Cheese - Заявки на услуги фотографа</title>
	<link rel="icon" href="/saycheese/saycheese.ico">
	<link rel="stylesheet" href="/saycheese/assets/styles/admin-moderator/requests/requests_to_photographer.css">
</head>

<body>

	<!-- Подключение разметки навигационной панели -->

	<?php require '../../include/nav_am.php' ?>

	<!-- Получение разметки блока с сообщением о статусе операции -->

	<?php require '../../include/message.php' ?>

	<!-- Получение разметки блока с сообщением об ошибке --> 

	<?php require '../../include/message_error.php' ?>

	<!-- Окошко для перенаправления заявки -->

	<div class="redirect-wrapper">
		<div class="redirect-block">
			<p class="close-redirect-block">×</p>
			<div class="redirect-block-content">
				<form method="POST" onsubmit="return false" id="redirect">
					<input name="id_request" type="hidden" id="id_request">
					<select name="photographer" class="photographer_list">
						<option value="0">Выберите фотографа</option>
						<?php for($i = 0; $i < count($photographers_list); $i++): ?>
							<option value="<?= $photographers_list[$i]['id'] ?>"><?= $photographers_list[$i]['name'] . str_repeat('&nbsp;', 3) . $photographers_list[$i]['count_processing'] . " | " . $photographers_list[$i]['count_completed'] ?></option>
						<?php endfor; ?>
					</select>
					<button type="submit" class="btn_redirect"><p class="btn-text">Перенаправить</p></button>
				</form>
			</div>
		</div>
	</div>

	<!-- Основной контент -->

	<main class="content">
		<div class="wrapper">
			<div class="headline-block">
				<h1 class="headline">Заявки на услуги фотографа</h1>
			</div>

			<!-- Фильтрация -->

			<div class="requests-search-block">
				<form action="" method="get">
					<input type="text" name="date" onfocus="(this.type='date')" value="<?=$date?>"  class="requests-search-by-date" placeholder="Поиск по дате">
					<select name="style" class="requests-search-by-style">
						<?php if($style == 0): ?>
							<option selected value=0>Все стили</option>
						<?php else: ?>
							<option value=0>Все стили</option>
						<?php endif; ?>
						<?php if($style == 1): ?>
							<option selected value=1>Обсужу с фотографом</option>
						<?php else: ?>
							<option value=1>Обсужу с фотографом</option>
						<?php endif; ?>
						<?php if($style == 2): ?>
							<option selected value=2>Портретная фотография</option>
						<?php else: ?>
							<option value=2>Портретная фотография</option>
						<?php endif; ?>
						<?php if($style == 3): ?>
							<option selected value=3>Фотосессия в стиле Lifestyle</option>
						<?php else: ?>
							<option value=3>Фотосессия в стиле Lifestyle</option>
						<?php endif; ?>
						<?php if($style == 4): ?>
							<option selected value=4>Фотосессия в стиле Love Story</option>
						<?php else: ?>
							<option value=4>Фотосессия в стиле Love Story</option>
						<?php endif; ?>
						<?php if($style == 5): ?>
							<option selected value=5>Фотосессия в стиле Fashion</option>
						<?php else: ?>
							<option value=5>Фотосессия в стиле Fashion</option>
						<?php endif; ?>
						<?php if($style == 6): ?>
							<option selected value=6>Фотосессия в ретро стиле</option>
						<?php else: ?>
							<option value=6>Фотосессия в ретро стиле</option>
						<?php endif; ?>
						<?php if($style == 7): ?>
							<option selected value=7>Фотосессия в стиле гламур</option>
						<?php else: ?>
							<option value=7>Фотосессия в стиле гламур</option>
						<?php endif; ?>
						<?php if($style == 8): ?>
							<option selected value=8>Арт фотосессия</option>
						<?php else: ?>
							<option value=8>Арт фотосессия</option>
						<?php endif; ?>
						<?php if($style == 9): ?>
							<option selected value=9>Свадебная фотосессия</option>
						<?php else: ?>
							<option value=9>Свадебная фотосессия</option>
						<?php endif; ?>
						<?php if($style == 10): ?>
							<option selected value=10>Фотосессия в стиле кантри</option>
						<?php else: ?>
							<option value=10>Фотосессия в стиле кантри</option>
						<?php endif; ?>
						<?php if($style == 11): ?>
							<option selected value=11>Фотосессия в стиле фэнтези</option>
						<?php else: ?>
							<option value=11>Фотосессия в стиле фэнтези</option>
						<?php endif; ?>
					</select>
					<button type="submit" name="requests_search" class="btn-go-search">Применить</button>
				</form>
			</div>

			<!-- Список заявок на услуги фотографа -->

			<div class="requests-list">
				<?php for ($i = 0; $i < count($requests); $i++) : ?>
					<?php
					$client = Select("client", ["id_user" => ["=", $requests[$i]['id_user']]]);
					$user = Select("user", ["id" => ["=", $requests[$i]['id_user']]]);
					$photosession_date = $requests[$i]['date'];
					$photosession_date = new DateTime($photosession_date);
					$photosession_date = date_format($photosession_date, 'd.m.Y');
					$photosession_time_start = $requests[$i]['time_start'];
					$photosession_time_start = new DateTime($photosession_time_start);
					$photosession_time_start = date_format($photosession_time_start, 'H:i');
					$photosession_time_end = $requests[$i]['time_end'];
					$photosession_time_end = new DateTime($photosession_time_end);
					$photosession_time_end = date_format($photosession_time_end, 'H:i');
					?>
					<div class="request-item">
						<div class="client-avatar-block">
							<?php if ($client[0]['avatar'] == null) : ?>
								<div class="client-avatar" style="background-image: url(/saycheese/assets/images/avatars/no_avatar.png);"></div>
							<?php else : ?>
								<div class="client-avatar" style="background-image: url(/saycheese/assets/images/avatars/<?= $client[0]['avatar'] ?>);"></div>
							<?php endif; ?>
						</div>
						<div class="client-info-block">
							<div class="client-info">
								<p class="client-name"><?= $client[0]['surname'] ?> <?= $client[0]['name'] ?></p>
								<p class="client-phone"><?= $user[0]['phone'] ?></p>
							</div>
						</div>
						<div class="photosession-date-block">
							<p class="photosession-date"><?= $photosession_date ?></p>
						</div>
						<div class="photosession-time-block">
							<p class="photosession-time"><?= $photosession_time_start ?> - <?= $photosession_time_end ?></p>
						</div>
						<div class="photosession-place-block">
							<p class="photosession-place"><?= $requests[$i]['place'] ?></p>
						</div>
						<div class="photosession-style-block">
							<p class="photosession-style"><?= $requests[$i]['style'] ?></p>
						</div>
						<div class="photosession-price-block">
							<p class="photosession-price"><?= $requests[$i]['price'] ?> ₽</p>
						</div>
						<div class="btn-redirect-block">
							<div class="btn-redirect" id="<?= $requests[$i]['id'] ?>">
								<p class="btn-text">Перенаправить</p>
							</div>
						</div>
					</div>
				<?php endfor; ?>
				<?php if($empty != ""): ?>
					<div class="empty-error_block">
						<div class="empty-error-wrapper">
							<div class="empty-error-img"></div>
							<p class="empty-error-message">По данному запросу <br>ничего не найдено</p>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</main>

	<!-- Подключение разметки навигационной панели -->

	<?php require '../../include/footer_am.php' ?>

	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	<script src="/saycheese/assets/scripts/open_nav.js" defer></script>
	<script src="/saycheese/assets/scripts/close_error.js" defer></script>
	<script src="/saycheese/assets/scripts/redirect_win.js" defer></script>
	<script src="/saycheese/assets/scripts/ajax/redirect_photographer_request.js" defer></script>

</body>

</html>