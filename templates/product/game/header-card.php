<?php

$meta = get_post_meta(get_the_ID(), 'pidogame_framework_products', true);
global $product;
$rating = $product->get_average_rating() * 2;
switch (true) {
    case $rating == 0:
        $footer = '<div class="card-footer py-6 text-center"><span class="fw-bolder fs-6 pt-1 ss02 text-dark opacity-75">بدون امتیاز</span></div>';
        break;

    case $rating < 4:
        $footer = '<div class="card-footer py-3 text-center bg-danger bg-opacity-75"><span class="fw-bolder fs-2x pt-1 ss02 text-white">' . $rating . '<span class="fs-6 me-2">/10</span></span></div>';
        break;

    case $rating < 7:
        $footer = '<div class="card-footer py-3 text-center bg-warning bg-opacity-75"><span class="fw-bolder fs-2x pt-1 ss02 text-white">' . $rating . '<span class="fs-6 me-2">/10</span></span></div>';
        break;

    case $rating <= 10:
        $footer = '<div class="card-footer py-3 text-center bg-success bg-opacity-75"><span class="fw-bolder fs-2x pt-1 ss02 text-white">' . $rating . '<span class="fs-6 me-2">/10</span></span></div>';
        break;
}
switch (true) {
    case $rating == 0:
        $rating = 'بدون امتیاز';
        $badgeColor = 'dark';
        break;

    case $rating < 4:
        $rating .= ' از 10 امتیاز';
        $badgeColor = 'danger';
        break;

    case $rating < 7:
        $rating .= ' از 10 امتیاز';
        $badgeColor = 'warning';
        break;

    case $rating <= 10:
        $rating .= ' از 10 امتیاز';
        $badgeColor = 'success';
        break;
}
?>

<div class="card">
    <div class="card-body p-3">
        <img class="w-100 rounded mb-2" src="<?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true) ?>">
        <div class="px-5">
            <div class="row my-3">
                <div class="col-12">
                    <?php echo do_shortcode("[yith_wcwl_add_to_wishlist]"); ?>
                </div>
            </div>
            <div class="separator separator-dashed my-5"></div>
            <div class="row pt-5">
                <div class="col-12">
                    <p class="lh-xl text-gray-700 ss02 m-0" style="text-align: justify;"><?php echo get_the_excerpt() ?></p>
                </div>
            </div>
            <div class="separator separator-dashed my-5"></div>
            <div class="mt-2 mb-4 d-flex justify-content-between" style="flex-wrap: wrap;">
                <span>ژانر : </span>
                <span class="text-gray-700 lh-lg badge badge-light-dark" style="flex-wrap: wrap; flex-direction: row-reverse;">
                    <?php if ($product->get_attribute('genre')) : ?>
                        <?php
                        $i = 0;
                        foreach (explode(',', $product->get_attribute('genre')) as $genre) :
                            $taxonomy = 'pa_genre';
                            $genre = get_term_by('name', trim($genre), $taxonomy);
                        ?>
                            <a class="mx-1" href="<?= home_url('genre/') . $genre->slug ?>"><?= $genre->name ?></a>
                            <?= $i + 1 < count(explode(',', $product->get_attribute('genre'))) ? ',' : '' ?>
                    <?php
                            $i++;
                        endforeach;
                    endif; ?>
                </span>
            </div>
            <div class="mt-2 d-flex justify-content-between">
                <span>سال انتشار : </span>
                <span class="text-gray-700 lh-lg badge badge-light-dark">
                    <?php if ($product->get_attribute('yearpublish')) : ?>
                        <?php echo str_replace(',', '،', $product->get_attribute('yearpublish')) ?>
                    <?php endif ?>
                </span>
            </div>
            <div class="mt-2 d-flex justify-content-between">
                <span>شرکت سازنده : </span>
                <span class="text-gray-700 lh-lg badge badge-light-dark"><?php echo str_replace(',', '، ', $product->get_attribute('producer')) ?></span>
            </div>
            <div class="mt-2 d-flex justify-content-between">
                <span>پلتفرم : </span>
                <span class="text-gray-700 lh-lg badge badge-light-dark">
                    <?php if ($product->get_attribute('device')) : ?>
                        <?php echo str_replace(',', '،', $product->get_attribute('device')) ?>
                    <?php endif ?>
                </span>
            </div>

            <?php if ($product->get_sku()) : ?>
                <div class="mt-2 mb-5 d-flex justify-content-between">
                    <span>شناسه محصول : </span>
                    <span class="text-gray-700 lh-lg badge badge-light-dark"><?php echo $product->get_sku() ?></span>
                </div>
            <?php endif ?>


        </div>
    </div>
    <?php echo $footer ?>

</div>

<div class="card my-4">
    <div class="card-body">
        <?php
        $attributes = $product->get_attributes();
        foreach ($attributes as $attribute) :
            if ($attribute['visible']) : ?>
                <div class="mt-2">
                    <span><?php echo $attribute['name'] ?>:</span>
                    <span class="text-muted ss02 lh-lg">
                        <?php for ($i = 0; $i < count($attribute['options']); $i++) {
                            if ($i != count($attribute['options']) - 1) echo $attribute['options'][$i] . '، ';
                            else echo $attribute['options'][$i];
                        } ?>
                    </span>
                </div>
        <?php endif;
        endforeach ?>
    </div>
</div>