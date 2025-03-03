<?php
/**
 * Auto Page Creation Module
 * 
 * This module automatically creates pages for template files if they don't exist.
 * It uses the template registry to map template files to page titles and slugs,
 * and creates the pages on theme activation.
 */

if (!function_exists('kuperbush_get_template_pages_config')) {
    /**
     * Configuration for template to page mapping
     * 
     * This function returns an array of template files mapped to their corresponding
     * page titles and slugs. It gets this information from the centralized template registry.
     * 
     * @return array Template to page mapping configuration
     */
    function kuperbush_get_template_pages_config() {
        // Get templates from the centralized registry
        if (function_exists('kuperbush_template_registry')) {
            return kuperbush_template_registry();
        }
        
        // Fallback to empty array if registry is not available
        return array();
    }
}

if (!function_exists('kuperbush_create_template_pages')) {
    /**
     * Create pages for templates if they don't exist
     * 
     * This function checks for existing pages with the configured slugs
     * and creates them if they don't exist, assigning the correct template.
     * 
     * @return void
     */
    function kuperbush_create_template_pages() {
        // Get template page configuration
        $template_pages = kuperbush_get_template_pages_config();
        
        // Check and create each page
        foreach ($template_pages as $template => $page_data) {
            // Check if page with this slug already exists
            $existing_page = get_page_by_path($page_data['slug']);
            
            // If page doesn't exist, create it
            if (!$existing_page) {
                // Create the page
                $page_id = wp_insert_post(array(
                    'post_title'    => $page_data['title'],
                    'post_name'     => $page_data['slug'],
                    'post_content'  => $page_data['content'] ?? '',
                    'post_status'   => 'publish',
                    'post_type'     => 'page',
                    'comment_status' => 'closed'
                ));
                
                // Set the page template
                if ($page_id && !is_wp_error($page_id)) {
                    update_post_meta($page_id, '_wp_page_template', $template);
                }
            } else {
                // Page exists, make sure it has the correct template
                $current_template = get_post_meta($existing_page->ID, '_wp_page_template', true);
                
                // If template is not set or incorrect, update it
                if (empty($current_template) || $current_template !== $template) {
                    update_post_meta($existing_page->ID, '_wp_page_template', $template);
                }
            }
        }
    }
}

/**
 * Run page creation on theme activation
 */
if (!function_exists('kuperbush_theme_activation')) {
    function kuperbush_theme_activation() {
        // Create template pages
        kuperbush_create_template_pages();
    }
}
add_action('after_switch_theme', 'kuperbush_theme_activation');

/**
 * Process template page form action
 */
if (!function_exists('kuperbush_process_template_page_actions')) {
    function kuperbush_process_template_page_actions() {
        // Check if the form was submitted
        if (isset($_POST['kuperbush_create_pages']) && check_admin_referer('kuperbush_create_pages_nonce')) {
            // Run page creation
            kuperbush_create_template_pages();
            
            // Add admin notice
            add_settings_error(
                'kuperbush_template_pages',
                'kuperbush_pages_created',
                __('Template pages have been created or updated!', 'kuperbush'),
                'success'
            );
            
            // Redirect to prevent form resubmission
            wp_redirect(add_query_arg(array(
                'page' => 'kuperbush-options',
                'tab' => 'tools',
                'settings-updated' => 'true'
            ), admin_url('themes.php')));
            exit;
        }
    }
}
add_action('admin_init', 'kuperbush_process_template_page_actions');

/**
 * Get template pages table HTML
 */
