<?php

class PlswbShorcodes{

    function __construct()
    {
        add_shortcode('gallery-thumbnail', [$this, 'view_gallery_thumbnail']);
        // add_shortcode('important-categories', [$this, 'view_important_categories']);
        // add_shortcode('description-head', [$this, 'view_description_head']);
        // add_shortcode('categories', [$this, 'view_categories']);
        // add_shortcode('ads', [$this, 'view_ads']);
        // add_shortcode('login', [$this, 'view_login']);
    }

    function view_gallery_thumbnail($param){
        $term_id = $param['term_id'];
        include PLSWB_THEME_PATH.'/inc/widgets-elementor/view-widgets/GalleryThumbnail_view.php';
    }

    function view_important_categories($param){
        $order = $param['order'];
        include PLSWB_THEME_PATH.'/views/shortcodes/important_categories_view.php';
    }

    function view_description_head(){
        include PLSWB_THEME_PATH.'/views/shortcodes/description_head_view.php';
    }

    function view_categories($param){
        $order = $param['order'];
        include PLSWB_THEME_PATH.'/views/shortcodes/categories_view.php';
    }

    function view_ads($param){
        $order = $param['order'];
        $count = $param['count'];
        include PLSWB_THEME_PATH.'/views/shortcodes/ads_view.php';
    }

    function view_login(){
        include PLSWB_THEME_PATH.'/views/shortcodes/login_view.php';
    }
}

new PlswbShorcodes();