<?php
/**
 * Kuperbush Theme functions and definitions
 */

if (!function_exists('kuperbush_setup')) {
    function kuperbush_setup() {
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        // Let WordPress manage the document title.
        add_theme_support('title-tag');

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support('post-thumbnails');

        // Register menus
        register_nav_menus(array(
            'primary' => esc_html__('Primary Menu', 'kuperbush'),
            'footer-products' => esc_html__('Footer Products Menu', 'kuperbush'),
            'footer-about' => esc_html__('Footer About Menu', 'kuperbush'),
            'legal' => esc_html__('Legal Menu', 'kuperbush'),
        ));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');
    }
}
add_action('after_setup_theme', 'kuperbush_setup');

/**
 * Enqueue scripts and styles.
 */
function kuperbush_scripts() {
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
add_action('wp_enqueue_scripts', 'kuperbush_scripts');

/**
 * Register widget area.
 */
function kuperbush_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Footer Widget 1', 'kuperbush'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Add widgets here.', 'kuperbush'),
        'before_widget' => '<div id="%1$s" class="fwidget et_pb_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="title">',
        'after_title'   => '</h4>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__('Footer Widget 2', 'kuperbush'),
        'id'            => 'footer-2',
        'description'   => esc_html__('Add widgets here.', 'kuperbush'),
        'before_widget' => '<div id="%1$s" class="fwidget et_pb_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="title">',
        'after_title'   => '</h4>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__('Footer Widget 3', 'kuperbush'),
        'id'            => 'footer-3',
        'description'   => esc_html__('Add widgets here.', 'kuperbush'),
        'before_widget' => '<div id="%1$s" class="fwidget et_pb_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'kuperbush_widgets_init');

/**
 * Template-specific styles and scripts
 * 
 * This function detects which template is being used and enqueues
 * specific CSS and JS files for that template only.
 */
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
    
    // Add cases for other templates here
}
add_action('wp_enqueue_scripts', 'kuperbush_template_specific_assets', 20);

/**
 * Add template-specific body classes
 */
function kuperbush_template_body_classes($classes) {
    // Get the current template file
    $template_file = basename(get_page_template());
    
    // Add template-specific body classes
    if ($template_file === 'tmp-design.php') {
        $classes[] = 'template-design';
    }
    
    return $classes;
}
add_filter('body_class', 'kuperbush_template_body_classes');

/**
 * Template loader function
 * This function checks for templates in the templates directory
 */
function kuperbush_template_loader($template) {
    // Check if a template exists in our templates directory
    if (is_page()) {
        $page_template = get_post_meta(get_the_ID(), '_wp_page_template', true);
        
        if (!empty($page_template) && $page_template !== 'default') {
            // Check if the template is one of our custom templates
            if (strpos($page_template, 'tmp-') === 0) {
                $template_path = get_template_directory() . '/templates/' . $page_template;
                
                if (file_exists($template_path)) {
                    return $template_path;
                }
            }
        }
    }
    
    return $template;
}
add_filter('template_include', 'kuperbush_template_loader');

/**
 * Fallback functions for the menus to ensure the site looks exactly like the original HTML
 * until real WordPress menus are created
 */
function kuperbush_primary_menu_fallback() {
    echo '<ul id="top-menu" class="nav">
        <li class="menu-principal-productos menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
            <a id="menu-item--first" data-menu="auto" href="">מוצרים</a>
            <ul class="sub-menu">
                <li id="menu-item-ovens-and-compacts" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-ovens-and-compacts">
                    <a id="menu-item-ovens-and-compacts-first" data-menu="auto" href="' . get_template_directory_uri() . '/ovens-and-compacts/index.html">תנורים וקומפקטים</a>
                </li>
                <li id="menu-item-hobs" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-hobs">
                    <a id="menu-item-hobs-first" data-menu="auto" href="' . get_template_directory_uri() . '/hobs/index.html">כיריים</a>
                </li>
                <li id="menu-item-hoods" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-hoods">
                    <a id="menu-item-hoods-first" data-menu="auto" href="' . get_template_directory_uri() . '/hoods/index.html">סינונים</a>
                </li>
                <li id="menu-item-refrigeration" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-refrigeration">
                    <a id="menu-item-refrigeration-first" data-menu="auto" href="' . get_template_directory_uri() . '/refrigeration/index.html">קירור</a>
                </li>
                <li id="menu-item-dishwashers" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-dishwashers">
                    <a id="menu-item-dishwashers-first" data-menu="auto" href="' . get_template_directory_uri() . '/dishwashers/index.html">מדיחי כלים</a>
                </li>
                <li id="menu-item-laundry" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-laundry">
                    <a id="menu-item-laundry-first" data-menu="auto" href="' . get_template_directory_uri() . '/laundry/index.html">כביסה</a>
                </li>
                <li id="menu-item-sinks-and-taps" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-sinks-and-taps">
                    <a id="menu-item-sinks-and-taps-first" data-menu="auto" href="' . get_template_directory_uri() . '/sinks-and-taps/index.html">כיורים וברזים</a>
                </li>
            </ul>
        </li>
        <li id="menu-item-69858" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-69858">
            <a href="#">על קופרסבוש</a>
            <ul class="sub-menu">
                <li id="menu-item-69859" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-69859">
                    <a href="' . get_template_directory_uri() . '/brand/index.html">מותג</a>
                </li>
                <li id="menu-item-69860" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-69860">
                    <a href="' . get_template_directory_uri() . '/design/index.html">עיצוב</a>
                </li>
                <li id="menu-item-69904" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-69904">
                    <a href="' . get_template_directory_uri() . '/in-the-world/index.html">KPH ברחבי העולם</a>
                </li>
                <li id="menu-item-69917" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-69917">
                    <a href="' . get_template_directory_uri() . '/history/index.html">היסטוריה</a>
                </li>
                <li id="menu-item-69861" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-69861">
                    <a href="' . get_template_directory_uri() . '/downloads/index.html">הורדות</a>
                </li>
            </ul>
        </li>
        <li id="menu-item-69862" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-69862">
            <a href="' . get_template_directory_uri() . '/service/index.html">שירות</a>
        </li>
    </ul>';
}

