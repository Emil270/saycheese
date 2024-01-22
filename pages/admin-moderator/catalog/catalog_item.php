<?php

session_start();
require '../../../app/include/querys.php';
require '../../../app/controllers/general/staff_login_check.php';

if (!isset($_GET['id_product'])) {
	header("Location: ../../general/error404.php");
	exit();
}

require '../../../app/controllers/admin-moderator/catalog.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Say Cheese - <?= $selected_product['name'] ?></title>
	<link rel="icon" href="/saycheese/saycheese.ico">
	<link rel="stylesheet" href="/saycheese/assets/styles/admin-moderator/catalog/catalog_item.css">
</head>

<body>

	<!-- Подключение разметки навигационной панели -->

	<?php require '../../include/nav_am.php' ?>

	<!-- Получение разметки блока с сообщением о статусе операции -->

	<?php require '../../include/message.php' ?>

	<!-- Основной контент -->

	<main class="content">
		<div class="wrapper">
			<div class="item_block">

				<!-- Блок с изображением товара, его стоимостью и кнопкой Добавить в корзину -->

				<div class="item-media_block">
					<div class="item-img_block" style="background-image: url(/saycheese/assets/images/catalog/<?= $selected_product['photo'] ?>);"></div>
					<div class="item-price-basket_block">
						<div class="item-price_block">
							<p class="item-price"><?= $selected_product['price'] ?> ₽</p>
						</div>
						<div class="item-btns-block">
							<a class="btn-link" href="edit_product.php?id_product_to_edit=<?= $selected_product['id'] ?>">
								<div class="edit_item_btn">
									<p class="btn-text">Изменить товар</p>
								</div>
							</a>
						</div>
					</div>
				</div>

				<!-- Блок с описанием и характеристиками товара -->

				<div class="item-info_block">
					<div class="item-name_block">
						<h1 class="item-name">Фотоаппарат <?= $selected_product['name'] ?></h1>
					</div>
					<div class="item-desc_block">
						<h2 class="item-desc-headline">Описание</h2>
						<p class="item-desc-text"><?= $selected_product['description']; ?></p>
					</div>
					<div class="item-charact_block">
						<h2 class="item-charact-headline">Характеристики</h2>
						<div class="item-charact-list">
							<p class="item-charact">Количество: <?= $selected_product['count'] ?></p>
							<p class="item-charact">Тип камеры: <?= $selected_product['type'] ?></p>
							<p class="item-charact">Число мегапикселей: <?= $selected_product['num_megapix'] ?></p>
							<p class="item-charact">Максимальное разрешение: <?= $selected_product['max_resolution'] ?></p>
							<p class="item-charact">Съемка видео: <?= $selected_product['shooting_video'] ?></p>
							<p class="item-charact">Чувствительность: <?= $selected_product['sensitivity'] ?></p>
							<p class="item-charact">Выдержка: <?= $selected_product['excerpt'] ?></p>
							<p class="item-charact">Фокусировка: <?= $selected_product['focusing'] ?></p>
							<p class="item-charact">Режим съемки: <?= $selected_product['shooting_mode'] ?></p>
							<p class="item-charact">Экран: <?= $selected_product['screen'] ?></p>
							<p class="item-charact">Защищенность: <?= $selected_product['security'] ?></p>
							<p class="item-charact">Интерфейсы: <?= $selected_product['interfaces'] ?></p>
							<p class="item-charact">Емкость аккумулятора: <?= $selected_product['battary_capacity'] ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<!-- Подключение разметки футера -->

	<?php require '../../include/footer_am.php' ?>

	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	<script src="/saycheese/assets/scripts/open_nav.js" defer></script>

</body>

</html>