<?php

session_start();
require '../../../app/include/querys.php';
require '../../../app/controllers/general/user_login_check.php';

if (!isset($_COOKIE['user_login'])) {
	header("Location: /saycheese/pages/general/login.php");
}

require '../../../app/controllers/admin-moderator/add_edit_product.php';
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
	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
</head>

<body>

	<!-- Подключение разметки навигационной панели -->

	<?php require '../../include/nav_am.php' ?>

	<!-- Получение разметки блока с сообщением об ошибке -->

	<?php if ($error != "") : ?>
		<?php require '../../include/message_error.php' ?>
		<?php $error = ""; ?>
	<?php endif; ?>

	<!-- Получение разметки блока с сообщением о статусе операции -->

	<?php require '../../include/message.php' ?>

	<!-- Проверка успешности операции (вывод сообщения об успехе) -->

	<?php if ($success !== "") : ?>
		<script>
			$('.message-block').fadeOut(0);
			$('.message-block').css('display', 'flex');
			$('.message').text("Успешно!");
			$('.message-block').delay(800).fadeOut();
		</script>
		<?php $success = ""; ?>
	<?php endif; ?>

	<!-- Основной контент -->

	<main class="content">
		<div class="wrapper">
			<div class="headline-block">
				<h1 class="headline">Изменить информацию о товаре</h1>
			</div>
			<div class="add-product-form-block">
				<div class="add-product-form-wrapper">
					<form method="post" action="edit_product.php" enctype="multipart/form-data">
						<input type="hidden" name="id_product_to_edit" value="<?=$id_product_to_edit?>">
						<input type="text" name="name" value="<?=$name?>" placeholder="Название товара">
						<br><textarea name="description" placeholder="Описание"><?=$description?></textarea>
						<br><input type="number" name="price" value="<?=$price?>" placeholder="Цена товара">
						<br><input type="number" name="count" value="<?=$count?>" placeholder="Количество товара">
						<br><label class="input-file">
							<input type="file" name="photo" accept=".jpg,.jpeg,.png">
							<span>Выберите фото</span>
						</label>
						<p class="label-type">Выберите тип камеры</p>
						<br><select name="type" class="select-type">
							<?php for ($i = 0; $i < count($types); $i++) : ?>
								<option value="<?= $types[$i]['id'] ?>" <?php if ($type == (string)$types[$i]['id']) { echo "selected"; } ?>><?= $types[$i]['type'] ?></option>
							<?php endfor; ?>
						</select>
						<br><input type="number" step=0.01 name="num_megapix" value="<?=$num_megapix?>" placeholder="Число мегапикселей">
						<br><input type="text" name="max_resolution" value="<?=$max_resolution?>" placeholder="Максимальное разрешение">
						<br><input type="text" name="shooting_video" value="<?=$shooting_video?>" placeholder="Разрешение съемки видео (если имеется)">
						<br><input type="text" name="sensitivity" value="<?=$sensitivity?>" placeholder="Чувствительность">
						<br><input type="text" name="excerpt" value="<?=$excerpt?>" placeholder="Выдержка">
						<br><input type="text" name="focusing" value="<?=$focusing?>" placeholder="Фокусировка">
						<br><input type="text" name="shooting_mode" value="<?=$shooting_mode?>" placeholder="Режим съемки">
						<br><input type="text" name="screen" value="<?=$screen?>" placeholder="Экран">
						<br><input type="text" name="security" value="<?=$security?>" placeholder="Защищенность">
						<br><input type="text" name="interfaces" value="<?=$interfaces?>" placeholder="Интерфейсы">
						<br><input type="number" name="battary_capacity" value="<?=$battary_capacity?>" placeholder="Емколсть аккумулятора (в количестве фотографий)">
						<button type="submit" name="edit_product" class="btn_add_product">
							<p class="btn-text">Изменить</p>
						</button>
					</form>
				</div>
			</div>
		</div>
	</main>

	<!-- Подключение разметки футера -->

	<?php require '../../include/footer_am.php' ?>

	<script src="/saycheese/assets/scripts/open_nav.js" defer></script>
	<script src="/saycheese/assets/scripts/close_error.js" defer></script>
	<script src="/saycheese/assets/scripts/input_file.js" defer></script>

</body>

</html>