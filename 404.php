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
                <div class="content flex-row-fluid d-flex justify-content-center" id="kt_content">
                    <div class="wrap-404">
                        <div class="row">
                            <div class="card mb-6">
                                <div class="card-body my-3">
                                <div class="d-flex align-items-center justify-content-center flex-column">
                                        <img width="150" src="<?= get_template_directory_uri() . '/assets/media/images/Normal.png' ?>" alt="">
                                            <h1 class="text-gray-600" style="font-size: 5rem;margin-bottom: 1rem;">همممم!</h1>
                                            <h3 class="text-gray-600" style="font-size: 2.4rem;">چیزی پیدا نکردم! یه نگاه به اینا بنداز شاید خوشت بیاد!</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                                    <?= do_shortcode('[recent_products per_page="8" columns="8" orderby="rand" order="rand"]'); ?>
                        </div>
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
