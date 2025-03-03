<?php
/**
 * Admin Tools Module
 * Contains functionality for admin-related features and utilities
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Disable Gutenberg editor based on settings
 * 
 * Allows for global or post-type specific disabling of the Gutenberg editor
 */
function kuperbush_disable_gutenberg() {
    // Global setting - disable Gutenberg for all post types
    if (get_option('kuperbush_disable_gutenberg', false)) {
        // Disable Gutenberg editor completely
        add_filter('use_block_editor_for_post', '__return_false', 10);
        add_filter('use_block_editor_for_post_type', '__return_false', 10);
        
        // Disable Gutenberg widgets screen
        add_filter('gutenberg_use_widgets_block_editor', '__return_false');
        add_filter('use_widgets_block_editor', '__return_false');
        
        return; // No need to check individual post types if global setting is on
    }
    
    // Post type specific settings
    add_filter('use_block_editor_for_post_type', function($use_block_editor, $post_type) {
        // Check if this specific post type has Gutenberg disabled
        if (get_option('kuperbush_disable_gutenberg_' . $post_type, false)) {
            return false;
        }
        return $use_block_editor;
    }, 10, 2);
    
    add_filter('use_block_editor_for_post', function($use_block_editor, $post) {
        $post_type = get_post_type($post);
        // Check if this specific post type has Gutenberg disabled
        if (get_option('kuperbush_disable_gutenberg_' . $post_type, false)) {
            return false;
        }
        return $use_block_editor;
    }, 10, 2);
}
add_action('init', 'kuperbush_disable_gutenberg');

/**
 * Display current template file name in the top admin bar.
 */
function show_current_template_in_admin_bar($wp_admin_bar) {
    // Only show on front-end for users with admin privileges.
    if (is_admin() || !current_user_can('manage_options')) {
        return;
    }

    // Check if the feature is enabled
    $show_template = get_option('kuperbush_show_template_name', true);
    if (!$show_template) {
        return;
    }

    global $template;
    if (empty($template)) {
        return;
    }

    // Get just the filename from the full template path.
    $template_file = basename($template);

    // Add a node to the admin bar.
    $wp_admin_bar->add_node(array(
        'id'    => 'current_template',
        'title' => 'Template: ' . $template_file,
    ));
}
add_action('admin_bar_menu', 'show_current_template_in_admin_bar', 999);

/**
 * Register theme settings
 */
function kuperbush_register_settings() {
    // Register settings
    register_setting('kuperbush_options', 'kuperbush_show_template_name', array(
        'type' => 'boolean',
        'default' => true,
        'sanitize_callback' => 'rest_sanitize_boolean',
    ));
    
    register_setting('kuperbush_options', 'kuperbush_disable_gutenberg', array(
        'type' => 'boolean',
        'default' => false,
        'sanitize_callback' => 'rest_sanitize_boolean',
    ));
    
    // Register custom login page setting
    register_setting('kuperbush_options', 'kuperbush_enable_custom_login', array(
        'type' => 'boolean',
        'default' => false,
        'sanitize_callback' => 'rest_sanitize_boolean',
    ));
    
    // Register post type specific Gutenberg settings
    $post_types = get_post_types(array('public' => true), 'objects');
    foreach ($post_types as $post_type) {
        register_setting('kuperbush_options', 'kuperbush_disable_gutenberg_' . $post_type->name, array(
            'type' => 'boolean',
            'default' => false,
            'sanitize_callback' => 'rest_sanitize_boolean',
        ));
    }
}
add_action('admin_init', 'kuperbush_register_settings');

/**
 * Redirect after settings save to maintain active tab
 */
