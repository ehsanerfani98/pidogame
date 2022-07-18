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
        padding: .5rem;
    }

    .image-cart-plswb img {
        border-radius: 6px;
    }

    .wrap-content-product {
        padding: 0.2rem 2.5rem 1.4rem 2.5rem;
    }

    .title-cart-plswb h4 {
        font-size: 12px;
        color: #999;
    }

    .icon-device {
        background: rgb(243 53 145 / 10%);
        padding: .2rem .4rem .3rem .3rem;
        width: 2rem;
        height: 2rem;
        border-radius: 20%;
    }

    .icon-device svg {
        width: 15px;
        height: 15px;
    }

    .deavice_name h4 {
        font-weight: bold;
        margin: 0;
    }

    .device-cart-plswb {
        margin-top: 1rem;
        margin-bottom: 1.2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
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
                        <?php
                        $args = array(
                            'post_type' => ['product'],
                            'post_status' => ['publish'],
                            'posts_per_page' => 12
                        );
                        $query = new WP_Query($args);
                        if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post();
                        ?>
                                <div class="col-lg-3 mb-5">
                                    <a href="<?php the_permalink() ?>">

                                        <div class="wrap-cart-plswb card">

                                            <div class="image-cart-plswb">
                                                <?php the_post_thumbnail('cart-product-plswb') ?>
                                            </div>

                                            <div class="wrap-content-product">
                                                <div class="title-cart-plswb">
                                                    <h4><?php the_title() ?></h4>
                                                </div>

                                                <div class="device-cart-plswb">
                                                    <span class="icon-device">
                                                        <svg style="color: rgb(243, 53, 145);" xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                                            <title>ionicons-v5_logos</title>
                                                            <path d="M480,265H232V444l248,36V265Z" fill="#f33591"></path>
                                                            <path d="M216,265H32V415l184,26.7V265Z" fill="#f33591"></path>
                                                            <path d="M480,32,232,67.4V249H480V32Z" fill="#f33591"></path>
                                                            <path d="M216,69.7,32,96V249H216V69.7Z" fill="#f33591"></path>
                                                        </svg>
                                                    </span>
                                                    <div class="deavice_name">
                                                        <h4>Fall Guys</h4>
                                                    </div>
                                                </div>

                                                <div class="platform-cart-plswb">
                                                    <div class="platform">
                                                        <span class="title">پلتفرم :</span>
                                                        <span class="content">استیم</span>
                                                    </div>
                                                    <div class="creator">
                                                        <span class="title">سازنده :</span>
                                                        <span class="content">Sanata Monica Studio</span>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>
                                    </a>
                                </div>


                        <?php
                            endwhile;
                        endif;
                        wp_reset_postdata();

                        ?>
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
