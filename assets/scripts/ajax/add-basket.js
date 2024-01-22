$(document).ready(function () {

	// Отправка POST-запроса на добавление товара в корзину //
	
	$('.add_basket').click(function () { 
		var id = $(this).attr('id');
		$.ajax({
			type: "post",
			url: "/saycheese/app/controllers/client/basket.php",
			data: {id_product: id}, 
			dataType: "json",
			success: function (response) {
				if(response['status'] != 'Ошибка' && response['status'] != 'Ошибка авторизации'){
					$('.message-block').fadeOut(0);
					$('.message-block').css('display', 'flex');
					$('.message-block').css('background-color', '#5dc572');
					$('.message-block').css('box-shadow', '0px 0px 25px 2px rgba(80, 209, 78, 0.6)');
					$('.message').text(response['status']);
					$('.message-block').delay(800).fadeOut();
				}
				if(response['status'] == "Ошибка авторизации"){
					window.location.href = "/saycheese/pages/general/login.php";
				}
				if(response['status'] == "Ошибка"){
					$('.message-block').fadeOut(0);
					$('.message-block').css('display', 'flex');
					$('.message-block').css('background-color', '#e1afaf');
					$('.message-block').css('box-shadow', '0px 0px 30px 3px rgba(255, 159, 159, 0.5)');
					$('.message').text("Товара больше нет в наличии");
					$('.message-block').delay(800).fadeOut();
				}
			}
		});
	});
	
});