<?php

$meta = get_post_meta(get_the_ID(), 'pidogame_framework_products', true);
global $product;
$type = $product->get_type();

$availableVariations = array();
for ($i = 0; $i < count($product->get_attributes()); $i++) {
    $keys = array_keys($product->get_attributes());
    $attribute = $product->get_attributes()[$keys[$i]];
    if ($attribute['variation'] && get_post_meta($product->id, 'attribute_' . $attribute['name'] . '_filter_' . $i, true)) array_push($availableVariations, $attribute);
}

$deliveryArray = array();
foreach ($product->get_available_variations() as $variation) {
    $formattedDescription = strip_tags($variation['variation_description']);
    $explode = explode('#', $formattedDescription);
    isset($explode[1]) ? $deliveryTime = $explode[1] : $deliveryTime = null;
    if (!in_array($deliveryTime, $deliveryArray)) array_push($deliveryArray, $deliveryTime);
}



?>
<div class="separator my-5"></div>
<div class="card mb-7">
    <div class="card-body">
        <div class="row">
            <?php foreach ($availableVariations as $variation) : ?>
                <?php $name = wc_get_attribute($variation['id'])->name ?>
                <div class="col-6 col-xl-2">
                    <select name="<?php echo $variation['name'] ?>" class="gift-card-select form-select form-select-solid" data-control="select2" data-placeholder="<?php echo $name ?>" data-allow-clear="true">
                        <option></option>
                        <?php foreach ($variation['options'] as $optionId) : ?>
                            <?php $term = get_term($optionId) ?>
                            <option value="<?php echo $term->slug ?>" data-kt-select2-icon="<?php echo $term->description ?>"><?php echo $term->name ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            <?php endforeach ?>
            <?php if (count($deliveryArray) > 1) : ?>
                <div class="col-6 col-xl-2">
                    <select name="delivery-time" class="form-select form-select-solid" data-control="select2" data-placeholder="مدت تحویل" data-allow-clear="true" data-hide-search="true">
                        <option></option>
                        <?php foreach ($deliveryArray as $optionId) : ?>
                            <option value="<?php echo $optionId ?>"><?php echo $optionId ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            <?php endif ?>
            <div class="col-9 col-xl-3 mt-3 mt-xl-0 d-none">
                <div class="position-relative">
                    <span class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black"></path>
                        </svg>
                    </span>
                    <input type="text" class="gift-cards-search form-control form-control-solid ps-10 ss02" placeholder="جستجو در گیفت کارت ها">
                </div>
            </div>
        </div>
    </div>
