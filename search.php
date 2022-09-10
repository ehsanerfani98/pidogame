<?php
$options = get_option('pidogame_framework');
get_header();
?>
<style>
    .pagination {
        margin-top: 1rem;
    }

    .pagination span {
        margin: 0 .2rem;
    }

    .pagination a {
        margin: 0 .2rem;
    }

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

    .wrap-content-product .price{
        margin: 0.5rem;
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
                            's' => $_GET['s']
                        );
                        $query = new WP_Query($args);


                        if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
                                <div class="col-md-3 mb-5">

                                    <div class="wrap-cart-plswb card">

                                        <span class="plswb-date text-gray bg-secondary bg-opacity-50">
                                            <?= get_the_date() ?>
                                        </span>
                                        <div class="image-cart-plswb">
                                            <?php the_post_thumbnail() ?>
                                        </div>

                                        <div class="wrap-content-product mt-2 px-2 pb-2">
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

                        else :
                        ?>
                            <div class="col-lg-12">
                                <div class="alert alert-dismissible bg-light-info border-dashed border-1 border-info d-flex flex-column flex-sm-row w-100 p-5 align-items-center">
                                    <!--begin::Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen007.svg-->
                                    <span class="svg-icon svg-icon-2hx svg-icon-info me-4 mb-5 mb-sm-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M12 22C13.6569 22 15 20.6569 15 19C15 17.3431 13.6569 16 12 16C10.3431 16 9 17.3431 9 19C9 20.6569 10.3431 22 12 22Z" fill="black"></path>
                                            <path d="M19 15V18C19 18.6 18.6 19 18 19H6C5.4 19 5 18.6 5 18V15C6.1 15 7 14.1 7 13V10C7 7.6 8.7 5.6 11 5.1V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V5.1C15.3 5.6 17 7.6 17 10V13C17 14.1 17.9 15 19 15ZM11 10C11 9.4 11.4 9 12 9C12.6 9 13 8.6 13 8C13 7.4 12.6 7 12 7C10.3 7 9 8.3 9 10C9 10.6 9.4 11 10 11C10.6 11 11 10.6 11 10Z" fill="black"></path>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <!--end::Icon-->
                                    <!--begin::Content-->
                                    <div class="d-flex flex-column pe-0 pe-sm-10">
                                        <span>
                                            هیچ نتیجه ای برای عبارت شما یافت نشد. </span>
                                    </div>
                                    <!--end::Content-->

                                </div>

                            </div>
                        <?php
                        endif; ?>
                    </div>
                </div>
            </div>
            <?php get_template_part('templates/page/footer/footer') ?>
        </div>
    </div>
</div>
<script>
    jQuery('a.next').addClass('p-3').html('<span class="svg-icon svg-icon-muted p-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"> <path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="black"/> <path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="black"/> </svg></span>');
    jQuery('a.prev').addClass('p-3').html('<span class="svg-icon svg-icon-muted p-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"> <path d="M10 4L18 12L10 20H14L21.3 12.7C21.7 12.3 21.7 11.7 21.3 11.3L14 4H10Z" fill="black"/> <path opacity="0.3" d="M3 4L11 12L3 20H7L14.3 12.7C14.7 12.3 14.7 11.7 14.3 11.3L7 4H3Z" fill="black"/> </svg></span>');
    jQuery('a.page-numbers').addClass('btn bg-secondary').removeClass('next').removeClass('prev');
    jQuery('span.page-numbers.current').addClass('btn btn-primary').removeClass('page-numbers').removeClass('current');
</script>
<?php get_template_part('templates/page/drawers/drawers') ?>
<?php get_template_part('templates/page/scrolltop/scrolltop') ?>
<?php if ($options['opt-header-notifications-switcher']) get_template_part('templates/page/modals/notification/notification') ?>
<?php
get_footer();
