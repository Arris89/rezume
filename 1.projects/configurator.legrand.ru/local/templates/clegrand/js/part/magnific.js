(function ($, app) {

    let initMagnific = function() {
        let mainWrap = $('body');

        function scrollbarWidth() {
            let documentWidth = document.documentElement.clientWidth;
            let windowsWidth = window.innerWidth;
            let scrollbarWidth = windowsWidth - documentWidth;
            return scrollbarWidth;
        }

        function overlowed() {
            let pr = scrollbarWidth() + 'px';

            mainWrap.addClass('page_crowded');
            mainWrap.css({
                'padding-right': pr,
            });
        }

        function scrolled() {
            mainWrap.removeClass('page_crowded');
            mainWrap.attr('style', '');
        }

        if ($('.popup-with-move-anim').length) {
            $('.popup-with-move-anim').magnificPopup({
                type: 'inline',
                fixedContentPos: false,
                fixedBgPos: true,
                removalDelay: 300,
                mainClass: 'my-mfp-slide-bottom',
                callbacks: {
                    beforeOpen: function () {
                        // setTimeout(overlowed, 25);
                    },
                    beforeClose: function () {
                        // setTimeout(scrolled, 250);
                    }
                }
            });
        }

        $('body').on('click', '.js-close-popup', function() {
            let popup = $(this).closest('.popup');
            popup.magnificPopup('close');
        });
    }

    app.initMagnific = initMagnific;
})(jQuery, window.app);