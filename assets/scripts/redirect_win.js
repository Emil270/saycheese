$(document).ready(function () {
	$('.redirect-wrapper').fadeOut(0);
	$('.btn-redirect').click(function () { 
		$('.redirect-wrapper').fadeIn(200);
		let id_request = $(this).attr('id');
		$('#id_request').val(id_request);
	});
	$('.close-redirect-block').click(function () { 
		$('.redirect-wrapper').fadeOut(200);
		$('#id_request').val("");
	});
});