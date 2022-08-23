<?php

/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_cart'); ?>
<style>
	.table>tbody>tr>td {
		vertical-align: middle !important;
	}

	.plswb-thumbnail {
		width: 80px;
		height: 80px;
	}

	.plswb-thumbnail img {
		width: 100%;
		height: 100%;
		border-radius: 50%;
		border: 4px solid #a6c0c9;
		padding: 2px;
	}

	#coupon_code {
		display: inline-block;
		width: 50%;
	}

	.coupon {
		display: inline-block;
	}

	.wrap-footer-cart {
		display: flex;
		justify-content: end;
	}

	.plswb-restore-back {
		justify-content: space-between !important;
		align-items: center !important;
		flex-direction: row !important;
		width: 100% !important;
	}

	a.restore-item {
		border: none !important;
		background: #009ef7 !important;
		border-radius: 8px !important;
		padding: .8rem 1.5rem !important;
		color: white !important;
	}

	a.restore-item:hover {
		background: #0b95e6 !important;
	}
	
</style>
<div class="card shop_table shop_table_responsive cart woocommerce-cart-form__contents">
	<div class="card-body">
		<form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
			<?php do_action('woocommerce_before_cart_table'); ?>
			<div class="table-responsive">
				<table class="table table-striped gy-7 gs-7 table-rounded border" cellspacing="0">
					<thead>
						<tr>
							<th class="product-remove">&nbsp;</th>
							<th class="product-thumbnail">&nbsp;</th>
							<th class="product-name"><?php esc_html_e('Product', 'woocommerce'); ?></th>
							<th class="product-price"><?php esc_html_e('Price', 'woocommerce'); ?></th>
							<th class="product-quantity"><?php esc_html_e('Quantity', 'woocommerce'); ?></th>
							<th class="product-subtotal"><?php esc_html_e('Subtotal', 'woocommerce'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php do_action('woocommerce_before_cart_contents'); ?>

						<?php
						foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
							$_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
							$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

							if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
								$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
						?>
								<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">

									<td class="product-remove">
										<?php
										echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
											'woocommerce_cart_item_remove_link',
											sprintf(
												'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
												esc_url(wc_get_cart_remove_url($cart_item_key)),
												esc_html__('Remove this item', 'woocommerce'),
												esc_attr($product_id),
												esc_attr($_product->get_sku())
											),
											$cart_item_key
										);
										?>
									</td>

									<td class="product-thumbnail">
										<div class="plswb-thumbnail">

											<?php
											$thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

											if (!$product_permalink) {
												echo $thumbnail; // PHPCS: XSS ok.
											} else {
												printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
											}
											?>
										</div>
									</td>

									<td class="product-name" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
										<?php
										if (!$product_permalink) {
											echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
										} else {
											echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<b style="font-size:15px"><a href="%s">%s</a></b>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
										}

										do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

										// Meta data.
										echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

										// Backorder notification.
										if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
											echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
										}
										?>
									</td>

									<td class="product-price" data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
										<?php
										echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
										?>
									</td>

									<td class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
										<?php
										if ($_product->is_sold_individually()) {
											$product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
										} else {
											$product_quantity = woocommerce_quantity_input(
												array(
													'input_name'   => "cart[{$cart_item_key}][qty]",
													'input_value'  => $cart_item['quantity'],
													'max_value'    => $_product->get_max_purchase_quantity(),
													'min_value'    => '0',
													'product_name' => $_product->get_name(),
												),
												$_product,
												false
											);
										}

										echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
										?>
									</td>

									<td class="product-subtotal" data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>">
										<?php
										echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // PHPCS: XSS ok.
										?>
									</td>
								</tr>
						<?php
							}
						}
						?>

						<?php do_action('woocommerce_cart_contents'); ?>

						<tr>
							<td colspan="6" class="actions">

								<div class="wrap-footer-cart">
									<!-- <?php if (wc_coupons_enabled()) { ?>
										<div class="coupon">
											<label for="coupon_code"><?php esc_html_e('Coupon:', 'woocommerce'); ?></label> <input type="text" name="coupon_code" class="input-text form-control" id="coupon_code" value="" placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>" /> <button type="submit" class="btn btn-success" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>"><?php esc_attr_e('Apply coupon', 'woocommerce'); ?></button>
											<?php do_action('woocommerce_cart_coupon'); ?>
										</div>
									<?php } ?> -->
									<button type="submit" class=" btn btn-info" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>"><?php esc_html_e('Update cart', 'woocommerce'); ?></button>

								</div>


								<?php do_action('woocommerce_cart_actions'); ?>

								<?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
							</td>
						</tr>

						<?php do_action('woocommerce_after_cart_contents'); ?>
					</tbody>
				</table>
			</div>
			<?php do_action('woocommerce_after_cart_table'); ?>
		</form>
	</div>
</div>


<?php do_action('woocommerce_before_cart_collaterals'); ?>

<div class="cart-collaterals">
	<?php
	/**
	 * Cart collaterals hook.
	 *
	 * @hooked woocommerce_cross_sell_display
	 * @hooked woocommerce_cart_totals - 10
	 */
	do_action('woocommerce_cart_collaterals');
	?>
</div>

<?php do_action('woocommerce_after_cart'); ?>

<script>
	jQuery('input').on('change', function() {
		jQuery('button[name="update_cart"]').prop('disabled', false);
	});
</script>