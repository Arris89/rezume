'use strict';

function _defineProperty(obj, key, value) {
  if (key in obj) {
    Object.defineProperty(obj, key, {
      value: value,
      enumerable: true,
      configurable: true,
      writable: true,
    });
  } else {
    obj[key] = value;
  }
  return obj;
}

svg4everybody();

(function() {
  var iterate = function iterate(items, callback) {
    items.forEach(function(item) {
      var key = void 0;
      var value = void 0;

      if (typeof item === 'string') {
        key = item;
        value = item;
      } else {
        key = item[0];
        value = item[1];
      }

      callback(key, value);
    });
  };

  var check = function check(category, items) {
    iterate(items, function(key, value) {
      if (bowser[key]) {
        document.documentElement.classList.add('is-' + category + '-' + value);
      }
    });
  };

  check('engine', [
    'blink', 'gecko', ['msedge', 'edge'],
    ['msie', 'ie'], 'webkit',
  ]);

  check('device', ['mobile', 'tablet']);

  check('browser', [
    'android',
    'bada',
    'blackberry',
    'chrome',
    'firefox',
    'ios',
    'kMeleon',
    ['msedge', 'edge'],
    ['msie', 'ie'],
    'opera',
    'phantom',
    'qupzilla',
    'safari',
    'sailfish',
    ['samsungBrowser', 'samsung'],
    'seamonkey',
    'silk',
    'sleipnir',
    'tizen',
    'ucbrowser',
    'vivaldi',
    'webos',
    ['yandexbrowser', 'yandex'],
  ]);

  check('os', [
    'android',
    'bada',
    'blackberry',
    'chromeos',
    'firefoxos',
    'ipad',
    'iphone',
    'ipod',
    'ios',
    'linux',
    'mac',
    'windows',
    'windowsphone',
    'sailfish',
    'tizen',
    'webos']);
})();

var $window = $(window);
var $document = $(document);
var $html = $(document.documentElement);
var $body = $(document.body);

// позиция начала клика или тапа по экрану
var positionTap = {
  X: 0,
  Y: 0,
};

// проверка события прокрутки
var wheelEvent = getWheelEvent();

function getWheelEvent() {
  var wheelEvent = 'DOMMouseScroll';
  if ('onwheel' in document) {
    // IE9+, FF17+, Ch31+
    wheelEvent = 'wheel';
  } else if ('onmousewheel' in document) {
    // устаревший вариант события
    wheelEvent = 'mousewheel';
  } else {
    // Firefox < 17
    wheelEvent = 'MozMousePixelScroll';
  }

  return wheelEvent;
}

// header
$(document).ready(function() {
  setPositionFixedHeader();

  $(window).scroll(function() {
    if ($(window).scrollTop() > 10) {
      $('body').addClass('is-fixed');
    } else {
      $('body').removeClass('is-fixed');
    }
  });

  $(window).resize(function() {
    setPositionFixedHeader();
  });

  function setPositionFixedHeader() {
    var headerHeight = $(".js-fixed-header").outerHeight();

    if ($(window).scrollTop() > 10) {
      $('body').addClass('is-fixed');
    } else {
      $('body').removeClass('is-fixed');
    }

    $('.all-wrap').css({
      paddingTop: headerHeight + 'px'
    });
    $('.header-mobile-menu').css({
      paddingTop: headerHeight + 'px'
    });
    $('.js-main-start').css({
      height: $(window).height() - headerHeight + 'px'
    });
  }
});

/* прокрутка информации */
$(document).ready(function() {
	if (typeof mCustomScrollbar !== "undefined" && $('.js-custom-scrollbar-y').length > 0) {
	  $('.js-custom-scrollbar-y').each(function () {
		let $scrollbarBlock = $(this);

		setTimeout(function () {
		  $scrollbarBlock.mCustomScrollbar({
			keyboard: {scrollType: "stepped"},
			mouseWheel: {scrollAmount: 300, normalizeDelta: true},
			axis: "y",
			theme: "rounded-dark"
		  });
		}, 100);
	  });
	}
});

