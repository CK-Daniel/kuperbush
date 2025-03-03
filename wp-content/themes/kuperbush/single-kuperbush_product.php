<?php
/**
 * The template for displaying single product pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

get_header();

// Get product data
$product_id = get_the_ID();
$model_number = get_post_meta($product_id, 'model_number', true);
$sku = get_post_meta($product_id, 'sku', true);
$color = get_post_meta($product_id, 'color', true);
$dimensions = get_post_meta($product_id, 'dimensions', true);
$price = get_post_meta($product_id, 'price', true);
$is_new = get_post_meta($product_id, 'is_new', true);

// Get product gallery images
$gallery_images = get_post_meta($product_id, 'gallery_images', true);

// Get product specifications
$specifications = get_post_meta($product_id, 'specifications', true);

// Get product documents
$documents = get_post_meta($product_id, 'documents', true);

// Get product categories and series
$product_categories = get_the_terms($product_id, 'product_category');
$product_series = get_the_terms($product_id, 'product_series');

// Get featured image
$product_image = get_the_post_thumbnail_url($product_id, 'large');
if (!$product_image) {
    $product_image = get_stylesheet_directory_uri() . '/img/placeholder.png';
}
?>

<div id="et-main-area">
    <div id="customize-product-wrapper" data-product-id="<?php echo esc_attr($product_id); ?>" style="display: none;">
        <div class="__inner">
            <div id="customize-backdrop" class="__backdrop"></div>
            <div class="__content">
                <button type="button" class="btn-close-customize" id="btn-close-customize">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.7042 10.969L8.56107 6.82467L12.7054 2.68039C13.1811 2.20462 13.1811 1.44884 12.7054 0.971944C12.2296 0.496168 11.4738 0.496168 10.9969 0.971944L6.85263 5.11622L2.70835 0.973064C2.23257 0.497288 1.47679 0.497288 0.999898 0.973064C0.524122 1.44884 0.524122 2.20462 0.999898 2.68151L5.14418 6.82467L1.00102 10.969C0.525242 11.4447 0.525242 12.2005 1.00102 12.6774C1.47679 13.1532 2.23257 13.1532 2.70947 12.6774L6.85263 8.53312L10.9969 12.6774C11.4727 13.1532 12.2285 13.1532 12.7054 12.6774C13.1811 12.2005 13.1811 11.4448 12.7043 10.969H12.7042Z" fill="#787879"/>
                    </svg>
                </button>
                <div class="show-xs">
                    <div class="__header-top">
                        <h3 class="text-gray font-13 text-transform-uppercase font-weight-bold"><?php echo esc_html($model_number); ?></h3>
                        <h5 class="font-24 text-white text-transform-uppercase font-weight-bold mb-0"><?php esc_html_e('Customize', 'kuperbush'); ?></h5>
                    </div>
                </div>
                <div class="__image">
                    <div class="image__inner">
                        <div class="__back"></div>
                        <img src="<?php echo esc_url($product_image); ?>" id="main-customized-image">
                    </div>
                </div>
                <div class="__info">
                    <div class="inner_info">
                        <div class="__top">
                            <div class="hide-xs">
                                <h3 class="text-gray font-13 text-transform-uppercase font-weight-bold"><?php echo esc_html($model_number); ?></h3>
                                <h5 class="font-24 text-white text-transform-uppercase font-weight-bold"><?php esc_html_e('Customize', 'kuperbush'); ?></h5>
                                <div class="divider10"></div>
                            </div>
                            <span class="d-block font-14"><?php esc_html_e('Choose main color', 'kuperbush'); ?></span>
                            <div id="customs-color" class="__customs __color">
                                <div class="__item item__color item__color_<?php echo esc_attr($product_id); ?> active" data-product-color-id="<?php echo esc_attr($product_id); ?>" data-product-color-ref="<?php echo esc_attr($model_number); ?>" data-product-color-title="<?php echo esc_attr(get_the_title()); ?>" data-product-color-tki="<?php echo esc_attr($sku); ?>">
                                    <div class="inner__item">
                                        <div class="__icon">
                                            <div class="__back_icon" style="background-image: url('<?php echo esc_url(get_stylesheet_directory_uri() . '/img/colors/' . sanitize_file_name($color) . '.svg'); ?>');"></div>
                                        </div>
                                        <div class="__text font-11"><?php echo esc_html($color); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="finishes-outer-wrapper">
                                <span class="d-block font-14"><?php esc_html_e('Choose finish', 'kuperbush'); ?></span>
                                <div id="customs-finish" class="__customs __finish"></div>
                            </div>
                        </div>
                        <div class="__bottom">
                            <h4 class="font-17 text-transform-uppercase font-weight-bold text-white"><?php esc_html_e('Your product', 'kuperbush'); ?></h4>
                            <div class="divider10"></div>
                            <div>
                                <span class="d-block font-12 mb-0 line-height-75"><?php esc_html_e('Product number:', 'kuperbush'); ?> <strong><span id="ref_product"><?php echo esc_html($model_number); ?></span> | <span id="tki_product"><?php echo esc_html($sku); ?></span></strong></span>
                                <span class="d-block font-12 mb-0 line-height-75"><?php esc_html_e('Finish number:', 'kuperbush'); ?> <strong><span id="ref_finish"></span> | <span id="tki_finish"></span></strong></span>
                            </div>
                            <div class="divider10"></div>
                            <div class="divider10"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="main-content">
        <article id="post-<?php echo esc_attr($product_id); ?>" <?php post_class('product type-product status-publish hentry'); ?>>
            <div class="entry-content">
                <div id="et-boc" class="et-boc">
                    <div class="et-l">
                        <div class="et_builder_inner_content et_pb_gutters3">
                            <!-- Navigation-->
                            <div id="top_product"></div>
                            <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
                                <div class="container px-5">
                                    <div class="collapse navbar-collapse" id="navbarResponsive">
                                        <ul class="menu_sticky">
                                            <li class="first_nav"><a href="#top_product"><?php echo esc_html($model_number); ?></a></li>
                                            <li class="second_nav"><a href="#caracteristicas"><?php esc_html_e('Features', 'kuperbush'); ?></a></li>
                                            <li class="second_nav"><a href="#datos_tecnicos"><?php esc_html_e('Technical data', 'kuperbush'); ?></a></li>
                                            <li class="second_nav"><a href="#accesorios"><?php esc_html_e('Accessories', 'kuperbush'); ?></a></li>
                                            <li class="second_nav"><a href="#inspiration"><?php esc_html_e('Inspiration', 'kuperbush'); ?></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                            <!-- Header-->
                            <header class="masthead text-center text-white">
                                <div class="masthead-content">
                                    <div id="imagen_producto">
                                        <div class="single-images-wrapper">
                                            <img src="<?php echo esc_url($product_image); ?>" alt="<?php echo esc_attr($model_number); ?>" id="main-image-single">
                                            <div id="contenedor_texto">
                                                <div id="texto_producto">
                                                    <?php if ($is_new) : ?>
                                                    <div class="etiqueta_nuevo">
                                                        <span class="label-new-b"><?php esc_html_e('New', 'kuperbush'); ?></span>
                                                    </div>
                                                    <?php endif; ?>
                                                    <div class="referencias"></div>
                                                    <div class="product_name">
                                                        <h1 id="product_title_"><?php the_title(); ?></h1>
                                                        <div class="ref" id="ref_current"><?php echo esc_html($model_number); ?></div>
                                                    </div>
                                                    <div class="ref_producto_acabado">
                                                        <div class="ref_header"><?php esc_html_e('Product number', 'kuperbush'); ?> <span id="ref_product_color"><?php echo esc_html($model_number); ?></span> | <span id="tki_product_color"><?php echo esc_html($sku); ?></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="galeria" id="main-gallery">
                                        <?php
                                        // Display the featured image in the gallery
                                        if ($product_image) :
                                        ?>
                                        <div class="contenedor_foto">
                                            <a data-fancybox="gallery" data-src="<?php echo esc_url($product_image); ?>">
                                                <img src="<?php echo esc_url($product_image); ?>">
                                            </a>
                                        </div>
                                        <?php
                                        endif;
                                        
                                        // Display additional gallery images
                                        if ($gallery_images && is_array($gallery_images)) :
                                            foreach ($gallery_images as $image_id) :
                                                $image_url = wp_get_attachment_image_url($image_id, 'large');
                                                $image_thumbnail = wp_get_attachment_image_url($image_id, 'thumbnail');
                                                if ($image_url) :
                                        ?>
                                        <div class="contenedor_foto">
                                            <a data-fancybox="gallery" data-src="<?php echo esc_url($image_url); ?>">
                                                <img src="<?php echo esc_url($image_thumbnail); ?>">
                                            </a>
                                        </div>
                                        <?php
                                                endif;
                                            endforeach;
                                        endif;
                                        ?>
                                    </div>
                                </div>
                                <div class="fix_galeria"></div>
                            </header>
                            <div id="kupper-product-content">
                                <div id="caracteristicas" class="producto-ancla"></div>
                                <div class="cabecera">
                                    <h2><?php esc_html_e('Features', 'kuperbush'); ?></h2>
                                </div>
                                
                                <?php 
                                // Get the product content
                                the_content();
                                
                                // Product Benefits/Features Section
                                ?>
                                
                                <div id="product-benefits" class="tab-content et_pb_section et_pb_section_2 et_section_regular">
                                    <?php
                                    // Display custom feature sections if available
                                    $features = get_post_meta($product_id, 'product_features', true);
                                    if ($features && is_array($features)) :
                                        foreach ($features as $index => $feature) :
                                            $alignment = ($index % 2 == 0) ? 'left' : 'right';
                                    ?>
                                    <div class="et_pb_row et_pb_equal_columns benefits-type-image benefits-image-alignment-<?php echo esc_attr($alignment); ?> benefits-text-colour- benefits-background-colour-">
                                        <?php if ($alignment === 'left') : ?>
                                        <div class="product-benefits-text et_pb_column et_pb_column_1_2">
                                            <div class="et_pb_module et_pb_text et_pb_bg_layout_light et_pb_text_align_left">
                                                <div class="et_pb_text_inner">
                                                    <h3><?php echo esc_html($feature['title']); ?></h3>
                                                    <span><?php echo wp_kses_post($feature['description']); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-benefits-image et_pb_column et_pb_column_1_2">
                                            <div class="et_pb_module et_pb_image et_always_center_on_mobile">
                                                <span class="et_pb_image_wrap">
                                                    <img class="lozad" src="<?php echo get_stylesheet_directory_uri(); ?>/img/px.png" data-src="<?php echo esc_url($feature['image']); ?>" alt="<?php echo esc_attr($feature['title']); ?>" />
                                                </span>
                                            </div>
                                        </div>
                                        <?php else : ?>
                                        <div class="product-benefits-text et_pb_column et_pb_column_1_2">
                                            <div class="et_pb_module et_pb_text et_pb_bg_layout_light et_pb_text_align_left">
                                                <div class="et_pb_text_inner">
                                                    <h3><?php echo esc_html($feature['title']); ?></h3>
                                                    <span><?php echo wp_kses_post($feature['description']); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-benefits-image et_pb_column et_pb_column_1_2">
                                            <div class="et_pb_module et_pb_image et_always_center_on_mobile">
                                                <span class="et_pb_image_wrap">
                                                    <img class="lozad" src="<?php echo get_stylesheet_directory_uri(); ?>/img/px.png" data-src="<?php echo esc_url($feature['image']); ?>" alt="<?php echo esc_attr($feature['title']); ?>" />
                                                </span>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php 
                                        endforeach;
                                    endif;
                                    ?>
                                </div>
                                <div id="product-features" class="tab-content et_pb_section et_pb_section_3 et_section_regular">
                                    <div id="datos_tecnicos" class="producto-ancla"></div>
                                    <div class="cabecera">
                                        <h2><?php esc_html_e('Technical data', 'kuperbush'); ?></h2>
                                    </div>
                                    <div id="product-features-description" class="et_pb_row">
                                        <div class="et_pb_column et_pb_column_1_4">
                                            <img src="<?php echo esc_url($product_image); ?>" alt="<?php echo esc_attr($model_number); ?>" loading="lazy">
                                        </div>
                                        <div class="et_pb_column et_pb_column_3_4 et-last-child">
                                            <h2><?php echo esc_html($model_number); ?></h2>
                                            <h3><?php the_title(); ?></h3>
                                            <?php the_excerpt(); ?>
                                        </div>
                                    </div>
                                    <div class="et_pb_row et_pb_row_4">
                                        <div class="et_pb_column et_pb_column_4_4 et_pb_column_7 et_pb_css_mix_blend_mode_passthrough et-last-child">
                                            <div id="download">
                                                <div class="btn_down">
                                                    <?php
                                                    // Display product documents if available
                                                    if ($documents && is_array($documents)) :
                                                        foreach ($documents as $doc) :
                                                            if (isset($doc['url']) && isset($doc['title'])) :
                                                    ?>
                                                    <div class="download-container <?php echo esc_attr(sanitize_title($doc['title'])); ?>">
                                                        <strong>
                                                            <a rel="nofollow" href="<?php echo esc_url($doc['url']); ?>" data-fancybox="gallery-<?php echo esc_attr(sanitize_title($doc['title'])); ?>">
                                                                <strong><?php echo esc_html($doc['title']); ?></strong>
                                                            </a>
                                                        </strong>
                                                    </div>
                                                    <?php
                                                            endif;
                                                        endforeach;
                                                    endif;
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="outer">
                                                <?php if ($specifications && is_array($specifications) && !empty($specifications['features'])) : ?>
                                                <details>
                                                    <summary><?php esc_html_e('Features', 'kuperbush'); ?></summary>
                                                    <div class="detail-content">
                                                        <ul>
                                                            <?php foreach ($specifications['features'] as $feature) : ?>
                                                            <li><?php echo esc_html($feature); ?></li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </div>
                                                </details>
                                                <?php endif; ?>
                                                
                                                <?php if ($specifications && is_array($specifications) && !empty($specifications['dimensions'])) : ?>
                                                <details>
                                                    <summary><?php esc_html_e('Dimensions', 'kuperbush'); ?></summary>
                                                    <div class="detail-content">
                                                        <div>
                                                            <h4><?php esc_html_e('Internal dimensions', 'kuperbush'); ?></h4>
                                                            <ul>
                                                                <?php foreach ($specifications['dimensions']['internal'] as $key => $value) : ?>
                                                                <li><strong><?php echo esc_html($key); ?>:</strong> <?php echo esc_html($value); ?></li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        </div>
                                                        <div>
                                                            <h4><?php esc_html_e('Overall dimensions', 'kuperbush'); ?></h4>
                                                            <ul>
                                                                <?php foreach ($specifications['dimensions']['overall'] as $key => $value) : ?>
                                                                <li><strong><?php echo esc_html($key); ?>:</strong> <?php echo esc_html($value); ?></li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </details>
                                                <?php endif; ?>
                                                
                                                <?php if ($specifications && is_array($specifications) && !empty($specifications['electrical'])) : ?>
                                                <details>
                                                    <summary><?php esc_html_e('Electrical connection', 'kuperbush'); ?></summary>
                                                    <div class="detail-content">
                                                        <div>
                                                            <h4><?php esc_html_e('Electrical connection', 'kuperbush'); ?></h4>
                                                            <ul>
                                                                <?php foreach ($specifications['electrical'] as $key => $value) : ?>
                                                                <li><strong><?php echo esc_html($key); ?>:</strong> <?php echo esc_html($value); ?></li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </details>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div id="inspiration" class="producto-ancla"></div>
                                    <?php
                                    // Display inspiration/ambient images
                                    $ambient_images = get_post_meta($product_id, 'ambient_images', true);
                                    if ($ambient_images && is_array($ambient_images) && !empty($ambient_images)) :
                                    ?>
                                    <div id="ambient-products" class="et_pb_section">
                                        <div class="et_pb_row">
                                            <div class="cabecera">
                                                <h2><?php esc_html_e('Inspiration', 'kuperbush'); ?></h2>
                                            </div>
                                            <div id="ambient-gallery">
                                                <div id="ambient-gallery-main">
                                                    <a data-fancybox="ambient" data-src="<?php echo esc_url($ambient_images[0]['large']); ?>">
                                                        <img src="<?php echo esc_url($ambient_images[0]['medium']); ?>" loading="lazy" />
                                                    </a>
                                                </div>
                                                <div id="ambient-gallery-sidebar">
                                                    <?php
                                                    // Skip the first image as it's shown above
                                                    $remaining_images = array_slice($ambient_images, 1);
                                                    foreach ($remaining_images as $image) :
                                                    ?>
                                                    <div class="ambient-gallery-item">
                                                        <a data-fancybox="ambient" data-src="<?php echo esc_url($image['large']); ?>">
                                                            <img src="<?php echo esc_url($image['thumbnail']); ?>" loading="lazy" />
                                                        </a>
                                                    </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <div id="accesorios"></div>
                                    <div class="cabecera">
                                        <h2><?php esc_html_e('Related Products', 'kuperbush'); ?></h2>
                                    </div>
                                    <div class="et_pb_row et_pb_row_6">
                                        <div id="product-related-products-slider" class="related-product-slider">
                                            <div class="et_pb_module et_pb_products_2 et_pb_bg_layout_light et_pb_portfolio_grid clearfix">
                                                <div class="et_pb_module_inner">
                                                    <div class="et_pb_ajax_pagination_container">
                                                        <div class="et_pb_portfolio_grid_items product-list">
                                                            <?php
                                                            // Get related products based on category and series
                                                            $related_args = array(
                                                                'post_type' => 'kuperbush_product',
                                                                'posts_per_page' => 10,
                                                                'post__not_in' => array($product_id),
                                                            );
                                                            
                                                            // Add taxonomy relationships
                                                            $tax_query = array('relation' => 'OR');
                                                            
                                                            if ($product_categories) {
                                                                $category_ids = wp_list_pluck($product_categories, 'term_id');
                                                                $tax_query[] = array(
                                                                    'taxonomy' => 'product_category',
                                                                    'field' => 'term_id',
                                                                    'terms' => $category_ids,
                                                                );
                                                            }
                                                            
                                                            if ($product_series) {
                                                                $series_ids = wp_list_pluck($product_series, 'term_id');
                                                                $tax_query[] = array(
                                                                    'taxonomy' => 'product_series',
                                                                    'field' => 'term_id',
                                                                    'terms' => $series_ids,
                                                                );
                                                            }
                                                            
                                                            if (count($tax_query) > 1) {
                                                                $related_args['tax_query'] = $tax_query;
                                                            }
                                                            
                                                            $related_query = new WP_Query($related_args);
                                                            
                                                            if ($related_query->have_posts()) :
                                                                while ($related_query->have_posts()) : $related_query->the_post();
                                                                    $related_id = get_the_ID();
                                                                    $related_model_number = get_post_meta($related_id, 'model_number', true);
                                                                    $related_sku = get_post_meta($related_id, 'sku', true);
                                                                    $related_color = get_post_meta($related_id, 'color', true);
                                                                    $related_is_new = get_post_meta($related_id, 'is_new', true);
                                                                    
                                                                    // Featured image
                                                                    $related_image = get_the_post_thumbnail_url($related_id, 'medium');
                                                                    if (!$related_image) {
                                                                        $related_image = get_stylesheet_directory_uri() . '/img/placeholder.png';
                                                                    }
                                                            ?>
                                                            <div id="post-<?php echo esc_attr($related_id); ?>" class="post-<?php echo esc_attr($related_id); ?> product type-product status-publish hentry et_pb_portfolio_item et_pb_grid_item">
                                                                <?php if ($related_is_new) : ?>
                                                                <span class="label-new-b"><?php esc_html_e('New', 'kuperbush'); ?></span>
                                                                <?php endif; ?>
                                                                
                                                                <div class="product-cat-img-container">
                                                                    <?php if ($related_is_new) : ?>
                                                                    <span class="label-fix"><?php esc_html_e('New', 'kuperbush'); ?></span>
                                                                    <?php endif; ?>
                                                                    <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr($related_model_number ? $related_model_number : get_the_title()); ?>">
                                                                        <img id="post-img-<?php echo esc_attr($related_id); ?>" class="product-cat-img lozad" src="<?php echo get_stylesheet_directory_uri(); ?>/img/px.png" data-src="<?php echo esc_url($related_image); ?>">
                                                                    </a>
                                                                </div>
                                                                
                                                                <div class="product-cat-info">
                                                                    <div class="productCat">
                                                                        <a><?php echo esc_html($related_model_number ? $related_model_number : get_the_title()); ?></a>
                                                                    </div>
                                                                    <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr($related_model_number ? $related_model_number : get_the_title()); ?>">
                                                                        <strong class="productCatLargeName"><?php the_title(); ?></strong>
                                                                    </a>
                                                                    
                                                                    <div class="product-list-footer">
                                                                        <?php if ($related_color) : ?>
                                                                        <div class="product-list-colors"><?php esc_html_e('Color', 'kuperbush'); ?> 
                                                                            <img class="tooltip" src="<?php echo esc_url(get_stylesheet_directory_uri() . '/img/colors/' . sanitize_file_name($related_color) . '.svg'); ?>" alt="<?php echo esc_attr($related_color); ?>" title="<?php echo esc_attr($related_color); ?>" data-exclude="<?php echo esc_attr($related_id); ?>" data-parent_product="">
                                                                            <div class="other-colors"></div>
                                                                        </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    
                                                                    <div class="product-list-description">
                                                                        <a class="teka-button" href="<?php the_permalink(); ?>"><?php esc_html_e('+ Details', 'kuperbush'); ?></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                                endwhile;
                                                                wp_reset_postdata();
                                                            else :
                                                                echo '<p>' . esc_html__('No related products found.', 'kuperbush') . '</p>';
                                                            endif;
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</div>

<?php
get_footer();