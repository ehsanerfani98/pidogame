<?php

class PlswbShorcodes{

    function __construct()
    {
        add_shortcode('gallery-thumbnail', [$this, 'view_gallery_thumbnail']);
        add_shortcode('plswb-products', [$this, 'view_Products']);
        // add_shortcode('description-head', [$this, 'view_description_head']);
        // add_shortcode('categories', [$this, 'view_categories']);
        // add_shortcode('ads', [$this, 'view_ads']);
        // add_shortcode('login', [$this, 'view_login']);
    }

    function view_gallery_thumbnail($param){
        $term_id = $param['term_id'];
        include PLSWB_THEME_PATH.'/inc/widgets-elementor/view-widgets/GalleryThumbnail_view.php';
    }

    function view_Products($param){
        $wid = rand(0000000000, 9999999999);
        $term_id = $param['term_id'];
        $count = $param['count'];
        $cart_color = $param['cart_color'];
        $cart_button_color = $param['cart_button_color'];
        $card_style = $param['card_style'];
        $orderby = $param['orderby'];
        $product_ids = $param['product_ids'];
        $status_product_ids = $param['status_product_ids'];
        $display_column = $param['display_column'];
        $count_column = $param['count_column'];
        $display_auto = $param['display_auto'];
        $status_slider = $param['status_slider'];
        include PLSWB_THEME_PATH.'/inc/widgets-elementor/view-widgets/Products_view.php';
    }

}
   

new PlswbShorcodes();