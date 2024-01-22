$(document).ready(function () {

	// Вывод сообщения об успехе после обновления страницы (сравнив хеш страницы) //

	if(window.location.hash.substr(1) == "TriggerAfterAdditionProduct"){
		window.location.hash = "";
		$('.message-block').fadeOut(0);
		$('.message-block').css('display', 'flex');
		$('.message').text("Успешно!");
		$('.message-block').delay(800).fadeOut();
	}

	// Отправка POST-запроса для добавления нового товара //

	$('#add_product').on("submit", function(){

		let formData = new FormData(this);
		let allfiles = $(this).find('input[name="photo"]');
		for(var i = 0; i < allfiles[0].files.length; i++){
			formData.append("file_"+i, allfiles[0].files[i]);
		}

		$.ajax({
			type: "POST",
			url: "/saycheese/app/controllers/admin-moderator/add_edit_product.php",
			data: formData,
			processData: false,
			contentType: false,
			dataType: "json",
			success: function (data) {
				if(data.status == "0"){
					$('.error-win-wrapper').fadeOut();
					$('.error-win-wrapper').css('display', 'flex');
					$('.error-text').text(data.error);
				}
				else{
					window.location.hash = "TriggerAfterAdditionProduct";
					window.location.reload();
				}
			}
		});
	});
});