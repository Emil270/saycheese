<?php

	session_start();
	require 'app/include/querys.php';
	//setcookie('user_login', '', -1, '/');
	require 'app/controllers/general/user_login_check.php';
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
						<h2 class="header-headline-shortinfo">Быстрая доставка профессиональных и <br>полупрофессиональных фотоаппаратов <br>разлиынх типов</h2>
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
						— &nbsp;&nbsp;Большой выбор фотоаппаратов самых разных брендов
						<br>— &nbsp;&nbsp;Быстрая доставка по всей России (только курьером)
						<br>— &nbsp;&nbsp;Гарантия на все товары
						<br>— &nbsp;&nbsp;Оплата до или после получения заказа
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


</body>

</html>