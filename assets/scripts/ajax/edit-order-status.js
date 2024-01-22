$(document).ready(function () {

	// Отправка POST-запроса на изменение статуса заказа

	$('.btn_edit_order_status').click(function () { 
		var status = $(this).attr('value');
		var id = $(this).attr('id');
		$.ajax({
			type: "POST",
			url: "/saycheese/app/controllers/admin-moderator/orders.php",
			data: {status: status, id: id},
			dataType: "json",
			success: function (response) {
				location.reload();
			}
		});
	});
});