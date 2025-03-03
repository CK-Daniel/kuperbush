/**
 * Brand Page Template Scripts
 */

jQuery(document).ready(function($) {
    // Animation for text sections
    function animateSections() {
        $('.et_pb_text').each(function(index) {
            var $this = $(this);
            
            // Only animate elements that are visible
            if ($this.isInViewport()) {
                setTimeout(function() {
                    $this.addClass('et_animated fade');
                }, index * 200); // Staggered animation
            }
        });
        
        // Animate images
        $('.et_pb_image').each(function(index) {
            var $this = $(this);
            
            if ($this.isInViewport()) {
                setTimeout(function() {
                    $this.addClass('et_animated fade');
                }, (index + 3) * 200); // Start after text animations
            }
        });
    }
    
    // Check if element is in viewport
    $.fn.isInViewport = function() {
        var elementTop = $(this).offset().top;
        var elementBottom = elementTop + $(this).outerHeight();
        var viewportTop = $(window).scrollTop();
        var viewportBottom = viewportTop + $(window).height();
        return elementBottom > viewportTop && elementTop < viewportBottom;
    };
    
    // Run animation on page load
    animateSections();
    
    // Run animation on scroll
    $(window).on('scroll', function() {
        animateSections();
    });
});