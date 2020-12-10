$(document).ready(function () {

    var min_width = 992;
    $(window).on('resize', function () {
        var new_width = $(window).width();
        if (new_width <= min_width) {
            $(".menu>ul>li>a").click(function (e) {
                e.preventDefault();
                $(".menu>ul>li>ul").removeClass('manu_active');
                $(this).parent().find("ul").addClass('manu_active');
            });
        }
    }).trigger('resize');

    $(function ($) {
        $(document).mouseup(function (e) {
            var div = $(".menu>ul>li>ul");
            if (!div.is(e.target) &&
                div.has(e.target).length === 0) {
                div.removeClass('manu_active');
            }
        });
    });

    $('.header__burger--js').click(function (e) {
        e.preventDefault();
        $('body').toggleClass('body__active');
        $('.header__menu').toggleClass('header__menu_active');
    });
    $('.header__menu-close--js').click(function (e) {
        e.preventDefault();
        $('body').toggleClass('body__active');
        $('.header__menu').toggleClass('header__menu_active');
    });

    var idIntervals = 0;

    function timer() {
        if ($('.promo__left').hasClass('promo__active')) {
            $(".promo__left").removeClass('promo__active').addClass('promo__min');
            $(".promo__right").removeClass('promo__min').addClass('promo__active');
        } else if ($('.promo__left').hasClass('promo__min')) {
            $(".promo__left").removeClass('promo__min').addClass('promo__active');
            $(".promo__right").removeClass('promo__active').addClass('promo__min');
        }
    }

    idIntervals = setInterval(function () {
        timer();
    }, 5000);

    // Animation block - left
    if ($(".promo__items_left").length > 0) {
        $(".promo__items_left").click(function () {
            clearInterval(idIntervals);
            idIntervals = setInterval(function () {
                timer();
            }, 5000);
            $(".promo__right").removeClass('promo__active');
            $(".promo__left").removeClass('promo__min');
            $(".promo__right").addClass('promo__min');
            $(".promo__left").addClass('promo__active');
        });
    }
    // Animation block - right
    if ($(".promo__items_right").length > 0) {
        $(".promo__items_right").click(function () {
            clearInterval(idIntervals);
            idIntervals = setInterval(function () {
                timer();
            }, 5000);
            $(".promo__left").removeClass('promo__active');
            $(".promo__right").removeClass('promo__min');
            $(".promo__right").addClass('promo__active');
            $(".promo__left").addClass('promo__min');
        });
    }

    // Page text - visible
    if ($(".btn-callback").length > 0) {
        $(".page-services__link").click(function () {
            $(this).addClass('page-services__link_active');
            $(".page-services__hidden").addClass('page-services__hidden_active');
        });
    }

    // Maintovar slider
    if ($(".mainslider__slick").length > 0) {
        $('.mainslider__slick').slick({
            dots: false,
            arrows: false,
            speed: 300,
            adaptiveHeight: true,
            slidesToShow: 6,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1600,
                    settings: {
                        slidesToShow: 5,
                    }
                },
                {
                    breakpoint: 1400,
                    settings: {
                        slidesToShow: 4,
                    }
                },
                {
                    breakpoint: 1100,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });
        $('.slick__arrow.slick__arrow_left').click(function (event) {
            $(this).parents('.mainslider__row').find('.mainslider__slick').slick('slickPrev');
        });
        $('.slick__arrow.slick__arrow_right').click(function (event) {
            $(this).parents('.mainslider__row').find('.mainslider__slick').slick('slickNext');
        });
    }

    // Maintovar slider
    if ($(".about__slick").length > 0) {
        $('.about__slick').slick({
            dots: false,
            arrows: false,
            speed: 300,
            adaptiveHeight: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1240,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                    }
                }
            ]
        });
        $('.slick__arrow.slick__arrow_left').click(function (event) {
            $(this).parents('.about__content').find('.about__slick').slick('slickPrev');
        });
        $('.slick__arrow.slick__arrow_right').click(function (event) {
            $(this).parents('.about__content').find('.about__slick').slick('slickNext');
        });
    }

    // Offers slider
    if ($(".offers__slick").length > 0) {
        $('.offers__slick').slick({
            dots: false,
            arrows: false,
            speed: 300,
            adaptiveHeight: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1440,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 1050,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 700,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });
        $('.box__arrow.box__arrow_left').click(function (event) {
            $(this).parents('.offers__row').find('.offers__slick').slick('slickPrev');
        });
        $('.box__arrow.box__arrow_right').click(function (event) {
            $(this).parents('.offers__row').find('.offers__slick').slick('slickNext');
        });
    }

    // Offers slider
    if ($(".offers-big__slick").length > 0) {
        $('.offers-big__slick').slick({
            dots: false,
            arrows: false,
            speed: 300,
            adaptiveHeight: true,
            slidesToShow: 2,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1100,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });
        $('.box__arrow.box__arrow_left').click(function (event) {
            $(this).parents('.offers__row').find('.offers-big__slick').slick('slickPrev');
        });
        $('.box__arrow.box__arrow_right').click(function (event) {
            $(this).parents('.offers__row').find('.offers-big__slick').slick('slickNext');
        });
    }

    // Modal window - callback
    if ($(".btn-callback").length > 0) {
        $(".btn-callback").click(function (e) {
            e.preventDefault();
            $('#modal-callback').arcticmodal({
                afterOpen: function () {
                    $('#modal-callback').find('[name="name"]').focus();
                }
            });
        });
    }

    // Modal window - special-equipment
    if ($(".btn-special").length > 0) {
        $(".btn-special").click(function (e) {
            e.preventDefault();
            $('#modal-special-equipment').arcticmodal({
                afterOpen: function () {
                    $('#modal-special-equipment').find('[name="name"]').focus();
                }
            });
        });
    }

    // Modal window - truck
    if ($(".btn-truck").length > 0) {
        $(".btn-truck").click(function (e) {
            e.preventDefault();
            $('#modal-truck').arcticmodal({
                afterOpen: function () {
                    $('#modal-truck').find('[name="name"]').focus();
                }
            });
        });
    }

    //PHONE MASK
    if ($(".phone-mask").length > 0) {
        $(".phone-mask").mask("+7 (999) 999 99 99", {autoclear: false});
        $('.phone-mask').focusout(function () {
            if ($(this).val() == '+7 (___) ___ __ __') {
                $(this).prev().removeClass('form__label_active');
            }
        });
    }

    // Animate top
    $(".footer__up--js, .footer__logo--js").click(function (event) {
        $('body,html').animate({scrollTop: 0}, 300);
    });

    // Custom select
    if ($(".js-example-responsive").length > 0) {
        $(function () {
            $('.js-example-responsive').select2();
        });
    }

    //NEST STEP SCRIPT
    if ($(".btn_mainform--js").length > 0) {
        $('.btn_mainform--js').click(function () {
            var step = $(this).data("next-step");
            $form = $('.mainform__container');
            var agreement = $form.find('[type="checkbox"]').prop('checked');
            if (agreement) {
                $(".mainform__block").removeClass("mainform__block_active");
                $(this).parent().parent().parent().parent().find(".mainform__coll").removeClass("mainform__coll_active");
                $('.mainform__block[data-id="' + step + '"]').addClass("mainform__block_active");
                $('.mainform__coll[data-tab="' + step + '"]').addClass("mainform__coll_active");
                if (step == 4) {
                    $(".mainform__top").addClass("mainform__top_active");
                }
                return false;
            } else {
                $form.find('.result').html('<span class="error">Нужно дать свое согласие на обработку персональных данных</span>');
                return false;
            }
        });
    }

    $(".field").focus(function () {
        $(this).prev().addClass('form__label_active');
    });
    $(".field").focusout(function () {
        if ($(this).val() == '') {
            $(this).prev().removeClass('form__label_active');
        }
    });
    $(".field_text").focus(function () {
        $(this).prev().addClass('form__label_active');
    });
    $(".field_text").focusout(function () {
        if ($(this).val() == '') {
            $(this).prev().removeClass('form__label_active');
        }
    });
    $(".form__label").click(function () {
        $(this).addClass('form__label_active');
        $(this).next().focus();
    });

    // block one 8
    $('[name="phone"]').keyup(function () {
        var val = $(this).val();
        if (val == '+7 (8__) ___ __ __') {
            $(this).unmask();
            $(this).mask('+7 (999) 999 99 99');
            $(this).focus();
        }
    });

    $('.btn-modal').click(function (e) {
        $forms = $(this).parent().parent().parent().find('.modal__form');
        var agreements = $forms.find('[type="checkbox"]').prop('checked');
        if (agreements) {
            $.arcticmodal('close');
            $('#modal-thanks').arcticmodal({});
        } else {
            e.preventDefault();
            $forms.find('.result').html('<span class="error">Нужно дать свое согласие на обработку персональных данных</span>');
        }
    });


    $('.btn_contacts').click(function (e) {
        $forms = $(this).parent().parent().find('.contacts__form-block');
        var agreements = $forms.find('[type="checkbox"]').prop('checked');
        if (agreements) {

        } else {
            e.preventDefault();
            $forms.find('.result').html('<span class="error">Нужно дать свое согласие на обработку персональных данных</span>');
        }

    });

    //ANIMATION
    hideObjects();
    checkObjectsVisibility();
    $(window).scroll(function () {
        hideObjects();
        checkObjectsVisibility();
    });
    function hideObjects() {
        $('.fadeInUp-scroll').css({
            'opacity': 0,
            'transform': 'translateY(100px)'
        });
    }

    function checkObjectsVisibility() {
        $('.fadeInUp-scroll').each(function (i) {
            var objectTop = $(this).offset().top;
            var windowBottom = $(window).scrollTop() + $(window).outerHeight();

            if (windowBottom > objectTop - 100) {
                $(this).addClass('visible');
            } else {
                $(this).removeClass('visible');
            }
        });
    }


