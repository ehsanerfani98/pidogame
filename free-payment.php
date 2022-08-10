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
                        <div class="card-header">
                            <div class="card-title">
                                <h1><?php the_title() ?></h1>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php the_content() ?>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-10">
                                        <label for="exampleFormControlInput1" class="required form-label">مبلغ (تومان)</label>
                                        <input style="text-align: right;" type="number" class="form-control form-control-solid" placeholder="مبلغ محصول را وارد کنید" />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-10">
                                        <label style="width: 100%;" for="exampleFormControlInput1" class="form-label">تعداد</label>
                                        <div class="position-relative w-100px d-inline-block" data-kt-dialer="true" data-kt-dialer-min="1" data-kt-dialer-max="" data-kt-dialer-step="1">
                                            <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease"><span class="svg-icon svg-icon-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                                                        <rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="currentColor"></rect>
                                                    </svg></span></button>
                                            <input id="" name="" type="text" class="form-control form-control-solid border-0 text-center ss02 w-100px" readonly data-kt-dialer-control="input">
                                            <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase"><span class="svg-icon svg-icon-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                                                        <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor"></rect>
                                                        <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor"></rect>
                                                    </svg></span></button>
                                        </div>
                                    </div>
                                </div>

                            </div>


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
