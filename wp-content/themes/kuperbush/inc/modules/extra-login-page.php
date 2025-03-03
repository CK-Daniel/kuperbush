<?php
/**
 * Custom Login Page Module
 * Provides functionality for customizing the WordPress login page
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue custom login CSS
 */
function kuperbush_custom_login_css() {
    // Only run if the feature is enabled
    if (!get_option('kuperbush_enable_custom_login', false)) {
        return;
    }
    
    $td = get_template_directory_uri() . '/inc/modules';
    wp_enqueue_style('custom-login-css', $td . '/css/style-login.css');
}
add_action('login_enqueue_scripts', 'kuperbush_custom_login_css', 10);

/**
 * Add custom HTML before the login form
 */
function kuperbush_before_login_form() {
    // Only run if the feature is enabled
    if (!get_option('kuperbush_enable_custom_login', false)) {
        return;
    }
    
    $td = get_template_directory_uri() . '/inc/modules';
?>
    <div class="wrapper-login">
        <div class="inner">
            <div class="part-custom">
                <div class="wrapper">
                    <a class="logo" href="<?php echo esc_url(home_url('/')); ?>" target="_blank">
                        <img src="<?php echo esc_url($td); ?>/img/extra-logo.png">
                    </a>
                    <div class="by-extra">
                        <img src="<?php echo esc_url($td); ?>/img/by-extra.png">
                    </div>
                </div>
            </div>
            
            <div class="part-default">
<?php
}
add_action('login_head', 'kuperbush_before_login_form', 10);

/**
 * Add custom HTML after the login form
 */
function kuperbush_after_login_form() {
    // Only run if the feature is enabled
    if (!get_option('kuperbush_enable_custom_login', false)) {
        return;
    }
    
    $td = get_template_directory_uri() . '/inc/modules';
?>
            </div> <!-- part-default -->
        </div> <!-- inner -->
    </div> <!-- wrapper-login -->
<?php
}
add_action('login_footer', 'kuperbush_after_login_form', 10);