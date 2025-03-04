<?php
/**
 * Kuperbush Theme functions and definitions
 */

/**
 * Load modular theme files
 */
// Form fix for theme admin settings - load FIRST to ensure it's available early
require_once get_template_directory() . '/inc/after-form-fix.php';

// Core theme functionality
require_once get_template_directory() . '/inc/modules/setup.php';
require_once get_template_directory() . '/inc/modules/scripts.php';
require_once get_template_directory() . '/inc/modules/widgets.php';
require_once get_template_directory() . '/inc/modules/templates.php';
require_once get_template_directory() . '/inc/modules/products.php';
require_once get_template_directory() . '/inc/modules/fallbacks.php';
require_once get_template_directory() . '/inc/modules/template-registry.php';
require_once get_template_directory() . '/inc/modules/auto-pages.php';
require_once get_template_directory() . '/inc/modules/template-utility.php';
require_once get_template_directory() . '/inc/modules/front-page.php';
require_once get_template_directory() . '/inc/modules/front-page-scripts.php';
// New modular admin structure (replacing admin-tools.php)
require_once get_template_directory() . '/inc/admin/admin.php';
require_once get_template_directory() . '/inc/modules/extra-login-page.php';

// Custom post types
require_once get_template_directory() . '/inc/cpt-products.php';
require_once get_template_directory() . '/inc/mock-products.php';

/**
 * Fix for theme options page form submission
 * 
 * This enqueues a script that addresses issues with form submission on the theme options page
 */
function kuperbush_admin_form_fix() {
    $screen = get_current_screen();
    
    // Only load on our options page
    if ( $screen && $screen->id === 'appearance_page_kuperbush-options' ) {
        wp_enqueue_script( 'kuperbush-form-fix', get_template_directory_uri() . '/js/form-fix.js', array( 'jquery' ), '1.0.0', true );
    }
}
add_action( 'admin_enqueue_scripts', 'kuperbush_admin_form_fix' );

// Handle form submissions in non-standard way if needed
function kuperbush_fix_form_processing() {
    if ( is_admin() && isset( $_SERVER['REQUEST_METHOD'] ) && $_SERVER['REQUEST_METHOD'] === 'POST' ) {
        // Only run if we're on our options page submission
        if ( isset( $_POST['active_tab'] ) && in_array( $_POST['active_tab'], array( 'general', 'tools', 'developer' ) ) ) {
            // Log the submission for debugging
            $log_file = WP_CONTENT_DIR . '/kuperbush-fix.log';
            file_put_contents( $log_file, "Form submission detected at " . date('Y-m-d H:i:s') . "\n", FILE_APPEND );
            file_put_contents( $log_file, "POST: " . print_r( $_POST, true ) . "\n", FILE_APPEND );
            
            // Fix missing option_page (critical for WordPress settings API)
            if ( ! isset( $_POST['option_page'] ) && isset( $_POST['active_tab'] ) ) {
                $_POST['option_page'] = 'kuperbush_options';
                file_put_contents( $log_file, "Added missing option_page\n", FILE_APPEND );
            }
        }
    }
}
add_action( 'admin_init', 'kuperbush_fix_form_processing', 5 );  // Priority 5 to run before normal admin_init