// анимация
$(document).ready(function() {
  // подключение анимации
  AOS.init({
    duration: 1000,
    offset: 200,
  });

  if ($('.js-animate').length > 0) {
    $(window).on('scroll', function() {
      if ($('.js-animate').offset().top <= $(window).height() * 2 / 3 +
          $(window).scrollTop()) {
        $('.js-animate').addClass('is-animate');
      } else {
        $('.js-animate').removeClass('is-animate');
      }
    });
  }

  // плавный скролл к блоку
  $('.js-page-slideDown').on(wheelEvent, function(e) {
    e = e || window.event;

    var $activeSection = $(this);
    var delta = e.deltaY || -e.detail || e.wheelDelta ||
        -e.originalEvent.detail || -e.originalEvent.deltaY;
    delta = -20 * Math.max(-1, Math.min(1, delta));

    if (pageSlideSection($activeSection, delta)) {
      e.stopPropagation();
      e.preventDefault();
      return false;
    }
  }).on('touchstart', function(e) {
    positionTap.X = e.changedTouches !== undefined && e.changedTouches[0] !==
    undefined ? e.changedTouches[0].pageX : e.pageX;
    positionTap.Y = e.changedTouches !== undefined && e.changedTouches[0] !==
    undefined ? e.changedTouches[0].pageY : e.pageY;
  }).on('touchend', function(e) {
    var positionCurrent = {
      X: e.changedTouches !== undefined && e.changedTouches[0] !== undefined ?
          e.changedTouches[0].pageX :
          e.pageX,
      Y: e.changedTouches !== undefined && e.changedTouches[0] !== undefined ?
          e.changedTouches[0].pageY :
          e.pageY,
    };

    if (Math.abs(positionTap.Y - positionCurrent.Y) > 3) {
      var $activeSection = $(this);
      var delta = positionTap.Y - positionCurrent.Y;

      pageSlideSection($activeSection, delta);
    }
  });

  function pageSlideSection($activeSection, delta) {
    var destination = -1;
    var scrollTop = $(window).scrollTop();
    var activeIndex = $activeSection.index('.js-page-slideDown');

    if (delta > 0 && activeIndex < $('.js-page-slideDown').length - 1) {
      if ($activeSection.offset().top + $activeSection.outerHeight() <=
          scrollTop + $(window).height()) {
        destination = $('.js-page-slideDown').eq(1 + activeIndex).offset().top;
      }
    } else if (delta < 0 && activeIndex > 0) {
      if (scrollTop <= $activeSection.offset().top) {
        destination = $('.js-page-slideDown').eq(activeIndex - 1).offset().top;

        if (destination >= $(window).scrollTop()) {
          destination = -1;
        }
      }
    }

    if (destination >= 0 && destination !== $(window).scrollTop()) {
      destination = Math.max(0, destination);

      $('html, body').stop().animate({
        scrollTop: destination,
      }, 1000);

      return true;
    }

    return false;
  }
});

// подключение попап
// попап
$(document).ready(function() {
  $('body').on('click', function() {
    $('.js-popup-close').click();
  }).keydown(function(e) {
    if (e.keyCode == 27) {
      $('.js-popup-close').click();
    }
  }).on('click', '.js-popup-close', function(e) {
    e.preventDefault();
    e.stopPropagation();

    if ($('.js-popup').length > 0 && $('.js-popup').hasClass('is-open')) {
      $('.js-popup').removeClass('is-open');
    }
  }).on('click', '.js-popup', function(e) {
    e.stopPropagation();
  }).on('click', '.js-open-popup', function(e) {
    e.stopPropagation();

    var html = '';

    if ($(this).data('popup') == undefined) {
      return false;
    }

    var $popupData = $('#' + $(this).data('popup'));

    if ($popupData.length > 0) {
      html = $popupData.html();
    }

    if ($popupData.find('[id]').length > 0) {
      $popupData.find('[id]').each(function() {
        $(this).attr('data-id', $(this).attr('id'));
        $(this).removeAttr('id');
      });
    }

    if (html != '') {
      if ($('.js-popup').length < 1) {
        $('body').
            append(
                '<div class="popup js-popup"><div class="popup__overlay js-popup-close"></div><div class="popup__content"><button class="popup__close js-popup-close" type="button"></button><div class="popup__content-inner"></div></div></div>');
      } else {
        $('.js-popup').removeClass('is-success');
      }

      $('.popup__content-inner').html(html);

      setTimeout(function() {
        $('.js-popup').addClass('is-open');
      }, 100);

      // добавить валидатор на форму
      var feedbackValidator = $('.js-popup form').validate({
        success: 'valid',
        debug: true,
        rules: {
          phone: {
            phone: true,
          },
          email: {
            email: true,
          },
        },
      });
    }
  });
});