</div>
<div id="cards_section" class="row <?php if (count($availableVariations) > 0) echo 'd-none' ?>">
    <?php $variations = $product->get_available_variations();
    foreach ($variations as $variation) :
        $attributesData = '';
        foreach ($variation['attributes'] as $key => $value) {
            $attributesData .= 'data-' . $key . '="' . $value . '"';
        }
        $formattedDescription = strip_tags($variation['variation_description']);
        $explode = explode('#', $formattedDescription);
        isset($explode[0]) ? $title = $explode[0] : $title = null;
        isset($explode[1]) ? $deliveryTime = $explode[1] : $deliveryTime = null; ?>
        <div class="gift-card-col col-12 col-md-6 col-xl-3 mb-5 <?php if (!$variation['is_in_stock']) echo 'opacity-25 opacity-50-hover fade' ?>" <?php echo $attributesData ?>>
            <div class="position-relative">
                <div class="gift-card <?php if ($variation['is_in_stock']) echo 'gift-card-flip' ?>">
                    <div class="gift-card-front gift-card-part position-absolute rounded p-7 bgi-position-center bgi-size-cover bgi-no-repeat" style="background-image: linear-gradient(to right bottom, <?php echo $meta['opt-product-gift-card-front-color']['color-1'] ?>, <?php echo $meta['opt-product-gift-card-front-color']['color-2'] ?>, <?php echo $meta['opt-product-gift-card-front-color']['color-3'] ?>, <?php echo $meta['opt-product-gift-card-front-color']['color-4'] ?>, <?php echo $meta['opt-product-gift-card-front-color']['color-5'] ?>), url('<?php echo $meta['opt-product-gift-card-front-image']['url'] ?>');">
                        <?php if ($meta['opt-product-gift-card-image']['url']) : ?>
                            <img class="<?php echo $meta['opt-product-gift-card-image-height'] ?>" src="<?php echo $meta['opt-product-gift-card-image']['url'] ?>" alt="<?php echo $meta['opt-product-gift-card-image']['alt'] ?>">
                        <?php endif ?>
                        <span class="float-end text-white fs-7 ls-2"><?php echo $variation['sku'] ?></span>
                        <p class="gift-card-title my-7 ss02 text-white text-center fw-boldest fs-3"><?php echo $title ?></p>
                        <?php if ($variation['is_in_stock']) : ?>
                            <div class="d-inline-block float-end">
                                <span class="text-white opacity-50 fs-8">قیمت</span>
                                <?php if ($variation['display_price'] == $variation['display_regular_price']) {
                                    echo '<span class="d-block text-white fs-4 mt-1 ss02">' . number_format($variation['display_price']) . ' ' . get_woocommerce_currency_symbol() . '</span>';
                                } else {
                                    $percentage = intval((($variation['display_regular_price'] - $variation['display_price']) / $variation['display_regular_price']) * 100);
                                    echo '<span class="badge badge-sm badge-light ms-3 ss02">' . $percentage . '% تخفیف</span>';
                                    echo '<span class="d-block mt-1 ss02">';
                                    echo '<span class="d-inline-block fs-7 text-muted text-decoration-line-through me-2">' . number_format($variation['display_regular_price']) . '</span>';
                                    echo '<span class="d-inline-block fs-4 text-white">' . number_format($variation['display_price']) . ' ' . get_woocommerce_currency_symbol() . '</span>';
                                    echo '</span>';
                                }
                                ?>
                            </div>
                            <?php if ($deliveryTime) : ?>
                                <div class="d-inline-block">
                                    <span class="text-white opacity-50 fs-8">مدت تحویل</span>
                                    <p class="delivery-time text-white fs-4 mt-1 ss02">
                                        <?php echo $deliveryTime ?>
                                    </p>
                                </div>
                            <?php endif ?>
                        <?php else : ?>
                            <span class="badge badge-danger position-absolute start-50 bottom-0 mb-10 translate-middle">این گیفت کارت ناموجود است!</span>
                        <?php endif ?>
                    </div>
                    <div class="gift-card-back gift-card-part position-absolute rounded py-7 bgi-position-center bgi-size-cover bgi-no-repeat" style="background-image: linear-gradient(to right bottom, <?php echo $meta['opt-product-gift-card-back-color']['color-1'] ?>, <?php echo $meta['opt-product-gift-card-back-color']['color-2'] ?>, <?php echo $meta['opt-product-gift-card-back-color']['color-3'] ?>, <?php echo $meta['opt-product-gift-card-back-color']['color-4'] ?>, <?php echo $meta['opt-product-gift-card-back-color']['color-5'] ?>), url('<?php echo $meta['opt-product-gift-card-back-image']['url'] ?>');">
                        <div class="h-40px" style="background-color: <?php echo $meta['opt-product-gift-card-line-color'] ?>;"></div>
                        <div class="px-5 pt-5">
                            <div class="text-center">
                                <div class="position-relative w-100px d-inline-block" data-kt-dialer="true" data-kt-dialer-min="<?php echo $variation['min_qty'] ?>" data-kt-dialer-max="<?php echo $variation['max_qty'] ?>" data-kt-dialer-step="1">
                                    <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease">
                                        <span class="svg-icon svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                                                <rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="currentColor"></rect>
                                            </svg>
                                        </span>
                                    </button>
                                    <input type="text" name="qty" class="form-control form-control-solid border-0 text-center ss02 w-100px" readonly="readonly" data-kt-dialer-control="input" value="1">
                                    <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase">
                                        <span class="svg-icon svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                                                <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor"></rect>
                                                <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor"></rect>
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                <button data-kt-redirect-url="<?php echo wc_get_cart_url() ?>" data-url="<?php echo get_site_url() . '/?product_id=' . $product->get_ID() . '&variation_id=' . $variation['variation_id'] . '&add-to-cart=' . $product->get_ID() ?>" class="gift-card-add-to-cart-btn btn btn-primary ms-2 position-relative" value="<?php echo $product->get_ID() ?>">افزودن به سبد خرید
                                    <span class="position-absolute top-0 start-50 translate-middle badge badge-danger ss02 gift-card-price-badge"><?php echo number_format($variation['display_price']) . ' ' . get_woocommerce_currency_symbol() ?></span>
                                </button>
                                <span class="position-absolute start-50 bottom-0 mb-4 translate-middle ss02 text-white fw-bold fs-4 w-100"><?php echo $title ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (!$variation['is_in_stock']) : ?>
                    <div class="ribbon ribbon-triangle ribbon-bottom-start border-danger">
                        <div class="ribbon-icon mt-0 ms-n6">
                            <i class="las la-highlighter fs-2 text-white"></i>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>
    <?php endforeach ?>
</div>
<div id="select_filter" class="card mb-5 pt-10 pb-5 px-20 <?php if (count($availableVariations) == 0) echo 'd-none';
                                                            else echo 'd-block' ?>">
    <?php foreach ($availableVariations as $variation) : ?>
        <?php $name = wc_get_attribute($variation['id'])->name ?>
        <div class="fv-row mb-5">
            <label class="d-flex align-items-center form-label mb-3 justify-content-center fs-3 text-gray-600"><?php echo $name ?>:</label>
            <div class="row justify-content-center" data-kt-buttons="true">
                <?php foreach ($variation['options'] as $optionId) : ?>
                    <?php $term = get_term($optionId) ?>
                    <div class="col-xl-2 col-md-3 col-6 ss02 mb-3">
                        <label class="btn btn-outline btn-outline-dashed btn-outline-default w-100 p-4">
                            <input type="radio" class="btn-check first-filter-radio" name="<?php echo $variation['name'] ?>" value="<?php echo $term->slug ?>" />
                            <?php if ($term->description) : ?>
                                <img class="rounded h-20px me-2" src="<?php echo $term->description ?>">
                            <?php endif ?>
                            <span class="fw-bolder fs-3"><?php echo $term->name ?></span>
                        </label>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    <?php endforeach ?>
</div>
<div id="no_card_div" class="card d-none d-flex flex-column flex-center pb-7 mb-5">
    <img src="<?php echo get_template_directory_uri() ?>/assets/media/illustrations/sketchy-1/5.png" class="mw-400px">
    <div class="fs-1 fw-bolder text-dark mb-4">گیفت کارتی یافت نشد</div>
    <div class="fs-6">برای فیلترها و متن وارد شده برای جسنجو گیفت کارتی یافت نشده است. لطفا دوباره تلاش کنید.</div>
</div>
<div class="separator mb-5"></div>