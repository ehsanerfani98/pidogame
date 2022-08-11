<?php
$options = get_option('pidogame_framework');
get_header();
?>
<style>
    .wrap-cart-plswb {
        position: relative;
        border-radius: 10px;
        height: auto;
        box-shadow: rgba(33, 35, 38, 0.1) 0px 10px 10px -10px;
    }

    .plswb-date {
        position: absolute;
        top: 1rem;
        right: 1rem;
        padding: .4rem 1rem;
        border-radius: 8px;
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
                        <div class="col-lg-12">
                            <ul class="breadcrumb breadcrumb-line fw-bold fs-7 mb-8">
                                <?php if (function_exists('bcn_display')) bcn_display() ?>
                            </ul>
                        </div>
                        <?php
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                        $args = array(
                            'post_type'        => 'post',
                            'posts_per_page'   => 12,
                            'paged' => $paged,
                            'status'         => 'publish',
                        );
                        $query = new WP_Query($args);


                        if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
                                <div class="col-md-3 mb-5">

                                    <div class="wrap-cart-plswb card">

                                        <span class="plswb-date text-gray bg-secondary bg-opacity-50">
                                            <?php the_date() ?>
                                        </span>
                                        <div class="image-cart-plswb">
                                            <?php the_post_thumbnail() ?>
                                        </div>

                                        <div class="wrap-content-product mt-2 pb-2">
                                            <div class="title-cart-plswb">
                                                <h4><?php the_title() ?></h4>
                                            </div>
                                        </div>
                                        <div class="separator separator-solid"></div>
                                        <div class="wrap-content-product text-gray-700">
                                            <?php the_content() ?>
                                        </div>
                                        <div class="card-footer py-1 text-center bg-primary bg-opacity-75"><a href="http://test.pidogame.com/product/call-of-duty-mobile-cp/">
                                            </a><a href="<?php the_permalink() ?>" class="d-block fw-bolder fs-6 py-2 text-white">مشاهده مطلب</a>
                                        </div>

                                    </div>


                                </div>
                            <?php
                            endwhile;
                            ?>
                            <div class="pagination">
                                <?php
                                echo paginate_links(array(
                                    'base'         => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                                    'total'        => $query->max_num_pages,
                                    'current'      => max(1, get_query_var('paged')),
                                    'format'       => '?paged=%#%',
                                    'show_all'     => false,
                                    'type'         => 'plain',
                                    'end_size'     => 2,
                                    'mid_size'     => 1,
                                    'prev_next'    => true,
                                    'prev_text'    => sprintf('<i></i> %1$s', __('Newer Posts', 'text-domain')),
                                    'next_text'    => sprintf('%1$s <i></i>', __('Older Posts', 'text-domain')),
                                    'add_args'     => false,
                                    'add_fragment' => '',
                                ));
                                ?>
                            </div>
                        <?php
                            wp_reset_postdata();
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
