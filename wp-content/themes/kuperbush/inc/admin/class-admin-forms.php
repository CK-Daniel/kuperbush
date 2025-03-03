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
            
            <form method="post" action="<?php echo admin_url( 'admin-post.php' ); ?>" style="margin-top: 1em;" class="kuperbush-front-page-form">
                <?php wp_nonce_field( 'kuperbush_front_page_action', 'kuperbush_front_page_nonce' ); ?>
                <input type="hidden" name="active_tab" value="<?php echo isset( $_GET['tab'] ) ? esc_attr( sanitize_key( $_GET['tab'] ) ) : 'general'; ?>">
                <input type="hidden" name="option_page" value="kuperbush_options">
                <input type="hidden" name="action" value="options">
                
                <p>
                    <label>
                        <input type="checkbox" name="kuperbush_apply_front_page" value="1">
                        <?php _e( 'Apply front page settings (change WordPress settings to use this page as front page)', 'kuperbush' ); ?>
                    </label>
                </p>
                
                <p><input type="submit" class="button button-primary" value="<?php _e( 'Setup Front Page', 'kuperbush' ); ?>"></p>
            </form>
            
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
            <form method="post" action="<?php echo admin_url( 'admin-post.php' ); ?>" class="kuperbush-template-pages-form">
                <?php wp_nonce_field( 'kuperbush_create_pages_nonce' ); ?>
                <input type="hidden" name="kuperbush_create_pages" value="1">
                <input type="hidden" name="active_tab" value="<?php echo esc_attr( $active_tab ); ?>">
                <input type="hidden" name="option_page" value="kuperbush_options">
                <input type="hidden" name="action" value="options">
                <p><?php _e( 'This tool will create pages for your template files if they don\'t exist.', 'kuperbush' ); ?></p>
                <button type="submit" class="button button-primary"><?php _e( 'Create Template Pages', 'kuperbush' ); ?></button>
            </form>
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