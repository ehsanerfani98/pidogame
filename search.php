<?php
$options = get_option('pidogame_framework');
get_header();
?>
<style>
    .wrap-cart-plswb {
        border-radius: 10px;
        height: auto;
        box-shadow: rgba(33, 35, 38, 0.1) 0px 10px 10px -10px;
    }

    .image-cart-plswb {
        text-align: center;
        height: 165px !important;
    }

    .image-cart-plswb img {
        width: 100% !important;
        height: 100% !important;
        object-fit: fill;
    }

    .image-cart-plswb img {
        border-top-left-radius: 6px;
        border-top-right-radius: 6px;
    }

    .wrap-content-product {
        padding: 0.6rem 1rem 1rem 1rem;
    }

    .title-cart-plswb h4 {
        font-size: 12px;
        color: #999;
    }

    .icon-device {
        background: rgb(0 158 247 / 16%);
        width: 1.4rem;
        height: 1.2rem;
        border-radius: 20%;
        position: relative;
    }

    .icon-device svg {
        width: 10px;
        height: 10px;
        position: absolute;
        right: 4px;
        top: 2.2px;
    }

    .deavice_name {
        display: flex;
        flex-direction: row-reverse;
        align-items: center;
        gap: .3rem;
        flex-wrap: wrap;
    }

    .deavice_name h5 {
        font-weight: bold;
        margin: 0;
        font-size: 12px;
    }

    .device-cart-plswb {
        margin-top: 1rem;
        margin-bottom: .5rem;
        align-items: center;
    }

    .platform,
    .creator {
        display: flex;
        flex-direction: column;
    }

    .platform .title,
    .creator .title {
        font-size: 12px;
        color: #999;
        margin-bottom: .5rem;
    }

    .platform .content,
    .creator .content {
        font-size: 10px;
        font-weight: bold;
    }

    .platform .content {
        background: #fff6de;
        border-radius: 4px;
        color: #ffb100;
        padding: .2rem .4rem;
    }

    .creator .content {
        background: #deffee;
        border-radius: 4px;
        color: #35bb76;
        padding: .2rem .4rem;
    }

    .platform-cart-plswb {
        display: flex;
        align-items: center;
        gap: 4rem;
    }
</style>

<div class="d-flex flex-column flex-root">
    <div class="page d-flex flex-row flex-column-fluid">
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            <?php get_template_part('templates/page/header/header') ?>
            <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
                <?php get_template_part('templates/page/aside/aside') ?>
                <div class="content flex-row-fluid" id="kt_content">
                    <div class="row">
                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                <div class="col-md-3 mb-4">

                                    <div class="wrap-cart-plswb card">


                                            <div class="image-cart-plswb">
                                                <?php the_post_thumbnail() ?>
                                            </div>

                                            <div class="wrap-content-product mt-2 pb-2">
                                                <div class="title-cart-plswb">
                                                    <h4><?php the_title() ?></h4>
                                                </div>
                                            </div>
                                            <div class="separator separator-solid"></div>
                                            <div class="wrap-content-product">
                                                <?php the_excerpt() ?>
                                            </div>
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
