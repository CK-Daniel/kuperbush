<?php
/**
 * Theme setup functions
 */

if (!function_exists('kuperbush_setup')) {
    function kuperbush_setup() {
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        // Let WordPress manage the document title.
        add_theme_support('title-tag');

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support('post-thumbnails');

        // Register menus
        register_nav_menus(array(
            'primary' => esc_html__('Primary Menu', 'kuperbush'),
            'footer-products' => esc_html__('Footer Products Menu', 'kuperbush'),
            'footer-about' => esc_html__('Footer About Menu', 'kuperbush'),
            'footer-social' => esc_html__('Footer Social Menu', 'kuperbush'),
            'legal' => esc_html__('Legal Menu', 'kuperbush'),
        ));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');
    }
}
add_action('after_setup_theme', 'kuperbush_setup');