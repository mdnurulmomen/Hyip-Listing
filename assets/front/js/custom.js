$(function ($) {
    "use strict"

    // Offset start 
    var html_body = $('html, body'),
        nav = $('nav'),
        navOffset = nav.offset().top,
        $window = $(window);


    // scroll top
    $('.headerTop a').on('click', function () {
        var sectionTo = $(this).attr('href');
        $('html, body').animate({
            scrollTop: $(sectionTo).offset().top
        }, 1500);
    });


    //    bottom to top js start

    $window.on('scroll', function () {

        var $scrollTopSelector = $('.totop');
        if ($(this).scrollTop() > 550) {
            $scrollTopSelector.fadeIn();
        } else {
            $scrollTopSelector.fadeOut();
        };

        var scrollPos = $window.scrollTop();

        if (scrollPos > navOffset) {
            $('#header').addClass('navbar-fixed');
            $('#topbar_area').addClass('d-none');
        } else {
            $('#header').removeClass('navbar-fixed');
            $('#topbar_area').removeClass('d-none');
        }
    });
    $('.totop a').on('click', function () {
        html_body.animate({
            scrollTop: 0
        }, 600);
        return false;
    });


    // top slider

    $('.topSlider').owlCarousel({
        loop: true,
        margin: 20,
        nav: true,
        dots: false,
        animateOut: 'slideOutRight',
        animateIn: 'slideInLeft',
        smartSpeed: 450,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    })

    // veno box light box plugin
    $('.venobox').venobox();



    jQuery(window).on('load', function () {

        /*---------------------------------------------------
            Site Preloader
        ----------------------------------------------------*/
        var $sitePreloaderSelector = $('.site-preloader');
        $sitePreloaderSelector.fadeOut(500);
        $('.totop').hide();

    });



});






// Project     :  REXHYIP - HYIP Monitor & Listing HTML Template
// Version     :   1.0
// Author              : Thesoftking
// Front-end developer : Mamunur Rashid