function kuperbush_settings_redirect() {
    // Check if this is a settings-update request
    if (isset($_REQUEST['option_page']) && $_REQUEST['option_page'] === 'kuperbush_options') {
        if (isset($_POST['active_tab'])) {
            // Get the active tab
            $active_tab = sanitize_key($_POST['active_tab']);
            
            // Create the redirect URL with the active tab
            $redirect_url = add_query_arg(
                array(
                    'page' => 'kuperbush-options',
                    'tab' => $active_tab,
                    'settings-updated' => 'true'
                ),
                admin_url('themes.php')
            );
            
            // This hook runs before WordPress would normally redirect
            add_filter('wp_redirect', function($location) use ($redirect_url) {
                if (strpos($location, 'options-general.php?page=') !== false ||
                    strpos($location, 'options.php?') !== false) {
                    return $redirect_url;
                }
                return $location;
            });
        }
    }
}
add_action('admin_init', 'kuperbush_settings_redirect');

/**
 * Register admin scripts and styles
 */
function kuperbush_admin_scripts() {
    $screen = get_current_screen();
    
    // Only load on our options page
    if ($screen && $screen->id === 'appearance_page_kuperbush-options') {
        wp_enqueue_style('kuperbush-admin-styles', get_template_directory_uri() . '/css/kuperbush-admin.css', array(), '1.0.0');
        wp_enqueue_script('kuperbush-admin-script', get_template_directory_uri() . '/js/kuperbush-admin.js', array('jquery'), '1.0.0', true);
    }
}
add_action('admin_enqueue_scripts', 'kuperbush_admin_scripts');

/**
 * Add Theme Options page to the menu
 */
function kuperbush_add_options_page() {
    add_theme_page(
        __('Kuperbush Theme Options', 'kuperbush'),
        __('Theme Options', 'kuperbush'),
        'manage_options',
        'kuperbush-options',
        'kuperbush_options_page_callback'
    );
}
add_action('admin_menu', 'kuperbush_add_options_page');

/**
 * Get available post types for editor settings
 *
 * @return array Associative array of post type objects
 */
function kuperbush_get_editor_post_types() {
    // Get all public post types
    $post_types = get_post_types(array('public' => true), 'objects');
    
    // Filter out some post types we don't want to include
    $excluded_types = array('attachment');
    foreach ($excluded_types as $excluded) {
        if (isset($post_types[$excluded])) {
            unset($post_types[$excluded]);
        }
    }
    
    return $post_types;
}

/**
 * Get template pages management form HTML
 */
function kuperbush_get_template_pages_form() {
    ob_start();
    ?>
    <div class="kuperbush-form-container">
        <form method="post" action="" class="kuperbush-template-pages-form">
            <?php wp_nonce_field('kuperbush_create_pages_nonce'); ?>
            <input type="hidden" name="kuperbush_create_pages" value="1">
            <p><?php _e('This tool will create pages for your template files if they don\'t exist.', 'kuperbush'); ?></p>
            <button type="submit" class="button button-primary"><?php _e('Create Template Pages', 'kuperbush'); ?></button>
        </form>
    </div>
    <?php
    // Get template pages table
    if (function_exists('kuperbush_get_template_pages_table')) {
        echo kuperbush_get_template_pages_table();
    }
    
    return ob_get_clean();
}

/**
 * Define the structure of admin modules
 * 
 * This function returns a structured array of modules, sections, and settings
 * Add new modules and options here to extend the admin interface
 */