// обратная связь
$(document).ready(function() {
  $.validator.methods.phone = function(value, element) {
    var re = /^(\+?\d[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/;
    return this.optional(element) || re.test(value);
  };

  // валидация формы регистрации
  $.extend($.validator.messages, {
    required: 'Заполните обязательное поле',
    remote: 'Исправьте это поле',
    email: 'Пожалуйста, введите корректный email',
    phone: 'Пожалуйста, введите корректный номер телефона',
    url: 'Пожалуйста, введите корректный url',
    date: 'Пожалуйста, введите корректную дату',
    dateISO: 'Пожалуйста, введите корректную дату (ISO)',
    number: 'Пожалуйста, введите корректное число',
    digits: 'Пожалуйста, введите только числа',
    equalTo: 'Повторите одно и то же значение',
    maxlength: $.validator.format('Введите не более {0} символов'),
    minlength: $.validator.format('Введите не менее {0} символов'),
    rangelength: $.validator.format(
        'Введите значение между {0} и {1} символами'),
    range: $.validator.format('Введите значение между {0} и {1}'),
    max: $.validator.format('Введите значение, меньшее или равное {0}'),
    min: $.validator.format('Введите значение больше или равно {0}'),
    step: $.validator.format('Введите несколько из {0}'),
  });

  var feedbackValidator = $('form').validate({
    success: 'valid',
    debug: true,
    rules: {
      phone: {
        phone: true,
      },
      email: {
        email: true,
      },
    },
  });

  // отправка форм
  $('body').on('submit', '.js-form-ajax', function() {
    var $form = $(this);

    $.ajax({
      url: $form.attr('action'),
      data: $form.serialize() + '&send=' +
          $form.find('[type="submit"]').attr('name'),
      type: 'POST',
      beforeSend: function beforeSend() {
        $('.js-ajax-loader').fadeIn(200);
      },
      success: function success(data) {
        if (data.errors) {
          $form.prepend(
              '<div class="alert alert_error">' + data.errors + '</div>');
          return;
        }

        if (data.success) {
          $form.closest('.js-popup').addClass('is-success');
          $form.siblings().remove();

          if ($form.closest('.js-popup').find('.popup__title').length < 1) {
            $form.before('<div class="popup__title" />');
          }
          $form.closest('.js-popup').find('.popup__title').text('Спасибо!');

          if ($form.closest('.js-popup').find('.popup__descr').length < 1) {
            $form.before('<div class="popup__descr" />');
          }
          $form.closest('.js-popup').find('.popup__descr').html(data.success);

          $form.before(
              '<button type="button" class="btn btn_small js-popup-close">Закрыть</button>');

          $form.remove();
        }
      },
      error: function error(data) {
        console.log(data);

        $form.prepend(
            '<div class="alert alert_error">Произошла ошибка. Пожалуйста, попробуйте позже.</div>');
      },
      complete: function complete(data) {
        $('.js-ajax-loader').fadeOut(200);
      },
      dataType: 'json',
    });

    return false;
  });
});

// подключение instagram
$(document).ready(function() {
  // если есть блок с инстаграммом то загрузим посты черезе аякс
  if ($('.js-instagram-slides').length > 0) {
    var $instagramBlock = $('.js-instagram-slides');

    $instagramBlock.on('init', function(event, slick) {
      $(slick.$slider).
          find('[data-slick-index="0"] .js-instagram-pagination').
          append($(slick.$slider).find('.slick-dots'));
    });

    $instagramBlock.slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      infinite: true,
      fade: true,
      prevArrow: '<div class="slick-arrow slick-arrow_prev"></div>',
      nextArrow: '<div class="slick-arrow slick-arrow_next"></div>',
      dots: true,
      customPaging: function customPaging(slider, i) {
        return '<a href="javascript: void(0)">' + (+i + 1) + '</a>';
      },
      speed: 500,
      adaptiveHeight: true,
    });

    $instagramBlock.on('beforeChange',
        function(event, slick, currentSlide, nextSlide) {
          $(slick.$slider).
              find('[data-slick-index="' + nextSlide +
                  '"] .js-instagram-pagination').
              append($(slick.$slider).find('.slick-dots'));
        });
  }
});

