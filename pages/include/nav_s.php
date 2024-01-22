<!-- Навигационная панель для специалистов -->

<div class="nav-wrapper">
	<div class="close-nav-field"></div>
	<div class="nav-panel">
		<div class="nav-panel-links-contnent">
			<div class="nav-panel-links-wrapper">
				<div class="nav-panel-links">
					<a href="<?=SITE_URL?>pages/specialist/profile/profile.php"><div class="link nav-link3">ПРОФИЛЬ</div></a>
					<?php if($_SESSION['role'] == "Фотограф"): ?>
						<a href="<?=SITE_URL?>pages/specialist/works/photographer_works.php"><div class="link nav-link4">МОИ РАБОТЫ</div></a>
					<?php else: ?>
						<a href="<?=SITE_URL?>pages/specialist/works/photoshop_works.php"><div class="link nav-link4">МОИ РАБОТЫ</div></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<nav>
	<div class="nav-left">
		<a href="<?=SITE_URL?>pages/specialist/profile/profile.php">
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