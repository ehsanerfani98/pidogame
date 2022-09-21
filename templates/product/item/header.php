<?php
$meta = get_post_meta(get_the_ID(), 'pidogame_framework_products', true);
global $product;
?>


<div class="row">
    <?php do_action('myalarm'); ?>

    <div class="col-lg-12 px-5">
        <ul class="breadcrumb breadcrumb-line fw-bold fs-7 mb-8">
            <?php if (function_exists('bcn_display')) bcn_display() ?>
        </ul>
    </div>
</div>

<div class="card overlay overflow-hidden w-100">
    <div class="card-body p-0">
        <div class="ar-16-8 ar-md-16-6 ar-lg-16-6 ar-xl-16-4 bgi-size-cover bgi-position-center" style="background-image: url(<?php echo $meta['opt-product-wallpaper-image']['url'] ?>)"></div>
        <div class="overlay-layer opacity-50 bg-black"></div>
        <div class="overlay-layer opacity-100 d-flex d-lg-none">
            <div class="d-flex flex-grow-1 flex-center py-5 px-5">
                <div>
                    <h1 class="text-white"><?php the_title() ?></h1>
                    <h3 class="fs-5 text-muted mt-2 ss02"><?php echo $meta['opt-product-subtitle'] ?></h3>
                    <div class="symbol symbol-25px me-2 d-block mt-4">
                        <span class="symbol-label bg-info d-inline-flex">
                            <i class="bi bi-mouse3-fill fs-8 text-white"></i>
                        </span>
                        <?php if ($product->get_attribute('device')) : ?>
                            <span class="text-white ms-2"><?php echo str_replace(',', '،', $product->get_attribute('device')) ?></span>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="d-block d-lg-none mt-5">
            <?php get_template_part('templates/product/item/header-card') ?>
        </div>
    </div>

</div>
<div class="d-none d-lg-flex row px-12 position-relative" style="margin-top: -160px">
    <div class="col-lg-5 col-xl-4">
        <?php get_template_part('templates/product/item/header-card') ?>
    </div>
    <div class="col-lg-7 col-xl-8 mt-16">
        <div class="">
            <div class="card-body">
                <h1 class="text-white"><?php the_title() ?></h1>
                <h3 class="fs-5 text-muted mt-2 ss02"><?php echo $meta['opt-product-subtitle'] ?></h3>
                <div class="symbol symbol-25px me-2 d-block mt-4 ">
                    <span class="symbol-label bg-info d-inline-flex">
                        <i class="bi bi-mouse3-fill fs-8 text-white"></i>
                    </span>
                    <?php if ($product->get_attribute('device')) : ?>
                        <span class="text-white ms-2"><?php echo str_replace(',', '،', $product->get_attribute('device')) ?></span>
                    <?php endif ?>
                </div>
                <p class="lh-xl pt-10 text-gray-700 ss02"><?php echo get_the_excerpt() ?></p>
                <?php get_template_part('templates/product/item/price') ?>
            </div>
        </div>
    </div>
</div>

<div class="d-lg-none d-xl-none d-flex row my-5 position-relative">
    <div class="col-lg-12">
        <?php get_template_part('templates/product/item/price') ?>
    </div>
</div>