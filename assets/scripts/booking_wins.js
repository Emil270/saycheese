$(document).ready(function () {

	$('.booking-photostudio-wrapper').fadeOut(0);
	$('.msg-busy-time-wrapper').fadeOut(0);

	$('.photostudio-book-btn').click(function () { 
		$('.booking-photostudio-wrapper').fadeIn();
	});

	$('.close-booking-window').click(function () { 
		$('.booking-photostudio-wrapper').fadeOut();
	});

	$('.close-busy-time-win').click(function () { 
		$('.msg-busy-time-wrapper').fadeOut();
	})

});