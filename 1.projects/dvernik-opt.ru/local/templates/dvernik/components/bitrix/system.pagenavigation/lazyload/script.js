$(document).ready(function () {

    $(document).on('click', '.btn.btn_type_link', function () {


        var targetContainer = $('.products__list'),          //  Контейнер, в котором хранятся элементы
            url = $('#doplist').attr('data-url');    //  URL, из которого будем брать элементы

        if (url !== undefined) {
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'html',
                success: function (data) {

                    //  Удаляем старую навигацию
                    $('.catalog-main__inner.catalog-main__inner_controls.view-controls').remove();

            /*        $.ajaxSetup({'cache': true});
                    $.getScript("/local/templates/aviator/components/bitrix/catalog.item/aviator/owl.carousel.min.js", function () {
                        //alert("Скрипт выполнен2.");
                    });

                    $.getScript("/local/templates/aviator/components/bitrix/catalog.item/aviator/script.js", function () {
                        //alert("Скрипт выполнен2.");
                    });


                    */
                   
                    $.getScript("/local/templates/dvernik/js/plugins/jquery/jquery-3.4.1.min.js", function () {
                        /*alert("Скрипт выполнен2.");*/
                    });
                     $.getScript("/local/templates/dvernik/js/plugins/OverlayScrollbars/jquery.overlayScrollbars.min.js", function () {
                     /*   alert("Скрипт выполнен2.");*/
                    });
                       $.getScript("/local/templates/dvernik/js/plugins/slickslider/slick.min.js", function () {
                    /*    alert("Скрипт выполнен2.");*/
                    });
                         $.getScript("/local/templates/dvernik/js/plugins/sumoselect/jquery.sumoselect.min.js", function () {
                  /*      alert("Скрипт выполнен2.");*/
                    });
                           $.getScript("/local/templates/dvernik/js/plugins/jquery.validate/jquery.validate.min.js", function () {
                       /* alert("Скрипт выполнен2.");*/
                    });
                             $.getScript("/local/templates/dvernik/js/script.min.js", function () {
                      /*  alert("Скрипт выполнен2.");*/
                    });




                    var elements = $(data).find('.products__item.product'),  //  Ищем элементы
                        pagination = $(data).find('.catalog-main__inner.catalog-main__inner_controls.view-controls');//  Ищем навигацию
                    targetContainer.append(elements);   //  Добавляем посты в конец контейнера
                    targetContainer.append(pagination); //  добавляем навигацию следом

                }

            })
        }


    });
});
