<?php
/**
 * Kuperbush Products Custom Post Type
 *
 * This file registers a custom post type for products
 * and related taxonomies for better organization.
 *
 * @package WordPress
 * @subpackage Kuperbush
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register the Product custom post type
 */
function kuperbush_register_product_post_type() {
    $labels = array(
        'name'                  => _x('Products', 'Post type general name', 'kuperbush'),
        'singular_name'         => _x('Product', 'Post type singular name', 'kuperbush'),
        'menu_name'             => _x('Products', 'Admin Menu text', 'kuperbush'),
        'name_admin_bar'        => _x('Product', 'Add New on Toolbar', 'kuperbush'),
        'add_new'               => __('Add New', 'kuperbush'),
        'add_new_item'          => __('Add New Product', 'kuperbush'),
        'new_item'              => __('New Product', 'kuperbush'),
        'edit_item'             => __('Edit Product', 'kuperbush'),
        'view_item'             => __('View Product', 'kuperbush'),
        'all_items'             => __('All Products', 'kuperbush'),
        'search_items'          => __('Search Products', 'kuperbush'),
        'parent_item_colon'     => __('Parent Products:', 'kuperbush'),
        'not_found'             => __('No products found.', 'kuperbush'),
        'not_found_in_trash'    => __('No products found in Trash.', 'kuperbush'),
        'featured_image'        => _x('Product Cover Image', 'Overrides the "Featured Image" phrase', 'kuperbush'),
        'set_featured_image'    => _x('Set cover image', 'Overrides the "Set featured image" phrase', 'kuperbush'),
        'remove_featured_image' => _x('Remove cover image', 'Overrides the "Remove featured image" phrase', 'kuperbush'),
        'use_featured_image'    => _x('Use as cover image', 'Overrides the "Use as featured image" phrase', 'kuperbush'),
        'archives'              => _x('Product archives', 'The post type archive label used in nav menus', 'kuperbush'),
        'insert_into_item'      => _x('Insert into product', 'Overrides the "Insert into post" phrase', 'kuperbush'),
        'uploaded_to_this_item' => _x('Uploaded to this product', 'Overrides the "Uploaded to this post" phrase', 'kuperbush'),
        'filter_items_list'     => _x('Filter products list', 'Screen reader text for the filter links', 'kuperbush'),
        'items_list_navigation' => _x('Products list navigation', 'Screen reader text for the pagination', 'kuperbush'),
        'items_list'            => _x('Products list', 'Screen reader text for the items list', 'kuperbush'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'product'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-products',
        'supports'           => array(
            'title',
            'editor',
            'author',
            'thumbnail',
            'excerpt',
            'custom-fields',
            'revisions',
        ),
        'show_in_rest'       => true,
        'taxonomies'         => array('product_category', 'product_tag'),
    );

    register_post_type('kuperbush_product', $args);
}
add_action('init', 'kuperbush_register_product_post_type');

/**
 * Register Product Category taxonomy
 */
function kuperbush_register_product_category_taxonomy() {
    $labels = array(
        'name'                       => _x('Product Categories', 'Taxonomy general name', 'kuperbush'),
        'singular_name'              => _x('Product Category', 'Taxonomy singular name', 'kuperbush'),
        'search_items'               => __('Search Product Categories', 'kuperbush'),
        'popular_items'              => __('Popular Product Categories', 'kuperbush'),
        'all_items'                  => __('All Product Categories', 'kuperbush'),
        'parent_item'                => __('Parent Product Category', 'kuperbush'),
        'parent_item_colon'          => __('Parent Product Category:', 'kuperbush'),
        'edit_item'                  => __('Edit Product Category', 'kuperbush'),
        'update_item'                => __('Update Product Category', 'kuperbush'),
        'add_new_item'               => __('Add New Product Category', 'kuperbush'),
        'new_item_name'              => __('New Product Category Name', 'kuperbush'),
        'separate_items_with_commas' => __('Separate product categories with commas', 'kuperbush'),
        'add_or_remove_items'        => __('Add or remove product categories', 'kuperbush'),
        'choose_from_most_used'      => __('Choose from the most used product categories', 'kuperbush'),
        'not_found'                  => __('No product categories found.', 'kuperbush'),
        'menu_name'                  => __('Product Categories', 'kuperbush'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'product-category'),
        'show_in_rest'      => true,
    );

    register_taxonomy('product_category', 'kuperbush_product', $args);
}
add_action('init', 'kuperbush_register_product_category_taxonomy');

/**
 * Register Product Tag taxonomy
 */
function kuperbush_register_product_tag_taxonomy() {
    $labels = array(
        'name'                       => _x('Product Tags', 'Taxonomy general name', 'kuperbush'),
        'singular_name'              => _x('Product Tag', 'Taxonomy singular name', 'kuperbush'),
        'search_items'               => __('Search Product Tags', 'kuperbush'),
        'popular_items'              => __('Popular Product Tags', 'kuperbush'),
        'all_items'                  => __('All Product Tags', 'kuperbush'),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __('Edit Product Tag', 'kuperbush'),
        'update_item'                => __('Update Product Tag', 'kuperbush'),
        'add_new_item'               => __('Add New Product Tag', 'kuperbush'),
        'new_item_name'              => __('New Product Tag Name', 'kuperbush'),
        'separate_items_with_commas' => __('Separate product tags with commas', 'kuperbush'),
        'add_or_remove_items'        => __('Add or remove product tags', 'kuperbush'),
        'choose_from_most_used'      => __('Choose from the most used product tags', 'kuperbush'),
        'not_found'                  => __('No product tags found.', 'kuperbush'),
        'menu_name'                  => __('Product Tags', 'kuperbush'),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'product-tag'),
        'show_in_rest'      => true,
    );

    register_taxonomy('product_tag', 'kuperbush_product', $args);
}
add_action('init', 'kuperbush_register_product_tag_taxonomy');

