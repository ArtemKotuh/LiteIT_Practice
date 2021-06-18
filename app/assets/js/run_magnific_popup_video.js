// Открытие iframe YouTube в всплывающем окне. Используется Magnific Popup — jQuery плагин.

$(document).ready(function() {
	// Type Iframe - видео Youtube (или Vimeo), карты Гугл или другой контент в iframe
	$('.popup-youtube').magnificPopup({
		type: 'iframe',
		iframe: {
			patterns: {
				youtube: {
					index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).
					id: 'v=', // String that splits URL in a two parts, second part should be %id%
					// Or null - full URL will be returned
					// Or a function that should return %id%, for example:
					// id: function(url) { return 'parsed id'; }
					src: '//www.youtube.com/embed/%id%?autoplay=1&rel=0&showinfo=0&iv_load_policy=3' 
				}
			}
		}
	});
	

    $('.popup-youtube').click(function () {
		$('.vedio_banner .ug-button-play').trigger('click'); //Если нажал на кнопку просмотра видео, то остановить слайдер

        $('.ug-arrow-right').trigger('click'); //Включить следующий слайд (чтоб остановить видео)

    });


    //Если в URL главной страницы ссылка на видео - автоматически воспроизводить
	//самое первое видео (под индексом 0)
    var link_video = $('#link_video').attr("data-link-video");
    if(link_video == true){
		$(".list-video img").eq(0).trigger("click");
    }

});