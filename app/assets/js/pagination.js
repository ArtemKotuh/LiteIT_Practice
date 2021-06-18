$(document).ready(function() {

    $(".mostcontainer").on('click', '#paginate-prev', { event: "prev" }, send);
    $(".mostcontainer").on('click', '#paginate-next', { event: "next" }, send);



        function send(event) {

            $("#ventilator").center(); //включение индикатора загрузки


            var data = {};

            data["id"] = $(this).attr("data-id"); //id
            data["name"] = $(this).attr("data-name"); //название
            data["prev"] = $(this).attr("data-prev"); //токен предыдущей страницы
            data["next"] = $(this).attr("data-next"); //токен следующей страницы
            data["token"] = $(this).attr("data-token");
            data["event"] = event.data.event; //тип события next/prev


            $.ajax({
                url: '', //отсылаем на эту же страницу но только POST запросом
                // url: $('#commentform').attr('action'),
                data: data,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': data["token"]
                },
                // cache: false,
                success: function(html){

                    //отключение индикатора загрузки
                    $("#ventilator").css({"display": "none"});

                    window.scrollTo(0, 0); //быстрая перемотка вверх

                    $('#content').html(html);

                    //Повторная привязка модуля для проигрывания видео в всплывающем окне после обновления DOM
                    $('.popup-youtube').magnificPopup({
                        type: 'iframe',
                        iframe: {
                            patterns: {
                                youtube: {
                                    index: 'youtube.com/',
                                    id: 'v=',
                                    src: '//www.youtube.com/embed/%id%?autoplay=1&rel=0&showinfo=0&iv_load_policy=3'
                                }
                            }
                        }
                    });



                },
                // Ошибка AJAX
                error: function(result){
                    console.log(result);
                }

            });
        }



});
