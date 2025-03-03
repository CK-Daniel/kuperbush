<?php
/**
 * AJAX handler for filtering Kuperbush products
 */
if (!function_exists('kuperbush_filter_products')) {
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
}

// Register AJAX actions
add_action('wp_ajax_filter_kuperbush_products', 'kuperbush_filter_products');
add_action('wp_ajax_nopriv_filter_kuperbush_products', 'kuperbush_filter_products');

/**
 * AJAX handler for loading product colors
 */
if (!function_exists('kuperbush_load_colors')) {
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
}

// Register AJAX actions for colors
add_action('wp_ajax_cargar_colores', 'kuperbush_load_colors');
add_action('wp_ajax_nopriv_cargar_colores', 'kuperbush_load_colors');