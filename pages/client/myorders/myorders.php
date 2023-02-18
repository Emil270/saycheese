<?php

session_start();
require '../../../app/include/querys.php';
require '../../../app/controllers/general/user_login_check.php';

$id_user = $_SESSION['id'];
$myorders = Select("orderr", ["id_user" => ["=", $id_user]], 0, 0, "id");

require '../../../app/controllers/client/myorder.php';

?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Say Cheese - Мои заказы</title>
	<link rel="icon" href="/saycheese/saycheese.ico">
	<link rel="stylesheet" href="/saycheese/assets/styles/client/myorders/myorders.css">
</head>

<body>

	<!-- Подключение разметки навигационной панели -->

	<?php require '../../include/nav.php' ?>

	<!-- Основной контент -->

	<main class="my-orders-content">
		<div class="my-orders-wrapper">
			<div class="my-orders-headline-block">
				<h1 class="my-orders-headline">Мои заказы</h1>
			</div>

			<!-- Поиск заказов но номеру -->

			<div class="my-orders-search-block">
				<form action="myorders.php" method="post">
					<input type="text" name="code" value="<?= $code ?>" class="my-orders-search" placeholder="Поиск по номеру заказа">
					<button type="submit" name="search_order_by_code" class="btn-go-search">Применить</button>
				</form>
			</div>

			<!-- Список заказов -->

			<div class="my-orders-list">
				<?php if (count($myorders) == 0) : ?>
					<div class="my-orders-no-items-block">
						<div class="my-orders-no-item-wrapper">
							<div class="my-orders-no-item-img"></div>
							<p class="my-orders-no-items">Здесь пусто...</p>
						</div>
					</div>
				<?php endif; ?>
				<?php for ($i = 0; $i < count($myorders); $i++) : ?>
					<div class="my-order-block">
						<div class="my-order-wrapper">
							<div class="my-order-headline-block">
								<h1 class="my-order-headline">Заказ № <?= $myorders[$i]['code'] ?></h1>
							</div>
							<div class="my-order-inform-block">
								<p class="my-order-inform">Дата создания заказа: <?= $myorders[$i]['date'] ?></p>
								<p class="my-order-inform">Адрес отправки: г. <?= $myorders[$i]['city'] ?>, ул. <?= $myorders[$i]['street'] ?>, д. <?= $myorders[$i]['house'] ?>, кв. <?= $myorders[$i]['apartament'] ?></p>
								<p class="my-order-inform">Домофон: <?= $myorders[$i]['intercom'] ?></p>
								<p class="my-order-inform">Почтовый индекс: <?= $myorders[$i]['indexx'] ?></p>
								<p class="my-order-inform">Сумма заказа: <?= $myorders[$i]['total_price'] ?> ₽</p>
								<p class="my-order-inform my-order-status">Статус заказа: <?= $myorders[$i]['status'] ?></p>
							</div>
							<div class="my-order-positions-block">
								<h2 class="my-order-positioms-headline">Позиции заказа:</h2>
								<?php $myorder_positions = SelectProductsFromOrder("orders_product", "product", $myorders[$i]['id']); ?>
								<ol class="my-order-positions-list">
									<?php for ($j = 0; $j < count($myorder_positions); $j++) : ?>
										<a href="/saycheese/pages/client/catalog/catalog_item.php?id_product=<?= $myorder_positions[$j]['id'] ?>">
											<li class="my-order-position"><?= $j + 1 ?>. <?= $myorder_positions[$j]['name'] ?> (x<?= $myorder_positions[$j]['count'] ?>)</li>
										</a>
									<?php endfor; ?>
								</ol>
							</div>
						</div>
					</div>
				<?php endfor; ?>
			</div>
		</div>
	</main>

	<!-- Подключение разметки навигационной панели -->

	<?php require '../../include/footer.php' ?>

	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	<script src="/saycheese/assets/scripts/open_nav.js" defer></script>

</body>

</html>