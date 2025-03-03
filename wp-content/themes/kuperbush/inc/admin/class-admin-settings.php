<?php
/**
 * Admin Settings Manager
 *
 * Core class for handling theme settings and options management
 *
 * @package Kuperbush
 * @subpackage Admin
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Kuperbush_Admin_Settings class
 *
 * Handles admin settings registration, rendering, and processing
 */
class Kuperbush_Admin_Settings {

    /**
     * The single instance of the class
     *
     * @var Kuperbush_Admin_Settings
     */
    protected static $_instance = null;

    /**
     * Settings fields registry
     *
     * @var array
     */
    private $settings = array();

    /**
     * Settings tabs registry
     *
     * @var array
     */
    private $tabs = array();

    /**
     * Active tab
     *
     * @var string
     */
    private $active_tab = 'general';

    /**
     * Debug mode
     *
     * @var bool
     */
    private $debug = false;

    /**
     * Main Kuperbush_Admin_Settings Instance
     *
     * Ensures only one instance of Kuperbush_Admin_Settings is loaded or can be loaded.
     *
     * @return Kuperbush_Admin_Settings Main instance
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->debug = defined( 'WP_DEBUG' ) && WP_DEBUG;
        $this->hooks();
    }

    /**
     * Setup hooks
     */
    public function hooks() {
        add_action( 'admin_init', array( $this, 'register_settings' ) );
        add_action( 'admin_menu', array( $this, 'add_options_page' ) );
        add_action( 'admin_post', array( $this, 'process_options' ) );
        add_action( 'admin_post_options', array( $this, 'process_options' ) );
        add_action( 'admin_notices', array( $this, 'admin_notices' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
    }

    /**
     * Register admin scripts and styles
     */
    public function admin_scripts() {
        $screen = get_current_screen();
        
        // Only load on our options page
        if ( $screen && $screen->id === 'appearance_page_kuperbush-options' ) {
            wp_enqueue_style( 'kuperbush-admin-styles', get_template_directory_uri() . '/css/kuperbush-admin.css', array(), '1.0.0' );
            wp_enqueue_script( 'kuperbush-admin-script', get_template_directory_uri() . '/js/kuperbush-admin.js', array( 'jquery' ), '1.0.0', true );
        }
    }

    /**
     * Add Theme Options page to the menu
     */
    public function add_options_page() {
        add_theme_page(
            __( 'Kuperbush Theme Options', 'kuperbush' ),
            __( 'Theme Options', 'kuperbush' ),
            'manage_options',
            'kuperbush-options',
            array( $this, 'options_page_callback' )
        );
    }

    /**
     * Register theme settings
     */
    public function register_settings() {
        // Core settings
        register_setting( 'kuperbush_options', 'kuperbush_show_template_name', array(
            'type'              => 'boolean',
            'default'           => true,
            'sanitize_callback' => 'rest_sanitize_boolean',
        ) );
        
        register_setting( 'kuperbush_options', 'kuperbush_disable_gutenberg', array(
            'type'              => 'boolean',
            'default'           => false,
            'sanitize_callback' => 'rest_sanitize_boolean',
        ) );
        
        // Register custom login page setting
        register_setting( 'kuperbush_options', 'kuperbush_enable_custom_login', array(
            'type'              => 'boolean',
            'default'           => false,
            'sanitize_callback' => 'rest_sanitize_boolean',
        ) );
        
        // Register post type specific Gutenberg settings
        $post_types = $this->get_editor_post_types();
        foreach ( $post_types as $post_type ) {
            register_setting( 'kuperbush_options', 'kuperbush_disable_gutenberg_' . $post_type->name, array(
                'type'              => 'boolean',
                'default'           => false,
                'sanitize_callback' => 'rest_sanitize_boolean',
            ) );
        }
        
        // Register all fields defined in admin modules
        $modules = $this->get_admin_modules();
        foreach ( $modules as $tab_id => $tab_data ) {
            if ( isset( $tab_data['sections'] ) ) {
                foreach ( $tab_data['sections'] as $section_id => $section ) {
                    if ( ! empty( $section['fields'] ) ) {
                        $fields = is_callable( $section['fields'] ) ? call_user_func( $section['fields'] ) : $section['fields'];
                        foreach ( $fields as $field_id => $field_data ) {
                            // Skip if already registered
                            if ( isset( $GLOBALS['wp_registered_settings'][$field_id] ) ) {
                                continue;
                            }
                            
                            $args = array();
                            
                            // Set type based on field type
                            if ( isset( $field_data['type'] ) ) {
                                switch ( $field_data['type'] ) {
                                    case 'checkbox':
                                        $args['type'] = 'boolean';
                                        $args['sanitize_callback'] = 'rest_sanitize_boolean';
                                        break;
                                    case 'text':
                                        $args['type'] = 'string';
                                        $args['sanitize_callback'] = 'sanitize_text_field';
                                        break;
                                    case 'select':
                                        $args['type'] = 'string';
                                        break;
                                    default:
                                        $args['type'] = 'string';
                                        break;
                                }
                            }
                            
                            // Set default value if provided
                            if ( isset( $field_data['default'] ) ) {
                                $args['default'] = $field_data['default'];
                            }
                            
                            // Register the setting
                            register_setting( 'kuperbush_options', $field_id, $args );
                        }
                    }
                }
            }
        }
    }

    /**
     * Custom settings saving handler that preserves all tab settings
     */
    public function process_options() {
        // Debug logging
        if ( $this->debug ) {
            $log_file = WP_CONTENT_DIR . '/kuperbush-debug.log';
            file_put_contents( $log_file, "Processing options - POST data: " . print_r( $_POST, true ) . "\n", FILE_APPEND );
        }
        
        // Only run on our settings page submissions
        if ( ! isset( $_POST['option_page'] ) || $_POST['option_page'] !== 'kuperbush_options' ) {
            if ( $this->debug ) {
                file_put_contents( $log_file, "Not our option_page: " . ( isset( $_POST['option_page'] ) ? $_POST['option_page'] : 'not set' ) . "\n", FILE_APPEND );
            }
            return;
        }

        // Verify nonce
        check_admin_referer( 'kuperbush_options-options' );
        
        // Get active tab
        $active_tab = isset( $_POST['active_tab'] ) ? sanitize_key( $_POST['active_tab'] ) : 'general';
        $this->active_tab = $active_tab;
        
        if ( $this->debug ) {
            file_put_contents( $log_file, "Active tab: $active_tab\n", FILE_APPEND );
        }
        
        // Process custom form submissions
        $this->process_custom_forms();
        
        // Get all registered settings
        global $wp_registered_settings;
        
        // Get fields that should be updated in the current tab
        $current_tab_fields = array();
        $modules = $this->get_admin_modules();
        $updated_options = array();
        
        // First, collect all fields from all tabs to ensure we don't miss any
        foreach ( $modules as $tab_id => $tab_data ) {
            if ( isset( $tab_data['sections'] ) ) {
                foreach ( $tab_data['sections'] as $section_id => $section ) {
                    if ( ! empty( $section['fields'] ) ) {
                        $fields = is_callable( $section['fields'] ) ? call_user_func( $section['fields'] ) : $section['fields'];
                        foreach ( $fields as $field_id => $field_data ) {
                            if ( $tab_id === $active_tab ) {
                                // Mark fields in current tab for prioritized handling
                                $current_tab_fields[$field_id] = true;
                            }
                        }
                    }
                }
            }
        }
        
        // Special handling for tabs with special needs
        if ( $active_tab === 'general' ) {
            // These are the main options in the general tab that need special handling
            $general_tab_fields = array(
                'kuperbush_disable_gutenberg',
                'kuperbush_show_template_name',
                'kuperbush_enable_custom_login'
            );
            
            // Add post type specific fields
            $post_types = $this->get_editor_post_types();
            foreach ( $post_types as $post_type ) {
                $general_tab_fields[] = 'kuperbush_disable_gutenberg_' . $post_type->name;
            }
            
            // Add these to the current tab fields
            foreach ( $general_tab_fields as $field_id ) {
                $current_tab_fields[$field_id] = true;
                if ( $this->debug ) {
                    file_put_contents( $log_file, "Added general tab field: $field_id\n", FILE_APPEND );
                }
            }
        }
        
        // Process checkbox options first (unchecked checkboxes don't appear in $_POST)
        foreach ( $wp_registered_settings as $option_name => $option_data ) {
            // Only process our settings
            if ( strpos( $option_name, 'kuperbush_' ) !== 0 ) {
                continue;
            }
            
            // Special handling for some tabs
            $special_handling = in_array( $active_tab, array( 'general', 'tools' ), true );
            
            // Only update fields in the current tab or with special handling
            if ( isset( $current_tab_fields[$option_name] ) || $special_handling ) {
                // For checkboxes, set value to false if not in $_POST
                if ( isset( $option_data['type'] ) && $option_data['type'] === 'boolean' ) {
                    if ( ! isset( $_POST[$option_name] ) ) {
                        update_option( $option_name, false );
                        $updated_options[$option_name] = false;
                    }
                }
            }
        }
        
        // Process all other option fields
        foreach ( $wp_registered_settings as $option_name => $option_data ) {
            // Only process our settings
            if ( strpos( $option_name, 'kuperbush_' ) !== 0 ) {
                continue;
            }
            
            // Special handling for some tabs
            $special_handling = in_array( $active_tab, array( 'general', 'tools' ), true );
            
            // Only update fields in the current tab or with special handling
            if ( isset( $current_tab_fields[$option_name] ) || $special_handling ) {
                if ( isset( $_POST[$option_name] ) ) {
                    $value = $_POST[$option_name];
                    
                    // Apply sanitization if available
                    if ( isset( $option_data['sanitize_callback'] ) && is_callable( $option_data['sanitize_callback'] ) ) {
                        $value = call_user_func( $option_data['sanitize_callback'], $value );
                    }
                    
                    update_option( $option_name, $value );
                    $updated_options[$option_name] = $value;
                } else {
                    // For checkboxes that weren't checked (legacy handling for options without explicit type)
                    if ( ( strpos( $option_name, 'kuperbush_disable' ) === 0 || 
                         strpos( $option_name, 'kuperbush_enable' ) === 0 ||
                         strpos( $option_name, 'kuperbush_show' ) === 0 ) &&
                         ! isset( $updated_options[$option_name] ) ) {
                        
                        update_option( $option_name, false );
                        $updated_options[$option_name] = false;
                    }
                }
            }
        }
        
        // Add success message
        add_settings_error(
            'kuperbush_options',
            'settings_updated',
            __( 'Settings saved successfully!', 'kuperbush' ),
            'success'
        );
        
        // Ensure all settings are registered properly and saved into transient
        set_transient( 'settings_errors', get_settings_errors(), 30 );
        
        // Redirect back to the settings page
        wp_redirect( add_query_arg(
            array(
                'page' => 'kuperbush-options',
                'tab' => $active_tab,
                'settings-updated' => 'true'
            ),
            admin_url( 'themes.php' )
        ) );
        exit;
    }

    /**
     * Process custom form submissions (front page, template pages, etc.)
     */
    private function process_custom_forms() {
        // Process front page form
        if ( isset( $_POST['kuperbush_front_page_nonce'] ) && 
             wp_verify_nonce( $_POST['kuperbush_front_page_nonce'], 'kuperbush_front_page_action' ) ) {
            
            if ( $this->debug ) {
                $log_file = WP_CONTENT_DIR . '/kuperbush-debug.log';
                file_put_contents( $log_file, "Processing front page form\n", FILE_APPEND );
            }
            
            if ( isset( $_POST['kuperbush_apply_front_page'] ) ) {
                // Apply front page settings
                $result = kuperbush_create_front_page( true );
                if ( $result ) {
                    add_settings_error(
                        'kuperbush_options',
                        'kuperbush_front_page_success',
                        __( 'Front page has been created and set as the homepage!', 'kuperbush' ),
                        'success'
                    );
                } else {
                    add_settings_error(
                        'kuperbush_options',
                        'kuperbush_front_page_error',
                        __( 'An error occurred while configuring the front page.', 'kuperbush' ),
                        'error'
                    );
                }
            } else {
                // Just create the pages without applying settings
                $result = kuperbush_create_front_page( false );
                if ( $result ) {
                    add_settings_error(
                        'kuperbush_options',
                        'kuperbush_front_page_success',
                        __( 'Front page has been created but not set as the homepage.', 'kuperbush' ),
                        'success'
                    );
                } else {
                    add_settings_error(
                        'kuperbush_options',
                        'kuperbush_front_page_error',
                        __( 'An error occurred while creating the front page.', 'kuperbush' ),
                        'error'
                    );
                }
            }
        }
        
        // Process template pages form
        if ( isset( $_POST['kuperbush_create_pages'] ) && 
             isset( $_POST['_wpnonce'] ) && 
             wp_verify_nonce( $_POST['_wpnonce'], 'kuperbush_create_pages_nonce' ) ) {
            
            if ( $this->debug ) {
                $log_file = WP_CONTENT_DIR . '/kuperbush-debug.log';
                file_put_contents( $log_file, "Processing template pages form\n", FILE_APPEND );
            }
            
            // Call the function to create template pages
            if ( function_exists( 'kuperbush_create_template_pages' ) ) {
                $result = kuperbush_create_template_pages();
                if ( $result ) {
                    add_settings_error(
                        'kuperbush_options',
                        'kuperbush_template_pages_success',
                        __( 'Template pages have been created successfully!', 'kuperbush' ),
                        'success'
                    );
                } else {
                    add_settings_error(
                        'kuperbush_options',
                        'kuperbush_template_pages_error',
                        __( 'No new template pages were created.', 'kuperbush' ),
                        'info'
                    );
                }
            } else {
                add_settings_error(
                    'kuperbush_options',
                    'kuperbush_template_pages_error',
                    __( 'Template pages function is not available.', 'kuperbush' ),
                    'error'
                );
            }
        }
    }

    /**
     * Display settings errors for our custom form submissions
     */
    public function admin_notices() {
        // Get current screen
        $screen = get_current_screen();
        
        // Only show notices on our settings page
        if ( $screen && $screen->id === 'appearance_page_kuperbush-options' ) {
            // Show settings errors
            if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] === 'true' ) {
                add_settings_error(
                    'kuperbush_options',
                    'settings_updated',
                    __( 'Settings saved successfully.', 'kuperbush' ),
                    'success'
                );
            }
            
            // Display all errors and success messages
            settings_errors( 'kuperbush_options' );
        }
    }

