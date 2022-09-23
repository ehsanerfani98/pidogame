<?php

/**
 * Checkout Payment Section
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.3
 */

defined('ABSPATH') || exit;

if (!wp_doing_ajax()) {
	do_action('woocommerce_review_order_before_payment');
}
?>

<div id="payment" class="woocommerce-checkout-payment card text-gray-700">
	<?php if (WC()->cart->needs_payment()) : ?>
		<ul class="wc_payment_methods payment_methods methods">
			<?php
			if (!empty($available_gateways)) {
				foreach ($available_gateways as $gateway) {
					wc_get_template('checkout/payment-method.php', array('gateway' => $gateway));
				}
			} else {
			?>
				<div class="alert alert-dismissible bg-light-info d-flex flex-column flex-sm-row w-100 p-5 mb-0">
					<!--begin::Icon-->
					<!--begin::Svg Icon | path: icons/duotune/general/gen007.svg-->
					<span class="svg-icon svg-icon-2hx svg-icon-info me-4 mb-5 mb-sm-0">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<path opacity="0.3" d="M12 22C13.6569 22 15 20.6569 15 19C15 17.3431 13.6569 16 12 16C10.3431 16 9 17.3431 9 19C9 20.6569 10.3431 22 12 22Z" fill="black"></path>
							<path d="M19 15V18C19 18.6 18.6 19 18 19H6C5.4 19 5 18.6 5 18V15C6.1 15 7 14.1 7 13V10C7 7.6 8.7 5.6 11 5.1V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V5.1C15.3 5.6 17 7.6 17 10V13C17 14.1 17.9 15 19 15ZM11 10C11 9.4 11.4 9 12 9C12.6 9 13 8.6 13 8C13 7.4 12.6 7 12 7C10.3 7 9 8.3 9 10C9 10.6 9.4 11 10 11C10.6 11 11 10.6 11 10Z" fill="black"></path>
						</svg>
					</span>
					<!--end::Svg Icon-->
					<!--end::Icon-->
					<!--begin::Content-->
					<div class="d-flex flex-column pe-0">
						<h4 class="fw-bold">توجه!</h4>
						<span>
							<?php
							echo apply_filters('woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__('Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce') : esc_html__('Please fill in your details above to see available payment methods.', 'woocommerce'));
							?>
						</span>
					</div>
					<!--end::Content-->
					
				</div>
			<?php
				// echo '<li class="woocommerce-notice woocommerce-notice--info ">' . apply_filters('woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__('Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce') : esc_html__('Please fill in your details above to see available payment methods.', 'woocommerce')) . '</li>'; // @codingStandardsIgnoreLine
			}
			?>
		</ul>
	<?php endif; ?>
	<div class="form-row place-order">
		<noscript>
			<?php
			/* translators: $1 and $2 opening and closing emphasis tags respectively */
			printf(esc_html__('Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce'), '<em>', '</em>');
			?>
			<br /><button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e('Update totals', 'woocommerce'); ?>"><?php esc_html_e('Update totals', 'woocommerce'); ?></button>
		</noscript>

		<?php wc_get_template('checkout/terms.php'); ?>

		<?php do_action('woocommerce_review_order_before_submit'); ?>

		<?php echo apply_filters('woocommerce_order_button_html', '<button type="submit" class="btn btn-primary alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr($order_button_text) . '" data-value="' . esc_attr($order_button_text) . '">' . esc_html($order_button_text) . '</button>'); // @codingStandardsIgnoreLine 
		?>

		<?php do_action('woocommerce_review_order_after_submit'); ?>

		<?php wp_nonce_field('woocommerce-process_checkout', 'woocommerce-process-checkout-nonce'); ?>
	</div>
</div>
<?php
if (!wp_doing_ajax()) {
	do_action('woocommerce_review_order_after_payment');
}
