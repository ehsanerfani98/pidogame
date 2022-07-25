<?php
$meta = get_post_meta(get_the_ID(), 'pidogame_framework_products', true);
global $product;
$type = $product->get_type();
?>
<?php switch ($type):
    case 'simple':
        if ($product->is_in_stock()) : ?>
            <div role="button" data-bs-target="#kt_modal_product_buy" class="d-block d-xl-flex border border-gray-300 border-dashed rounded p-6 mb-6 position-relative bg-hover-light-dark border-hover-primary">
                <!-- <div class="d-flex align-items-center flex-grow-1 me-2 me-sm-5">
                    <a role="button" class="btn btn-sm btn-primary me-4">افزودن</a>
                    <div class="me-2">
                        <a class="text-gray-800 fs-6 fw-bold ss02"><?php echo $meta['opt-product-simple-title'] ?></a>
                        <span class="text-muted fw-bold d-block fs-7 ss02"><?php echo $meta['opt-product-simple-subtitle'] ?></span>
                    </div>
                </div> -->

                <div class="d-flex align-items-center flex-grow-1 me-2 me-sm-5">
                    <form onsubmit="return extra_fields(event)" action="" method="post">
                        <input name="variation-id" type="hidden" value="<?= $variation['variation_id'] ?>">
                        <input name="product-id" type="hidden" value="<?= get_the_ID() ?>">

                        <div class="d-flex flex-column">
                            <?php $plswb_fields = fx_check($variation['variation_id']);
                            if (count($plswb_fields) > 0) :
                            ?>
                                <?php foreach ($plswb_fields as $key => $item) : ?>
                                    <?php switch ($item['type_field']):
                                        case 'email': ?>
                                            <div class="form-group mb-4">
                                                <label for="email_<?= $variation['variation_id'] . $key ?>"><?= $item['title_field'] ?> <?= $item['required_field'] ? '<span style="color:red">(الزامی)</span>' : '' ?></label>
                                                <input data-extra-title="<?= $item['title_field'] ?>" <?= $item['required_field'] ? 'required="required"' : '' ?> class="form-control" type="email" name="ext_email_<?= $variation['variation_id'] . $key ?>" id="ext_email_<?= $variation['variation_id'] . $key ?>">
                                            </div>
                                            <?php
                                            break;
                                            ?>
                                        <?php
                                        case 'text': ?>
                                            <div class="form-group mb-4">
                                                <label for="text_<?= $variation['variation_id'] . $key ?>"><?= $item['title_field'] ?> <?= $item['required_field'] ? '<span style="color:red">(الزامی)</span>' : '' ?></label>
                                                <input data-extra-title="<?= $item['title_field'] ?>" <?= $item['required_field'] ? 'required="required"' : '' ?> class="form-control" type="text" name="ext_text_<?= $variation['variation_id'] . $key ?>" id="ext_text_<?= $variation['variation_id'] . $key ?>">
                                            </div>
                                            <?php
                                            break;
                                            ?>
                                        <?php
                                        case 'password': ?>
                                            <div class="form-group mb-4">
                                                <label for="password_<?= $variation['variation_id'] . $key ?>"><?= $item['title_field'] ?> <?= $item['required_field'] ? '<span style="color:red">(الزامی)</span>' : '' ?></label>
                                                <input data-extra-title="<?= $item['title_field'] ?>" <?= $item['required_field'] ? 'required="required"' : '' ?> class="form-control" type="password" name="ext_password_<?= $variation['variation_id'] . $key ?>" id="ext_password_<?= $variation['variation_id'] . $key ?>">
                                            </div>
                                            <?php
                                            break;
                                            ?>
                                        <?php
                                        case 'number': ?>
                                            <div class="form-group mb-4">
                                                <label class="d-block mb-2" for="number_<?= $variation['variation_id'] . $key ?>"><?= $item['title_field'] ?> <?= $item['required_field'] ? '<span style="color:red">(الزامی)</span>' : '' ?></label>
                                                <!-- <input <?= $item['required_field'] ? 'required="required"' : '' ?> class="form-control" type="number" name="number" id=""> -->
                                                <div class="position-relative w-100px d-inline-block" data-kt-dialer="true" data-kt-dialer-min="1" data-kt-dialer-max="" data-kt-dialer-step="1">
                                                    <button <?= $item['required_field'] ? 'required="required"' : '' ?> type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease"><span class="svg-icon svg-icon-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                                                                <rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="currentColor"></rect>
                                                            </svg></span></button>
                                                    <input data-extra-title="<?= $item['title_field'] ?>" id="ext_number_<?= $variation['variation_id'] . $key ?>" name="ext_number_<?= $variation['variation_id'] . $key ?>" type="text" class="form-control form-control-solid border-0 text-center ss02 w-100px" readonly data-kt-dialer-control="input">
                                                    <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase"><span class="svg-icon svg-icon-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                                                                <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor"></rect>
                                                                <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor"></rect>
                                                            </svg></span></button>

                                                </div>
                                            </div>
                                            <?php
                                            break;
                                            ?>
                                        <?php
                                        case 'checkbox': ?>
                                            <div class="form-group mb-4">
                                                <label for="checkbox_<?= $variation['variation_id'] . $key ?>"><?= $item['title_field'] ?> <?= $item['required_field'] ? '<span style="color:red">(الزامی)</span>' : '' ?></label>
                                                <input data-extra-title="<?= $item['title_field'] ?>" <?= $item['required_field'] ? 'required="required"' : '' ?> class="form-check-input" type="checkbox" name="ext_checkbox_<?= $variation['variation_id'] . $key ?>" id="ext_checkbox_<?= $variation['variation_id'] . $key ?>">
                                            </div>
                                            <?php
                                            break;
                                            ?>
                                        <?php
                                        case 'select': ?>
                                            <div class="form-group mb-4">
                                                <label for="select_<?= $variation['variation_id'] . $key ?>"><?= $item['title_field'] ?> <?= $item['required_field'] ? '<span style="color:red">(الزامی)</span>' : '' ?></label>
                                                <select data-extra-title="<?= $item['title_field'] ?>" <?= $item['required_field'] ? 'required="required"' : '' ?> class="form-select" data-control="select2" data-placeholder="یک گزینه را انتخاب کنید" data-allow-clear="true" name="ext_select_<?= $variation['variation_id'] . $key ?>" id="ext_select_<?= $variation['variation_id'] . $key ?>">
                                                    <option></option>
                                                    <?php
                                                    $values = explode('#', $item['values_select_field']);
                                                    foreach ($values as $item) :
                                                    ?>
                                                        <option value="<?= $item ?>"><?= $item ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <?php
                                            break;
                                            ?>
                                        <?php
                                        case 'textarea': ?>
                                            <div class="form-group mb-4">
                                                <label for="textarea_<?= $variation['variation_id'] . $key ?>"><?= $item['title_field'] ?> <?= $item['required_field'] ? '<span style="color:red">(الزامی)</span>' : '' ?></label>
                                                <textarea data-extra-title="<?= $item['title_field'] ?>" <?= $item['required_field'] ? 'required="required"' : '' ?> name="ext_textarea_<?= $variation['variation_id'] . $key ?>" class="form-control" id="ext_textarea_<?= $variation['variation_id'] . $key ?>" cols="30" rows="5"></textarea>
                                            </div>
                                            <?php
                                            break;
                                            ?>
                                        <?php
                                        default: ?>
                                    <?php
                                            break;
                                    endswitch; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <button type="submit" class="btn btn-primary" id="btn_<?= $variation['variation_id'] ?>">
                                <span class="indicator-label">
                                    افزودن به سبد خرید
                                </span>
                                <span class="indicator-progress">
                                    در حال پردازش ... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>

                <div class="d-flex align-items-center justify-content-center mt-4 mt-md-2 mt-xl-0">
                    <?php if ($product->is_on_sale()) : ?>
                        <span class="text-muted fw-bold fs-4 me-3 mt-1 ss02 text-decoration-line-through"><?php echo number_format($product->regular_price) ?></span>
                        <span class="text-primary fw-boldest fs-4 ss02"><?php echo number_format($product->sale_price) ?></span>
                        <span class="fw-bold fs-4 text-gray-600 me-1 ms-2"><?php echo get_woocommerce_currency_symbol() ?></span>
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
                        <span class="text-primary fw-boldest fs-4 ss02"><?php echo number_format($product->regular_price) ?></span>
                        <span class="fw-bold fs-4 text-gray-600 me-1 ms-2"><?php echo get_woocommerce_currency_symbol() ?></span>
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
                    <span class="text-danger fw-boldest fs-4">ناموجود</span>
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
                    <div role="button" data-bs-target="#kt_modal_product_buy" <?php echo $variationData ?> class="d-block d-xl-flex border border-gray-300 border-dashed rounded p-6 mb-6 position-relative bg-hover-light-dark border-hover-primary">
                        <!-- <div class="d-flex align-items-center flex-grow-1 me-2 me-sm-5">
                            <a role="button" class="btn btn-sm btn-primary me-4">افزودن</a>
                            <div class="me-2">
                                <a class="text-gray-800 fs-6 fw-bold ss02"><?php echo $title ?></a>
                                <span class="text-muted fw-bold d-block fs-7 ss02"><?php echo $subtitle ?></span>
                            </div>
                        </div> -->
                        <div class="d-flex align-items-center flex-grow-1 me-2 me-sm-5">
                    <form onsubmit="return extra_fields(event)" action="" method="post">
                        <input name="variation-id" type="hidden" value="<?= $variation['variation_id'] ?>">
                        <input name="product-id" type="hidden" value="<?= get_the_ID() ?>">

                        <div class="d-flex flex-column">
                            <?php $plswb_fields = fx_check($variation['variation_id']);
                            if (count($plswb_fields) > 0) :
                            ?>
                                <?php foreach ($plswb_fields as $key => $item) : ?>
                                    <?php switch ($item['type_field']):
                                        case 'email': ?>
                                            <div class="form-group mb-4">
                                                <label for="email_<?= $variation['variation_id'] . $key ?>"><?= $item['title_field'] ?> <?= $item['required_field'] ? '<span style="color:red">(الزامی)</span>' : '' ?></label>
                                                <input data-extra-title="<?= $item['title_field'] ?>" <?= $item['required_field'] ? 'required="required"' : '' ?> class="form-control" type="email" name="ext_email_<?= $variation['variation_id'] . $key ?>" id="ext_email_<?= $variation['variation_id'] . $key ?>">
                                            </div>
                                            <?php
                                            break;
                                            ?>
                                        <?php
                                        case 'text': ?>
                                            <div class="form-group mb-4">
                                                <label for="text_<?= $variation['variation_id'] . $key ?>"><?= $item['title_field'] ?> <?= $item['required_field'] ? '<span style="color:red">(الزامی)</span>' : '' ?></label>
                                                <input data-extra-title="<?= $item['title_field'] ?>" <?= $item['required_field'] ? 'required="required"' : '' ?> class="form-control" type="text" name="ext_text_<?= $variation['variation_id'] . $key ?>" id="ext_text_<?= $variation['variation_id'] . $key ?>">
                                            </div>
                                            <?php
                                            break;
                                            ?>
                                        <?php
                                        case 'password': ?>
                                            <div class="form-group mb-4">
                                                <label for="password_<?= $variation['variation_id'] . $key ?>"><?= $item['title_field'] ?> <?= $item['required_field'] ? '<span style="color:red">(الزامی)</span>' : '' ?></label>
                                                <input data-extra-title="<?= $item['title_field'] ?>" <?= $item['required_field'] ? 'required="required"' : '' ?> class="form-control" type="password" name="ext_password_<?= $variation['variation_id'] . $key ?>" id="ext_password_<?= $variation['variation_id'] . $key ?>">
                                            </div>
                                            <?php
                                            break;
                                            ?>
                                        <?php
                                        case 'number': ?>
                                            <div class="form-group mb-4">
                                                <label class="d-block mb-2" for="number_<?= $variation['variation_id'] . $key ?>"><?= $item['title_field'] ?> <?= $item['required_field'] ? '<span style="color:red">(الزامی)</span>' : '' ?></label>
                                                <!-- <input <?= $item['required_field'] ? 'required="required"' : '' ?> class="form-control" type="number" name="number" id=""> -->
                                                <div class="position-relative w-100px d-inline-block" data-kt-dialer="true" data-kt-dialer-min="1" data-kt-dialer-max="" data-kt-dialer-step="1">
                                                    <button <?= $item['required_field'] ? 'required="required"' : '' ?> type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease"><span class="svg-icon svg-icon-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                                                                <rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="currentColor"></rect>
                                                            </svg></span></button>
                                                    <input data-extra-title="<?= $item['title_field'] ?>" id="ext_number_<?= $variation['variation_id'] . $key ?>" name="ext_number_<?= $variation['variation_id'] . $key ?>" type="text" class="form-control form-control-solid border-0 text-center ss02 w-100px" readonly data-kt-dialer-control="input">
                                                    <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase"><span class="svg-icon svg-icon-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                                                                <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor"></rect>
                                                                <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor"></rect>
                                                            </svg></span></button>

                                                </div>
                                            </div>
                                            <?php
                                            break;
                                            ?>
                                        <?php
                                        case 'checkbox': ?>
                                            <div class="form-group mb-4">
                                                <label for="checkbox_<?= $variation['variation_id'] . $key ?>"><?= $item['title_field'] ?> <?= $item['required_field'] ? '<span style="color:red">(الزامی)</span>' : '' ?></label>
                                                <input data-extra-title="<?= $item['title_field'] ?>" <?= $item['required_field'] ? 'required="required"' : '' ?> class="form-check-input" type="checkbox" name="ext_checkbox_<?= $variation['variation_id'] . $key ?>" id="ext_checkbox_<?= $variation['variation_id'] . $key ?>">
                                            </div>
                                            <?php
                                            break;
                                            ?>
                                        <?php
                                        case 'select': ?>
                                            <div class="form-group mb-4">
                                                <label for="select_<?= $variation['variation_id'] . $key ?>"><?= $item['title_field'] ?> <?= $item['required_field'] ? '<span style="color:red">(الزامی)</span>' : '' ?></label>
                                                <select data-extra-title="<?= $item['title_field'] ?>" <?= $item['required_field'] ? 'required="required"' : '' ?> class="form-select" data-control="select2" data-placeholder="یک گزینه را انتخاب کنید" data-allow-clear="true" name="ext_select_<?= $variation['variation_id'] . $key ?>" id="ext_select_<?= $variation['variation_id'] . $key ?>">
                                                    <option></option>
                                                    <?php
                                                    $values = explode('#', $item['values_select_field']);
                                                    foreach ($values as $item) :
                                                    ?>
                                                        <option value="<?= $item ?>"><?= $item ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <?php
                                            break;
                                            ?>
                                        <?php
                                        case 'textarea': ?>
                                            <div class="form-group mb-4">
                                                <label for="textarea_<?= $variation['variation_id'] . $key ?>"><?= $item['title_field'] ?> <?= $item['required_field'] ? '<span style="color:red">(الزامی)</span>' : '' ?></label>
                                                <textarea data-extra-title="<?= $item['title_field'] ?>" <?= $item['required_field'] ? 'required="required"' : '' ?> name="ext_textarea_<?= $variation['variation_id'] . $key ?>" class="form-control" id="ext_textarea_<?= $variation['variation_id'] . $key ?>" cols="30" rows="5"></textarea>
                                            </div>
                                            <?php
                                            break;
                                            ?>
                                        <?php
                                        default: ?>
                                    <?php
                                            break;
                                    endswitch; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <button type="submit" class="btn btn-primary" id="btn_<?= $variation['variation_id'] ?>">
                                <span class="indicator-label">
                                    افزودن به سبد خرید
                                </span>
                                <span class="indicator-progress">
                                    در حال پردازش ... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
                        <div class="d-flex align-items-center justify-content-center mt-4 mt-md-2 mt-xl-0">
                            <?php if ($variationProduct->is_on_sale()) : ?>
                                <span class="text-muted fw-bold fs-4 me-3 mt-1 ss02 text-decoration-line-through"><?php echo number_format($variationProduct->regular_price) ?></span>
                                <span class="text-primary fw-boldest fs-4 ss02"><?php echo number_format($variationProduct->sale_price) ?></span>
                                <span class="fw-bold fs-4 text-gray-600 me-1 ms-2"><?php echo get_woocommerce_currency_symbol() ?></span>
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
                                <span class="text-primary fw-boldest fs-4 ss02"><?php echo number_format($variationProduct->regular_price) ?></span>
                                <span class="fw-bold fs-4 text-gray-600 me-1 ms-2"><?php echo get_woocommerce_currency_symbol() ?></span>
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
                            <span class="text-danger fw-boldest fs-4">ناموجود</span>
                        </div>
                    </div>
                <?php endif ?>
            <?php endforeach ?>
        </div>
<?php break;
endswitch ?>