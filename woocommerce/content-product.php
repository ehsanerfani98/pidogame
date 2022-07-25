<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
	return;
}
?>
<div class="col-lg-3 mb-4">
	<a href="<?php the_permalink() ?>">
		<div class="wrap-cart-plswb card">


			<div class="image-cart-plswb">
				<?php if ( file_exists( get_attached_file ( get_post_thumbnail_id( get_the_ID() ) ))): ?>
				<?php the_post_thumbnail('cart-product-plswb') ?>
				<?php else: ?>
					<img class="no-image" src="<?= IMAGES_URL.'no-image-found.png' ?>" alt="">
				<?php endif; ?>
			</div>

			<div class="wrap-content-product">
				<div class="title-cart-plswb">
					<h4><?php the_title() ?></h4>
				</div>

				<div class="device-cart-plswb">
					<span class="icon-device">
						<svg style="color: rgb(243, 53, 145);" xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
							<title>ionicons-v5_logos</title>
							<path d="M480,265H232V444l248,36V265Z" fill="#f33591"></path>
							<path d="M216,265H32V415l184,26.7V265Z" fill="#f33591"></path>
							<path d="M480,32,232,67.4V249H480V32Z" fill="#f33591"></path>
							<path d="M216,69.7,32,96V249H216V69.7Z" fill="#f33591"></path>
						</svg>
					</span>
					<div class="deavice_name">
						<h4>Fall Guys</h4>
					</div>
				</div>

				<div class="platform-cart-plswb">
					<div class="platform">
						<span class="title">پلتفرم :</span>
						<span class="content">استیم</span>
					</div>
					<div class="creator">
						<span class="title">سازنده :</span>
						<span class="content">Sanata Monica Studio</span>
					</div>
				</div>
			</div>

		</div>
	</a>
</div>