function kuperbush_get_admin_modules() {
    $modules = array(
        'general' => array(
            'title' => __('General', 'kuperbush'),
            'icon' => 'dashicons-admin-generic',
            'description' => __('General theme settings and configuration options.', 'kuperbush'),
            'sections' => array(
                'front_page' => array(
                    'title' => __('Front Page Settings', 'kuperbush'),
                    'description' => __('Configure your site\'s homepage and front page settings.', 'kuperbush'),
                    'custom_content' => 'kuperbush_front_page_options_form',
                ),
                'editor' => array(
                    'title' => __('Editor Settings', 'kuperbush'),
                    'description' => __('Configure how the WordPress editor behaves.', 'kuperbush'),
                    'fields' => array(
                        'kuperbush_disable_gutenberg' => array(
                            'label' => __('Disable Gutenberg Editor Globally', 'kuperbush'),
                            'description' => __('Use the classic editor instead of Gutenberg for all post types. Changes take effect on page reload.', 'kuperbush'),
                            'type' => 'checkbox',
                            'default' => false,
                        ),
                    )
                ),
                'post_type_editor' => array(
                    'title' => __('Post Type Editor Settings', 'kuperbush'),
                    'description' => __('Configure editor settings for specific post types.', 'kuperbush'),
                    'before_fields' => '<div class="kuperbush-bulk-actions">
                        <button type="button" class="button kuperbush-select-all-post-types">' . __('Select All Post Types', 'kuperbush') . '</button>
                        <button type="button" class="button kuperbush-deselect-all-post-types">' . __('Deselect All', 'kuperbush') . '</button>
                    </div>',
                    'fields' => function() {
                        $fields = array();
                        $post_types = kuperbush_get_editor_post_types();
                        
                        // Create a field for each post type
                        foreach ($post_types as $post_type) {
                            $fields['kuperbush_disable_gutenberg_' . $post_type->name] = array(
                                'label' => sprintf(__('Disable Gutenberg for %s', 'kuperbush'), $post_type->labels->name),
                                'description' => sprintf(__('Use the classic editor for %s. This setting is ignored if Gutenberg is disabled globally.', 'kuperbush'), $post_type->labels->name),
                                'type' => 'checkbox',
                                'default' => false,
                                'post_type' => $post_type->name,
                            );
                        }
                        
                        return $fields;
                    },
                ),
                'login_page' => array(
                    'title' => __('Login Page', 'kuperbush'),
                    'description' => __('Customize the WordPress login page.', 'kuperbush'),
                    'fields' => array(
                        'kuperbush_enable_custom_login' => array(
                            'label' => __('Enable Custom Login Page', 'kuperbush'),
                            'description' => __('Use the theme\'s custom styling for the WordPress login page.', 'kuperbush'),
                            'type' => 'checkbox',
                            'default' => false,
                        ),
                    )
                ),
            )
        ),
        'tools' => array(
            'title' => __('Tools', 'kuperbush'),
            'icon' => 'dashicons-admin-tools',
            'description' => __('Theme tools and utilities.', 'kuperbush'),
            'sections' => array(
                'template_pages' => array(
                    'title' => __('Template Pages', 'kuperbush'),
                    'description' => __('Manage pages automatically created from template files.', 'kuperbush'),
                    'custom_content' => 'kuperbush_get_template_pages_form',
                ),
            )
        ),
        'developer' => array(
            'title' => __('Developer', 'kuperbush'),
            'icon' => 'dashicons-code-standards',
            'description' => __('Tools and settings for theme development and debugging.', 'kuperbush'),
            'sections' => array(
                'tools' => array(
                    'title' => __('Developer Tools', 'kuperbush'),
                    'description' => __('Helpful utilities for theme development.', 'kuperbush'),
                    'fields' => array(
                        'kuperbush_show_template_name' => array(
                            'label' => __('Show Template Name', 'kuperbush'),
                            'description' => __('Display the current template file name in the admin bar.', 'kuperbush'),
                            'type' => 'checkbox',
                            'default' => true,
                        ),
                    )
                ),
            )
        ),
        // Example structure for future extension
        /*
        'performance' => array(
            'title' => __('Performance', 'kuperbush'),
            'icon' => 'dashicons-performance',
            'description' => __('Configure performance-related settings.', 'kuperbush'),
            'sections' => array(
                'caching' => array(
                    'title' => __('Caching', 'kuperbush'),
                    'description' => __('Manage caching behavior.', 'kuperbush'),
                    'fields' => array(
                        'kuperbush_enable_caching' => array(
                            'label' => __('Enable Caching', 'kuperbush'),
                            'description' => __('Cache theme assets for better performance.', 'kuperbush'),
                            'type' => 'checkbox',
                            'default' => true,
                        ),
                    )
                ),
            )
        ),
        */
    );
    
    return apply_filters('kuperbush_admin_modules', $modules);
}

/**
 * Render a field based on its type
 */
