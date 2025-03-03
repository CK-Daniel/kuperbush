<?php
/**
 * The template for displaying kuperbush_product archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

get_header();
?>

<div id="main-content">
    <article class="post type-page status-publish hentry">
        <div class="entry-content">
            <div id="et-boc" class="et-boc">
                <div class="et-l">
                    <div class="et_builder_inner_content et_pb_gutters3">

                        <div id="productos-header" class="et_pb_section et_pb_section_0 et_section_regular">

                            <!-- .et_pb_row -->
                            <div id="products-header-img" class="
                            <?php
                            // Set a default background image for product categories
                            $header_image = '';
                            if (is_tax('product_category')) {
                                $term = get_queried_object();
                                // Get header image from term meta if available
                                $header_image = get_term_meta($term->term_id, 'header_image', true);
                            }
                            ?>" 
                            style="background-image: url(<?php echo esc_url($header_image ? $header_image : 'https://teka.b-cdn.net/CMP1219/1/KPH-Ovens-and-compacts-Header.jpg'); ?>);" >

                                <div class="texto_cabecera">
                                    <div class="et_pb_row">
                                        <div class="centered">
                                            <h1>
                                                <?php 
                                                    if (is_tax('product_category')) {
                                                        echo single_term_title('', false);
                                                    } elseif (is_tax('product_series')) {
                                                        echo single_term_title('', false);
                                                    } elseif (is_post_type_archive('kuperbush_product')) {
                                                        echo esc_html__('Products', 'kuperbush');
                                                    }
                                                ?>
                                            </h1>
                                            <?php
                                            // Get term description if on taxonomy page
                                            if (is_tax()) {
                                                $term_description = term_description();
                                                if (!empty($term_description)) {
                                                    echo '<p>' . $term_description . '</p>';
                                                }
                                            } elseif (is_post_type_archive('kuperbush_product')) {
                                                echo '<p>' . esc_html__('Discover our complete range of premium kitchen appliances, designed to enhance your cooking experience with cutting-edge technology and elegant design.', 'kuperbush') . '</p>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- .et_pb_section -->
                        <div id="products-container-all" class="et_pb_section et_pb_section_1 et_section_regular">

                            <div id="products-container" class="et_pb_row et_pb_row_2 et_pb_row_1-4_3-4">
                                <div id="menu_lateral" class="et_pb_column et_pb_column_1_4 et_pb_column_2 et_pb_css_mix_blend_mode_passthrough">
                                    <div class="et_pb_module et_pb_text et_pb_text_2 et_pb_bg_layout_light et_pb_text_align_left">
                                        <div class="et_pb_text_inner">

                                            <div id="product-menu-left">
                                                <span id="product-menu-main-cat" class="product-menu-main-cat-no-mobile">
                                                    <?php
                                                    if (is_tax('product_category')) {
                                                        echo single_term_title('', false);
                                                    } elseif (is_tax('product_series')) {
                                                        echo single_term_title('', false);
                                                    } elseif (is_post_type_archive('kuperbush_product')) {
                                                        echo esc_html__('Products', 'kuperbush');
                                                    }
                                                    ?>
                                                </span>
                                                <span id="product-menu-main-cat-mobile" class="product-menu-main-cat-mobile">Categories</span>
                                                <ul id='categories_menu'>
                                                    <?php
                                                    // Get all product categories
                                                    $categories = get_terms(array(
                                                        'taxonomy' => 'product_category',
                                                        'hide_empty' => true,
                                                    ));

                                                    if (!empty($categories) && !is_wp_error($categories)) {
                                                        foreach ($categories as $category) {
                                                            echo '<li class="' . (is_tax('product_category', $category->slug) ? 'active' : '') . '">';
                                                            echo '<a href="' . get_term_link($category) . '">' . $category->name . '</a>';
                                                            echo '</li>';
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                            </div>

                                            <div id="query-debug"></div>

                                        </div>
                                    </div>
                                    <div id="products-filters-mobile">
                                        <span class="products-filters-title-mobile">Filters</span>
                                        <div id="products-filters" class="et_pb_module et_pb_text et_pb_text_3 et_pb_bg_layout_light et_pb_text_align_left">
                                            <div class="et_pb_text_inner">

                                                <form action="<?php echo admin_url('admin-ajax.php'); ?>" method="POST" id="filter">
                                                    <?php if (is_tax('product_category')): ?>
                                                        <input type="hidden" id="input_referencia_de_seccion" name="referencia_de_seccion[]" value="<?php echo get_queried_object_id(); ?>" />
                                                    <?php endif; ?>
                                                    <input type="hidden" class="filter-type-of-appliance" name="type_of_appliance[]" value="" />

                                                    <?php
                                                    // Display Product Series filter
                                                    $series = get_terms(array(
                                                        'taxonomy' => 'product_series',
                                                        'hide_empty' => true,
                                                    ));
                                                    if (!empty($series) && !is_wp_error($series)): 
                                                    ?>
                                                    <div class="product-filter product-filter-product_series">
                                                        <h4 class="familia">Series</h4>
                                                        <div class="product-filter-dropdown">
                                                            <div class="childs">
                                                                <?php foreach ($series as $serie): ?>
                                                                <div class="product-filter-item">
                                                                    <input type="checkbox" id="series-<?php echo esc_attr($serie->slug); ?>" name="product_series[]" value="<?php echo esc_attr($serie->slug); ?>">
                                                                    <label for="series-<?php echo esc_attr($serie->slug); ?>"><?php echo esc_html($serie->name); ?></label>
                                                                </div>
                                                                <?php endforeach; ?>
                                                            </div>
                                                            <span>CLOSE</span>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>

                                                    <?php
                                                    // You can add more filter options here based on your custom fields
                                                    // For example, for colors, installation types, etc.
                                                    ?>

                                                    <input type="hidden" name="action" id="input_filtrar_productos" value="filter_kuperbush_products">
                                                </form>

                                            </div>
                                        </div>
                                        <div>
                                            <a id="seeMoreFilters" href="#">See more filters <i class="itk-flecha-abajo-filtros"></i></a>
                                            <a id="seeLessFilters" href="#">See less filters <i class="itk-flecha-arriba-filtros"></i></a>
                                        </div>
                                    </div>
                                    <div id="profucts-filters-inline" style="display: none;"><a href="" id="reset-filter">Reset filters</a></div>
                                </div>
                                <!-- .et_pb_column -->
                                <div id="products-container-right" class="product_grid">

                                    <div id="number-products"><span><?php echo wp_count_posts('kuperbush_product')->publish; ?></span> Products</div>
                                    <!-- .et_pb_text -->
                                    <div class="et_pb_module et_pb_products_0 et_pb_bg_layout_light et_pb_portfolio_grid clearfix">
                                        <div class="et_pb_module_inner">
                                            <div class="et_pb_ajax_pagination_container">
                                                <div class="et_pb_portfolio_grid_items product-list">
                                                    <?php
                                                    // Include mock products
                                                    include_once get_template_directory() . '/inc/mock-products.php';
                                                    
                                                    if (have_posts()) :
                                                        while (have_posts()) : the_post();
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
                                                        endwhile;
                                                    else :
                                                        // Use mock data when no real products are found
                                                        if (function_exists('kuperbush_get_mock_products')) {
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
                                                                            <img id="post-img-<?php echo esc_attr($product['id']); ?>" class="product-cat-img lozad" src="<?php echo get_stylesheet_directory_uri(); ?>/img/px.png" data-src="<?php echo esc_url($product['image']); ?>">
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
                                                        } else {
                                                            echo '<p>' . esc_html__('No products found.', 'kuperbush') . '</p>';
                                                        }
                                                    endif;
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                    // Pagination
                                    the_posts_pagination(array(
                                        'mid_size' => 2,
                                        'prev_text' => __('Previous', 'kuperbush'),
                                        'next_text' => __('Next', 'kuperbush'),
                                    ));
                                    ?>

                                </div>
                            </div>
                        </div>

                        <?php if (is_tax('product_category') || is_post_type_archive('kuperbush_product')): ?>
                        <div id="product-benefits" class="tab-content et_pb_section et_pb_section_2 et_section_regular et_pb_section_first">
                            <div class="cabecera">
                                <h2>
                                    <?php
                                    if (is_tax('product_category')) {
                                        echo single_term_title('', false);
                                    } else {
                                        echo esc_html__('Products', 'kuperbush');
                                    }
                                    ?>
                                </h2>
                            </div>
                            
                            <?php
                            // Include mock products if not already included
                            if (!function_exists('kuperbush_get_mock_benefits')) {
                                include_once get_template_directory() . '/inc/mock-products.php';
                            }
                            
                            // Here you can include category-specific benefits content
                            $term_id = 0;
                            if (is_tax()) {
                                $term = get_queried_object();
                                $term_id = $term->term_id;
                                
                                // Get benefits for this category
                                $benefits = get_term_meta($term_id, 'category_benefits', true);
                                
                                if (!$benefits && function_exists('kuperbush_get_mock_benefits')) {
                                    // If no benefits are set for this term, use mock benefits
                                    $mock_benefits = kuperbush_get_mock_benefits();
                                    if (isset($mock_benefits[$term->slug])) {
                                        $benefits = $mock_benefits[$term->slug];
                                    } elseif (isset($mock_benefits['ovens-and-compacts'])) {
                                        // Fallback to a default category if this one doesn't have mock benefits
                                        $benefits = $mock_benefits['ovens-and-compacts'];
                                    }
                                }
                                
                                if ($benefits) {
                                    foreach ($benefits as $benefit) {
                                        echo '<div class="et_pb_row et_pb_row_3 benefits-type- benefits-image-alignment- benefits-text-colour- benefits-background-colour-">';
                                        echo '<div class="product-benefits-image et_pb_column et_pb_column_5 et_pb_css_mix_blend_mode_passthrough">';
                                        echo '<div class="et_pb_module et_pb_image et_pb_image_2 et_always_center_on_mobile">';
                                        echo '<span class="et_pb_image_wrap"><img class="lozad" src="' . get_stylesheet_directory_uri() . '/img/px.png" data-src="' . esc_url($benefit['image']) . '" alt="" /></span>';
                                        echo '</div></div>';
                                        echo '<div class="product-benefits-text et_pb_column et_pb_column_6 et_pb_css_mix_blend_mode_passthrough et-last-child">';
                                        echo '<div class="et_pb_module et_pb_text et_pb_text_4 et_pb_bg_layout_light et_pb_text_align_lef">';
                                        echo '<div class="et_pb_text_inner">';
                                        echo '<h3>' . esc_html($benefit['title']) . '</h3>';
                                        echo '<span>' . wp_kses_post($benefit['description']) . '</span>';
                                        echo '</div></div></div>';
                                        echo '</div>';
                                    }
                                }
                            } else if (is_post_type_archive('kuperbush_product') && function_exists('kuperbush_get_mock_benefits')) {
                                // For main product archive, display a selection of benefits from all categories
                                $mock_benefits = kuperbush_get_mock_benefits();
                                $selected_benefits = array();
                                
                                // Get one benefit from each category
                                foreach ($mock_benefits as $category => $category_benefits) {
                                    if (isset($category_benefits[0])) {
                                        $selected_benefits[] = $category_benefits[0];
                                        if (count($selected_benefits) >= 2) {
                                            break; // Limit to 2 benefits on the main archive page
                                        }
                                    }
                                }
                                
                                if ($selected_benefits) {
                                    foreach ($selected_benefits as $benefit) {
                                        echo '<div class="et_pb_row et_pb_row_3 benefits-type- benefits-image-alignment- benefits-text-colour- benefits-background-colour-">';
                                        echo '<div class="product-benefits-image et_pb_column et_pb_column_5 et_pb_css_mix_blend_mode_passthrough">';
                                        echo '<div class="et_pb_module et_pb_image et_pb_image_2 et_always_center_on_mobile">';
                                        echo '<span class="et_pb_image_wrap"><img class="lozad" src="' . get_stylesheet_directory_uri() . '/img/px.png" data-src="' . esc_url($benefit['image']) . '" alt="" /></span>';
                                        echo '</div></div>';
                                        echo '<div class="product-benefits-text et_pb_column et_pb_column_6 et_pb_css_mix_blend_mode_passthrough et-last-child">';
                                        echo '<div class="et_pb_module et_pb_text et_pb_text_4 et_pb_bg_layout_light et_pb_text_align_lef">';
                                        echo '<div class="et_pb_text_inner">';
                                        echo '<h3>' . esc_html($benefit['title']) . '</h3>';
                                        echo '<span>' . wp_kses_post($benefit['description']) . '</span>';
                                        echo '</div></div></div>';
                                        echo '</div>';
                                    }
                                }
                            }
                            ?>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </article>
</div>

<?php
get_footer();