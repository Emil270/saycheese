<?php

	session_start();
	require 'app/include/querys.php';
	//setcookie('user_login', '', -1, '/');

	require 'app/controllers/general/user_login_check.php';
	
	$studios = Select("photostudio", null, 4);
	$products = Select("product", ["count" => [">", 0]], 8, 0, "id");
	$reviews = SelectReviewsAndClients("review", "user", "client", 4);

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Say Cheese - Главная</title>
	<link rel="icon" href="/saycheese/saycheese.ico">
	<link rel="stylesheet" href="/saycheese/assets/styles/index.css">
</head>

<body>

	<!-- Подключение разметки навигационной панели -->

	<?php require 'pages/include/nav.php' ?>

	<!-- Получение разметки блока с сообщением о статусе операции -->

	<?php require 'pages/include/message.php' ?>

	<!-- Подключение разметки блока с ошибкой -->

	<?php require 'pages/include/message_error.php' ?>

	<!-- Header -->

	<header>
		<div class="header-content">
			<div class="header-line-block"></div>
			<div class="header-welcome-contain">
				<div class="header-wrapper">
					<div class="header-welcome-headline-block">
						<h2 class="header-welcome-headline">Добро <br>пожаловать!</h2>
					</div>
					<div class="header-subheadline-block">
						<h2 class="header-subheadline">ты попал на:</h2>
					</div>
					<div class="header-headline-name-block">
						<h1 class="header-headline-name">«SAY CHEESE»</h1>
					</div>
					<div class="header-headline-shortinfo-block">
						<h2 class="header-headline-shortinfo">— Бронируй наши студии<br>— Приобретай профессиональные и полупрофессиональные фотоаппараты<br>— Пользуйся услугами фотографа и обработки фото<br><b>— Твори и создавай!</b></h2>
					</div>
				</div>
			</div>
			<div class="header-image"></div>
		</div>
	</header>

	<!-- Блок Добро пожаловать (ну типа) -->

	<aside class="aside-hi">
		<div class="hi-block">
			<div class="hi-image-container">
			</div>
			<div class="hi-text-container">
				<div class="hi-wrapper">
					<h2 class="hi-text-headline">
						Скажите "Сыр"
					</h2>
					<p class="hi-text-text">
						Мы рады видеть вас среди <br>наших клиентов! И..., кстати, вас снимает <br>скрытая камера - улыбочку :)
					</p>
				</div>
			</div>
		</div>
	</aside>

	<!-- Блок с краткой инормацией -->

	<aside class="aside-short-info">
		<div class="short-info-block">
			<div class="short-info-container">
				<div class="short-info-wrapper">
					<h2 class="short-info-headline">
						Что мы имеем?
					</h2>
					<p class="short-info-text">
						12 точек по городу Казань - качественные, оснащенные профессиональным оборудованием фотостудии.
						<br><br>Большой выбор фотоаппратов и камер различных типов.
						<br><br>Профессиональные фотографы и специалисты по обработке фотографий - мастера в своем деле, готовые довести начатое до прекрасного результата.
					</p>
				</div>
			</div>
			<div class="short-info-image">
			</div>
		</div>
	</aside>

	<aside class="separator">
		<div class="separ-first"></div>
		<div class="separ-second"></div>
		<div class="separ-third"></div>
	</aside>


	<!-- Фотостудии -->

	<main class="photostudio-block">
		<div class="photostudio-wrapper">
			<a href="/saycheese/pages/client/photostudio/photostudios.php">
				<div class="photostudio-headline-block">
					<h1 class="photostudio-headline">
						Фотостудии &nbsp; →
					</h1>
				</div>
			</a>
			<div class="photostudio-items-list">
					<?php for($i = 0; $i < count($studios); $i++) : ?>
						<?php $studio_img = Select("photostudio_image", ["id_photostudio" => ["=", $studios[$i]['id']]], 1) ?>
						<div class="photostudio-item">
							<div class="photostudio-item-img" style="background-image: url(/saycheese/assets/images/studios/<?=$studio_img[0]['image']?>);">
							</div>
							<div class="photostudio-item-info-block">
								<div class="photostudio-item-name-price-block">
									<h1 class="photostudio-item-name"><?=$studios[$i]['name']?></h1>
									<h2 class="photostudio-item-price"><?=$studios[$i]['price']?> руб. в час</h2>
								</div>
								<div class="photostudio-item-address-block">
									<h2 class="photostudio-item-address"><?=$studios[$i]['address']?></h2>
								</div>
							</div>
							<div class="photostudio-item-btns-block">
								<div class="photostudio-btn-show-more">
									<a class="btn-link" href="/saycheese/pages/client/photostudio/photostudio_page.php?id_photostudio=<?=$studios[$i]['id']?>"><p class="btn-text">Подробнее</p></a>
								</div>
							</div>
						</div>
					<?php endfor ; ?>
			</div>
		</div>
	</main>

	<!-- Каталог -->

	<main class="catalog-block">
		<div class="catalog-wrapper">
			<a href="/saycheese/pages/client/catalog/catalog.php">
				<div class="catalog-headline-block">
					<h1 class="catalog-headline">
						Каталог &nbsp; →
					</h1>
				</div>
			</a>
			<div class="catalog-items-list">
				<?php for ($i = 0; $i < count($products); $i++) : ?>
					<div class="catalog-item">
						<div class="item-img-block">
							<div class="item-img" style="background-image: url(/saycheese/assets/images/catalog/<?=$products[$i]['photo']?>);">
							</div>
						</div>
						<div class="item-info-block">
							<div class="item-name-block">
								<h1 class="item-name"><?=$products[$i]['name']?></h1>
							</div>
							<div class="item-price-block">
								<p class="item-price"><?=$products[$i]['price']?> ₽</p>
							</div>
						</div>
						<div class="item-btns-block">
							<div class="btn-add-to-basket">
								<a class="btn-link add_basket" id="<?=$products[$i]['id']?>"><p class="btn-text">В корзину</p></a>
							</div>
							<div class="btn-show-more">
								<a class="btn-link" href="/saycheese/pages/client/catalog/catalog_item.php?id_product=<?=$products[$i]['id']?>"><p class="btn-text">Подробнее</p></a>
							</div>
						</div>
					</div>
				<?php endfor; ?>
			</div>
		</div>
	</main>

	<aside class="separator">
		<div class="separ-first"></div>
		<div class="separ-second"></div>
		<div class="separ-third"></div>
	</aside>

	<!-- Услуги фотографа -->

	<main class="services-block">
		<div class="photographer-service-block">
			<div class="photographer-service-img-block">
				<div class="photographer-service-img-text-block">
					<p class="photographer-service-text1">Нужен хороший фотограф?</p>
					<p class="photographer-service-text2">Заполни форму и мы перезвоним вам <br>в течении 10 минут</p>
				</div>
			</div>
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

		<!-- Услуги обработки фотографий -->

		<div class="photoshop-service-block">
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
			<div class="photoshop-service-img-block">
				<div class="photoshop-service-img-text-block">
					<p class="photoshop-service-text1">Нужна качественная обработка фото?</p>
					<p class="photoshop-service-text2">Заполни форму и мы перезвоним вам <br>в течении 10 минут</p>
				</div>
			</div>
		</div>	
	</main>

	<aside class="separator">
		<div class="separ-first"></div>
		<div class="separ-second"></div>
		<div class="separ-third"></div>
	</aside>

	<!-- Отзывы -->

	<main class="reviews-block">
		<div class="reviews-wrapper">
			<a href="/saycheese/pages/client/reviews/reviews.php">
				<div class="reviews-headline-block">
					<h1 class="reviews-headline">
						Отзывы &nbsp; →
					</h1>
				</div>
			</a>
			<div class="reviews-list-items-block">
			<div class="reviews-list-items">
					<?php for ($i = 0; $i < count($reviews); $i++) : ?>
						<div class="review-item">
							<?php if ($reviews[$i]['avatar'] == "") : ?>
								<div class="review-author-avatar" style="background-image: url(/saycheese/assets/images/avatars/no_avatar.png);"></div>
							<?php else : ?>
								<div class="review-author-avatar" style="background-image: url(/saycheese/assets/images/avatars/<?= $reviews[$i]['avatar'] ?>);"></div>
							<?php endif; ?>
							<div class="review-info-block">
								<div class="review-date-block">
									<p class="review-date"><?= $reviews[$i]['date'] ?></p>
								</div>
								<div class="review-author-fullname-block">
									<p class="review-author-fullname"><?= $reviews[$i]['name'] . " " . $reviews[$i]['surname'] ?></p>
								</div>
								<div class="review-text-block">
									<p class="review-text"><?= $reviews[$i]['text'] ?></p>
								</div>
							</div>
						</div>
					<?php endfor; ?>
				</div>
			</div>
		</div>
	</main>

	<!-- Подключение разметки футера -->

	<?php require 'pages/include/footer.php' ?>

	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	<script src="/saycheese/assets/scripts/open_nav.js" defer></script>
	<script src="/saycheese/assets/scripts/ajax/add-basket.js" defer></script>
	<script src="/saycheese/assets/scripts/close_error.js" defer></script>
	<script src="/saycheese/assets/scripts/ajax/create_request_to_service.js" defer></script>
	<script src="/saycheese/assets/scripts/no-login-btn.js" defer></script>

</body>

</html>