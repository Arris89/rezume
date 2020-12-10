"use strict";

(function ($, app) {
  function initMap() {
    ymaps.ready(init);
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
    }); // let BalloonContentLayout = ymaps.templateLayoutFactory.createClass(`<div class="balloon">
    //     <div class="balloon__title">ANS Group
    //     </div>
    //     <div class="balloon__place">Москва, ул. Скотопрогонная, дом 27/26, строение 1, БЦ "РТС", 2 этаж, офис 201
    //     </div>
    //     <div class="balloon__contacts">
    //       <div class="balloon__phone"><a href="tel:+74951222259">+7 (495) 122-22-59</a>
    //       </div>
    //       <div class="balloon__metro">Волоколамская
    //       </div>
    //       <div class="balloon__link"><a href="www.220city.ru">www.220city.ru</a>
    //       </div>
    //     </div>
    //     <div class="balloon__bottom">
    //       <div class="balloon__collection">Коллекции: Celiane, Etika, Livinglight, Valena Allure, Valena Life
    //       </div>
    //       <div class="balloon__time">
    //         <div class="balloon__time-item">Пн-пт: с 8:00 до 19:45
    //         </div>
    //         <div class="balloon__time-item">Сб-вс: с 10:00 до 17:45
    //         </div>
    //       </div>
    //     </div>
    //     <div class="balloon__btn">
    //       <div class="my-btn">
    //         <div class="my-btn__text">Выбрать магазин
    //         </div>
    //       </div>
    //     </div>
    //   </div>`);

    var BalloonContentLayout = ymaps.templateLayoutFactory.createClass("<div class=\"shops shops_balloon\">\n            <div class=\"shops__item\">\n              <div class=\"shops__block\">\n                <div class=\"shops__head\">\n                  <div class=\"shops__title\">ANS Group\n                  </div>\n                  <div class=\"shops__link\"><a href=\"#\">http://www.antelectric.ru/category/legrandhttp://www.antelectric.ru/category/legrand</a>\n                  </div>\n                </div>\n                <div class=\"shops__content\">\n                  <div class=\"shops__visible\">\n                    <div class=\"shops__place\">\u041C\u043E\u0441\u043A\u0432\u0430, \u0443\u043B. \u0421\u043A\u043E\u0442\u043E\u043F\u0440\u043E\u0433\u043E\u043D\u043D\u0430\u044F, \u0434\u043E\u043C 27/26, \u0441\u0442\u0440\u043E\u0435\u043D\u0438\u0435 1, \u0411\u0426 \"\u0420\u0422\u0421\", 2 \u044D\u0442\u0430\u0436, \u043E\u0444\u0438\u0441 201\n                    </div>\n                    <div class=\"shops__info\">\n                      <div class=\"shops__metro\">\u0412\u043E\u043B\u043E\u043A\u043E\u043B\u0430\u043C\u0441\u043A\u0430\u044F\n                      </div>\n                      <div class=\"shops__phone\"><a href=\"tel:+74951222259\">+7 (495) 122-22-59</a>\n                      </div>\n                    </div>\n                  </div>\n                  <div class=\"shops__invisible\">\n                    <div class=\"shops__collections\">\u041A\u043E\u043B\u043B\u0435\u043A\u0446\u0438\u0438: Celiane, Etika, Livinglight, Valena Allure, Valena Life\n                    </div>\n                    <div class=\"shops__time\">\n                      <div class=\"shops__time-item\">\u041F\u043D-\u043F\u0442: \u0441 8:00 \u0434\u043E 19:45\n                      </div>\n                      <div class=\"shops__time-item\">\u0421\u0431-\u0432\u0441: \u0441 10:00 \u0434\u043E 17:45\n                      </div>\n                    </div>\n                  </div>\n                </div>\n                <div class=\"shops__show\">\n                    <a href=\"#\">\n                        <div class=\"my-btn balloon-btn\">\n                        <disableiv class=\"my-btn__text\"><span class=\"pc-show\">\u0412\u044B\u0431\u0440\u0430\u0442\u044C \u043C\u0430\u0433\u0430\u0437\u0438\u043D</span><span class=\"laptop-show\">\u0412\u044B\u0431\u0440\u0430\u0442\u044C</span>\n                        </div>\n                      </div>\n                    </a>\n                </div>\n              </div>\n            </div>\n        </div>");
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
      // balloonMaxHeight: 200,
      iconLayout: 'default#image',
      iconImageHref: 'img/configurator/map/marker.png',
      iconImageSize: [31, 39],
      iconImageOffset: [-15, -23]
    });
    myMap.geoObjects.add(myPlacemark).add(myPlacemark2);
  }

  app.initMap = initMap;
})(jQuery, window.app);