$(document).ready(function () {

		// Отправка POST-запроса для оформления заказа товарво из корзины //

	$('#create-order-form').on("submit", function() {
		$.ajax({
			method: 'post',
			url: '/saycheese/app/controllers/client/myorder.php',
			data: $(this).serialize(),
			dataType: 'json',
			success: function (data) { 
				if(data.status == "1"){
					window.location.href = "/saycheese/pages/client/myorders/myorders.php";
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