$(document).ready(function() {
  $('.js-anchor').click(function(e) {
    var $elementClick = void 0;
    var hash = '';
    var url = '';

    // иначе разбираем по хэшу и ссылке
    if ($(this).attr('href') !== undefined &&
        $(this).attr('href').split('#').length > 1) {
      url = $(this).attr('href').split('#');
      hash = '#' + url.pop();
      url = url[0];
    }

    if (hash !== '' && $(hash).length > 0) {
      e.preventDefault();

      $elementClick = $(hash);
      var destination = $elementClick.offset().top;

      $('html, body').animate({
        scrollTop: destination,
      }, 500);

      return false;
    }
  });

  $('body').on('click', '.js-header-hamburger', function() {
    if ($('.js-header-mobile-menu').length < 1) {
      $('.js-fixed-header').
          after('<div class="header-mobile-menu js-header-mobile-menu"></div>');

      var $mobileMenu = $('.js-header-mobile-menu');
      $mobileMenu.css({
        paddingTop: $('.js-fixed-header').outerHeight() + 'px',
      });

      if ($('.js-header-top').length > 0) {
        $mobileMenu.append($('.js-header-top').clone());
      }

      if ($('.js-header-menu').length > 0) {
        $mobileMenu.append($('.js-header-menu').clone());
      }

      if ($('.js-header-small-menu').length > 0) {
        $mobileMenu.append($('.js-header-small-menu').clone());
      }
    }

    $(this).toggleClass('is-active');
    $('.js-header-mobile-menu').toggleClass('is-open');
  });

  $('body').
      on('click', '.js-header-mobile-menu .js-header-small-menu a', function() {
        $('.js-header-hamburger').removeClass('is-active');
        $('.js-header-mobile-menu').removeClass('is-open');
      });
});

$(document).ready(function() {
  $('.js-horizontal-button').click(function(e) {
    e.preventDefault();

    var $button = $(this);

    $button.addClass('is-active').siblings().removeClass('is-active');
    $button.closest('.js-horizontal-tabs').
        find('.js-horizontal-body').
        eq($button.index()).
        fadeIn(150).
        siblings('.js-horizontal-body').
        hide();

    return false;
  });
});

// плагин для отображения видео ютуб
$(document).ready(function () {
    if ($('.js-video-player-bg').length > 0) {
        $('.js-video-player-bg').each(function () {
            var $player = $(this);
            var intervalPlayer = null;

            $player.YTPlayer({
                mute: true,
                showControls: false,
                useOnMobile: true,
                ratio: 'auto',
                quality: 'auto',
                opacity: 1,
                containment: $player,
                optimizeDisplay: false,
                loop: 100,
                startAt: 0,
                autoPlay: true,
                stopMovieOnBlur: true,
                playOnlyIfVisible: true,
				onScreenPercentage: 50,
                showYTLogo: false,
                onReady: function(player) {
                    var widthSlider = $(player).closest('.js-main-start').outerWidth();
                    var heightSlider = $(player).closest('.js-main-start').outerHeight();

                    getVideosSize($(player), widthSlider, heightSlider);

                    setIntervalPlayer();
                    
                    intervalPlayer = setInterval(function() {
                        setIntervalPlayer();
                    }, 60000);

                    window.onfocus = function() {
                        setIntervalPlayer();

                        intervalPlayer = setInterval(function() {
                            setIntervalPlayer();
                        }, 60000);
                    };

                    window.onblur = function() {
                        clearInterval(intervalPlayer);
                    };

                    function setIntervalPlayer () {
                        if (player.player.loopTime && player.player.loopTime >= 99) {
                            $(player).YTPStop();

                            setTimeout(function() {
                                $(player).YTPPlay();
                                $(player).find('.mbYTP_wrapper').css({opacity: 1});
                            }, 50);
                        }
                    }
                }
            });
        });
    }
});

// подключение слайдеров
$(document).ready(function() {
	$('.js-main-start-slides').on('init', function(event, slick) {
		if ($(slick.$slides).length === 1) {
			$('.js-main-start-slides').after('<ul class="slick-dots"><li class="slick-active"></li></ul>');
		}

		if (slick.$slides.find('video, .js-video-player-bg').length > 0) {
			var widthSlider = slick.$slider.outerWidth();
			var heightSlider = slick.$slider.outerHeight();

			getVideosSize(slick.$slides.find('video, .js-video-player-bg'), widthSlider, heightSlider);
		}
	}).slick(_defineProperty({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		infinite: true,
		speed: 600,
		prevArrow: '<div class="slick-arrow slick-arrow_prev"></div>',
		nextArrow: '<div class="slick-arrow slick-arrow_next"></div>',
		dots: true,
		customPaging: function customPaging(slider, i) {
			return '';
		}
	}, 'speed', 1000)).on('setPosition', function(event, slick) {
		if (slick.$slides.find('video').length > 0) {
			var widthSlider = slick.$slider.outerWidth();
			var heightSlider = slick.$slider.outerHeight();

			getVideosSize(slick.$slides.find('video, .js-video-player-bg'), widthSlider, heightSlider);
		}
	});
});

