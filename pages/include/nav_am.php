
<!-- Навигационная панель для админов и модераторов -->

<div class="nav-panel">
	<div class="nav-panel-links-contnent">
		<div class="nav-panel-links-wrapper">
			<div class="nav-panel-links">
				<a href="<?=SITE_URL?>pages/admin-moderator/profile/profile.php"><div class="link nav-link1">ПРОФИЛЬ</div></a>
				<a href="<?=SITE_URL?>pages/admin-moderator/catalog/catalog.php"><div class="link nav-link2">ТОВАРЫ</div></a>
				<a href="<?=SITE_URL?>pages/admin-moderator/orders/orders.php"><div class="link nav-link3">ЗАКАЗЫ</div></a>
				<a href="<?=SITE_URL?>pages/admin-moderator/reviews/reviews.php"><div class="link nav-link4">ОТЗЫВЫ</div></a>
				<?php if($_SESSION['role'] == "Администратор"): ?>
					<a href="<?=SITE_URL?>pages/admin-moderator/moderators/moderators.php"><div class="link nav-link6">МОДЕРАТОРЫ</div></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<nav>
	<div class="nav-left">
		<a href="<?=SITE_URL?>pages/admin-moderator/profile/profile.php">
			<div class="nav-headline-block">
				<h1 class="nav-headline">say <span>cheese</span></h1>
			</div>
	</div>
	</a>
	<div class="nav-rigth">
		<div class="btn-open-nav-block">
			<div class="btn-open-nav">
				<div class="btn-nav-lines"></div>
			</div>
		</div>
	</div>
</nav>