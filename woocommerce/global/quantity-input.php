<?php

/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.0.0
 */

defined('ABSPATH') || exit;

if ($max_value && $min_value === $max_value) {
?>
	<div class="quantity hidden">
		<input type="hidden" id="<?php echo esc_attr($input_id); ?>" class="qty" name="<?php echo esc_attr($input_name); ?>" value="<?php echo esc_attr($min_value); ?>" />
	</div>
<?php
} else {
	/* translators: %s: Quantity. */
	$label = !empty($args['product_name']) ? sprintf(esc_html__('%s quantity', 'woocommerce'), wp_strip_all_tags($args['product_name'])) : esc_html__('Quantity', 'woocommerce');
?>
	<div class=" position-relative w-100px d-inline-block">
		<?php do_action('woocommerce_before_quantity_input_field'); ?>
		<!-- <label class="screen-reader-text" for="<?php echo esc_attr($input_id); ?>"><?php echo esc_attr($label); ?></label> -->

		<!-- <div data-kt-dialer="true" data-kt-dialer-min="<?php echo esc_attr($min_value); ?>" data-kt-dialer-max="<?php echo esc_attr(0 < $max_value ? $max_value : ''); ?>" data-kt-dialer-step="<?php echo esc_attr($step); ?>">
			<button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease"><span class="svg-icon svg-icon-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
						<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
						<rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="currentColor"></rect>
					</svg></span></button>
			<input id="<?php echo esc_attr($input_id); ?>" name="<?php echo esc_attr($input_name); ?>" value="<?php echo esc_attr($input_value); ?>" type="text" class="form-control form-control-solid border-0 text-center ss02 w-100px" readonly data-kt-dialer-control="input">
			<button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase"><span class="svg-icon svg-icon-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
						<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
						<rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor"></rect>
						<rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor"></rect>
					</svg></span></button>

		</div> -->
		<div class="wrap-input-number">

			<button type="button" class="decrease">
				<span class="svg-icon svg-icon-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
						<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
						<rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="currentColor"></rect>
					</svg></span>
			</button>

			<input readonly type="text" id="<?php echo esc_attr($input_id); ?>" name="<?php echo esc_attr($input_name); ?>" value="<?php echo esc_attr($input_value); ?>" data-plswb-min="1" data-plswb-max="20" data-plswb-step="<?php echo esc_attr($step); ?>" class="plswb-quantity">

			<button type="button" class="increase">
				<span class="svg-icon svg-icon-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
						<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
						<rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor"></rect>
						<rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor"></rect>
					</svg></span>
			</button>
		</div>

		<!-- <input
			type="number"
			id="<?php echo esc_attr($input_id); ?>"
			class="<?php echo esc_attr(join(' ', (array) $classes)); ?>"
			step="<?php echo esc_attr($step); ?>"
			min="<?php echo esc_attr($min_value); ?>"
			max="<?php echo esc_attr(0 < $max_value ? $max_value : ''); ?>"
			name="<?php echo esc_attr($input_name); ?>"
			value="<?php echo esc_attr($input_value); ?>"
			title="<?php echo esc_attr_x('Qty', 'Product quantity input tooltip', 'woocommerce'); ?>"
			size="4"
			placeholder="<?php echo esc_attr($placeholder); ?>"
			inputmode="<?php echo esc_attr($inputmode); ?>"
			autocomplete="<?php echo esc_attr(isset($autocomplete) ? $autocomplete : 'on'); ?>"
		/> -->
		<?php do_action('woocommerce_after_quantity_input_field'); ?>
	</div>
<?php
}
