
// Скрыть/показать окно для выбора изображения //

$(document).ready(function () {

	$('.select-img-wrapper').fadeOut(0);

	$('.btn_edit_avatar').click(function () { 
		$('.select-img-wrapper').fadeIn(300);
	});

	$('.btn-close-input-file').click(function () { 
		$('.select-img-wrapper').fadeOut(300);
	});

	// Сохранение имени файла как текст кнопки выбора изображения //
	
	$('.input-file input[type=file]').on('change', function(){
		let file = this.files[0];
		$(this).next().html(file.name);
	});
	
});