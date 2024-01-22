$(document).ready(function () {

	// Вывод сообщения об успехе после обновления страницы (сравнив хеш страницы) //

	if(window.location.hash.substr(1) == "TriggerAfterAdditionStaff"){
		window.location.hash = "";
		$('.message-block').fadeOut(0);
		$('.message-block').css('display', 'flex');
		$('.message').text("Успешно!");
		$('.message-block').delay(800).fadeOut();
	}

	// Отправка POST-запроса для добавления нового модератора //

	$('#add_staff').on("submit", function(){
		$.ajax({
			type: "POST",
			url: "/saycheese/app/controllers/admin-moderator/staff.php",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if(data.status == "0"){
					$('.error-win-wrapper').fadeOut();
					$('.error-win-wrapper').css('display', 'flex');
					$('.error-text').text(data.error);
				}
				else{
					window.location.hash = "TriggerAfterAdditionStaff";
					window.location.reload();
				}
			}
		});
	});
});