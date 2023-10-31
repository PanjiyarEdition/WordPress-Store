<?php

/**
 * Rishi Widget Areas
 * 
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 * @package Rishi
 */

if (!function_exists('rishi_widgets_init')) :
    /**
     * Register Widget Areas
     */
    function rishi_widgets_init()
    {
        $defaults    = rishi__cb__get_layout_defaults();
        $title_class = get_theme_mod('ed_footer_widget_title', $defaults['ed_footer_widget_title']) ? 'hide_widget_title' : '';

        $sidebars = array(
            'sidebar-1'   => array(
                'name'        => __('Sidebar', 'rishi'),
                'description' => __('Default Sidebar', 'rishi'),
            ),
            'footer-one' => array(
                'name'        => __('Footer One', 'rishi'),
                'description' => __('Add footer one widgets here.', 'rishi'),
            ),
            'footer-two' => array(
                'name'        => __('Footer Two', 'rishi'),
                'description' => __('Add footer two widgets here.', 'rishi'),
            ),
            'footer-three' => array(
                'name'        => __('Footer Three', 'rishi'),
                'description' => __('Add footer three widgets here.', 'rishi'),
            ),
            'footer-four' => array(
                'name'        => __('Footer Four', 'rishi'),
                'description' => __('Add footer four widgets here.', 'rishi'),
            ),
            'footer-five' => array(
                'name'        => __('Footer Five', 'rishi'),
                'description' => __('Add footer five widgets here.', 'rishi'),
            ),
            'footer-six' => array(
                'name'        => __('Footer Six', 'rishi'),
                'description' => __('Add footer six widgets here.', 'rishi'),
            )
        );

        foreach ($sidebars as $id => $sidebar) {
            register_sidebar(array(
                'name'          => esc_html($sidebar['name']),
                'id'            => esc_attr($id),
                'description'   => esc_html($sidebar['description']),
                'before_widget' => '<section id="%1$s" class="widget ' . esc_attr($title_class) . ' %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => apply_filters('rishi_widget_before_title', '<h2 class="widget-title" itemprop="name">'),
                'after_title'   => apply_filters('rishi_widget_after_title', '</h2>'),
            ));
        }

        do_action('rishi:widgets_init');
    }
endif;
add_action('widgets_init', 'rishi_widgets_init');
