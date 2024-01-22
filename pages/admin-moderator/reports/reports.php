<?php
	session_start();
	require '../../../app/include/querys.php';
	require '../../../app/controllers/general/staff_login_check.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Say Cheese - Отчёты</title>
	<link rel="icon" href="/saycheese/saycheese.ico">
	<link rel="stylesheet" href="/saycheese/assets/styles/admin-moderator/reports/reports.css">
</head>

<body>

	<!-- Подключение разметки навигационной панели -->

	<?php require '../../include/nav_am.php' ?>

	<!-- Получение разметки блока с сообщением о статусе операции -->

	<?php require '../../include/message.php' ?>

	<!-- Получение разметки блока с сообщением об ошибке -->

	<?php require '../../include/message_error.php' ?>

	<div class="container">
		<div class="wrapper">
			<div class="headline-block">
				<h1 class="headline">Отчёты</h1>
			</div>
			<div class="content">
				<form id="report_form" method="POST" action="/saycheese/app/controllers/admin-moderator/report.php">
					<div class="months-block">
						<input type="checkbox" id="month1" class="month" name="months[]" value=1> <label for="month1">Январь</label>
						<input type="checkbox" id="month2" class="month" name="months[]" value=2> <label for="month2">Февраль</label>
						<input type="checkbox" id="month3" class="month" name="months[]" value=3> <label for="month3">Март</label>
						<input type="checkbox" id="month4" class="month" name="months[]" value=4> <label for="month4">Апрель</label>
						<input type="checkbox" id="month5" class="month" name="months[]" value=5> <label for="month5">Май</label>
						<input type="checkbox" id="month6" class="month" name="months[]" value=6> <label for="month6">Июнь</label>
						<input type="checkbox" id="month7" class="month" name="months[]" value=7> <label for="month7">Июль</label>
						<input type="checkbox" id="month8" class="month" name="months[]" value=8> <label for="month8">Август</label>
						<input type="checkbox" id="month9" class="month" name="months[]" value=9> <label for="month9">Сентябрь</label>
						<input type="checkbox" id="month10" class="month" name="months[]" value=10> <label for="month10">Октябрь</label>
						<input type="checkbox" id="month11" class="month" name="months[]" value=11> <label for="month11">Ноябрь</label>
						<input type="checkbox" id="month12" class="month" name="months[]" value=12> <label for="month12">Декабрь</label>
					</div>
					<select name="year" class="year-list">
						<option class="year" value=2022>2022</option>
						<option class="year" selected value=2023>2023</option>
					</select>
					<div class="sep"></div>
					<input checked type="radio" value="photographer_services" name="report-type" class="report-type" id="report-type1"> <label for="report-type1">Количество оказанных услуг фотографами</label><br>
					<input type="radio" value="photoshop_services" name="report-type" class="report-type" id="report-type2"> <label for="report-type2">Количество оказанных услуг специалистами по обработке фотографий</label><br>
					<input type="radio" value="products" name="report-type" class="report-type" id="report-type3"> <label for="report-type3">Количество продаж каждого товара</label><br>
					<input type="radio" value="photostudios" name="report-type" class="report-type" id="report-type4"> <label for="report-type4">Количество брони каждой фотостудии</label>
					<input type="hidden" name="report">
					<div class="sep"></div>
					<button type="submit" class="btn-report" value="report">
						Печать
					</button>
				</form>
			</div>
		</div>
	</div>

	<!-- Подключение разметки навигационной панели -->

	<?php require '../../include/footer_am.php' ?>

	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	<script src="/saycheese/assets/scripts/open_nav.js"></script>
	<!--<script src="/saycheese/assets/scripts/close_error.js"></script>-->
</body>

</html>