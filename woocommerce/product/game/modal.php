<?php
$meta = get_post_meta(get_the_ID(), 'pidogame_framework_products', true);
global $product;
?>

<div class="modal fade" id="kt_modal_product_buy" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-650px">
        <div class="modal-content rounded">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-info" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <div class="mb-13 text-center">
                    <h1 class="mb-3"><?php echo $meta['opt-product-modal-form-title'] ?></h1>
                    <div class="text-muted fw-bold fs-5"><?php echo $meta['opt-product-modal-form-subtitle'] ?></div>
                </div>
                <?php
                remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
                remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
                remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
                remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
                remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
                remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
                do_action('woocommerce_single_product_summary');
                ?>

            </div>
        </div>
    </div>
</div>