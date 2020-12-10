"use strict";

(function ($) {
  function app(version, token, on_page, model, page) {
    app.version = version;
    app.token = token;
    app.on_page = on_page;
    app.model = model;
    app.page = page;
  }
  /**
   * Прокручиваем страницу к блоку
   * @param {object} element - элемент на странице
   * @param {int} speed - скорость прокрутки
   * @param {function} callback - колбек
   * @param {int} diff - отступ от верхнего края окна до элемента
   */


  function scrollToElement(element, speed, callback, diff) {
    scrollToPos(element.offset().top - 95, speed, callback, diff);
  }
  /**
   * Прокручиваем страницу к позиции
   * @param {int} pos - позиция на странице
   * @param {int} speed - скорость прокрутки
   * @param {function} callback - колбек
   * @param {int} diff - отступ от верхнего края окна до элемента
   */


  function scrollToPos(pos, speed, callback, diff) {
    callback = callback || function () {};

    jQuery('html, body').animate({
      scrollTop: pos + (diff || 0)
    }, speed, function () {
      callback();
    });
  }
  /**
   * Загружаем ссылку ajax
   * @param {string} url ссылка которую необходимо открыть
   * @param {function} callback функция обратного вызова
   * @param {object} data массив данных для отправки
   */


  function load(url, callback, data) {
    callback = callback || function () {};

    data.token = app.token;
    $.ajax({
      url: url,
      dataType: 'json',
      type: 'POST',
      data: data
    }).then(function (data) {
      return callback(data);
    }).fail(function (data) {
      console.warn('data', data);
    });
  }

  function isMobileAgent() {
    if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) {
      return true;
    } else {
      return false;
    }
  }

  app.img = [];
  app.isMobile = $(window).width() < 768;
  app.isDesktop = $(window).width() > 1023;
  app.isTablet = !app.isDesktop;
  app.scrollToElement = scrollToElement;
  app.isMobileAgent = isMobileAgent;
  app.scrollToPos = scrollToPos;
  app.load = load;
  window.app = app;
})(jQuery);