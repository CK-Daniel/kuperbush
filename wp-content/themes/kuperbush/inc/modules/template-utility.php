<?php
/**
 * Template Utility Module
 * 
 * Tools and utilities for generating new template files and their associated CSS/JS files
 */

if (!function_exists('kuperbush_create_template_files')) {
    /**
     * Create a new template file and associated assets
     * 
     * This function creates a new template file and its associated CSS and JS files.
     * It also registers the template in the centralized template registry.
     * 
     * @param string $template_name Name of the template (without tmp- prefix or .php extension)
     * @param string $title Page title
     * @param string $slug URL slug (optional, will be generated from title if not provided)
     * @return boolean Success status
     */
    function kuperbush_create_template_files($template_name, $title, $slug = '') {
        // Check if template name is valid
        if (empty($template_name)) {
            return false;
        }
        
        // Generate slug if not provided
        if (empty($slug)) {
            $slug = sanitize_title($template_name);
        } else {
            $slug = sanitize_title($slug);
        }
        
        // Set up paths
        $template_dir = get_template_directory() . '/templates/';
        $css_dir = get_template_directory() . '/css/templates/';
        $js_dir = get_template_directory() . '/js/templates/';
        
        // Ensure directories exist
        wp_mkdir_p($template_dir);
        wp_mkdir_p($css_dir);
        wp_mkdir_p($js_dir);
        
        // Create template file
        $template_file = $template_dir . 'tmp-' . $slug . '.php';
        
        if (!file_exists($template_file)) {
            $template_content = <<<EOT
<?php
/**
 * Template Name: {$title}
 *
 * @package Kuperbush
 */

get_header();
?>

<div id="main-content">
    <div class="container">
        <div id="content-area" class="clearfix">
            <div id="{$slug}-content">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                        
                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
EOT;
            
            // Create the template file
            file_put_contents($template_file, $template_content);
        }
        
        // Create CSS file
        $css_file = $css_dir . $slug . '.css';
        
        if (!file_exists($css_file)) {
            $css_content = <<<EOT
/**
 * {$title} Template Styles
 */

/* Main container */
#{$slug}-content {
    padding: 2em 0;
}

/* Add your template-specific styles here */

EOT;
            
            // Create the CSS file
            file_put_contents($css_file, $css_content);
        }
        
        // Create JS file
        $js_file = $js_dir . $slug . '.js';
        
        if (!file_exists($js_file)) {
            $js_content = <<<EOT
/**
 * {$title} Template JavaScript
 */

(function($) {
    'use strict';
    
    // Document ready
    $(function() {
        // Add your template-specific JS here
        console.log('{$title} template initialized');
    });
    
})(jQuery);

EOT;
            
            // Create the JS file
            file_put_contents($js_file, $js_content);
        }
        
        // Register the template in the template registry
        kuperbush_add_template_to_config($template_name, $title, $slug);
        
        return true;
    }
}

if (!function_exists('kuperbush_add_template_to_config')) {
    /**
     * Add a new template to the template registry
     * 
     * This function adds a new template to the centralized template registry.
     * 
     * @param string $template_name Template name (without tmp- prefix or .php extension)
     * @param string $title Page title
     * @param string $slug URL slug
     * @return boolean Success status
     */
    function kuperbush_add_template_to_config($template_name, $title, $slug) {
        // Call the template registry function to register the new template
        if (function_exists('kuperbush_register_template')) {
            $template_file = 'tmp-' . $slug . '.php';
            $content = '<!-- ' . $title . ' page content created automatically -->';
            
            return kuperbush_register_template($template_file, $title, $slug, $content);
        }
        
        return false;
    }
}

/**
 * Add admin page for template generation
 */
if (!function_exists('kuperbush_add_template_generator_page')) {
    function kuperbush_add_template_generator_page() {
        add_submenu_page(
            'themes.php',
            'Template Generator',
            'Template Generator',
            'manage_options',
            'kuperbush-template-generator',
            'kuperbush_template_generator_page'
        );
    }
}
add_action('admin_menu', 'kuperbush_add_template_generator_page');

