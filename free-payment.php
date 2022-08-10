<?php
/* Template Name: پرداخت آزاد */


// $product_id = create_product( array(
//     'type'               => '', // Simple product by default
//     'name'               => __("The product title", "woocommerce"),
//     'description'        => __("The product description…", "woocommerce"),
//     'short_description'  => __("The product short description…", "woocommerce"),
//     // 'sku'                => '',
//     'regular_price'      => '5.00', // product price
//     // 'sale_price'         => '',
//     'reviews_allowed'    => true,
//     'attributes'         => array(
//         // Taxonomy and term name values
//         'pa_color' => array(
//             'term_names' => array('Red', 'Blue'),
//             'is_visible' => true,
//             'for_variation' => false,
//         ),
//         'pa_size' =>  array(
//             'term_names' => array('X Large'),
//             'is_visible' => true,
//             'for_variation' => false,
//         ),
//     ),
// ) );  



$options = get_option('pidogame_framework');
get_header();


?>
<div class="d-flex flex-column flex-root">
    <div class="page d-flex flex-row flex-column-fluid">
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            <?php get_template_part('templates/page/header/header') ?>
            <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
                <?php get_template_part('templates/page/aside/aside') ?>
                <div class="content flex-row-fluid" id="kt_content">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title"><h1><?php the_title() ?></h1></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php get_template_part('templates/page/footer/footer') ?>
        </div>
    </div>
</div>
<?php get_template_part('templates/page/drawers/drawers') ?>
<?php get_template_part('templates/page/scrolltop/scrolltop') ?>
<?php if ($options['opt-header-notifications-switcher']) get_template_part('templates/page/modals/notification/notification') ?>
<?php
get_footer();