/**
 * Register Product Series taxonomy (for K-series, etc.)
 */
function kuperbush_register_product_series_taxonomy() {
    $labels = array(
        'name'                       => _x('Product Series', 'Taxonomy general name', 'kuperbush'),
        'singular_name'              => _x('Product Series', 'Taxonomy singular name', 'kuperbush'),
        'search_items'               => __('Search Product Series', 'kuperbush'),
        'popular_items'              => __('Popular Product Series', 'kuperbush'),
        'all_items'                  => __('All Product Series', 'kuperbush'),
        'parent_item'                => __('Parent Product Series', 'kuperbush'),
        'parent_item_colon'          => __('Parent Product Series:', 'kuperbush'),
        'edit_item'                  => __('Edit Product Series', 'kuperbush'),
        'update_item'                => __('Update Product Series', 'kuperbush'),
        'add_new_item'               => __('Add New Product Series', 'kuperbush'),
        'new_item_name'              => __('New Product Series Name', 'kuperbush'),
        'separate_items_with_commas' => __('Separate product series with commas', 'kuperbush'),
        'add_or_remove_items'        => __('Add or remove product series', 'kuperbush'),
        'choose_from_most_used'      => __('Choose from the most used product series', 'kuperbush'),
        'not_found'                  => __('No product series found.', 'kuperbush'),
        'menu_name'                  => __('Product Series', 'kuperbush'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'product-series'),
        'show_in_rest'      => true,
    );

    register_taxonomy('product_series', 'kuperbush_product', $args);
}
add_action('init', 'kuperbush_register_product_series_taxonomy');

/**
 * Add custom meta boxes for product details
 */
