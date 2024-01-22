<?php

	session_start();
	require '../../../app/include/querys.php';
	require '../../../app/controllers/general/user_login_check.php';

	$id_user = $_SESSION['id'];

	$products = SelectProductsFromBasket("basket", "product", $id_user);
	$count = 0;
	$total_price = 0;
	for ($i = 0; $i < count($products); $i++) {
		$count += $products[$i]['count'];
		$total_price += $products[$i]['price'] * $products[$i]['count'];
	}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Say Cheese - Корзина</title>
	<link rel="icon" href="/saycheese/saycheese.ico">
	<link rel="stylesheet" href="/saycheese/assets/styles/client/basket/basket.css">
</head>

<body>

	<!-- Подключение разметки навигационной панели -->

	<?php require '../../include/nav.php' ?>

	<!-- Получение разметки блока с сообщением о статусе операции -->

	<?php require '../../include/message.php' ?>

	<!-- Отображение ошибки -->

	<?php require '../../include/message_error.php' ?>

	<!-- Основной контент -->

	<main class="basket-content">
		<div class="basket-wrapper">
			<div class="basket-headline-block">
				<h1 class="basket-headline">Корзина (<?=$count?>)</h1>
				<p class="del_all_basket">Удалить все тоавры из корзины</p>
			</div>

			<!-- Товары из корзины -->

			<div class="basket-main-block">
				<div class="basket-items-block">
					<div class="basket-items-list">
						<?php if($count == 0) : ?>
							<div class="basket-no-items-block">
								<div class="basket-no-item-wrapper">
									<div class="basket-no-item-img"></div>
									<p class="basket-no-items">Корзина пустая...</p>
								</div>			
							</div>
						<?php else : ?>
							<?php for ($i = 0; $i < count($products); $i++) : ?>
								<div class="basket-item">
									<div class="item-img-block">
										<div class="item-img" style="background-image: url(/saycheese/assets/images/catalog/<?= $products[$i]['photo'] ?>);">
										</div>
									</div>
									<div class="item-info-block">
										<div class="item-name-block">
											<h1 class="item-name"><?= $products[$i]['name'] ?></h1>
										</div>
										<div class="item-price-block">
											<p class="item-price"><?= $products[$i]['price'] ?> ₽</p>
										</div>
									</div>
									<div class="item-btns-block">
										<div class="btn-remove-one" id="<?=$products[$i]['id']?>">
											<p class="btn-text">-</p>
										</div>
										<div class="btn-add-one" id="<?=$products[$i]['id']?>">
											<p class="btn-text">+</p>
										</div>
										<div class="basket-items-count-block">
											<p class="basket-item-count">x<?=$products[$i]['count']?></p>
										</div>
									</div>
								</div>
							<?php endfor; ?>
						<?php endif; ?>
					</div>
				</div>

				<!-- Форма создания заказа -->

				<div class="create-order-block">
					<div class="create-order-content">
						<div class="total-price-block">
							<p class="total-price"><?=$total_price?> ₽</p>
						</div>
						<div class="create-order-form">
							<div class="create-order-headline-block">
								<h2 class="create-order-headline">Оформить заказ</h2>
							</div>
							<form method="POST" id="create-order-form" onsubmit="return false">
								<input type="text" name="city" placeholder="Город">
								<br><input type="text" name="street" placeholder="Улица">
								<br><input type="text" name="house" placeholder="Дом">
								<br><input type="number" name="flat" placeholder="Этаж">
								<br><input type="number" name="apartament" placeholder="Квартира">
								<br><input type="text" name="intercom" placeholder="Домофон">
								<br><input type="text" name="index" placeholder="Индекс">
								<br><input type="hidden" name="create-order">
								<br><input type="radio" checked class="input-radio" id="input-radio1" name="type_of_pay" value="Оплата онлайн"><label for="input-radio1">Оплата онлайн</label>
								<input type="radio" class="input-radio" id="input-radio2" name="type_of_pay" value="Оплата при получении"><label for="input-radio2">Оплата при получении</label>
								<?php if($count == 0) : ?>
									<button disabled type="submit" name="order" class="btn_create_order">Оформить</button>
								<?php else: ?>
									<button type="submit" name="order" class="btn_create_order">Оформить</button>
								<?php endif; ?>
							</form>
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
	<script src="/saycheese/assets/scripts/close_error.js"></script>
	<script src="/saycheese/assets/scripts/ajax/edit-basket.js"></script>
	<script src="/saycheese/assets/scripts/ajax/create_order.js"></script>

</body>

</html>