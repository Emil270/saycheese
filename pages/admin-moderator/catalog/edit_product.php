<?php

session_start();
require '../../../app/include/querys.php';
require '../../../app/controllers/general/staff_login_check.php';

$id_product_to_edit = $_GET['id_product_to_edit'];
if(!is_numeric($id_product_to_edit) || $id_product_to_edit < 0 || $id_product_to_edit == ""){
	header("Location: /saycheese/pages/general/error404.php");
	exit();
}
$product = SelectAllInfoAboutProduct("product", "charact_product", "type", $id_product_to_edit);
if(empty($product)){
	header("Location: /saycheese/pages/general/error404.php");
	exit();
}
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
				<h1 class="headline">Изменить информацию о товаре</h1>
			</div>
			<div class="add-product-form-block">
				<div class="add-product-form-wrapper">
					<form method="post" id="edit_product_form" enctype="multipart/form-data" onsubmit="return false">
						<input type="hidden" name="edit-product">
						<input type="hidden" name="id_product_to_edit" value="<?=$id_product_to_edit?>">
						<input type="text" name="name" value="<?=$product['name']?>" placeholder="Название товара">
						<br><textarea name="description" placeholder="Описание"><?=$product['description']?></textarea>
						<br><input type="number" name="price" value="<?=$product['price']?>" placeholder="Цена товара">
						<br><input type="number" name="count" value="<?=$product['count']?>" placeholder="Количество товара">
						<br><label class="input-file">
							<input type="file" name="photo" accept=".jpg,.jpeg,.png">
							<span>Выберите фото</span>
						</label>
						<p class="label-type">Выберите тип камеры</p>
						<br><select name="type" class="select-type">
							<?php for ($i = 0; $i < count($types); $i++) : ?>
								<option value="<?= $types[$i]['id'] ?>" <?php if ($product['id_type'] == (string)$types[$i]['id']) { echo "selected"; } ?>><?= $types[$i]['type'] ?></option>
							<?php endfor; ?>
						</select>
						<br><input type="number" step=0.01 name="num_megapix" value="<?=$product['num_megapix']?>" placeholder="Число мегапикселей">
						<br><input type="text" name="max_resolution" value="<?=$product['max_resolution']?>" placeholder="Максимальное разрешение">
						<br><input type="text" name="shooting_video" value="<?=$product['shooting_video']?>" placeholder="Разрешение съемки видео (если имеется)">
						<br><input type="text" name="sensitivity" value="<?=$product['sensitivity']?>" placeholder="Чувствительность">
						<br><input type="text" name="excerpt" value="<?=$product['excerpt']?>" placeholder="Выдержка">
						<br><input type="text" name="focusing" value="<?=$product['focusing']?>" placeholder="Фокусировка">
						<br><input type="text" name="shooting_mode" value="<?=$product['shooting_mode']?>" placeholder="Режим съемки">
						<br><input type="text" name="screen" value="<?=$product['screen']?>" placeholder="Экран">
						<br><input type="text" name="security" value="<?=$product['security']?>" placeholder="Защищенность">
						<br><input type="text" name="interfaces" value="<?=$product['interfaces']?>" placeholder="Интерфейсы">
						<br><input type="number" name="battary_capacity" value="<?=$product['battary_capacity']?>" placeholder="Емколсть аккумулятора (в количестве фотографий)">
						<button type="submit" class="btn_add_product">
							<p class="btn-text">Изменить</p>
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
	<script src="/saycheese/assets/scripts/ajax/edit_product.js"></script>

</body>

</html>