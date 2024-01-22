$(document).ready(function () {

	// Вывод сообщения об успехе после обновления страницы (сравнив хеш страницы) //

	if (window.location.hash.substr(1) == "TriggerAfterAdditionReview") {
		window.location.hash = "";
		$('.message-block').fadeOut(0);
		$('.message-block').css('display', 'flex');
		$('.message').text("Успешно!");
		$('.message-block').delay(800).fadeOut();
	}

	// Отправка POST-запроса для добавления нового отзыва //

	$('#add-review-form').on("submit", function(){
		$.ajax({
			method: 'POST',
			url: '/saycheese/app/controllers/client/reviews.php',
			data: $(this).serialize(),
			dataType: 'json',
			success: function (data) {
				if(data.status == "0"){
					$('.add-review-wrapper').fadeOut(100);
					$('.error-win-wrapper').fadeOut();
					$('.error-win-wrapper').css('display', 'flex');
					$('.error-text').text(data.error);
				}
				if(data.status == "1"){
					window.location.hash = "TriggerAfterAdditionReview";
					window.location.reload();
				}
				if(data.status == "2"){
					window.location.href = "/saycheese/pages/general/login.php";
				}
			}
		});
	});
});