<?php
$options = get_option('pidogame_framework');
wp_head();
?>

<div class="woocommerce">
<?php woocommerce_content(); ?>
</div>

<?php

wp_footer();