if (!function_exists('kuperbush_get_template_pages_table')) {
    function kuperbush_get_template_pages_table() {
        ob_start();
        ?>
        <div class="kuperbush-table-container">
            <table class="kuperbush-admin-table">
                <thead>
                    <tr>
                        <th><?php _e('Template', 'kuperbush'); ?></th>
                        <th><?php _e('Page Title', 'kuperbush'); ?></th>
                        <th><?php _e('Slug', 'kuperbush'); ?></th>
                        <th><?php _e('Status', 'kuperbush'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $template_pages = kuperbush_get_template_pages_config();
                    
                    if (empty($template_pages)) {
                        echo '<tr><td colspan="4">' . __('No template pages configured.', 'kuperbush') . '</td></tr>';
                    } else {
                        foreach ($template_pages as $template => $page_data) {
                            $existing_page = get_page_by_path($page_data['slug']);
                            $status = $existing_page ? __('Exists', 'kuperbush') : __('Not Created', 'kuperbush');
                            $status_class = $existing_page ? 'kuperbush-status-success' : 'kuperbush-status-warning';
                            
                            if ($existing_page) {
                                $current_template = get_post_meta($existing_page->ID, '_wp_page_template', true);
                                $template_match = ($current_template === $template);
                                
                                if (!$template_match) {
                                    $status .= ' (' . __('Template mismatch', 'kuperbush') . ')';
                                    $status_class = 'kuperbush-status-error';
                                }
                            }
                            
                            echo '<tr>';
                            echo '<td>' . esc_html($template) . '</td>';
                            echo '<td>' . esc_html($page_data['title']) . '</td>';
                            echo '<td>' . esc_html($page_data['slug']) . '</td>';
                            echo '<td><span class="kuperbush-status-badge ' . esc_attr($status_class) . '">' . esc_html($status) . '</span></td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
        return ob_get_clean();
    }
}

/**
 * Function to programmatically create pages for templates
 * 
 * This function can be called from other parts of the code or plugins
 * to create pages for specific templates.
 * 
 * @param string $template Template file name
 * @return int|false Page ID if created, false otherwise
 */
if (!function_exists('kuperbush_create_page_for_template')) {
    function kuperbush_create_page_for_template($template) {
        $templates_config = kuperbush_get_template_pages_config();
        
        // Check if template exists in config
        if (isset($templates_config[$template])) {
            $page_data = $templates_config[$template];
            
            // Check if page already exists
            $existing_page = get_page_by_path($page_data['slug']);
            
            if (!$existing_page) {
                // Create the page
                $page_id = wp_insert_post(array(
                    'post_title'    => $page_data['title'],
                    'post_name'     => $page_data['slug'],
                    'post_content'  => $page_data['content'] ?? '',
                    'post_status'   => 'publish',
                    'post_type'     => 'page',
                    'comment_status' => 'closed'
                ));
                
                // Set the page template
                if ($page_id && !is_wp_error($page_id)) {
                    update_post_meta($page_id, '_wp_page_template', $template);
                    return $page_id;
                }
            } else {
                // Page exists, make sure it has the correct template
                $current_template = get_post_meta($existing_page->ID, '_wp_page_template', true);
                
                // If template is not set or incorrect, update it
                if (empty($current_template) || $current_template !== $template) {
                    update_post_meta($existing_page->ID, '_wp_page_template', $template);
                }
                
                return $existing_page->ID;
            }
        }
        
        return false;
    }
}

/**
 * Add a filter to show template assignments in the page list
 */
if (!function_exists('kuperbush_add_template_column')) {
    function kuperbush_add_template_column($columns) {
        $columns['template'] = 'Template';
        return $columns;
    }
}
add_filter('manage_pages_columns', 'kuperbush_add_template_column');

/**
 * Display template information in the page list
 */
if (!function_exists('kuperbush_display_template_column')) {
    function kuperbush_display_template_column($column_name, $post_id) {
        if ($column_name === 'template') {
            $template = get_post_meta($post_id, '_wp_page_template', true);
            
            if ($template && $template !== 'default') {
                echo esc_html($template);
            } else {
                echo '<span class="na">–</span>';
            }
        }
    }
}
add_action('manage_pages_custom_column', 'kuperbush_display_template_column', 10, 2);

/**
 * Add a function to detect new template files
 */
if (!function_exists('kuperbush_detect_new_templates')) {
    function kuperbush_detect_new_templates() {
        // Get the template directory
        $template_dir = get_template_directory() . '/templates/';
        
        // Check if directory exists
        if (!is_dir($template_dir)) {
            return array();
        }
        
        // Get all template files
        $template_files = glob($template_dir . 'tmp-*.php');
        
        // Get configured templates
        $config = kuperbush_get_template_pages_config();
        $configured_templates = array_keys($config);
        
        // Find templates that are not configured
        $new_templates = array();
        
        foreach ($template_files as $template_file) {
            $template_name = basename($template_file);
            
            if (!in_array($template_name, $configured_templates)) {
                $new_templates[] = $template_name;
            }
        }
        
        return $new_templates;
    }
}

/**
 * Add admin notice for new templates
 */
if (!function_exists('kuperbush_new_template_notice')) {
    function kuperbush_new_template_notice() {
        // Only show to administrators
        if (!current_user_can('manage_options')) {
            return;
        }
        
        // Check for new templates
        $new_templates = kuperbush_detect_new_templates();
        
        if (!empty($new_templates)) {
            ?>
            <div class="notice notice-info is-dismissible">
                <p>
                    <strong>Kuperbush Theme:</strong> 
                    <?php echo count($new_templates) > 1 ? 'New templates were' : 'A new template was'; ?> detected but not configured for auto page creation: 
                    <strong><?php echo esc_html(implode(', ', $new_templates)); ?></strong>
                    <br>
                    Please add them to the template registry in the <code>inc/modules/template-registry.php</code> file.
                </p>
            </div>
            <?php
        }
    }
}
add_action('admin_notices', 'kuperbush_new_template_notice');