function kuperbush_add_product_meta_boxes() {
    add_meta_box(
        'kuperbush_product_details',
        __('Product Details', 'kuperbush'),
        'kuperbush_product_details_meta_box_callback',
        'kuperbush_product',
        'normal',
        'high'
    );

    add_meta_box(
        'kuperbush_product_specifications',
        __('Product Specifications', 'kuperbush'),
        'kuperbush_product_specifications_meta_box_callback',
        'kuperbush_product',
        'normal',
        'high'
    );

    add_meta_box(
        'kuperbush_product_gallery',
        __('Product Gallery', 'kuperbush'),
        'kuperbush_product_gallery_meta_box_callback',
        'kuperbush_product',
        'normal',
        'high'
    );

    add_meta_box(
        'kuperbush_product_documents',
        __('Product Documents', 'kuperbush'),
        'kuperbush_product_documents_meta_box_callback',
        'kuperbush_product',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'kuperbush_add_product_meta_boxes');

/**
 * Product Details meta box callback
 */
function kuperbush_product_details_meta_box_callback($post) {
    // Add nonce for security
    wp_nonce_field('kuperbush_product_details_nonce', 'kuperbush_product_details_nonce');

    // Get current values
    $model_number = get_post_meta($post->ID, '_product_model_number', true);
    $sku = get_post_meta($post->ID, '_product_sku', true);
    $color = get_post_meta($post->ID, '_product_color', true);
    $design_line = get_post_meta($post->ID, '_product_design_line', true);
    $dimensions = get_post_meta($post->ID, '_product_dimensions', true);
    $energy_rating = get_post_meta($post->ID, '_product_energy_rating', true);
    $price = get_post_meta($post->ID, '_product_price', true);
    
    // Output fields
    ?>
    <p>
        <label for="product_model_number"><?php _e('Model Number:', 'kuperbush'); ?></label>
        <input type="text" id="product_model_number" name="product_model_number" value="<?php echo esc_attr($model_number); ?>" class="widefat">
    </p>
    <p>
        <label for="product_sku"><?php _e('SKU:', 'kuperbush'); ?></label>
        <input type="text" id="product_sku" name="product_sku" value="<?php echo esc_attr($sku); ?>" class="widefat">
    </p>
    <p>
        <label for="product_color"><?php _e('Color:', 'kuperbush'); ?></label>
        <input type="text" id="product_color" name="product_color" value="<?php echo esc_attr($color); ?>" class="widefat">
    </p>
    <p>
        <label for="product_design_line"><?php _e('Design Line:', 'kuperbush'); ?></label>
        <input type="text" id="product_design_line" name="product_design_line" value="<?php echo esc_attr($design_line); ?>" class="widefat">
    </p>
    <p>
        <label for="product_dimensions"><?php _e('Dimensions (W x H x D):', 'kuperbush'); ?></label>
        <input type="text" id="product_dimensions" name="product_dimensions" value="<?php echo esc_attr($dimensions); ?>" class="widefat">
    </p>
    <p>
        <label for="product_energy_rating"><?php _e('Energy Rating:', 'kuperbush'); ?></label>
        <input type="text" id="product_energy_rating" name="product_energy_rating" value="<?php echo esc_attr($energy_rating); ?>" class="widefat">
    </p>
    <p>
        <label for="product_price"><?php _e('Price:', 'kuperbush'); ?></label>
        <input type="text" id="product_price" name="product_price" value="<?php echo esc_attr($price); ?>" class="widefat">
    </p>
    <?php
}

/**
 * Product Specifications meta box callback
 */
function kuperbush_product_specifications_meta_box_callback($post) {
    // Add nonce for security
    wp_nonce_field('kuperbush_product_specs_nonce', 'kuperbush_product_specs_nonce');

    // Get current values
    $specs = get_post_meta($post->ID, '_product_specifications', true);
    
    if (!is_array($specs)) {
        $specs = array();
    }
    
    // Output fields
    ?>
    <div id="product-specs-container">
        <?php 
        if (!empty($specs)) {
            foreach ($specs as $i => $spec) {
                ?>
                <div class="spec-row">
                    <p>
                        <label for="spec_name_<?php echo $i; ?>"><?php _e('Specification Name:', 'kuperbush'); ?></label>
                        <input type="text" id="spec_name_<?php echo $i; ?>" name="spec_name[]" value="<?php echo esc_attr($spec['name']); ?>" class="widefat">
                    </p>
                    <p>
                        <label for="spec_value_<?php echo $i; ?>"><?php _e('Specification Value:', 'kuperbush'); ?></label>
                        <input type="text" id="spec_value_<?php echo $i; ?>" name="spec_value[]" value="<?php echo esc_attr($spec['value']); ?>" class="widefat">
                    </p>
                    <button type="button" class="button remove-spec"><?php _e('Remove', 'kuperbush'); ?></button>
                </div>
                <?php
            }
        } else {
            // Add a default empty row
            ?>
            <div class="spec-row">
                <p>
                    <label for="spec_name_0"><?php _e('Specification Name:', 'kuperbush'); ?></label>
                    <input type="text" id="spec_name_0" name="spec_name[]" value="" class="widefat">
                </p>
                <p>
                    <label for="spec_value_0"><?php _e('Specification Value:', 'kuperbush'); ?></label>
                    <input type="text" id="spec_value_0" name="spec_value[]" value="" class="widefat">
                </p>
                <button type="button" class="button remove-spec"><?php _e('Remove', 'kuperbush'); ?></button>
            </div>
            <?php
        }
        ?>
    </div>
    <p>
        <button type="button" class="button add-spec"><?php _e('Add Specification', 'kuperbush'); ?></button>
    </p>

    <script>
    jQuery(document).ready(function($) {
        // Add new specification row
        $('.add-spec').on('click', function() {
            var index = $('.spec-row').length;
            var newRow = `
                <div class="spec-row">
                    <p>
                        <label for="spec_name_${index}"><?php _e('Specification Name:', 'kuperbush'); ?></label>
                        <input type="text" id="spec_name_${index}" name="spec_name[]" value="" class="widefat">
                    </p>
                    <p>
                        <label for="spec_value_${index}"><?php _e('Specification Value:', 'kuperbush'); ?></label>
                        <input type="text" id="spec_value_${index}" name="spec_value[]" value="" class="widefat">
                    </p>
                    <button type="button" class="button remove-spec"><?php _e('Remove', 'kuperbush'); ?></button>
                </div>
            `;
            $('#product-specs-container').append(newRow);
        });

        // Remove specification row
        $(document).on('click', '.remove-spec', function() {
            if ($('.spec-row').length > 1) {
                $(this).closest('.spec-row').remove();
            } else {
                // Clear values if it's the last row
                $(this).closest('.spec-row').find('input').val('');
            }
        });
    });
    </script>
    <?php
}

/**
 * Product Gallery meta box callback
 */
function kuperbush_product_gallery_meta_box_callback($post) {
    // Add nonce for security
    wp_nonce_field('kuperbush_product_gallery_nonce', 'kuperbush_product_gallery_nonce');

    // Get current gallery images
    $gallery_images = get_post_meta($post->ID, '_product_gallery', true);
    
    ?>
    <div id="product-gallery-container">
        <input type="hidden" id="product_gallery" name="product_gallery" value="<?php echo esc_attr($gallery_images); ?>" class="widefat">
        <div id="product-gallery-preview">
            <?php
            if (!empty($gallery_images)) {
                $image_ids = explode(',', $gallery_images);
                foreach ($image_ids as $image_id) {
                    if ($image_id) {
                        echo '<div class="gallery-image-preview">';
                        echo wp_get_attachment_image($image_id, 'thumbnail');
                        echo '</div>';
                    }
                }
            }
            ?>
        </div>
        <p>
            <button type="button" class="button upload-gallery-images"><?php _e('Add Gallery Images', 'kuperbush'); ?></button>
        </p>
    </div>

    <script>
    jQuery(document).ready(function($) {
        // Initialize media uploader
        var file_frame;
        $('.upload-gallery-images').on('click', function(e) {
            e.preventDefault();
            
            // If the media frame already exists, reopen it
            if (file_frame) {
                file_frame.open();
                return;
            }
            
            // Create the media frame
            file_frame = wp.media.frames.file_frame = wp.media({
                title: '<?php _e('Select Product Gallery Images', 'kuperbush'); ?>',
                button: {
                    text: '<?php _e('Add to Gallery', 'kuperbush'); ?>'
                },
                multiple: true
            });
            
            // When images are selected
            file_frame.on('select', function() {
                var selection = file_frame.state().get('selection');
                var imageIds = $('#product_gallery').val();
                var imageIdsArray = imageIds ? imageIds.split(',') : [];
                
                selection.map(function(attachment) {
                    attachment = attachment.toJSON();
                    
                    // Add to image IDs array if not already included
                    if ($.inArray(attachment.id.toString(), imageIdsArray) === -1) {
                        imageIdsArray.push(attachment.id);
                        
                        // Add preview
                        $('#product-gallery-preview').append(
                            '<div class="gallery-image-preview">' +
                            '<img src="' + attachment.sizes.thumbnail.url + '" alt="">' +
                            '</div>'
                        );
                    }
                });
                
                // Update the hidden field value
                $('#product_gallery').val(imageIdsArray.join(','));
            });
            
            // Finally, open the modal
            file_frame.open();
        });
    });
    </script>
    <style>
    #product-gallery-preview {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 10px;
    }
    .gallery-image-preview {
        width: 100px;
        height: 100px;
        overflow: hidden;
        border: 1px solid #ddd;
    }
    .gallery-image-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    </style>
    <?php
}

