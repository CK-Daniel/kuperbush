<?php
/**
 * Admin Functionality Bootstrap
 *
 * Main entry point for admin functionality
 *
 * @package Kuperbush
 * @subpackage Admin
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Load the admin classes and initialize admin functionality
 */
function kuperbush_admin_init() {
    // Include admin classes
    require_once get_template_directory() . '/inc/admin/class-admin-settings.php';
    require_once get_template_directory() . '/inc/admin/class-admin-editor.php';
    require_once get_template_directory() . '/inc/admin/class-admin-forms.php';
    
    // Initialize frontend function references
    if ( ! function_exists( 'kuperbush_front_page_options_form' ) ) {
        /**
         * Render front page options form
         * This is a frontend wrapper for the class method
         */
        function kuperbush_front_page_options_form() {
            return Kuperbush_Admin_Forms::instance()->front_page_options_form();
        }
    }
    
    if ( ! function_exists( 'kuperbush_get_template_pages_form' ) ) {
        /**
         * Render template pages form
         * This is a frontend wrapper for the class method
         */
        function kuperbush_get_template_pages_form() {
            return Kuperbush_Admin_Forms::instance()->template_pages_form();
        }
    }
}
add_action( 'after_setup_theme', 'kuperbush_admin_init' );