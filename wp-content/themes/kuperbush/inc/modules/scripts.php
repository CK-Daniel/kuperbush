<?php
/**
 * Enqueue scripts and styles
 */

if (!function_exists('kuperbush_enqueue_main_scripts')) {
    function kuperbush_enqueue_main_scripts() {
        // Enqueue the main stylesheet
        wp_enqueue_style('kuperbush-style', get_stylesheet_uri());
        
        // Enqueue main CSS
        wp_enqueue_style('main-css', get_template_directory_uri() . '/css/main.css');
        wp_enqueue_style('pagenavi-css', get_template_directory_uri() . '/css/pagenavi-css.css');
        wp_enqueue_style('customize-product-css', get_template_directory_uri() . '/css/customize-product.css');
        wp_enqueue_style('wp-mediaelement-css', get_template_directory_uri() . '/css/wp-mediaelement.min.css');
        wp_enqueue_style('mediaelement-legacy-css', get_template_directory_uri() . '/css/mediaelementplayer-legacy.min.css');
        wp_enqueue_style('fonts-bunny-css', get_template_directory_uri() . '/css/fonts-bunny.css');
        wp_enqueue_style('style-product-css', get_template_directory_uri() . '/css/style-product.css');
        wp_enqueue_style('style-product-cat-css', get_template_directory_uri() . '/css/style-product-cat.css');
        wp_enqueue_style('fontello-css', get_template_directory_uri() . '/fonts/fontello.css');
        wp_enqueue_style('fontawesome-brands-css', get_template_directory_uri() . '/fonts/brands.min.css');
        
        // Enqueue slick CSS
        wp_enqueue_style('slick-css', get_template_directory_uri() . '/js/slick/slick.css');
        wp_enqueue_style('slick-theme-css', get_template_directory_uri() . '/js/slick/slick-theme.css');
        
        // Featherlight CSS
        wp_enqueue_style('featherlight-css', get_template_directory_uri() . '/js/featherlight/featherlight.min.css');
        wp_enqueue_style('featherlight-gallery-css', get_template_directory_uri() . '/js/featherlight/featherlight.gallery.min.css');
        
        // Tooltipster CSS
        wp_enqueue_style('tooltipster-css', get_template_directory_uri() . '/js/tooltipster/css/tooltipster.bundle.min.css');
        
        // JS Socials CSS
        wp_enqueue_style('jssocials-css', get_template_directory_uri() . '/js/jssocials/jssocials.css');
        wp_enqueue_style('jssocials-flattheme-css', get_template_directory_uri() . '/js/jssocials/jssocials-theme-flat.css');
        
        // Admin styles
        wp_enqueue_style('admin-styles-css', get_template_directory_uri() . '/style-admin.css');
        
        // jQuery and jQuery Migrate
        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-migrate');
        
        // Other scripts
        wp_enqueue_script('tl-custom-js', get_template_directory_uri() . '/js/tl_custom.js', array('jquery'), null, true);
        wp_enqueue_script('select2-js', get_template_directory_uri() . '/js/select2/js/select2.min.js', array('jquery'), null, true);
        wp_enqueue_script('menuslider-js', get_template_directory_uri() . '/js/menuslider.js', array('jquery'), null, true);
        wp_enqueue_script('tooltipster-js', get_template_directory_uri() . '/js/tooltipster/js/tooltipster.bundle.min.js', array('jquery'), null, true);
        wp_enqueue_script('js-cookie-js', get_template_directory_uri() . '/js/js.cookie.js', array('jquery'), null, true);
        wp_enqueue_script('compare-js', get_template_directory_uri() . '/js/compare.js', array('jquery'), null, true);
        wp_enqueue_script('comparator-js', get_template_directory_uri() . '/js/comparator.js', array('jquery'), null, true);
        wp_enqueue_script('slick-js', get_template_directory_uri() . '/js/slick/slick.min.js', array('jquery'), null, true);
        wp_enqueue_script('featherlight-js', get_template_directory_uri() . '/js/featherlight/featherlight.min.js', array('jquery'), null, true);
        wp_enqueue_script('featherlight-gallery-js', get_template_directory_uri() . '/js/featherlight/featherlight.gallery.min.js', array('jquery'), null, true);
        wp_enqueue_script('markerclusterer-js', get_template_directory_uri() . '/js/markerclusterer.js', array('jquery'), null, true);
        wp_enqueue_script('product-list-js', get_template_directory_uri() . '/js/product-list.js', array('jquery'), null, true);
        wp_enqueue_script('lozad-js', get_template_directory_uri() . '/js/lozad.min.js', array('jquery'), null, true);
        wp_enqueue_script('scripts-js', get_template_directory_uri() . '/js/scripts.js', array('jquery'), null, true);
        wp_enqueue_script('jssocials-js', get_template_directory_uri() . '/js/jssocials/jssocials.min.js', array('jquery'), null, true);
        wp_enqueue_script('fullscreen-js', get_template_directory_uri() . '/js/jquery.fullscreen-0.4.1.min.js', array('jquery'), null, true);
    }
}
add_action('wp_enqueue_scripts', 'kuperbush_enqueue_main_scripts');

