<?php 
		session_start();
		require '../../../app/include/querys.php';
		require '../../../app/controllers/general/user_login_check.php';
		$id_photostudio = $_GET['id_photostudio'];
		if($id_photostudio < 0 || !is_numeric($id_photostudio) || $id_photostudio == ""){
			header("Location: /saycheese/pages/general/error404.php");
			exit();
		}
		$current_studio = Select("photostudio", ["id" => ["=", $id_photostudio]]);
		$current_studio_images = Select("photostudio_image", ["id_photostudio" => ["=", $id_photostudio]]);
		if(empty($current_studio)){
			header("Location: /saycheese/pages/general/error404.php");
			exit();
		}
		$time_work_start = date('H:i', strtotime($current_studio[0]['time_work_start']));
		$time_work_end = date('H:i', strtotime($current_studio[0]['time_work_end']));
		$dateNow = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Say Cheese - Страница фотостудии</title>
	<link rel="icon" href="/saycheese/saycheese.ico">
	<link rel="stylesheet" href="/saycheese/assets/styles/client/photostudio/photostudio_page.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

	<div class="test"></div>

	<!-- Подключение разметки блока с ошибкой -->

	<?php require '../../include/message_error.php' ?>
	
	<!-- Подключение разметки навигационной панели -->

	<?php require '../../include/nav.php'; ?>

	<!-- Получение разметки блока с сообщением о статусе операции -->

	<?php require '../../include/message.php' ?> 

	<!-- Окошко с информацией о занятом времени -->

	<div class="msg-busy-time-wrapper">
		<div class="msg-busy-time-block">
		<p class="close-busy-time-win">×</p>
			<div class="msg-busy-time-content">
				<h1 class="msg-busy-time-headline">Занятое время на 00.00.00</h1>
				<p class="msg-busy-time-text"></p>
			</div>
		</div>
	</div>

	<!-- Окошко для брони студии -->

	<div class="booking-photostudio-wrapper">
		<div class="booking-photostudio-block">
			<p class="close-booking-window">×</p>
			<div class="get-busy-time-wrapper">
				<div class="get-busy-time-block">
					<form id="get-busy-time-form" method="POST" onsubmit="return false">
						<input required="" min="<?=$dateNow?>" class="get-busy-time-input" type="text" name="date" onfocus="(this.type='date')" placeholder="Дата">
						<input type="hidden" name="id_photostudio" value="<?=$id_photostudio?>">
						<input type="hidden" name="get-busy-time">
						<br><button type="submit" class="get-busy-time-btn">Узнать занятое время</button>
					</form>
				</div>
			</div>
			<div class="booking-photostudio-headline-block">
				<h1 class="booking-photostudio-headline">Заполните форму и мы обязательно<br>позвонимвам в течении 10 минут</h1>
			</div>
			<div class="booking-photostudio-form">
				<form id="book_studio" method="POST" onsubmit="return false">
					<div class="booking-photostudio-inputs">
						<input required="" type="text" name="date_book" min="<?=$dateNow?>" class="date_book" onfocus="(this.type='date')" placeholder="Дата брони"> <br>
						<input required="" type="text" min="<?=$time_work_start?>" max="<?=$time_work_end?>" name="time_book_start" class="time_book" onfocus="(this.type='time')" placeholder="Время начала брони"> <br>
						<input required="" type="text" min="<?=$time_work_start?>" max="<?=$time_work_end?>" name="time_book_end" class="time_book" onfocus="(this.type='time')" placeholder="Время окончания брони"> <br>
						<input type="hidden" name="book-studio" value="<?=$id_photostudio?>"> <br>
					</div>
					<button type="submit" class="btn-bool-studio">Забронировать</button> <br>
				</form>
			</div>
		</div>
	</div>

	<main class="photostudio-main-content">
		<div class="photostudio-wrapper">
			<div class="photostudio-block">
				<div class="photostudio-img-block" style="background-image: url(/saycheese/assets/images/studios/<?=$current_studio_images[0]['image']?>);">
				</div>
				<div class="photostudio-info-block">
					<div class="photostudio-headline-block">
						<h1 class="photostudio-headline"><?=$current_studio[0]['name']?></h1>
					</div>
					<div class="photostudio-text-block">
						<div class="photostudio-text-key">
							<b><p class="photostudio-text">
								Адрес <br>
								Площадь <br>
								Высота потолков <br>
								Время работы <br>
								Номер телефона
							</p></b>
						</div>
						<div class="photostudio-text-value">
							<p class="photostudio-text">
								<?=$current_studio[0]['address']?> <br>
								<?=$current_studio[0]['area']?> м<sup>2</sup> <br>
								<?=$current_studio[0]['ceiling_height']?> м <br>
								c <?=$time_work_start?> до <?=$time_work_end?> <br>
								89656027374
							</p>
						</div>
					</div>
					<div class="photostudio-booking-block">
						<div class="photostudio-price-block">
							<p class="photostudio-price">Стоимость <?=$current_studio[0]['price']?> руб. в час</p>
						</div>
						<?php if(isset($_COOKIE['user_login'])): ?>
							<div class="photostudio-book-btn">
								<p class="btn-text">Забронировать</p>
							</div>
						<?php else: ?>
							<div class="no-login">
								<p class="btn-text">Забронировать</p>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="photostudio-more-images-block">
				<div class="photostudio-more-images-headline-block">
					<h2 class="photostudio-more-images-headline">Больше фотографий</h2>
				</div>
				<div class="photostudios-images-carousel">
					<div class="carousel-btn-left-block">
						<div class="carousel-btn">
							<i id="left" class="fa-solid fa-angle-left"></i>
						</div>
					</div>
					<div class="carousel-images-block">
						<?php for($i = 0; $i < count($current_studio_images); $i++): ?>
							<img src="/saycheese/assets/images/studios/<?=$current_studio_images[$i]['image']?>" alt="img">
						<?php endfor; ?>
					</div>
					<div class="carousel-btn-right-block">
						<div class="carousel-btn">
							<i id="right" class="fa-solid fa-angle-right"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<!-- Подключение разметки футера -->

	<?php require '../../include/footer.php' ?>

	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	<script src="/saycheese/assets/scripts/open_nav.js" defer></script>
	<script src="/saycheese/assets/scripts/carousel.js" defer></script>
	<script src="/saycheese/assets/scripts/booking_wins.js" defer></script>
	<script src="/saycheese/assets/scripts/close_error.js" defer></script>
	<script src="/saycheese/assets/scripts/ajax/booking.js"></script>
	<script src="/saycheese/assets/scripts/no-login-btn.js"></script>
</body>
</html>