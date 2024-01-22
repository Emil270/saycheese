
<!-- Футер (подвал) для специалистов -->

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
						<a href="<?=SITE_URL?>pages/specialist/profile/profile.php">
							<li class="footer-link">Профиль</li>
						</a>
						<?php if($_SESSION['role'] == "Фотограф"): ?>
							<a href="<?=SITE_URL?>pages/specialist/works/photographer_works.php">
								<li class="footer-link">Мои работы</li>
							</a>
						<?php else: ?>
							<a href="<?=SITE_URL?>pages/specialist/works/photoshop_works.php">
								<li class="footer-link">Мои работы</li>
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
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-part3"></div>
</footer>