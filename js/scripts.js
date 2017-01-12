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

});


