"use strict";

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

var showShop = null;
BX.ready(function () {
  // smart.filter
  var $form = $('form[name="shopsFilter"]');
  $form.on('submit', function (evt) {
    evt.preventDefault();
    updateFilter();
  });
  var $selectCity = $('.js-form-city', $form);
  var $selectMetro = $('.js-form-metro', $form);
  var cityDefaultVal = $selectCity.val();

  var onSelectricInit = function onSelectricInit() {
    var currentValue = $(this).val();
    var option = $(this).find('option:first-child');
    var wrapper = $(this).closest('.selectric-wrapper');

    if (!option.data('value')) {
      option.attr('data-value', option.text().trim());
      option.text('Сбросить');
      wrapper.find('li:first-child').text('Сбросить');
    }

    if (currentValue === option.attr('value')) {
      wrapper.find('span.label').text(option.data('value'));
    }
  };

  var onSelectricRefresh = function onSelectricRefresh() {
    $(this).val('');
    var option = $(this).find('option:first-child');
    var wrapper = $(this).closest('.selectric-wrapper');
    option.attr('data-value', option.text().trim());
    option.text('Сбросить');
    wrapper.find('li:first-child').text('Сбросить');
    wrapper.find('span.label').text(option.data('value'));
  };

  $selectMetro.selectric({
    onInit: onSelectricInit,
    onRefresh: onSelectricRefresh
  });
  $selectCity.selectric({
    onInit: onSelectricInit
  });
  updateMetro();
  $selectCity.on('change', function () {
    updateMetro();
    updateFilter();
  });
  $selectMetro.on('change', updateFilter);
  $('.js-form-checkbox', $form).on('input', updateFilter);
  $('.js-filter-reset').on('click', function () {
    $form[0].reset();
    updateFilter();
    $selectCity.val(cityDefaultVal).selectric('refresh');
    updateMetro();
  });

  function updateMetro() {
    var curCity = $selectCity.find('option:selected').data('id');
    var $enableMetros = $('[class=f-metro-' + curCity + ']', $form);
    $selectMetro.prop('disabled', $enableMetros.length === 0);
    $selectMetro.selectric('refresh');

    if ($enableMetros.length > 0) {
      $('[class^=f-metro-]', $form).hide();
      $('[class=f-metro-' + curCity + ']', $form).show();
    }
  }

  function updateFilter() {
    var sendData = $form.serializeArray();
    BX.showWait();
    var url = window.location.pathname;
    var querySend = '';
    sendData.forEach(function (item) {
      var value = item.value;

      if (value !== '') {
        querySend += '&' + item.name + '=' + item.value;
      }
    });
    querySend = '?shops-ajax=y&set_filter=y' + querySend;
    loadContent(url + querySend);
  } //


  function loadContent(url) {
    $('.js-shops-ajax').load(url, function () {
      BX.closeWait();
      showTab();
      initListeners();
      showShop = null;
    });
  }

  function initListeners() {
    // аякс-пагинация
    $('.modern-page-navigation a').on('click', function (evt) {
      evt.preventDefault();
      BX.showWait();
      var url = this.href + '&shops-ajax=y&set_filter=y';
      loadContent(url);
    }); // показать магазин ка карте

    $('.js-show-shop').on('click', function () {
      showShop = $(this).data('id');

      if (+showShop > 0) {
        $('.js-tab-btn a[data-target=".js-type-map"]').trigger('click');
      }
    });
  }

  initListeners(); // карта и табы

  var $toggleBtns = $('.js-tab-btn a');
  $toggleBtns.on('click', function (evt) {
    evt.preventDefault();
    var $this = $(this);

    if (!$this.hasClass('active')) {
      $toggleBtns.removeClass('active');
      $this.addClass('active');
      showTab();
    }
  });

  function showTab() {
    var $curActive = $toggleBtns.filter('.active');
    var $target = $($curActive.data('target'));

    if ($target.length > 0) {
      $('.r-order__map').hide();
      $target.show();
    }

    if ($curActive.data('target') === '.js-type-map') {
      $target.html('');
      ymaps.ready(initMap);
    } else {
      showShop = null;
    }
  }
});

