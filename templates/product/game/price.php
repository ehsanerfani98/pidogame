<?php
$meta = get_post_meta(get_the_ID(), 'pidogame_framework_products', true);
global $product;
$type = $product->get_type();
?>
<?php switch ($type):
    case 'simple':
        if ($product->is_in_stock()) : ?>
            <div role="button" data-bs-toggle="modal" data-bs-target="#kt_modal_product_buy" class="d-block d-xl-flex border border-gray-300 border-dashed rounded p-6 mb-6 position-relative bg-hover-light-dark border-hover-info">
                <div class="d-flex align-items-center flex-grow-1 me-2 me-sm-5">
                    <a role="button" class="btn btn-sm btn-info me-4">افزودن</a>
                    <div class="me-2">
                        <a class="text-gray-800 fs-6 fw-bold ss02"><?php echo $meta['opt-product-simple-title'] ?></a>
                        <span class="text-muted fw-bold d-block fs-7 ss02"><?php echo $meta['opt-product-simple-subtitle'] ?></span>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-center mt-4 mt-md-2 mt-xl-0">
                    <?php if ($product->is_on_sale()) : ?>
                        <span class="text-muted fw-bold fs-4 me-3 mt-1 ss02 text-decoration-line-through"><?php echo number_format($product->regular_price) ?></span>
                        <span class="text-info fw-boldest fs-2x ss02"><?php echo number_format($product->sale_price) ?></span>
                        <span class="fw-bold fs-2 text-gray-600 me-1 ms-2"><?php echo get_woocommerce_currency_symbol() ?></span>
                        <?php $percentage = intval((($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price()) * 100) ?>
                        <span class="badge badge-lg badge-success align-self-center px-2 ms-3 ss02"><?php echo $percentage ?>% تخفیف</span>
                        <?php $salesPriceTo = get_post_meta($product->id, '_sale_price_dates_to', true);
                        if ($salesPriceTo) :
                            $salesPriceDateTo = date("Y-m-j H:i:s", $salesPriceTo);
                            $now = new DateTime();
                            $futureDate = new DateTime($salesPriceDateTo);
                            $interval = $futureDate->diff($now);
                            $diff = $interval->format("%a روز و %h ساعت و %i دقیقه") ?>
                            <span class="d-block d-xl-none position-absolute top-0 start-50 translate-middle badge badge-danger ss02"><?php echo $diff ?> باقی مانده</span>
                            <span class="d-none d-xl-block position-absolute top-0 start-75 translate-middle-y badge badge-danger ss02"><?php echo $diff ?> باقی مانده</span>
                        <?php endif;
                    else : ?>
                        <span class="text-info fw-boldest fs-2x ss02"><?php echo number_format($product->regular_price) ?></span>
                        <span class="fw-bold fs-2 text-gray-600 me-1 ms-2"><?php echo get_woocommerce_currency_symbol() ?></span>
                    <?php endif ?>
                </div>
            </div>
        <?php else : ?>
            <div class="d-block d-xl-flex border border-gray-300 border-dashed rounded p-6 mb-6 position-relative border-hover-danger">
                <div class="d-flex align-items-center flex-grow-1 me-2 me-sm-5">
                    <span class="svg-icon svg-icon-danger svg-icon-2hx me-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor" />
                            <rect x="9" y="13.0283" width="7.3536" height="1.2256" rx="0.6128" transform="rotate(-45 9 13.0283)" fill="currentColor" />
                            <rect x="9.86664" y="7.93359" width="7.3536" height="1.2256" rx="0.6128" transform="rotate(45 9.86664 7.93359)" fill="currentColor" />
                        </svg>
                    </span>
                    <div class="me-2">
                        <a class="text-gray-800 fs-6 fw-bold ss02"><?php echo $meta['opt-product-simple-title'] ?></a>
                        <span class="text-muted fw-bold d-block fs-7 ss02"><?php echo $meta['opt-product-simple-subtitle'] ?></span>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-center mt-4 mt-md-2 mt-xl-0">
                    <span class="text-danger fw-boldest fs-2x">ناموجود</span>
                </div>
            </div>
        <?php endif;
        break;
    case 'variable': ?>
        <div class="scroll h-250px pe-5">
            <?php $variations = $product->get_available_variations();
            foreach ($variations as $variation) :
                $description = $variation['variation_description'];
                $formattedDescription = strip_tags($description);
                $explode = explode('#', $formattedDescription);
                isset($explode[0]) ? $title = $explode[0] : $title = null;
                isset($explode[1]) ? $subtitle = $explode[1] : $subtitle = null;
                $variationProduct = new WC_Product_Variation($variation['variation_id']);
                $variationData = '';
                foreach ($variation['attributes'] as $key => $value) {
                    $variationData .= 'data-bs-' . $key . '="' . $value . '"';
                }
                if ($variationProduct->is_in_stock()) : ?>
                    <div role="button" data-bs-toggle="modal" data-bs-target="#kt_modal_product_buy" <?php echo $variationData ?> class="d-block d-xl-flex border border-gray-300 border-dashed rounded p-6 mb-6 position-relative bg-hover-light-dark border-hover-info">
                        <div class="d-flex align-items-center flex-grow-1 me-2 me-sm-5">
                            <a role="button" class="btn btn-sm btn-info me-4">افزودن</a>
                            <div class="me-2">
                                <a class="text-gray-800 fs-6 fw-bold ss02"><?php echo $title ?></a>
                                <span class="text-muted fw-bold d-block fs-7 ss02"><?php echo $subtitle ?></span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mt-4 mt-md-2 mt-xl-0">
                            <?php if ($variationProduct->is_on_sale()) : ?>
                                <span class="text-muted fw-bold fs-4 me-3 mt-1 ss02 text-decoration-line-through"><?php echo number_format($variationProduct->regular_price) ?></span>
                                <span class="text-info fw-boldest fs-2x ss02"><?php echo number_format($variationProduct->sale_price) ?></span>
                                <span class="fw-bold fs-2 text-gray-600 me-1 ms-2"><?php echo get_woocommerce_currency_symbol() ?></span>
                                <?php $percentage = intval((($variationProduct->get_regular_price() - $variationProduct->get_sale_price()) / $variationProduct->get_regular_price()) * 100) ?>
                                <span class="badge badge-lg badge-success align-self-center px-2 ms-3 ss02"><?php echo $percentage ?>% تخفیف</span>
                                <?php $salesPriceTo = null;
                                $salesPriceTo = get_post_meta($variationProduct->get_id(), '_sale_price_dates_to', true);
                                if ($salesPriceTo) :
                                    $salesPriceDateTo = date("Y-m-j H:i:s", $salesPriceTo);
                                    $now = new DateTime();
                                    $futureDate = new DateTime($salesPriceDateTo);
                                    $interval = $futureDate->diff($now);
                                    $diff = $interval->format("%a روز و %h ساعت و %i دقیقه") ?>
                                    <span class="d-block d-xl-none position-absolute top-0 start-50 translate-middle badge badge-danger ss02"><?php echo $diff ?> باقی مانده</span>
                                    <span class="d-none d-xl-block position-absolute top-0 start-75 translate-middle-y badge badge-danger ss02"><?php echo $diff ?> باقی مانده</span>
                                <?php endif ?>
                            <?php else : ?>
                                <span class="text-info fw-boldest fs-2x ss02"><?php echo number_format($variationProduct->regular_price) ?></span>
                                <span class="fw-bold fs-2 text-gray-600 me-1 ms-2"><?php echo get_woocommerce_currency_symbol() ?></span>
                            <?php endif ?>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="d-block d-xl-flex border border-gray-300 border-dashed rounded p-6 mb-6 position-relative border-hover-danger">
                        <div class="d-flex align-items-center flex-grow-1 me-2 me-sm-5">
                            <span class="svg-icon svg-icon-danger svg-icon-2hx me-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor" />
                                    <rect x="9" y="13.0283" width="7.3536" height="1.2256" rx="0.6128" transform="rotate(-45 9 13.0283)" fill="currentColor" />
                                    <rect x="9.86664" y="7.93359" width="7.3536" height="1.2256" rx="0.6128" transform="rotate(45 9.86664 7.93359)" fill="currentColor" />
                                </svg>
                            </span>
                            <div class="me-2">
                                <a class="text-gray-800 fs-6 fw-bold ss02"><?php echo $title ?></a>
                                <span class="text-muted fw-bold d-block fs-7 ss02"><?php echo $subtitle ?></span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mt-4 mt-md-2 mt-xl-0">
                            <span class="text-danger fw-boldest fs-2x">ناموجود</span>
                        </div>
                    </div>
                <?php endif ?>
            <?php endforeach ?>
        </div>
<?php break;
endswitch ?>