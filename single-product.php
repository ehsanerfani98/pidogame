<?php
$options = get_option('pidogame_framework');
$meta = get_post_meta(get_the_ID(), 'pidogame_framework_products', true);
get_header();
?>
<div class="d-flex flex-column flex-root">
    <div class="page d-flex flex-row flex-column-fluid">
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            <?php get_template_part('templates/page/header/header') ?>
            <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
                <?php get_template_part('templates/page/aside/aside') ?>
                <div class="content flex-row-fluid" id="kt_content">
                    <?php
                    $type = $meta['opt-product-type'];
                    switch ($type) {
                        case 'game':
                            get_template_part('templates/product/game/game');
                            break;
                        case 'gift':
                            get_template_part('templates/product/gift/gift');
                            break;
                        case 'item':
                            get_template_part('templates/product/item/item');
                            break;
                    }
                    ?>
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
