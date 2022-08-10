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
                            <div class="mb-10">
                                <label for="exampleFormControlInput1" class="required form-label">مبلغ (تومان)</label>
                                <input type="number" class="form-control form-control-solid" placeholder="مبلغ محصول را وارد کنید" />
                            </div>
                            <div class="mb-10">
                                <label for="exampleFormControlInput1" class="required form-label">مبلغ (تومان)</label>
                                <!--begin::Dialer-->
                                <div class="position-relative w-md-300px" data-kt-dialer="true" data-kt-dialer-min="1000" data-kt-dialer-max="50000" data-kt-dialer-step="1000" data-kt-dialer-prefix="$" data-kt-dialer-decimals="2">

                                    <!--begin::Decrease control-->
                                    <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease">
                                        <span class="svg-icon svg-icon-1"><svg></svg></span>
                                    </button>
                                    <!--end::Decrease control-->

                                    <!--begin::Input control-->
                                    <input type="text" class="form-control form-control-solid border-0 ps-12" data-kt-dialer-control="input" placeholder="Amount" name="manageBudget" readonly value="$36,000.00" />
                                    <!--end::Input control-->

                                    <!--begin::Increase control-->
                                    <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase">
                                        <span class="svg-icon svg-icon-1"><svg></svg></span>
                                    </button>
                                    <!--end::Increase control-->
                                </div>
                                <!--end::Dialer-->
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