/**
 * Product Documents meta box callback
 */
function kuperbush_product_documents_meta_box_callback($post) {
    // Add nonce for security
    wp_nonce_field('kuperbush_product_documents_nonce', 'kuperbush_product_documents_nonce');

    // Get current documents
    $documents = get_post_meta($post->ID, '_product_documents', true);
    
    if (!is_array($documents)) {
        $documents = array();
    }
    
    // Output fields
    ?>
    <div id="product-documents-container">
        <?php 
        if (!empty($documents)) {
            foreach ($documents as $i => $doc) {
                ?>
                <div class="document-row">
                    <p>
                        <label for="document_title_<?php echo $i; ?>"><?php _e('Document Title:', 'kuperbush'); ?></label>
                        <input type="text" id="document_title_<?php echo $i; ?>" name="document_title[]" value="<?php echo esc_attr($doc['title']); ?>" class="widefat">
                    </p>
                    <p>
                        <label for="document_file_<?php echo $i; ?>"><?php _e('Document File:', 'kuperbush'); ?></label>
                        <input type="text" id="document_file_<?php echo $i; ?>" name="document_file[]" value="<?php echo esc_attr($doc['file']); ?>" class="widefat document-url-field" readonly>
                        <input type="hidden" name="document_id[]" value="<?php echo esc_attr($doc['id']); ?>" class="document-id-field">
                        <button type="button" class="button upload-document"><?php _e('Select File', 'kuperbush'); ?></button>
                    </p>
                    <button type="button" class="button remove-document"><?php _e('Remove', 'kuperbush'); ?></button>
                </div>
                <?php
            }
        } else {
            // Add a default empty row
            ?>
            <div class="document-row">
                <p>
                    <label for="document_title_0"><?php _e('Document Title:', 'kuperbush'); ?></label>
                    <input type="text" id="document_title_0" name="document_title[]" value="" class="widefat">
                </p>
                <p>
                    <label for="document_file_0"><?php _e('Document File:', 'kuperbush'); ?></label>
                    <input type="text" id="document_file_0" name="document_file[]" value="" class="widefat document-url-field" readonly>
                    <input type="hidden" name="document_id[]" value="" class="document-id-field">
                    <button type="button" class="button upload-document"><?php _e('Select File', 'kuperbush'); ?></button>
                </p>
                <button type="button" class="button remove-document"><?php _e('Remove', 'kuperbush'); ?></button>
            </div>
            <?php
        }
        ?>
    </div>
    <p>
        <button type="button" class="button add-document"><?php _e('Add Document', 'kuperbush'); ?></button>
    </p>

    <script>
    jQuery(document).ready(function($) {
        // Add new document row
        $('.add-document').on('click', function() {
            var index = $('.document-row').length;
            var newRow = `
                <div class="document-row">
                    <p>
                        <label for="document_title_${index}"><?php _e('Document Title:', 'kuperbush'); ?></label>
                        <input type="text" id="document_title_${index}" name="document_title[]" value="" class="widefat">
                    </p>
                    <p>
                        <label for="document_file_${index}"><?php _e('Document File:', 'kuperbush'); ?></label>
                        <input type="text" id="document_file_${index}" name="document_file[]" value="" class="widefat document-url-field" readonly>
                        <input type="hidden" name="document_id[]" value="" class="document-id-field">
                        <button type="button" class="button upload-document"><?php _e('Select File', 'kuperbush'); ?></button>
                    </p>
                    <button type="button" class="button remove-document"><?php _e('Remove', 'kuperbush'); ?></button>
                </div>
            `;
            $('#product-documents-container').append(newRow);
        });

        // Remove document row
        $(document).on('click', '.remove-document', function() {
            if ($('.document-row').length > 1) {
                $(this).closest('.document-row').remove();
            } else {
                // Clear values if it's the last row
                $(this).closest('.document-row').find('input').val('');
            }
        });

        // Upload document
        $(document).on('click', '.upload-document', function() {
            var button = $(this);
            var documentRow = button.closest('.document-row');
            var documentUrlField = documentRow.find('.document-url-field');
            var documentIdField = documentRow.find('.document-id-field');
            
            var file_frame = wp.media.frames.file_frame = wp.media({
                title: '<?php _e('Select Document', 'kuperbush'); ?>',
                button: {
                    text: '<?php _e('Select', 'kuperbush'); ?>'
                },
                multiple: false
            });
            
            file_frame.on('select', function() {
                var attachment = file_frame.state().get('selection').first().toJSON();
                documentUrlField.val(attachment.url);
                documentIdField.val(attachment.id);
            });
            
            file_frame.open();
        });
    });
    </script>
    <?php
}

