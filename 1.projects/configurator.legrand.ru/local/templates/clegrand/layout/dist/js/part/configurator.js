"use strict";

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

/* eslint-disable no-unused-vars */

/* eslint-disable no-undef */
(function ($, app) {
  function initConfigurator() {
    window.res;
    window.mechanisms = [];
    var mainWrap = $('body');
    var config = $('.config-main');
    var slots = $('.place');
    var frameImage = $('.js-frame-image');
    var frameBlock = $('.config-grid__frame');
    var preloader = $('.config__preloader');
    var zoom = 1;
    var zoomCoef = 0.2;
    var frames = 0;
    var fixedFrames = 0;
    var maxFrames = 5;
    var orientation = 'horizontal';
    var currentFrame = null;
    var currentCollection = '';
    var frameSize = {};

    $.magnificPopup.instance.open = function (data) {
      var id = $(data.el[0]).attr('href');

      if (!window.res && id === '#popup-config') {
        return;
      }

      $.magnificPopup.proto.open.call(this, data);
    };

    var result = {
      mechanisms: [],
      frameOrientation: 'horizontal',
      background: ''
    };
    var collectionNames = {
      'Valena Life': 'Valena-Life',
      'Valena Allure': 'Valena-Allure',
      'Celiane': 'Celiane',
      'Etika': 'Etika',
      'Livinglight (немецкий стандарт)': 'LivinglightGermany',
      'Livinglight (итальянский стандарт)': 'LivinglightItaly'
    }; // drag and drop настройки

    var drag = {
      isDragging: false,
      image: '',
      frameName: '',
      type: null,
      obj: null,
      remember: null,
      id: null,
      dragSize: 1,
      width: 1
    };
    var frameSizesX = [250, 420, 600, 770, 950];
    var frameSizesY = 3.92;

    if (window.config) {
      buildKit(window.config);
    }

    if (window.postmodframe) {
      window.modframe = postmodframe;
      delete window.postmodframe;
    }

    if (window.postfcollection) {
      window.fcollection = postfcollection;
      delete window.postfcollection;
    }

    if (window.postcolor) {
      window.fcolor = postcolor;
      delete window.postcolor;
    }

    function buildKit(params) {
      frames = Number(params.frame.posts); // кол-во постов у рамки

      buildFrameByParams(params);

      if (params.mechanisms) {
        params.mechanisms.forEach(function (e) {
          setBreaker(null, {
            info: {
              name: e.name,
              image: "/".concat(e.src),
              price: e.price + ' руб',
              color: e.color
            },
            image: "/".concat(e.src),
            id: e.id,
            width: e.width || 1
          });
        });
      }
      /*  for (let [key, value] of Object.entries(params.mechanisms)) {
          if (Object.keys(value).length > 0) {
              setBreaker(null, {image: `/${params.mechanisms[key].src}`, id: params.mechanisms[key].id, width: params.mechanisms[key].width || 1 });
          }
      }*/


      updateResult();
    } // функции для попапа


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

    function scrollbarWidth() {
      var documentWidth = document.documentElement.clientWidth;
      var windowsWidth = window.innerWidth;
      var scrollbarWidth = windowsWidth - documentWidth;
      return scrollbarWidth;
    } // установка новой рамки кликом


    function setFrame(value, collectionName) {
      if (!frames) {
        setFrames(1, 1, null, true, value, collectionName);
        $('.posts-number > div').removeClass('my-radio__item_active');
        $('.posts-number > div:first-child').addClass('my-radio__item_active');
      } else {
        setFrames(frames, 1, null, true, value, collectionName);
      }
    }

    function checkVerticalOrientation(collection) {
      var div = $('.frame-orientation');

      if (collection.includes('Livinglight')) {
        div.addClass('disabled-vertical');
        div.find('.my-radio__item').removeClass('my-radio__item_active');
        div.find('.my-radio__item').eq(0).addClass('my-radio__item_active');
        orientation = 'horizontal';
        frameBlock.removeClass('vertical horizontal');
        frameBlock.addClass(orientation);
      } else {
        div.removeClass('disabled-vertical');
      }
    } // скролл к началу конфигуратора


    function scrollToConfig() {
      if ($(window).width() < 768) {
        $('html, body').animate({
          scrollTop: config.offset().top - 95
        }, 'slow');
      }
    } // изменить изображение рамки


    function changeFrameImage(_x, _x2, _x3) {
      return _changeFrameImage.apply(this, arguments);
    } // масштабирование


    function _changeFrameImage() {
      _changeFrameImage = _asyncToGenerator(
      /*#__PURE__*/
      regeneratorRuntime.mark(function _callee(frameID, frames, collectionName) {
        return regeneratorRuntime.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                return _context.abrupt("return", new Promise(function (resolve, reject) {
                  if (!frameID) {
                    reject();
                    return;
                  }

                  var timer = setTimeout(function () {
                    preloader.addClass('active');
                  }, 100); // window.frames = frames;
                  // console.log(frameID, orientation, frames)

                  var requestOrientation = orientation;

                  if (collectionName.includes('Livinglight') || frames < 2) {
                    requestOrientation = 'horizontal';
                  }

                  $.post('/local/templates/clegrand/ajax/config.php', {
                    frameID: frameID,
                    frameOrientation: requestOrientation,
                    postsNumber: frames
                  }, function (response) {
                    response = JSON.parse(response);
                    /*данные для модального окна*/

                    /*первый вариант из post запроса при изменении комплекта в корзине
                    второй вариант - просто выбор в конфгураторе
                    */

                    window.modframe = response;
                    /*      if(window.config.postmodframe)
                    {
                        window.modframe = config.postmodframe;
                    }*/

                    var path = response.img;
                    var $img = $('<img src=' + path + ' />');
                    window.res = response.ID;
                    result.frame = response.ID;
                    currentFrame = response.ID;
                    window.fcolor = response.color;
                    window.fcollection = response.collection; // console.log(response);

                    $img.on({
                      'load': function load() {
                        frameImage.attr('src', path);
                        clearTimeout(timer);
                        preloader.removeClass('active');
                        resolve(response);
                      },
                      'error': function error() {
                        clearTimeout(timer);
                        preloader.removeClass('active');
                        reject();
                      }
                    });
                  });
                }));

              case 1:
              case "end":
                return _context.stop();
            }
          }
        }, _callee);
      }));
      return _changeFrameImage.apply(this, arguments);
    }

    function zoomFrame() {
      var zoom = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 1;
      var wrap = $('.config-grid');
      var scroller = $('.config__wrap');
      var startWidth = wrap.width();
      var startHeight = wrap.outerHeight();

      if (orientation === 'horizontal') {
        frameImage.css({
          'max-width': frameSize.width * zoom,
          'max-height': frameSize.height * zoom,
          'width': frameSize.width * zoom
        });
        var newScrollWidth = Math.abs((wrap.width() - startWidth) / 2);

        if (wrap.width() > startWidth) {
          var newScrollX = scroller.scrollLeft() + newScrollWidth;
          scroller.scrollLeft(newScrollX);
        } else if (wrap.width() < startWidth) {
          var _newScrollX = scroller.scrollLeft() - newScrollWidth;

          scroller.scrollLeft(_newScrollX);
        }
      } else {
        var prevRange = wrap.outerHeight() - 488; // высота скролла

        var prevScrollPercent = scroller.scrollTop() * 100 / prevRange; // скрол в процентах

        frameImage.css({
          'max-width': frameSize.width * zoom,
          'max-height': frameSize.height * zoom,
          'height': frameSize.height * zoom
        });
        wrap.css('height', frameImage.height() + 80 + 'px');
        var currentHeight = wrap.outerHeight();
        var range = currentHeight - 488; // высота скролла

        var newScrollHeight = Math.abs((wrap.outerHeight() - startHeight) / 2);

        if (currentHeight > startHeight) {
          var newScrollY = scroller.scrollTop() + newScrollHeight;
          scroller.scrollTop(newScrollY);
        } else if (currentHeight < startHeight) {
          var scrollValue = range * (prevScrollPercent / 100);
          scroller.scrollTop(scrollValue);
        }
      }

      updatePreviewSize();
    }

    $('body').on('click', '.js-set-frame', function () {
      var collection = $(this).closest('.config-frame__item').data('kollect');
      setFrame($(this).data('frame'), collection);
      scrollToConfig();
    }); // изменить текущую сборку

    $('body').on('click', '.js-change-kit', function () {
      $('#popup-config').magnificPopup('close');
      updateResult();
      /*передаем название комплекта для изменения*/

      window.comp = $(this).attr('data-edit'); // console.log(result.comp);
    }); // новая сборка (удалить текущую)

    $('body').on('click', '.js-new-kit', function () {
      $('#popup-config').magnificPopup('close');
      setFrames(0, 1, null, false);
      $('#itnum').html('<span id="itnum">0 позиций)</span>');
      $('.config-result__rub').html('<span id="fullPrice">0</span> руб.');
      refreshView();
    }); // новая сборка (удалить текущую)

    $('body').on('click', '.js-delete-kit', function () {
      $('#popup-config').magnificPopup('close');
      setFrames(0, 1, null, false);
      $('#itnum').html('<span id="itnum">0 позиций)</span>');
      $('.config-result__rub').html('<span id="fullPrice">0</span> руб.');
      refreshView();
    });

    function getMechanismInfo(el) {
      var name = el.find('.config-frame__color').text().trim();
      var image = el.find('img').attr('src').trim();
      var price = el.find('.config-frame__price').text().trim();
      var color = el.data('functcolor'); // const collection = collectionNames[el.data('kollect')].toLowerCase();

      return {
        name: name,
        image: image,
        price: price,
        color: color
      };
    } // установка переключателя кликом


    $('body').on('click', '.js-set-breaker', function () {
      var item = $(this).closest('.config-frame__item');
      var collection = item.data('kollect');

      if (fixedFrames <= 0) {
        // ошибка! нет рамки
        iziToast.info({
          title: 'Внимание!',
          message: 'Выберите рамку, прежде чем ставить механизм.'
        });
      } else if (collectionNames[collection] !== currentCollection) {
        // ошибка! коллекция не подходит
        iziToast.info({
          title: 'Внимание!',
          message: 'Требуется сначала выбрать рамку соответствующей коллекции, для которой выбирается механизм.'
        });
        return;
      }

      if (fixedFrames > 0) {
        setBreaker(null, {
          info: getMechanismInfo(item),
          image: $(this).attr('src'),
          id: $(this).data('id'),
          width: $(this).data('posts') || 1
        });
      }

      scrollToConfig();
    }); // радио

    $('body').on('click', '.my-radio__item', function () {
      $(this).addClass('my-radio__item_active').siblings().removeClass('my-radio__item__active');
    }); // настройки

    $('body').on('click', '.my-radio__item', function () {
      var type = $(this).closest('.my-radio').data('type');
      var value = $(this).data('value');
      $(this).addClass('my-radio__item_active').siblings().removeClass('my-radio__item_active');

      switch (type) {
        case 'orientation':
          if (value === 'vert') {
            setFrames(frames, 1, 'vertical', true, currentFrame, currentCollection);
          } else {
            setFrames(frames, 1, 'horizontal', true, currentFrame, currentCollection);
          }

          zoom = 1;
          break;

        case 'posts':
          frames = value;

          if (currentFrame) {
            setFrames(value, 1, null, true, currentFrame, currentCollection);
            zoom = 1;
          }

          break;

        case 'zoom':
          // console.log(zoom)
          if (value === 'plus') {
            if (zoom <= 5) {
              if (zoom < 5) {
                zoom++;
                zoomFrame(1 - zoomCoef + zoom * zoomCoef);
              }
            }
          } else if (zoom > 1) {
            zoom--;
            zoomFrame(1 - zoomCoef + zoom * zoomCoef);
          } // $('.js-grid-sizing span').html(17 + (zoom * 3) + ' мм');


          break;
      }
    });

    function getCurrentZoom() {
      return 1 - zoomCoef + zoom * zoomCoef;
    } // удаление рамки


    $('body').on('click', '.js-frame-delete', function () {
      setFrames(0, 1, null, false);
      var numConf = 0;
      $('#itnum').html('<span id="itnum">0 позиций)</span>');
      $('.config-result__rub').html('<span id="fullPrice">0</span> руб.');
    }); // удаление поста из рамки

    $('body').on('click', '.js-remove-frame', function () {
      removeBreaker($(this).closest('.place'));
      updateResult();
    }); // фон

    $('body').on('click', '.js-delete-bg', function () {
      $('.config__wrap').css('background', '');
      $('.config__grid').css('background', '');
      config.removeClass('with-bg');
      $('.setbg__item').removeClass('active');
      $('.setbg__color').removeClass('active');
    });
    $('body').on('click', '.js-set-bg', function () {
      $('.setbg__item').removeClass('active');
      $('.setbg__color').removeClass('active');
      $('#popup-setbg').magnificPopup('close');

      if ($(this).data('id')) {
        var id = $(this).data('id');
        $(this).closest('.setbg__item').addClass('active');
        $.post('/local/templates/clegrand/ajax/fon.php', {
          id: id
        }, function (response) {
          $('.config__wrap').css('background', 'url(' + response + ')');
          $('.js-input-bg').val(null);
          $('.config-grid').css('background-image', '');
        });
        config.addClass('with-bg');
      } else {
        var color = $(this).data('color');
        $(this).addClass('active');
        $('.config__wrap').css('background', "".concat(color));
        $('.js-input-bg').val(null);
        $('.config-grid').css('background-image', '');
        config.addClass('with-bg');
      }
    });
    $('.js-input-bg').on('change', function () {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('.config-grid').css('background-image', 'url(' + e.target.result + ')');
        config.addClass('with-bg');
      };

      reader.readAsDataURL(this.files[0]);
    });
    $('body').on('mousedown', '.js-draggable', function () {
      var type = $(this).data('type');
      var item = $(this).closest('.config-frame__item');
      var collectionName;
      drag.width = 1;

      if ($(this).parent().hasClass('slot')) {
        // драг с рабочего поля
        collectionName = $(this).data('kollect');
        drag.width = $(this).data('width') || 1;
        drag.info = window.mechanisms[$(this).closest('.place').index()];
      } else {
        collectionName = collectionNames[item.data('kollect')];
        drag.info = getMechanismInfo(item);
        drag.width = $(this).data('posts') || 1;
      }

      if (currentCollection !== collectionName) {
        return;
      }

      var frameWidth;

      if (type === 'frame') {
        frameWidth = $(this).width();
        drag.frameName = $(this).data('frame');
      } else {
        frameWidth = $(this).width();
      }

      if (collectionName.includes('Livinglight')) {
        drag.dragSize = 1;
      } else {
        drag.dragSize = .2;
      }

      drag.isDragging = true;
      drag.image = $(this).attr('src');
      drag.id = $(this).data('id');
      drag.collection = collectionName;
      var img = $('<img width="' + frameWidth + '" draggable="false"/>');
      img.css({
        'position': 'fixed',
        'left': '-9999px',
        'z-index': 10
      });
      img.attr('src', drag.image);
      $('body').append(img);
      drag.obj = $(img);
      drag.type = $(this).data('type') || 'mechanism';

      if ($(this).hasClass('remember')) {
        $(this).css('opacity', '.5');
        drag.remember = $(this).closest('.slot');
      }
    });
    $('body').on('mousemove', function (e) {
      if (drag.isDragging) {
        drag.obj.css({
          'left': e.clientX - drag.obj.width() / 2 + 'px',
          'top': e.clientY - drag.obj.height() / 2 + 'px'
        });

        if (drag.type !== 'frame') {
          var frameWidth = $('.slot').width();
          var frameHeight = $('.slot').height();
          slots.removeClass('hover');
          config.removeClass('edit');
          var counter = 0;
          var array = [];
          var specialType = config.hasClass('LivinglightGermany');

          for (var i = 0; i < slots.length; i++) {
            var elem = slots.eq(i);

            if ($(elem).css('display') === 'block') {
              var x1 = drag.obj.offset().left;
              var y1 = drag.obj.offset().top;
              var xx = $(elem).offset().left;
              var yy = $(elem).offset().top;
              var percent = drag.dragSize;
              var objWidth = drag.obj.width() * percent;
              var objHeight = drag.obj.height() * percent; // slots.removeClass('hover');

              if (isIntersects({
                x: x1 + (drag.obj.width() - objWidth) / 2,
                y: y1 + (drag.obj.height() - objHeight) / 2
              }, {
                x: xx,
                y: yy
              }, {
                width: objWidth,
                height: objHeight
              }, {
                width: frameWidth,
                height: frameHeight
              })) {
                counter++;
                array.push(i);
                config.addClass('edit'); // прозрачность остальных блоков

                if (counter == drag.width) {
                  $.each(array, function (index, elem) {
                    slots.eq(elem).addClass('hover');
                  });
                  break;
                }

                if (specialType && i % 2 !== 0) {
                  counter = 0;
                  array = [];
                }
              }
            }
          }
        }
      }
    });
    $('body').on('mouseup', function () {
      if (drag.obj) {
        drag.isDragging = false;
        drag.obj.remove();
        drag.obj = null;
        slots.find('img').css('opacity', 1);
        var focused = $('.place.hover').eq(0);

        if (focused.length) {
          setBreaker(focused, drag);
        }

        slots.removeClass('hover');

        if (drag.frameName) {
          setTimeout(function () {
            if ($('.config-main:hover').length !== 0) {
              // если драг в рабочей области то ставим рамку
              setFrame(drag.frameName, drag.collection);
            }

            drag.frameName = '';
          }, 15);
        }

        config.removeClass('edit');
      }
    });

    var isAvailbaleCell = function isAvailbaleCell(frame) {
      var other = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
      var width = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 1;

      if (frame.index() + width <= fixedFrames) {
        if (other) {
          if (!frame.hasClass('placed')) {
            if (width > 1) {
              return !frame.next().hasClass('placed');
            } else {
              return true;
            }
          }
        } else {
          return true;
        }
      }

      return false;
    }; // установка переключателя


    function setBreaker() {
      var frame = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
      var obj = arguments.length > 1 ? arguments[1] : undefined;

      if (frame && frames > 0) {
        console.log('object info: ', obj);
        var prev = frame.prev();
        var next = frame.next();

        if (drag.remember) {
          var oldPlace = drag.remember.closest('.place');
          oldPlace.removeClass('placed width1 width2');
          drag.remember.html('');
          drag.remember = null;

          if (frame.hasClass('placed') || prev.hasClass('width2') || next.hasClass('placed')) {
            var settings = frame.hasClass('placed') ? frame.find('img') : prev.find('img'); // console.log(window.mechanisms[settings.closest('.place').index()])

            var newObj;

            if (settings.length > 0) {
              newObj = {
                width: settings.data('width'),
                collection: settings.data('kollect'),
                id: settings.data('id'),
                image: settings.attr('src'),
                info: _objectSpread({}, window.mechanisms[settings.closest('.place').index()])
              };

              if (isAvailbaleCell(oldPlace, true, settings.data('width'))) {
                setBreaker(oldPlace, newObj);
              } else if (currentCollection === 'LivinglightGermany') {
                if (oldPlace.index() % 2 !== 0) {
                  setBreaker(oldPlace.prev(), newObj);
                } else {
                  setBreaker(oldPlace, newObj);
                }
              } else if (currentCollection === 'LivinglightItaly') {
                if (isAvailbaleCell(oldPlace.next(), true)) {
                  setBreaker(oldPlace, newObj);
                } else if (isAvailbaleCell(oldPlace, false)) {
                  setBreaker(oldPlace.prev(), newObj);
                }
              }
            } // случай с перетаскиванием двойного механизма на 2 механизма


            if (obj.width > 1 && next.hasClass('placed')) {
              settings = next.find('img');
              newObj = {
                width: settings.data('width'),
                collection: settings.data('kollect'),
                id: settings.data('id'),
                image: settings.attr('src')
              };

              if (newObj.width < 2) {
                setBreaker(oldPlace.next(), newObj);
              } else {
                setBreaker(oldPlace, newObj);
              }
            }
          }
        } // удаление предыдущего если он на 2 клетки


        if (prev.hasClass('width2')) {
          removeBreaker(prev);
        } // удаление следующего если текущий на 2 клетки


        if (obj.width > 1 && next.hasClass('placed')) {
          removeBreaker(next);
        } // удаление текущего поста


        removeBreaker(frame);
        var block = frame.find('.slot');
        var blockIndex = block.closest('.place').index();
        window.mechanisms[blockIndex] = _objectSpread({
          id: obj.id
        }, obj.info);
        frame.addClass('placed width' + obj.width);
        var kollect = obj.collection ? obj.collection : currentCollection;
        block.append("<img class=\"js-draggable remember\" draggable=\"false\" data-kollect=".concat(kollect, " data-id=").concat(obj.id, " data-width=").concat(obj.width, " src=\"") + obj.image + "\" alt=\"\"/>");
        updateResult();
      } else if (frames > 1) {
        var set = false;

        for (var i = 0; i < frames; i++) {
          var elem = slots.eq(i);
          var prevElem = elem.prev();
          var nextElem = elem.next();
          var slot = elem.find('.slot');

          if (!slot.children().length && !prevElem.hasClass('width2')) {
            if (obj.width > 1) {
              if (nextElem.hasClass('placed') || frames < i + 2) {
                continue;
              }

              if (currentCollection === 'LivinglightGermany' && i % 2 !== 0) {
                continue;
              }
            }

            set = true;
            setBreaker(elem, obj);
            break;
          }
        }

        if (!set) {
          if (obj.width < 2) {
            var _prev = slots.eq(frames - 2);

            if (_prev.hasClass('width2')) {
              setBreaker(slots.eq(frames - 2), obj);
            } else {
              setBreaker(slots.eq(frames - 1), obj);
            }
          } else {
            if (slots.eq(frames - 3).hasClass('width2')) {
              setBreaker(slots.eq(frames - 3), obj);
            } else {
              setBreaker(slots.eq(frames - 2), obj);
            }
          }
        }
      } else {
        setBreaker(slots.eq(0), obj);
      }
    } // удаление переключателя


    function removeBreaker(elem) {
      elem.removeClass('placed width1 width2');
      var id = elem.find('img').data('id'); // delete window.mechanisms[id];

      elem.find('.slot img').remove();
    }

    function getCorrectPostCount(current, posts) {
      var min = +posts[0];
      var max = +posts[posts.length - 1];
      var result = 1;

      if (posts.includes(String(current))) {
        result = current;
      } else {
        result = 1;
      }

      if (current > max) {
        result = max;
      }

      if (current < min) {
        result = min;
      }

      changePostActiveButton(result);
      return result;
    }

    function updatePostButtons(postsArray) {
      var posts = $('.posts-number div');

      for (var i = 0, counter = 0; i < 8; i++) {
        if (i === Number(postsArray[counter]) - 1) {
          posts.eq(i).css('display', 'flex');
          counter++;
        } else {
          posts.eq(i).css('display', 'none');
        }
      }
    }

    function changePostActiveButton(n) {
      $('.posts-number > div').removeClass('my-radio__item_active');
      $('.posts-number > div').eq(n - 1).addClass('my-radio__item_active');
    }

    function updatePreviewSize() {} // // const gridSize = 0.16; // %
    // let result;
    // if (orientation == 'horizontal' || fixedFrames < 2) {
    //     const realSize = frameSizesX[fixedFrames - 1] * 3.92; // 980
    //     const ratio = frameSize.width / 36; // 36 - ширина ячейки на миллиметровке
    //     result = Math.floor(realSize / ratio);
    //     // result = (Math.floor((frameSizes[fixedFrames - 1] * (frameSize.width * getCurrentZoom() )) * gridSize));
    // } else {
    //     const realSize = 210 * 3.92;
    //     const ratio = frameSize.width / 36; // 36 - ширина ячейки на миллиметровке
    //     result = Math.floor(realSize / ratio);
    //     // result = (Math.floor((frameSizesY * (frameSize.width * getCurrentZoom() )) * gridSize));
    // }
    // if (isNaN(result)) {
    //     result = 0;
    // }
    // $('.js-grid-sizing span').html(result + ' мм');
    // // удаление элементов
    // function removeKit() {
    //     if (framesCount <= 0) {
    //         config.addClass('deleted');
    //         $('.posts-number .my-radio__item_active').removeClass('my-radio__item_active');
    //         slots.find('img').remove();
    //         slots.removeClass('width1 width2 placed');
    //         currentFrame = null;
    //         window.res = null;
    //         fixedFrames = 0;
    //         frameImage.attr('src', '');
    //     } else {
    //         config.removeClass('deleted');
    //     }
    //     for (let i = 0; i < 8; i++) {
    //         if (i >= framesCount - 1 && slots.eq(i).hasClass('width2')) {
    //             removeBreaker(slots.eq(i))
    //         }
    //         if (i >= framesCount) {
    //             removeBreaker(slots.eq(i))
    //         }
    //     }
    // }


    function refreshView() {
      frames = 0;
      fixedFrames = 0;
      updatePostButtons([1, 2, 3, 4, 5]);
      checkVerticalOrientation('');
    } // обновление активного блока ориентации


    function updateOrientationView() {
      $('.frame-orientation > div').removeClass('my-radio__item_active');

      if (orientation === 'horizontal') {
        $('.frame-orientation > div').eq(0).addClass('my-radio__item_active');
      } else {
        $('.frame-orientation > div').eq(1).addClass('my-radio__item_active');
      }
    } // установка размеров рабочего поля


    function updateConfigSize() {
      var configWidth = config.width() * zoom;
      var configHeight = config.height() * zoom;
      frameImage.css({
        'max-width': configWidth - 100 + 'px',
        'max-height': configHeight - 100 + 'px',
        'width': '',
        'height': ''
      });
      setTimeout(function () {
        frameSize = {
          'width': frameImage.width(),
          'height': frameImage.height()
        };
        $('.config-grid').css('height', frameImage.height() + 80 + 'px');
        updatePreviewSize();
      }, 10);
    } // установка рамки по параметрам


    function buildFrameByParams(params) {
      // текущая рамка
      currentFrame = params.frame.id;
      currentCollection = collectionNames[params.collectionName];
      frameImage.attr('src', "/".concat(params.frame.src));
      config.removeClass('deleted');
      config.addClass(currentCollection);
      checkVerticalOrientation(currentCollection); // ориентация

      orientation = params.frameOrientation || 'horizontal';
      frameBlock.removeClass('vertical horizontal');
      frameBlock.addClass(orientation);
      updateOrientationView(); // добавление класса с количеством постов

      fixedFrames = frames;
      $('.config-grid__frame').removeClass('quantity1 quantity2 quantity3 quantity4 quantity5 quantity6 quantity7 quantity8');
      $('.config-grid__frame').addClass('quantity' + fixedFrames);
      updatePostButtons(params.posts);
      changePostActiveButton(fixedFrames);
      window.res = currentFrame;
      updateConfigSize();
    } // установка рамки


    function setFrames(_x4) {
      return _setFrames.apply(this, arguments);
    } // проверка пересечений


    function _setFrames() {
      _setFrames = _asyncToGenerator(
      /*#__PURE__*/
      regeneratorRuntime.mark(function _callee2(framesCount) {
        var zoom,
            orient,
            change,
            frameID,
            collectionName,
            i,
            imageResult,
            _args2 = arguments;
        return regeneratorRuntime.wrap(function _callee2$(_context2) {
          while (1) {
            switch (_context2.prev = _context2.next) {
              case 0:
                zoom = _args2.length > 1 && _args2[1] !== undefined ? _args2[1] : 1;
                orient = _args2.length > 2 && _args2[2] !== undefined ? _args2[2] : null;
                change = _args2.length > 3 && _args2[3] !== undefined ? _args2[3] : true;
                frameID = _args2.length > 4 && _args2[4] !== undefined ? _args2[4] : null;
                collectionName = _args2.length > 5 && _args2[5] !== undefined ? _args2[5] : null;

                // console.log(framesCount, zoom, orient , change, frameID, collectionName)
                if (orient) {
                  orientation = orient;
                }

                frames = framesCount; // удаление рамки

                if (framesCount <= 0) {
                  config.addClass('deleted');
                  $('.posts-number .my-radio__item_active').removeClass('my-radio__item_active');
                  slots.find('img').remove();
                  slots.removeClass('width1 width2 placed');
                  currentFrame = null;
                  window.res = null;
                  window.mechanisms = [];
                  fixedFrames = 0;
                  frameImage.attr('src', '');
                } else {
                  config.removeClass('deleted');
                }

                for (i = 0; i < 8; i++) {
                  if (i >= framesCount - 1 && slots.eq(i).hasClass('width2')) {
                    removeBreaker(slots.eq(i));
                  }

                  if (i >= framesCount) {
                    removeBreaker(slots.eq(i));
                  }
                } // смена картинки у рамки


                imageResult = true; // запрос картинки

                if (!change) {
                  _context2.next = 13;
                  break;
                }

                _context2.next = 13;
                return changeFrameImage(frameID, framesCount, collectionName).then(function (res) {
                  frames = +res.postfix || frames;
                  framesCount = getCorrectPostCount(frames, res.posts);
                  frames = framesCount;
                  updatePostButtons(res.posts);

                  if (res.collection) {
                    config.removeClass('Celiane Etika LivinglightGermany LivinglightItaly Valena-Life Valena-Allure');
                    config.addClass(collectionNames[res.collection]);

                    if (currentCollection !== collectionNames[res.collection]) {
                      slots.find('img').remove();
                      slots.removeClass('width1 width2 placed');
                    }

                    currentCollection = collectionNames[res.collection];
                  }
                }, function (error) {
                  imageResult = false;
                });

              case 13:
                if (imageResult) {
                  _context2.next = 15;
                  break;
                }

                return _context2.abrupt("return");

              case 15:
                // если ошибка в картинке дальше ничего не делаем
                checkVerticalOrientation(currentCollection); // проверяем допустимые ориентации для текущей рамки

                zoom = 1; // присваиваем новый id рамки в конфиг

                /* if (frameID) {
                     currentFrame = frameID;
                 }*/

                fixedFrames = framesCount;
                frameBlock.removeClass('vertical horizontal');

                if (orientation === 'vertical' && frames > 1) {
                  frameBlock.addClass('vertical');
                } else {
                  frameBlock.addClass('horizontal');
                } // добавление класса с количеством постов


                $('.config-grid__frame').removeClass('quantity1 quantity2 quantity3 quantity4 quantity5 quantity6 quantity7 quantity8');
                $('.config-grid__frame').addClass('quantity' + framesCount);
                updateConfigSize();
                updateResult();

              case 24:
              case "end":
                return _context2.stop();
            }
          }
        }, _callee2);
      }));
      return _setFrames.apply(this, arguments);
    }

    function isIntersects(a, b, w, w2) {
      if (a.x > b.x + w2.width) return false; // Объект находится правее

      if (a.x + w.width < b.x) return false; // Объект находится левее

      if (a.y > b.y + w2.height) return false; // Объект находится ниже

      if (a.y + w.height < b.y) return false; // Объект находится выше

      return true;
    } // драг + скрол конфигуратора мышкой


    function initScrollDrag() {
      var slider = document.querySelector('.config__wrap');
      var isDown = false;
      var startX;
      var startY;
      var scrollLeft;
      var scrollTop;
      slider.addEventListener('mousedown', function (e) {
        isDown = true;
        slider.classList.add('active');
        startX = e.pageX - slider.offsetLeft;
        startY = e.pageY - slider.offsetTop;
        scrollLeft = slider.scrollLeft;
        scrollTop = slider.scrollTop;
      });
      slider.addEventListener('mouseleave', function () {
        isDown = false;
        slider.classList.remove('active');
      });
      slider.addEventListener('mouseup', function () {
        isDown = false;
        slider.classList.remove('active');
      });
      slider.addEventListener('mousemove', function (e) {
        if (!isDown) return;
        e.preventDefault();
        var x = e.pageX - slider.offsetLeft;
        var y = e.pageY - slider.offsetTop;
        var walk = (x - startX) * 1; //scroll-fast

        var walkY = (y - startY) * 1; //scroll-fast

        slider.scrollLeft = scrollLeft - walk;
        slider.scrollTop = scrollTop - walkY;
      });
    }

    if (config.length) {
      initScrollDrag();
    }

    function getCurrentBg() {
      if (config.hasClass('with-bg')) {
        if ($('.config__wrap').css('background-image') !== 'none') {
          return $('.config__wrap').css('background-image');
        }

        return $('.config__wrap').css('background-color');
      }

      return '';
    }

    function updateResult() {
      result.frame = currentFrame;

      if (res !== '') {
        result.frame = res;
      }

      result.frameOrientation = orientation;
      result.background = getCurrentBg();
      result.mechanisms = [];
      var items = $('.place');
      var itnum;

      if (result.frame !== null) {
        itnum = 1;
      }

      for (var i = 0; i < fixedFrames; i++) {
        var mechanism = items.eq(i).find('img');

        if (mechanism.length) {
          result.mechanisms.push(mechanism.data('id'));
        } else {
          result.mechanisms.push(null);
          window.mechanisms[i] = null;
        }
      }

      window.mechanisms.length = fixedFrames;
      console.log('mechanisms: ', window.mechanisms);
      var mex = 0;

      for (var key in result.mechanisms) {
        if (result.mechanisms[key] !== null) {
          mex++;
        }
      }

      var numConf = mex + itnum;

      if (window.config && window.config.mechanisms !== null) {
        /*mechanisms = config.mechanisms;*/
        window.config.mechanisms = null;
      }
      /*if(typeof window.mech !== 'undefined')
      {
                        //window.mechanismsnew = mech;
                      mechanismsnew = window.mech;
                      //mechanisms = mechanismsnew;
        }*/

      /*    else
          {
              var comp = 1;
          }*/
      //console.log(window.mechanisms);
      // console.log(result);

      /*обновление цены*/


      if (result.frame) {
        $.post('/local/templates/clegrand/ajax/config.php', {
          result: result
        }, function (datac) {
          // console.log(datac)
          $('.config-result__rub').html('<span id="fullPrice">' + datac + '</span> руб.');
        });
      }
      /* Обновление количества */


      if (numConf == 1) {
        $('#itnum').html('<span id="itnum">' + numConf + ' позиция)</span>');
      }

      if (numConf == 2 || numConf == 3 || numConf == 4) {
        $('#itnum').html('<span id="itnum">' + numConf + ' позиции)</span>');
      }

      if (numConf == 5 || numConf == 6 || numConf == 7 || numConf == 8 || numConf == 9) {
        $('#itnum').html('<span id="itnum">' + numConf + ' позиций)</span>');
      }
    }

    function updateResultbasket() {
      console.log(mechanisms);
      result.frame = currentFrame;

      if (res !== '') {
        result.frame = res;
      }

      result.frameOrientation = orientation;
      result.background = getCurrentBg();
      result.mechanisms = [];
      var items = $('.place');

      for (var i = 0; i < fixedFrames; i++) {
        var mechanism = items.eq(i).find('img');

        if (mechanism.length) {
          result.mechanisms.push(mechanism.data('id'));
        } else {
          result.mechanisms.push(null);
        }
      } // console.log(result);


      var room = $('#room').val();
      var walls = $('#wall').val();
      var room1 = $('#room').val();
      var walls1 = $('#wall').val();
      /*          if(window.postmodframe)
                     {
                         window.modframe = postmodframe;
                         delete window.postmodframe;
                     }
                            if(window.postfcollection)
                     {
                         window.fcollection = postfcollection;
                         delete window.postfcollection;
                     }
                            if(window.postcolor)
                     {
                         window.fcolor = postcolor;
                         delete window.postcolor;
                     }*/

      var textframes;

      if (frames == 1) {
        textframes = ' пост';
      } else if (frames == 2 || frames == 3 || frames == 4) {
        textframes = ' поста';
      } else {
        textframes = ' постов';
      }

      var text = "\n                    <div class=\"m-table__body\">\n                        <div class=\"m-table__body-item m-table-column-1\">\n                            <div class=\"kit-good\">\n                                <div class=\"kit-good__image frame\">\n                                    <img src=\"".concat(modframe.img, "\" alt=\"").concat(modframe.name, "\" />\n                                </div>\n                                <div class=\"kit-good__content\">\n                                    <div class=\"kit-good__name\" data-frame-id=\"frame\"></div>\n                                    <div class=\"kit-good__text\">\u0420\u0430\u043C\u043A\u0430 (").concat(fcollection, "), \u0446\u0432\u0435\u0442 ").concat(modframe.name, ", ").concat(frames, " ").concat(textframes, "</div>  \n                                </div>\n                            </div>\n                        </div>\n                        <div class=\"m-table__body-item m-table-column-2\">\n                            <div class=\"m-table__desktop\"><strong class=\"mod-count\" data-count=\"1\"> 1 \u0448\u0442 </strong></div>\n                            <div class=\"m-table__mob\">\n                                <div class=\"kit-number kit-number_str\">\n                                    <div class=\"kit-number__text\">\u043A\u043E\u043B-\u0432\u043E:</div>\n                                    <div class=\"kit-number__btn kit-number__btn_min\">-</div>\n                                    <div class=\"kit-number__value\">1 \u0448\u0442</div>\n                                    <div class=\"kit-number__btn kit-number__btn_plus\">+</div>\n                                </div>\n                            </div>\n                        </div>\n                        <div class=\"m-table__body-item m-table-column-3\">\n                            <span class=\"price-text\">\u0426\u0435\u043D\u0430: </span> <strong class=\"mod-price\" data-f-price=\"modal\"></strong>\n                        </div>\n                    </div>");
      $('.m-table__content').html(text);
      /* установка атрибута для удаления комплекта */

      /*$('.delmod').attr('data-name', '' +fcollection+ ' '+fcolor+'');*/

      $('.config-popup__kit-left').html('Комплект <span id="Cmpname">' + fcollection + ' ' + fcolor + '</span> ' + frames + '' + textframes + '');
      /*if (typeof mechanismsnew !== 'undefined') {
          mechanisms = mechanismsnew;
      }*/

      for (var key in mechanisms) {
        if (mechanisms[key] !== null && mechanisms[key].hasOwnProperty('price')) {
          console.log(mechanisms[key]);
          var pricm = mechanisms[key].price.toLocaleString();
          var text1 = "\n                        <div class=\"m-table__body\">\n                            <div class=\"m-table__body-item m-table-column-1\">\n                                <div class=\"kit-good\">\n                                    <div class=\"kit-good__image function ".concat(currentCollection.toLowerCase(), "\">\n                                        <img src=\"").concat(mechanisms[key].image, "\" alt=\"").concat(mechanisms[key].name, "\" />\n                                    </div>\n                                    <div class=\"kit-good__content\">\n                                        <div class=\"kit-good__name\" data-mex-id=\"").concat(mechanisms[key].id, "\"></div>\n                                        <div class=\"kit-good__text\">").concat(mechanisms[key].name, ", \u0446\u0432\u0435\u0442 ").concat(mechanisms[key].color, "</div>  \n                                    </div>\n                                </div>\n                            </div>\n                            <div class=\"m-table__body-item m-table-column-2\">\n                                <div class=\"m-table__desktop\"><strong class=\"mod-count\" data-count=\"1\"> 1 \u0448\u0442 </strong></div>\n                                <div class=\"m-table__mob\">\n                                    <div class=\"kit-number kit-number_str\">\n                                        <div class=\"kit-number__text\">\u043A\u043E\u043B-\u0432\u043E:</div>\n                                        <div class=\"kit-number__btn kit-number__btn_min\">-</div>\n                                        <div class=\"kit-number__value\">1 \u0448\u0442</div>\n                                        <div class=\"kit-number__btn kit-number__btn_plus\">+</div>\n                                    </div>\n                                </div>\n                            </div>\n                            <div class=\"m-table__body-item m-table-column-3\">\n                                <span class=\"price-text\">\u0426\u0435\u043D\u0430: </span> <strong class=\"mod-price\" data-mod-pric=\"").concat(pricm, "\">").concat(pricm, "</strong>\n                            </div>\n                        </div>");
          $('.m-table__content').append(text1);
        }
      }
      /*получаем артикулы механизмов и рамки*/


      var result1 = result;
      $.post('/local/templates/clegrand/ajax/articul.php', {
        result1: result1
      }, function (datams) {
        // console.log(datams);
        var datamt = JSON.parse(datams);

        if (datamt.MECH) {
          for (var key in datamt.MECH) {
            $('[data-mex-id=' + key + ']').text(datamt.MECH[key]);
          } // console.log(datamt.MECH);

        }

        $('[data-frame-id=frame]').text(datamt.FRAME);
        $('[data-f-price=modal]').text('' + datamt.PRICE + ' руб.');
        $('[data-f-price=modal]').text('' + datamt.PRICE + ' руб.');
        $('[data-f-price=modal]').attr('data-mod-pric', '' + datamt.PRICE + '');
      });
      var comp;

      if (typeof window.comp == 'undefined') {
        comp = 1;
      } else {
        comp = window.comp; // console.log(comp);
      }
      /*url адрес для фильтрации конфигуратора*/


      var url;

      if (window.location.search == '') {
        /*если фильтр не использовался, все равно сохраняем фильтрацию по рамке*/
        url = '?set_filter=y&' + $('#collect option[value="' + window.fcollection + '"]').attr('data-query');
      } else {
        url = window.location.search;
      } // console.log(url);

      /* установка данных для (+) (-) в корзине */


      var arr = result.mechanisms;
      var ress = {};
      var mexlist = '';
      arr.forEach(function (a) {
        ress[a] = ress[a] + 1 || 1;
      });

      for (var key in ress) {
        if (key !== 'null') {
          mexlist += '' + key + ',' + ress[key] + ',';
        }
      } // console.log(mexlist);

      /* сохранение в корзину */


      $.post('/local/templates/clegrand/ajax/basket.php', {
        result: result,
        walls: walls,
        room: room,
        comp: comp,
        url: url,
        mexlist: mexlist
      }, function (dataq) {
        //var dataq = JSON.parse(datas);
        // console.log(dataq);
        $('.icon-text.icon-text_hover.js-change-kit').attr('data-edit', '' + dataq + '');
        /* установка данных для (+) (-) в корзине */

        /*       var arr = result.mechanisms;
               var ress = {};
               var mexlist='';
               arr.forEach(function(a){
               ress[a] = ress[a] + 1 || 1;
               });
               for (var key in ress)
                   if(key !== 'null')
                   {
                        mexlist += '' + key + ',' + ress[key] + ',';
                   }
               console.log(mexlist);*/

        /* установка атрибута для удаления комплекта */

        $('.delmod').attr('data-name', '' + dataq + '');
        /*
                        let room = {
                            comp: dataq,
                            room: ''
                        };
                        room.room = room1;
                        var walls = walls1;
                        var frameOrientation = result.frameOrientation;*/

        /*
                        $.post('/local/templates/clegrand/ajax/config.php', {
                            room,
                            walls,
                            frameOrientation,
                            mexlist,
                            url,
                            mex
                        }, function(data) {})*/
      });
    }
    /*увеличение или уменьшение комплектов в модальном окне*/


    function updateModalbasket(button) {
      result.frame = currentFrame;

      if (res !== '') {
        result.frame = res;
      }

      result.frameOrientation = orientation;
      result.background = getCurrentBg();
      result.mechanisms = [];
      var items = $('.place');

      for (var i = 0; i < fixedFrames; i++) {
        var mechanism = items.eq(i).find('img');

        if (mechanism.length) {
          result.mechanisms.push(mechanism.data('id'));
        } else {
          result.mechanisms.push(null);
        }
      } // console.log(result);

      /* установка данных для (+) (-) в корзине */


      var arr = result.mechanisms;
      var ress = {};
      var mex = '';
      arr.forEach(function (a) {
        ress[a] = ress[a] + 1 || 1;
      });

      for (var key in ress) {
        if (key !== 'null') {
          mex += '' + key + ',' + ress[key] + ',';
        }
      } // console.log(mex);


      var comp = $(".delmod").attr('data-name');
      var result1 = result;
      result1.room = $("#modalroom").val(); // console.log(result1.room);

      result1.walls = $("#modalwall").val(); // console.log(result1.walls);
      //var comp = $('#Cmpname').text();
      //alert(comp);

      /*url адрес для фильтрации конфигуратора*/

      var url;

      if (window.location.search == '') {
        url = 1;
      } else {
        url = window.location.search;
      }

      $.post('/local/templates/clegrand/ajax/modalframe.php', {
        result1: result1,
        button: button,
        comp: comp,
        mex: mex,
        url: url
      }, function (datasm) {//alert(datasm);
      });
    }

    function updateResultDeferred() {
      var resultdef = {
        mechanisms: [],
        frameOrientation: '',
        background: '',
        frame: ''
      };
      resultdef.frame = currentFrame;
      resultdef.frameOrientation = orientation;
      resultdef.background = getCurrentBg();
      resultdef.mechanisms = [];
      var room = $("#modalroom").val();
      var walls = $("#modalwall").val();
      var items = $('.place');

      for (var i = 0; i < fixedFrames; i++) {
        var mechanism = items.eq(i).find('img');

        if (mechanism.length) {
          resultdef.mechanisms.push(mechanism.data('id'));
        } else {
          resultdef.mechanisms.push(null);
        }
      }
      /*console.log(result);*/


      var arr = result.mechanisms;
      var ress = {};
      var mexlist = '';
      arr.forEach(function (a) {
        ress[a] = ress[a] + 1 || 1;
      });

      for (var key in ress) {
        if (key !== 'null') {
          mexlist += '' + key + ',' + ress[key] + ',';
        }
      } // console.log(mexlist);


      var comp = 1;
      /*if(typeof window.comp == 'undefined')
      {
          comp = 1;
      }
      else
      {
          comp = window.comp;
          // console.log(comp);
      }*/

      /*url адрес для фильтрации конфигуратора*/

      var url;

      if (window.location.search == '') {
        url = 1;
      } else {
        url = window.location.search;
      } // console.log(url);


      console.log(resultdef);
      $.post('/local/templates/clegrand/ajax/deferred.php', {
        resultdef: resultdef,
        room: room,
        walls: walls,
        url: url,
        mexlist: mexlist,
        comp: comp
      }, function (datas) {
        console.log(datas);
      });
    }
    /*Обновление корзины в header*/


    function updateBasketPrice() {
      var basketprice = 1;
      $.post('/local/templates/clegrand/ajax/basketlist.php', {
        basketprice: basketprice
      }, function (data) {
        var datab = JSON.parse(data); // console.log(datab);

        $('.header-basket__value').html('' + datab.NUM + ' товара / ' + datab.SUM + ' руб.');
      });
    }
    /*Добавление в корзину*/


    $('body').on('click', '.js-add-to-order', function (e) {
      console.log('window res is ', window.res);

      if (!window.res) {
        // console.log("forbidden")
        e.preventDefault(); // iziToast.error({
        //     title: 'Ошибка!',
        //     message: '',
        // });

        return;
      }

      var basket = 'basket';
      /*   if (!window.mech) {
                      var comp = 1;
                  }
                  else
                  {
                      var comp = window.comp;
                  }*/

      updateResultbasket(basket);
      var fullPrice = $('#fullPrice').text();
      $('.p-price__value').html('<span id="Sum" data-price=' + fullPrice + ' data-sum=' + fullPrice + '>' + fullPrice + '</span> руб.');
      setTimeout(function () {
        updateBasketPrice();
      }, 2000);
    });
    /*Нажатие на плюс в модальном окне конфигуратора*/

    $('body').on('click', '.kit-number__btn.kit-number__btn_plus.configplus', function () {
      var plus = 'plus';
      updateModalbasket(plus);
      updateBasketPrice();
      var str = $('#Sum').attr('data-price');
      var num = parseFloat(str); // console.log(num);

      var str2 = $('#Sum').attr('data-sum');
      var num2 = parseFloat(str2);
      var modSum = num + num2;
      modSum = modSum.toString().replace(/\s/g, "").replace(",", ".");
      /*           $('.p-price__value').html('<span id="Sum" data-price=' + str + ' data-sum=' + modSum + '>' + modSum.toFixed(2) + '</span> руб.');*/

      /*пересчет количества товаров*/

      var countmodall = 0;
      $('body').find('.mod-count').each(function () {
        var countmod = parseFloat($(this).attr('data-count'));
        var realcount = parseFloat($(this).text());
        var newcount = countmod + realcount;
        $(this).text('' + newcount + ' шт.');
        countmodall += countmod;
      });
      console.log(countmodall);
      /*смена цен для товаров*/

      $('body').find('.mod-price').each(function () {
        var modprice = $(this).attr('data-mod-pric');
        modprice = modprice.replace(/\s/g, '');
        modprice = parseFloat(modprice);
        var realprice = $(this).text();
        realprice = realprice.replace(/\s/g, '');
        realprice = parseFloat(realprice);
        var newprice = (realprice + modprice).toFixed(2);
        newprice = newprice.toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
        $(this).text('' + newprice + ' руб.'); //$(this).attr('data-mod-pric', ''+newprice+'');
      });
      /*расчет общей суммы в модальном окне*/

      var sum = 0;
      $('body').find('.mod-price').each(function () {
        var count = $(this).text();
        count = count.replace(/\s/g, '');
        count = parseFloat(count);
        console.log(count);
        sum += count;
        console.log(sum);
      });
      sum = parseFloat(sum);
      sum = sum.toFixed(2);
      sum = sum.toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
      console.log(sum);
      $('.p-price__value').html('<span id="Sum" data-price=' + str + ' data-sum=' + sum + '>' + sum + '</span> руб.');
    });
    /*Нажатие на минус в модальном окне конфигуратора*/

    $('body').on('click', '.kit-number__btn.kit-number__btn_min.configminus', function () {
      var minus = 'minus';
      var quan = $('#compNum').next().next().text();
      var ss = quan.replace(/[^+\d]/g, '');

      if (ss > 1) {
        updateModalbasket(minus); //var fullPrice = $('#fullPrice').text();
        //$('.p-price__value').html('<span id="Sum" data-price='+fullPrice+' data-sum='+fullPrice+'>'+fullPrice+'</span> руб.');

        updateBasketPrice();
        var str = $('#Sum').attr('data-price');
        var num = parseFloat(str.replace(/\s/g, "").replace(",", ".")); // console.log(num);

        var str2 = $('#Sum').attr('data-sum');
        var num2 = parseFloat(str2.replace(/\s/g, "").replace(",", "."));
        var modSum = num2 - num;
        /*          $('.p-price__value').html('<span id="Sum" data-price=' + str + ' data-sum=' + modSum + '>' + modSum.toFixed(2) + '</span> руб.');*/

        /*пересчет количества товаров*/

        var countmodall = 0;
        $('body').find('.mod-count').each(function () {
          var countmod = parseFloat($(this).attr('data-count'));
          var realcount = parseFloat($(this).text());
          var newcount = realcount - countmod;
          $(this).text('' + newcount + ' шт.');
          countmodall += countmod;
        });
        console.log(countmodall);
        /*смена цен для товаров*/

        $('body').find('.mod-price').each(function () {
          var modprice = $(this).attr('data-mod-pric');
          modprice = modprice.replace(/\s/g, '');
          modprice = parseFloat(modprice);
          var realprice = $(this).text();
          realprice = realprice.replace(/\s/g, '');
          realprice = parseFloat(realprice);
          /*      var modprice = parseFloat($(this).attr('data-mod-pric'));
                var realprice = parseFloat($(this).text());*/

          var newprice = (realprice - modprice).toFixed(2);
          newprice = newprice.toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
          $(this).text('' + newprice + ' руб.'); //$(this).attr('data-mod-pric', ''+newprice+'');
        });
        /*расчет общей суммы в модальном окне*/

        var sum = 0;
        $('body').find('.mod-price').each(function () {
          var count = $(this).text();
          count = count.replace(/\s/g, '');
          count = parseFloat(count);
          console.log(count);
          sum += count;
          console.log(sum);
          /*
                  var count = parseFloat($(this).attr('data-mod-pric'));
                  sum += count;*/
        });
        sum = parseFloat(sum);
        sum = sum.toFixed(2);
        sum = sum.toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
        console.log(sum);
        $('.p-price__value').html('<span id="Sum" data-price=' + str + ' data-sum=' + sum + '>' + sum + '</span> руб.');
      }
    });
    /*Добавление в отложенные товары*/

    $(document).on('click', '#deferred', function () {
      updateResultDeferred();
    });
    /*Удаление комплекта из корзины в модальном окне конфигуратора*/

    $(document).on('click', '.delmod', function () {
      //var delname = $(this).attr('data-name');
      var delname = $(this).attr('data-name'); //alert(delname);

      $.post('/local/templates/clegrand/ajax/basketdelcomp.php', {
        delname: delname
      }, function (data) {
        location.reload();
      });
    });
    /*Смена комнаты в модальном окне*/

    $("#modalroom").change(function () {
      var cmpname = $(".delmod").attr('data-name');
      var walls = $("#modalwall").val();
      var room = {
        comp: cmpname,
        room: ''
      };
      room.room = $(this).val();
      /* установка данных для (+) (-) в корзине */

      var arr = result.mechanisms;
      var ress = {};
      var mexlist = '';
      arr.forEach(function (a) {
        ress[a] = ress[a] + 1 || 1;
      });

      for (var key in ress) {
        if (key !== 'null') {
          mexlist += '' + key + ',' + ress[key] + ',';
        }
      } // console.log(mexlist);


      var frameOrientation = result.frameOrientation;
      $.post('/local/templates/clegrand/ajax/config.php', {
        room: room,
        walls: walls,
        mexlist: mexlist,
        frameOrientation: frameOrientation
      }, function (data) {});
    });
    /*Смена стен в модальном окне*/

    $("#modalwall").change(function () {
      var cmpname = $(".delmod").attr('data-name');
      var room = $("#modalroom").val();
      var walls = {
        comp: cmpname,
        walls: ''
      };
      walls.walls = $(this).val();
      /* установка данных для (+) (-) в корзине */

      var arr = result.mechanisms;
      var ress = {};
      var mexlist = '';
      arr.forEach(function (a) {
        ress[a] = ress[a] + 1 || 1;
      });

      for (var key in ress) {
        if (key !== 'null') {
          mexlist += '' + key + ',' + ress[key] + ',';
        }
      } // console.log(mexlist);


      var frameOrientation = result.frameOrientation;
      $.post('/local/templates/clegrand/ajax/config.php', {
        walls: walls,
        room: room,
        mexlist: mexlist,
        frameOrientation: frameOrientation
      }, function (data) {});
    });
  }

  app.initConfigurator = initConfigurator;
})(jQuery, window.app);