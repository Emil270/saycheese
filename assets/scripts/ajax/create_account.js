$(document).ready(function(){

	// Отправка POST-запроса для регистрации нового аккаунта //

	$('#create-account-form').on("submit", function(){
		$.ajax({
			method: 'POST',
			url: '/saycheese/app/controllers/general/user.php',
			data: $(this).serialize(),
			dataType: 'json',
			success: function (data){  
				if(data.status == "0"){
					$('.error-win-wrapper').fadeOut();
					$('.error-win-wrapper').css('display', 'flex');
					$('.error-text').text(data.error);
				}
				else{
					window.location.href = "/saycheese/pages/general/login.php";
				}
			}
		});
	});
});