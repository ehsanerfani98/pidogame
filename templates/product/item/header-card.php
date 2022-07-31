<?php
$meta = get_post_meta(get_the_ID(), 'pidogame_framework_products', true);
global $product;
$rating = $product->get_average_rating() * 2;
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
        <div class="px-10">

            <?php if (is_user_logged_in()) : ?>
                <div class="row my-3">
                    <div class="col-12">
                        <?php echo do_shortcode("[yith_wcwl_add_to_wishlist]"); ?>
                    </div>
                </div>
                <div class="separator separator-dashed my-5"></div>
            <?php endif; ?>
            
            <div class="row my-3">
                <div class="col-6">
                    <?php if ($product->get_attribute('requirement-game')) : ?>
                        <span class="text-muted">بازی مورد نیاز:</span>
                        <div class="d-block mt-2">
                            <span class="badge badge-light-warning">
                                <?php echo str_replace(',', '، ', $product->get_attribute('requirement-game')) ?>
                            </span>
                        </div>
                    <?php endif ?>
                </div>
                <div class="col-6">
                    <?php if ($product->get_attribute('producer')) : ?>
                        <span class="text-muted">سازنده:</span>
                        <div class="d-block mt-2">
                            <span class="badge badge-light-success">
                                <?php echo str_replace(',', '، ', $product->get_attribute('producer')) ?>
                            </span>
                        </div>
                    <?php endif ?>
                </div>
            </div>
            <?php if ($product->get_attribute('requirement-game') || $product->get_attribute('producer')) : ?>
                <div class="separator separator-dashed my-5"></div>
            <?php endif ?>
            <div class="mt-2 mb-4">
                <span>امتیاز کاربران:</span>
                <span class="badge badge-light-<?php echo $badgeColor ?> ss02"><?php echo $rating ?></span>
            </div>
            <?php if ($product->get_sku()) : ?>
                <div class="mt-2">
                    <span>شناسه محصول:</span>
                    <span class="text-muted lh-lg"><?php echo $product->get_sku() ?></span>
                </div>
            <?php endif ?>
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
    <?php if ($product->is_in_stock()) : ?>
        <div class="card-footer py-3 text-center btn-danger bg-opacity-75">
            <a role="button" data-bs-toggle="modal" data-bs-target="#kt_modal_product_buy" class="d-block fw-bolder fs-4 py-2 text-white">مشاهده نکات قبل از خرید</a>
        </div>
    <?php else : ?>
        <div class="card-footer py-3 text-center bg-danger bg-opacity-75">
            <a class="d-block fw-bolder fs-4 py-2 text-white">محصول ناموجود است</a>
        </div>
    <?php endif ?>
</div>