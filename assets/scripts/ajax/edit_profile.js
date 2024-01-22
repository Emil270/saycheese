$(document).ready(function () {

	// Вывод сообщения об успехе после обновления страницы (сравнив хеш страницы) //

	if(window.location.hash.substr(1) == "TriggerAfterEditionProfile"){
		window.location.hash = "";
		$('.message-block').fadeOut(0);
		$('.message-block').css('display', 'flex');
		$('.message').text("Успешно!");
		$('.message-block').delay(800).fadeOut();
	}

	// Отправка POST-запроса для изменения имени и фамилии //

	$('#edit_fullname').on("submit", function(){
		$.ajax({
			type: "POST",
			url: "/saycheese/app/controllers/general/edit_profile.php",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if(data.status == "1"){
					window.location.hash = "TriggerAfterEditionProfile";
					window.location.reload();
				} 
				else{
					$('.error-win-wrapper').fadeOut();
					$('.error-win-wrapper').css('display', 'flex');
					$('.error-text').text(data.error);
				}
			}
		});
	});

	// Отправка POST-запроса для изменения номера телефона //

	$('#edit_phone').on("submit", function(){
		$.ajax({
			type: "POST",
			url: "/saycheese/app/controllers/general/edit_profile.php",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if(data.status == "1"){
					window.location.hash = "TriggerAfterEditionProfile";
					window.location.reload();
				} 
				else{
					$('.error-win-wrapper').fadeOut();
					$('.error-win-wrapper').css('display', 'flex');
					$('.error-text').text(data.error);
				}
			}
		});
	});

	// Отправка POST-запроса для изменения эл. почты //

	$('#edit_email').on("submit", function(){
		$.ajax({
			type: "POST",
			url: "/saycheese/app/controllers/general/edit_profile.php",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if(data.status == "1"){
					window.location.hash = "TriggerAfterEditionProfile";
					window.location.reload();
				} 
				else{
					$('.error-win-wrapper').fadeOut();
					$('.error-win-wrapper').css('display', 'flex');
					$('.error-text').text(data.error);
				}
			}
		});
	});

	// Отправка POST-запроса для изменения пароля //

	$('#edit_pass').on("submit", function () {  
		$.ajax({
			type: "POST",
			url: "/saycheese/app/controllers/general/edit_profile.php",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if(data.status == "1"){
					window.location.hash = "TriggerAfterEditionProfile";
					window.location.reload();
				} 
				else{
					$('.error-win-wrapper').fadeOut();
					$('.error-win-wrapper').css('display', 'flex');
					$('.error-text').text(data.error);
				}
			}
		});
	});

	// Отправка POST-запроса для удаления аватара //

	$('#delete_avatar').on("submit", function(){
		$.ajax({
			type: "POST",
			url: "/saycheese/app/controllers/general/edit_profile.php",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if(data.status == "1"){
					window.location.hash = "TriggerAfterEditionProfile";
					window.location.reload();
				} 
				else{
					$('.error-win-wrapper').fadeOut();
					$('.error-win-wrapper').css('display', 'flex');
					$('.error-text').text(data.error);
				}
			}
		});
	});

	// Отправка POST-запроса для изменения аватара //

	$('#edit_avatar').on("submit", function(){

		let formData = new FormData(this);
		let allfiles = $(this).find('input[name="avatar"]');
		for(var i = 0; i < allfiles[0].files.length; i++){
			formData.append("file_"+i, allfiles[0].files[i]);
		}
		$.ajax({
			type: "POST",
			url: "/saycheese/app/controllers/general/edit_profile.php",
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
					window.location.hash = "TriggerAfterEditionProfile";
					window.location.reload();
				}
				console.log(data);
			}
		});
	});

});