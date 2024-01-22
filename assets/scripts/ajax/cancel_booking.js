$(document).ready(function () {
	$('.btn-cancel').click(function () { 
		let current_id = $(this).attr('id');
		$.ajax({
			type: "POST",
			url: "/saycheese/app/controllers/client/my_booking.php",
			data: {id_booking: current_id},
			dataType: "json",
			success: function (data) {
				if(data.status == "1"){
					window.location.reload();
				}
			}
		});
		
	});
});