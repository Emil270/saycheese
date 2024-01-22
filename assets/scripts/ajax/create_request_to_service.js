$(document).ready(function () {

	// Вывод сообщения об успехе после обновления страницы (сравнив хеш страницы) //

	if(window.location.hash.substr(1) == "TriggerAfterCreationRequest"){
		window.location.hash = "";
		$('.message-block').css('display', 'flex');
		$('.message').text("Успешно!");
		$('.message-block').delay(800).fadeOut();
	}

	// Отправка POST-запроса для создания заявки на услугу фотографа //

	$('.photographer-service-form').on("submit", function () { 
		$.ajax({
			type: "POST",
			url: "/saycheese/app/controllers/client/services.php",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if(data.status == "0"){
					$('.error-win-wrapper').css('display', 'flex');
					$('.error-text').text(data.error);
				}
				if(data.status == "1"){
					window.location.hash = "TriggerAfterCreationRequest";
					window.location.reload();
				}
				if(data.status == "2"){
					window.location.href = "/saycheese/pages/general/login.php";
				}
			},
			error: function () { 
				alert("Ошибка");
			}
		});
	});

	// Отправка POST-запроса для создания заявки на услугу обработки фото //

	$('.photoshop-service-form').on("submit", function(){
		let formData = new FormData(this);
		let allfiles = $(this).find('input[name="images"]');
		for(var i = 0; i < allfiles[0].files.length; i++){
			formData.append("file_"+i, allfiles[0].files[i]);
		}
		$.ajax({
			type: "POST",
			url: "/saycheese/app/controllers/client/services.php",
			data: formData,
			processData: false,
			contentType: false,
			dataType: "json",
			success: function (data) {
				if(data.status == "0"){
					$('.error-win-wrapper').css('display', 'flex');
					$('.error-text').text(data.error);
				}
				if(data.status == "1"){
					window.location.hash = "TriggerAfterCreationRequest";
					window.location.reload();
				}
				if(data.status == "2"){
					window.location.href = "/saycheese/pages/general/login.php";
				}
			},
			error: function () { 
				alert("Ошибка");
			}
		});
	});

});