/**
 * Save product meta data
 */
function kuperbush_save_product_meta($post_id) {
    // Check if our nonces are set and verify them
    if (!isset($_POST['kuperbush_product_details_nonce']) || 
        !wp_verify_nonce($_POST['kuperbush_product_details_nonce'], 'kuperbush_product_details_nonce') ||
        !isset($_POST['kuperbush_product_specs_nonce']) || 
        !wp_verify_nonce($_POST['kuperbush_product_specs_nonce'], 'kuperbush_product_specs_nonce') ||
        !isset($_POST['kuperbush_product_gallery_nonce']) || 
        !wp_verify_nonce($_POST['kuperbush_product_gallery_nonce'], 'kuperbush_product_gallery_nonce') ||
        !isset($_POST['kuperbush_product_documents_nonce']) || 
        !wp_verify_nonce($_POST['kuperbush_product_documents_nonce'], 'kuperbush_product_documents_nonce')) {
        return;
    }

    // Check if this is an autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check the user's permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save Product Details
    if (isset($_POST['product_model_number'])) {
        update_post_meta($post_id, '_product_model_number', sanitize_text_field($_POST['product_model_number']));
    }
    
    if (isset($_POST['product_sku'])) {
        update_post_meta($post_id, '_product_sku', sanitize_text_field($_POST['product_sku']));
    }
    
    if (isset($_POST['product_color'])) {
        update_post_meta($post_id, '_product_color', sanitize_text_field($_POST['product_color']));
    }
    
    if (isset($_POST['product_design_line'])) {
        update_post_meta($post_id, '_product_design_line', sanitize_text_field($_POST['product_design_line']));
    }
    
    if (isset($_POST['product_dimensions'])) {
        update_post_meta($post_id, '_product_dimensions', sanitize_text_field($_POST['product_dimensions']));
    }
    
    if (isset($_POST['product_energy_rating'])) {
        update_post_meta($post_id, '_product_energy_rating', sanitize_text_field($_POST['product_energy_rating']));
    }
    
    if (isset($_POST['product_price'])) {
        update_post_meta($post_id, '_product_price', sanitize_text_field($_POST['product_price']));
    }

    // Save Product Specifications
    if (isset($_POST['spec_name']) && isset($_POST['spec_value'])) {
        $specs = array();
        
        foreach ($_POST['spec_name'] as $i => $name) {
            if (!empty($name)) {
                $specs[] = array(
                    'name' => sanitize_text_field($name),
                    'value' => isset($_POST['spec_value'][$i]) ? sanitize_text_field($_POST['spec_value'][$i]) : ''
                );
            }
        }
        
        update_post_meta($post_id, '_product_specifications', $specs);
    }

    // Save Product Gallery
    if (isset($_POST['product_gallery'])) {
        update_post_meta($post_id, '_product_gallery', sanitize_text_field($_POST['product_gallery']));
    }

    // Save Product Documents
    if (isset($_POST['document_title']) && isset($_POST['document_file']) && isset($_POST['document_id'])) {
        $documents = array();
        
        foreach ($_POST['document_title'] as $i => $title) {
            if (!empty($title) && !empty($_POST['document_file'][$i])) {
                $documents[] = array(
                    'title' => sanitize_text_field($title),
                    'file' => esc_url_raw($_POST['document_file'][$i]),
                    'id' => intval($_POST['document_id'][$i])
                );
            }
        }
        
        update_post_meta($post_id, '_product_documents', $documents);
    }
}
add_action('save_post_kuperbush_product', 'kuperbush_save_product_meta');

