<?php

require '../../../app/controllers/admin-moderator/orders.php';
require '../../../app/controllers/general/staff_login_check.php';

$id_user = $_SESSION['id'];

?>

<!DOCTYPE html>
<html lang="ru">

<head>
	
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Say Cheese - Мои заказы</title>
	<link rel="icon" href="/saycheese/saycheese.ico">
	<link rel="stylesheet" href="/saycheese/assets/styles/admin-moderator/orders/orders.css"> 
</head>

<body>

	<!-- Подключение разметки навигационной панели -->

	<?php require '../../include/nav_am.php' ?>


	<!-- Основной контент -->

	<main class="orders-content">
		<div class="orders-wrapper">
			<div class="orders-headline-block">
				<h1 class="orders-headline">Заказы</h1>
			</div>

			<!-- Поиск заказов но номеру -->

			<div class="orders-search-block">
				<form action="orders.php" method="get">
					<input type="text" name="code" value="<?= $code ?>" class="orders-search" placeholder="Поиск по номеру заказа">
					<button type="submit" name="search_order_by_code" class="btn-go-search">Применить</button>
				</form>
			</div>

			<!-- Список заказов -->

			<div class="orders-list">
				<?php if (count($orders) == 0) : ?>
					<div class="orders-no-items-block">
						<div class="orders-no-item-wrapper">
							<div class="orders-no-item-img"></div>
							<p class="orders-no-items">Здесь пусто...</p>
						</div>
					</div>
				<?php endif; ?>
				<?php for ($i = 0; $i < count($orders); $i++) : ?>
					<div class="order-block">
						<div class="order-wrapper">
							<div class="order-headline-block">
								<h1 class="order-headline">Заказ № <?= $orders[$i]['code'] ?></h1>
							</div>
							<?php	$client = SelectClientOfOrder("user", "client", $orders[$i]['id_user']); ?>
							<div class="order-inform-block">
								<p class="order-inform">Заказчик: <?= $client['name'] . " " . $client['surname'] ?></p>
								<p class="order-inform">Эл. почта заказчика: <?= $client['email'] ?></p>
								<p class="order-inform">Номер телефона заказчика: <?= $client['phone'] ?></p>
								<p class="order-inform">Дата создания заказа: <?= $orders[$i]['date'] ?></p>
								<p class="order-inform">Адрес отправки: г. <?= $orders[$i]['city'] ?>, ул. <?= $orders[$i]['street'] ?>, д. <?= $orders[$i]['house'] ?>, кв. <?= $orders[$i]['apartament'] ?></p>
								<p class="order-inform">Домофон: <?= $orders[$i]['intercom'] ?></p>
								<p class="order-inform">Почтовый индекс: <?= $orders[$i]['indexx'] ?></p>
								<p class="order-inform">Сумма заказа: <?= $orders[$i]['total_price'] ?> ₽</p>
							</div>
							<div class="order-positions-block">
								<h2 class="order-positioms-headline">Позиции заказа:</h2>
								<?php $order_positions = SelectProductsFromOrder("orders_product", "product", $orders[$i]['id']); ?>
								<ol class="order-positions-list">
									<?php for ($j = 0; $j < count($order_positions); $j++) : ?>
										<a href="/saycheese/pages/admin-moderator/catalog/catalog_item.php?id_product=<?= $order_positions[$j]['id'] ?>">
											<li class="order-position"><?= $j + 1 ?>. <?= $order_positions[$j]['name'] ?> (x<?= $order_positions[$j]['count'] ?>)</li>
										</a>
									<?php endfor; ?>
								</ol>
							</div>
						</div>
						<div class="order-btns-block">
							<?php if($orders[$i]['status'] == "Новый"): ?>
								<button class="btn_status_selected"><p class="btn-text">Новый</p></button>
							<?php else: ?>
								<button class="btn_edit_order_status" value="Новый" id="<?=$orders[$i]['id']?>"><p class="btn-text">Новый</p></button>
							<?php endif; ?>

							<?php if($orders[$i]['status'] == "В обработке"): ?>
								<button class="btn_status_selected"><p class="btn-text">В обработке</p></dibuttonv>
							<?php else: ?>
								<button class="btn_edit_order_status" value="В обработке" id="<?=$orders[$i]['id']?>"><p class="btn-text">В обработке</p></button>
							<?php endif; ?>

							<?php if($orders[$i]['status'] == "Собирается"): ?>
								<button class="btn_status_selected"><p class="btn-text">Собирается</p></button>
							<?php else: ?>
								<button class="btn_edit_order_status" value="Собирается" id="<?=$orders[$i]['id']?>"><p class="btn-text">Собирается</p></button>
							<?php endif; ?>

							<?php if($orders[$i]['status'] == "Отправлен"): ?>
								<button class="btn_status_selected"><p class="btn-text">Отправлен</p></button>
							<?php else: ?>
								<button class="btn_edit_order_status" value="Отправлен" id="<?=$orders[$i]['id']?>"><p class="btn-text">Отправлен</p></button>
							<?php endif; ?>

							<?php if($orders[$i]['status'] == "Прибыл"): ?>
								<button class="btn_status_selected"><p class="btn-text">Прибыл</p></button>
							<?php else: ?>
								<button class="btn_edit_order_status" value="Прибыл" id="<?=$orders[$i]['id']?>"><p class="btn-text">Прибыл</p></button>
							<?php endif; ?>

							<?php if($orders[$i]['status'] == "Завершен"): ?>
								<button class="btn_status_selected"><p class="btn-text">Завершен</p></button>
							<?php else: ?>
								<button class="btn_edit_order_status" value="Завершен" id="<?=$orders[$i]['id']?>"><p class="btn-text">Завершен</p></button>
							<?php endif; ?>
						</div>
					</div>
				<?php endfor; ?>
			</div>

			<!-- Пагинация (кнопки вперед назад :D) -->

			<div class="pagination-block">
				<div class="btn_pages_block">
					<?php if ($page == 1) : ?>
						<a href="?page=<?= $page - 1 ?>"><button disabled class="btn-edit-page prev-page">Предыдущая странциа</button></a>
					<?php else : ?>
						<a href="?page=<?= $page - 1 ?>"><button class="btn-edit-page prev-page">Предыдущая странциа</button></a>
					<?php endif; ?>
					<?php if ($page == $max_page) : ?>
						<a href="?page=<?= $page + 1 ?>"><button disabled class="btn-edit-page next-page">Следующая странциа</button></a>
					<?php else : ?>
						<a href="?page=<?= $page + 1 ?>"><button class="btn-edit-page next-page">Следующая странциа</button></a>
					<?php endif; ?>
				</div>
			</div>

		</div>
	</main>

	<!-- Подключение разметки навигационной панели -->

	<?php require '../../include/footer_am.php' ?>

	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	<script src="/saycheese/assets/scripts/open_nav.js" defer></script>
	<script src="/saycheese/assets/scripts/ajax/edit-order-status.js" defer></script>

</body>

</html>
