<?php 

	session_start();
	require '../../../app/include/querys.php';
	require '../../../app/controllers/general/user_login_check.php';
	$studios = Select("photostudio");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Say Cheese - Страница фотостудии</title>
	<link rel="icon" href="/saycheese/saycheese.ico">
	<link rel="stylesheet" href="/saycheese/assets/styles/client/photostudio/photostudios.css">
</head>
<body>

	<!-- Подключение разметки навигационной панели -->

	<?php require '../../include/nav.php'; ?>

	<!-- Получение разметки блока с сообщением о статусе операции -->

	<?php require '../../include/message.php' ?>

	<main class="photostudios-content">
		<div class="photostudios-wrapper">
			<div class="photostudios-headline-block">
				<h1 class="photostudios-headline">Фотостудии</h1>
			</div>
			<div class="photostudio-items-list">
				<?php for($i = 0; $i < count($studios); $i++) : ?>
					<?php $studio_img = Select("photostudio_image", ["id_photostudio" => ["=", $studios[$i]['id']]], 1) ?>
					<div class="photostudio-item">
						<div class="photostudio-item-img" style="background-image: url(/saycheese/assets/images/studios/<?=$studio_img[0]['image']?>);">
						</div>
						<div class="photostudio-item-info-block">
							<div class="photostudio-item-name-price-block">
								<h1 class="photostudio-item-name"><?=$studios[$i]['name']?></h1>
								<h2 class="photostudio-item-price"><?=$studios[$i]['price']?> руб. в час</h2>
							</div>
							<div class="photostudio-item-address-block">
								<h2 class="photostudio-item-address"><?=$studios[$i]['address']?></h2>
							</div>
						</div>
						<div class="photostudio-item-btns-block">
							<div class="photostudio-btn-show-more">
								<a class="btn-link" href="/saycheese/pages/client/photostudio/photostudio_page.php?id_photostudio=<?=$studios[$i]['id']?>"><p class="btn-text">Подробнее</p></a>
							</div>
						</div>
					</div>
				<?php endfor ; ?>
			</div>
		</div>
	</main>

	<!-- Подключение разметки футера -->

	<?php require '../../include/footer.php' ?>
	
	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	<script src="/saycheese/assets/scripts/open_nav.js" defer></script>
</body>
</html>