$(document).ready(function(){
//        $('.aval-colors2').owlCarousel({
//            loop: true,
//            margin:5,
//            dots:false,
//            nav:true,
//            autoWidth:0,
//            items: 3,
//            autoplay:true,
//            autoplayTimeout:2000,
//            navText:['',''],
//            fallbackEasing:''
//        });
//        if($('.jcarousel ul li a img').is(':visible')){
//            $('#product-gallery').jcarousel({
//                vertical: true,
//                wrap: 'circular'
//            }).jcarouselAutoscroll({
//                interval: 3000,
//                target: '+=1',
//                autostart: true
//            });
//        }
//
//        $('.recommended-slider').owlCarousel({
//            loop: true,
//            margin:5,
//            dots:false,
//            nav:true,
//            autoWidth:0,
//            items: 1,
//            autoplay:true,
//            autoplayTimeout:1000,
//            navText:['',''],
//            fallbackEasing:'',
//            responsive:{
//                0:{
//                    items:3
//                },
//                550:{
//                    items:4
//                },
//                1200:{
//                    items:5
//                }
//            }
//        });
    if($('.prod-slide-prev').length>0){
        $('.prod-slide-prev')
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .jcarouselControl({
                target: '-=1'
            });
    }

    if($('.prod-slide-next').length>0) {
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
        margin:0,
        dots:false,
        nav:true,
        autoWidth:0,
        items: 1,
        autoplay:true,
        autoplayTimeout:5000,
        navText:['',''],
        fallbackEasing:''
    });

});