/**
 * Add custom columns to product post type admin
 */
function kuperbush_product_custom_columns($columns) {
    $new_columns = array();
    
    // Insert thumbnail after checkbox
    $new_columns['cb'] = $columns['cb'];
    $new_columns['thumbnail'] = __('Image', 'kuperbush');
    
    // Add other columns
    $new_columns['title'] = $columns['title'];
    $new_columns['model'] = __('Model', 'kuperbush');
    $new_columns['categories'] = __('Categories', 'kuperbush');
    $new_columns['series'] = __('Series', 'kuperbush');
    $new_columns['date'] = $columns['date'];
    
    return $new_columns;
}
add_filter('manage_kuperbush_product_posts_columns', 'kuperbush_product_custom_columns');

/**
 * Display custom column content
 */
function kuperbush_product_custom_column_content($column, $post_id) {
    switch ($column) {
        case 'thumbnail':
            if (has_post_thumbnail($post_id)) {
                echo '<a href="' . get_edit_post_link($post_id) . '">';
                echo get_the_post_thumbnail($post_id, array(50, 50));
                echo '</a>';
            } else {
                echo '<a href="' . get_edit_post_link($post_id) . '">';
                echo '<img src="' . get_template_directory_uri() . '/img/placeholder-product.png" width="50" height="50" alt="Product Placeholder">';
                echo '</a>';
            }
            break;
            
        case 'model':
            $model = get_post_meta($post_id, '_product_model_number', true);
            echo $model ? esc_html($model) : '—';
            break;
            
        case 'categories':
            $terms = get_the_terms($post_id, 'product_category');
            if (!empty($terms)) {
                $term_links = array();
                foreach ($terms as $term) {
                    $term_links[] = '<a href="' . esc_url(add_query_arg(array('post_type' => 'kuperbush_product', 'product_category' => $term->slug), 'edit.php')) . '">' . esc_html($term->name) . '</a>';
                }
                echo implode(', ', $term_links);
            } else {
                echo '—';
            }
            break;
            
        case 'series':
            $terms = get_the_terms($post_id, 'product_series');
            if (!empty($terms)) {
                $term_links = array();
                foreach ($terms as $term) {
                    $term_links[] = '<a href="' . esc_url(add_query_arg(array('post_type' => 'kuperbush_product', 'product_series' => $term->slug), 'edit.php')) . '">' . esc_html($term->name) . '</a>';
                }
                echo implode(', ', $term_links);
            } else {
                echo '—';
            }
            break;
    }
}
add_action('manage_kuperbush_product_posts_custom_column', 'kuperbush_product_custom_column_content', 10, 2);