    /**
     * Get available post types for editor settings
     *
     * @return array Associative array of post type objects
     */
    public function get_editor_post_types() {
        // Get all public post types
        $post_types = get_post_types( array( 'public' => true ), 'objects' );
        
        // Filter out some post types we don't want to include
        $excluded_types = array( 'attachment' );
        foreach ( $excluded_types as $excluded ) {
            if ( isset( $post_types[$excluded] ) ) {
                unset( $post_types[$excluded] );
            }
        }
        
        return $post_types;
    }

    /**
     * Get admin modules configuration
     * 
     * @return array Array of module configurations
     */
    public function get_admin_modules() {
        $modules = array(
            'general' => array(
                'title' => __( 'General', 'kuperbush' ),
                'icon' => 'dashicons-admin-generic',
                'description' => __( 'General theme settings and configuration options.', 'kuperbush' ),
                'sections' => array(
                    'front_page' => array(
                        'title' => __( 'Front Page Settings', 'kuperbush' ),
                        'description' => __( 'Configure your site\'s homepage and front page settings.', 'kuperbush' ),
                        'custom_content' => 'kuperbush_front_page_options_form',
                    ),
                    'editor' => array(
                        'title' => __( 'Editor Settings', 'kuperbush' ),
                        'description' => __( 'Configure how the WordPress editor behaves.', 'kuperbush' ),
                        'fields' => array(
                            'kuperbush_disable_gutenberg' => array(
                                'label' => __( 'Disable Gutenberg Editor Globally', 'kuperbush' ),
                                'description' => __( 'Use the classic editor instead of Gutenberg for all post types. Changes take effect on page reload.', 'kuperbush' ),
                                'type' => 'checkbox',
                                'default' => false,
                            ),
                        )
                    ),
                    'post_type_editor' => array(
                        'title' => __( 'Post Type Editor Settings', 'kuperbush' ),
                        'description' => __( 'Configure editor settings for specific post types.', 'kuperbush' ),
                        'before_fields' => '<div class="kuperbush-bulk-actions">
                            <button type="button" class="button kuperbush-select-all-post-types">' . __( 'Select All Post Types', 'kuperbush' ) . '</button>
                            <button type="button" class="button kuperbush-deselect-all-post-types">' . __( 'Deselect All', 'kuperbush' ) . '</button>
                        </div>',
                        'fields' => function() {
                            $fields = array();
                            $post_types = $this->get_editor_post_types();
                            
                            // Create a field for each post type
                            foreach ( $post_types as $post_type ) {
                                $fields['kuperbush_disable_gutenberg_' . $post_type->name] = array(
                                    'label' => sprintf( __( 'Disable Gutenberg for %s', 'kuperbush' ), $post_type->labels->name ),
                                    'description' => sprintf( __( 'Use the classic editor for %s. This setting is ignored if Gutenberg is disabled globally.', 'kuperbush' ), $post_type->labels->name ),
                                    'type' => 'checkbox',
                                    'default' => false,
                                    'post_type' => $post_type->name,
                                );
                            }
                            
                            return $fields;
                        },
                    ),
                    'login_page' => array(
                        'title' => __( 'Login Page', 'kuperbush' ),
                        'description' => __( 'Customize the WordPress login page.', 'kuperbush' ),
                        'fields' => array(
                            'kuperbush_enable_custom_login' => array(
                                'label' => __( 'Enable Custom Login Page', 'kuperbush' ),
                                'description' => __( 'Use the theme\'s custom styling for the WordPress login page.', 'kuperbush' ),
                                'type' => 'checkbox',
                                'default' => false,
                            ),
                        )
                    ),
                )
            ),
            'tools' => array(
                'title' => __( 'Tools', 'kuperbush' ),
                'icon' => 'dashicons-admin-tools',
                'description' => __( 'Theme tools and utilities.', 'kuperbush' ),
                'sections' => array(
                    'template_pages' => array(
                        'title' => __( 'Template Pages', 'kuperbush' ),
                        'description' => __( 'Manage pages automatically created from template files.', 'kuperbush' ),
                        'custom_content' => 'kuperbush_get_template_pages_form',
                    ),
                )
            ),
            'developer' => array(
                'title' => __( 'Developer', 'kuperbush' ),
                'icon' => 'dashicons-code-standards',
                'description' => __( 'Tools and settings for theme development and debugging.', 'kuperbush' ),
                'sections' => array(
                    'tools' => array(
                        'title' => __( 'Developer Tools', 'kuperbush' ),
                        'description' => __( 'Helpful utilities for theme development.', 'kuperbush' ),
                        'fields' => array(
                            'kuperbush_show_template_name' => array(
                                'label' => __( 'Show Template Name', 'kuperbush' ),
                                'description' => __( 'Display the current template file name in the admin bar.', 'kuperbush' ),
                                'type' => 'checkbox',
                                'default' => true,
                            ),
                        )
                    ),
                )
            ),
        );
        
        return apply_filters( 'kuperbush_admin_modules', $modules );
    }

