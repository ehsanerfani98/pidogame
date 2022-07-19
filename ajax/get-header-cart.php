<?php require_once("../../../../wp-load.php");
$options = get_option('pidogame_framework') ?>

<?php if (WC()->cart->get_cart_contents_count() == 0) : ?>
    <div class="text-center">
        <div class="pt-10 pb-5">
            <span class="svg-icon svg-icon-4x opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.3" d="M20 22H4C3.4 22 3 21.6 3 21V2H21V21C21 21.6 20.6 22 20 22Z" fill="currentColor" />
                    <path d="M12 14C9.2 14 7 11.8 7 9V5C7 4.4 7.4 4 8 4C8.6 4 9 4.4 9 5V9C9 10.7 10.3 12 12 12C13.7 12 15 10.7 15 9V5C15 4.4 15.4 4 16 4C16.6 4 17 4.4 17 5V9C17 11.8 14.8 14 12 14Z" fill="currentColor" />
                </svg>
            </span>
        </div>
        <div class="pb-15 fw-bold">
            <h3 class="text-gray-600 fs-5 mb-2"><?= $options['opt-header-cart-empty-title'] ?></h3>
            <div class="text-muted fs-7"><?= $options['opt-header-cart-empty-subtitle'] ?></div>
        </div>
    </div>
<?php else : ?>
    <div class="d-flex flex-column">
        <h3 class="text-dark fw-bold px-9 py-5 border-bottom"><?= $options['opt-header-cart-title'] ?>
            <span class="fs-8 opacity-75 ps-3 ss02"><?= count(WC()->cart->get_cart()) ?> مورد</span>
        </h3>
    </div>
    <div class="tab-content">
        <div class="scroll-y mh-325px my-5 px-8">
            <?php global $woocommerce;
            $items = $woocommerce->cart->get_cart();
            foreach ($items as $item => $values) : $_product = wc_get_product($values['product_id']) ?>
                <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-3">
                    <div class="d-flex flex-stack py-4">
                        <div class="d-flex align-items-center me-2">
                            <div class="symbol symbol-50px me-5">
                                <span class="symbol-label bg-lighten">
                                    <?php $meta = get_post_meta($_product->get_id(), 'pidogame_framework_products', true) ?>
                                    <div class="w-100 h-100 bgi-size-cover bgi-position-center rounded" style="background-image: url('<?= wp_get_attachment_url(get_post_thumbnail_id($_product->get_id())) ?>');"></div>
                                </span>
                                <span id="header-cart-remove-item" data-product-id="<?= $values['variation_id'] ?>" role="button" class="symbol-badge badge badge-circle bg-danger start-0 top-0">
                                    <i class="bi bi-x text-white"></i>
                                </span>
                                <span class="symbol-badge badge badge-circle bg-info start-0 top-100 ss02"><?= $values['quantity'] ?></span>
                            </div>
                            <div class="d-flex align-items-center flex-wrap w-100">
                                <div class="mb-1 pe-3 flex-grow-1">
                                    <div class="d-block">
                                        <span class="svg-icon svg-icon-primary svg-icon-6">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z" fill="currentColor" />
                                                <path d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z" fill="currentColor" />
                                                <path opacity="0.3" d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z" fill="currentColor" />
                                                <path opacity="0.3" d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <span class="fs-8 text-primary">
                                        <a href="<?= $_product->get_permalink() ?>" class="text-gray-800 text-hover-primary fw-bold"><?= $_product->get_title() ?></a>

                                            <?php
                                            // $_product_plswb   = apply_filters('woocommerce_cart_item_product', $values['data'], $values, $item);

                                            // $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product_plswb->is_visible() ? $_product_plswb->get_permalink($values) : '', $values, $item);

                                            // if (!$product_permalink) {
                                            //     echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product_plswb->get_name(), $values, $item) . '&nbsp;');
                                            // } else {
                                            //     echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product_plswb->get_name()), $values, $item));
                                            // }


                                            // $slug_r = $values['variation']['attribute_pa_region'];
                                            // $slug_d = $values['variation']['attribute_pa_device'];
                                            // $region = !empty(get_term_by('slug', $slug_r, 'pa_region')->name) ? 'ریجن ' . get_term_by('slug', $slug_r, 'pa_region')->name : '';
                                            // $device = !empty(get_term_by('slug', $slug_d, 'pa_device')->name) ? get_term_by('slug', $slug_d, 'pa_device')->name : '';
                                            // if (!empty($device) and !empty($region)) {
                                            //     echo $device . ' - ' . $region;
                                            // } else {
                                            //     echo $device . $region;
                                            // }
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span class="badge badge-light fs-8 ss02"><?=
                                                                    $price = WC()->cart->get_product_price($values['data']);
                                                                    number_format($price) ?></span>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <div class="py-3 text-center border-top">
            <a class="btn btn-sm btn-light me-2" href="<?= wc_get_cart_url() ?>"><?= $options['opt-header-cart-cart-button'] ?></a>
            <a class="btn btn-sm btn-primary" href="<?= wc_get_checkout_url() ?>"><?= $options['opt-header-cart-checkout-button'] ?><span class="badge badge-light-primary ms-2 ss02"><?= number_format(WC()->cart->cart_contents_total) . ' ' . get_woocommerce_currency_symbol() ?></span></a>
        </div>
    </div>
<?php endif ?>