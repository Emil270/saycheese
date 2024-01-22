
<!-- Футер (подвал) -->

<footer>
	<div class="footer-part1"></div>
	<div class="footer-part2">
		<div class="footer-content">
			<div class="footer-copyright-block">
				<p class="footer-copyright">© 2022–2023 «Say Cheese»</p>
			</div>
			<div class="footer-links-block">
				<div class="footer-nav-block">
					<ul class="links-list">
						<a href="<?=SITE_URL?>index.php">
							<li class="footer-link">Главная</li>
						</a>
						<a href="<?=SITE_URL?>pages/client/photostudio/photostudios.php">
							<li class="footer-link">Фотостудии</li>
						</a>
						<?php if (isset($_COOKIE['user_login'])): ?>
							<a href="<?=SITE_URL?>pages/client/my-booking/my_booking.php">
								<li class="footer-link">Мои брони</li>
							</a>
						<?php endif; ?>
						<a href="<?=SITE_URL?>pages/client/catalog/catalog.php">
							<li class="footer-link">Каталог</li>
						</a>
						<?php if (isset($_COOKIE['user_login'])): ?>
							<a href="<?=SITE_URL?>pages/client/basket/basket.php">
								<li class="footer-link">Корзина</li>
							</a>
							<a href="<?=SITE_URL?>pages/client/myorders/myorders.php">
								<li class="footer-link">Заказы</li>
							</a>
						<?php endif; ?>
						<a href="<?=SITE_URL?>pages/client/reviews/reviews.php">
							<li class="footer-link">Отзывы</li>
						</a>
						<?php if (!isset($_COOKIE['user_login'])): ?>
							<a href="<?=SITE_URL?>pages/general/login.php">
								<li class="footer-link">Войти</li>
							</a>
						<?php endif; ?>
					</ul>
				</div>
				<div class="footer-contacts-block">
					<ul class="links-list">
						<li class="footer-link-c">+7 (965) 602-73-74</li>
						<li class="footer-link-c">saycheese.kzn@gmail.com</li>
						<a href="">
							<li class="footer-link">Telegram</li>
						</a>
						<a href="">
							<li class="footer-link">Vk</li>
						</a>
						<?php if (isset($_COOKIE['user_login'])): ?>
							<a href="<?=SITE_URL?>pages/client/profile/profile.php">
								<li class="footer-link">Профиль</li>
							</a>
						<?php endif; ?>
						<a href="<?=SITE_URL?>pages/client/services/services.php">
							<li class="footer-link">Услуги</li>
						</a>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-part3"></div>
</footer>