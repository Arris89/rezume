"use strict";

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance"); }

function _iterableToArrayLimit(arr, i) { if (!(Symbol.iterator in Object(arr) || Object.prototype.toString.call(arr) === "[object Arguments]")) { return; } var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

$(function () {
  var items = [];
  var itemsSelector = '#speclist .m-table__body';
  var totalPrice = $('#pricespec');
  var panelTotalPrice = $('#priceitem span');
  var positionsBlock = $('#numitem');
  var clearItemsSelector = '.js-clear-spec';
  totalPrice.html(0);

  var has = function has(arr, id) {
    return arr.findIndex(function (e) {
      return e.id === id;
    });
  };

  var getTotalPrice = function getTotalPrice() {
    var rub = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : true;
    var total = items.reduce(function (acc, e) {
      return acc + parseFloat(e.price) * e.count;
    }, 0).toFixed(2).toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
    /*total = (total.toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 '));
    rub = (rub.toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ')); */

    return rub ? total + ' руб.' : total;
  };

  var removeItem = function removeItem(index) {
    items.splice(index, 1);
    $(itemsSelector).eq(index).remove();
    renderView();
  };

  var clearItems = function clearItems() {
    items.length = 0;
    $(itemsSelector).remove();
    renderView();
  };

  var addItem = function addItem(data) {
    items.push(data);
    $('.m-table__content').append(renderItem(data));
    renderView();
  };

  var rerenderItem = function rerenderItem(index, data) {
    $(itemsSelector).eq(index).replaceWith(renderItem(data));
    renderView();
  };

  var renderView = function renderView() {
    var total = getTotalPrice(false);
    totalPrice.html(total);
    panelTotalPrice.html(total);
    positionsBlock.html(items.length + ' ' + getPositionText(items.length));
    localStorage.setItem('specification_items', JSON.stringify(items));
    console.log(items);
  };

  var getPositionText = function getPositionText(number) {
    if (number === 1) {
      return 'позиция';
    } else if (number > 1 && number < 5) {
      return 'позиции';
    } else {
      return 'позиций';
    }
  };

  var renderItem = function renderItem(data) {
    data['countPrice'] = Math.floor(data['count'] * data['price'] * 100) / 100;

    var _data$collectionCode$ = data['collectionCode'].split(':'),
        _data$collectionCode$2 = _slicedToArray(_data$collectionCode$, 2),
        collectionCode = _data$collectionCode$2[0],
        sectionCode = _data$collectionCode$2[1];

    var specificationItem = '<div class="m-table__body">' + '<div class="m-table__body-item m-table-column-1">' + '<div class="m-table__desktop">' + '<div class="kit-good">' + '<div class="kit-good__image ' + collectionCode + ' ' + sectionCode + ' window-holder">' + '<img src="' + data['picture'] + '" role="presentation">' + '<div class="p-window">' + '<div class="p-window__close">' + '<div class="close-icon js-close-p-window"></div>' + '</div>' + '<div class="p-window__wrap">' + '<div class="breaker breaker_2">' + '<div class="breaker__top">' + '<div class="breaker__top-left">' + '<img src="' + data['picture'] + '" alt="' + data['title'] + '">' + '</div>' + '<div class="breaker__top-right">' + '<div class="breaker__title">' + data['title'] + '</div>' + '<div class="breaker__price">Цена ' + data['countPrice'] + ' руб.</div>' + '</div>' + '</div>' + '<p class="breaker__desc">' + 'Описание' + '</p>' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="kit-good__content">' + '<div class="kit-good__name">' + data['articul'] + '</div>' + '<div class="kit-good__text">' + data['title'] + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="m-table__mob">' + '<strong>' + data['articul'] + ' ' + '</strong>' + data['title'] + '</div>' + '</div>' + '<div class="m-table__body-item m-table-column-2">' + '<div class="m-table__desktop">' + '<div class="kit-number kit-number_centered">' + '<div class="kit-number__btn kit-number__btn_min desc">-</div>' + '<div class="kit-number__value">' + data['count'] + '</div>' + '<div class="kit-number__btn kit-number__btn_plus">+</div>' + '</div>' + '</div>' + '<div class="m-table__mob">' + '<div class="m-table__row">' + '<div class="m-table__row-left">' + '<div class="kit-mob">' + '<div class="kit-mob__image">' + '<img src="' + data['picture'] + '" role="presentation">' + '</div>' + '<div class="kit-mob__price">ЦЕНА:</div>' + '<div class="kit-mob__price-val">' + data['countPrice'] + ' руб.</div>' + '</div>' + '</div>' + '<div class="m-table__row-right">' + '<div class="kit-number kit-number_centered">' + '<div class="kit-number__btn kit-number__btn_min">-</div>' + '<div class="kit-number__value">' + data['count'] + '</div>' + '<div class="kit-number__btn kit-number__btn_plus">+</div>' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="m-table__body-item m-table-column-3">' + '<strong class="itemprice" data-ids="' + data['id'] + '">' + data['countPrice'].toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ') + ' руб.</strong>' + '</div>' + '<div class="m-table__body-remove">' + '<div class="icon-text icon-text_hover js-remove-item">' + '<div class="icon-text__icon">' + '<div class="close-icon"></div>' + '</div>' + '<div class="icon-text__text">Удалить</div>' + '</div>' + '</div>' + '</div>';
    return specificationItem;
  };

  var buildItems = function buildItems(data) {
    if (data === null) return;
    data.forEach(function (item) {
      addItem(item);
    });
  };

  $('body').on('click', '.btn-add-spec-js', function () {
    var _this = $(this),
        itemBlock = _this.closest('.search__item');

    var data = {
      id: itemBlock.data('id'),
      articul: itemBlock.data('articul'),
      title: itemBlock.data('title'),
      picture: itemBlock.data('picture'),
      count: parseInt(itemBlock.find('.kit-number__value').html()),
      price: itemBlock.data('price'),
      collectionCode: itemBlock.data('collection-code') + ':' + itemBlock.data('section-code')
    };
    var index = has(items, data.id);

    if (index === -1) {
      addItem(data);
    } else {
      items[index].count += data.count;
      rerenderItem(index, items[index]);
    }

    $('.search-result-js').hide();
  }); // items

  $('body').on('click', '#speclist .kit-number__btn', function () {
    var _this = $(this),
        item = _this.closest('.m-table__body'),
        index = item.index(),
        count = parseInt(_this.closest('.kit-number').find('.kit-number__value').html(), 10);

    items[index].count = count;
    rerenderItem(index, items[index]);
  }); // clear items

  $('body').on('click', clearItemsSelector, clearItems); // search

  $('body').on('click', '.search .kit-number__btn', function () {
    var _this = $(this),
        price = parseFloat(_this.closest('.search__item').data('price')),
        count = parseInt(_this.closest('.kit-number').find('.kit-number__value').html(), 10);

    if (_this.hasClass('kit-number__btn_plus')) {
      var countPrice = Math.floor(count * price * 100) / 100;

      _this.closest('.search-product__bottom').find('.js-result-price').html(countPrice);
    } else if (count >= 1) {
      var _countPrice = Math.floor(count * price * 100) / 100;

      _this.closest('.search-product__bottom').find('.js-result-price').html(_countPrice);
    }
  });
  $('body').on('click', '.js-remove-item', function () {
    var index = $(this).closest('.m-table__body').index();
    removeItem(index);
  }); // обновление цены и количества-товара в header

  function updateHeadPrice() {
    var basketprice = 1;
    $.post('/local/templates/clegrand/ajax/basketlist.php', {
      basketprice: basketprice
    }, function (data) {
      var datab = JSON.parse(data);
      var newSum = parseFloat(datab.SUM);
      $('.header-basket__value').html('' + datab.NUM + ' товара / ' + newSum + ' руб.');
    });
  }
  /*добавление в корзину*/


  $('body').on('click', '.btn-add-order-js', function (event) {
    event.preventDefault();
    $.post('/local/templates/clegrand/ajax/specification/basket.php', {
      items: items
    }, function () {
      updateHeadPrice();
      clearItems();
    });
  });
  /*добавление в отложенные*/

  $('body').on('click', '.basket-kit-bottom__later', function (event) {
    event.preventDefault();
    $.post('/local/templates/clegrand/ajax/specification/deferred.php', {
      items: items
    }, function () {
      //updateHeadPrice();
      clearItems();
    });
  }); // if there are items in local storage

  var initialItems = JSON.parse(localStorage.getItem('specification_items')); // relation's local storage with price in db

  var updatePrice = function updatePrice(items) {
    var url = '/local/templates/clegrand/ajax/specification/price/index.php',
        post = {
      items: items
    };
    $.post(url, post, function (data, status) {
      if (status === 'success') {
        var arItems = JSON.parse(data);

        if (_typeof(arItems) === 'object') {
          buildItems(arItems);
        } else {
          buildItems(items);
          console.log("Prices don't update!");
        }
      } else {
        console.log("Prices don't update!");
      }
    });
  };

  var isEmpty = function isEmpty(obj) {
    for (var key in obj) {
      return false;
    }

    return true;
  };

  if (_typeof(initialItems) === 'object' && !isEmpty(initialItems)) {
    updatePrice(initialItems);
  } //download pdf, xls


  $(document).on('click', '.specification__right .download-js', function () {
    var _this = $(this),
        print = _this.data('print'),
        url = '/specification/' + print + '/index.php',
        fileName = 'specification.' + print;

    var post = {
      items: items,
      print: print
    };

    if (print === 'pdf' || print === 'xls') {
      $.ajax({
        url: url,
        method: 'POST',
        data: post,
        xhrFields: {
          responseType: 'blob'
        },
        success: function success(data) {
          // download in browser
          var a = document.createElement('a');
          var url = window.URL.createObjectURL(data);
          a.href = url;
          a.download = fileName;
          document.body.append(a);
          a.click();
          a.remove();
          window.URL.revokeObjectURL(url);
        },
        error: function error() {
          console.log('Error download specification .' + print + '!');
        }
      });
    }
  });
});