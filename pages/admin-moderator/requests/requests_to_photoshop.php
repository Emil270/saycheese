<?php

session_start();
require '../../../app/include/querys.php';
require '../../../app/controllers/general/staff_login_check.php';
require '../../../app/controllers/admin-moderator/requests_to_photoshop.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Say Cheese - Заявки на услуги обработки фотографий</title>
	<link rel="icon" href="/saycheese/saycheese.ico">
	<link rel="stylesheet" href="/saycheese/assets/styles/admin-moderator/requests/requests_to_photoshop.css">
</head>

<body>

	<!-- Подключение разметки навигационной панели -->

	<?php require '../../include/nav_am.php' ?>

	<!-- Получение разметки блока с сообщением о статусе операции -->

	<?php require '../../include/message.php' ?>

	<!-- Получение разметки блока с сообщением об ошибке --> 

	<?php require '../../include/message_error.php' ?>

	<!-- Скрытый блок с полным описанием заявки -->

	<div class="description-wrapper">
		<div class="description-block">
			<p class="close-description">×</p>
			<div class="description-content">
				<h2 class="desc-headline">Описание</h2>
				<p class="desc-text"></p>
			</div>
		</div>
	</div>

	<!-- Окошко для перенаправления заявки -->

	<div class="redirect-wrapper">
	<div class="redirect-block">
		<p class="close-redirect-block">×</p>
		<div class="redirect-block-content">
			<form method="POST" onsubmit="return false" id="redirect">
				<input name="id_request" type="hidden" id="id_request">
				<select name="specialist" class="specialist_list">
					<option value="0">Выберите специалиста</option>
					<?php for($i = 0; $i < count($specialists_list); $i++): ?>
						<option value="<?= $specialists_list[$i]['id'] ?>"><?= $specialists_list[$i]['name'] . str_repeat('&nbsp;', 3) . $specialists_list[$i]['count_processing'] . " | " . $specialists_list[$i]['count_completed'] ?></option>
					<?php endfor; ?>
				</select>
				<button type="submit" class="btn_redirect"><p class="btn-text">Перенаправить</p></button>
			</form>
		</div>
	</div>
</div>

	<!-- Основной контент -->

	<main class="content">
		<div class="wrapper">
			<div class="headline-block">
				<h1 class="headline">Заявки на услуги обработки фотографий</h1>
			</div>

			<!-- Фильтрация -->

			<div class="requests-search-block">
				<form action="" method="get">
					<select name="style" class="requests-search-by-style">
						<?php if($style == 0): ?>
							<option selected value=0>Все стили</option>
						<?php else: ?>
							<option value=0>Все стили</option>
						<?php endif; ?>
						<?php if($style == 1): ?>
							<option selected value=1>Ретушь</option>
						<?php else: ?>
							<option value=1>Ретушь</option>
						<?php endif; ?>
						<?php if($style == 2): ?>
							<option selected value=2>Замена фона</option>
						<?php else: ?>
							<option value=2>Замена фона</option>
						<?php endif; ?>
						<?php if($style == 3): ?>
							<option selected value=3>Удаление объектов</option>
						<?php else: ?>
							<option value=3>Удаление объектов</option>
						<?php endif; ?>
						<?php if($style == 4): ?>
							<option selected value=4>Коллажи</option>
						<?php else: ?>
							<option value=4>Коллажи</option>
						<?php endif; ?>
						<?php if($style == 5): ?>
							<option selected value=5>Художественная обработка</option>
						<?php else: ?>
							<option value=5>Художественная обработка</option>
						<?php endif; ?>
						<?php if($style == 6): ?>
							<option selected value=6>Реставрация</option>
						<?php else: ?>
							<option value=6>Реставрация</option>
						<?php endif; ?>
					</select>
					<button type="submit" name="requests_search" class="btn-go-search">Применить</button>
				</form>
			</div>

			<!-- Список заявок на услуги фотографа -->

			<div class="requests-list">
				<?php for ($i = 0; $i < count($requests); $i++) : ?>
					<?php
					$client = Select("client", ["id_user" => ["=", $requests[$i]['id_user']]]);
					$user = Select("user", ["id" => ["=", $requests[$i]['id_user']]]);			
					?>
					<div class="request-item">
						<div class="request-item-info-block">
							<div class="client-avatar-block">
								<?php if ($client[0]['avatar'] == null) : ?>
									<div class="client-avatar" style="background-image: url(/saycheese/assets/images/avatars/no_avatar.png);"></div>
								<?php else : ?>
									<div class="client-avatar" style="background-image: url(/saycheese/assets/images/avatars/<?= $client[0]['avatar'] ?>);"></div>
								<?php endif; ?>
							</div>
							<div class="client-info-block">
								<div class="client-info">
									<p class="client-name"><?= $client[0]['surname'] ?> <?= $client[0]['name'] ?></p>
									<p class="client-phone"><?= $user[0]['phone'] ?></p>
								</div>
							</div>
							<div class="photoshop-description-block">
								<p id="<?= $requests[$i]['description'] ?>" class="photoshop-description"><?=mb_substr($requests[$i]['description'], 0, 55, 'UTF-8') . "... подробнее"?></p>
							</div>
							<div class="photoshop-style-block">
								<p class="photoshop-style"><?= $requests[$i]['style'] ?></p>
							</div>
							<div class="photoshop-price-block">
								<p class="photoshop-price"><?= $requests[$i]['price'] ?> ₽</p>
							</div>
							<div class="btn-redirect-block">
								<div class="btn-redirect" id="<?= $requests[$i]['id'] ?>">
									<p class="btn-text">Перенаправить</p>
								</div>
							</div>
						</div>
						<div class="request-item-images-block">
							<?php 
								$images = Select("images_to_photoshop", ["id_request" => ["=", $requests[$i]['id']]]);
							?>
							<?php for($j = 0; $j < count($images); $j++): ?>
								<?php if(count($images) > 4): ?>
									<img src="/saycheese/assets/images/photoshop/<?=$images[$j]['image']?>" class="photoshop-image-many">
								<?php else: ?>
									<img src="/saycheese/assets/images/photoshop/<?=$images[$j]['image']?>" class="photoshop-image">
								<?php endif; ?>
							<?php endfor; ?>
						</div>
					</div>
				<?php endfor; ?>
				<?php if($empty != ""): ?>
					<div class="empty-error_block">
						<div class="empty-error-wrapper">
							<div class="empty-error-img"></div>
							<p class="empty-error-message">По данному запросу <br>ничего не найдено</p>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</main>

	<!-- Подключение разметки навигационной панели -->

	<?php require '../../include/footer_am.php' ?>

	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	<script src="/saycheese/assets/scripts/open_nav.js"></script>
	<script src="/saycheese/assets/scripts/redirect_win.js"></script>
	<script src="/saycheese/assets/scripts/get_description.js"></script>
	<script src="/saycheese/assets/scripts/close_error.js"></script>
	<script src="/saycheese/assets/scripts/ajax/redirect_photoshop_request.js"></script>

</body>

</html>