<?php
/**
 * Admin Editor Manager
 *
 * Handles editor-related functionality like Gutenberg disabling
 *
 * @package Kuperbush
 * @subpackage Admin
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Kuperbush_Admin_Editor class
 *
 * Handles editor-related settings and functionality
 */
class Kuperbush_Admin_Editor {
    /**
     * The single instance of the class
     *
     * @var Kuperbush_Admin_Editor
     */
    protected static $_instance = null;

    /**
     * Constructor
     */
    public function __construct() {
        $this->hooks();
    }

    /**
     * Main Kuperbush_Admin_Editor Instance
     *
     * Ensures only one instance of Kuperbush_Admin_Editor is loaded or can be loaded.
     *
     * @return Kuperbush_Admin_Editor Main instance
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Setup hooks
     */
    public function hooks() {
        add_action( 'init', array( $this, 'disable_gutenberg' ) );
        add_action( 'admin_bar_menu', array( $this, 'show_current_template_in_admin_bar' ), 999 );
    }

    /**
     * Disable Gutenberg editor based on settings
     * 
     * Allows for global or post-type specific disabling of the Gutenberg editor
     */
    public function disable_gutenberg() {
        // Global setting - disable Gutenberg for all post types
        if ( get_option( 'kuperbush_disable_gutenberg', false ) ) {
            // Disable Gutenberg editor completely
            add_filter( 'use_block_editor_for_post', '__return_false', 10 );
            add_filter( 'use_block_editor_for_post_type', '__return_false', 10 );
            
            // Disable Gutenberg widgets screen
            add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
            add_filter( 'use_widgets_block_editor', '__return_false' );
            
            return; // No need to check individual post types if global setting is on
        }
        
        // Post type specific settings
        add_filter( 'use_block_editor_for_post_type', function( $use_block_editor, $post_type ) {
            // Check if this specific post type has Gutenberg disabled
            if ( get_option( 'kuperbush_disable_gutenberg_' . $post_type, false ) ) {
                return false;
            }
            return $use_block_editor;
        }, 10, 2 );
        
        add_filter( 'use_block_editor_for_post', function( $use_block_editor, $post ) {
            $post_type = get_post_type( $post );
            // Check if this specific post type has Gutenberg disabled
            if ( get_option( 'kuperbush_disable_gutenberg_' . $post_type, false ) ) {
                return false;
            }
            return $use_block_editor;
        }, 10, 2 );
    }

    /**
     * Display current template file name in the top admin bar.
     */
    public function show_current_template_in_admin_bar( $wp_admin_bar ) {
        // Only show on front-end for users with admin privileges.
        if ( is_admin() || ! current_user_can( 'manage_options' ) ) {
            return;
        }

        // Check if the feature is enabled
        $show_template = get_option( 'kuperbush_show_template_name', true );
        if ( ! $show_template ) {
            return;
        }

        global $template;
        if ( empty( $template ) ) {
            return;
        }

        // Get just the filename from the full template path.
        $template_file = basename( $template );

        // Add a node to the admin bar.
        $wp_admin_bar->add_node( array(
            'id'    => 'current_template',
            'title' => 'Template: ' . $template_file,
        ) );
    }
}

// Initialize Editor Settings
Kuperbush_Admin_Editor::instance();