function getVideosSize($videos, widthSlider, heightSlider) {
	$videos.each(function(key, item) {
		var intervalVideo = setInterval(function() {				
			var videoRealSize = {
				height: $(item)[0].videoHeight || $(item).data('height') || $(item).outerHeight(),
				width: $(item)[0].videoWidth || $(item).data('width') || $(item).outerWidth()
			};
			
			if (videoRealSize.height !== 0 && videoRealSize.width !== 0) {
				clearInterval(intervalVideo);
			}

			if (!$(item).data('height')) {
				$(item).data('height', $(item).outerHeight());
			}

			if (!$(item).data('width')) {
				$(item).data('width', $(item).outerWidth());
			}

			var videoSize = {
				width: 'auto',
				minWidth: 0,
				height: 'auto',
				minHeight: 0
			};

			var iframeMoreHeight = $(item).find('iframe').length > 0 ? 400 : 0;

			if (widthSlider / heightSlider > videoRealSize.width / videoRealSize.height) {
				videoSize.width = widthSlider + 'px';
				videoSize.height = videoRealSize.height * widthSlider / videoRealSize.width + iframeMoreHeight + 'px';
			} else {
				videoSize.height = heightSlider + iframeMoreHeight + 'px';
				videoSize.width = videoRealSize.width * heightSlider / videoRealSize.height + 'px';
			}
			
			$(item).css(videoSize);
		}, 100);
	});
}


// слайдеры - кнопки с заголовками
$(document).ready(function() {
	var $slidesBlocksName = $('.js-slides-blocks-name, .equipment-slides, .quest-slides, .halls-slides, .restaurant-menu-slides, .seating-guests-slides, .race-slides, .carts-slides');

	if ($slidesBlocksName.length > 0) {
		$slidesBlocksName.each(function() {
			$(this).on('init', function(event, slick) {
				setTextArrow(slick.$slider, 0, slick.slideCount);
			}).slick({
				infinite: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				dots: false,
				speed: 600,
				cssEase: 'linear',
				prevArrow: '<button class="slick-prev slider-arrow" type="button"></button>',
				nextArrow: '<button class="slick-next slider-arrow" type="button"></button>',
				responsive: [{
					breakpoint: 980,
					settings: {
						adaptiveHeight: true
					}
				}]
			}).on('afterChange', function(event, slick, currentSlide, nextSlide) {
				setTextArrow(slick.$slider, currentSlide, slick.slideCount);
			});
		});
	}
});

function setTextArrow(slider, currentSlide, slideCount) {
	var slides = slider.find('.slick-slide'),
		slidesLength = slideCount || slides.length,
		indexPrev = currentSlide > 0 ? currentSlide - 1 : slidesLength - 1,
		indexNext = currentSlide + 1;

	var namePrev = slider.find('.slick-slide[data-slick-index="' + indexPrev + '"] .js-arrow-name').text() || 'Назад',
		nameNext = slider.find('.slick-slide[data-slick-index="' + indexNext + '"] .js-arrow-name').text() || 'Далее';

	slider.find('.slick-arrow.slick-prev').text(namePrev);
	slider.find('.slick-arrow.slick-next').text(nameNext);
}

$(document).ready(function() {
	if ($('.sports-hall-slides').length > 0) {
		$('.sports-hall-slides').slick({
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			dots: false,
			speed: 600,
			cssEase: 'linear',
			prevArrow: '<button class="slick-prev slider-arrow" type="button" style="">Назад</button>',
			nextArrow: '<button class="slick-next slider-arrow" type="button" style="">Далее</button>',
			adaptiveHeight: true
		});
	}
});

// слайдер старых событий
$(document).ready(function () {
  if ($('.js-old-events').length > 0) {
    $('.js-old-events')
      .slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        speed: 600,
        cssEase: 'linear',
        arrows: true,
        prevArrow: '<button class="slick-arrow slick-arrow_prev" type="button"></button>',
        nextArrow: '<button class="slick-arrow slick-arrow_next" type="button"></button>',
        responsive: [
          {
            breakpoint: 480,
            settings: {
              arrows: false,
            }
          }
        ]
      });
  }
});

$(document).ready(function() {
	if ($(window).width() < 980) {
		setTimeout(function() {
			var sl = $('.slick-slider:not(.main-start__slides)');
			sl.each(function(i, el) {
				var h = $(el).find('.slick-slide.slick-active').outerHeight();
				$(el).find('.slick-track').height(h);
				$(el).find('.slick-list').height(h);
			});
		}, 600);
	}
});

