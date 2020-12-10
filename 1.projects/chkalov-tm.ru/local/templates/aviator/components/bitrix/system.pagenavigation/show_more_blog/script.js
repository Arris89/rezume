$(document).ready(function () {

    $(document).on('click', '.prod-subscribe', function () {

        var targetContainer = $('.posts'), //  Контейнер, в котором хранятся элементы
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
                    $.getScript("/local/templates/aviator/components/bitrix/news/blog/script.js", function () {
                    });
                    var elements = $(data).find('#post-stream'), //  Ищем элементы
                            pagination = $(data).find('.text-center');//  Ищем навигацию

                    targetContainer.append(elements);   //  Добавляем посты в конец контейнера
                    elements.after(pagination); //  добавляем навигацию следом
                }
            })
        }
    });

});