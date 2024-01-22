<?php 

	require '../../../app/controllers/client/my_booking.php';
	require '../../../app/controllers/general/user_login_check.php'; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Say Cheese - Мои брони</title>
	<link rel="icon" href="/saycheese/saycheese.ico">
	<link rel="stylesheet" href="/saycheese/assets/styles/client/my-booking/my_booking.css">
</head>
<body>	

	<!-- Подключение разметки навигационной панели -->

	<?php require '../../include/nav.php' ?>

	<main class="content">
		<div class="wrapper">
			<div class="booking-headline-block">
				<h1 class="booking-headline">Мои брони</h1>
			</div>

			<!-- Фильтрация -->

			<div class="booking-search-block">
				<form action="" method="get">
					<input type="text" name="date" onfocus="(this.type='date')" value="<?=$date?>"  class="booking-search-by-date" placeholder="Поиск по дате">
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
					<?php if($booking[$i]["status"] != "Завершена"): ?>
						<div class="booking-item-block">
					<?php else: ?>
						<div class="booking-item-block complete">
					<?php endif; ?>			
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
						<div class="btn-cancel-block">
							<div class="btn-cancel" id="<?=$booking[$i]['id']?>">
								<p class="btn-text">Отменить бронь</p>
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

	<?php require '../../include/footer.php' ?>

	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	<script src="/saycheese/assets/scripts/open_nav.js" defer></script>
	<script src="/saycheese/assets/scripts/ajax/cancel_booking.js" defer></script>

</body>
</html>