function kuperbush_render_field($field_id, $field) {
    $value = get_option($field_id, $field['default']);
    
    switch ($field['type']) {
        case 'checkbox':
            $disabled = !empty($field['disabled']) ? 'disabled="disabled"' : '';
            $field_class = !empty($field['disabled']) ? 'kuperbush-field-disabled' : '';
            ?>
            <div class="kuperbush-field kuperbush-field-checkbox <?php echo esc_attr($field_class); ?>">
                <label class="kuperbush-toggle">
                    <input type="checkbox" name="<?php echo esc_attr($field_id); ?>" id="<?php echo esc_attr($field_id); ?>" value="1" <?php checked($value); ?> <?php echo $disabled; ?>>
                    <span class="kuperbush-toggle-slider"></span>
                </label>
                <label for="<?php echo esc_attr($field_id); ?>" class="kuperbush-field-label"><?php echo esc_html($field['label']); ?></label>
                <?php if (!empty($field['description'])): ?>
                    <p class="kuperbush-field-description"><?php echo esc_html($field['description']); ?></p>
                <?php endif; ?>
            </div>
            <?php
            break;
            
        case 'text':
            ?>
            <div class="kuperbush-field kuperbush-field-text">
                <label for="<?php echo esc_attr($field_id); ?>" class="kuperbush-field-label"><?php echo esc_html($field['label']); ?></label>
                <input type="text" name="<?php echo esc_attr($field_id); ?>" id="<?php echo esc_attr($field_id); ?>" value="<?php echo esc_attr($value); ?>" class="regular-text">
                <?php if (!empty($field['description'])): ?>
                    <p class="kuperbush-field-description"><?php echo esc_html($field['description']); ?></p>
                <?php endif; ?>
            </div>
            <?php
            break;
            
        case 'select':
            ?>
            <div class="kuperbush-field kuperbush-field-select">
                <label for="<?php echo esc_attr($field_id); ?>" class="kuperbush-field-label"><?php echo esc_html($field['label']); ?></label>
                <select name="<?php echo esc_attr($field_id); ?>" id="<?php echo esc_attr($field_id); ?>">
                    <?php foreach ($field['options'] as $option_key => $option_label): ?>
                        <option value="<?php echo esc_attr($option_key); ?>" <?php selected($value, $option_key); ?>><?php echo esc_html($option_label); ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if (!empty($field['description'])): ?>
                    <p class="kuperbush-field-description"><?php echo esc_html($field['description']); ?></p>
                <?php endif; ?>
            </div>
            <?php
            break;
            
        default:
            do_action('kuperbush_render_field_' . $field['type'], $field_id, $field);
            break;
    }
}

/**
 * Get front page options form HTML
 * This function displays the front page configuration options
 */
