<?php
/**
 * Mock Product Data for Kuperbush Products
 * 
 * This file contains mock data for kitchen appliances that can be displayed
 * when no actual products are available in the database.
 */

/**
 * Function to get mock products for display
 * 
 * @return array Array of mock product data
 */
function kuperbush_get_mock_products() {
    // Get the theme directory URL for image paths
    $theme_url = get_stylesheet_directory_uri();
    
    // Create array of mock products
    $mock_products = array(
        array(
            'id' => 1,
            'model_number' => 'BP6550.0S',
            'title' => 'Pyrolytic Oven with Steam Function',
            'color' => 'Stainless Steel',
            'is_new' => true,
            'category' => 'Ovens and Compacts',
            'series' => 'K-Series 5',
            'image' => $theme_url . '/img/uploads/KUPPER-Cabecera-3.jpg',
            'design_line' => 'Stainless Steel',
            'energy_rating' => 'A+'
        ),
        array(
            'id' => 2,
            'model_number' => 'CKV6550.0S',
            'title' => 'Combination Steam Oven',
            'color' => 'Black',
            'is_new' => true,
            'category' => 'Ovens and Compacts',
            'series' => 'K-Series 8',
            'image' => $theme_url . '/img/uploads/KUPPER-Cabecera-5.jpg',
            'design_line' => 'GraphiteBlack',
            'energy_rating' => 'A++'
        ),
        array(
            'id' => 3,
            'model_number' => 'VKI3500.1SR',
            'title' => 'Induction Cooktop with Flex Zones',
            'color' => 'Black',
            'is_new' => false,
            'category' => 'Hobs',
            'series' => 'K-Series 3',
            'image' => $theme_url . '/img/uploads/KUPPER-Cabecera-8.jpg',
            'design_line' => 'Black Edition',
            'energy_rating' => 'A'
        ),
        array(
            'id' => 4,
            'model_number' => 'DW8500.0',
            'title' => 'Full-Size Dishwasher with Auto Program',
            'color' => 'White',
            'is_new' => false,
            'category' => 'Dishwashers',
            'series' => 'K-Series 5',
            'image' => $theme_url . '/img/uploads/KPH-marca-historia.jpg',
            'design_line' => 'Professional',
            'energy_rating' => 'A+++'
        ),
        array(
            'id' => 5,
            'model_number' => 'KW5000.0S',
            'title' => 'Built-in Wine Cooler with Dual Zone',
            'color' => 'Stainless Steel',
            'is_new' => true,
            'category' => 'Refrigeration',
            'series' => 'Individual',
            'image' => $theme_url . '/img/uploads/KPH-marca-diseño-.jpg',
            'design_line' => 'Stainless Steel',
            'energy_rating' => 'A+'
        ),
        array(
            'id' => 6,
            'model_number' => 'IKD9550.0',
            'title' => 'Decorative Island Hood with LED Lighting',
            'color' => 'Graphite',
            'is_new' => false,
            'category' => 'Hoods',
            'series' => 'K-Series 8',
            'image' => $theme_url . '/img/uploads/KUPPER-valores-marca-2.jpg',
            'design_line' => 'GraphiteBlack',
            'energy_rating' => 'A'
        ),
        array(
            'id' => 7,
            'model_number' => 'CM6550.0S',
            'title' => 'Built-in Coffee Machine',
            'color' => 'Stainless Steel',
            'is_new' => false,
            'category' => 'Ovens and Compacts',
            'series' => 'K-Series 5',
            'image' => $theme_url . '/img/uploads/KPH-in-the-world-it-1.jpeg',
            'design_line' => 'Stainless Steel',
            'energy_rating' => 'A'
        ),
        array(
            'id' => 8,
            'model_number' => 'KJ9800.0SR',
            'title' => 'Warming Drawer',
            'color' => 'Black',
            'is_new' => true,
            'category' => 'Ovens and Compacts',
            'series' => 'Individual',
            'image' => $theme_url . '/img/uploads/KPH-in-the-world-it-2.jpeg',
            'design_line' => 'Black Edition',
            'energy_rating' => 'A+'
        ),
        array(
            'id' => 9,
            'model_number' => 'GKS3800.0',
            'title' => 'Gas Cooktop with Wok Burner',
            'color' => 'Stainless Steel',
            'is_new' => false,
            'category' => 'Hobs',
            'series' => 'K-Series 3',
            'image' => $theme_url . '/img/uploads/KPH-in-the-world-ch-1-.jpeg',
            'design_line' => 'Professional',
            'energy_rating' => 'A'
        ),
        array(
            'id' => 10,
            'model_number' => 'RFR9300.0',
            'title' => 'French Door Refrigerator with Ice Maker',
            'color' => 'Silver',
            'is_new' => true,
            'category' => 'Refrigeration',
            'series' => 'K-Series 9',
            'image' => $theme_url . '/img/uploads/KPH-in-the-world-ch-2-.jpeg',
            'design_line' => 'Premium',
            'energy_rating' => 'A+++'
        )
    );
    
    return $mock_products;
}

