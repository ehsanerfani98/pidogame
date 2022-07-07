<?php
$meta = get_post_meta(get_the_ID(), 'pidogame_framework_products', true);
global $product;
?>
<div class="row">
    <div class="col-12 col-xl-9">
        <div class="mt-xl-4 mt-lg-3 mt-md-2 mt-1 lh-xl text-gray-700 fs-6 ss02 img-rounded">
            <?php the_content() ?>
        </div>
    </div>
    <div class="d-none d-xl-block col-12 col-xl-3">
        <div data-kt-sticky="true" data-kt-sticky-offset="1280px" data-kt-sticky-width="300px" data-kt-sticky-left="auto" data-kt-sticky-top="100px" data-kt-sticky-animation="true" data-kt-sticky-zindex="95">
            <?php get_template_part('templates/product/item/header-card') ?>
        </div>
    </div>
</div>