    /**
     * Render a field based on its type
     * 
     * @param string $field_id The option name for this field
     * @param array $field Field configuration data
     */
    public function render_field( $field_id, $field ) {
        // Get the current value from the database, falling back to default if not set
        $value = get_option( $field_id, isset( $field['default'] ) ? $field['default'] : '' );
        
        switch ( $field['type'] ) {
            case 'checkbox':
                $disabled = ! empty( $field['disabled'] ) ? 'disabled="disabled"' : '';
                $field_class = ! empty( $field['disabled'] ) ? 'kuperbush-field-disabled' : '';
                ?>
                <div class="kuperbush-field kuperbush-field-checkbox <?php echo esc_attr( $field_class ); ?>">
                    <label class="kuperbush-toggle">
                        <input type="checkbox" name="<?php echo esc_attr( $field_id ); ?>" id="<?php echo esc_attr( $field_id ); ?>" value="1" <?php checked( $value, true ); ?> <?php echo $disabled; ?>>
                        <span class="kuperbush-toggle-slider"></span>
                    </label>
                    <label for="<?php echo esc_attr( $field_id ); ?>" class="kuperbush-field-label"><?php echo esc_html( $field['label'] ); ?></label>
                    <?php if ( ! empty( $field['description'] ) ) : ?>
                        <p class="kuperbush-field-description"><?php echo esc_html( $field['description'] ); ?></p>
                    <?php endif; ?>
                </div>
                <?php
                break;
                
            case 'text':
                ?>
                <div class="kuperbush-field kuperbush-field-text">
                    <label for="<?php echo esc_attr( $field_id ); ?>" class="kuperbush-field-label"><?php echo esc_html( $field['label'] ); ?></label>
                    <input type="text" name="<?php echo esc_attr( $field_id ); ?>" id="<?php echo esc_attr( $field_id ); ?>" value="<?php echo esc_attr( $value ); ?>" class="regular-text">
                    <?php if ( ! empty( $field['description'] ) ) : ?>
                        <p class="kuperbush-field-description"><?php echo esc_html( $field['description'] ); ?></p>
                    <?php endif; ?>
                </div>
                <?php
                break;
                
            case 'select':
                ?>
                <div class="kuperbush-field kuperbush-field-select">
                    <label for="<?php echo esc_attr( $field_id ); ?>" class="kuperbush-field-label"><?php echo esc_html( $field['label'] ); ?></label>
                    <select name="<?php echo esc_attr( $field_id ); ?>" id="<?php echo esc_attr( $field_id ); ?>">
                        <?php foreach ( $field['options'] as $option_key => $option_label ) : ?>
                            <option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $value, $option_key ); ?>><?php echo esc_html( $option_label ); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if ( ! empty( $field['description'] ) ) : ?>
                        <p class="kuperbush-field-description"><?php echo esc_html( $field['description'] ); ?></p>
                    <?php endif; ?>
                </div>
                <?php
                break;
                
            default:
                do_action( 'kuperbush_render_field_' . $field['type'], $field_id, $field );
                break;
        }
    }

    /**
     * Theme Options page content
     */
    public function options_page_callback() {
        $active_tab = isset( $_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : 'general';
        $modules = $this->get_admin_modules();
        
        // If the active tab doesn't exist, default to the first tab
        if ( ! isset( $modules[$active_tab] ) ) {
            $active_tab = key( $modules );
        }
        ?>
        <div class="kuperbush-admin-wrap">
            <div class="kuperbush-admin-header">
                <div class="kuperbush-admin-logo">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/img/kuppersbusch.svg' ); ?>" alt="Kuperbush">
                </div>
                <h1><?php _e( 'Theme Options', 'kuperbush' ); ?></h1>
                <div class="kuperbush-admin-version">
                    <span><?php _e( 'Version', 'kuperbush' ); ?>: <?php echo wp_get_theme()->get( 'Version' ); ?></span>
                </div>
            </div>
            
            <?php
            // Display settings errors/notifications
            settings_errors( 'kuperbush_options' );
            ?>
            
            <div class="kuperbush-admin-content">
                <div class="kuperbush-admin-sidebar">
                    <ul class="kuperbush-admin-tabs">
                        <?php foreach ( $modules as $tab_id => $tab ) : ?>
                            <li class="kuperbush-admin-tab <?php echo $active_tab === $tab_id ? 'active' : ''; ?>">
                                <a href="<?php echo esc_url( add_query_arg( 'tab', $tab_id ) ); ?>" class="kuperbush-admin-tab-link">
                                    <span class="dashicons <?php echo esc_attr( $tab['icon'] ); ?>"></span>
                                    <span class="kuperbush-admin-tab-label"><?php echo esc_html( $tab['title'] ); ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                
                <div class="kuperbush-admin-main">
                    <div class="kuperbush-admin-tab-content">
                        <div class="kuperbush-admin-module-header">
                            <h2><?php echo esc_html( $modules[$active_tab]['title'] ); ?></h2>
                            <p class="kuperbush-admin-module-description"><?php echo esc_html( $modules[$active_tab]['description'] ); ?></p>
                        </div>
                        
                        <form method="post" action="<?php echo admin_url( 'admin-post.php' ); ?>" class="kuperbush-admin-form">
                            <?php settings_fields( 'kuperbush_options' ); ?>
                            <input type="hidden" name="action" value="options">
                            <input type="hidden" name="active_tab" value="<?php echo esc_attr( $active_tab ); ?>">
                            
                            <?php foreach ( $modules[$active_tab]['sections'] as $section_id => $section ) : ?>
                                <div class="kuperbush-admin-section">
                                    <div class="kuperbush-admin-section-header">
                                        <h3><?php echo esc_html( $section['title'] ); ?></h3>
                                        <?php if ( ! empty( $section['description'] ) ) : ?>
                                            <p class="kuperbush-admin-section-description"><?php echo esc_html( $section['description'] ); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="kuperbush-admin-section-content">
                                        <?php 
                                        // Display any content that should appear before fields
                                        if ( ! empty( $section['before_fields'] ) ) {
                                            echo wp_kses_post( $section['before_fields'] );
                                        }
                                        
                                        // Check if this section has custom content
                                        if ( ! empty( $section['custom_content'] ) ) {
                                            if ( is_callable( $section['custom_content'] ) ) {
                                                // Call the function to get the content
                                                echo call_user_func( $section['custom_content'] );
                                            } else {
                                                // Direct HTML content
                                                echo wp_kses_post( $section['custom_content'] );
                                            }
                                        } 
                                        // Regular fields section
                                        elseif ( ! empty( $section['fields'] ) ) {
                                            // Handle both direct fields array and callable that returns fields
                                            $fields = is_callable( $section['fields'] ) ? call_user_func( $section['fields'] ) : $section['fields'];
                                            
                                            // Group fields by group if specified
                                            $has_groups = false;
                                            $grouped_fields = array();
                                            
                                            foreach ( $fields as $field_id => $field ) {
                                                // Check if the field has a group
                                                if ( ! empty( $field['group'] ) ) {
                                                    $has_groups = true;
                                                    $grouped_fields[$field['group']][$field_id] = $field;
                                                } else {
                                                    $grouped_fields['default'][$field_id] = $field;
                                                }
                                            }
                                            
                                            // Render grouped fields in fieldsets if needed
                                            if ( $has_groups ) {
                                                foreach ( $grouped_fields as $group_name => $group_fields ) {
                                                    if ( $group_name !== 'default' ) {
                                                        echo '<fieldset class="kuperbush-field-group"><legend>' . esc_html( $group_name ) . '</legend>';
                                                    }
                                                    
                                                    foreach ( $group_fields as $field_id => $field ) {
                                                        $this->render_field( $field_id, $field );
                                                    }
                                                    
                                                    if ( $group_name !== 'default' ) {
                                                        echo '</fieldset>';
                                                    }
                                                }
                                            } else {
                                                // No groups, just render fields normally
                                                foreach ( $fields as $field_id => $field ) {
                                                    $this->render_field( $field_id, $field );
                                                }
                                            }
                                        }
                                        
                                        // Display any content that should appear after fields
                                        if ( ! empty( $section['after_fields'] ) ) {
                                            echo wp_kses_post( $section['after_fields'] );
                                        }
                                        ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            
                            <?php submit_button( __( 'Save Changes', 'kuperbush' ), 'primary kuperbush-admin-submit-button' ); ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}

// Initialize Settings
Kuperbush_Admin_Settings::instance();