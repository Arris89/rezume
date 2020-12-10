/* eslint-disable no-unused-vars */
/* eslint-disable no-undef */

(function ($, app) {

    function initPopup() {

        $('.js-call-popup').on('click', function (e) {
            e.preventDefault();
            $('html').css({
                'overflow': 'hidden',
                'margin-right': '17px',
            });
            let target = $(this).attr('data-target');
            let popup = $('#' + target);
            let block = popup.find('.popup');
            popup.fadeIn(0);
            block.addClass('popup-anim');
        });

        $('.js-popup-close').on('click', function () {
            let popups = $('.popup-wrapper');
            let popup = $(this).closest('.popup-wrapper');
            popup.fadeOut(0);
            $(this).closest('.popup').removeClass('popup-anim');
            let overflow = true;
            popups.each(function (i, e) {
                if ($(e).css('display') === 'block' && $(e).attr('id') !== popup.attr('id')) {
                    overflow = false;
                }
            });
            if (overflow) {
                $('html').css({
                    'overflow': '',
                    'margin-right': '0',
                });
            }
        });

        $(document).mouseup(function (e) {
            let target = e.target.className;
            if ((target === 'popup-wrapper' || target === 'popup-wrapper__wrap') 
                && e.pageX + 18 < $(window).width()) {
                    let block;
                    if (target === 'popup-wrapper__wrap') {
                        block = $(e.target.closest('.popup-wrapper'));
                    } else {
                        block = $(e.target);
                    }
                    block.find('.popup').removeClass('popup-anim');
                    block.fadeOut(0);

                    let overflow = true;
                    let popups = $('.popup-wrapper');

                    popups.each(function (i, e) {
                        console.log($(e).css('display'))
                        if ($(e).css('display') === 'block') {
                            overflow = false;
                        }
                    });

                    if (overflow) {
                        $('html').css({
                            'overflow': '',
                            'margin-right': '0',
                        });
                    }
            }
        });
    }

    app.initPopup = initPopup;
})(jQuery, window.app);
