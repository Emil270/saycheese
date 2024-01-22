<?php

session_start();
require '../../../app/include/querys.php';
require '../../../app/controllers/general/staff_login_check.php';

//require '../../../app/controllers/admin-moderator/add_edit_product.php';
$types = Select("type");

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Say Cheese - Добавить товар</title>
	<link rel="icon" href="/saycheese/saycheese.ico">
	<link rel="stylesheet" href="/saycheese/assets/styles/admin-moderator/catalog/add_product.css">
</head>

<body>

	<!-- Подключение разметки навигационной панели -->

	<?php require '../../include/nav_am.php' ?>

	<!-- Получение разметки блока с сообщением об ошибке -->

	<?php require '../../include/message_error.php' ?>

	<!-- Получение разметки блока с сообщением о статусе операции -->

	<?php require '../../include/message.php' ?>

	<!-- Основной контент -->

	<main class="content">
		<div class="wrapper">
			<div class="headline-block">
				<h1 class="headline">Добавить новый товар</h1>
			</div>
			<div class="add-product-form-block">
				<div class="add-product-form-wrapper">
					<form method="post" id="add_product" onsubmit="return false" enctype="multipart/form-data">
						<input type="text" name="name" placeholder="Название товара">
						<br><textarea name="description" placeholder="Описание"></textarea>
						<br><input type="number" name="price" placeholder="Цена товара">
						<br><input type="number" name="count" placeholder="Количество товара">
						<br><label class="input-file">
							<input type="file" name="photo" accept=".jpg,.jpeg,.png">
							<span>Выберите фото</span>
						</label>
						<p class="label-type">Выберите тип камеры</p>
						<br><select name="type" class="select-type">
							<?php for ($i = 0; $i < count($types); $i++) : ?>
								<option value="<?= $types[$i]['id'] ?>"><?= $types[$i]['type'] ?></option>
							<?php endfor; ?>
						</select>
						<br><input type="number" step=0.01 name="num_megapix" placeholder="Число мегапикселей">
						<br><input type="text" name="max_resolution" placeholder="Максимальное разрешение">
						<br><input type="text" name="shooting_video" placeholder="Разрешение съемки видео (если имеется)">
						<br><input type="text" name="sensitivity" placeholder="Чувствительность">
						<br><input type="text" name="excerpt" placeholder="Выдержка">
						<br><input type="text" name="focusing" placeholder="Фокусировка">
						<br><input type="text" name="shooting_mode" placeholder="Режим съемки">
						<br><input type="text" name="screen" placeholder="Экран">
						<br><input type="text" name="security" placeholder="Защищенность">
						<br><input type="text" name="interfaces" placeholder="Интерфейсы">
						<br><input type="number" name="battary_capacity" placeholder="Емколсть аккумулятора (в количестве фотографий)">
						<input type="hidden" name="add-product">
						<button type="submit" class="btn_add_product">
							<p class="btn-text">Добавить</p>
						</button>
					</form>
				</div>
			</div>
		</div>
	</main>

	<!-- Подключение разметки футера -->

	<?php require '../../include/footer_am.php' ?>

	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	<script src="/saycheese/assets/scripts/open_nav.js"></script>
	<script src="/saycheese/assets/scripts/close_error.js"></script>
	<script src="/saycheese/assets/scripts/input_file.js"></script>
	<script src="/saycheese/assets/scripts/ajax/add_product.js"></script>

</body>

</html>