function kuperbush_footer_products_menu_fallback() {
    echo '<div id="nav_menu-4" class="fwidget et_pb_widget widget_nav_menu">
        <h4 class="title">מוצרים</h4>
        <div class="menu-products-footer-container">
            <ul id="menu-products-footer" class="menu">
                <li id="menu-item-69933" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-69933">
                    <a href="' . get_template_directory_uri() . '/ovens-and-compacts/index.html">תנורים</a>
                </li>
                <li id="menu-item-69934" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-69934">
                    <a href="' . get_template_directory_uri() . '/hobs/index.html">כיריים</a>
                </li>
                <li id="menu-item-69935" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-69935">
                    <a href="' . get_template_directory_uri() . '/hoods/index.html">סינונים</a>
                </li>
                <li id="menu-item-69936" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-69936">
                    <a href="' . get_template_directory_uri() . '/refrigeration/index.html">קו קר</a>
                </li>
                <li id="menu-item-69937" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-69937">
                    <a href="' . get_template_directory_uri() . '/dishwashers/index.html">מדיחי כלים</a>
                </li>
                <li id="menu-item-69938" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-69938">
                    <a href="' . get_template_directory_uri() . '/laundry/index.html">כביסה</a>
                </li>
                <li id="menu-item-76241" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-76241">
                    <a href="' . get_template_directory_uri() . '/sinks-and-taps/index.html">כיורים וברזים</a>
                </li>
                <li id="menu-item-76577" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-76577">
                    <a href="' . get_template_directory_uri() . '/service/manuals/index.html">מדריכים</a>
                </li>
            </ul>
        </div>
    </div>';
}

function kuperbush_footer_about_menu_fallback() {
    echo '<div id="nav_menu-12" class="fwidget et_pb_widget widget_nav_menu">
        <h4 class="title">אודות קופרבוש</h4>
        <div class="menu-about-kuppersbusch-footer-container">
            <ul id="menu-about-kuppersbusch-footer" class="menu">
                <li id="menu-item-69944" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-69944">
                    <a href="' . get_template_directory_uri() . '/brand/index.html">ערכי מותג</a>
                </li>
                <li id="menu-item-69942" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-69942">
                    <a href="' . get_template_directory_uri() . '/history/index.html">היסטוריה</a>
                </li>
                <li id="menu-item-69940" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-69940">
                    <a href="' . get_template_directory_uri() . '/design/index.html">עיצוב</a>
                </li>
                <li id="menu-item-69941" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-69941">
                    <a href="' . get_template_directory_uri() . '/downloads/index.html">הורדות</a>
                </li>
                <li id="menu-item-72896" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-72896">
                    <a href="' . get_template_directory_uri() . '/new-energy-label/index.html">תווית אנרגיה חדשה</a>
                </li>
                <li id="menu-item-69939" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-69939">
                    <a href="' . get_template_directory_uri() . '/service/index.html">שירות</a>
                </li>
                <li id="menu-item-74079" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-74079">
                    <a href="' . get_template_directory_uri() . '/individual/index.html">אישי</a>
                </li>
                <li id="menu-item-74080" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-74080">
                    <a href="' . get_template_directory_uri() . '/k-series/index.html">סדרת K</a>
                </li>
            </ul>
        </div>
    </div>';
}

function kuperbush_footer_brand_info_fallback() {
    echo '<div id="media_image-2" class="fwidget et_pb_widget widget_media_image">
        <img class="image" src="' . get_template_directory_uri() . '/img/kuppersbusch-white.svg" alt="" width="300" height="37" decoding="async" loading="lazy" />
    </div>
    <div id="custom_html-3" class="widget_text fwidget et_pb_widget widget_custom_html">
        <div class="textwidget custom-html-widget">
            <a href="https://www.youtube.com/channel/UCaRoMAFkv5XWgWDPwObus4g" target="_blank" align="right">
                <img src="' . get_template_directory_uri() . '/img/uploads/KPH-youtube-.png">
            </a>
            <a href="https://www.linkedin.com/company/k%C3%BCppersbusch-hausger%C3%A4te-gmbh/" target="_blank" align="right">
                <img src="' . get_template_directory_uri() . '/img/uploads/KPH-linkedin-.png">
            </a>
            <a href="https://www.instagram.com/kueppersbusch.international/" target="_blank" align="right">
                <img src="' . get_template_directory_uri() . '/img/uploads/KPH-INDIVIDUA.png">
            </a>
        </div>
    </div>';
}

function kuperbush_legal_menu_fallback() {
    echo '<ul id="menu-legal" class="bottom-nav">
        <li id="menu-item-22135" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22135">
            <a href="' . get_template_directory_uri() . '/legal-notice/index.html">ייעוץ משפטי</a>
        </li>
        <li id="menu-item-22140" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22140">
            <a href="' . get_template_directory_uri() . '/privacy-policy/index.html">מדיניות פרטיות</a>
        </li>
        <li id="menu-item-22141" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22141">
            <a href="' . get_template_directory_uri() . '/cookies-policy/index.html">מדיניות עוגיות</a>
        </li>
    </ul>';
}