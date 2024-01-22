<?php

session_start();
require '../../../app/include/querys.php';
require '../../../app/controllers/general/staff_login_check.php';

require '../../../app/controllers/admin-moderator/staff.php'; 

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Say Cheese - Сотрудники</title>
	<link rel="icon" href="/saycheese/saycheese.ico">
	<link rel="stylesheet" href="/saycheese/assets/styles/admin-moderator/staff/staff.css">
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
			<div class="staff-headline-block">
				<h1 class="staff-headline">Сотрудники</h1>
				<a href="add_staff.php" class="btn-add-staff">
					<p class="btn-add-staff">Добавить нового сотрудника</p>
				</a>
			</div>

			<!-- Поиск по фамилии -->

			<div class="staff-search-block">
				<form action="staff.php" method="get">
					<input type="text" name="surname" value="<?= $surname_search ?>" class="staff-search" placeholder="Поиск по фамилии">
					<select name="role" class="staff-search-by-role">
						<?php if($role_search == "all"): ?>
							<option selected value="all">Все сотрудники</option>
						<?php else: ?>
							<option value="all">Все сотрудники</option>
						<?php endif; ?>
						<?php if($role_search == "Модератор"): ?>
							<option selected value="Модератор">Модераторы</option>
						<?php else: ?>
							<option value="Модератор">Модераторы</option>
						<?php endif; ?>
						<?php if($role_search == "Фотограф"): ?>
							<option selected value="Фотограф">Фотографы</option>
						<?php else: ?>
							<option value="Фотограф">Фотографы</option>
						<?php endif; ?>
						<?php if($role_search == "Специалист по обработке фотографий"): ?>
							<option selected value="Специалист по обработке фотографий">Специалисты по обработке фотографий</option>
						<?php else: ?>
							<option value="Специалист по обработке фотографий">Специалисты по обработке фотографий</option>
						<?php endif; ?>
					</select>
					<button type="submit" name="staff_search" class="btn-go-search">Применить</button>
				</form>
			</div>

			<!-- Список специалистов -->

			<div class="staff-list-block">
				<?php for($i = 0; $i < count($staff); $i++): ?>
					<div class="staff-block">
						<div class="staff-avatar-block">
							<?php if($staff[$i]['avatar'] == ""): ?>
								<div class="staff-avatar" style="background-image: url(/saycheese/assets/images/avatars/no_avatar.png);"></div>
							<?php else: ?>
								<div class="staff-avatar" style="background-image: url(/saycheese/assets/images/avatars/<?=$staff[$i]['avatar']?>)"></div>
							<?php endif; ?>
						</div>
						<div class="staff-info-block">
							<div class="staff-info-wrapper">
								<h2 class="staff-fullname"><?= $staff[$i]['name'] . " " . $staff[$i]['surname'] ?> <span class="role"><?=" (" . $staff[$i]['role'] . ")"?></span> </h2>
								<p class="staff-email">Эл. почта: <?= $staff[$i]['email'] ?></p>
							</div>
						</div>
						<div class="staff-delete-block">
							<form class="staff-delete-form" method="post" action="staff.php">
								<button type="submit" name="staff_delete" value="<?=$staff[$i]['id']?>" class="btn_del_staff">
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