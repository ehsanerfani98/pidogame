<?php $options = get_option('pidogame_framework') ?>
<div class="header-logo me-5 me-md-10 flex-grow-1 flex-lg-grow-0">
    <a href="/">
        <?php if ($options['opt-header-desktop-logo']['url'] && $options['opt-header-desktop-logo-height']) : ?>
            <img src="<?php echo $options['opt-header-desktop-logo']['url'] ?>" class="d-none d-lg-block <?php echo $options['opt-header-desktop-logo-height'] ?>" alt="<?php echo $options['opt-header-desktop-logo']['alt'] ?>" />
        <?php endif ?>
        <?php if ($options['opt-header-mobile-logo']['url'] && $options['opt-header-mobile-logo-height']) : ?>
            <img src="<?php echo $options['opt-header-mobile-logo']['url'] ?>" class="d-lg-none <?php echo $options['opt-header-mobile-logo-height'] ?>" alt="<?php echo $options['opt-header-mobile-logo']['alt'] ?>" />
        <?php endif ?>
    </a>
</div>