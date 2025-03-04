<?php
/**
 * Admin Forms Manager
 *
 * Handles admin form rendering and processing
 *
 * @package Kuperbush
 * @subpackage Admin
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Kuperbush_Admin_Forms class
 *
 * Handles custom form rendering and processing
 */
class Kuperbush_Admin_Forms {
    /**
     * The single instance of the class
     *
     * @var Kuperbush_Admin_Forms
     */
    protected static $_instance = null;

    /**
     * Constructor
     */
    public function __construct() {
        add_action( 'init', array( $this, 'init' ) );
    }

    /**
     * Main Kuperbush_Admin_Forms Instance
     *
     * Ensures only one instance of Kuperbush_Admin_Forms is loaded or can be loaded.
     *
     * @return Kuperbush_Admin_Forms Main instance
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Initialize the forms
     */
    public function init() {
        // Register form rendering callbacks
        add_action( 'kuperbush_front_page_options_form', array( $this, 'front_page_options_form' ) );
        add_action( 'kuperbush_get_template_pages_form', array( $this, 'template_pages_form' ) );
    }

    /**
     * Get front page options form HTML
     * This function displays the front page configuration options
     */
    public function front_page_options_form() {
        ob_start();
        
        // Get current front page settings
        $show_on_front = get_option( 'show_on_front' );
        $page_on_front = get_option( 'page_on_front' );
        $page_for_posts = get_option( 'page_for_posts' );
        
        $front_page = $page_on_front ? get_post( $page_on_front ) : null;
        $posts_page = $page_for_posts ? get_post( $page_for_posts ) : null;
        
        ?>
        <div class="kuperbush-form-container">
            <p><?php _e( 'This tool will create a front page and optionally set it as the homepage in WordPress settings.', 'kuperbush' ); ?></p>
            
            <table class="widefat" style="margin-bottom: 1em;">
                <tr>
                    <th><?php _e( 'Current Homepage Display', 'kuperbush' ); ?></th>
                    <td><?php echo $show_on_front === 'page' ? __( 'Static page', 'kuperbush' ) : __( 'Latest posts', 'kuperbush' ); ?></td>
                </tr>
                <tr>
                    <th><?php _e( 'Current Front Page', 'kuperbush' ); ?></th>
                    <td>
                        <?php if ( $front_page ) : ?>
                            <?php echo esc_html( $front_page->post_title ); ?> (ID: <?php echo esc_html( $front_page->ID ); ?>)
                        <?php else : ?>
                            <?php _e( 'Not set', 'kuperbush' ); ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th><?php _e( 'Current Posts Page', 'kuperbush' ); ?></th>
                    <td>
                        <?php if ( $posts_page ) : ?>
                            <?php echo esc_html( $posts_page->post_title ); ?> (ID: <?php echo esc_html( $posts_page->ID ); ?>)
                        <?php else : ?>
                            <?php _e( 'Not set', 'kuperbush' ); ?>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
            
            <div class="front-page-settings-container" style="margin-top: 1em;">
                <?php wp_nonce_field( 'kuperbush_front_page_action', 'kuperbush_front_page_nonce' ); ?>
                <!-- These fields will be used by JavaScript to submit via the main form -->
                
                <p>
                    <label>
                        <input type="checkbox" name="kuperbush_apply_front_page" value="1" id="kuperbush_apply_front_page">
                        <?php _e( 'Apply front page settings (change WordPress settings to use this page as front page)', 'kuperbush' ); ?>
                    </label>
                </p>
                
                <p><button type="button" class="button button-secondary kuperbush-setup-front-page" data-action="setup_front_page"><?php _e( 'Setup Front Page', 'kuperbush' ); ?></button></p>
            </div>
            
            <script>
                jQuery(document).ready(function($) {
                    // Handle the front page setup button click
                    $('.kuperbush-setup-front-page').on('click', function(e) {
                        e.preventDefault();
                        
                        // Get main form
                        const mainForm = $(this).closest('form.kuperbush-admin-form');
                        
                        // Set special field to indicate front page setup
                        if (!mainForm.find('input[name="kuperbush_setup_front_page"]').length) {
                            mainForm.append('<input type="hidden" name="kuperbush_setup_front_page" value="1">');
                        }
                        
                        // Check if apply checkbox is checked
                        const applyChecked = $('#kuperbush_apply_front_page').is(':checked');
                        if (applyChecked) {
                            if (!mainForm.find('input[name="kuperbush_apply_front_page"]').length) {
                                mainForm.append('<input type="hidden" name="kuperbush_apply_front_page" value="1">');
                            }
                        }
                        
                        // Copy over the nonce
                        const frontPageNonce = $('input[name="kuperbush_front_page_nonce"]').val();
                        if (frontPageNonce && !mainForm.find('input[name="kuperbush_front_page_nonce"]').length) {
                            mainForm.append('<input type="hidden" name="kuperbush_front_page_nonce" value="' + frontPageNonce + '">');
                        }
                        
                        // Submit the main form
                        console.log('Front page setup: Submitting main form');
                        mainForm.submit();
                    });
                });
            </script>
            
            <p class="description" style="margin-top: 1em;">
                <strong><?php _e( 'Note:', 'kuperbush' ); ?></strong> 
                <?php _e( 'If you don\'t check the "Apply front page settings" box, pages will be created but your current homepage settings will not be changed.', 'kuperbush' ); ?>
            </p>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Get template pages management form HTML
     */
    public function template_pages_form() {
        ob_start();
        $active_tab = isset( $_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : 'tools';
        ?>
        <div class="kuperbush-form-container">
            <div class="template-pages-settings-container">
                <?php wp_nonce_field( 'kuperbush_create_pages_nonce' ); ?>
                <!-- These fields will be used by JavaScript to submit via the main form -->
                
                <p><?php _e( 'This tool will create pages for your template files if they don\'t exist.', 'kuperbush' ); ?></p>
                <button type="button" class="button button-secondary kuperbush-create-template-pages" data-action="create_template_pages"><?php _e( 'Create Template Pages', 'kuperbush' ); ?></button>
            </div>
            
            <script>
                jQuery(document).ready(function($) {
                    // Handle the template pages button click
                    $('.kuperbush-create-template-pages').on('click', function(e) {
                        e.preventDefault();
                        
                        // Get main form
                        const mainForm = $(this).closest('form.kuperbush-admin-form');
                        
                        // Set special field to indicate template pages creation
                        if (!mainForm.find('input[name="kuperbush_create_pages"]').length) {
                            mainForm.append('<input type="hidden" name="kuperbush_create_pages" value="1">');
                        }
                        
                        // Copy over the nonce
                        const pagesNonce = $('input[name="_wpnonce"]').val();
                        if (pagesNonce && !mainForm.find('input[name="kuperbush_pages_nonce"]').length) {
                            mainForm.append('<input type="hidden" name="kuperbush_pages_nonce" value="' + pagesNonce + '">');
                        }
                        
                        // Submit the main form
                        console.log('Template pages: Submitting main form');
                        mainForm.submit();
                    });
                });
            </script>
        </div>
        <?php
        // Get template pages table
        if ( function_exists( 'kuperbush_get_template_pages_table' ) ) {
            echo kuperbush_get_template_pages_table();
        }
        
        return ob_get_clean();
    }
}

// Initialize Forms
Kuperbush_Admin_Forms::instance();