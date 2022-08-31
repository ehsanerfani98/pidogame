<?php

function register_widget_elementor($widgets_manager)
{
    require_once PLSWB_THEME_PATH . '/inc/widgets-elementor/functions-widgets/GalleryThumbnail.php';

    $widgets_manager->register(new \GalleryThumbnail());
   
}
add_action('elementor/widgets/register', 'register_widget_elementor');

function add_elementor_widget_categories($elements_manager)
{

    $elements_manager->add_category(
        'plussweb-category',
        [
            'title' => esc_html__('ویجت های پیدوگیم', 'pidogame'),
            'icon' => 'fa fa-plug',
        ]
    );
}
add_action('elementor/elements/categories_registered', 'add_elementor_widget_categories');
