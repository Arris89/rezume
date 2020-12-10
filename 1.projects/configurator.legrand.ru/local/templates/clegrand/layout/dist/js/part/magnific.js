"use strict";

(function ($, app) {
  var initMagnific = function initMagnific() {
    var mainWrap = $('body');

    function scrollbarWidth() {
      var documentWidth = document.documentElement.clientWidth;
      var windowsWidth = window.innerWidth;
      var scrollbarWidth = windowsWidth - documentWidth;
      return scrollbarWidth;
    }

    function overlowed() {
      var pr = scrollbarWidth() + 'px';
      mainWrap.addClass('page_crowded');
      mainWrap.css({
        'padding-right': pr
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
          beforeOpen: function beforeOpen() {
            setTimeout(overlowed, 25);
          },
          beforeClose: function beforeClose() {
            setTimeout(scrolled, 250);
          }
        }
      });
    }

    $('body').on('click', '.js-close-popup', function () {
      var popup = $(this).closest('.popup');
      popup.magnificPopup('close');
    });
  };

  app.initMagnific = initMagnific;
})(jQuery, window.app);