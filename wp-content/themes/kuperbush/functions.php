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
 * Include custom post types and other functionality
 */
require_once get_template_directory() . '/inc/cpt-products.php';

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
    
    if ($template_file === 'tmp-downloads.php') {
        $classes[] = 'template-downloads';
    }
    
    if ($template_file === 'tmp-in-the-world.php') {
        $classes[] = 'template-in-the-world';
    }
    
    if ($template_file === 'tmp-service.php') {
        $classes[] = 'template-service';
    }
    
    if ($template_file === 'tmp-brand.php') {
        $classes[] = 'template-brand';
    }
    
    if ($template_file === 'tmp-history.php') {
        $classes[] = 'template-history page-template-tp-historia page-template-tp-historia-php';
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
 * AJAX handler for filtering Kuperbush products
 */
function kuperbush_filter_products() {
    $args = array(
        'post_type' => 'kuperbush_product',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
        'tax_query' => array(),
    );

    // Filter by category if specified
    if (isset($_POST['referencia_de_seccion']) && !empty($_POST['referencia_de_seccion'])) {
        $category_ids = array_map('intval', $_POST['referencia_de_seccion']);
        $args['tax_query'][] = array(
            'taxonomy' => 'product_category',
            'field' => 'term_id',
            'terms' => $category_ids,
            'operator' => 'IN',
        );
    }

    // Filter by product series if specified
    if (isset($_POST['product_series']) && !empty($_POST['product_series'])) {
        $series_slugs = $_POST['product_series'];
        $args['tax_query'][] = array(
            'taxonomy' => 'product_series',
            'field' => 'slug',
            'terms' => $series_slugs,
            'operator' => 'IN',
        );
    }

    // Filter by appliance type if specified
    if (isset($_POST['type_of_appliance']) && !empty($_POST['type_of_appliance'][0])) {
        // Assuming type_of_appliance would be a custom taxonomy or meta field
        // Adjust this based on how it's implemented in your system
        $appliance_type = sanitize_text_field($_POST['type_of_appliance'][0]);
        
        // If it's a taxonomy:
        $args['tax_query'][] = array(
            'taxonomy' => 'product_tag', // Adjust if needed
            'field' => 'slug',
            'terms' => $appliance_type,
        );
    }

    // Allow for multiple taxonomy conditions
    if (count($args['tax_query']) > 1) {
        $args['tax_query']['relation'] = 'AND';
    }

    // Run the query
    $query = new WP_Query($args);

    // Start output buffer
    ob_start();
    
    // Check if we have real products
    if ($query->have_posts()) {
        echo '<div class="et_pb_portfolio_grid_items product-list">';
        while ($query->have_posts()) {
            $query->the_post();
            
            // Get product data
            $product_id = get_the_ID();
            $model_number = get_post_meta($product_id, 'model_number', true);
            $sku = get_post_meta($product_id, 'sku', true);
            $color = get_post_meta($product_id, 'color', true);
            $is_new = get_post_meta($product_id, 'is_new', true);
            
            // Get product categories 
            $product_categories = get_the_terms($product_id, 'product_category');
            $product_series = get_the_terms($product_id, 'product_series');
            
            // Get featured image
            $product_image = get_the_post_thumbnail_url($product_id, 'medium');
            if (!$product_image) {
                $product_image = get_stylesheet_directory_uri() . '/img/placeholder.png';
            }
            ?>
            <div id="post-<?php echo esc_attr($product_id); ?>" class="post-<?php echo esc_attr($product_id); ?> product type-product status-publish hentry et_pb_portfolio_item et_pb_grid_item">
                <?php if ($is_new) : ?>
                    <span class="label-new-b">New</span>
                <?php endif; ?>

                <div class="product-cat-img-container">
                    <?php if ($is_new) : ?>
                        <span class="label-fix">New</span>
                    <?php endif; ?>
                    <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr($model_number ? $model_number : get_the_title()); ?>">
                        <img id="post-img-<?php echo esc_attr($product_id); ?>" class="product-cat-img lozad" src="<?php echo get_stylesheet_directory_uri(); ?>/img/px.png" data-src="<?php echo esc_url($product_image); ?>">
                    </a>
                </div>

                <div class="product-cat-info">
                    <div class="productCat">
                        <a><?php echo esc_html($model_number ? $model_number : get_the_title()); ?></a>
                    </div>
                    <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr($model_number ? $model_number : get_the_title()); ?>">
                        <strong class="productCatLargeName"><?php the_title(); ?></strong>
                    </a>

                    <div class="product-list-footer">
                        <?php if ($color) : ?>
                        <div class="product-list-colors">Color 
                            <img class="tooltip" src="<?php echo esc_url(get_stylesheet_directory_uri() . '/img/colors/' . sanitize_file_name(strtolower($color)) . '.svg'); ?>" alt="<?php echo esc_attr($color); ?>" title="<?php echo esc_attr($color); ?>" data-exclude="<?php echo esc_attr($product_id); ?>" data-parent_product="">
                            <div class="other-colors"></div>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="product-list-description">
                        <a class="teka-button" href="<?php the_permalink(); ?>">+ Details</a>
                    </div>
                </div>
            </div>
            <?php
        }
        echo '</div>';
    } else {
        // Load and display mock products
        include_once get_template_directory() . '/inc/mock-products.php';
        
        if (function_exists('kuperbush_get_mock_products')) {
            echo '<div class="et_pb_portfolio_grid_items product-list">';
            $mock_products = kuperbush_get_mock_products();
            foreach ($mock_products as $product) {
                ?>
                <div id="post-<?php echo esc_attr($product['id']); ?>" class="post-<?php echo esc_attr($product['id']); ?> product type-product status-publish hentry et_pb_portfolio_item et_pb_grid_item">
                    <?php if ($product['is_new']) : ?>
                        <span class="label-new-b">New</span>
                    <?php endif; ?>

                    <div class="product-cat-img-container">
                        <?php if ($product['is_new']) : ?>
                            <span class="label-fix">New</span>
                        <?php endif; ?>
                        <a href="#" title="<?php echo esc_attr($product['model_number']); ?>">
                            <img id="post-img-<?php echo esc_attr($product['id']); ?>" class="product-cat-img lozad" src="<?php echo get_stylesheet_directory_uri(); ?>/img/px.png" data-src="<?php echo esc_url($product['image'] ? $product['image'] : get_stylesheet_directory_uri() . '/img/placeholder.png'); ?>">
                        </a>
                    </div>

                    <div class="product-cat-info">
                        <div class="productCat">
                            <a><?php echo esc_html($product['model_number']); ?></a>
                        </div>
                        <a href="#" title="<?php echo esc_attr($product['model_number']); ?>">
                            <strong class="productCatLargeName"><?php echo esc_html($product['title']); ?></strong>
                        </a>

                        <div class="product-list-footer">
                            <?php if (!empty($product['color'])) : ?>
                            <div class="product-list-colors">Color 
                                <img class="tooltip" src="<?php echo esc_url(get_stylesheet_directory_uri() . '/img/colors/' . sanitize_file_name(strtolower($product['color'])) . '.svg'); ?>" alt="<?php echo esc_attr($product['color']); ?>" title="<?php echo esc_attr($product['color']); ?>" data-exclude="<?php echo esc_attr($product['id']); ?>" data-parent_product="">
                                <div class="other-colors"></div>
                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="product-list-description">
                            <a class="teka-button" href="#">+ Details</a>
                        </div>
                    </div>
                </div>
                <?php
            }
            echo '</div>';
        } else {
            echo '<p>' . esc_html__('No products found matching your criteria.', 'kuperbush') . '</p>';
        }
    }
    
    // Get content from buffer and return it
    $content = ob_get_clean();
    echo $content;
    
    wp_die(); // Required to terminate the AJAX request properly
}

// Register AJAX actions
add_action('wp_ajax_filter_kuperbush_products', 'kuperbush_filter_products');
add_action('wp_ajax_nopriv_filter_kuperbush_products', 'kuperbush_filter_products');

/**
 * AJAX handler for loading product colors
 */
function kuperbush_load_colors() {
    // Sanitize inputs
    $exclude_id = isset($_POST['exclude']) ? intval($_POST['exclude']) : 0;
    $parent_product_id = isset($_POST['parent_product']) ? intval($_POST['parent_product']) : 0;
    
    // Initialize the output HTML
    $output = '';
    
    // Create args for query to find related color variations
    $args = array(
        'post_type' => 'kuperbush_product',
        'posts_per_page' => -1,
        'post__not_in' => array($exclude_id),
    );
    
    // If parent product is provided, query by parent meta value
    if ($parent_product_id) {
        $args['meta_query'] = array(
            array(
                'key' => 'parent_product_id',
                'value' => $parent_product_id,
                'compare' => '=',
            ),
        );
    } else {
        // Otherwise, try to find the parent ID from the excluded product
        $parent_id = get_post_meta($exclude_id, 'parent_product_id', true);
        if ($parent_id) {
            $args['meta_query'] = array(
                array(
                    'key' => 'parent_product_id',
                    'value' => $parent_id,
                    'compare' => '=',
                ),
            );
        } else {
            // If no parent found, look for products with same base model number
            $model_number = get_post_meta($exclude_id, 'model_number', true);
            if ($model_number) {
                // Strip any color-specific suffix from model number if needed
                $base_model = preg_replace('/-[a-zA-Z]+$/', '', $model_number);
                
                $args['meta_query'] = array(
                    array(
                        'key' => 'model_number',
                        'value' => $base_model,
                        'compare' => 'LIKE',
                    ),
                );
            }
        }
    }
    
    // Run the query
    $color_query = new WP_Query($args);
    
    // Process results
    if ($color_query->have_posts()) {
        while ($color_query->have_posts()) {
            $color_query->the_post();
            $product_id = get_the_ID();
            $color = get_post_meta($product_id, 'color', true);
            $model_number = get_post_meta($product_id, 'model_number', true);
            
            if ($color) {
                $output .= '<a href="' . get_permalink() . '" class="tooltip" title="' . esc_attr($color) . '">';
                $output .= '<img src="' . esc_url(get_stylesheet_directory_uri() . '/img/colors/' . sanitize_file_name(strtolower($color)) . '.svg') . '" alt="' . esc_attr($color) . '">';
                $output .= '</a>';
            }
        }
    }
    
    // Reset post data
    wp_reset_postdata();
    
    // Return the HTML
    echo $output;
    wp_die();
}

// Register AJAX actions for colors
add_action('wp_ajax_cargar_colores', 'kuperbush_load_colors');
add_action('wp_ajax_nopriv_cargar_colores', 'kuperbush_load_colors');

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