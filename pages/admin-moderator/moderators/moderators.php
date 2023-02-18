<?php

session_start();
require '../../../app/include/querys.php';
require '../../../app/controllers/general/user_login_check.php';

require '../../../app/controllers/admin-moderator/moderators.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Say Cheese - Модераторы</title>
	<link rel="icon" href="/saycheese/saycheese.ico">
	<link rel="stylesheet" href="/saycheese/assets/styles/admin-moderator/moderators/moderators.css">
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
			<div class="moderators-headline-block">
				<h1 class="moderators-headline">Модераторы</h1>
				<a href="add_moderator.php" class="btn-add-moderator">
					<p class="btn-add-moderator">Добавить нового модератора</p>
				</a>
			</div>

			<!-- Поиск по фамилии -->

			<div class="moderators-search-block">
				<form action="moderators.php" method="post">
					<input type="text" name="surname" value="<?= $surname_search ?>" class="moderators-search" placeholder="Поиск по фамилии">
					<button type="submit" name="moderators_search" class="btn-go-search">Применить</button>
				</form>
			</div>

			<!-- Список модераторов -->

			<div class="moderators-list-block">
				<?php for($i = 0; $i < count($moderators); $i++): ?>
					<div class="moderator-block">
						<div class="moderator-avatar-block">
							<?php if($moderators[$i]['avatar'] == ""): ?>
								<div class="moderator-avatar" style="background-image: url(/saycheese/assets/images/avatars/no_avatar.png);"></div>
							<?php else: ?>
								<div class="moderator-avatar" style="background-image: url(/saycheese/assets/images/avatars/<?=$moderators[$i]['avatar']?>)"></div>
							<?php endif; ?>
						</div>
						<div class="moderator-info-block">
							<div class="moderator-info-wrapper">
								<h2 class="moderator-fullname"><?= $moderators[$i]['name'] . " " . $moderators[$i]['surname'] ?></h2>
								<p class="moderator-email">Эл. почта: <?= $moderators[$i]['email'] ?></p>
							</div>
						</div>
						<div class="moderatoe-delete-block">
							<form class="moderator-delete-form" method="post" action="moderators.php">
								<button type="submit" name="moderator_delete" value="<?=$moderators[$i]['id']?>" class="btn_del_moderator">
									<p class="btn-text">×</p>
								</button>
							</form>
						</div>
					</div>
				<?php endfor; ?>
			</div>

		</div>
	</main>

	<!-- Подключение разметки футера -->

	<?php require '../../include/footer_am.php' ?>

	<script src="/saycheese/assets/scripts/open_nav.js" defer></script>

</body>
</html>