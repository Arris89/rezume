$(document).ready(function () {


    $('.leftfav').on('click', function (e) {

        var wer = $(this).attr('data-wish');
//1 Если товар не в избранном
        if (wer == 0) {
//сердечко в карточке товара
            $(this).empty();
            var str = '<img src="/upload/listfav.png" height="27" width="30">';
            $(this).html(str);
            $(this).attr("data-wish", "1");


//+Увеличение счетчика в шапке
            var wers = $('#favourite-count').attr('data-count');
            var fol = +wers + 1;


//Замена значения счетчика в шапке
            $('.favhead').children().eq(0).remove();
            var str1 = '<span id="favourite-count" data-count="' + fol + '">' + fol + '</span>';
            $('.favhead').prepend(str1);
        }

        else
//2 Если товар уже был добавлен в избранное
        {
            //сердечко в карточке товара
            $(this).empty();
            var str = '<img src="/local/templates/aviator/images/main-recommend-heart.png" height="27" width="30">';
            $(this).html(str);
            $(this).attr("data-wish", "0");

//Уменьшение счетчика в шапке
            var wers = $('#favourite-count').attr('data-count');
            var fol = +wers - 1;
            $('.fav-count').attr('data-count', '' + fol + '');


//Замена значения счетчика в шапке
            $('.favhead').children().eq(0).remove();

            if (fol > 0) {

                var str1 = '<span id="favourite-count" data-count="' + fol + '">' + fol + '</span>';
                $('.favhead').prepend(str1);
            }
            else {

                var str1 = '<span id="favourite-count" data-count="0">0</span>';
                $('.favhead').prepend(str1);
            }

        }

        var favorID = $(this).attr('data-item');
        addFavorite(favorID);
    });


    /* Избранное */
    function addFavorite(favorID) {
        var param = favorID;
        $.post('/ajax/favorites.php', {param, idfav}, function (datad1) {

        })
    }



});