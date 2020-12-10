"use strict";

(function ($, app) {
  function initMap() {// ymaps.ready(init);
  }

  function init() {
    if ($('#r-order-map').length < 1) {
      return false;
    }

    var zm = 14;
    var coords = [51.661953505612296, 39.14955035581963];
    var myMap = new ymaps.Map('r-order-map', {
      center: coords,
      zoom: zm,
      controls: ['zoomControl']
    });
    var clusterer = new ymaps.Clusterer({
      preset: 'islands#invertedRedClusterIcons',
      clusterHideIconOnBalloonOpen: false,
      geoObjectHideIconOnBalloonOpen: false,
      gridSize: 100
    });
    var BalloonContentLayout = ymaps.templateLayoutFactory.createClass("<div class=\"balloon\">\n            <div class=\"balloon__title\">ANS Group\n            </div>\n            <div class=\"balloon__place\">\u041C\u043E\u0441\u043A\u0432\u0430, \u0443\u043B. \u0421\u043A\u043E\u0442\u043E\u043F\u0440\u043E\u0433\u043E\u043D\u043D\u0430\u044F, \u0434\u043E\u043C 27/26, \u0441\u0442\u0440\u043E\u0435\u043D\u0438\u0435 1, \u0411\u0426 \"\u0420\u0422\u0421\", 2 \u044D\u0442\u0430\u0436, \u043E\u0444\u0438\u0441 201\n            </div>\n            <div class=\"balloon__contacts\">\n              <div class=\"balloon__phone\"><a href=\"tel:+74951222259\">+7 (495) 122-22-59</a>\n              </div>\n              <div class=\"balloon__metro\">\u0412\u043E\u043B\u043E\u043A\u043E\u043B\u0430\u043C\u0441\u043A\u0430\u044F\n              </div>\n              <div class=\"balloon__link\"><a href=\"www.220city.ru\">www.220city.ru</a>\n              </div>\n            </div>\n            <div class=\"balloon__bottom\">\n              <div class=\"balloon__collection\">\u041A\u043E\u043B\u043B\u0435\u043A\u0446\u0438\u0438: Celiane, Etika, Livinglight, Valena Allure, Valena Life\n              </div>\n              <div class=\"balloon__time\">\n                <div class=\"balloon__time-item\">\u041F\u043D-\u043F\u0442: \u0441 8:00 \u0434\u043E 19:45\n                </div>\n                <div class=\"balloon__time-item\">\u0421\u0431-\u0432\u0441: \u0441 10:00 \u0434\u043E 17:45\n                </div>\n              </div>\n            </div>\n            <div class=\"balloon__btn\">\n              <div class=\"my-btn\">\n                <div class=\"my-btn__text\">\u0412\u044B\u0431\u0440\u0430\u0442\u044C \u043C\u0430\u0433\u0430\u0437\u0438\u043D\n                </div>\n              </div>\n            </div>\n          </div>");
    myMap.behaviors.disable('scrollZoom');
    var myPlacemark = new ymaps.Placemark(coords, {
      hintContent: ''
    }, {
      balloonContentLayout: BalloonContentLayout,
      balloonMaxWidth: 570,
      iconLayout: 'default#image',
      iconImageHref: 'img/configurator/map/marker.png',
      iconImageSize: [31, 39],
      iconImageOffset: [-15, -23]
    });
    var myPlacemark2 = new ymaps.Placemark([51.671953505612296, 39.16955035581963], {
      hintContent: ''
    }, {
      balloonContentLayout: BalloonContentLayout,
      balloonMaxWidth: 570,
      iconLayout: 'default#image',
      iconImageHref: 'img/configurator/map/marker.png',
      iconImageSize: [31, 39],
      iconImageOffset: [-15, -23]
    });
    myMap.geoObjects.add(myPlacemark).add(myPlacemark2);
  }

  app.initMap = initMap;
})(jQuery, window.app);