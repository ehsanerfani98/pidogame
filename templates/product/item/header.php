<?php
$meta = get_post_meta(get_the_ID(), 'pidogame_framework_products', true);
global $product;


function fx_check($pid, $vid)
{

	unset($created_fields);

	$arg = array(
		'post_type' => 'extra_fields_plswb',
		'post_status' => 'publish',
		'posts_per_page' => -1,
	);

	$fields_plswb = new WP_Query($arg);
	if ($fields_plswb->have_posts()) {
		while ($fields_plswb->have_posts()) {
			$fields_plswb->the_post();
			$display_rules = get_post_meta(get_the_ID(), "all_products_show_rules", true);
			$extra_fields = get_post_meta(get_the_ID(), "plswb_fields", true);

			foreach ($display_rules as $product_id) {
				$product = wc_get_product($product_id);
				if ($product->is_type('simple')) {
					$all_org_variation_ids[] = $product_id;
				} else {
					$variations = new WC_Product_Variable($product_id);
					foreach ($variations->get_children() as  $v_id) {
						$all_org_variation_ids[] = $v_id;
					}
				}
			}

			$all_org_variation_ids = array_unique($all_org_variation_ids);

			foreach ($extra_fields as $field) {
				if ($field['disable_org_show_products_rules']) {

					foreach ($field['inside_show_products_rules'] as $inside_product_id) {
						$product = wc_get_product($inside_product_id);
						if ($product->is_type('simple')) {
							$inside_variation_ids[] = $inside_product_id;
						} else {
							$inside_variations = new WC_Product_Variable($inside_product_id);
							foreach ($inside_variations->get_children() as  $inside_v_id) {
								$inside_variation_ids[] = $inside_v_id;
							}
						}
					}
					$inside_variation_ids = array_unique($inside_variation_ids);

					if (count($field['not_show_products_rules']) > 0) {
						foreach ($field['not_show_products_rules'] as $not_show_product_id) {
							$product = wc_get_product($not_show_product_id);
							if ($product->is_type('simple')) {
								$not_show_variation_ids[] = $not_show_product_id;
							} else {
								$not_show_variations = new WC_Product_Variable($not_show_product_id);
								foreach ($not_show_variations->get_children() as  $not_show_v_id) {
									$not_show_variation_ids[] = $not_show_v_id;
								}
							}
						}
						$not_show_variation_ids = array_unique($not_show_variation_ids);

						$display_rules_ids = array_diff($inside_variation_ids, $not_show_variation_ids);
					} else {
						$display_rules_ids = $inside_variation_ids;
					}

					if (is_null($vid)) {
						if (in_array($pid, $display_rules_ids)) {
							$created_fields[] = $field;
						}
					} else {
						if (in_array($vid, $display_rules_ids)) {
							$created_fields[] = $field;
						}
					}
				} else {
					if (count($field['not_show_products_rules']) > 0) {

						foreach ($field['not_show_products_rules'] as $not_show_product_id) {
							$product = wc_get_product($not_show_product_id);
							if ($product->is_type('simple')) {
								$not_show_variation_ids[] = $not_show_product_id;
							} else {
								$not_show_variations = new WC_Product_Variable($not_show_product_id);
								foreach ($not_show_variations->get_children() as  $not_show_v_id) {
									$not_show_variation_ids[] = $not_show_v_id;
								}
							}
						}
						$not_show_variation_ids = array_unique($not_show_variation_ids);

						$display_rules_ids =  $not_show_variation_ids;

						if (is_null($vid)) {
							if (in_array($pid, $display_rules_ids)) {
								$created_fields[] = $field;
							}
						} else {
							if (in_array($vid, $display_rules_ids)) {
								$created_fields[] = $field;
							}
						}
					} else {
						if (is_null($vid)) {
							if (in_array($pid, $all_org_variation_ids)) {
								$created_fields[] = $field;
							}
						} else {
							if (in_array($vid, $all_org_variation_ids)) {
								$created_fields[] = $field;
							}
						}
					}
				}
			}

			unset($all_org_variation_ids);
			unset($inside_variation_ids);
		}
		wp_reset_postdata();
	}

	return $created_fields;
}

dd(311,null);
?>


<div class="row">
    <?php do_action('myalarm'); ?>

    <div class="col-lg-12 px-5">
        <ul class="breadcrumb breadcrumb-line fw-bold fs-7 mb-8">
            <?php if (function_exists('bcn_display')) bcn_display() ?>
        </ul>
    </div>
</div>

<div class="card overlay overflow-hidden w-100">
    <div class="card-body p-0">
        <div class="ar-16-8 ar-md-16-6 ar-lg-16-6 ar-xl-16-4 bgi-size-cover bgi-position-center" style="background-image: url(<?php echo $meta['opt-product-wallpaper-image']['url'] ?>)"></div>
        <div class="overlay-layer opacity-50 bg-black"></div>
        <div class="overlay-layer opacity-100 d-flex d-lg-none">
            <div class="d-flex flex-grow-1 flex-center py-5 px-5">
                <div>
                    <h1 class="text-white"><?php the_title() ?></h1>
                    <h3 class="fs-5 text-muted mt-2 ss02"><?php echo $meta['opt-product-subtitle'] ?></h3>
                    <div class="symbol symbol-25px me-2 d-block mt-4">
                        <span class="symbol-label bg-info d-inline-flex">
                            <i class="bi bi-mouse3-fill fs-8 text-white"></i>
                        </span>
                        <?php if ($product->get_attribute('device')) : ?>
                            <span class="text-white ms-2"><?php echo str_replace(',', '،', $product->get_attribute('device')) ?></span>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="d-block d-lg-none mt-5">
            <?php get_template_part('templates/product/item/header-card') ?>
        </div>
    </div>
  
</div>
<div class="d-none d-lg-flex row px-12 position-relative" style="margin-top: -160px">
    <div class="col-lg-5 col-xl-4">
        <?php get_template_part('templates/product/item/header-card') ?>
    </div>
    <div class="col-lg-7 col-xl-8 mt-16">
        <h1 class="text-white"><?php the_title() ?></h1>
        <h3 class="fs-5 text-muted mt-2 ss02"><?php echo $meta['opt-product-subtitle'] ?></h3>
        <div class="symbol symbol-25px me-2 d-block mt-4">
            <span class="symbol-label bg-info d-inline-flex">
                <i class="bi bi-mouse3-fill fs-8 text-white"></i>
            </span>
            <?php if ($product->get_attribute('device')) : ?>
                <span class="text-white ms-2"><?php echo str_replace(',', '،', $product->get_attribute('device')) ?></span>
            <?php endif ?>
        </div>
        <p class="lh-xl pt-10 text-gray-700 ss02"><?php echo get_the_excerpt() ?></p>
        <?php get_template_part('templates/product/item/price') ?>
    </div>
</div>