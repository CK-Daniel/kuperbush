<?php
/**
 * Add template-specific body classes
 */
if (!function_exists('kuperbush_template_body_classes')) {
    function kuperbush_template_body_classes($classes) {
        global $post;
        
        // Get the current template file using the most reliable method
        $template_file = '';
        if (is_object($post)) {
            $template_file = get_post_meta($post->ID, '_wp_page_template', true);
            // For backward compatibility, extract the filename if it contains a path
            if (strpos($template_file, '/') !== false) {
                $template_file = basename($template_file);
            }
        }
        
        // Log the template file for debugging
        error_log('Body class template file: ' . $template_file);
        
        // Add template-specific body classes
        if ($template_file === 'tmp-design.php' || $template_file === 'templates/tmp-design.php') {
            $classes[] = 'template-design';
        }
        
        if ($template_file === 'tmp-downloads.php' || $template_file === 'templates/tmp-downloads.php') {
            $classes[] = 'template-downloads';
        }
        
        if ($template_file === 'tmp-in-the-world.php' || $template_file === 'templates/tmp-in-the-world.php') {
            $classes[] = 'template-in-the-world';
        }
        
        if ($template_file === 'tmp-service.php' || $template_file === 'templates/tmp-service.php') {
            $classes[] = 'template-service';
        }
        
        if ($template_file === 'tmp-brand.php' || $template_file === 'templates/tmp-brand.php') {
            $classes[] = 'template-brand';
        }
        
        if ($template_file === 'tmp-history.php' || $template_file === 'templates/tmp-history.php') {
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
            
            // Log the template for debugging
            error_log('Template loader: ' . $page_template);
            
            if (!empty($page_template) && $page_template !== 'default') {
                // Check if the template is one of our custom templates
                // Check both formats: with and without the templates/ directory prefix
                if (strpos($page_template, 'tmp-') === 0 || strpos($page_template, 'templates/tmp-') === 0) {
                    // Ensure template path has the correct prefix
                    $template_file = basename($page_template);
                    $template_path = get_template_directory() . '/templates/' . $template_file;
                    
                    error_log('Looking for template at: ' . $template_path);
                    
                    if (file_exists($template_path)) {
                        error_log('Template found: ' . $template_path);
                        return $template_path;
                    } else {
                        error_log('Template not found: ' . $template_path);
                    }
                }
            }
        }
        
        return $template;
    }
}
add_filter('template_include', 'kuperbush_template_loader');