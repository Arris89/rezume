/**
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade this module to newer
* versions in the future. If you wish to customize this module for your
* needs please contact us at contact@devhub.pl
*
*  @author    Devhub <contact@devhub.pl>
*  @copyright (c)2016 Devhub
*  @package   ProductLookbooks
*/
var PRODUCTLOOKBOOKS = (function () {
    'use strict';
    var sliderElement;
    var mainSlide;
    var slides = [];
    var currentSlideIndex = 0;
    var pagination = [];
    var properties = {
        width: 0,
        height: 0,
        ratio: 0,
        loop: true
    };
    var containerDimensions = {
        width: 0,
        height: 0
    };
    var pageCounterElement;



    var updateContainerDimensions = function () {
        containerDimensions.width = sliderElement.width();
        containerDimensions.height = containerDimensions.width / properties.ratio;
    };

    var updateSlidesHeight = function () {
        slides.forEach(function (slide) {
            var descriptionElement = $(slide).find('.associated-products-inner');

            descriptionElement.removeClass('set');
            descriptionElement.css('height', 'auto');
            descriptionElement.height(descriptionElement.height());
            descriptionElement.addClass('set');
        });
    };

    var updateSliderDimensions = function () {
        if (sliderElement.width() === containerDimensions.width) {
            return false;
        }

        updateContainerDimensions();
        updateSlidesHeight();

        sliderElement.find('.outer-slider').css({
            width: containerDimensions.width + 'px',
            height: containerDimensions.height + 'px'
        });
        mainSlide.css({
            width: (containerDimensions.width * slides.length) + 'px',
            height: containerDimensions.height + 'px'
        });
        slides.forEach(function (slide) {
            slide.css({
                width: containerDimensions.width + 'px',
                height: containerDimensions.height + 'px'
            });
        });
        updateSliderPosition();
    };

    var updateSliderPosition = function () {
        var leftOffset = containerDimensions.width * currentSlideIndex * -1;
        mainSlide.css({
            left: leftOffset
        });

        slides.forEach(function (slide, index) {
            if (index === currentSlideIndex) {
                slide.addClass('active');
            } else {
                slide.removeClass('active');
            }
        });
    };

    var updatePagination = function () {
        pagination.forEach(function (page) {
            var elem = $(page);
            var index = +elem.data('index');

            if (index === currentSlideIndex) {
                elem.addClass('active');
            } else {
                elem.removeClass('active');
            }
        });
    };

    var updatePageCounter = function () {
        pageCounterElement.text(currentSlideIndex + 1);
    };

    var slideTo = function (index) {
        if (properties.loop) {
            if (index < 0) {
                index = slides.length - 1;
            } else if (index >= slides.length) {
                index = 0;
            }
        } else {
            if (index < 0) {
                index = 0;
            } else if (index >= slides.length) {
                index = slides.length - 1;
            }
        }

        currentSlideIndex = index;
        updateSliderPosition();
        updatePagination();
        updatePageCounter();
    };

    var onNavPrev = function () {
        slideTo(currentSlideIndex - 1);
    };

    var onNavNext = function () {
        slideTo(currentSlideIndex + 1);
    };

    var onWindowResize = function () {
        updateSliderDimensions();
    };

    var onPaginationClick = function (evt) {
        var slideIndex = $(evt.target).data('index');
        slideTo(slideIndex);
    };

    var onItemButtonClick = function (evt) {
        $(evt.target).closest('.item').toggleClass('show-associated');
    };

    var setUpSlides = function () {
        sliderElement.find('.item').each(function (ignore, slide) {
            $(slide).find('button').on('click tap', onItemButtonClick);
            slides.push($(slide));
        });
    };

    var createPagination = function () {
        var i = 0;
        var length = slides.length;
        var fragment = $(document.createDocumentFragment());
        var elem;

        while (i < length) {
            elem = $('<button type="button">' + (i + 1) + '</button>');
            elem.data('index', i).on('click tap', onPaginationClick);
            pagination.push(elem);
            fragment.append(elem);

            i += 1;
        }

        sliderElement.find('.pagination').append(fragment);
    };

    var setUpSlider = function () {
        var width = +sliderElement.data('width');
        var height = +sliderElement.data('height');

        setUpSlides();
        createPagination();

        properties.width = width;
        properties.height = height;
        properties.ratio = width / height;

        updateSliderDimensions();
    };

    var bindNavigation = function () {
        sliderElement.find('.navigation button[data-direction="prev"]').on('click tap', onNavPrev);
        sliderElement.find('.navigation button[data-direction="next"]').on('click tap', onNavNext);
    };

    var bindResize = function () {
        $(window).on('resize', onWindowResize);
    };

    var init = function (elem) {
        sliderElement = elem;
        if (!sliderElement) {
            return false;
        }
        mainSlide = sliderElement.find('.inner-slider');
        pageCounterElement = sliderElement.find('.current-page');

        setUpSlider();
        bindNavigation();
        bindResize();
        slideTo(0);
        updateSlidesHeight();
    };

    return {
        init: init
    };
}());

