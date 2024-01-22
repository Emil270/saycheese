<?php

session_start();
require '../../../app/include/querys.php';
require '../../../app/controllers/general/user_login_check.php';

?>

<!DOCTYPE html>
<html lang="ru"> 

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Say Cheese - Профиль</title>
	<link rel="icon" href="/saycheese/saycheese.ico">
	<link rel="stylesheet" href="/saycheese/assets/styles/client/profile/profile.css">
</head>

<body>

	<!-- Подключение разметки навигационной панели -->

	<?php require '../../include/nav.php' ?>

	<!-- Основной контент -->

	<main class="profile-content">
		<div class="profile-wrapper">
			<div class="profile-headline-block">
				<h1 class="profile-headline">Профиль</h1>
				<a class="edit_profile" href="/saycheese/pages/general/edit_profile.php"><p class="edit_profile_text">Редактировтаь профиль</p></a>
			</div>
			<div class="profile-card-block">
				<div class="profile-avatar-block">
					<div class="profile-avatar-wrapper">
						<?php if($_SESSION['avatar'] == ""): ?>
							<div class="profile-avatar" style="background-image:url(/saycheese/assets/images/avatars/no_avatar.png);"></div>
						<?php else: ?>
							<div class="profile-avatar" style="background-image:url(/saycheese/assets/images/avatars/<?=$_SESSION['avatar']?>);"></div>
						<?php endif; ?>
					</div>
				</div>
				<div class="profile-info-block">
					<div class="profile-info-wrapper">
						<h2 class="profile-info profile-fullname"><?=$_SESSION['name'] . " " . $_SESSION['surname']?></h2>
						<p class="profile-info profile-email">Электронная почта: <?=$_SESSION['email']?></p>
						<p class="profile-info profile-phone">Номер телефона: <?=$_SESSION['phone']?></p>
						<a href="/saycheese/app/controllers/general/exit.php"><p class="profile-info profile-exit">Выйти из аккаунта</p></a>
					</div>
				</div>
			</div>
		</div>
	</main>

	<!-- Подключение разметки навигационной панели -->

	<?php require '../../include/footer.php' ?>

	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	<script src="/saycheese/assets/scripts/open_nav.js" defer></script>

</body>
</html>