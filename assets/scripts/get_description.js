$(document).ready(function () {
	$('.photoshop-description').click(function () { 
		let description = $(this).attr('id');
		$('.description-wrapper').css('display', 'flex');
		$('.desc-text').text(description);
	});
	$('.close-description').click(function () { 
		$('.description-wrapper').fadeOut();
	});
});