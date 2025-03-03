/**
 * Design template specific JavaScript
 */
jQuery(document).ready(function($) {
    // Fade in design boxes
    $('.design-line-boxed').each(function(index) {
        $(this).delay(100 * index).animate({opacity: 1}, 500);
    });
    
    // Handle any design page specific functionality
});