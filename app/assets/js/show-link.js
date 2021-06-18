// Отображает ссылку на видео в сплывающем окне при клике на иконку

$(document).ready(function() {

    $(".mostcontainer").on('click', '.link-video', show);
    $(".sideblock2").on('click', '.link-video', show);

    $(".mostcontainer").on('click', '.link-video', pluso);
    $(".sideblock2").on('click', '.link-video', pluso);

    function show(e) {

        var parent = $(this).closest("li")[0]; //ближайший родительский элемент

        var video_id = $(parent).find("img[data-id-video]").attr("data-id-video");

        var domen = 'http://'+window.location.hostname;
        var link = domen + '/id=' +video_id;
        $(".toast-container").detach(); //удаление старого блока


        //БЛОК сервиса соцсетей
        var description = $(parent).find(".ttle a.popup-youtube").html(); //название видео
        // alert($.trim(description));
        var pluso = '<div class="pluso" data-background="#ebebeb" data-options="small,square,line,horizontal,nocounter,theme=01" ' +
            'data-services="facebook,google,vkontakte,odnoklassniki,twitter,googlebookmark" data-url="' + link + '"' +
            'data-title="VIDEO" data-description="' + $.trim(description) + '"></div>';




        function showStickyErrorToast(text) {
            $().toastmessage('showToast', {
                text     : text,
                sticky   : true,
                position : 'top-right',
                type     : 'notice',
                closeText: '',
                close    : function () {
                    // console.log("toast is closed ...");
                }
            });
        }

        showStickyErrorToast(link + pluso); //всплывающее окно со ссылкой

    }


    //Сервис http://share.pluso.ru
    function pluso() {
        // if (window.pluso)if (typeof window.pluso.start == "function") return;
        if (window.ifpluso==undefined) { window.ifpluso = 1;
            var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
            s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
            s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
            var h=d[g]('body')[0];
            h.appendChild(s);
        }}



});