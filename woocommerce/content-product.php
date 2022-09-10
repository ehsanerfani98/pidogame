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
<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-8">

	<a href="<?php the_permalink() ?>">
		<div class="wrap-cart-plswb card">


			<div class="image-cart-plswb">
				<?php if (file_exists(get_attached_file(get_post_thumbnail_id(get_the_ID())))) : ?>
					<?php the_post_thumbnail() ?>
				<?php else : ?>
					<img class="no-image" src="<?= IMAGES_URL . 'no-image-found.png' ?>" alt="">
				<?php endif; ?>
			</div>

			<div class="wrap-content-product mt-2 px-4 py-3">
				<div class="title-cart-plswb">
					<h4><?php the_title() ?></h4>
				</div>

				<div class="device-cart-plswb">
					<div class="deavice_name">
						<span class="svg-icon svg-icon-primary svg-icon-1hx"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<path d="M10 4L18 12L10 20H14L21.3 12.7C21.7 12.3 21.7 11.7 21.3 11.3L14 4H10Z" fill="black" />
								<path opacity="0.3" d="M3 4L11 12L3 20H7L14.3 12.7C14.7 12.3 14.7 11.7 14.3 11.3L7 4H3Z" fill="black" />
							</svg></span>
						<h5><?= $meta['opt-product-subtitle'] ?></h5>
					</div>
				</div>
			</div>
			<div class="separator separator-solid"></div>
			<div class="wrap-content-product">

				<div class="price text-gray-700 bg-light text-center mt-2 rounded">
					<div class="d-flex justify-content-around align-items-center bg-light py-2">
						<?php echo $product->get_price_html(); ?>
					</div>
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
			<?php if ($product->is_in_stock()) : ?>
				<div class="card-footer py-1 text-center bg-primary bg-opacity-75">
					<a href="<?php the_permalink() ?>" class="d-block fw-bolder fs-6 py-2 text-white">خرید محصول</a>
				</div>
			<?php else : ?>
				<div class="card-footer py-1 text-center bg-danger bg-opacity-75">
					<a class="d-block fw-bolder fs-6 py-2 text-white">ناموجود</a>
				</div>
			<?php endif ?>

		</div>
	</a>
</div>