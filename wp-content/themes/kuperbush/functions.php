<?php
/**
 * Kuperbush Theme functions and definitions
 */

/**
 * Load modular theme files
 */
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
require_once get_template_directory() . '/inc/modules/admin-tools.php';
require_once get_template_directory() . '/inc/modules/extra-login-page.php';

// Custom post types
require_once get_template_directory() . '/inc/cpt-products.php';