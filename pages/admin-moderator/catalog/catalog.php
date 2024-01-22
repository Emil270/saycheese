<?php

session_start();
require '../../../app/include/querys.php';
require '../../../app/controllers/general/staff_login_check.php';

require '../../../app/controllers/admin-moderator/catalog.php';
$types = Select("type");

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Say Cheese - Товары</title>
	<link rel="icon" href="/saycheese/saycheese.ico">
	<link rel="stylesheet" href="/saycheese/assets/styles/admin-moderator/catalog/catalog.css">
	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
</head>

<body>

	<!-- Подключение разметки навигационной панели -->

	<?php require '../../include/nav_am.php' ?>

	<!-- Получение разметки блока с сообщением о статусе операции -->

	<?php require '../../include/message.php' ?>

	<!-- Проверка успешности операции (вывод сообщения об успехе) -->

	<?php if($success !== ""): ?>
		<script>
			$('.message-block').fadeOut(0);
			$('.smessage-block').css('display', 'flex');
			$('.smessage').text("Успешно!");
			$('.message-block').delay(800).fadeOut();
		</script>
		<?php $success = ""; ?>
	<?php endif; ?>

	<!-- Основной контент -->

	<main class="content">
		<div class="wrapper">
			<div class="catalog-headline-block">
				<h1 class="catalog-headline">Товары</h1>
				<a href="add_product.php" class="btn-add-product">
					<p class="btn-add-product">Добавить новый товар</p>
				</a>
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
							<option value="0" <?php if ($type_filter === '0') { echo "selected"; } ?>>Все типы</option>
							<?php for ($i = 0; $i < count($types); $i++) : ?>
								<option value="<?= $types[$i]['id'] ?>" <?php if ($type_filter === (string)$types[$i]['id']) { echo "selected"; } ?>><?= $types[$i]['type'] ?></option>
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
						<div class="catalog-item-img" style="background-image: url(/saycheese/assets/images/catalog/<?= $product[$i]['photo'] ?>);"></div>
						<div class="catalog-item-info-block">
							<div class="catalog-item-info-wrapper">
								<div class="catalog-item-name-block">
									<h2 class="catalog-item-name">Фотаппарат <?= $product[$i]['name'] ?></h2>
								</div>
								<div class="catalog-item-price-block">
									<p class="catalog-item-price"><?= $product[$i]['price'] ?> ₽</p>
								</div>
								<div class="catalog-item-count-block">
									<p class="catalog-item-count">Осталось: <?= $product[$i]['count'] ?></p>
								</div>
							</div>
						</div>
						<div class="catalog-btns-block">
							<div class="catalog-btns-wrapper">
								<a href="edit_product.php?id_product_to_edit=<?=$product[$i]['id']?>" class="btn-link">
									<div class="btn_edit_product">
										<p class="btn-edit-text">✎</p>
									</div>
								</a>
								<form method="post" action="catalog.php" class="btn-link">
									<button name="del_product" value="<?=$product[$i]['id']?>" class="btn_del_product">
										<p class="btn-del-text">×</p>
									</button>
								</form>
							</div>
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

	<?php require '../../include/footer_am.php' ?>

	<script src="/saycheese/assets/scripts/open_nav.js" defer></script>

</body>

</html>