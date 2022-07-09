<?php
$meta = get_post_meta(get_the_ID(), 'pidogame_framework_products', true);
global $product;

foreach (explode(',', $product->get_attribute('pa_device')) as $name) {
    $sorting_id_devices[] = get_term_by('name', $name, 'pa_device')->term_id;
}


?>


<div class=" d-lg-flex row px-4 position-relative">

    <!-- <div class="row">
        <div class="col-lg-12">
            <ul class="breadcrumb breadcrumb-line fw-bold fs-7 mb-8">
                <?php if (function_exists('bcn_display')) bcn_display() ?>
            </ul>
        </div>
        <div class="col-lg-12">
            <div class="mb-3" style="padding-right: 1rem;">
                <h1 class="text-gray" style="font-size: 1.65rem;"><?php the_title() ?></h1>
                <h3 class="fs-5 text-gray-700 mt-3 ss02"><?php echo $meta['opt-product-subtitle'] ?></h3>
            </div>
        </div>
    </div> -->

    <div class="col-lg-5 col-xl-4">
        <?php get_template_part('templates/product/game/header-card') ?>
    </div>

</div>

<script src="<?php echo get_template_directory_uri() ?>/assets/custom/js/plswb.js"></script>