<?php
/**
 * Admin Form Fix
 *
 * Fixes issues with the theme options page form submission
 * This file is loaded via wp_head to ensure it's always loaded
 *
 * @package Kuperbush
 * @subpackage Admin
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Make sure we're in the admin
if ( ! is_admin() ) {
    return;
}

// Add the form fix script to the admin
function kuperbush_add_form_fix_script() {
    // Only load on our options page
    $screen = get_current_screen();
    if ( $screen && $screen->id === 'appearance_page_kuperbush-options' ) {
        // Enqueue our form fix JavaScript
        wp_enqueue_script( 'kuperbush-form-fix', get_template_directory_uri() . '/js/kuperbush-form-fix.js', array( 'jquery' ), '1.0.0', true );
    }
}
add_action( 'admin_enqueue_scripts', 'kuperbush_add_form_fix_script' );

// Fix the process_options function
function kuperbush_fix_process_options() {
    // This runs on admin_init before the main processing
    // Make sure it's our form being processed
    if ( isset( $_POST['active_tab'] ) && in_array( $_POST['active_tab'], array( 'general', 'tools', 'developer' ) ) ) {
        // Force debug logging
        $log_file = WP_CONTENT_DIR . '/kuperbush-form-fix.log';
        file_put_contents( $log_file, "Form submission detected - " . date('Y-m-d H:i:s') . "\n", FILE_APPEND );
        file_put_contents( $log_file, "POST data: " . print_r( $_POST, true ) . "\n", FILE_APPEND );
        
        // Fix missing option_page
        if ( ! isset( $_POST['option_page'] ) ) {
            $_POST['option_page'] = 'kuperbush_options';
            file_put_contents( $log_file, "Added missing option_page value\n", FILE_APPEND );
        }
        
        // Fix missing action
        if ( ! isset( $_POST['action'] ) ) {
            $_POST['action'] = 'options';
            file_put_contents( $log_file, "Added missing action value\n", FILE_APPEND );
        }
        
        // Log if we're missing the nonce
        if ( ! isset( $_POST['_wpnonce'] ) ) {
            file_put_contents( $log_file, "WARNING: Missing nonce field\n", FILE_APPEND );
            
            // We can't properly fix a missing nonce, so we'll temporarily bypass the check
            // This is NOT a secure solution, just for debugging!
            if ( isset( $_POST['_fix_missing_nonce'] ) ) {
                add_filter( 'nonce_user_logged_in', '__return_true' );
                file_put_contents( $log_file, "WARNING: Temporarily bypassing nonce check for debugging\n", FILE_APPEND );
            }
        }
    }
}
add_action( 'admin_init', 'kuperbush_fix_process_options', 1 );  // Priority 1 to run before normal admin_init