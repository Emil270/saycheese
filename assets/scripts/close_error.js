
// Закрыть окно с ошибкой //

$(document).ready(function () {
	$('.btn-close-error-win').click(function () { 
		$('.error-win-wrapper').slideUp(200);
	});
});