// галерея
$(document).ready(function () {
  if ($('.gallery').length > 0) {
    gallerySlider();
  }

  $('.gallery-arrow.gallery-arrow-prev').click(function () {
    if (+$('.gallery').attr('active') == 1) {
      $('.gallery').attr('active', $('.gallery-slide').length);
      gallerySlider();
    } else {
      var slideIndex = +$('.gallery').attr('active') - 1;
      $('.gallery').attr('active', slideIndex);
      gallerySlider();
    }
  });

  $('.gallery-arrow.gallery-arrow-next').click(function () {
    var slidersLn = $('.gallery-slide').length;
    if (+$('.gallery').attr('active') == slidersLn) {
      $('.gallery').attr('active', 1);
      gallerySlider();
    } else {
      var slideIndex = +$('.gallery').attr('active') + 1;
      $('.gallery').attr('active', slideIndex);
      gallerySlider();
    }
  });

  $('.gallery-slide').click(function () {
    var _this = $(this),
      slides = $('.gallery-slide'),
      slideIndex = slides.index(_this) + 1;
    // if (slideIndex == slides.length) {
    //   slideIndex = 1;
    // }
    $('.gallery').attr('active', slideIndex);
    gallerySlider();
  });

  function gallerySlider() {
    var slideIndex = +$('.gallery').attr('active'),
      slideActive = $('#gallery-slide-' + slideIndex),
      slideTitle = slideActive.data('title'),
      slideDate = slideActive.data('date'),
      slideBgImg = slideActive.css('backgroundImage');

    $('[id^="gallery-slide-"]').not($('#gallery-slide-' + slideIndex)).removeClass('is-active');
    slideActive.addClass('is-active');
	
    $('.gallery .gallery-title').fadeOut(200, function() {
      $('.gallery .gallery-title').html(slideTitle).fadeIn(500);
    });

    $('.gallery .gallery-date').fadeOut(200, function() {
      $('.gallery .gallery-date').html(slideDate).fadeIn(500);
    });

    $('.gallery .gallery-image').fadeOut(200, function() {
      $('.gallery .gallery-image').css({
        backgroundImage: slideBgImg
      }).fadeIn(500);
    });

    return false;
  }
});


// подключение карты
// маршруты
var GOOGLE_API_KEY = 'AIzaSyAWMjY2e4DG-JI8xP5rR7kIObeJan5L_j0';
//var COORDS_FORZA = '55.721597, 37.682974';
var COORDS_FORZA = '55.719838, 37.683936';
var COORDS_PARKING = [
  {
    lat: 55.719582,
    lng: 37.684042,
  }, {
    lat: 55.719632,
    lng: 37.684232,
  }, {
    lat: 55.719483,
    lng: 37.684345,
  }, {
    lat: 55.719438,
    lng: 37.684147,
  }, {
    lat: 55.719582,
    lng: 37.684042,
  }];

$(document).ready(function() {
  window.routes = {};

  if (document.querySelector('.js-opening-contacts-map')) {
	  var script = document.createElement('script');
	  script.src = 'https://maps.googleapis.com/maps/api/js?key=' + GOOGLE_API_KEY +
		  '&callback=initMap';
	  script.defer = true;
	  script.async = true;
	  (document.head || document.documentElement).appendChild(script);

	  $('body').on('click', '.js-route-title', function() {
		var $routeTitle = $(this);
		var $routeBlock = $routeTitle.closest('.js-route');

		if ($routeBlock.length < 1) {
		  return false;
		}

		if ($routeBlock.hasClass('is-active')) {
		  return false;
		}

		$routeBlock.siblings('.js-route').removeClass('is-active');
		$routeBlock.addClass('is-active');
	  });
  }
});

