<?php

session_start();
require '../../../app/include/querys.php';
require '../../../app/controllers/general/user_login_check.php';

require '../../../app/controllers/client/catalog.php';
$types = Select("type");

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Say Cheese - Каталог</title>
	<link rel="icon" href="/saycheese/saycheese.ico">
	<link rel="stylesheet" href="/saycheese/assets/styles/client/catalog/catalog.css">
</head>

<body>

	<!-- Подключение разметки навигационной панели -->

	<?php require '../../include/nav.php' ?>

	<!-- Получение разметки блока с сообщением о статусе операции -->

	<?php require '../../include/message.php' ?>

	<!-- Основной контент -->

	<main class="content">
		<div class="wrapper">
			<div class="catalog-headline-block">
				<h1 class="catalog-headline">Каталог</h1>
			</div>

			<!-- Фильтр -->

			<div class="catalog-filter">
				<div class="filter-headline-block">
					<p class="filter-headline">Фильтр:</p>
				</div>
				<div class="filter-content">
					<form action="catalog.php" method="get">
						<input type="text" name="name_filter" value="<?= $name_filter ?>" class="search-by-name" placeholder="Поиск">
						<select name="type_filter" class="select-type">
							<option value="0" <?php if ($type_filter === '0') {
																	echo "selected";
																} ?>>Все типы</option>
							<?php for ($i = 0; $i < count($types); $i++) : ?>
								<option value="<?= $types[$i]['id'] ?>" <?php if ($type_filter === (string)$types[$i]['id']) {
																													echo "selected";
																												} ?>><?= $types[$i]['type'] ?></option>
							<?php endfor; ?>
						</select>
						<input type="hidden" name="page" value="<?= $page ?>">
						<button type="submit" name="filter" class="btn-go-filter">Применить</button>
					</form>
				</div>
			</div>

			<!-- Отображение товаров -->

			<div class="catalog-items-list">
				<?php if ($error !== "") : ?>
					<div class="catalog-error_block">
						<div class="catalog-error-wrapper">
							<div class="catalog-error-img"></div>
							<p class="catalog-error-message"><?= $error ?></p>
						</div>
					</div>
				<?php endif; ?>
				<?php for ($i = 0; $i < count($product); $i++) : ?>
					<div class="catalog-item">
						<div class="item-img-block">
							<div class="item-img" style="background-image: url(/saycheese/assets/images/catalog/<?= $product[$i]['photo'] ?>);">
							</div>
						</div>
						<div class="item-info-block">
							<div class="item-name-block">
								<h1 class="item-name">Фотоаппарат <?= $product[$i]['name'] ?></h1>
							</div>
							<div class="item-price-block">
								<p class="item-price"><?= $product[$i]['price'] ?> ₽</p>
							</div>
						</div>
						<div class="item-btns-block">
							<div class="btn-add-to-basket">
								<a class="btn-link add_basket" id="<?= $product[$i]['id'] ?>">
									<p class="btn-text">В корзину</p>
								</a>
							</div>
							<div class="btn-show-more">
								<a class="btn-link" href="catalog_item.php?id_product=<?= $product[$i]['id'] ?>">
									<p class="btn-text">Подробнее</p>
								</a>
							</div>
							</a>
						</div>
					</div>
				<?php endfor; ?>
			</div>

			<!-- Пагинация (кнопки вперед назад :D) -->

			<div class="pagination-block">
				<div class="btn_pages_block">
					<?php if ($page == 1) : ?>
						<a href="?name_filter=<?= $name_filter ?>&type_filter=<?= $type_filter ?>&page=<?= $page - 1 ?>"><button disabled class="btn-edit-page prev-page">Предыдущая странциа</button></a>
					<?php else : ?>
						<a href="?name_filter=<?= $name_filter ?>&type_filter=<?= $type_filter ?>&page=<?= $page - 1 ?>"><button class="btn-edit-page prev-page">Предыдущая странциа</button></a>
					<?php endif; ?>
					<?php if ($page == $max_page) : ?>
						<a href="?name_filter=<?= $name_filter ?>&type_filter=<?= $type_filter ?>&page=<?= $page + 1 ?>"><button disabled class="btn-edit-page next-page">Следующая странциа</button></a>
					<?php else : ?>
						<a href="?name_filter=<?= $name_filter ?>&type_filter=<?= $type_filter ?>&page=<?= $page + 1 ?>"><button class="btn-edit-page next-page">Следующая странциа</button></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</main>

	<!-- Подключение разметки футера -->

	<?php require '../../include/footer.php' ?>

	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	<script src="/saycheese/assets/scripts/open_nav.js" defer></script>
	<script src="/saycheese/assets/scripts/ajax/add-basket.js" defer></script>

</body>

</html>