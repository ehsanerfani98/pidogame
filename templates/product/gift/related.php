<?php
global $product;
$related = wc_get_related_products($product->get_id(), 4);
?>


<div class="row">
    <div class="col-12 col-lg-12">

        <div class="mt-10">

            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-stack mb-5">
                        <h3 class="text-dark">محصولات مرتبط</h3>
                    </div>
                    <div class="separator separator-dashed mb-9"></div>
                    <div class="row g-10">
                        <?php foreach ($related as $productId) :
                            $relatedProduct = wc_get_product($productId) ?>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="card-xl-stretch">
                                    <a href="<?php echo get_permalink($productId) ?>">
                                        <div class="position-relative w-100 pt-56p3 animated-background rounded">
                                            <img class="position-absolute top-0 end-0 w-100 rounded" src="<?php echo get_the_post_thumbnail_url($productId) ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id($productId), '_wp_attachment_image_alt', true) ?>">
                                        </div>
                                    </a>
                                    <div class="mt-5">
                                        <a href="<?php echo get_permalink($productId) ?>" class="fs-4 text-dark fw-bolder text-hover-primary text-dark lh-base"><?php echo strip_tags(wp_trim_words(get_the_title($productId), 5, '...')) ?></a>
                                        <div class="fs-6 fw-bolder mt-5 d-flex flex-stack">
                                            <span class="badge border border-dashed fs-3 fw-bolder text-dark p-2 ss02">
                                                <?php echo number_format($relatedProduct->get_price()) ?>
                                                <span class="ms-2 fs-8 fw-bold text-gray-400">
                                                    <?php echo get_woocommerce_currency_symbol() ?>
                                                </span>
                                            </span>
                                            <a href="<?php echo get_permalink($productId) ?>" class="btn btn-sm btn-primary">خرید محصول</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>