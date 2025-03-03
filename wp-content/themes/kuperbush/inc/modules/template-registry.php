<?php
/**
 * Template Registry
 * 
 * A centralized registry of template files to be created by the auto-pages module.
 * Add new templates to this registry instead of modifying auto-pages.php directly.
 */

if (!function_exists('kuperbush_template_registry')) {
    /**
     * Get the template registry
     * 
     * This function returns an array of all available template files mapped
     * to their page titles and slugs. To add a new template, just add it to this array.
     * 
     * @return array Template registry
     */
    function kuperbush_template_registry() {
        return array(
            'tmp-brand.php' => array(
                'title' => 'Brand',
                'slug'  => 'brand',
                'content' => '<!-- Brand page content created automatically -->'
            ),
            'tmp-design.php' => array(
                'title' => 'Design',
                'slug'  => 'design',
                'content' => '<!-- Design page content created automatically -->'
            ),
            'tmp-downloads.php' => array(
                'title' => 'Downloads',
                'slug'  => 'downloads',
                'content' => '<!-- Downloads page content created automatically -->'
            ),
            'tmp-history.php' => array(
                'title' => 'History',
                'slug'  => 'history',
                'content' => '<!-- History page content created automatically -->'
            ),
            'tmp-in-the-world.php' => array(
                'title' => 'In The World',
                'slug'  => 'in-the-world',
                'content' => '<!-- In The World page content created automatically -->'
            ),
            'tmp-service.php' => array(
                'title' => 'Service',
                'slug'  => 'service',
                'content' => '<!-- Service page content created automatically -->'
            ),
            // Add new templates here in the format:
            // 'tmp-template-slug.php' => array(
            //     'title' => 'Template Title',
            //     'slug'  => 'template-slug',
            //     'content' => '<!-- Template content -->'
            // ),
        );
    }
}

/**
 * Register a new template in the registry
 * 
 * @param string $template_file Template file name (tmp-*.php)
 * @param string $title Page title
 * @param string $slug Page slug
 * @param string $content Optional page content
 * @return bool Success status
 */
if (!function_exists('kuperbush_register_template')) {
    function kuperbush_register_template($template_file, $title, $slug, $content = '') {
        $registry_file = __FILE__;
        
        if (!file_exists($registry_file)) {
            return false;
        }
        
        // Read the registry file
        $file_content = file_get_contents($registry_file);
        
        // Check if template is already registered
        if (strpos($file_content, "'$template_file'") !== false) {
            return false;
        }
        
        // Prepare the new template entry
        if (empty($content)) {
            $content = "<!-- $title page content created automatically -->";
        }
        
        $new_entry = <<<EOT
            '$template_file' => array(
                'title' => '$title',
                'slug'  => '$slug',
                'content' => '$content'
            ),
            // Add new templates here in the format:
EOT;
        
        // Replace the placeholder comment
        $pattern = '/\/\/ Add new templates here in the format:/';
        $updated_content = preg_replace($pattern, $new_entry, $file_content, 1);
        
        if ($updated_content !== $file_content) {
            // Write the updated content back to the file
            file_put_contents($registry_file, $updated_content);
            return true;
        }
        
        return false;
    }
}