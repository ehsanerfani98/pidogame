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

$meta = get_post_meta(get_the_ID(), 'pidogame_framework_products', true);
?>
<div class="col-lg-3 mb-4">
	<a href="<?php the_permalink() ?>">
		<div class="wrap-cart-plswb card">


			<div class="image-cart-plswb">
				<?php if (file_exists(get_attached_file(get_post_thumbnail_id(get_the_ID())))) : ?>
					<?php the_post_thumbnail() ?>
				<?php else : ?>
					<img class="no-image" src="<?= IMAGES_URL . 'no-image-found.png' ?>" alt="">
				<?php endif; ?>
			</div>

			<div class="wrap-content-product">
				<div class="title-cart-plswb">
					<h4><?php the_title() ?></h4>
				</div>

				<div class="device-cart-plswb">

					<div class="deavice_name">
						<span class="icon-device">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
								<path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
								<path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z" />
							</svg>
						</span>
						<h5><?= $meta['opt-product-subtitle'] ?></h5>
					</div>
				</div>
				<div class="price text-center mt-6">
					<span class="badge badge-light p-2">
						<?php echo $product->get_price_html(); ?>
					</span>
				</div>
				<!-- <div class="platform-cart-plswb">
					<div class="platform">
						<span class="title">پلتفرم :</span>
						<span class="content">استیم</span>
					</div>
					<div class="creator">
						<span class="title">سازنده :</span>
						<span class="content">Sanata Monica Studio</span>
					</div>
				</div> -->
			</div>
			<div class="card-footer py-1 text-center bg-primary bg-opacity-75">
				<a href="<?php the_permalink() ?>" class="d-block fw-bolder fs-6 py-2 text-white">خرید محصول</a>
			</div>
		</div>
	</a>
</div>