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
</head>

<body>

	<!-- Подключение разметки навигационной панели -->

	<?php require '../../include/nav.php' ?>

	<?php require '../../include/message_error.php' ?>

	<!-- Получение разметки блока с сообщением о статусе операции -->

	<?php require '../../include/message.php' ?> 

	<!-- Форма для добавления нового отзыва -->

	<div class="add-review-wrapper">
		<div class="add-review-block">
			<p class="btn-close-add-review">×</p>
			<div class="add-review-headline-block">
				<h2 class="add-review-headline">Оставить свой отзыв</h2>
			</div>
			<form method="post" id="add-review-form" onsubmit="return false">
				<textarea name="text" class="review_text" placeholder="Текст отзыва"></textarea>
				<input type="hidden" name="add-review">
				<button type="submit" class="btn-add-review">
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
				<?php if(isset($_COOKIE['user_login'])): ?>
					<p class="btn-open-add-review">Оставить свой отзыв</p>
				<?php else: ?>
					<p class="no-login">Оставить свой отзыв</p>
				<?php endif; ?>
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

	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	<script src="/saycheese/assets/scripts/open_nav.js"></script>
	<script src="/saycheese/assets/scripts/form-add-review.js"></script>
	<script src="/saycheese/assets/scripts/close_error.js"></script>
	<script src="/saycheese/assets/scripts/ajax/add_review.js"></script>
	<script src="/saycheese/assets/scripts/no-login-btn.js"></script>

</body>

</html>