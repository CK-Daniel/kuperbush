<?php
/**
 * Front Page Module
 * 
 * This module handles the creation of the front page and 
 * sets it as the homepage in WordPress settings when explicitly requested.
 * It does NOT modify the front page automatically on theme activation.
 */

if (!function_exists('kuperbush_create_front_page')) {
    /**
     * Create front page and set it as the homepage
     * 
     * This function creates a front page if it doesn't exist
     * and sets it as the homepage in WordPress settings.
     * 
     * @param bool $apply_changes Whether to actually set the front page (default: false)
     * @return int|bool Page ID if created/found, false on failure
     */
    function kuperbush_create_front_page($apply_changes = false) {
        // Check if a page with the slug 'home' already exists
        $existing_page = get_page_by_path('home');
        $page_id = 0;
        
        // If page doesn't exist, create it
        if (!$existing_page) {
            $page_id = wp_insert_post(array(
                'post_title'    => 'Home',
                'post_name'     => 'home',
                'post_content'  => '<!-- Home page content created automatically -->',
                'post_status'   => 'publish',
                'post_type'     => 'page',
                'comment_status' => 'closed'
            ));
        } else {
            $page_id = $existing_page->ID;
        }
        
        if ($page_id && $apply_changes) {
            // Set the front page template if needed
            $current_template = get_post_meta($page_id, '_wp_page_template', true);
            if (empty($current_template) || $current_template === 'default') {
                // Check if a front-page.php exists in the theme
                if (file_exists(get_template_directory() . '/front-page.php')) {
                    update_post_meta($page_id, '_wp_page_template', 'front-page.php');
                }
            }
            
            // Set WordPress to display a static front page
            update_option('show_on_front', 'page');
            
            // Set the front page to the page we just created/found
            update_option('page_on_front', $page_id);
            
            // Create a blog page if needed and set it as the posts page
            kuperbush_create_blog_page($apply_changes);
        }
        
        return $page_id;
    }
}

if (!function_exists('kuperbush_create_blog_page')) {
    /**
     * Create a blog page and set it as the posts page
     * 
     * @param bool $apply_changes Whether to actually set the blog page (default: false)
     * @return int|bool Page ID if created/found, false on failure
     */
    function kuperbush_create_blog_page($apply_changes = false) {
        // Check if a posts page is already set
        $posts_page_id = get_option('page_for_posts');
        if ($posts_page_id > 0) {
            return $posts_page_id;
        }
        
        // Check if a page with the slug 'blog' already exists
        $existing_page = get_page_by_path('blog');
        $page_id = 0;
        
        // If page doesn't exist, create it
        if (!$existing_page) {
            $page_id = wp_insert_post(array(
                'post_title'    => 'Blog',
                'post_name'     => 'blog',
                'post_content'  => '<!-- Blog page content created automatically -->',
                'post_status'   => 'publish',
                'post_type'     => 'page',
                'comment_status' => 'open'
            ));
        } else {
            $page_id = $existing_page->ID;
        }
        
        if ($page_id && $apply_changes) {
            // Set the page as the posts page
            update_option('page_for_posts', $page_id);
        }
        
        return $page_id;
    }
}

/**
 * Add functionality to admin tools page
 */
if (!function_exists('kuperbush_front_page_admin_tools')) {
    function kuperbush_front_page_admin_tools() {
        // Make sure there's a Kuperbush admin tools section
        if (!function_exists('kuperbush_admin_tools_page')) {
            return;
        }
        
        // Add the front page section to the admin tools page
        add_action('admin_init', function() {
            // Register our section
            add_settings_section(
                'kuperbush_front_page_section',
                'Front Page Setup',
                'kuperbush_front_page_section_callback',
                'kuperbush_tools_page'
            );
        });
    }
}
add_action('init', 'kuperbush_front_page_admin_tools');

/**
 * Output front page settings section
 */