function initMap() {
  if (!document.querySelector('.js-opening-contacts-map')) {
    return;
  }

  // создание маршрутов
  var directionsService = new google.maps.DirectionsService();

  // создание карты и установка центра
  var map = new google.maps.Map(
      document.querySelector('.js-opening-contacts-map'), {
        zoom: 17,
        center: {
          lat: 55.718335,
          lng: 37.677503,
        },
        mapTypeControl: false,
      });

  var url = getUrl('/js/googleMapStyle.json');
  $.getJSON(url, function(data) {
    map.setOptions({
      styles: data,
    });
  });

  var directionsDisplayDriving = new google.maps.DirectionsRenderer({
    map: map,
    suppressMarkers: true,
    optimizeWaypoints: true,
    polylineOptions: {
      strokeColor: '#8b0013',
      strokeWeight: 4,
      strokeOpacity: 1,
      fillOpacity: 1,
      icons: [],
    },
  });

  var directionsDisplayWalking = new google.maps.DirectionsRenderer({
    map: map,
    suppressMarkers: true,
    optimizeWaypoints: true,
    polylineOptions: {
      strokeColor: '#8b0013',
      strokeWeight: 4,
      strokeOpacity: 0,
      fillOpacity: 0,
      icons: [
        {
          icon: {
            path: google.maps.SymbolPath.CIRCLE,
            fillOpacity: 1,
            scale: 3,
          },
          offset: '0',
          repeat: '10px',
        }],
    },
  });

  var drawParking = new google.maps.Polygon({
    paths: COORDS_PARKING,
    strokeColor: '#FF0000',
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: '#FF0000',
    fillOpacity: 0.35,
  });

  // добавить конечную точку маркером
  addMarker(map);

  // Display the route between the initial start and end selections.
  var travelMode = $('.is-active .js-route-title').data('travel-mode');
  checkParking($('.is-active .js-route-title'));
  calculateAndDisplayRoute(travelMode.toUpperCase() == 'WALKING' ?
      directionsDisplayWalking :
      directionsDisplayDriving, directionsService, map, travelMode);

  $('.js-route-title').click(function() {
    checkParking($(this));
    if (!$(this).closest().hasClass('is-active')) {
      setTimeout(function() {
        onChangeHandler();
      }, 100);
    }
  });

  // Listen to change events from the start and end lists.
  function onChangeHandler() {
    var travelMode = $('.is-active .js-route-title').data('travel-mode');
    directionsDisplayWalking.setMap(null);
    directionsDisplayDriving.setMap(null);
    calculateAndDisplayRoute(travelMode.toUpperCase() == 'WALKING' ?
        directionsDisplayWalking :
        directionsDisplayDriving, directionsService, map, travelMode);
  }

  function checkParking(element) {
    if (element.data('mode') !== undefined && element.data('mode') ==
        'PARKING') addParking();
    else removeParking();
  }

  function addParking() {
    drawParking.setMap(map);
  }

  function removeParking() {
    drawParking.setMap(null);
  }
}

function calculateAndDisplayRoute(
    directionsDisplay, directionsService, map, travelMode) {
  travelMode = $('.is-active .js-route-title').data('travel-mode') || 'DRIVING';
  travelMode = travelMode.toUpperCase();

  // добавление промежуточных точек
  var waypts = [];

  if ($('.is-active .js-route-title').data('waypoints') !== undefined &&
      $('.is-active .js-route-title').data('waypoints').split(', ').length >
      0) {
    var wayptsTemp = $('.is-active .js-route-title').
        data('waypoints').
        split('; ');

    wayptsTemp.forEach(function(item, index) {
      waypts.push({
        location: item,
        stopover: true,
      });
    });
  }

  directionsService.route({
    origin: $('.is-active .js-route-title').data('start'),
    destination: COORDS_FORZA,
    waypoints: waypts,
    optimizeWaypoints: true,
    travelMode: travelMode,
  }, function(response, status) {
    // Route the directions and pass the response to a function to create
    // markers for each step.
    if (status === google.maps.DirectionsStatus.OK) {
      directionsDisplay.setOptions({
        map: map,
      });

      directionsDisplay.setDirections(response);

      window.googleMapZoomTimeout = setTimeout(function() {
        if (map.getZoom() > 18) {
          clearTimeout(window.googleMapZoomTimeout);

          map.setZoom(18);
        }
      }, 100);
    } else {
      window.alert('Directions request failed due to ' + status);
    }
  });
}

function addMarker(map) {
  var bounds = new google.maps.LatLngBounds();
  var coords = COORDS_FORZA.split(', ');

  var icon = getPrefix() + '/images/sprites/svg/map_point.svg';
  var position = new google.maps.LatLng(parseFloat(coords[0]),
      parseFloat(coords[1]));
  bounds.extend(position);

  var marker = new google.maps.Marker({
    position: position,
    animation: google.maps.Animation.DROP,
    icon: icon,
    map: map,
  });
}