$(document).ready(function () {
    PRODUCTLOOKBOOKS.init($('#productlookbooks'));
});


$(function () {
    'use strict';
    var $slider_wrapper = $('#productlookbooks-slider');
    var $elems = {
        parent: $slider_wrapper.parent(),
        products: $slider_wrapper.find('#productlookbooks-slider-products'),
        presentation: $slider_wrapper.find('#productlookbooks-slider-presentation'),
        nav: $slider_wrapper.find('#productlookbooks-slider-nav'),
        pagination: $slider_wrapper.find('#productlookbooks-slider-pagination'),
        images_wrapper: $('#productlookbooks-slider-images'),
    };
    var products = {};
    var slides = {
        current_index: 0,
        prev: null,
        current: null,
        by_id: {},
        by_position: [],
        images: []
    };
    var settings = {
        products_width: 250,
        max_height: 700,
        products_position: 'left',
        slide_direction: 'left',
        slide_autoplay: false,
        slide_speed: 250,
        slide_delay: 5000,
        slide_pause_on_hover: true,
        nav: true,
        pagination: true,
        full_width: true,
    };
    var vendor_prefix = '';
    
    var setupVendorPrefixes = function () {
        var browser = {};
        var ua = navigator.userAgent.toLowerCase();
        var match = /(chrome)[ \/]([\w.]+)/.exec(ua) ||
                /(webkit)[ \/]([\w.]+)/.exec(ua) ||
                /(opera)(?:.*version|)[ \/]([\w.]+)/.exec(ua) ||
                /(msie) ([\w.]+)/.exec(ua) ||
                ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec(ua) ||
                [];
        var browser_name = match[1] || "";

        if (browser_name) {
            browser[browser_name] = true;
        }
        
        vendor_prefix = (browser.webkit)  ? '-webkit-' :
                        (browser.mozilla) ? '-moz-' : 
                        (browser.msie)    ? '-ms-' :
                        (browser.opera)   ? '-o-' : '';
    };
    
    var slider = (function () {
        var getStartImage = function () {
            var matches = location.hash.match(/^#\/photo-([\d]+)$/i);
            var id_image;
            
            if (!matches || matches.length !== 2) {
                return 0;
            }
            id_image = +matches[1];
            
            return $elems.images_wrapper.children('[data-id="'+ id_image +'"]').index();
        };
        
        var getMaxHeight = function () {
            var $biggest_image;
            var biggest_width = 0;
            var max_width = $elems.presentation.width();
            var max_height = settings.max_height;
            
            slides.images.forEach(function ($img) {
                if ($img.width() > biggest_width) {
                    biggest_width = $img.width();
                    $biggest_image = $img;
                }
            });
            if ($biggest_image) {
                max_height = $biggest_image.height() * max_width / biggest_width;
            }
            
            return Math.min(settings.max_height, $(window).height() * 0.9, max_height);
        };
        
        var setupItemsSize = function () {
            $elems.slider_items = $elems.images_wrapper.children('.productlookbooks-slider-slide');
            
            $elems.products.css({
                width: settings.products_width + 'px'
            });
            $elems.presentation.css({
                width: ($slider_wrapper.width() - settings.products_width) + 'px'
            });
            
            $elems.slider_items.css({
                height: getMaxHeight() + 'px'
            });
        };
        
        var createRewindSlide = function () {
            var $elem = $('<div class="productlookbooks-slider-rewind">');
            
            $elem.on('click tap', function () {
                goto(0);
            });
            
            $elems.rewind_slide = $elem;
            $elems.images_wrapper.append($elem);
        };
        
        var setupItems = function () {
            setupItemsSize();
            
            $elems.product_items = $elems.products.children('.productlookbooks-slider-product-wrap');
            $elems.product_items.each(function (_ignore, item) {
                var $item = $(item);
                var id = $item.data('id');

                products[id] = {
                    id: id,
                    $item: $item,
                    $children: $item.children('.productlookbooks-slider-product')
                };
            });
            $elems.product_items.css(vendor_prefix + 'transition', 'opacity '+ settings.slide_speed +'ms ease, visibility '+ settings.slide_speed +'ms ease');

            $elems.slider_items.each(function (index, item) {
                var $item = $(item);
                var id = $item.data('id');
                var $temp_img = $('<img>');
                var $img = $item.find('img');
                
                $item.data('index', index);
                
                $temp_img.on('load', (function () {
                    $(this).css({
                        opacity: 1
                    });
                    $(this).closest('.productlookbooks-slider-slide').addClass('loaded');
                    slides.images.push($(this));
                    
                    setupSliderWidth();
                    setupItemsSize();
                    setupItemPositions();
                    goto(slides.current_index);
                }).bind($img)).attr('src', $img.attr('src'));
                
                slides.by_id[id] = {
                    index: index,
                    id: id,
                    products: products[id],
                    $item: $item
                };
                slides.by_position.push(slides.by_id[id]);
            });
            $elems.slider_items.on('click tap', function () {
                goto($(this).data('index'));
            });
        };

        var setupItemPositions = function () {
            var max_height = getMaxHeight();
            var left = 0;

            slides.by_position.forEach(function (slide) {
                var width = +slide.$item.data('width');
                var height = +slide.$item.data('height');
                var multiplier = height / max_height;
                
                slide.width = width / multiplier;
                slide.height = height;

                slide.left = left * -1;
                
                slide.$item.css({
                    width: slide.width + 'px'
                });
                
                left += slide.width;
            });
            slides.current = slides.by_position[slides.current_index];
            
            $elems.rewind_slide.css({
                height: max_height
            });
        };
        
        var setupNav = function () {
            if (settings.nav !== true) {
                $elems.nav.hide();
            }
            $elems.nav.children('button').on('click tap', function () {
                var direction = $(this).data('direction');

                if (direction === 'prev') {
                    goto(slides.current_index - 1);
                } else if (direction === 'next') {
                    goto(slides.current_index + 1);
                    
                } else if (direction === 'products') {
                    $('body, html').animate({
                        scrollTop: $elems.products.offset().top
                    }, settings.slide_speed);
                }
            });
        };
        
        var toggleProducts = function () {
            if (slides.prev) {
                slides.prev.products.$item.css({
                    visibility: 'hidden',
                    opacity: 0,
                    zIndex: 9
                });
            }
            slides.current.products.$item.css({
                visibility: 'visible',
                opacity: 1,
                zIndex: 10
            });
            $elems.products.height(slides.current.products.$item.height());
        };
        
        var goto = function (slide_index) {
            if (slide_index >= slides.by_position.length) {
                slide_index = 0;
            } else if (slide_index < 0) {
                slide_index = slides.by_position.length - 1;
            }
            
            slides.current_index = slide_index;
            slides.current.$item.removeClass('active');
            slides.prev = slides.current;
            slides.current = slides.by_position[slide_index];
            slides.current.$item.addClass('active');
            
            toggleProducts();
            
            $elems.images_wrapper.css({
                left: slides.by_position[slide_index].left
            });
        };
        
        var setupSliderWidth = function () {
            var offset_left;
            
            if (settings.full_width !== true) {
                return false;
            }
            
            offset_left = $elems.parent.offset().left * -1;
            $slider_wrapper.css({
                left: offset_left,
                width: $(window).width()
            });
        };
        
        var onResize = function () {
            setupSliderWidth();
            setupItemsSize();
            setupItemPositions();
            
            goto(slides.current_index);
        };
        
        var setup = function () {
            setupSliderWidth();
            createRewindSlide();
            setupItems();
            setupItemPositions();
            
            goto(getStartImage());
            
            setupNav();
            
            $(window).on('resize', onResize);
        };
        
        return {
            setup: setup
        };
    }());
    
    var checkIntegrity = function () {
        var keys = Object.keys($elems);
        var valid = true;
        
        keys.forEach(function (key) {
            if (!$elems[key] || $elems[key].length !== 1) {
                valid = false;
            }
        });
        
        return valid;
    };
    
    var loadOptions = function () {
        var keys = Object.keys(settings);
        var options_container = PRODUCTLOOKBOOKS_OPTIONS;
        
        keys.forEach(function (key) {
            if (options_container[key] === undefined) {
                return false;
            }
            settings[key] = options_container[key];
        });
    };
    
    var init = function () {
        if (!checkIntegrity()) {
            return false;
        }
        setupVendorPrefixes();
        loadOptions();
        slider.setup();
    };
    init();
});