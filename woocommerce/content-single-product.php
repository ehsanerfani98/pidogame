<?php
$options = get_option('pidogame_framework');
$meta = get_post_meta(get_the_ID(), 'pidogame_framework_products', true);
?>

                    <?php

					if (get_post_field('post_name', get_post()) == "pay") {
						get_template_part('templates/product/free-payment');
					}
					else{
						$type = $meta['opt-product-type'];
						switch ($type) {
							case 'game':
								get_template_part('templates/product/game/game');
								break;
							case 'gift':
								get_template_part('templates/product/gift/gift');
								break;
							case 'item':
								get_template_part('templates/product/item/item');
								break;
						}
					}
					?>
     
<?php
