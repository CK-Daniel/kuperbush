<?php
/**
 * Front Page Module
 * 
 * This module handles the creation of the front page and 
 * sets it as the homepage in WordPress settings when explicitly requested.
 * It does NOT modify the front page automatically on theme activation.
 * 
 * Note: The admin UI has been moved to admin-tools.php
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
 * Add a notice to inform users about the new location of front page settings
 */
function kuperbush_front_page_admin_notice() {
    global $pagenow;
    
    // Only show on the kuperbush-front-page admin page if someone tries to access it directly
    if ($pagenow === 'admin.php' && isset($_GET['page']) && $_GET['page'] === 'kuperbush-front-page') {
        ?>
        <div class="notice notice-info">
            <p><strong>Front Page Setup has moved!</strong> Front page settings are now available in the <a href="<?php echo admin_url('themes.php?page=kuperbush-options'); ?>">Theme Options</a> page under the General tab.</p>
        </div>
        <?php
        
        // Auto-redirect after 5 seconds
        ?>
        <script>
        setTimeout(function() {
            window.location.href = '<?php echo esc_url(admin_url('themes.php?page=kuperbush-options')); ?>';
        }, 5000);
        </script>
        <?php
    }
}
add_action('admin_notices', 'kuperbush_front_page_admin_notice');