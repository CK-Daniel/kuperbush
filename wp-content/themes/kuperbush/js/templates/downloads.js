/**
 * Downloads template specific JavaScript
 */
jQuery(document).ready(function($) {
    // Animate in the download sections
    $('.et_pb_section').each(function(index) {
        $(this).addClass('et_animated');
    });
    
    // Add hover effects to buttons
    $('.KPH_button-2, .KPH_button_lato').hover(
        function() {
            $(this).css('transform', 'translateY(-2px)');
        },
        function() {
            $(this).css('transform', 'translateY(0)');
        }
    );
});