$(document).ready(function () {
	$('#report_form').on("submit", function () {

		var months = [];
		$('.month:checked').each(function(i, e) {
			months.push($(this).val());
		});
		var year = $('.year:selected').val();
		var report_type = $('.report-type:checked').val();

		$.ajax({
			type: "POST",
			url: "/saycheese/app/controllers/admin-moderator/report.php",
			data: {
				'months[]': months.join(),
				'months-count': months.length,
				'year': year,
				'report-type': report_type
			},
			dataType: "json",
			success: function (data) {
				if(data.status == "0"){
					$('.error-win-wrapper').fadeOut();
					$('.error-win-wrapper').css('display', 'flex');
					$('.error-text').text(data.error);
				}
				else{
					//window.open("data:application/pdf," + encodeURI(data.pdffile));
					//alert("Успешно");
				}
			}, 
			error: function () { 
				alert("Ошибка");
			}
		});
	})
});