function initMap() {
  var mapContainer = document.getElementById('shops-map');
  var items = document.shops.items;
  var mapParams;

  if (showShop) {
    items = items.filter(function (it) {
      return +it.id === +showShop;
    });

    if (items.length === 0) {
      return false;
    }

    ;
    mapParams = {
      center: items[0].coords,
      zoom: 15
    };
  } else {
    mapParams = ymaps.util.bounds.getCenterAndZoom(document.shops.bounds, [mapContainer.offsetWidth, mapContainer.offsetHeight]);
  }

  if (mapParams.zoom > 16) {
    mapParams.zoom = 16;
  }

  var myMap = new ymaps.Map('shops-map', _objectSpread({}, mapParams, {
    controls: ['zoomControl']
  }));
  var MyBalloonLayout = ymaps.templateLayoutFactory.createClass('<div class="popover top">' + '<a class="close" href="#"></a>' + '<div class="arrow"></div>' + '<div class="popover-inner">' + '$[[options.contentLayout observeSize minWidth=235 maxWidth=525 maxHeight=350]]' + '</div>' + '</div>', {
    /**
     * Строит экземпляр макета на основе шаблона и добавляет его в родительский HTML-элемент.
     * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/layout.templateBased.Base.xml#build
     * @function
     * @name build
     */
    build: function build() {
      var _this = this;

      this.constructor.superclass.build.call(this);
      this._$element = $('.popover', this.getParentElement());
      this.applyElementOffset();

      this._$element.find('.close').on('click', $.proxy(this.onCloseClick, this));

      $(window).on('resize', function () {
        _this.applyElementOffset();

        _this.events.fire('shapechange');
      });
    },

    /**
     * Удаляет содержимое макета из DOM.
     * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/layout.templateBased.Base.xml#clear
     * @function
     * @name clear
     */
    clear: function clear() {
      this._$element.find('.close').off('click');

      this.constructor.superclass.clear.call(this);
    },

    /**
     * Метод будет вызван системой шаблонов АПИ при изменении размеров вложенного макета.
     * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/IBalloonLayout.xml#event-userclose
     * @function
     * @name onSublayoutSizeChange
     */
    onSublayoutSizeChange: function onSublayoutSizeChange() {
      MyBalloonLayout.superclass.onSublayoutSizeChange.apply(this, arguments);

      if (!this._isElement(this._$element)) {
        return;
      }

      this.applyElementOffset();
      this.events.fire('shapechange');
    },

    /**
     * Сдвигаем балун, чтобы "хвостик" указывал на точку привязки.
     * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/IBalloonLayout.xml#event-userclose
     * @function
     * @name applyElementOffset
     */
    applyElementOffset: function applyElementOffset() {
      this._$element.css({
        left: -(this._$element[0].offsetWidth / 2),
        top: -(this._$element[0].offsetHeight + this._$element.find('.arrow')[0].offsetHeight)
      });
    },

    /**
     * Закрывает балун при клике на крестик, кидая событие "userclose" на макете.
     * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/IBalloonLayout.xml#event-userclose
     * @function
     * @name onCloseClick
     */
    onCloseClick: function onCloseClick(e) {
      e.preventDefault();
      this.events.fire('userclose');
    },

    /**
     * Используется для автопозиционирования (balloonAutoPan).
     * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/ILayout.xml#getClientBounds
     * @function
     * @name getClientBounds
     * @returns {Number[][]} Координаты левого верхнего и правого нижнего углов шаблона относительно точки привязки.
     */
    getShape: function getShape() {
      if (!this._isElement(this._$element)) {
        return MyBalloonLayout.superclass.getShape.call(this);
      }

      var position = this._$element.position();

      return new ymaps.shape.Rectangle(new ymaps.geometry.pixel.Rectangle([[position.left, position.top], [position.left + this._$element[0].offsetWidth, position.top + this._$element[0].offsetHeight + this._$element.find('.arrow')[0].offsetHeight]]));
    },

    /**
     * Проверяем наличие элемента (в ИЕ и Опере его еще может не быть).
     * @function
     * @private
     * @name _isElement
     * @param {jQuery} [element] Элемент.
     * @returns {Boolean} Флаг наличия.
     */
    _isElement: function _isElement(element) {
      return element && element[0] && element.find('.arrow')[0];
    }
  });
  var MyBalloonContentLayout = ymaps.templateLayoutFactory.createClass('<div class="shops shops_balloon">' + '<div class="shops__block">' + '<h3 class="popover-title">$[properties.balloonHeader]</h3>' + '<div class="popover-content">$[properties.balloonContent]</div>' + '</div>' + '</div>');
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
      balloonHeader: "<div class=\"shops__head\">\n                  <div class=\"shops__title\">".concat(item.name ? item.name : '', "\n                  </div>\n                  <div class=\"shops__link\">\n                    ").concat(item.site ? '<a href="//' + item.site + '">' + item.site + '</a>' : '', "\n                  </div>\n                </div>"),
      balloonContent: "<div class=\"shops__content\">\n                  <div class=\"shops__visible\">\n                    <div class=\"shops__place\">".concat(item.address ? item.address : '', "\n                    </div>\n                    <div class=\"shops__info\">\n                        ").concat(item.metro ? '<div class="shops__metro">' + item.metro + '</div>' : '', "\n                        ").concat(item.phone ? '<div class="shops__phone">' + item.phone + '</div>' : '', "\n                    </div>\n                  </div>\n                  <div class=\"shops__invisible\">\n                    ").concat(item.collections ? '<div class="shops__collections">Коллекции: ' + item.collections + '</div>' : '', "\n                    ").concat(item.working ? "<div class=\"shops__time\">\n                      <div class=\"shops__time-item\"> ".concat(item.working, "\n                      </div>\n                    </div>") : '', "\n                  </div>\n                </div>\n                ").concat(item.site ? '<div class="shops__show"><div class="my-btn balloon-btn"><a href="//' + item.site + '" target="_blank" class="my-btn__text"><span class="pc-show">Перейти на сайт</span><span class="laptop-show">Перейти</span></a></div></div>' : ''),
      hintContent: ''
    }, {
      balloonLayout: MyBalloonLayout,
      balloonContentLayout: MyBalloonContentLayout,
      balloonMaxWidth: 570,
      balloonPanelMaxMapArea: 0,
      iconLayout: 'default#image',
      iconImageHref: '/local/templates/clegrand/img/configurator/map/marker.png',
      iconImageSize: [31, 39],
      iconImageOffset: [-15, -23]
    });
  });
  clusterer.add(geoObjects);
  myMap.geoObjects.add(clusterer);

  if (showShop) {
    geoObjects[0].balloon.open();
  }
}

BX.showWait = function () {
  $('.js-preloader').show();
};

BX.closeWait = function () {
  $('.js-preloader').hide();
};