function kuperbush_front_page_options_form() {
    ob_start();
    
    // Check if form was submitted
    if (isset($_POST['kuperbush_front_page_nonce']) && 
        wp_verify_nonce($_POST['kuperbush_front_page_nonce'], 'kuperbush_front_page_action')) {
        
        // Get the active tab for redirect
        $active_tab = isset($_POST['active_tab']) ? sanitize_key($_POST['active_tab']) : 'general';
        
        if (isset($_POST['kuperbush_apply_front_page'])) {
            // Apply front page settings
            $result = kuperbush_create_front_page(true);
            if ($result) {
                add_settings_error('kuperbush_front_page', 'kuperbush_front_page_success', 'Front page has been created and set as the homepage!', 'success');
            } else {
                add_settings_error('kuperbush_front_page', 'kuperbush_front_page_error', 'An error occurred while configuring the front page.', 'error');
            }
        } else {
            // Just create the pages without applying settings
            $result = kuperbush_create_front_page(false);
            if ($result) {
                add_settings_error('kuperbush_front_page', 'kuperbush_front_page_success', 'Front page has been created but not set as the homepage.', 'success');
            } else {
                add_settings_error('kuperbush_front_page', 'kuperbush_front_page_error', 'An error occurred while creating the front page.', 'error');
            }
        }
        
        // Redirect to prevent form resubmission and preserve the tab
        $redirect_url = add_query_arg(
            array(
                'page' => 'kuperbush-options',
                'tab' => $active_tab,
                'settings-updated' => 'true'
            ),
            admin_url('themes.php')
        );
        wp_redirect($redirect_url);
        exit;
    }
    
    // Get current front page settings
    $show_on_front = get_option('show_on_front');
    $page_on_front = get_option('page_on_front');
    $page_for_posts = get_option('page_for_posts');
    
    $front_page = $page_on_front ? get_post($page_on_front) : null;
    $posts_page = $page_for_posts ? get_post($page_for_posts) : null;
    
    ?>
    <div class="kuperbush-form-container">
        <p><?php _e('This tool will create a front page and optionally set it as the homepage in WordPress settings.', 'kuperbush'); ?></p>
        
        <table class="widefat" style="margin-bottom: 1em;">
            <tr>
                <th><?php _e('Current Homepage Display', 'kuperbush'); ?></th>
                <td><?php echo $show_on_front === 'page' ? __('Static page', 'kuperbush') : __('Latest posts', 'kuperbush'); ?></td>
            </tr>
            <tr>
                <th><?php _e('Current Front Page', 'kuperbush'); ?></th>
                <td>
                    <?php if ($front_page): ?>
                        <?php echo esc_html($front_page->post_title); ?> (ID: <?php echo esc_html($front_page->ID); ?>)
                    <?php else: ?>
                        <?php _e('Not set', 'kuperbush'); ?>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th><?php _e('Current Posts Page', 'kuperbush'); ?></th>
                <td>
                    <?php if ($posts_page): ?>
                        <?php echo esc_html($posts_page->post_title); ?> (ID: <?php echo esc_html($posts_page->ID); ?>)
                    <?php else: ?>
                        <?php _e('Not set', 'kuperbush'); ?>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
        
        <form method="post" action="" style="margin-top: 1em;" class="kuperbush-front-page-form">
            <?php wp_nonce_field('kuperbush_front_page_action', 'kuperbush_front_page_nonce'); ?>
            <input type="hidden" name="active_tab" value="<?php echo isset($_GET['tab']) ? esc_attr(sanitize_key($_GET['tab'])) : 'general'; ?>">
            
            <p>
                <label>
                    <input type="checkbox" name="kuperbush_apply_front_page" value="1">
                    <?php _e('Apply front page settings (change WordPress settings to use this page as front page)', 'kuperbush'); ?>
                </label>
            </p>
            
            <p><input type="submit" class="button button-primary" value="<?php _e('Setup Front Page', 'kuperbush'); ?>"></p>
        </form>
        
        <p class="description" style="margin-top: 1em;">
            <strong><?php _e('Note:', 'kuperbush'); ?></strong> 
            <?php _e('If you don\'t check the "Apply front page settings" box, pages will be created but your current homepage settings will not be changed.', 'kuperbush'); ?>
        </p>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Display settings errors for our custom form submissions
 */
function kuperbush_admin_notices() {
    // Show existing WordPress errors
    settings_errors('kuperbush_front_page');
}
add_action('admin_notices', 'kuperbush_admin_notices');

/**
 * Theme Options page content
 */
function kuperbush_options_page_callback() {
    $active_tab = isset($_GET['tab']) ? sanitize_key($_GET['tab']) : 'general';
    $modules = kuperbush_get_admin_modules();
    
    // If the active tab doesn't exist, default to the first tab
    if (!isset($modules[$active_tab])) {
        $active_tab = key($modules);
    }
    ?>
    <div class="kuperbush-admin-wrap">
        <div class="kuperbush-admin-header">
            <div class="kuperbush-admin-logo">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/img/kuppersbusch.svg'); ?>" alt="Kuperbush">
            </div>
            <h1><?php _e('Theme Options', 'kuperbush'); ?></h1>
            <div class="kuperbush-admin-version">
                <span><?php _e('Version', 'kuperbush'); ?>: <?php echo wp_get_theme()->get('Version'); ?></span>
            </div>
        </div>
        
        <div class="kuperbush-admin-content">
            <div class="kuperbush-admin-sidebar">
                <ul class="kuperbush-admin-tabs">
                    <?php foreach ($modules as $tab_id => $tab): ?>
                        <li class="kuperbush-admin-tab <?php echo $active_tab === $tab_id ? 'active' : ''; ?>">
                            <a href="<?php echo esc_url(add_query_arg('tab', $tab_id)); ?>" class="kuperbush-admin-tab-link">
                                <span class="dashicons <?php echo esc_attr($tab['icon']); ?>"></span>
                                <span class="kuperbush-admin-tab-label"><?php echo esc_html($tab['title']); ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <div class="kuperbush-admin-main">
                <div class="kuperbush-admin-tab-content">
                    <div class="kuperbush-admin-module-header">
                        <h2><?php echo esc_html($modules[$active_tab]['title']); ?></h2>
                        <p class="kuperbush-admin-module-description"><?php echo esc_html($modules[$active_tab]['description']); ?></p>
                    </div>
                    
                    <form method="post" action="options.php" class="kuperbush-admin-form">
                        <?php settings_fields('kuperbush_options'); ?>
                        <input type="hidden" name="active_tab" value="<?php echo esc_attr($active_tab); ?>">
                        
                        <?php foreach ($modules[$active_tab]['sections'] as $section_id => $section): ?>
                            <div class="kuperbush-admin-section">
                                <div class="kuperbush-admin-section-header">
                                    <h3><?php echo esc_html($section['title']); ?></h3>
                                    <?php if (!empty($section['description'])): ?>
                                        <p class="kuperbush-admin-section-description"><?php echo esc_html($section['description']); ?></p>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="kuperbush-admin-section-content">
                                    <?php 
                                    // Display any content that should appear before fields
                                    if (!empty($section['before_fields'])) {
                                        echo wp_kses_post($section['before_fields']);
                                    }
                                    
                                    // Check if this section has custom content
                                    if (!empty($section['custom_content'])) {
                                        if (is_callable($section['custom_content'])) {
                                            // Call the function to get the content
                                            echo call_user_func($section['custom_content']);
                                        } else {
                                            // Direct HTML content
                                            echo wp_kses_post($section['custom_content']);
                                        }
                                    } 
                                    // Regular fields section
                                    elseif (!empty($section['fields'])) {
                                        // Handle both direct fields array and callable that returns fields
                                        $fields = is_callable($section['fields']) ? call_user_func($section['fields']) : $section['fields'];
                                        
                                        // Group fields by group if specified
                                        $has_groups = false;
                                        $grouped_fields = array();
                                        
                                        foreach ($fields as $field_id => $field) {
                                            // Check if the field has a group
                                            if (!empty($field['group'])) {
                                                $has_groups = true;
                                                $grouped_fields[$field['group']][$field_id] = $field;
                                            } else {
                                                $grouped_fields['default'][$field_id] = $field;
                                            }
                                        }
                                        
                                        // If we have groups, render them in fieldsets
                                        if ($has_groups) {
                                            foreach ($grouped_fields as $group_name => $group_fields) {
                                                if ($group_name !== 'default') {
                                                    echo '<fieldset class="kuperbush-field-group"><legend>' . esc_html($group_name) . '</legend>';
                                                }
                                                
                                                foreach ($group_fields as $field_id => $field) {
                                                    kuperbush_render_field($field_id, $field);
                                                }
                                                
                                                if ($group_name !== 'default') {
                                                    echo '</fieldset>';
                                                }
                                            }
                                        } else {
                                            // No groups, just render fields normally
                                            foreach ($fields as $field_id => $field) {
                                                kuperbush_render_field($field_id, $field);
                                            }
                                        }
                                    }
                                    
                                    // Display any content that should appear after fields
                                    if (!empty($section['after_fields'])) {
                                        echo wp_kses_post($section['after_fields']);
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        
                        <?php submit_button(__('Save Changes', 'kuperbush'), 'primary kuperbush-admin-submit-button'); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
}