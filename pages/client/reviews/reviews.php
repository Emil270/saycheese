<?php

session_start();
require '../../../app/include/querys.php';
require '../../../app/controllers/general/user_login_check.php';

require '../../../app/controllers/client/reviews.php';

?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Say Cheese - Мои отзывы</title>
	<link rel="icon" href="/saycheese/saycheese.ico">
	<link rel="stylesheet" href="/saycheese/assets/styles/client/reviews/reviews.css">
	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
</head>

<body>

	<!-- Подключение разметки навигационной панели -->

	<?php require '../../include/nav.php' ?>

	<?php if ($error !== "") : ?>
		<?php require '../../include/message_error.php' ?>
		<?php $error = ""; ?>
	<?php endif; ?>

	<!-- Получение разметки блока с сообщением о статусе операции -->

	<?php require '../../include/message.php' ?>

	<!-- Проверка успешности операции (вывод сообщения об успехе) -->

	<?php if($success !== ""): ?>
		<script>
			$('.message-block').fadeOut(0);
			$('.message-block').css('display', 'flex');
			$('.message').text("Успешно!");
			$('.message-block').delay(800).fadeOut();
		</script>
		<?php $success = ""; ?>
	<?php endif; ?>

	<!-- Форма для добавления нового отзыва -->

	<div class="add-review-wrapper">
		<div class="add-review-block">
			<p class="btn-close-add-review">×</p>
			<div class="add-review-headline-block">
				<h2 class="add-review-headline">Оставить свой отзыв</h2>
			</div>
			<form method="post" action="reviews.php" class="add-review-form">
				<textarea name="text" class="review_text" placeholder="Текст отзыва"></textarea>
				<button name="add_review" type="submit" class="btn-add-review">
					<p class="btn-text">Оставить</p>
				</button>
			</form>
		</div>
	</div>
	</div>

	<!-- Основной контент -->

	<main class="reviews-content">
		<div class="reviews-wrapper">
			<div class="reviews-headline-block">
				<h1 class="reviews-headline">Отзывы</h1>
				<p class="btn-open-add-review">Оставить свой отзыв</p>
			</div>
			<div class="reviews-list-block">
				<div class="reviews-list-items">
					<?php for ($i = 0; $i < count($reviews); $i++) : ?>
						<div class="review-item">
							<?php if ($reviews[$i]['avatar'] == "") : ?>
								<div class="review-author-avatar" style="background-image: url(/saycheese/assets/images/avatars/no_avatar.png);"></div>
							<?php else : ?>
								<div class="review-author-avatar" style="background-image: url(/saycheese/assets/images/avatars/<?= $reviews[$i]['avatar'] ?>);"></div>
							<?php endif; ?>
							<div class="review-info-block">
								<div class="review-date-block">
									<p class="review-date"><?= $reviews[$i]['date'] ?></p>
								</div>
								<div class="review-author-fullname-block">
									<p class="review-author-fullname"><?= $reviews[$i]['name'] . " " . $reviews[$i]['surname'] ?></p>
								</div>
								<div class="review-text-block">
									<p class="review-text"><?= $reviews[$i]['text'] ?></p>
								</div>
							</div>
						</div>
					<?php endfor; ?>
				</div>
			</div>

			<!-- Пагинация (кнопки вперед назад :D) -->

			<div class="pagination-block">
				<div class="btn_pages_block">
					<?php if ($page == 1) : ?>
						<a href="?page=<?= $page - 1 ?>"><button disabled class="btn-edit-page prev-page">Предыдущая странциа</button></a>
					<?php else : ?>
						<a href="?page=<?= $page - 1 ?>"><button class="btn-edit-page prev-page">Предыдущая странциа</button></a>
					<?php endif; ?>
					<?php if ($page == $max_page) : ?>
						<a href="?page=<?= $page + 1 ?>"><button disabled class="btn-edit-page next-page">Следующая странциа</button></a>
					<?php else : ?>
						<a href="?page=<?= $page + 1 ?>"><button class="btn-edit-page next-page">Следующая странциа</button></a>
					<?php endif; ?>
				</div>
			</div>

		</div>
	</main>

	<!-- Подключение разметки навигационной панели -->

	<?php require '../../include/footer.php' ?>

	<script src="/saycheese/assets/scripts/open_nav.js" defer></script>
	<script src="/saycheese/assets/scripts/form-add-review.js" defer></script>
	<script src="/saycheese/assets/scripts/close_error.js" defer></script>

</body>

</html>