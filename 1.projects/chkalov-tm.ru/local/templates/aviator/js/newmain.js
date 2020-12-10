$(document).ready(function () {

// Слайдер рекомендуемых товаров
    $(".product-cards-slider").slick({
        slidesToShow: 6,
        slidesToScroll: 2,
        infinite: true,
        arrows: false,
        /*autoplay: true,*/
        autoplaySpeed: 3000,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3

                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });


    $(".btn a").click(function (e) {
        e.preventDefault();
    });

    $(".delete a").click(function (e) {
        e.preventDefault();
    });


    /*****menu sidebar******/

    $(".header .top").sticky({topSpacing: 0});
    /***/
    $('.filter-title').click(function () {
        $('.filter-mobile').slideToggle();
        $('.catalog-actions').slideUp();
        $(this).toggleClass('active');
        $('.sort-title').removeClass('active');
        return false;
    });
    $('.sort-title').click(function () {
        $('.catalog-actions').slideToggle();
        $('.catalog-actions').insertBefore('.catalog-right .title');
        $('.filter-mobile').slideUp();
        $(this).toggleClass('active');
        $('.filter-title').removeClass('active');
        return false;
    });

    $(".btn_mobile-menu").click(() = > {
        $('.sb-slidebar'
    ).
    toggleClass('myShowHide');
    $(".btn_mobile-menu").toggleClass('myleft');
})
    ;

    $("#mailer-subscribe-form a").on("click", function (event) {
        $("#mailer-subscribe-form").submit();
        event.preventDefault();
    });


    window.onload = function () {
        $("#tabs").tabs({active: 0});
    };

    $(".login").on("click", function (e) {
        $(".fade-screen").first().show();
        $(".popup.enter").show();


    });

    $("#orbasket").on("click", function (e) {
        $(".fade-screen").first().show();
        $(".popup.enter").show();


    });

    $(".leftfavnot").on("click", function (e) {
        $(".fade-screen").first().show();
        $(".popup.enter").show();


    });


    $(".shop_favorites_not").on("click", function (e) {
        $(".fade-screen").first().show();
        $(".popup.enter").show();


    });

    $("#signup").on("click", function (e) {
        if (location.pathname != '/signup/') {
            $(".fade-screen").first().show();
            $(".popup.registration").show();
            e.preventDefault();

        }
    });

    $("#loginreload").on("click", function () {
        $(".popup.enter").hide();
        $(".fade-screen").first().show();
        $(".popup.registration").show();

    });


    $('#oldcust').on('click', function (e) {
        $(".fade-screen").first().show();
        $(".popup.enter").show();

    });


    $(".popup.sizes .close").on("click", function (e) {
        $(".fade-screen").hide();
        $(".popup.sizes").hide();
        e.preventDefault();
    });
    $(".popup.town .town-list input").on("click", function () {
        $(this).attr("checked", true);
        $(this).siblings().attr("checked", false);
    });


    $(".popup-close").on("click", function (e) {
        $(".fade-screen").hide();
        $(".popup").hide();
        $(".popup-size").hide();
        if ($(this).data('user-type-enter') === 1) {
            $(this).removeAttr('data');
            $('#new_user').prettyCheckable('check');
            $('#old_user').removeAttr('uncheck');
        }

        e.preventDefault();
    });


    $(".popup-close").on("click", function (e) {
        $(".fade-screen").hide();
        $(".spopup").hide();
        $(".popup-size").hide();
        if ($(this).data('user-type-enter') === 1) {
            $(this).removeAttr('data');
            $('#new_user').prettyCheckable('check');
            $('#old_user').removeAttr('uncheck');
        }
        e.preventDefault();
    });


    $("#product-gallery a").click(function () {
        $("#product-gallery a").removeClass("selected");
        $(this).addClass("selected");

    });
    function trigSubmit(elem) {
        elem.next().trigger('click');
        return false;
    }

    if (jQuery(window).width() > 1200) {
        /* *** tabs *** */
        $('ul.tabs-menu').each(function () {
            $(this).on('click', 'li:not(.active)', function () {
                $(this).addClass('active').siblings().removeClass('active')
                    .parents('div.tab-block').find('div.tab-item').eq($(this).index()).fadeIn(200).siblings('div.tab-item').hide();
            });
        });
        /***/
    } else {
        /* *** accordion *** */
        //Add Inactive Class To All Accordion Headers
        $('.accordion-header').toggleClass('inactive-header');


        //Set The Accordion Content Width
        var contentwidth = $('.accordion-header').width();
        $('.accordion-content').css({'width': contentwidth});

        //Open The First Accordion Section When Page Loads
        $('.accordion-header').first().toggleClass('active-header').toggleClass('inactive-header');
        $('.accordion-content').first().slideDown().toggleClass('open-content');

        // The Accordion Effect
        $('.accordion-header').click(function () {
            if ($(this).is('.inactive-header')) {
                $('.active-header').toggleClass('active-header').toggleClass('inactive-header').next().slideToggle().toggleClass('open-content');
                $(this).toggleClass('active-header').toggleClass('inactive-header');
                $(this).next().slideToggle().toggleClass('open-content');
            } else {
                $(this).toggleClass('active-header').toggleClass('inactive-header');
                $(this).next().slideToggle().toggleClass('open-content');
            }
        });
        /*return false;*/
        /***/
    }
    ;


});

$(document).on('click', '#buy-in-click-button', function () {
    console.log($('[name="features[13]"]').val());
    $('.fade-screen').fadeIn();
    $('#buy-in-click-modal').fadeIn();
    return false;
});


/*таблица размеров*/
$(document).on('click', '#buy-in-click-button1', function () {
    $('.fade-screen').fadeIn();
    $('#buy-in-click-modal1').fadeIn();
    return false;
});