/**
 * Template generator admin page callback
 */
if (!function_exists('kuperbush_template_generator_page')) {
    function kuperbush_template_generator_page() {
        // Process form submission
        $message = '';
        
        if (isset($_POST['kuperbush_generate_template']) && check_admin_referer('kuperbush_generate_template_nonce')) {
            $template_name = sanitize_text_field($_POST['template_name']);
            $title = sanitize_text_field($_POST['template_title']);
            $slug = sanitize_title($_POST['template_slug']);
            
            if (empty($template_name) || empty($title)) {
                $message = '<div class="notice notice-error"><p>Template name and title are required!</p></div>';
            } else {
                $result = kuperbush_create_template_files($template_name, $title, $slug);
                
                if ($result) {
                    $message = '<div class="notice notice-success"><p>Template files were created successfully!</p></div>';
                } else {
                    $message = '<div class="notice notice-error"><p>An error occurred while creating template files.</p></div>';
                }
            }
        }
        
        ?>
        <div class="wrap">
            <h1>Template Generator</h1>
            
            <?php echo $message; ?>
            
            <div class="card">
                <h2>Generate New Template Files</h2>
                <p>This tool will create a new template file and associated CSS and JS files. The template will be automatically added to the template registry for auto-page creation.</p>
                
                <form method="post" action="">
                    <?php wp_nonce_field('kuperbush_generate_template_nonce'); ?>
                    <input type="hidden" name="kuperbush_generate_template" value="1">
                    
                    <table class="form-table">
                        <tr>
                            <th scope="row"><label for="template_name">Template Name</label></th>
                            <td>
                                <input type="text" id="template_name" name="template_name" class="regular-text" required>
                                <p class="description">Internal reference name (e.g. "About Us")</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="template_title">Page Title</label></th>
                            <td>
                                <input type="text" id="template_title" name="template_title" class="regular-text" required>
                                <p class="description">Title for the page (e.g. "About Our Company")</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="template_slug">URL Slug</label></th>
                            <td>
                                <input type="text" id="template_slug" name="template_slug" class="regular-text">
                                <p class="description">URL slug (e.g. "about-us") - will be generated from title if left blank</p>
                            </td>
                        </tr>
                    </table>
                    
                    <p><input type="submit" class="button button-primary" value="Generate Template Files"></p>
                </form>
            </div>
            
            <div class="card">
                <h2>Existing Template Files</h2>
                <table class="widefat">
                    <thead>
                        <tr>
                            <th>Template File</th>
                            <th>CSS File</th>
                            <th>JS File</th>
                            <th>In Registry</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Get all template files
                        $template_dir = get_template_directory() . '/templates/';
                        $css_dir = get_template_directory() . '/css/templates/';
                        $js_dir = get_template_directory() . '/js/templates/';
                        
                        if (is_dir($template_dir)) {
                            $template_files = glob($template_dir . 'tmp-*.php');
                            
                            // Get configured templates from registry
                            $config = function_exists('kuperbush_template_registry') ? kuperbush_template_registry() : array();
                            
                            foreach ($template_files as $template_file) {
                                $template_name = basename($template_file);
                                $slug = preg_replace('/^tmp-(.+)\.php$/', '$1', $template_name);
                                
                                $css_file = $css_dir . $slug . '.css';
                                $js_file = $js_dir . $slug . '.js';
                                
                                $css_exists = file_exists($css_file) ? 'Yes' : 'No';
                                $js_exists = file_exists($js_file) ? 'Yes' : 'No';
                                
                                $in_config = isset($config[$template_name]) ? 'Yes' : 'No';
                                
                                echo '<tr>';
                                echo '<td>' . esc_html($template_name) . '</td>';
                                echo '<td>' . esc_html($css_exists) . '</td>';
                                echo '<td>' . esc_html($js_exists) . '</td>';
                                echo '<td>' . esc_html($in_config) . '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="4">No template files found</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
    }
}