//передаем данные в форму из списка товаров аренда
    $('body').on('click', '#ar_list', function () {
        var det = $(this).attr('value');
        alert(det);
        $('.formind').remove(); //чтобы при клике и открытии новой формы удалялись предыдушие невидимые теги, если они были
        $('.form__item').prepend('<input class="formind" name="arenda_tovar_list" style="display:none" value="' + det + '">'); // ставим невидимый тег передаваемый при отправке формы
    })

//передаем данные в форму из детальной карточки товара аренда
    $('body').on('click', '#ar_detail', function () {
        var det = $(this).attr('value');
        alert(det);
        $('.formind').remove(); //чтобы при клике и открытии новой формы удалялись предыдушие невидимые теги, если они были
        $('.form__item').prepend('<input class="formind" name="arenda_tovar_detail" style="display:none" value="' + det + '">'); // ставим невидимый тег передаваемый при отправке формы
    })

//передаем данные в форму блока "интересно" детальной аренда
    $('body').on('click', '#ar_interes', function () {
        var det = $(this).attr('value');
        alert(det);
        $('.formind').remove(); //чтобы при клике и открытии новой формы удалялись предыдушие невидимые теги, если они были
        $('.form__item').prepend('<input class="formind" name="arenda_tovar_interes" style="display:none" value="' + det + '">'); // ставим невидимый тег передаваемый при отправке формы
    })


