<?php
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
                    <?php if (is_singular('product')) : ?>
                        <?php if (have_posts()) :
                        ?>
                            <div class="woocommerce">
                                <?php
                                var_dump('sdss');
                                woocommerce_content(); ?>
                            </div>
                        <?php
                        endif ?>
                    <?php else : ?>
                        <?php 
                                                            var_dump('54646');

                            woocommerce_get_template('archive-product.php'); ?>
                    <?php endif; ?>
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
