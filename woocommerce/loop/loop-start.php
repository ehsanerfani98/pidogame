<?php

/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if (!defined('ABSPATH')) {
	exit;
}
?>

<style>
	.wrap-cart-plswb {
		border-radius: 10px;
		height: auto;
		box-shadow: rgba(33, 35, 38, 0.1) 0px 10px 10px -10px;
	}

	.image-cart-plswb {
		text-align: center;
		height: 150px !important;
	}

	.image-cart-plswb img {
		width: 100% !important;
		height: 100% !important;
		object-fit: fill;
	}

	.image-cart-plswb img {
		border-top-left-radius: 6px;
		border-top-right-radius: 6px;
	}

	.wrap-content-product {
		padding: 0.6rem 1rem 1rem 1rem;
	}

	.title-cart-plswb h4 {
		font-size: 12px;
		color: #999;
	}

	.icon-device {
		background: rgb(0 158 247 / 16%);
		width: 1.4rem;
		height: 1.2rem;
		border-radius: 20%;
		position: relative;
	}

	.icon-device svg {
		width: 10px;
		height: 10px;
		position: absolute;
		right: 4px;
		top: 2.2px;
	}

	.deavice_name {
		display: flex;
		flex-direction: row-reverse;
		align-items: center;
		gap: .3rem;
		flex-wrap: wrap;
	}

	.deavice_name h5 {
		font-weight: bold;
		margin: 0;
		font-size: 12px;
	}

	.device-cart-plswb {
		margin-top: 1rem;
		margin-bottom: .5rem;
		align-items: center;
	}

	.platform,
	.creator {
		display: flex;
		flex-direction: column;
	}

	.platform .title,
	.creator .title {
		font-size: 12px;
		color: #999;
		margin-bottom: .5rem;
	}

	.platform .content,
	.creator .content {
		font-size: 10px;
		font-weight: bold;
	}

	.platform .content {
		background: #fff6de;
		border-radius: 4px;
		color: #ffb100;
		padding: .2rem .4rem;
	}

	.creator .content {
		background: #deffee;
		border-radius: 4px;
		color: #35bb76;
		padding: .2rem .4rem;
	}

	.platform-cart-plswb {
		display: flex;
		align-items: center;
		gap: 4rem;
	}
</style>


<!-- <ul class="products columns-<?php echo esc_attr(wc_get_loop_prop('columns')); ?>"> -->
<div class="row">