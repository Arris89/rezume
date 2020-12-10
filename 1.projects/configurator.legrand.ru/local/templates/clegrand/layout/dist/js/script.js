"use strict";

(function ($, app) {
  $(function () {
    app.initMask();
    app.initPopup();
    app.initMagnific();
    app.initMap();
    app.initConfigurator();
    app.initMenu();
    app.initCategory();
    $('body').on('click', '.js-toggle-panel', function () {
      if ($(window).width() < 768) {
        $('.panel-personal__block').slideToggle(300);
      }
    });
    $('body').on('click', '.js-order-filter', function () {
      $(this).closest('.r-order').addClass('active');
    });
    $('body').on('click', '.js-order-filter-close', function () {
      $(this).closest('.r-order').removeClass('active');
    }); // $('body').on('click', '.js-call-frame', function() {
    //     $('.config-bottom-settings__popup_frames').fadeIn(300);
    //     $('.config-bottom-settings__popup_mechanism').fadeOut(300);
    // });
    // $('body').on('click', '.js-call-mechanism', function() {
    //     $('.config-bottom-settings__popup_mechanism').fadeIn(300);
    //     $('.config-bottom-settings__popup_frames').fadeOut(300);
    // });

    $('body').on('click', '.js-close-window', function () {
      $(this).closest('.window').fadeOut(300);
    });
    $('body').on('click', '.js-close-p-window', function () {
      $(this).closest('.p-window').fadeOut(0);
    });
    $('body').on('mouseover', '.window-holder', function () {
      $(this).find('.p-window').css('display', '');
    });
    $('body').on('click', '.js-show-cities, .js-city-change', function () {
      $('.section-header__cities').slideToggle(300);
    });
    $('body').on('click', '.js-pick-city', function (e) {
      e.preventDefault();
      $('.your-city').addClass('accepted');
      $('.section-header__cities').slideUp(300);
      $('.your-city__value').html($(this).text());
    });
    $('body').on('click', '.js-city-accept', function () {
      $(this).closest('.your-city').addClass('accepted');
    });
    $('body').on('change', '.js-scroll-select', function () {
      app.scrollToElement($('.config-main'), 500);
    }); // kit-number

    $('body').on('click', '.kit-number__btn', function () {
      var kit = $(this).closest('.kit-number');
      var prefix = kit.hasClass('kit-number_str') ? ' шт.' : '';
      var value = parseInt(kit.find('.kit-number__value').html());

      if ($(this).hasClass('kit-number__btn_plus')) {
        value += 1;
        kit.find('.kit-number__value').html(value + prefix);
      } else if (value > 1) {
        value -= 1;
        kit.find('.kit-number__value').html(value + prefix);
      }

      if (kit.data('target')) {
        var parent = kit.closest(kit.data('parent'));
        parent.find($(kit.data('target'))).html((value * parent.data('price')).toFixed(2));
        console.log('chang');
      }
    });
    $('select:not(.basic)').selectric({
      onInit: function onInit() {
        $(this).closest('.selectric-wrapper').find('li:first-child').text('Сбросить');
      }
    }); // $(".lazy").Lazy({
    //     event: "lazyScroll",
    //     beforeLoad: function(element) {
    //         // called before an elements gets handled
    //     },
    //     afterLoad: function(element) {
    //         console.log('loaded')
    //     },
    //     onError: function(element) {
    //         // called whenever an element could not be handled
    //     },
    //     onFinishedAll: function() {
    //         console.log('all')
    //     }
    // });

    $('body').on('click', '.js-call-window', function () {
      var data = $(this).data('target');
      $('.config-goods, .air-select').fadeOut(300);
      $(data).fadeIn(300);

      if (data.includes('frame')) {
        $('.air-select_frame').fadeIn(300);
      }

      if (data.includes('mechanism')) {
        $('.air-select_mechanism').fadeIn(300);
      }
    });
    $('.js-close-goods').on('click', function () {
      var main = $(this).closest('.config-goods');
      $(this).closest('.config-goods').fadeOut(300); // фильтры

      if (main.hasClass('config-goods_frames')) {
        $('.air-select_frame').fadeOut(300);
      } else if (main.hasClass('config-goods_mechanisms')) {
        $('.air-select_mechanism').fadeOut(300);
      }
    }); // lazy

    var instance = $('.lazy').lazy({
      chainable: false
    }); // grab from elements
    // only works well if you use same selector or a single instance overall

    $('.lazy').lazy();
    $('body').on('click', function () {
      instance.update();
    }); // new

    $('body').on('click', '.js-toggle-composition', function (e) {
      e.preventDefault();
      var parent = $(this).closest('.kit-good-block');
      var details = parent.find('.kit-good-block__details');

      if (!parent.hasClass('active')) {
        details.slideDown(300);
        parent.addClass('active');
        $(this).text('Скрыть состав');
      } else {
        details.slideUp(300);
        parent.removeClass('active');
        $(this).text('Посмотреть состав');
      }
    });
  });
})(jQuery, window.app);