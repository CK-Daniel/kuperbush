(function($) {
    $(document).ready(function() {
        // Initialize front page slider functionality
        if ($('.et_pb_fullwidth_slider_0').length) {
            $('.et_pb_fullwidth_slider_0').addClass('et_animated');
            
            // Make sure videos autoplay
            $('.et_pb_slide video').each(function() {
                var video = $(this)[0];
                if (video) {
                    video.muted = true;
                    video.play();
                }
            });
            
            // Initialize clickable slides
            $('.et_pb_slide_0, .et_pb_slide_1, .et_pb_slide_2').on('click', function() {
                var slideClass = $(this).attr('class').split(' ').filter(function(c) {
                    return c.indexOf('et_pb_slide_') === 0;
                })[0];
                
                // Find the matching link in et_link_options_data
                if (typeof et_link_options_data !== 'undefined') {
                    for (var i = 0; i < et_link_options_data.length; i++) {
                        if (et_link_options_data[i].class === slideClass) {
                            window.location.href = et_link_options_data[i].url;
                            break;
                        }
                    }
                }
            });
            
            // Handle video autoplay issues
            $(window).on('scroll', function() {
                $('.et_pb_slide_video video').each(function() {
                    if ($(this).is(':visible')) {
                        if (this.paused) {
                            this.play();
                        }
                    }
                });
            });
        }
    });
})(jQuery);