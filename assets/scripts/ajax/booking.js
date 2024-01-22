$(document).ready(function () {

	if(window.location.hash.substr(1) == "TriggerAfterGetTime"){
		window.location.hash = "";

	}

	// Отправка POST-запроса для бронирования фотостудии

	$('#book_studio').on("submit", function() {
		$.ajax({
			type: "POST",
			url: "/saycheese/app/controllers/client/photostudio.php",
			data: $(this).serialize(),
			dataType: 'json',
			success: function (data) {
				if(data.status == "1"){
					window.location.href = "/saycheese/pages/client/my-booking/my_booking.php";
				}
				if(data.status == "2"){
					window.location.href = "/saycheese/pages/general/login.php";
				}
				if(data.status == "0"){
					$('.booking-photostudio-wrapper').fadeOut();
					$('.error-win-wrapper').css('display', 'flex');
					$('.error-text').text(data.error);
				}
			}
		});
	});

	// Отправка POST-запроса для получения занятого времени брони выбранного дня //

	$('#get-busy-time-form').on("submit", function(){
		$.ajax({
			type: "POST",
			url: "/saycheese/app/controllers/client/photostudio.php",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if(data.status == "1"){
					let busy_time = "";
					data.busy_time.forEach(time => {
						busy_time += time + "<br>";
					});
					$('.msg-busy-time-wrapper').fadeIn();
					$('.msg-busy-time-headline').text("Занятое время на " + data.date);
					$('.msg-busy-time-text').html(busy_time);
				}
			}
		});
	});

});