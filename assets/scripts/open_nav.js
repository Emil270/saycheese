
// Открытие навигационной панели //

$(document).ready(function () {
	let clickCounter = 0;
	$('.btn-open-nav').click(function() { 
		if(clickCounter == 0){
			$('.nav-wrapper').css("right", "0");
			clickCounter++;
		}
		else{
			$('.nav-wrapper').css("right", "-110%");
			clickCounter = 0;
		}
	});

	$('.close-nav-field').click(function () { 
		$('.nav-wrapper').css("right", "-110%");
		clickCounter = 0;
	});
	
});
