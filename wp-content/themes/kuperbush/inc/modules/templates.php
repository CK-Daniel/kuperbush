<?php
/**
 * Add template-specific body classes
 */
if (!function_exists('kuperbush_template_body_classes')) {
    function kuperbush_template_body_classes($classes) {
        // Get the current template file
        $template_file = basename(get_page_template());
        
        // Add template-specific body classes
        if ($template_file === 'tmp-design.php') {
            $classes[] = 'template-design';
        }
        
        if ($template_file === 'tmp-downloads.php') {
            $classes[] = 'template-downloads';
        }
        
        if ($template_file === 'tmp-in-the-world.php') {
            $classes[] = 'template-in-the-world';
        }
        
        if ($template_file === 'tmp-service.php') {
            $classes[] = 'template-service';
        }
        
        if ($template_file === 'tmp-brand.php') {
            $classes[] = 'template-brand';
        }
        
        if ($template_file === 'tmp-history.php') {
            $classes[] = 'template-history page-template-tp-historia page-template-tp-historia-php';
        }
        
        return $classes;
    }
}
add_filter('body_class', 'kuperbush_template_body_classes');

/**
 * Template loader function
 * This function checks for templates in the templates directory
 */
if (!function_exists('kuperbush_template_loader')) {
    function kuperbush_template_loader($template) {
        // Check if a template exists in our templates directory
        if (is_page()) {
            $page_template = get_post_meta(get_the_ID(), '_wp_page_template', true);
            
            if (!empty($page_template) && $page_template !== 'default') {
                // Check if the template is one of our custom templates
                if (strpos($page_template, 'tmp-') === 0) {
                    $template_path = get_template_directory() . '/templates/' . $page_template;
                    
                    if (file_exists($template_path)) {
                        return $template_path;
                    }
                }
            }
        }
        
        return $template;
    }
}
add_filter('template_include', 'kuperbush_template_loader');