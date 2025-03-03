<?php
/**
 * Register widget area.
 */
if (!function_exists('kuperbush_widgets_init')) {
    function kuperbush_widgets_init() {
        register_sidebar(array(
            'name'          => esc_html__('Footer Widget 1', 'kuperbush'),
            'id'            => 'footer-1',
            'description'   => esc_html__('Add widgets here.', 'kuperbush'),
            'before_widget' => '<div id="%1$s" class="fwidget et_pb_widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="title">',
            'after_title'   => '</h4>',
        ));
        
        register_sidebar(array(
            'name'          => esc_html__('Footer Widget 2', 'kuperbush'),
            'id'            => 'footer-2',
            'description'   => esc_html__('Add widgets here.', 'kuperbush'),
            'before_widget' => '<div id="%1$s" class="fwidget et_pb_widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="title">',
            'after_title'   => '</h4>',
        ));
        
        register_sidebar(array(
            'name'          => esc_html__('Footer Widget 3', 'kuperbush'),
            'id'            => 'footer-3',
            'description'   => esc_html__('Add widgets here.', 'kuperbush'),
            'before_widget' => '<div id="%1$s" class="fwidget et_pb_widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="title">',
            'after_title'   => '</h4>',
        ));
    }
}
add_action('widgets_init', 'kuperbush_widgets_init');