function getUrl(url) {
  //ссылка на страницу - она заносится в историю и встает в адресную строку
  if (typeof site_template_path !== 'undefined') {
    return site_template_path + url;
  }

  var section = window.location.href.indexOf('/html/') > 0 ? 'html/' : '';
  return window.location.origin + '/' + section + url.replace(/^\//, '');
}

function getPrefix() {
  if (typeof site_template_path !== 'undefined') {
    return site_template_path;
  }

  return '';
}

// бронирование
$(document).ready(function() {
  $('.js-booking').on('change', '.js-booking-childs-yes', function() {
    var $bookingChildsYes = $(this);

    if ($bookingChildsYes.find('input').prop('checked')) {
      $('.js-booking-childs-count input').prop('disabled', false);
    } else {
      $('.js-booking-childs-count input').prop('disabled', true);
    }
  }).on('click', '.js-booking-time-arrow-top', function() {
    var $listOverflow = $(this).
        closest('.js-booking-time').
        find('.js-booking-time-overflow');

    $listOverflow.find('.js-booking-time-row').each(function() {
      var top = $(this).position().top;

      if (top + $(this).outerHeight() >= 0) {
        top += $listOverflow.scrollTop();

        $listOverflow.animate({
          scrollTop: top,
        }, 500);

        return false;
      }
    });
  }).on('click', '.js-booking-time-arrow-bottom', function() {
    var $listWrap = $(this).
        closest('.js-booking-time').
        find('.js-booking-time-overflow-wrap');
    var $listOverflow = $(this).
        closest('.js-booking-time').
        find('.js-booking-time-overflow');
    var overflowHeight = $listOverflow.scrollTop();

    $listOverflow.find('.js-booking-time-row').each(function() {
      var top = $(this).position().top;

      if (top - $listWrap.outerHeight() + 20 > 0) {
        top += $(this).outerHeight();
        top += overflowHeight;
        top -= $listWrap.outerHeight();

        $listOverflow.animate({
          scrollTop: top + 20,
        }, 500);

        return false;
      }
    });
  });
});

// $(document).ready(function() {
//   if ($('div').is('.tabs')) {
//     $('div').on('click', 'a', function() {
//       var $this = $(this),
//           $tabs = $this.parents('.tabs'),
//           tabType = $this.data('tab');
//
//       var items_all = $('.tabs-content').find('.news-item'),
//           items_news = $('.tabs-content').
//               find('.news-item:not(.news-item_promo)'),
//           items_promo = $('.tabs-content').find('.news-item.news-item_promo');
//
//       items_all.addClass('is-hidden');
//       items_all.removeAttr('data-aos').removeAttr('data-aos-anchor-placement');
//       switch (tabType) {
//         case 'all':
//           items_all.removeClass('is-hidden');
//           break;
//         case 'news':
//           items_news.removeClass('is-hidden');
//           break;
//         case 'promo':
//           items_promo.removeClass('is-hidden');
//           break;
//         default:
//           items_all.removeClass('is-hidden');
//           break;
//       }
//
//       $tabs.find('a').removeClass('is-active');
//       $tabs.addClass('is-active');
//
//       return false;
//     });
//   }
// });

$(document).ready(function() {
  var updateNews = function(e) {
    e.preventDefault();

    if ($(this).is('.tabs-item')) {
      $('.tabs a.tabs-item').removeClass('is-active');
      $(this).addClass('is-active');
    }
    var data = {
      action: 'get_news',
      type: $('div.tabs a.is-active').data('tab'),
    };

    var url = '';
    if ($(this).attr('href').includes('page')) {
      url = $(this).attr('href');
      var destination = $('.tabs-content').offset().top;
      $(window).scrollTop(destination - 100);
    }

    $.ajax({
      url: '/content/news/ajax.php' + url,
      type: 'post',
      data: data,
    }).done(function(html) {
      if (html && html !== 'nope') {
        $('.tabs-content').replaceWith(html);
      }
    });
    return false;
  };

  if ($('div.tabs').length > 0) {
    $('div.tabs').on('click', 'a', updateNews);
    $('body').on('click', 'li a.pagination-link', updateNews);
  }
});

$(document).ready(function() {
	setPositionInstagram();

	$(window).resize(function() {
		setPositionInstagram();
	});
});

//перемещение блока инстаграмма после новостей (для мобильного)
function setPositionInstagram() {
	var isMediaSmall = window.matchMedia("(max-width: 1025px)").matches;

	if ($('.instagram-best').length > 0) {
		var _block = $('.instagram-best').parents('.sidebar__item');
		_block.detach();

		if (isMediaSmall && $('.news').length > 0) {
			$('.news').append(_block);
		} else if (!isMediaSmall && $('.sidebar').length > 0) {
			$('.sidebar').append(_block);
		}
	}
}

// переход по хэшу
$(document).ready(function() {
  if (hash && $(hash).length > 0) {
    $('html, body').animate({
      scrollTop: $(hash).offset().top - $('.js-fixed-header').outerHeight()
    }, 500);
  }
});