//передаем данные в форму список раздела "Чем перевозим"
    $('body').on('click', '#perevoz_list', function () {
        var det = $(this).attr('value');
        alert(det);
        $('.formind').remove(); //чтобы при клике и открытии новой формы удалялись предыдушие невидимые теги, если они были
        $('.form__item').prepend('<input class="formind" name="perevoz_tovar_list" style="display:none" value="' + det + '">'); // ставим невидимый тег передаваемый при отправке формы
    })


//передаем данные в форму список раздела "Грузоперевозки"
    $('body').on('click', '#gruz_interes', function () {
        var det = $(this).attr('value');
        alert(det);
        $('.formind').remove(); //чтобы при клике и открытии новой формы удалялись предыдушие невидимые теги, если они были
        $('.form__item').prepend('<input class="formind" name="gruz_tovar_interes" style="display:none" value="' + det + '">'); // ставим невидимый тег передаваемый при отправке формы
    })


//передаем данные в форму список раздела "Грузоперевозки"
    $('body').on('click', '#chem_detail', function () {
        var det = $(this).attr('value');
        alert(det);
        $('.formind').remove(); //чтобы при клике и открытии новой формы удалялись предыдушие невидимые теги, если они были
        $('.form__item').prepend('<input class="formind" name="chem_tovar_detail" style="display:none" value="' + det + '">'); // ставим невидимый тег передаваемый при отправке формы
    })


    //MAP
    if ($("#map").length > 0) {
        ymaps.ready(function () {
            var myMap = new ymaps.Map('map', {
                    center: [56.032408, 92.879611],
                    zoom: 16
                }, {
                    searchControlProvider: 'yandex#search'
                }),

                myPlacemark = new ymaps.Placemark([56.032408, 92.879611], {
                    hintContent: 'ул. Линейная 89, оф. 304',
                    balloonContent: ''
                }, {
                    iconLayout: 'default#image',
                    iconImageHref: 'img/map.svg',
                    iconImageSize: [30, 42],
                    iconImageOffset: [-15, -42]
                });
            myMap.behaviors.disable('scrollZoom');
            myMap.geoObjects
                .add(myPlacemark);
        });
    }

});



