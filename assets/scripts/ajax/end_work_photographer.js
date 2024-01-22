$(document).ready(function () {
	$('.btn-end-work').click(function () { 

		/*
			Отправка POST-запроса для завершения работы над заявкой клиента
		*/

		let id_request = $(this).attr('id');
		$.ajax({
			type: "POST",
			url: "/saycheese/app/controllers/specialists/photographer_works.php",
			data: {id_request: id_request},
			dataType: "json",
			success: function (data) {
				if(data.status == "1"){
					window.location.reload();
				}
			},
			error: function (jqXHR, exception) {
				if (jqXHR.status === 0) {
					alert('Not connect. Verify Network.');
				} else if (jqXHR.status == 404) {
					alert('Requested page not found (404).');
				} else if (jqXHR.status == 500) {
					alert('Internal Server Error (500).');
				} else if (exception === 'parsererror') {
					alert('Requested JSON parse failed.');
				} else if (exception === 'timeout') {
					alert('Time out error.');
				} else if (exception === 'abort') {
					alert('Ajax request aborted.');
				} else {
					alert('Uncaught Error. ' + jqXHR.responseText);
				}
			}
		});
	});
});