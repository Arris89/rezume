"use strict";
$(function() {
    var e = $(".main-header__btn");
    e.length && e.on("click", function(e) {
        var n = $(e.currentTarget);
        if (n.hasClass("main-header__btn_catalog")) {
            e.preventDefault();
            var t = n.next(".catalog-area__list");
            $(t).slideToggle(200)
        }
    });
    var n, t = $(".catalog-area__link_submenu");
    t.length && t.on("click", function(e) {
        var n = $(e.currentTarget);
        if ($(".catalog-area").find(".main-header__btn_catalog").length) {
            e.preventDefault();
            var t = n.next(".catalog-area__list_inner");
            n.toggleClass("catalog-area__link_active"), $(t).slideToggle(200)
        }
    }), $(window).on("resize", function() {
        clearTimeout(n), n = setTimeout(function() {
            $(window).trigger("resizeDone")
        }, 250)
    });
    var a = function() {
        var e = $(".main-header__btn"),
            n = $(window).width();
        n < 1153 && !e.hasClass("main-header__btn_catalog") ? e.addClass("main-header__btn_catalog") : 1153 <= n && e.hasClass("main-header__btn_catalog") && (e.removeClass("main-header__btn_catalog"), $(".catalog-area__list").removeAttr("style"))
    };
    a(), $(window).on("resizeDone", a)
}), $(function() {
    var e = $(".sorting-area__select"),
        n = $(".view-controls__select");
    e.length && e.SumoSelect(), n.length && n.SumoSelect();
    var t = $(".display__label");
    t.length && t.on("click", function(e) {
        var n = $(e.currentTarget);
        n.hasClass("display__label_active") || (n.siblings().removeClass("display__label_active"), n.addClass("display__label_active"))
    });
    var a = $(".filters__toggle");
    a.length && a.on("click", function(e) {
        e.preventDefault(), a.toggleClass("filters__toggle_opened"), a.next(".filters__inner").slideToggle(200)
    });
    var i = $(".filter__toggle");
    i.length && i.on("click", function(e) {
        var n = $(e.currentTarget),
            t = n.parent(),
            a = n.siblings();
        t.toggleClass("filter_opened"), a.slideToggle(200)
    })
}), $(function() {
    var e, n;
    if (e = window.navigator.userAgent, 0 < (0 < (n = e.indexOf("MSIE")) ? parseInt(e.substring(n + 5, e.indexOf(".", n))) : navigator.userAgent.match(/Trident\/7\./) ? 11 : void 0)) {
        var t = "js/plugins/svgxuse/svgxuse.min.js",
            a = function(e) {
                $("<script>", {
                    src: e
                }).appendTo(document.body)
            };
        a("js/plugins/ofi/ofi.min.js"), a(t), setTimeout(function() {
            objectFitImages()
        }, 1e3)
    }
}), $(function() {
    $(".faq__item").length && $(".faq__name").on("click", function(e) {
        e.preventDefault();
        var n = $(e.currentTarget),
            t = n.next(".faq__inner");
        n.toggleClass("faq__name_opened"), t.slideToggle(200)
    })
}), $(function() {
    var e = $(".contact-form");
    $.validator.methods.email = function(e, n) {
        return this.optional(n) || /[a-z]+@[a-z]+\.[a-z]+/.test(e)
    };
    var n = {
        rules: {
            "user-name": {
                required: !0,
                minlength: 2
            },
            "user-email": {
                required: !0,
                email: !0
            },
            "user-tel": {
                required: !0,
                minlength: 10
            }
        },
        messages: {
            "user-email": "Введите корректный email",
            "user-tel": {
                required: "Введите телефон",
                minlength: "Телефон должен содержать минимум 10 цифр"
            }
        }
    };
    e.length && e.each(function() {
        $(this).validate(n)
    });
    $('input[type="submit"]').on("click", function(e) {
        e.preventDefault(),
            function(e) {
                if (e.valid()) {
                    var n = $(e).find('[name="user-name"]').val() || "none",
                        t = $(e).find('[name="user-email"]').val() || "none",
                        a = $(e).find('[name="user-tel"]').val();
                    $.ajax({
                        type: "POST",
                        url: "https://example.com",
                        async: !0,
                        dataType: "json",
                        data: {
                            name: n,
                            email: t,
                            phone: a
                        }
                    }).done(function(e) {
                        console.log(e)
                    }).fail(function(e) {
                        console.log(e)
                    }).always(function() {
                        $(e).hasClass("popup__form") && $(e).closest(".popup__item").fadeOut(200), $(".popup").fadeIn(200), "get-call-form" === $(e).attr("name") && $(".popup__item_call-success").fadeIn(200), "get-price-form" === $(e).attr("name") && $(".popup__item_price-success").fadeIn(200)
                    })
                }
            }($(this).closest("form"))
    })
}), $(function() {
    var e = $(".item-thumb");
    e && e.hover(function() {
        $(this).closest(".slider").find(".slider__pagination").css({
            "z-index": "-1"
        })
    }, function() {
        $(this).closest(".slider").find(".slider__pagination").css({
            "z-index": "0"
        })
    })
}), $(function() {
    var i = $("#map");
    if (i.length) {
        ymaps.ready(function() {
            var a, e = {
                    x: i.data("x"),
                    y: i.data("y")
                },
                n = new ymaps.Map("map", {
                    center: [e.x, e.y],
                    zoom: 5,
                    controls: []
                });
            if (i.hasClass("map__content_partners")) {
                var t = i.find(".map__pin");
                t.length && (a = n, t.each(function(e, n) {
                    var t = {
                        x: $(n).data("x"),
                        y: $(n).data("y")
                    };
                    a.geoObjects.add(new ymaps.Placemark([t.x, t.y], {}, {
                        preset: "islands#redStarIcon"
                    }))
                }))
            }
            i.hasClass("map__content_main") && (n.setZoom(16), n.geoObjects.add(new ymaps.Placemark([e.x, e.y], {}, {
                preset: "islands#redHomeIcon"
            })))
        })
    }
}), $(function() {
    var e = $(".main-header__navigation-area");
    if (e.length) {
        var n = e.find(".main-header__navigation"),
            t = e.find(".main-header__menu-btn");
        t.on("click", function(e) {
            e.preventDefault(), n.slideToggle(200), t.toggleClass("main-header__menu-btn_active")
        })
    }
}), $(function() {
    var n = $(".popup");
    if (n.length) {
        var e = $(".popup__close-btn");
        e.length && e.on("click", function(e) {
            e.preventDefault(), $(e.currentTarget).closest(".popup__item").fadeOut(200), n.fadeOut(200)
        });
        var t = n.find(".popup__item_call");
        if (t.length) {
            var a = $(".btn_get-call");
            a.length && a.on("click", function(e) {
                e.preventDefault(), n.fadeIn(200), t.fadeIn(200)
            })
        }
        var i = n.find(".popup__item_price");
        if (i.length) {
            var s = $(".btn_get-price");
            s.length && s.on("click", function(e) {
                e.preventDefault(), n.fadeIn(200), i.fadeIn(200)
            })
        }
    }
}), $(function() {
    var e = $(".custom-scrollbar");
    e.length && e.overlayScrollbars({
        className: "os-theme-green"
    })
}), $(function() {
    var e = function(e, n, t) {
            var a = n.find(".slider__list"),
                i = n.find(".slider__pagination");
            i.length && (e.appendDots = i), t && (e.arrows = !0, e.prevArrow = n.find(".slider__btn_prev"), e.nextArrow = n.find(".slider__btn_next"), e.responsive = [{
                breakpoint: 1170,
                settings: {
                    arrows: !1
                }
            }]), a.slick(e)
        },
        n = $(".promo.slider");
    n.length && e({
        dots: !0,
        adaptiveHeight: !0
    }, n, !0);
    var t = {
            dots: !0,
            arrows: !1,
            slidesToShow: 5,
            swipeToSlide: !0,
            centerMode: !0,
            centerPadding: "15px",
            responsive: [{
                breakpoint: 1170,
                settings: {
                    slidesToShow: 3,
                    centerMode: !1
                }
            }, {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    centerMode: !1
                }
            }]
        },
        a = $(".doors_rooms .doors__content_new.slider"),
        i = $(".doors_rooms .doors__content_hits.slider");
    a.length && e(t, a, !1), i.length && e(t, i, !1);
    var s = $(".doors_main .doors__content_new.slider"),
        o = $(".doors_main .doors__content_hits.slider");
    s.length && e(t, s, !1), o.length && e(t, o, !1);
    var r = $(".doors.doors_similar");
    r.length && e(t, r, !1);
    var l = $(".reviews__slider.slider");
    l.length && e({
        infinite: !1,
        dots: !0,
        arrows: !1,
        slidesToShow: 2,
        swipeToSlide: !0,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 1
            }
        }]
    }, l, !1);
    var _ = $(".item-content__img-area.slider");
    _.length && e({
        infinite: !1,
        dots: !0,
        arrows: !1,
        slidesToShow: 1,
        slidesToScroll: 1,
        customPaging: function(e, n) {
            return '<button type="button"><img class="slider__img" src="'.concat(n, '.jpg" alt=""></button>')
        }
    }, _, !1)
}), $(function() {
    var e = function(e) {
        $(e).find(".tabs__item").on("click", function(e) {
            var n = e.currentTarget,
                t = $(n).parent().siblings(".doors__content_new"),
                a = $(n).parent().siblings(".doors__content_hits");
            $(n).hasClass("tabs__item_active") || ($(n).siblings().removeClass("tabs__item_active"), $(n).addClass("tabs__item_active")), $(n).hasClass("tabs__item_new") ? (t.show(), t.find(".slider__list").slick("refresh"), a.hide()) : $(n).hasClass("tabs__item_hits") && (t.hide(), a.show(), a.find(".slider__list").slick("refresh"))
        })
    };
    e(".doors_rooms"), e(".doors_main")
});