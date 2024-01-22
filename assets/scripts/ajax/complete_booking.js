$(document).ready(function () {
	$('.btn-done').click(function () { 
		let current_id = $(this).attr('id');
		$.ajax({
			type: "POST",
			url: "/saycheese/app/controllers/admin-moderator/booking.php",
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