/**
 * Make custom columns sortable
 */
function kuperbush_product_sortable_columns($columns) {
    $columns['model'] = 'model';
    return $columns;
}
add_filter('manage_edit-kuperbush_product_sortable_columns', 'kuperbush_product_sortable_columns');

/**
 * Order by custom columns
 */
function kuperbush_product_orderby($query) {
    if (!is_admin() || !$query->is_main_query() || $query->get('post_type') !== 'kuperbush_product') {
        return;
    }

    if ($query->get('orderby') === 'model') {
        $query->set('meta_key', '_product_model_number');
        $query->set('orderby', 'meta_value');
    }
}
add_action('pre_get_posts', 'kuperbush_product_orderby');

/**
 * Add filter dropdowns for taxonomies on product admin screen
 */
function kuperbush_products_filter_dropdowns() {
    global $typenow;
    
    if ($typenow === 'kuperbush_product') {
        // Product Category dropdown
        $current_category = isset($_GET['product_category']) ? $_GET['product_category'] : '';
        $categories = get_terms(array('taxonomy' => 'product_category', 'hide_empty' => false));
        
        if (!empty($categories)) {
            echo '<select name="product_category">';
            echo '<option value="">' . __('All Categories', 'kuperbush') . '</option>';
            
            foreach ($categories as $category) {
                $selected = ($current_category === $category->slug) ? ' selected="selected"' : '';
                echo '<option value="' . esc_attr($category->slug) . '"' . $selected . '>' . esc_html($category->name) . '</option>';
            }
            
            echo '</select>';
        }
        
        // Product Series dropdown
        $current_series = isset($_GET['product_series']) ? $_GET['product_series'] : '';
        $series_terms = get_terms(array('taxonomy' => 'product_series', 'hide_empty' => false));
        
        if (!empty($series_terms)) {
            echo '<select name="product_series">';
            echo '<option value="">' . __('All Series', 'kuperbush') . '</option>';
            
            foreach ($series_terms as $series) {
                $selected = ($current_series === $series->slug) ? ' selected="selected"' : '';
                echo '<option value="' . esc_attr($series->slug) . '"' . $selected . '>' . esc_html($series->name) . '</option>';
            }
            
            echo '</select>';
        }
    }
}
add_action('restrict_manage_posts', 'kuperbush_products_filter_dropdowns');