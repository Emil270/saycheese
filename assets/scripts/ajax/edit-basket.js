$(document).ready(function () {

	// Отправка POST-запроса на добавление единицы существующего товара в корзину (+1 к количеству) //

	$('.btn-add-one').click(function () { 
		var id = $(this).attr('id');
		$.ajax({
			type: "POST",
			url: "/saycheese/app/controllers/client/basket.php",
			data: {id_basket_add: id},
			dataType: "json",
			success: function (response) {
				if(response.success == "Успешно"){
					location.reload();
				}
				else{
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

	// Отправка POST-запроса на удаление единицы существующего товара их корзину (-1 от количества) //

	$('.btn-remove-one').click(function () { 
		var id = $(this).attr('id');
		$.ajax({
			type: "POST",
			url: "/saycheese/app/controllers/client/basket.php",
			data: {id_basket_remove: id},
			dataType: "json",
			success: function (response) {
				location.reload();
			}
		});
	});

	//Отправка POST-запроса на удаление всех товаров из корзины конкретного клиента

	$('.del_all_basket').click(function (){ 
		$.ajax({
			type: "POST",
			url: "/saycheese/app/controllers/client/basket.php",
			data: {del_all_basket: 1},
			dataType: "json",
			success: function (response) {
				location.reload();
			}
		});
	});

});