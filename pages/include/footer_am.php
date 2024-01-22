
<!-- Футер (подвал) для админов или модераторов -->

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
						<?php if($_SESSION['role'] == "Администратор"): ?>
							<a href="<?=SITE_URL?>pages/admin-moderator/staff/staff.php">
								<li class="footer-link">Сотрудники</li>
							</a>
							<a href="<?=SITE_URL?>pages/admin-moderator/reports/reports.php">
								<li class="footer-link">Отчёты</li>
							</a>
						<?php endif; ?>
						<a href="<?=SITE_URL?>pages/admin-moderator/booking/booking_list.php">
							<li class="footer-link">Бронь фотостудий</li>
						</a>
						<a href="<?=SITE_URL?>pages/admin-moderator/catalog/catalog.php">
							<li class="footer-link">Товры</li>
						</a>
						<a href="<?=SITE_URL?>pages/admin-moderator/orders/orders.php">
							<li class="footer-link">Заказы</li>
						</a>
						<a href="<?=SITE_URL?>pages/admin-moderator/requests/requests_to_photographer.php">
							<li class="footer-link">Заявки (фотограф)</li>
						</a>
						<a href="<?=SITE_URL?>pages/admin-moderator/requests/requests_to_photoshop.php">
							<li class="footer-link">Заявки (фотошоп)</li>
						</a>
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
						<a href="<?=SITE_URL?>pages/admin-moderator/reviews/reviews.php">
							<li class="footer-link">Отзывы</li>
						</a>
						<a href="<?=SITE_URL?>pages/admin-moderator/profile/profile.php">
							<li class="footer-link">Профиль</li>
						</a>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-part3"></div>
</footer>