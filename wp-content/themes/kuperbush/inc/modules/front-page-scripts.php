<?php
/**
 * Front Page Scripts Module
 * 
 * This module adds the necessary scripts and styles
 * for the front page slider to function properly.
 */

if (!function_exists('kuperbush_front_page_scripts')) {
    /**
     * Add front page specific scripts and styles
     */
    function kuperbush_front_page_scripts() {
        if (is_front_page()) {
            // Add required styles for the home slider
            wp_enqueue_style('wp-mediaelement', get_template_directory_uri() . '/css/wp-mediaelement.min.css');
            wp_enqueue_style('mediaelement-legacy', get_template_directory_uri() . '/css/mediaelementplayer-legacy.min.css');
            
            // Localize slider animation data
            wp_localize_script('jquery', 'et_animation_data', array(
                array(
                    "class" => "et_pb_fullwidth_slider_0",
                    "style" => "fade",
                    "repeat" => "once",
                    "duration" => "700ms",
                    "delay" => "0ms",
                    "intensity" => "50%",
                    "starting_opacity" => "0%",
                    "speed_curve" => "ease-in-out"
                )
            ));
            
            // Localize slider link options
            wp_localize_script('jquery', 'et_link_options_data', array(
                array(
                    "class" => "et_pb_slide_0",
                    "url" => "https://www.home-kueppersbusch.com/global/hobs/inductions-with-hoods/",
                    "target" => "_self"
                ),
                array(
                    "class" => "et_pb_slide_1",
                    "url" => "https://www.home-kueppersbusch.com/global/product/bp6350-0gph6_121010032/",
                    "target" => "_self"
                ),
                array(
                    "class" => "et_pb_slide_2",
                    "url" => "https://www.home-kueppersbusch.com/global/product/bp6332-0ksm6_121010037/",
                    "target" => "_self"
                )
            ));
            
            // Enqueue mediaelement scripts
            wp_enqueue_script('mediaelement-core', get_template_directory_uri() . '/plugins/js/mediaelement/mediaelement-and-player.min.js', array('jquery'), null, true);
            wp_enqueue_script('mediaelement-migrate', get_template_directory_uri() . '/plugins/js/mediaelement/mediaelement-migrate.min.js', array('jquery'), null, true);
            wp_enqueue_script('wp-mediaelement', get_template_directory_uri() . '/plugins/js/mediaelement/wp-mediaelement.min.js', array('jquery'), null, true);
            
            // Localize mediaelement settings
            wp_localize_script('mediaelement-core', 'mejsL10n', array(
                "language" => "en",
                "strings" => array(
                    "mejs.download-file" => "Download File",
                    "mejs.install-flash" => "You are using a browser that does not have Flash player enabled or installed. Please turn on your Flash player plugin or download the latest version from https://get.adobe.com/flashplayer/",
                    "mejs.fullscreen" => "Fullscreen",
                    "mejs.play" => "Play",
                    "mejs.pause" => "Pause",
                    "mejs.time-slider" => "Time Slider",
                    "mejs.time-help-text" => "Use Left/Right Arrow keys to advance one second, Up/Down arrows to advance ten seconds."
                )
            ));
            
            wp_localize_script('wp-mediaelement', '_wpmejsSettings', array(
                "pluginPath" => "/global/wp-includes/js/mediaelement/",
                "classPrefix" => "mejs-",
                "stretching" => "responsive"
            ));

            // Add slider module design styles for front page
            $inline_style = '.et_pb_slide_1.et_pb_slide .et_pb_slide_overlay_container{background-color:rgba(0,0,0,0.21)}.et_pb_slider .et_pb_slide_2 .et_pb_slide_description .et_pb_button_wrapper{text-align:center}.et_pb_fullwidth_slider_0,.et_pb_fullwidth_slider_0 .et_pb_slide{min-height:auto;max-height:1050px}.et_pb_fullwidth_slider_0 .et_pb_slide>.et_pb_container{width:100%}.et_pb_slider .et_pb_slide_0.et_pb_slide .et_pb_slide_description .et_pb_slide_title,.et_pb_slider.et_pb_module .et_pb_slide_0.et_pb_slide .et_pb_slide_description .et_pb_slide_content,.et_pb_slider .et_pb_slide_1.et_pb_slide .et_pb_slide_description .et_pb_slide_title,.et_pb_slider.et_pb_module .et_pb_slide_1.et_pb_slide .et_pb_slide_description .et_pb_slide_content,.et_pb_slider .et_pb_slide_2.et_pb_slide .et_pb_slide_description .et_pb_slide_title,.et_pb_slider.et_pb_module .et_pb_slide_2.et_pb_slide .et_pb_slide_description .et_pb_slide_content{text-align:left!important}.et_pb_slides .et_pb_slide_0.et_pb_slide .et_pb_slide_description,.et_pb_slides .et_pb_slide_2.et_pb_slide .et_pb_slide_description{text-align:left}@media only screen and (max-width:980px){.et_pb_fullwidth_slider_0,.et_pb_fullwidth_slider_0 .et_pb_slide{min-height:auto}.et_pb_slider .et_pb_slide_0,.et_pb_slider .et_pb_slide_1,.et_pb_slider .et_pb_slide_2{background-image:initial;background-color:initial}}@media only screen and (max-width:767px){.et_pb_section_0.et_pb_section{margin-bottom:50px}.et_pb_fullwidth_slider_0,.et_pb_fullwidth_slider_0 .et_pb_slide{min-height:auto}.et_pb_slider .et_pb_slide_0{background-size:cover;background-image:url(../css/uploads/Home_mobile_kitchen_BlackVelvet_3.jpg)}.et_pb_slider .et_pb_slide_1{background-size:cover;background-image:url(/wp-content/uploads/sites/3/2025/01/Kitchen_GraphiteLine_mobile.jpg)}.et_pb_slider .et_pb_slide_2{background-size:cover;background-image:url(/wp-content/uploads/sites/3/2025/01/Kitchen-MattBlack_mobile.jpg)}}';
            wp_add_inline_style('kuperbush-style', $inline_style);
        }
    }
}
add_action('wp_enqueue_scripts', 'kuperbush_front_page_scripts', 30);