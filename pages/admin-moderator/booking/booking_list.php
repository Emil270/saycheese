<?php 

	require '../../../app/controllers/admin-moderator/booking.php';
	require '../../../app/controllers/general/staff_login_check.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Say Cheese - Бронь фотостудий</title>
	<link rel="icon" href="/saycheese/saycheese.ico">
	<link rel="stylesheet" href="/saycheese/assets/styles/admin-moderator/booking/booking_list.css">
</head>
<body>

	<!-- Подключение разметки навигационной панели -->

	<?php require '../../include/nav_am.php' ?>

	<!-- Получение разметки блока с сообщением о статусе операции -->

	<?php require '../../include/message.php' ?>

	<!-- Получение разметки блока с сообщением об ошибке --> 

	<?php require '../../include/message_error.php' ?>

	<main class="content">
		<div class="wrapper">
			<div class="booking-headline-block">
				<h1 class="booking-headline">Бронь фотостудий</h1>
			</div>

			<!-- Фильтрация -->

			<div class="booking-search-block">
				<form action="" method="get">
					<input type="text" name="date" onfocus="(this.type='date')" value="<?=$date?>"  class="booking-search-by-date" placeholder="Поиск по дате">
					<select name="photostudio" class="booking-search-by-photostudio">
						<option value=0>Все фотостудии</option>
						<?php for($i = 0; $i < count($photostudios); $i++): ?>
							<?php if($photostudio == $photostudios[$i]['id']): ?>
								<option selected value=<?=$photostudios[$i]['id']?>><?=$photostudios[$i]['name']?></option>
							<?php else: ?>
								<option value=<?=$photostudios[$i]['id']?>><?=$photostudios[$i]['name']?></option>
							<?php endif; ?>
						<?php endfor; ?>
					</select>
					<button type="submit" name="booking_search" class="btn-go-search">Применить</button>
				</form>
			</div>

			<!-- Список брони фотостудий -->

			<div class="booking-list-block">
				
				<?php for($i = 0; $i < count($booking); $i++): ?>
					<?php 
						$client = Select("client", ["id_user" => ["=", $booking[$i]['id_user']]]);
						$user = Select("user", ["id" => ["=", $booking[$i]['id_user']]]);
						$photostudio = Select("photostudio", ["id" => ["=", $booking[$i]['id_photostudio']]]);
						$book_date = $booking[$i]['date'];
						$book_date = new DateTime($book_date);
						$book_date = date_format($book_date, 'd.m.Y');
						$book_time_start = $booking[$i]['time_start'];
						$book_time_start = new DateTime($book_time_start);
						$book_time_start = date_format($book_time_start, 'H:i');
						$book_time_end = $booking[$i]['time_end'];
						$book_time_end = new DateTime($book_time_end);
						$book_time_end = date_format($book_time_end, 'H:i');
					?>
					<div class="booking-item-block">
						<div class="client-avatar-block">
							<?php if($client[0]['avatar'] == null): ?> 
								<div class="client-avatar" style="background-image: url(/saycheese/assets/images/avatars/no_avatar.png);"></div>
							<?php else: ?>
								<div class="client-avatar" style="background-image: url(/saycheese/assets/images/avatars/<?=$client[0]['avatar']?>);"></div>
							<?php endif; ?>
						</div>
						<div class="client-info-block">
							<div class="client-info">
								<p class="client-name"><?=$client[0]['surname']?> <?=$client[0]['name']?></p>
								<p class="client-phone"><?=$user[0]['phone']?></p>
							</div>
						</div>
						<div class="photostudio-name-block">
							<p class="photostudio-name"><?=$photostudio[0]['name']?></p>
						</div>
						<div class="booking-date-block">
							<p class="booking-date"><?=$book_date?></p>
						</div>
						<div class="booking-time-block">
							<p class="booking-time"><?=$book_time_start?> - <?=$book_time_end?></p>
						</div>
						<div class="booking-price-block">
							<p class="booking-price"><?=$booking[$i]['price']?> Р</p>
						</div>
						<div class="btn-done-block">
							<div class="btn-done" id="<?=$booking[$i]['id']?>">
								<p class="btn-text">✓</p>
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

	<!-- Подключение разметки футера -->

	<?php require '../../include/footer_am.php' ?>

	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	<script src="/saycheese/assets/scripts/open_nav.js" defer></script>
	<script src="/saycheese/assets/scripts/ajax/complete_booking.js" defer></script>
</body>
</html>