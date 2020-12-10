"use strict";

function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

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
/* eslint-disable no-unused-vars */

/* eslint-disable no-undef */


(function ($, app) {
  function initCategory() {
    var catItem = $('.js-cat-item');
    catItem.hover(function () {
      var $this = $(this);
      var thisAttr = $this.attr('data-project-item');
      var imageAttr = 'data-project-bg';
      var thisImage = $("[".concat(imageAttr, " = ").concat(thisAttr, "]"));
      $this.siblings().addClass('unactive');
      $this.addClass('active');
      thisImage.addClass('active');
    }, function () {
      var $this = $(this);
      var thisAttr = $this.attr('data-project-item');
      var imageAttr = 'data-project-bg';
      var thisImage = $("[".concat(imageAttr, " = ").concat(thisAttr, "]"));
      $this.siblings().removeClass('unactive');
      $this.removeClass('active');
      thisImage.removeClass('active');
    });
  }

  app.initCategory = initCategory;
})(jQuery, window.app);
/* eslint-disable no-unused-vars */

/* eslint-disable no-undef */


(function ($, app) {
  function initConfigurator() {
    var config = $('.config-main');
    var slots = $('.place');
    var frameImage = $('.js-frame-image');
    var preloader = $('.config__preloader');
    var zoom = 1;
    var zoomCoef = 0.2;
    var frames = 0;
    var fixedFrames = 0;
    var initialSizing = 10; // sizing

    var frameBlock = $('.frame'); // конфигуратор настройки

    var initialSize = 14; // padding

    var initialWidth = 86;
    var sizes = [20, 30, 40, 50, 60];
    var orientation = 'horizontal';
    var currentFrame = '1';
    var frameSize = {};
    var result = {
      mechanisms: [],
      frameOrientation: 'horizontal',
      background: ''
    }; // установка новой рамки кликом

    function setFrame(value) {
      var form = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'square';
      config.removeClass('radial square square-rounded');
      config.addClass(form);
      slots.find('img').remove();
      currentFrame = value; // frame.removeClass (function (index, className) {
      //     return (className.match (/\bframe-\S+/g) || []).join(' ');
      // });

      console.log(frames);

      if (!frames) {
        setFrames(1);
        $('.posts-number > div:first-child').addClass('my-radio__item_active');
      } // frame.addClass(value);


      changeFrameImage();
    } // получить имя рамки


    function getFrameName() {
      var newFrame;

      if (frames === 1) {
        newFrame = "".concat(currentFrame, "-").concat(frames, ".png");
      } else {
        newFrame = orientation === 'horizontal' ? "".concat(currentFrame, "-").concat(frames, ".png") : "".concat(currentFrame, "v-").concat(frames, ".png");
      }

      return newFrame;
    } // изменить изображение рамки


    function changeFrameImage() {
      return _changeFrameImage.apply(this, arguments);
    } // масштабирование


    function _changeFrameImage() {
      _changeFrameImage = _asyncToGenerator(
      /*#__PURE__*/
      regeneratorRuntime.mark(function _callee() {
        return regeneratorRuntime.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                return _context.abrupt("return", new Promise(function (resolve, reject) {
                  var timer = setTimeout(function () {
                    preloader.addClass('active');
                  }, 100); // $.post('url', {
                  //     frameID: currentFrame,
                  //     frameOrientation: orientation,
                  //     postsNumber: frames
                  // }, (response) => {
                  //     let path = response; // путь к картинке
                  //     let $img = $('<img src=' + path +' />');
                  //
                  // $img.on({
                  //     'load': function() {
                  //         console.log('loaded', path, frameImage);
                  //         frameImage.attr('src', path);
                  //         clearTimeout(timer);
                  //         preloader.removeClass('active');
                  //         resolve();
                  //     },
                  //     'error': function() {
                  //         console.log('error', path, frameImage);
                  //         clearTimeout(timer);
                  //         preloader.removeClass('active');
                  //         resolve();
                  //     }
                  // });
                  // });
                  // удалить потом START

                  var path = 'img/configurator/frame/' + getFrameName();
                  var $img = $('<img src=' + path + ' />');
                  $img.on({
                    'load': function load() {
                      frameImage.attr('src', 'img/configurator/frame/' + getFrameName());
                      clearTimeout(timer);
                      preloader.removeClass('active');
                      updateResult();
                      resolve();
                    },
                    'error': function error() {
                      clearTimeout(timer);
                      preloader.removeClass('active');
                      updateResult();
                      resolve();
                    }
                  }); // удалить потом END
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

      if (orientation === 'horizontal') {
        frameImage.css({
          'max-width': frameSize.width * zoom,
          'max-height': frameSize.height * zoom,
          'width': frameSize.width * zoom
        });
      } else {
        frameImage.css({
          'max-width': frameSize.width * zoom,
          'max-height': frameSize.height * zoom,
          'height': frameSize.height * zoom
        });
      }
    }

    $('body').on('click', '.js-set-frame', function () {
      setFrame($(this).data('frame'), $(this).data('form'));
    }); // установка переключателя кликом

    $('body').on('click', '.js-set-breaker', function () {
      if (frames > 0) {
        setBreaker(null, $(this).attr('src'), $(this).data('id'));
      }
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
            setFrames(frames, 1, 'vertical');
          } else {
            setFrames(frames, 1, 'horizontal');
          }

          zoom = 1;
          break;

        case 'posts':
          setFrames(value);
          zoom = 1;
          break;

        case 'zoom':
          // config.removeClass('zoom-2 zoom-3 zoom-4 zoom-5');
          if (value === 'plus') {
            if (zoom <= 5) {
              if (zoom < 5) {
                zoom++; // setFrames(frames, (1 - zoomCoef) + (zoom * zoomCoef));

                zoomFrame(1 - zoomCoef + zoom * zoomCoef);
              }
            }
          } else if (zoom > 1) {
            zoom--;
            zoomFrame(1 - zoomCoef + zoom * zoomCoef); // setFrames(frames, (1 - zoomCoef) + (zoom * zoomCoef));
          } // $('.js-grid-sizing span').html(17 + (zoom * 3) + ' мм');


          break;
      }
    }); // удаление рамки

    $('body').on('click', '.js-frame-delete', function () {
      setFrames(0, 1, null, false);
    }); // удаление переключателя

    $('body').on('click', '.js-remove-frame', function () {
      $(this).closest('.place').removeClass('placed');
      $(this).closest('.place').find('.slot img').remove();
      updateResult();
    }); // фон

    $('body').on('click', '.js-delete-bg', function () {
      $('.config__wrap').css('background', '');
      config.removeClass('with-bg');
      $('.setbg__item').removeClass('active');
      $('.setbg__color').removeClass('active');
    });
    $('body').on('click', '.js-set-bg', function () {
      $('.setbg__item').removeClass('active');
      $('.setbg__color').removeClass('active');

      if ($(this).data('id')) {
        var id = $(this).data('id');
        $(this).closest('.setbg__item').addClass('active');
        $.post('getbg', {
          id: id
        }, function (response) {
          $('.config__wrap').css('background', 'url(' + response + ')');
        });
        $('.config__wrap').css('background', 'url(img/configurator/background/' + id + '.png)'); // удалить потом

        config.addClass('with-bg');
      } else {
        var color = $(this).data('color');
        $(this).addClass('active');
        $('.config__wrap').css('background', "".concat(color));
        config.addClass('with-bg');
      }
    });
    $('.js-input-bg').on('change', function () {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('.config__wrap').css('background-image', 'url(' + e.target.result + ')');
        config.addClass('with-bg');
      };

      reader.readAsDataURL(this.files[0]);
      console.log(this.files[0]);
    }); // drag and drop object

    var drag = {
      isDragging: false,
      image: '',
      frameName: '',
      type: null,
      obj: null,
      remember: null,
      id: null
    };
    $('body').on('mousedown', '.js-draggable', function () {
      var type = $(this).data('type');
      var frameWidth;

      if (type === 'frame') {
        frameWidth = $(this).width();
        drag.frameName = $(this).data('frame');
      } else {
        // механизм
        // frameWidth = $('.config-grid__image').width();
        frameWidth = $(this).width();
      }

      drag.isDragging = true;
      drag.image = $(this).attr('src');
      drag.id = $(this).data('id');
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

          for (var i = 0; i < slots.length; i++) {
            var elem = slots.eq(i);

            if ($(elem).css('display') === 'block') {
              var x1 = drag.obj.offset().left;
              var y1 = drag.obj.offset().top;
              var xx = $(elem).offset().left;
              var yy = $(elem).offset().top;
              var objOffset = drag.obj.width() / 2;
              console.log(drag.obj.width() / 2, frameWidth);
              slots.removeClass('hover');

              if (isIntersects({
                x: x1 + objOffset / 2,
                y: y1 + objOffset / 2
              }, {
                x: xx + frameWidth * 0.2,
                y: yy + frameWidth * 0.2
              }, objOffset, frameWidth * 0.6)) {
                $(elem).addClass('hover');
                break;
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
        var focused = $('.place.hover');

        if (drag.remember) {
          // уничтожение предыдущего места драг объекта
          drag.remember.html('');
          drag.remember.closest('.place').removeClass('placed');
          drag.remember = null;
          updateResult();
        }

        if (focused.length) {
          setBreaker(focused, drag.image, drag.id);
        }

        slots.removeClass('hover');

        if (drag.frameName) {
          setTimeout(function () {
            if ($('.config-main:hover').length !== 0) {
              setFrame(drag.frameName);
            }

            drag.frameName = '';
          }, 15);
        }
      }
    }); // установка переключателя

    function setBreaker() {
      var frame = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
      var image = arguments.length > 1 ? arguments[1] : undefined;
      var idd = arguments.length > 2 ? arguments[2] : undefined;

      if (frame && frames > 0) {
        var block = frame.find('.slot');
        block.html(''); // block.append(`<div class="frame-fill-item"><div class="config-grid__remove js-remove-frame">
        //   <div class="close-icon">
        //   </div>
        // </div>
        // <img class="js-draggable remember" draggable="false" data-id=${idd} src="` + image + `" alt=""/>
        // </div>`);

        frame.addClass('placed');
        block.append("<img class=\"js-draggable remember\" draggable=\"false\" data-id=".concat(idd, " src=\"") + image + "\" alt=\"\"/>");
        updateResult();
      } else if (frames > 1) {
        for (var i = 0; i < frames; i++) {
          var elem = slots.eq(i);
          var slot = elem.find('.slot');

          if (!slot.children().length) {
            setBreaker(elem, image, idd);
            break;
          }
        }
      } else {
        setBreaker(slots.eq(0), image, idd);
      }
    } // установка рамки


    function setFrames(_x) {
      return _setFrames.apply(this, arguments);
    } // проверка пересечений


    function _setFrames() {
      _setFrames = _asyncToGenerator(
      /*#__PURE__*/
      regeneratorRuntime.mark(function _callee2(value) {
        var zoom,
            orient,
            change,
            configWidth,
            configHeight,
            mobileCoef,
            calcWidth,
            breakerWidth,
            breakerPadding,
            sizing,
            _args2 = arguments;
        return regeneratorRuntime.wrap(function _callee2$(_context2) {
          while (1) {
            switch (_context2.prev = _context2.next) {
              case 0:
                zoom = _args2.length > 1 && _args2[1] !== undefined ? _args2[1] : 1;
                orient = _args2.length > 2 && _args2[2] !== undefined ? _args2[2] : null;
                change = _args2.length > 3 && _args2[3] !== undefined ? _args2[3] : true;
                frames = value;

                if (orient) {
                  orientation = orient;
                } // смена картинки у рамки


                if (!change) {
                  _context2.next = 8;
                  break;
                }

                _context2.next = 8;
                return changeFrameImage(value);

              case 8:
                if (orient) {
                  frameBlock.removeClass('vertical horizontal');

                  if (orientation === 'vertical') {
                    // config.addClass('vertical');
                    frameBlock.addClass('vertical');
                  } else {
                    frameBlock.addClass('horizontal'); // config.removeClass('vertical');
                  }
                } // добавление класса с количеством постов


                $('.config-grid__frame').removeClass('quantity1 quantity2 quantity3 quantity4 quantity5');
                $('.config-grid__frame').addClass('quantity' + value); // высота рамки

                configWidth = config.width() * zoom;
                configHeight = config.height() * zoom;
                mobileCoef = $(window).width() < 768 ? 10 : 0;
                calcWidth = orientation === 'horizontal' ? configWidth * (sizes[value - 1] - mobileCoef) / 100 : configHeight * (sizes[value - 1] - mobileCoef) / 100;
                breakerWidth = calcWidth / value;
                breakerPadding = breakerWidth * initialSize / initialWidth;
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
                }, 10); // slots.css('display', 'none');
                // items.css('padding', breakerPadding);
                // $('.config-grid__items').css('padding', breakerPadding);
                // $('.config-grid__image').css({
                //     'width': breakerWidth,
                //     'height': breakerWidth
                // });

                sizing = breakerWidth * initialSizing / initialWidth;

                if (!sizing) {
                  sizing = 0;
                }

                $('.js-grid-sizing span').html(Math.floor(sizing) + ' мм');

                if (value <= 0) {
                  config.addClass('deleted');
                  $('.posts-number .my-radio__item_active').removeClass('my-radio__item_active'); // $('.frame-fill-item').remove();

                  slots.find('img').remove();
                } else {
                  config.removeClass('deleted');
                } // for (let i = 0; i < 5; i++) {
                //     if (i < value) {
                //         // slots.eq(i).css('display', 'block');
                //     } else {
                //         items.eq(i).find('img').remove();
                //     }
                // }


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
      var size1 = w;
      var size2 = w2;
      if (a.x > b.x + size2) return false; // Объект находится правее

      if (a.x + size1 < b.x) return false; // Объект находится левее

      if (a.y > b.y + size2) return false; // Объект находится ниже

      if (a.y + size1 < b.y) return false; // Объект находится выше

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
        var walk = (x - startX) * 3; //scroll-fast

        var walkY = (y - startY) * 3; //scroll-fast

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
      result.frame = getFrameName();
      result.frameOrientation = orientation;
      result.background = getCurrentBg();
      result.mechanisms = [];
      var items = $('.place');

      for (var i = 0; i < frames; i++) {
        var mechanism = items.eq(i).find('img');

        if (mechanism.length) {
          result.mechanisms.push(mechanism.data('id'));
        } else {
          result.mechanisms.push(null);
        }
      }

      console.log(result);
    }

    $('body').on('click', '.js-add-to-order', function () {
      updateResult();
    });
  }

  app.initConfigurator = initConfigurator;
})(jQuery, window.app);

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
/* eslint-disable no-unused-vars */

/* eslint-disable no-undef */


(function ($, app) {
  function initMask() {
    $(".js-phone-mask").mask("+7 (000) 000-00-00");
  }

  app.initMask = initMask;
})(jQuery, window.app);

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
/* eslint-disable no-unused-vars */

/* eslint-disable no-undef */


(function ($, app) {
  function initPopup() {
    $('.js-call-popup').on('click', function (e) {
      e.preventDefault();
      $('html').css({
        'overflow': 'hidden',
        'margin-right': '17px'
      });
      var target = $(this).attr('data-target');
      var popup = $('#' + target);
      var block = popup.find('.popup');
      popup.fadeIn(0);
      block.addClass('popup-anim');
    });
    $('.js-popup-close').on('click', function () {
      var popups = $('.popup-wrapper');
      var popup = $(this).closest('.popup-wrapper');
      popup.fadeOut(0);
      $(this).closest('.popup').removeClass('popup-anim');
      var overflow = true;
      popups.each(function (i, e) {
        if ($(e).css('display') === 'block' && $(e).attr('id') !== popup.attr('id')) {
          overflow = false;
        }
      });

      if (overflow) {
        $('html').css({
          'overflow': '',
          'margin-right': '0'
        });
      }
    });
    $(document).mouseup(function (e) {
      var target = e.target.className;

      if ((target === 'popup-wrapper' || target === 'popup-wrapper__wrap') && e.pageX + 18 < $(window).width()) {
        var block;

        if (target === 'popup-wrapper__wrap') {
          block = $(e.target.closest('.popup-wrapper'));
        } else {
          block = $(e.target);
        }

        block.find('.popup').removeClass('popup-anim');
        block.fadeOut(0);
        var overflow = true;
        var popups = $('.popup-wrapper');
        popups.each(function (i, e) {
          console.log($(e).css('display'));

          if ($(e).css('display') === 'block') {
            overflow = false;
          }
        });

        if (overflow) {
          $('html').css({
            'overflow': '',
            'margin-right': '0'
          });
        }
      }
    });
  }

  app.initPopup = initPopup;
})(jQuery, window.app); // /* eslint-disable no-unused-vars */
// /* eslint-disable no-undef */


(function ($, app) {
  var isFormValidate = function isFormValidate(form, error_class) {
    var result = true;
    var rq = $('.required', form).length;
    var check = ['input[type="text"]', 'input[type="login"]', 'input[type="password"]', 'input[type="number"]', 'input[type="checkbox"]', 'input[type="tel"]', 'input[type="email"]', 'input[type="select"]', 'input[type="file"]', 'textarea', 'select'];
    var parent;
    error_class = error_class || 'invalid-input';
    $('.required, input, textarea, select').removeClass(error_class);

    if (rq < 1) {
      return result;
    }

    for (var i = 0; i < rq; i++) {
      parent = $('.required', form).eq(i); // eslint-disable-next-line no-loop-func

      $(check.join(','), parent).each(function () {
        if (!isFieldValidate($(this))) {
          if ($(this).attr('type') === 'checkbox' || $(this).attr('type') === 'file') {
            $(this).closest('label').addClass(error_class);
          } else {
            $(this).addClass(error_class);
          }

          result = false;
        }
      });
    }

    if (result) {
      form.removeClass('form-invalid');
    } else {
      form.addClass('form-invalid');
    }

    return result;
  };

  var isValidEmail = function isValidEmail(email) {
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(email);
  };

  var isValidPhone = function isValidPhone(phone) {
    var pattern = new RegExp(/\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}/i);
    return pattern.test(phone);
  };

  var isValidFile = function isValidFile(file) {
    var maxSize = $(file).data('max-size');
    var type_reg = /^image\/(jpg|png|jpeg|gif)$/;

    if (file.get(0).files[0].size > maxSize || file.get(0).files[0].name === '' || !type_reg.test(file.get(0).files[0].type)) {
      return false;
    }

    return true;
  };

  var isFieldValidate = function isFieldValidate(field) {
    var result = true;
    var val = '';

    if (field && field.attr('name')) {
      if (!field.val()) {
        field.val('');
        return false;
      }

      val = (field.val() + '').trim();

      if (field.hasClass('js-valid_email') && !isValidEmail(val)) {
        result = false;
      } else if (field.attr('name') === 'phone' && !isValidPhone(val)) {
        result = false;
      } else if (field.attr('type') === 'checkbox' && !field.is(':checked')) {
        result = false;
      } else if (field.attr('type') === 'file' && !isValidFile(field)) {
        result = false;
      } else if (val === null || val === '') {
        field.val('');
        result = false;
      }
    }

    return result;
  };

  app.isFormValidate = isFormValidate;
})(jQuery, window.app);
/* eslint-disable no-unused-vars */

/* eslint-disable no-undef */
// import {isFormValidate} from './initValidate';


(function ($, app) {
  /**
   * init
   */
  var initSendForm = function initSendForm() {
    $('body').on('submit', 'form', function (e) {
      return sendForm(e);
    });
  };
  /**
   * Валидация перед отправкой формы
   *
   * @param {object} e event
   */


  var sendForm = function sendForm(e) {
    var t = $(e.target);

    if (!app.isFormValidate(t)) {
      e.preventDefault();
      e.stopPropagation();
      $('.js-form-result', t).text('Заполните все поля');
      $('.invalid-input', t).first().focus();
    } else if (t.hasClass('js-ajax-form')) {
      e.preventDefault();
      e.stopPropagation();
      t.addClass('load');
      axios.post(t.attr('action'), new FormData(t.get(0))).then(function (response) {
        successResponse(response.data, t);
        t.removeClass('load');
      }).catch(function (error) {
        errorResponse(error.response.data, t);
        t.removeClass('load');
      });
    } else {
      // let uploadFormData = new FormData(t.get(0));
      // for (let [key, value] of uploadFormData.entries()) { // не работает в IE
      //     console.log(key, value);
      // }
      $('.js-form-result', t).text('');
      e.preventDefault();
      e.stopPropagation();
    }
  };
  /**
   * fail callback
   *
   * @param data
   * @param form
   */


  var errorResponse = function errorResponse(data, form) {
    if (isObject(data.errors)) {
      $('.js-form-result', form).text('');

      for (var i in data.errors) {
        if ({}.hasOwnProperty.call(data.errors, i)) {
          $('[name="' + i + '"]', form).addClass('invalid-input');
          $('.js-form-result', form).append(data.errors[i].join('</br>'));
        }
      }

      form.addClass('form-invalid');
    } else {
      $('.js-form-result', form).text(data.message);
      form.addClass('form-invalid');
    }
  };
  /**
   * callback success
   *
   * @param data
   * @param form
   */


  var successResponse = function successResponse(data, form) {
    if (data.action === 'modal') {
      openModal(data.modal);
    } else if (data.action === 'reload') {
      location.reload();
    } else if (data.action === 'navigate') {
      location.href = data.link;
    } else if (data.action === 'send') {
      form.html('<div class="form__message form__message_success">' + data.content + '</div>');

      if (data.goal) {
        sendTarget(data.goal);
      }
    } else if (data.action === 'load') {
      openModal(data.modal);
      $('#popup-check-register button[type="reset"]').click();
      $('.section-calendar .calendar__table').html(data.content);
    }
  };

  app.initSendForm = initSendForm;
})(jQuery, window.app);