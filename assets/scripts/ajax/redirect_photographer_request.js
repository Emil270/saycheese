$(document).ready(function () {

	// Вывод сообщения об успехе после обновления страницы (сравнив хеш страницы) //

	if(window.location.hash.substr(1) == "TriggerAfterRedirect"){
		window.location.hash = "";
		$('.message-block').fadeOut(0);
		$('.message-block').css('display', 'flex');
		$('.message').text("Успешно!");
		$('.message-block').delay(800).fadeOut();
	}

	$('#redirect').on("submit", function() { 

		/*
			Отправка POST-запроса для перенаправления выбранной услуги выбранному специалисту
		*/

		$.ajax({
			type: "POST",
			url: "/saycheese/app/controllers/admin-moderator/requests_to_photographer.php",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if(data.status == "0"){
					$('.error-win-wrapper').fadeOut();
					$('.error-win-wrapper').css('display', 'flex');
					$('.error-text').text(data.error);
				}
				if(data.status == "1"){
					window.location.hash = "TriggerAfterRedirect";
					window.location.reload();
				}
			},
			error: function (jqXHR, exception) {
				if (jqXHR.status === 0) {
					alert('Not connect. Verify Network.');
				} else if (jqXHR.status == 404) {
					alert('Requested page not found (404).');
				} else if (jqXHR.status == 500) {
					alert('Internal Server Error (500).');
				} else if (exception === 'parsererror') {
					alert('Requested JSON parse failed.');
				} else if (exception === 'timeout') {
					alert('Time out error.');
				} else if (exception === 'abort') {
					alert('Ajax request aborted.');
				} else {
					alert('Uncaught Error. ' + jqXHR.responseText);
				}
			}
		});

	});

});