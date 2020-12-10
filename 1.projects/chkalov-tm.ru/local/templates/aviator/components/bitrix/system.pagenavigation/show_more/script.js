$(document).ready(function () {

    $(document).on('click', '.prod-subscribe', function () {


        var targetContainer = $('.catalog-list'),          //  Контейнер, в котором хранятся элементы
            url = $('.prod-subscribe').attr('data-url');    //  URL, из которого будем брать элементы

        if (url !== undefined) {
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'html',
                success: function (data) {

                    //  Удаляем старую навигацию
                    $('.text-center').remove();

                    $.ajaxSetup({'cache': true});
                    $.getScript("/local/templates/aviator/components/bitrix/catalog.item/aviator/owl.carousel.min.js", function () {
                    });

                    $.getScript("/local/templates/aviator/components/bitrix/catalog.item/aviator/script.js", function () {
                    });

                    $.getScript("/local/templates/aviator/js/jquery.fancybox.min.js", function () {
                    });

                    $.getScript("/local/templates/aviator/js/fav.js", function () {
                    });

                    $.getScript("/local/templates/aviator/js/newmain.js", function () {
                    });


                    var elements = $(data).find('[data-card=card]'),  //  Ищем элементы
                        pagination = $(data).find('.text-center');//  Ищем навигацию
                    targetContainer.append(elements);   //  Добавляем посты в конец контейнера
                    targetContainer.append(pagination); //  добавляем навигацию следом


                    $(".fancybox").fancybox(
                        {
                            "frameWidth": 510,
                            "frameHeight": 400,

                            "hideOnContentClick": false
                        }
                    );
                }

            })
        }


        var idfav = $('#favourite-count').attr('data-user');

        $.post('/ajax/fav_shownore.php', {idfav}, function (favres) {


            var datad = JSON.parse(favres);
            for (var key2 in datad) {

                $('[data-item = ' + key2 + ']').empty();
                var str = '<img src="/upload/listfav.png" height="27" width="30">';
                $('[data-item = ' + key2 + ']').html(str);
                $('[data-item = ' + key2 + ']').attr("data-wish", "1");
            }
        })
    });
});
