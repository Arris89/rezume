(function ($, app) {

    $(function () {
        app.initMask();
        app.initPopup();
        app.initMagnific();
        app.initMap();
        app.initConfigurator();
        app.initMenu();

        // categories

        $('.category').magnificPopup({
            delegate: 'a',
            type: 'image',
            closeOnContentClick: false,
            closeBtnInside: false,
            mainClass: 'mfp-with-zoom mfp-img-mobile',
            image: {
                verticalFit: true
            },
            gallery: {
                enabled: true
            },
            zoom: {
                enabled: true,
                duration: 300, // don't foget to change the duration also in CSS
                opener: function(element) {
                    return element.find('img');
                }
            },
            callbacks: {
                open: function(e) {
                    $('html').css('height', 'auto');
                },
                close: function() {
                    $('html').css('height', '100%');
                }
            }
        });

        $('body').on('click', '.js-toggle-panel', function() {
            if ($(window).width() < 768) {
                $('.panel-personal__block').slideToggle(300);
            }
        });

        $('body').on('click', '.js-order-filter', function() {
            $(this).closest('.r-order').addClass('active');
        });

        $('body').on('click', '.js-order-filter-close', function() {
            $(this).closest('.r-order').removeClass('active');
        });

        $('body').on('click', '.js-close-window', function() {
            $(this).closest('.window').fadeOut(300);
        });

        $('body').on('click', '.js-close-p-window', function() {
            $(this).closest('.p-window').fadeOut(0);
        });

        $('body').on('mouseover', '.window-holder', function() {
            $(this).find('.p-window').css('display', '');
        });

        $('body').on('click', '.js-show-cities, .js-city-change', function() {
            $('.section-header__cities').slideToggle(300);
        });

        $('body').on('click', '.js-pick-city', function(e) {
            e.preventDefault();
            $('.your-city').addClass('accepted');
            $('.section-header__cities').slideUp(300);
            $('.your-city__value').html($(this).text());
        });

        $('body').on('click', '.js-city-accept', function() {
            $(this).closest('.your-city').addClass('accepted');
        });

        $('body').on('change', '.js-scroll-select', function() {
            if ($(window).width() < 768) {
                 $('html, body').animate({
                    scrollTop: $('.config-main').offset().top - 95
                }, 'slow');
            }
        });

        // kit-number
        $('body').on('click', '.kit-number__btn', function() {
            let prefix = $(this).closest('.kit-number').hasClass('kit-number_str') ? ' шт.' : '';
            let value = parseInt($(this).closest('.kit-number').find('.kit-number__value').html());
            if ($(this).hasClass('kit-number__btn_plus')) {
                $(this).closest('.kit-number').find('.kit-number__value').html((value + 1) + prefix);
            } else if (value > 1) {
                $(this).closest('.kit-number').find('.kit-number__value').html((value - 1) + prefix);
            }
        });

        $('select:not(.basic)').selectric({
            onInit: function(e, config) {
            },
            /*
             * Перехватывает любое другое событие сhange()
             * на изменение select
             * Пример: сhange() фильтра
             *
             * Исправить!
             */
            // onChange: function(select) {
            //     console.log('change')
            //     const elem = $(select);
            //     if (elem.hasClass('changer')) {
            //         const target = $(elem.data('target'));
            //         target.val(elem.val()).selectric('refresh');
            //     }
            //     checkFirstOption($(this));
            // },
            onRefresh: function() {
                checkFirstOption($(this));
            }
        });

        // Initialize Selectric and bind to 'change' event
        $('select:not(.config-panel select)').selectric().on('change', function() {
            const elem = $(this);
            console.log('trigger', elem.hasClass('changer'), $(this), $(this).val())
            if (elem.hasClass('changer')) {
                console.log('refresh')
                const target = $(elem.data('target'));
                target.val(elem.val()).selectric('refresh');
            }
            checkFirstOption($(this));
        });

        function checkFirstOption(elem) {
            const currentValue = elem.val();
            const option = elem.find('option:first-child');
            const wrapper = elem.closest('.selectric-wrapper');
            console.log(elem, wrapper, currentValue , option.attr('value'))

            if (currentValue === option.attr('value')) {
                console.log('replace')
                console.log(wrapper)
                wrapper.find('span.label').text(option.data('value'));
            }
        }

        $('body').on('click', '.js-call-window', function() {
            const data = $(this).data('target');
            $('.air-select').fadeOut(0);
            $('.config-panel').removeClass('config-panel_frames config-panel_mechanisms');
            $('.config-panel').addClass('config-panel_' + data);
            if (data.includes('frame')) {
                $('.air-select_frame').fadeIn(300);
            }
            if (data.includes('mechanism')) {
                $('.air-select_mechanism').fadeIn(300);
            }
        });

        $('body').on('click', '.js-close-panel', function() {
            $('.config-panel').removeClass('config-panel_frames config-panel_mechanisms');
            $('.air-select').fadeOut(0);
        });

        // lazyload

        var instance = $('img.lazy:visible').lazy({
            chainable: false,
            beforeLoad: function(element) {
                // console.log('before load')
            },
            afterLoad: function(element) {
                $(element).closest('.config-frame__item').addClass('loaded')
            },
        });

        instance.update();

        $('.simplebar-content-wrapper').on('scroll', function() {
            const scrollTop = $(this).scrollTop();
            const scrollHeight = $(this)[0].scrollHeight;
            if (scrollTop > scrollHeight - 480 - 40) {
                const index = $(this).find('.loaded').length - 1;
                for (let i = 0; i < 3; i++) {
                    $(this).find('.config-frame__item').eq(index).nextAll().eq(i).css('display', 'flex');
                }
            }
            $('img.lazy:visible').lazy({
                chainable: false,
                afterLoad: function(element) {
                    $(element).closest('.config-frame__item').addClass('loaded')
                },
            });
            instance.update();
        });

        // детали в корзине
        $('body').on('click', '.js-toggle-composition', function(e) {
            e.preventDefault();
            const parent = $(this).closest('.kit-good-block');
            const details = parent.find('.kit-good-block__details');
            if (!parent.hasClass('active')) {
                details.slideDown(300);
                parent.addClass('active');
                $(this).text('Скрыть состав')
            } else {
                details.slideUp(300);
                parent.removeClass('active');
                $(this).text('Посмотреть состав');
            }
        })

    });

})(jQuery, window.app);

