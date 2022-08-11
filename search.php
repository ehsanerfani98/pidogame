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
                    <div class="row">
                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                <div class="col-md-4">

                                    <div class="wrap-cart-plswb card">
                                        <a href="<?php the_permalink() ?>">


                                            <div class="image-cart-plswb">
                                                <?php the_post_thumbnail('cart-product-plswb') ?>
                                            </div>

                                            <div class="wrap-content-product mt-2 pb-2">
                                                <div class="title-cart-plswb">
                                                    <h4><?php the_title() ?></h4>
                                                </div>
                                            </div>
                                            <div class="separator separator-solid"></div>
                                            <div class="wrap-content-product">

                                            </div>
                                        </a>
                                        <div class="card-footer py-1 text-center bg-primary bg-opacity-75"><a href="http://test.pidogame.com/product/call-of-duty-mobile-cp/">
                                            </a><a href="<?php the_permalink() ?>" class="d-block fw-bolder fs-6 py-2 text-white">مشاهده مطلب</a>
                                        </div>

                                    </div>


                                </div>
                        <?php
                            endwhile;
                        endif ?>
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
