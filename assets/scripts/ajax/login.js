$(document).ready(function(){

	// Отправка POST-запроса для  авторизации //

	$('#login-form').on("submit", function(){
		$.ajax({
			method: 'post',
			url: '/saycheese/app/controllers/general/user.php',
			data: $(this).serialize(),
			dataType: 'json',
			success: function(data){
				if(data.status == "1" && data.role == "client"){
						window.location.href = '/saycheese/index.php';
				}
				else if (data.status == "1" && data.role == "admin_moderator"){
						window.location.href = "/saycheese/pages/admin-moderator/profile/profile.php";
				}
				else if(data.status == "1" && data.role == "specialist"){
					window.location.href = "/saycheese/pages/specialist/profile/profile.php";
				}
				else{
					$('.error-win-wrapper').fadeOut();
					$('.error-win-wrapper').css('display', 'flex');
					$('.error-text').text(data.error);
				}
			}
		});
	});
});