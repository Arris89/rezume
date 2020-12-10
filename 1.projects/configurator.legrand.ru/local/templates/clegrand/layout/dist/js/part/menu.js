"use strict";

(function ($, app) {
  function initMenu() {
    $('.js-slide-menu').on('click', function () {
      $('.js-menu').toggleClass('js-menu-active');
      $(this).toggleClass('hamgurber-active');

      if ($(this).hasClass('hamgurber-active')) {
        $('html').addClass('html-overflow');
      } else {
        $('html').removeClass('html-overflow');
      }
    });
    $('.js-close-menu').on('click', function () {
      $('.js-menu').removeClass('js-menu-active');
      $('.hamburger').removeClass('hamgurber-active');
      $('html').removeClass('html-overflow');
    });
  }

  app.initMenu = initMenu;
})(jQuery, window.app);