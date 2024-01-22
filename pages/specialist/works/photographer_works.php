<?php

session_start();
require '../../../app/include/querys.php';
require '../../../app/controllers/general/staff_login_check.php';
require '../../../app/controllers/specialists/photographer_works.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Say Cheese - Мои работы</title>
	<link rel="icon" href="/saycheese/saycheese.ico">
	<link rel="stylesheet" href="/saycheese/assets/styles/specialist/works/photographer_works.css"> 
</head>
<body>

	<!-- Подключение разметки навигационной панели -->

	<?php require '../../include/nav_s.php' ?>

	<!-- Основной контент -->

	<main class="content">
		<div class="wrapper">
			<div class="headline-block">
				<h1 class="headline">Мои работы</h1>
			</div>

			<!-- Фильтрация -->

			<div class="requests-search-block">
				<form action="" method="get">
					<input type="text" name="date" onfocus="(this.type='date')" value="<?=$date?>"  class="requests-search-by-date" placeholder="Поиск по дате">				
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
					<?php if($requests[$i]['status'] == "Завершена"): ?>
						<div class="request-item complete">
					<?php else: ?>
						<div class="request-item">
					<?php endif; ?>
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
						<div class="btn-end-work-block">
							<div class="btn-end-work" id="<?= $requests[$i]['id'] ?>">
								<p class="btn-text">Завершить</p>
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
				<?php if($no_works != ""): ?>
					<div class="empty-error_block">
						<div class="empty-error-wrapper">
							<div class="empty-error-img"></div>
							<p class="empty-error-message">На данный момент <br>у вас нет работ</p>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</main>

	<!-- Подключение разметки навигационной панели -->

	<?php require '../../include/footer_s.php' ?>

	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	<script src="/saycheese/assets/scripts/open_nav.js" defer></script>
	<script src="/saycheese/assets/scripts/ajax/end_work_photographer.js" defer></script>

</body>

</html>