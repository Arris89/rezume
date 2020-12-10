"use strict";
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }
function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }
function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

BX.ready(function () {
  ymaps.ready(initMap);
});

function initMap() {
  var mapContainer = document.getElementById('shops-map');
  var items = document.shops.items;
  var mapParams =  {
    center: [55.755941, 37.621263],
    zoom: 10
  };

  var myMap = new ymaps.Map('shops-map', _objectSpread({}, mapParams, {
    controls: ['zoomControl']
  }));

  var BalloonContentLayout = function BalloonContentLayout(item) {
    return ymaps.templateLayoutFactory.createClass("<div class=\"shops shops_balloon\">\n          <div class=\"shops__block\">\n            <div class=\"shops__head\">\n              <div class=\"shops__title\">".concat(item.name ? item.name : '', "\n              </div>\n              <div class=\"shops__link\">\n                ").concat(item.site ? '<a href="' + item.site_href + '">' + item.site + '</a>' : '', "\n              </div>\n            </div>\n            <div class=\"shops__content\">\n              <div class=\"shops__visible\">\n                <div class=\"shops__place\">").concat(item.address ? item.address : '', "\n                </div>\n                <div class=\"shops__info\">\n                    ").concat(item.metro ? '<div class="shops__metro">' + item.metro + '</div>' : '', "\n                    ").concat(item.phone ? '<div class="shops__phone">' + item.phone + '</div>' : '', "\n                </div>\n              </div>\n              <div class=\"shops__invisible\">\n                ").concat(item.collections ? '<div class="shops__collections">Коллекции: ' + item.collections + '</div>' : '', "\n                ").concat(item.delivery ? '<div class="shops__delivery">Есть доставка</div>' : '', "\n                    ").concat(item.pay_card ? '<div class="shops__pay-card">Есть оплата картой</div>' : '', "\n                    ").concat(item.working ? "<div class=\"shops__time\">\n                  <div class=\"shops__time-item\"> ".concat(item.working, "\n                  </div>\n                </div>") : '', "\n              </div>\n            </div>\n            </div>\n        </div>"));
  };

  myMap.behaviors.disable('scrollZoom'); // кластеризация

  var clusterer = new ymaps.Clusterer({
    preset: 'islands#invertedOliveClusterIcons',
    clusterHideIconOnBalloonOpen: false,
    geoObjectHideIconOnBalloonOpen: false,
    gridSize: 60,
    clusterIcons: [{
      href: '/local/templates/clegrand/img/configurator/map/cluster.png',
      size: [46, 46],
      offset: [-23, -23]
    }]
  });
  var geoObjects = [];
  items.forEach(function (item, i) {
    geoObjects[i] = new ymaps.Placemark(item.coords, {
      hintContent: ''
    }, {
      balloonContentLayout: BalloonContentLayout(item),
      balloonMaxWidth: 570,
      iconLayout: 'default#image',
      iconImageHref: '/local/templates/clegrand/img/configurator/map/marker.png',
      iconImageSize: [31, 39],
      iconImageOffset: [-15, -23]
    });
  });
  clusterer.add(geoObjects);
  myMap.geoObjects.add(clusterer);
}