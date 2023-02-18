
// Открытие навигационной панели //

$(document).ready(function () {
	let clickCounter = 0;
	$('.btn-open-nav').click(function() { 
		if(clickCounter == 0){
			$('.nav-panel').css("right", "0");
			clickCounter++;
		}
		else{
			$('.nav-panel').css("right", "-110%");
			clickCounter = 0;
		}
	});
});