/*Уведомить о появлении*/
$(document).on('click', '#buy-in-click-button4', function () {
    $('.fade-screen').fadeIn();
    $('#buy-in-click-modal4').fadeIn();
    return false;
});


/*добавить отзыв*/
$(document).on('click', '#buy-in-click-button2', function () {
    $('.fade-screen').fadeIn();
    $('#buy-in-click-modal2').fadeIn();
    return false;
});


/*уведомить о появлении*/
$(document).on('click', '#buy-in-click-button3', function () {
    $('.fade-screen').fadeIn();
    $('#buy-in-click-modal3').fadeIn();
    return false;
});


/*выбор города*/
$(document).on('click', '#buy-in-click-city', function () {
    $('.fade-screen').fadeIn();
    $('#buy-in-click-city-modal').fadeIn();
    return false;
});


$(document).on('click', '.js-catclose', function () {
    var that = $(this);
    var list = that.next();
    var img = that.find('img');
    list.slideToggle(400, function () {
        that.toggleClass('open');
        if (that.hasClass('open')) {
            img.attr('src', '/local/templates/aviator/images/prod-slide-prev.png');
        } else {
            img.attr('src', '/local/templates/aviator/images/prod-slide-next.png');
        }
    });
});

function initContactCapcha() {
    if ($('#contact-capcha').length > 0) {
        // $('#contact-capcha').find('.g-recaptcha').remove();
        $('#contact-capcha').html('');
        grecaptcha.render(document.getElementById('contact-capcha'), {
            'sitekey': '6LeqcggUAAAAAOt4dWejkbSV8XPDjqTCWlGxspqj'
        });
    }
}

$(document).on('click', '#contact-form-submit', function () {
    var bt = $(this);
    var form = bt.parents('form');
    var data = form.serialize();
    if (!$('#personal-order').is(':checked')) {
        var err = "<em class='wa-error-msg'>Необходимо принять условия обработки персональных данных</em>";
        $(err).insertAfter(form.find('textarea'));
        setTimeout(function () {
            form.find('.wa-error-msg').remove();
        }, 2000);
        return false;
    }
    $.post(window.location.href, data, function (resp) {
        var tmp = $('<div></div>').html(resp);
        var html = tmp.find('.contacts-right').html();
        $('.contacts-right').html(html);
        initContactCapcha();
        $('.contacts-right').find('#personal-order').prettyCheckable();
        if ($('.contacts-right').find('input').length <= 0) {
            yaCounter33198788.reachGoal('formcont');
        }
    });
    return false;
});
$(document).on('click', '#callback-button', function () {
    $('.fade-screen').fadeIn();
    $('#callback-modal').fadeIn();
    return false;
});
$('form[action="/signup/"]').submit(function () {
    var that = $(this);
    var accept = $(this).find('[name="personaAccept"]');
    if (accept.length > 0 && !accept.is(':checked')) {
        var err = "<em class='wa-error-msg personal'>Необходимо принять условия обработки персональных данных</em>";
        $(err).insertAfter(accept.parent());
        setTimeout(function () {
            that.find('.wa-error-msg').remove();
        }, 2000);
        return false;
    }

});

if ($("#personal-bic").length) {
    $("#personal-bic").prettyCheckable();
}


/////     FAVOURITE     /////
function add2favourite(p_id, pp_id, p, name, dpu, th) {
    $.ajax({
        type: "POST",
        url: "/local/ajax/favourite.php",
        data: "p_id=" + p_id + "&pp_id=" + pp_id + "&p=" + p + "&name=" + name + "&dpu=" + dpu,
        success: function (html) {
            $(th).addClass('in_favouritelist');
            $('#favourite-count').html(html);
        }
    });
}
;

/*  Слайдер в карточке товара */

$(document).ready(function () {
    $('.aval-colors2').owlCarousel({
        loop: true,
        margin: 5,
        dots: false,
        nav: true,
        autoWidth: 0,
        items: 3,
        autoplay: true,
        autoplayTimeout: 2000,
        navText: ['', ''],
        fallbackEasing: ''
    });
    if ($('.jcarousel ul li a img').is(':visible')) {
        $('#product-gallery').jcarousel({
            vertical: true,
            wrap: 'circular'
        }).jcarouselAutoscroll({
            interval: 3000,
            target: '+=1',
            autostart: true
        });
    }

    $('.recommended-slider').owlCarousel({
        loop: true,
        margin: 5,
        dots: false,
        nav: true,
        autoWidth: 0,
        items: 1,
        autoplay: true,
        autoplayTimeout: 1000,
        navText: ['', ''],
        fallbackEasing: '',
        responsive: {
            0: {
                items: 3
            },
            550: {
                items: 4
            },
            1200: {
                items: 5
            }
        }
    });
    if ($('.prod-slide-prev').length > 0) {
        $('.prod-slide-prev')
            .on('jcarouselcontrol:active', function () {
                $(this).removeClass('inactive');
            })
            .on('jcarouselcontrol:inactive', function () {
                $(this).addClass('inactive');
            })
            .jcarouselControl({
                target: '-=1'
            });
    }

    if ($('.prod-slide-next').length > 0) {
        $('.prod-slide-next')
            .on('jcarouselcontrol:active', function () {
                $(this).removeClass('inactive');
            })
            .on('jcarouselcontrol:inactive', function () {
                $(this).addClass('inactive');
            })
            .jcarouselControl({
                target: '+=1'
            });
    }
    $('.main-top-offer:not(.not-owl)').owlCarousel({
        loop: true,
        margin: 0,
        dots: false,
        nav: true,
        autoWidth: 0,
        items: 1,
        autoplay: true,
        autoplayTimeout: 5000,
        navText: ['', ''],
        fallbackEasing: ''
    });

});