/**
 * Template-specific styles and scripts
 * 
 * This function detects which template is being used and enqueues
 * specific CSS and JS files for that template only.
 */
if (!function_exists('kuperbush_template_specific_assets')) {
    function kuperbush_template_specific_assets() {
        // Get the current template file
        $template_file = basename(get_page_template());
        
        // Design template specific assets
        if ($template_file === 'tmp-design.php') {
            // Add design template specific CSS
            wp_enqueue_style('design-template-css', get_template_directory_uri() . '/css/templates/design.css', array(), '1.0');
            
            // Add design template specific JS
            wp_enqueue_script('design-template-js', get_template_directory_uri() . '/js/templates/design.js', array('jquery'), '1.0', true);
        }
        
        // Downloads template specific assets
        if ($template_file === 'tmp-downloads.php') {
            // Add downloads template specific CSS
            wp_enqueue_style('downloads-template-css', get_template_directory_uri() . '/css/templates/downloads.css', array(), '1.0');
            
            // Add downloads template specific JS
            wp_enqueue_script('downloads-template-js', get_template_directory_uri() . '/js/templates/downloads.js', array('jquery'), '1.0', true);
        }
        
        // In The World template specific assets
        if ($template_file === 'tmp-in-the-world.php') {
            // Add in-the-world template specific CSS
            wp_enqueue_style('in-the-world-template-css', get_template_directory_uri() . '/css/templates/in-the-world.css', array(), '1.0');
            
            // Add in-the-world template specific JS
            wp_enqueue_script('in-the-world-template-js', get_template_directory_uri() . '/js/templates/in-the-world.js', array('jquery'), '1.0', true);
        }
        
        // Service template specific assets
        if ($template_file === 'tmp-service.php') {
            // Add service template specific CSS
            wp_enqueue_style('service-template-css', get_template_directory_uri() . '/css/templates/service.css', array(), '1.0');
            
            // Add service template specific JS
            wp_enqueue_script('service-template-js', get_template_directory_uri() . '/js/templates/service.js', array('jquery'), '1.0', true);
        }
        
        // Brand template specific assets
        if ($template_file === 'tmp-brand.php') {
            // Add brand template specific CSS
            wp_enqueue_style('brand-template-css', get_template_directory_uri() . '/css/templates/brand.css', array(), '1.0');
            
            // Add brand template specific JS
            wp_enqueue_script('brand-template-js', get_template_directory_uri() . '/js/templates/brand.js', array('jquery'), '1.0', true);
        }
        
        // History template specific assets
        if ($template_file === 'tmp-history.php') {
            // Add Historia CSS files from the original template
            wp_enqueue_style('normalize-css', get_template_directory_uri() . '/css/historia/normalize.min.css', array(), '1.0');
            wp_enqueue_style('swiper-css', get_template_directory_uri() . '/css/historia/swiper.min.css', array(), '1.0');
            wp_enqueue_style('historia-css', get_template_directory_uri() . '/css/historia/style.css', array(), '1.0');
            
            // Add custom history template CSS
            wp_enqueue_style('history-template-css', get_template_directory_uri() . '/css/templates/history.css', array(), '1.0');
            
            // Add Swiper JS and custom history JS
            wp_enqueue_script('swiper-js', get_template_directory_uri() . '/js/historia/swiper.min.js', array('jquery'), '1.0', true);
            wp_enqueue_script('historia-js', get_template_directory_uri() . '/js/historia/historia.js', array('jquery', 'swiper-js'), '1.0', true);
            wp_enqueue_script('history-template-js', get_template_directory_uri() . '/js/templates/history.js', array('jquery', 'swiper-js', 'historia-js'), '1.0', true);
        }
    }
}
add_action('wp_enqueue_scripts', 'kuperbush_template_specific_assets', 20);