if (!function_exists('kuperbush_front_page_section_callback')) {
    function kuperbush_front_page_section_callback() {
        // Check if form was submitted
        if (isset($_POST['kuperbush_front_page_nonce']) && 
            wp_verify_nonce($_POST['kuperbush_front_page_nonce'], 'kuperbush_front_page_action')) {
            
            if (isset($_POST['kuperbush_apply_front_page'])) {
                // Apply front page settings
                $result = kuperbush_create_front_page(true);
                if ($result) {
                    echo '<div class="notice notice-success"><p>Front page has been created and set as the homepage!</p></div>';
                } else {
                    echo '<div class="notice notice-error"><p>An error occurred while configuring the front page.</p></div>';
                }
            } else {
                // Just create the pages without applying settings
                $result = kuperbush_create_front_page(false);
                if ($result) {
                    echo '<div class="notice notice-success"><p>Front page has been created but not set as the homepage.</p></div>';
                } else {
                    echo '<div class="notice notice-error"><p>An error occurred while creating the front page.</p></div>';
                }
            }
        }
        
        // Get current front page settings
        $show_on_front = get_option('show_on_front');
        $page_on_front = get_option('page_on_front');
        $page_for_posts = get_option('page_for_posts');
        
        $front_page = $page_on_front ? get_post($page_on_front) : null;
        $posts_page = $page_for_posts ? get_post($page_for_posts) : null;
        
        ?>
        <div class="card">
            <h2>Front Page Settings</h2>
            <p>This tool will create a front page and optionally set it as the homepage in WordPress settings.</p>
            
            <table class="widefat">
                <tr>
                    <th>Current Homepage Display</th>
                    <td><?php echo $show_on_front === 'page' ? 'Static page' : 'Latest posts'; ?></td>
                </tr>
                <tr>
                    <th>Current Front Page</th>
                    <td>
                        <?php if ($front_page): ?>
                            <?php echo esc_html($front_page->post_title); ?> (ID: <?php echo esc_html($front_page->ID); ?>)
                        <?php else: ?>
                            Not set
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Current Posts Page</th>
                    <td>
                        <?php if ($posts_page): ?>
                            <?php echo esc_html($posts_page->post_title); ?> (ID: <?php echo esc_html($posts_page->ID); ?>)
                        <?php else: ?>
                            Not set
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
            
            <form method="post" action="" style="margin-top: 1em;">
                <?php wp_nonce_field('kuperbush_front_page_action', 'kuperbush_front_page_nonce'); ?>
                
                <p>
                    <label>
                        <input type="checkbox" name="kuperbush_apply_front_page" value="1">
                        Apply front page settings (change WordPress settings to use this page as front page)
                    </label>
                </p>
                
                <p><input type="submit" class="button button-primary" value="Setup Front Page"></p>
            </form>
            
            <p class="description" style="margin-top: 1em;">
                <strong>Note:</strong> If you don't check the "Apply front page settings" box, 
                pages will be created but your current homepage settings will not be changed.
            </p>
        </div>
        <?php
    }
}

/**
 * Register a custom admin page for front page tools if needed
 */
if (!function_exists('kuperbush_register_front_page_tools')) {
    function kuperbush_register_front_page_tools() {
        if (!function_exists('kuperbush_admin_tools_page')) {
            // If the main tools page doesn't exist, create our own
            add_menu_page(
                'Front Page Setup',
                'Front Page',
                'manage_options',
                'kuperbush-front-page',
                'kuperbush_front_page_tools_page',
                'dashicons-admin-home',
                80
            );
        }
    }
}
add_action('admin_menu', 'kuperbush_register_front_page_tools');

/**
 * Output the stand-alone front page tools page if needed
 */
if (!function_exists('kuperbush_front_page_tools_page')) {
    function kuperbush_front_page_tools_page() {
        ?>
        <div class="wrap">
            <h1>Kuperbush Front Page Setup</h1>
            <?php kuperbush_front_page_section_callback(); ?>
        </div>
        <?php
    }
}

/**
 * Add our section to the main Kuperbush admin tools page
 */
function kuperbush_add_to_admin_tools() {
    if (function_exists('kuperbush_front_page_section_callback')) {
        kuperbush_front_page_section_callback();
    }
}
add_action('kuperbush_admin_tools_sections', 'kuperbush_add_to_admin_tools');