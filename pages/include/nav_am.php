
<!-- Навигационная панель для админов и модераторов -->

<div class="nav-wrapper">
	<div class="close-nav-field"></div>
	<div class="nav-panel">
		<div class="nav-panel-links-contnent">
			<div class="nav-panel-links-wrapper">
				<div class="nav-panel-links">
					<a href="<?=SITE_URL?>pages/admin-moderator/profile/profile.php"><div class="link nav-link1">ПРОФИЛЬ</div></a>
					<?php if($_SESSION['role'] == "Администратор"): ?>
						<a href="<?=SITE_URL?>pages/admin-moderator/staff/staff.php"><div class="link nav-link2">СОТРУДНИКИ</div></a>
						<a href="<?=SITE_URL?>pages/admin-moderator/reports/reports.php"><div class="link nav-link2">ОТЧЁТЫ</div></a>
					<?php endif; ?>
					<a href="<?=SITE_URL?>pages/admin-moderator/booking/booking_list.php"><div class="link nav-link2">БРОНЬ ФОТОСТУДИЙ</div></a>
					<a href="<?=SITE_URL?>pages/admin-moderator/catalog/catalog.php"><div class="link nav-link2">ТОВАРЫ</div></a>
					<a href="<?=SITE_URL?>pages/admin-moderator/orders/orders.php"><div class="link nav-link3">ЗАКАЗЫ</div></a>
					<a href="<?=SITE_URL?>pages/admin-moderator/reviews/reviews.php"><div class="link nav-link4">ОТЗЫВЫ</div></a>
					<a href="<?=SITE_URL?>pages/admin-moderator/requests/requests_to_photographer.php"><div class="link nav-link3">ЗАЯВКИ (ФОТОГРАФ)</div></a>
					<a href="<?=SITE_URL?>pages/admin-moderator/requests/requests_to_photoshop.php"><div class="link nav-link4">ЗАЯВКИ (ФОТОШОП)</div></a>
				</div>
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
		</a>
		<div class="contacts-block">
			<p class="contacts">+7 (965) 602-73-74</p>
		</div>
	</div>
	<div class="nav-rigth">
		<div class="btn-open-nav-block">
			<div class="btn-open-nav">
				<div class="btn-nav-lines"></div>
			</div>
		</div>
	</div>
</nav>