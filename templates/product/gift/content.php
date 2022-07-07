<?php
$meta = get_post_meta(get_the_ID(), 'pidogame_framework_products', true);
global $product;
?>
<div class="mt-xl-4 mt-lg-3 mt-md-2 mt-1 lh-xl text-gray-700 fs-6 ss02 img-rounded">
    <?php the_content() ?>
</div>