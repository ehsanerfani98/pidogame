<?php $options = get_option('pidogame_framework') ?>
<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
    <div class="container-xxl d-flex flex-column flex-md-row align-items-center justify-content-between">
        <div class="text-dark order-2 order-md-1">
            <span class="text-gray-700 fw-bold me-1"><?php echo date('Y') ?>©</span>
            <a class="text-gray-800"><?php echo $options['opt-footer-copyright'] ?></a>
        </div>
        <?php get_template_part('templates/page/footer/menu') ?>
    </div>
</div>