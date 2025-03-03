function playVideo(video) {
    if (video.paused) {
        video.play();
        if (video.id == "" || video.id == undefined) {
            video.id = new Date().getTime();
        }
        jQuery("#" + video.id).addClass("playing");
        jQuery("#" + video.id).parent().fullscreen();
        video.controls = true;
    } else {
        video.pause();
        jQuery("#" + video.id).removeClass("playing");
        if (jQuery.fullscreen.isFullScreen()) {
            jQuery.fullscreen.exit();
        }
    }
}
jQuery(function() {
    jQuery(".video").on("fscreenopen", function() {
        jQuery(this).find(".play").hide();
        jQuery(this).find(".close_fullscreen").show();
    });
    jQuery(".video").on("fscreenclose", function() {
        if (!jQuery(this).find("video").hasClass("playing")) {
            jQuery(this).find(".play").show();
        }
        jQuery(this).find(".close_fullscreen").hide();
    });
    jQuery(".video a").click(function(event) {
        event.preventDefault();
        jQuery(this).parent().find("video").click();
    })
})