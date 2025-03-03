/* 
 * History Timeline JS for Kuperbush Theme
 */
jQuery(document).ready(function($) {
    // Initialize Swiper for the timeline
    var timelineSwiper = new Swiper('.swiper-container', {
        direction: 'horizontal',
        loop: false,
        speed: 1000,
        pagination: {
            el: '.swiper-pagination',
            type: 'bullets',
            clickable: true,
            renderBullet: function(index, className) {
                var year = document.querySelectorAll('.swiper-slide')[index].getAttribute('data-year');
                return '<span class="' + className + '">' + year + '</span>';
            },
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        autoplay: {
            delay: 8000,
            disableOnInteraction: false,
        },
        keyboard: {
            enabled: true,
            onlyInViewport: true,
        },
    });

    // Additional functionality for responsive adjustments
    function adjustTimelineHeight() {
        if ($(window).width() < 768) {
            // Adjust for mobile viewing if needed
            $('.container-historia').css('height', 'auto');
            $('.swiper-container').css('position', 'relative');
        } else {
            // Reset for desktop
            $('.container-historia').css('height', '100vh');
            $('.swiper-container').css('position', 'absolute');
            
            // Account for admin bar if present
            if ($('body').hasClass('admin-bar')) {
                var adminBarHeight = $('#wpadminbar').height();
                $('.container-historia').css('height', 'calc(100vh - ' + adminBarHeight + 'px)');
            }
        }
    }

    // Run on load and resize
    adjustTimelineHeight();
    $(window).resize(function() {
        adjustTimelineHeight();
    });
});