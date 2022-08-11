<?php

if (isset($_POST['btn-pay'])) {
    $product_id = create_product(array(
        'type'               => '',
        'name'               => $_POST['title_product'],
        'regular_price'      => $_POST['amount'],
        // 'sale_price'         => '',
        'reviews_allowed'    => false,
    ));
}

$options = get_option('pidogame_framework');


?>
<div class="d-flex flex-column flex-root">
    <div class="page d-flex flex-row flex-column-fluid">
        <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start ">
            <?php get_template_part('templates/page/aside/aside') ?>
            <div class="content flex-row-fluid" id="kt_content">
                <form action="" method="post">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h1><?php the_title() ?></h1>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php the_content() ?>
                        </div>
                        <div class="card-footer">
                            <?php the_ID() ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php get_template_part('templates/page/drawers/drawers') ?>
<?php get_template_part('templates/page/scrolltop/scrolltop') ?>
<?php if ($options['opt-header-notifications-switcher']) get_template_part('templates/page/modals/notification/notification') ?>