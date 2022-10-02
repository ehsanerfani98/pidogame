<?php
/**
 * Displayed when no products are found matching the current query
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/no-products-found.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.0.0
 */

defined( 'ABSPATH' ) || exit;

?>
<!-- <p class="woocommerce-info"><?php esc_html_e( 'No products were found matching your selection.', 'woocommerce' ); ?></p> -->
<div class="alert alert-dismissible bg-light-info border-dashed border-1 border-info d-flex flex-column flex-sm-row w-100 p-5 align-items-center mt-8" <?php echo wc_get_notice_data_attr($notice); ?>>
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
		<div class="d-flex flex-column pe-0 pe-sm-10">
			<span>
            <?php esc_html_e( 'No products were found matching your selection.', 'woocommerce' ); ?>
			</span>
		</div>
		<!--end::Content-->

	</div>