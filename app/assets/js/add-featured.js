// Добавление видеозаписи в избранные

$(document).ready(function() {

    $(".mostcontainer").on('click', '#add_featured', add);
    $(".sideblock2").on('click', '#add_featured', add);

    function add(e) {

        var data = {};
        data["video_id"] = $(this).attr("data-id-video"); //id
        data["url"] = $(this).attr("data-url"); //на какой маршрут перенаправлять

        $.ajax({
            url: data["url"],
            data: data,
            type: 'POST',
            dataType: "json",  // этим параметром определяется, что ответ от сервера будет получен в json
            headers: {
                'X-CSRF-TOKEN': data["token"]
            },

            success: function(result){

                if(result.response === false){

                    $(location).attr('href', data["url"]); //перенаправление
                    // console.log(result);

                } else {

                    $(e.target).attr({"src":"/images/ok.png", "id":"add_featured_ok", "class":"plusicon_ok"}); //img

                    $(e.target).parent(".addtoplaylist").attr('class','addtoplaylist_ok'); //родительский span

                }

            },
            error: function(result){
                console.log(result);
                // alert('ошибка');
            }
        });
    }
});