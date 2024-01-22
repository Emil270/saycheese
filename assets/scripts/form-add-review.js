
// Скрыть/показать форму добавления отзывов //

$(document).ready(function () {

	$('.add-review-wrapper').fadeOut(0);

	$('.btn-open-add-review').click(function () { 
		$('.add-review-wrapper').fadeIn(300);
	});

	$('.btn-close-add-review').click(function () { 
		$('.add-review-wrapper').fadeOut(300); 
	});

});