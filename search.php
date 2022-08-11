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
                            <div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title"><?php the_title() ?></h3>
        <div class="card-toolbar">
            <button type="button" class="btn btn-sm btn-light">
            <?php the_date(  ) ?>
            </button>
        </div>
    </div>
    <div class="card-body">
    <?php the_excerpt() ?>
    </div>
    <div class="card-footer bg-primary">
        <a href="<?php the_permalink(  ) ?>">مشاهده مطلب</a>
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
