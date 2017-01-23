/* 
 * Script active call
 * @author_url https://github.com/sabujdas94
 * @package Cot_Multipurpose_Wp_theme
 */

jQuery(document).ready(function ($) {

    /*====================================
     Page a Link Smooth Scrolling 
     ======================================*/

    $('body').smoothScroll({
        delegateSelector: 'a.scroll-button'
    });

    $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,

        fixedContentPos: false
    });

    new WOW().init();

    /*=========================================
     Isotope
     ==========================================*/
    var $container = $('.portfolio-grid');
    $('.portfolio-filter a').on('click', function () {
        $('.portfolio-filter .current').removeClass('current');
        $(this).addClass('current');

        var selector = $(this).attr('data-filter');

        $container.isotope({
            filter: selector,
            animationOptions: {
                duration: 750,
                easing: 'linear',
                queue: false
            }
        });
        return false;
    });

    /*============================================
     * Owl Carosul
     ============================================*/
    $(document).ready(function () {
        $(".owl-carousel").owlCarousel({
            margin: 10,
            loop: true,
            autoWidth: true,
            items: 4,
            center: true
        });
    });

});


