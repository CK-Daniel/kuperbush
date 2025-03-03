jQuery(document).ready(function($) {
    // Initialize tab functionality for continent filtering
    $('#ContinentTab .et_pb_tab_0').click(function() {
        $('.europa').fadeIn();
        $('.america').fadeIn();
        $('.australia').fadeIn();
        $('.asia').fadeIn();
    });
    
    $('#ContinentTab .et_pb_tab_1').click(function() {
        $('.europa').fadeIn();
        $('.america').fadeOut();
        $('.australia').fadeOut();
        $('.asia').hide();
    });
    
    $('#ContinentTab .et_pb_tab_2').click(function() {
        $('.europa').fadeOut();
        $('.america').fadeOut();
        $('.australia').fadeOut();
        $('.asia').fadeIn();
    });
    
    // Initialize any sliders if needed
    // $('.gallery-slider').slick({
    //     dots: true,
    //     infinite: true,
    //     speed: 500,
    //     fade: true,
    //     cssEase: 'linear',
    //     autoplay: true,
    //     autoplaySpeed: 5000
    // });
    
    // Make sure galleries are responsive
    $(window).resize(function() {
        adjustGalleryHeight();
    });
    
    function adjustGalleryHeight() {
        var windowWidth = $(window).width();
        
        if (windowWidth <= 767) {
            // Mobile adjustments
            $('.et_pb_gallery').each(function() {
                $(this).css('max-height', 'auto');
            });
        } else {
            // Desktop/tablet adjustments
            $('.et_pb_gallery').each(function() {
                $(this).css('max-height', '550px');
            });
        }
    }
    
    // Initialize on page load
    adjustGalleryHeight();
});