/**
 * Function to get mock product categories
 * 
 * @return array Array of mock category data
 */
function kuperbush_get_mock_categories() {
    $mock_categories = array(
        array(
            'id' => 1,
            'name' => 'Ovens and Compacts',
            'slug' => 'ovens-and-compacts',
            'description' => 'High-performance ovens and compact appliances for your kitchen',
            'count' => 4,
        ),
        array(
            'id' => 2,
            'name' => 'Hobs',
            'slug' => 'hobs',
            'description' => 'Premium cooktops with advanced features',
            'count' => 2,
        ),
        array(
            'id' => 3,
            'name' => 'Hoods',
            'slug' => 'hoods',
            'description' => 'Stylish and effective extraction solutions',
            'count' => 1,
        ),
        array(
            'id' => 4,
            'name' => 'Refrigeration',
            'slug' => 'refrigeration',
            'description' => 'Advanced cooling and storage solutions',
            'count' => 2,
        ),
        array(
            'id' => 5,
            'name' => 'Dishwashers',
            'slug' => 'dishwashers',
            'description' => 'Efficient dishwashing solutions',
            'count' => 1,
        ),
    );
    
    return $mock_categories;
}

/**
 * Function to get mock product series
 * 
 * @return array Array of mock series data
 */
function kuperbush_get_mock_series() {
    $mock_series = array(
        array(
            'id' => 1,
            'name' => 'K-Series 3',
            'slug' => 'k-series-3',
            'description' => 'Entry-level series with essential features',
            'count' => 2,
        ),
        array(
            'id' => 2,
            'name' => 'K-Series 5',
            'slug' => 'k-series-5',
            'description' => 'Mid-level series with enhanced performance',
            'count' => 3,
        ),
        array(
            'id' => 3,
            'name' => 'K-Series 8',
            'slug' => 'k-series-8',
            'description' => 'Premium series with advanced features',
            'count' => 2,
        ),
        array(
            'id' => 4,
            'name' => 'K-Series 9',
            'slug' => 'k-series-9',
            'description' => 'Top-of-the-line series with professional features',
            'count' => 1,
        ),
        array(
            'id' => 5,
            'name' => 'Individual',
            'slug' => 'individual',
            'description' => 'Customizable premium appliances',
            'count' => 2,
        ),
    );
    
    return $mock_series;
}

/**
 * Function to get mock product benefits
 * 
 * @return array Array of mock benefits data
 */
function kuperbush_get_mock_benefits() {
    $theme_url = get_stylesheet_directory_uri();
    
    $mock_benefits = array(
        'ovens-and-compacts' => array(
            array(
                'title' => 'Precision Cooking',
                'description' => 'Küppersbusch ovens feature advanced temperature control systems for perfect cooking results every time. With multiple heating modes and intelligent cooking programs, you can achieve professional results at home.',
                'image' => $theme_url . '/img/uploads/KUPPER-Cabecera-3.jpg',
            ),
            array(
                'title' => 'Design Excellence',
                'description' => 'Our ovens and compact appliances are designed to complement any kitchen style. Available in various finishes including stainless steel, black, and graphite, they create a cohesive look for your premium kitchen.',
                'image' => $theme_url . '/img/uploads/KUPPER-Cabecera-5.jpg',
            ),
        ),
        'hobs' => array(
            array(
                'title' => 'Flexible Cooking Zones',
                'description' => 'Küppersbusch hobs feature innovative flexible cooking zones that adapt to your cookware size and shape. This allows for maximum versatility when preparing multiple dishes simultaneously.',
                'image' => $theme_url . '/img/uploads/KUPPER-Cabecera-8.jpg',
            ),
            array(
                'title' => 'Intuitive Controls',
                'description' => 'Our hobs feature user-friendly touch controls that make cooking simple and precise. With slider controls and programmable settings, you have complete control over your cooking experience.',
                'image' => $theme_url . '/img/uploads/KUPPER-valores-marca-2.jpg',
            ),
        ),
        'hoods' => array(
            array(
                'title' => 'Powerful Extraction',
                'description' => 'Küppersbusch hoods provide powerful and efficient extraction to keep your kitchen fresh and odor-free. Advanced filtration systems capture grease and odors effectively while operating quietly.',
                'image' => $theme_url . '/img/uploads/KPH-marca-historia.jpg',
            ),
            array(
                'title' => 'Integrated Lighting',
                'description' => 'Our hoods feature LED lighting systems that provide optimal illumination of your cooking surface. Adjustable brightness levels allow you to create the perfect ambiance while cooking.',
                'image' => $theme_url . '/img/uploads/KPH-marca-diseño-.jpg',
            ),
        ),
    );
    
    return $mock_benefits;
}