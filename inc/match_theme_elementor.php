<?php

// Register Elementor locations
function theme_prefix_register_elementor_locations($elementor_theme_manager)
{
    $elementor_theme_manager->register_location(
        'header',
        [
            'hook' => 'theme_prefix_header',
            'remove_hooks' => ['theme_prefix_print_elementor_header'],
        ]
    );
    $elementor_theme_manager->register_location(
        'footer',
        [
            'hook' => 'theme_prefix_footer',
            'remove_hooks' => ['theme_prefix_print_elementor_footer'],
        ]
    );
    $elementor_theme_manager->register_location(
        'single',
        [
            'hook' => 'theme_prefix_single',
            'remove_hooks' => ['theme_prefix_print_elementor_single'],
        ]
    );
    $elementor_theme_manager->register_location(
        'archive',
        [
            'hook' => 'theme_prefix_archive',
            'remove_hooks' => ['theme_prefix_print_elementor_archive'],
        ]
    );
}
add_action('elementor/theme/register_locations', 'theme_prefix_register_elementor_locations');

// The header
function theme_prefix_print_elementor_header()
{
    get_template_part('templates-parts/header');
}
add_action('theme_prefix_header', 'theme_prefix_print_elementor_header');

// The footer
function theme_prefix_print_elementor_footer()
{
    get_template_part('templates-parts/footer');
}
add_action('theme_prefix_footer', 'theme_prefix_print_elementor_footer');

// The single
function theme_prefix_print_elementor_single()
{
    get_template_part('templates-parts/single');
}
add_action('theme_prefix_single', 'theme_prefix_print_elementor_single');

// The archive
function theme_prefix_print_elementor_archive()
{
    get_template_part('templates-parts/archive');
}
add_action('theme_prefix_archive', 'theme_prefix_print_elementor_archive');

/***********************/
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');
function my_theme_enqueue_styles()
{
    // wp_enqueue_style('plswb-bootstrap',  PLSWB_THEME_ASSETS . 'front/css/bootstrap.min.css');
    wp_enqueue_style('plswb-style', get_template_directory_uri() . '/style.css');
}
/***********************/