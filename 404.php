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
                   <div class="card">
                        <div class="card-body">
                           <div class="d-flex align-items-center justify-content-center">
                           <img width="150" src="<?= get_template_directory_uri() . '/assets/media/images/Normal.png' ?>" alt="">
                            <div class="d-flex align-items-center justify-content-center flex-column">
                                <h1 style="font-size: 26px;">همممم!</h1>
                                <h3>چیزی پیدا نکردم! یه نگاه به بازی های زیر بنداز شاید خوشت بیاد!</h3>
                            </div>
                           </div>
                        </div>
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
