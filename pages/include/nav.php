

<!-- Навигационная панель -->

<div class="nav-wrapper">
	<div class="close-nav-field"></div>
	<div class="nav-panel">
		<div class="nav-panel-links-contnent">
			<div class="nav-panel-links-wrapper">
				<div class="nav-panel-links">
					<a href="<?= SITE_URL ?>index.php">
						<div class="link nav-link1">ГЛАВНАЯ</div>
					</a>
					<a href="<?= SITE_URL ?>pages/client/photostudio/photostudios.php">
						<div class="link nav-link1">ФОТОСТУДИИ</div>
					</a>
					<?php if (isset($_COOKIE['user_login'])) : ?>
						<a href="<?= SITE_URL ?>pages/client/my-booking/my_booking.php">
							<div class="link nav-link1">МОИ БРОНИ</div>
						</a>
					<?php endif; ?>
					<a href="<?= SITE_URL ?>pages/client/catalog/catalog.php">
						<div class="link nav-link2">КАТАЛОГ</div>
					</a>
					<?php if (isset($_COOKIE['user_login'])) : ?>
						<a href="<?= SITE_URL ?>pages/client/basket/basket.php">
							<div class="link nav-link3">КОРЗИНА</div>
						</a>
						<a href="<?= SITE_URL ?>pages/client/myorders/myorders.php">
							<div class="link nav-link4">МОИ ЗАКАЗЫ</div>
						</a>
					<?php endif; ?>
					<a href="<?= SITE_URL ?>pages/client/services/services.php">
						<div class="link nav-link4">УСЛУГИ</div>
					</a>
					<a href="<?= SITE_URL ?>pages/client/reviews/reviews.php">
						<div class="link nav-link6">ОТЗЫВЫ</div>
					</a>
					<?php if (isset($_COOKIE['user_login'])) : ?>
						<a href="<?= SITE_URL ?>pages/client/profile/profile.php">
							<div class="link nav-link5">ПРОФИЛЬ</div>
						</a>
					<?php else : ?>
						<a href="<?= SITE_URL ?>pages/general/login.php">
							<div class="link nav-link5">ВОЙТИ</div>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>


<nav>
	<div class="nav-left">
		<a href="<?= SITE_URL ?>index.php">
			<div class="nav-headline-block">
				<h1 class="nav-headline">say <span>cheese</span></h1>
			</div>
		</a>
		<div class="contacts-block">
			<p class="contacts">+7 (965) 602-73-74</p>
		</div>
	</div> 

	<div class="nav-rigth">
		<?php if (!isset($_COOKIE['user_login'])) : ?>
			<a href="<?= SITE_URL ?>pages/general/login.php">
				<div class="btn-login-block">
					<p class="btn-login-text">Войти в аккаунт</p>
				</div>
			</a>
		<?php endif; ?>
		<div class="btn-open-nav-block">
			<div class="btn-open-nav">
				<div class="btn-nav-lines"></div>
			</div>
		</div>
	</div>
</nav>