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
            
            // Enqueue Divi scripts for slider functionality
            wp_enqueue_script('divi-fitvids', get_template_directory_uri() . '/css/Divi/includes/builder/feature/dynamic-assets/assets/js/jquery.fitvids.js', array('jquery'), null, true);
            wp_enqueue_script('divi-jquery-mobile', get_template_directory_uri() . '/css/Divi/includes/builder/feature/dynamic-assets/assets/js/jquery.mobile.js', array('jquery'), null, true);
            wp_enqueue_script('divi-custom-script', get_template_directory_uri() . '/css/Divi/js/scripts.min.js', array('jquery'), null, true);
            wp_enqueue_script('divi-core-common', get_template_directory_uri() . '/css/Divi/core/admin/js/common.js', array('jquery'), null, true);
            
            // Enqueue mediaelement scripts from theme folder
            wp_enqueue_script('mediaelement-core', get_template_directory_uri() . '/js/mediaelement/mediaelement-and-player.min.js', array('jquery'), null, true);
            wp_enqueue_script('mediaelement-migrate', get_template_directory_uri() . '/js/mediaelement/mediaelement-migrate.min.js', array('jquery'), null, true);
            wp_enqueue_script('wp-mediaelement', get_template_directory_uri() . '/js/mediaelement/wp-mediaelement.min.js', array('jquery'), null, true);
            
            // Enqueue our custom Divi customizer for slider
            wp_enqueue_script('divi-customizer', get_template_directory_uri() . '/js/divi-customizer.js', array('jquery', 'divi-custom-script'), null, true);
            
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
                    "mejs.time-help-text" => "Use Left/Right Arrow keys to advance one second, Up/Down arrows to advance ten seconds.",
                    "mejs.live-broadcast" => "Live Broadcast",
                    "mejs.volume-help-text" => "Use Up/Down Arrow keys to increase or decrease volume.",
                    "mejs.unmute" => "Unmute",
                    "mejs.mute" => "Mute",
                    "mejs.volume-slider" => "Volume Slider",
                    "mejs.video-player" => "Video Player",
                    "mejs.audio-player" => "Audio Player"
                )
            ));
            
            wp_localize_script('wp-mediaelement', '_wpmejsSettings', array(
                "pluginPath" => "/js/mediaelement/",
                "classPrefix" => "mejs-",
                "stretching" => "responsive",
                "audioShortcodeLibrary" => "mediaelement",
                "videoShortcodeLibrary" => "mediaelement"
            ));
            
            // DIVI Variables
            wp_localize_script('jquery', 'DIVI', array(
                "item_count" => "%d Item",
                "items_count" => "%d Items"
            ));
            
            wp_localize_script('jquery', 'et_builder_utils_params', array(
                "condition" => array(
                    "diviTheme" => true,
                    "extraTheme" => false
                ),
                "scrollLocations" => array("app", "top"),
                "builderScrollLocations" => array(
                    "desktop" => "app",
                    "tablet" => "app",
                    "phone" => "app"
                ),
                "onloadScrollLocation" => "app",
                "builderType" => "fe"
            ));
            
            wp_localize_script('jquery', 'et_frontend_scripts', array(
                "builderCssContainerPrefix" => "#et-boc",
                "builderCssLayoutPrefix" => "#et-boc .et-l"
            ));
            
            wp_localize_script('jquery', 'et_pb_custom', array(
                "ajaxurl" => admin_url('admin-ajax.php'),
                "images_uri" => get_template_directory_uri() . "/images",
                "builder_images_uri" => get_template_directory_uri() . "/includes/builder/images",
                "et_frontend_nonce" => wp_create_nonce('et_frontend_nonce'),
                "subscription_failed" => "Please, check the fields below to make sure you entered the correct information.",
                "et_ab_log_nonce" => wp_create_nonce('et_ab_log_nonce'),
                "fill_message" => "Please, fill in the following fields:",
                "contact_error_message" => "Please, fix the following errors:",
                "invalid" => "Invalid email",
                "captcha" => "Captcha",
                "prev" => "Prev",
                "previous" => "Previous",
                "next" => "Next",
                "wrong_captcha" => "You entered the wrong number in captcha.",
                "wrong_checkbox" => "Checkbox",
                "ignore_waypoints" => "no",
                "is_divi_theme_used" => "1",
                "widget_search_selector" => ".widget_search",
                "ab_tests" => array(),
                "is_ab_testing_active" => "",
                "page_id" => get_the_ID(),
                "unique_test_id" => "",
                "ab_bounce_rate" => "5",
                "is_cache_plugin_active" => "no",
                "is_shortcode_tracking" => "",
                "tinymce_uri" => get_template_directory_uri() . "/includes/builder/frontend-builder/assets/vendors",
                "accent_color" => "#c8102e",
                "waypoints_options" => array()
            ));
            
            wp_localize_script('jquery', 'et_pb_box_shadow_elements', array());

            // Add slider module design styles for front page
            $inline_style = '.et_pb_slide_1.et_pb_slide .et_pb_slide_overlay_container{background-color:rgba(0,0,0,0.21)}.et_pb_slider .et_pb_slide_2 .et_pb_slide_description .et_pb_button_wrapper{text-align:center}.et_pb_fullwidth_slider_0,.et_pb_fullwidth_slider_0 .et_pb_slide{min-height:auto;max-height:1050px}.et_pb_fullwidth_slider_0 .et_pb_slide>.et_pb_container{width:100%}.et_pb_slider .et_pb_slide_0.et_pb_slide .et_pb_slide_description .et_pb_slide_title,.et_pb_slider.et_pb_module .et_pb_slide_0.et_pb_slide .et_pb_slide_description .et_pb_slide_content,.et_pb_slider .et_pb_slide_1.et_pb_slide .et_pb_slide_description .et_pb_slide_title,.et_pb_slider.et_pb_module .et_pb_slide_1.et_pb_slide .et_pb_slide_description .et_pb_slide_content,.et_pb_slider .et_pb_slide_2.et_pb_slide .et_pb_slide_description .et_pb_slide_title,.et_pb_slider.et_pb_module .et_pb_slide_2.et_pb_slide .et_pb_slide_description .et_pb_slide_content{text-align:left!important}.et_pb_slides .et_pb_slide_0.et_pb_slide .et_pb_slide_description,.et_pb_slides .et_pb_slide_2.et_pb_slide .et_pb_slide_description{text-align:left}@media only screen and (max-width:980px){.et_pb_fullwidth_slider_0,.et_pb_fullwidth_slider_0 .et_pb_slide{min-height:auto}.et_pb_slider .et_pb_slide_0,.et_pb_slider .et_pb_slide_1,.et_pb_slider .et_pb_slide_2{background-image:initial;background-color:initial}}@media only screen and (max-width:767px){.et_pb_section_0.et_pb_section{margin-bottom:50px}.et_pb_fullwidth_slider_0,.et_pb_fullwidth_slider_0 .et_pb_slide{min-height:auto}.et_pb_slider .et_pb_slide_0{background-size:cover;background-image:url(../css/uploads/Home_mobile_kitchen_BlackVelvet_3.jpg)}.et_pb_slider .et_pb_slide_1{background-size:cover;background-image:url(/wp-content/uploads/sites/3/2025/01/Kitchen_GraphiteLine_mobile.jpg)}.et_pb_slider .et_pb_slide_2{background-size:cover;background-image:url(/wp-content/uploads/sites/3/2025/01/Kitchen-MattBlack_mobile.jpg)}}';
            wp_add_inline_style('kuperbush-style', $inline_style);
        }
    }
}
add_action('wp_enqueue_scripts', 'kuperbush_front_page_scripts', 30);