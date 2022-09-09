<?php


include 'constant.php';
include get_template_directory() . '/inc/match_theme_elementor.php';
include PLSWB_THEME_PATH . '/inc/widgets-elementor/register_widget_elementor.php';
include PLSWB_THEME_PATH . '/inc/widgets-elementor/view-widgets/controller.php';


//نمایش دیتا در سبد خرید
function add_cf_after_cart_item_name($name_html, $cart_item, $cart_item_key)
{
    if (!isset($cart_item['meta_data_cart'])) {
        return $name_html;
    }
    if (!empty($cart_item['meta_data_cart'])) {
        foreach ($cart_item['meta_data_cart'] as $item) {
            if (isset($item['status'])) {
                $val = number_format($item['value']) . ' تومان ';
            } else {
                $val = $item['value'];
            }
            $name_html .=         "<br>" . $item['title'] . ' : ' .  $val;
        }
    }
    return $name_html;
}
add_filter('woocommerce_cart_item_name', 'add_cf_after_cart_item_name', 10, 3);


//اضافه کردن دیتا به سبد خرید
// function kia_add_cart_item_data($cart_item, $product_id)
// {
// 	$cart_item['meta_data_cart'] = [
// 		'name' => 'دستگاه',
// 		'device' => 'پلی استیشن'
// 	];
// 	return $cart_item;
// }
// add_filter('woocommerce_add_cart_item_data', 'kia_add_cart_item_data', 10, 2);


// ذخیره دیتا بعد از پرداخت
add_action('woocommerce_checkout_create_order_line_item', 'save_cart_item_custom_meta_as_order_item_meta', 10, 4);
function save_cart_item_custom_meta_as_order_item_meta($cart_item, $cart_item_key, $values, $order)
{
    if (!isset($values['meta_data_cart'])) {
        return;
    }
    if (!empty($values['meta_data_cart'])) {
        foreach ($values['meta_data_cart'] as $item) {
            if (isset($item['status'])) {
                $val = number_format($item['value']) . ' تومان ';
            } else {
                $val = $item['value'];
            }
            $cart_item->update_meta_data($item['title'], $val);
        }
    }
}

function ti_custom_javascript()
{
    wp_enqueue_script('plswb-js', get_template_directory_uri() . '/assets/js/plswb-js.js', '', '', true);
    wp_enqueue_style('plswb-css', get_template_directory_uri() . '/assets/css/plswb-css.css');
}
add_action('wp_enqueue_scripts', 'ti_custom_javascript',);


add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
function woocommerce_ajax_add_to_cart()
{

    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $variation_id = absint($_POST['variation_id']);
    // This is where you extra meta-data goes in
    $cart_item_data = $_POST['meta'];
    // $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);

    // wp_send_json( [
    // 	'data' => $product_id
    // ] );

    // Remember to add $cart_item_data to WC->cart->add_to_cart
    if (WC()->cart->add_to_cart($product_id, $quantity, $variation_id, array(), $cart_item_data) && 'publish' === $product_status) {

        do_action('woocommerce_ajax_added_to_cart', $product_id);

        if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
            wc_add_to_cart_message(array($product_id => $quantity), true);
        }

        wp_send_json([
            // "data" => WC_AJAX::get_refreshed_fragments(),
            "count" => count(WC()->cart->get_cart())
        ]);
    } else {

        $data = array(
            'error' => true,
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id)
        );

        echo wp_send_json($data);
    }

    wp_die();
}

add_action('wp_ajax_woocommerce_ajax_add_to_cart_free_payment', 'woocommerce_ajax_add_to_cart_free_payment');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart_free_payment', 'woocommerce_ajax_add_to_cart_free_payment');
function woocommerce_ajax_add_to_cart_free_payment()
{

    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    // $variation_id = absint($_POST['variation_id']);
    // This is where you extra meta-data goes in
    $cart_item_data = $_POST['meta'];
    // $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);

    // Remember to add $cart_item_data to WC->cart->add_to_cart
    if (WC()->cart->add_to_cart($product_id, $quantity, '', array(), $cart_item_data) && 'publish' === $product_status) {

        do_action('woocommerce_ajax_added_to_cart', $product_id);

        if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
            wc_add_to_cart_message(array($product_id => $quantity), true);
        }

        wp_send_json([
            // "data" => WC_AJAX::get_refreshed_fragments(),
            "count" => count(WC()->cart->get_cart())
        ]);
    } else {

        $data = array(
            'error' => true,
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id)
        );

        echo wp_send_json($data);
    }

    wp_die();
}

add_action('woocommerce_before_calculate_totals', 'set_cutom_cart_item_price', 20, 1);
function set_cutom_cart_item_price($cart)
{

    if (is_admin() && !defined('DOING_AJAX'))
        return;

    if (did_action('woocommerce_before_calculate_totals') >= 2)
        return;

    $cart_content = $cart->get_cart();



    foreach ($cart_content as $cart_item) {
        // if (!isset($cart_item['meta_data_cart'])) {
        // 	return;
        // }
        // dd($cart_item['meta_data_cart']);

        foreach ($cart_item['meta_data_cart'] as $value) {
            if (isset($value['status'])) {
                $total_price[] = $value['value'];
            }
        }

        $base_price = $cart_item['data']->get_price();
        if (isset($total_price) && !empty($total_price)) {
            $new_total_price = array_sum($total_price) + (int)$base_price;
        } else {
            $new_total_price = $base_price;
        }

        $cart_item['data']->set_price($new_total_price);
        unset($total_price);
    }
}

add_filter('woocommerce_get_price_html', 'custom_price_format', 10, 2);
add_filter('woocommerce_variable_price_html', 'custom_price_format', 10, 2);
function custom_price_format($price, $product)
{

    if ($product->is_type('variable')) {

        $default_attributes = $product->get_default_attributes();
        foreach ($product->get_available_variations() as $variation) {
            $found = true;
            foreach ($variation['attributes'] as $key => $value) {
                $taxonomy = str_replace('attribute_', '', $key);
                if (isset($default_attributes[$taxonomy]) && $default_attributes[$taxonomy] != $value) {
                    $found = false;
                    break;
                }
            }
            if ($found) {
                $default_variaton = $variation;
                break;
            } else {
                continue;
            }
        }
        if ($product->is_on_sale()) {
            $regular_price = $product->get_variation_sale_price('min', true);
            $sale_price = $product->get_variation_sale_price('max', true);
        } else {
            $regular_price = $product->get_variation_regular_price('min', true);
            $sale_price = $product->get_variation_regular_price('max', true);
        }
        $price = '<div class=" fs-5 px-4 py-2">' . wc_price($regular_price) . '</div><div class=" fs-5 px-4 py-2">' . wc_price($sale_price) . '</div>';

        return $price;
    } else {
        $regular_price = $product->get_regular_price();
        $sale_price    = $product->get_sale_price();


        if ($regular_price !== $sale_price && $product->is_on_sale()) {
            $percentage = round(($regular_price - $sale_price) / $regular_price * 100) . '%';
            $percentage_txt = __(' Save', 'woocommerce') . ' ' . $percentage;

            // $price = '<del class="badge badge-danger">' . wc_price($regular_price) . '</del> <ins>' . wc_price($sale_price) . $percentage_txt . '</ins>';
            $price = '<div class=" fs-5 px-4 py-2"><del>' . wc_price($regular_price) . ' </del>  </div><div class="badge badge-success fs-5 px-4 py-2">' . wc_price($sale_price) . '</div>';
        } else {
            if ($sale_price == 0) {
                if ($regular_price == 0) {
                    $price = '<div class=" fs-5 px-4 py-2">' . 'رایگان' . '</div>';
                    return $price;
                }
                $price = '<div class=" fs-5 px-4 py-2">' . wc_price($regular_price) . '</div>';
                return $price;
            }
        }
        $price = '<div class=" fs-5 px-4 py-2">' . wc_price($regular_price) . '</div><div class=" fs-5 px-4 py-2">' . wc_price($sale_price) . '</div>';
        return $price;
    }
}




add_action('init', 'woo_general_init');
function woo_general_init()
{
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
                        if ($product->is_type('variation')) {
                            $all_org_variation_ids[] = $product_id;
                        } else {
                            $variations = new WC_Product_Variable($product_id);
                            foreach ($variations->get_children() as  $v_id) {
                                $all_org_variation_ids[] = $v_id;
                            }
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
                                if ($product->is_type('variation')) {
                                    $inside_variation_ids[] = $inside_product_id;
                                } else {
                                    $inside_variations = new WC_Product_Variable($inside_product_id);
                                    foreach ($inside_variations->get_children() as  $inside_v_id) {
                                        $inside_variation_ids[] = $inside_v_id;
                                    }
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
                                    if ($product->is_type('variation')) {
                                        $not_show_variation_ids[] = $not_show_product_id;
                                    } else {
                                        $not_show_variations = new WC_Product_Variable($not_show_product_id);
                                        foreach ($not_show_variations->get_children() as  $not_show_v_id) {
                                            $not_show_variation_ids[] = $not_show_v_id;
                                        }
                                    }
                                }
                            }
                            $not_show_variation_ids = array_unique($not_show_variation_ids);
                            $display_rules_ids = array_diff($inside_variation_ids, $not_show_variation_ids);
                            unset($not_show_variation_ids);
                        } else {
                            $display_rules_ids = $inside_variation_ids;
                            unset($inside_variation_ids);
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
                                    if ($product->is_type('variation')) {
                                        $not_show_variation_ids[] = $not_show_product_id;
                                    } else {
                                        $not_show_variations = new WC_Product_Variable($not_show_product_id);
                                        foreach ($not_show_variations->get_children() as  $not_show_v_id) {
                                            $not_show_variation_ids[] = $not_show_v_id;
                                        }
                                    }
                                }
                            }
                            $not_show_variation_ids = array_unique($not_show_variation_ids);
                            $display_rules_ids = array_diff($all_org_variation_ids, $not_show_variation_ids);
                            unset($not_show_variation_ids);

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
}

function admin_enqueue($hook)
{
    if ($hook == 'post-new.php') {
        wp_enqueue_style('plswb-css-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', false, '1.0.0');
        wp_enqueue_style('plswb-css-select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css', false, '1.0.0');
        wp_enqueue_script('plswb-js-select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array("jquery"), "1.0.0", true);
        wp_enqueue_style('plswb-css-reapeter', get_template_directory_uri() . '/assets/css/jq.multiinput.min.css', false, '1.0.0');
        wp_enqueue_script('plswb-js-reapeter', get_template_directory_uri() . '/assets/js/jq.multiinput.js', array("jquery"), "1.0.0", true);
    } elseif ($hook == 'post.php') {
        $post_type = get_post_type($_GET['post']);
        if ($post_type == 'extra_fields_plswb') {
            wp_enqueue_style('plswb-css-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', false, '1.0.0');
            wp_enqueue_style('plswb-css-select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css', false, '1.0.0');
            wp_enqueue_script('plswb-js-select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array("jquery"), "1.0.0", true);
            wp_enqueue_style('plswb-css-reapeter', get_template_directory_uri() . '/assets/css/jq.multiinput.min.css', false, '1.0.0');
            wp_enqueue_script('plswb-js-reapeter', get_template_directory_uri() . '/assets/js/jq.multiinput.js', array("jquery"), "1.0.0", true);
        }
    }
}

add_action('admin_enqueue_scripts', 'admin_enqueue');

/*************************************/

add_action('add_meta_boxes', 'extra_fields_add_meta_boxes', 10, 2);
function extra_fields_add_meta_boxes()
{
    add_meta_box('plswb_extra_options', 'فیلدهای اضافه', 'view_plswb_extra_options', 'extra_fields_plswb', 'normal');
}


function view_plswb_extra_options()
{
?>

    <div id="wrap-fields" style="display: none;">
        <div class="col-lg-12 wrap-section-fields drag-card">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row px-3">
                        <div class="col-6">
                            <button onclick="remove_filed(this)" type="button" class="btn btn-danger btn-sm">حذف فیلد</button>
                        </div>
                        <div class="col-6" style="text-align: left;">
                            <button onclick="close_filed(this)" type="button" class="btn btn-primary btn-sm">بستن فیلد</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="plswb-card">
                        <div class="plswb-card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="ext_title">عنوان فیلد <span style="color: red;"> (الزامی) </span></label>
                                        <input oninvalid="this.setCustomValidity('عنوان فیلد را وارد کنید.')" oninput="this.setCustomValidity('')" type="text" name="" id="ext_title" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="ext_help">متن راهنما</label>
                                        <input type="text" name="" id="ext_help" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <input class="form-check-input" type="checkbox" value="true" name="" id="ext_required">
                                        <label class="form-check-label" for="ext_required">
                                            الزامی
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 close-wrap">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="plswb-card">
                                <div class="plswb-card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="ext_type">نوع فیلد <span style="color: red;"> (الزامی) </span></label>
                                                <select oninvalid="this.setCustomValidity('نوع فیلد را انتخاب کنید.')" oninput="this.setCustomValidity('')" class="form-control" name="" id="ext_type">
                                                    <option value="">نوع فیلد را انتخاب کنید</option>
                                                    <option value="text">متنی</option>
                                                    <option value="email">ایمیل</option>
                                                    <option value="password">رمز عبور</option>
                                                    <option value="number">تعدادی</option>
                                                    <option value="number_char">عدد</option>
                                                    <option value="textarea">توضیحات متنی</option>
                                                    <option value="checkbox">تیک زدنی</option>
                                                    <option value="select">انتخابی</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="ext_price">قیمت</label>
                                                <input type="text" name="" id="ext_price" class="form-control">
                                                <div class="form-text">چنانچه مقدار این فیلد به قیمت محصول اضافه می شود ، یک مبلغ برای آن وارد کنید.</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="ext_value_select">مقدار فیلد انتخابی</label>
                                                <input type="text" name="" id="ext_value_select" class="form-control">
                                                <div class="form-text">چنانچه نوع فیلد را از نوع انتخابی انتخاب کرده اید ، مقدار هر گزینه رو با # جدا کنید.
                                                    مثال : گوگل#فیسبوک#اینستاگرام</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="plswb-card">
                                <div class="plswb-card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="">عدم نمایش</label>
                                                <div class="col-lg-12">

                                                    <select class="org_products_not_show_rules new_select form-control" name="" id="not_show_products_rules" multiple="multiple">

                                                    </select>
                                                </div>
                                                <div class="form-text">محصولات یا متغیرهایی را که قصد دارید این فیلد در آن ها نمایش داده نشود انتخاب کنید.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="plswb-card">
                                <div class="plswb-card-body">
                                    <fieldset>
                                        <legend>
                                            <h6>قوانین نمایش</h6>
                                        </legend>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <div class="">
                                                        <input class="form-check-input" type="checkbox" value="" name="" id="ext_disable_org_show_products_rules">
                                                        <label class="form-check-label" for="ext_disable_org_show_products_rules">
                                                            غیر فعال کردن محصولات شامل کلی
                                                        </label>
                                                        <div class="form-text">اگر می خواهید محصولات انتخابی در بخش "محصولات شامل کلی" به این فیلد اعمال نشود ، این گزینه رو انتخاب کنید.
                                                            توجه : در صورت انتخاب این گزینه باید حتما از "محصولات شامل درون فیلدی" استفاده نمایید.</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="">محصولات شامل درون فیلدی</label>
                                                    <div class="col-lg-12">

                                                        <select class="org_products_not_show_rules new_select form-control" name="" id="inside_show_products_rules" multiple="multiple">

                                                        </select>
                                                    </div>
                                                    <div class="form-text">محصولات یا متغیرهایی را که قصد دارید این فیلد در آن ها نمایش داده نشود انتخاب کنید.</div>
                                                </div>
                                            </div>

                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-12">
            <div class="plswb-card">
                <div class="plswb-card-body">
                    <label for="">محصولات شامل کلی</label>
                    <select class="org_products_show_rules products_rules form-control" name="org_products_show_rules[]" multiple="multiple">


                        <?php foreach (get_post_meta(get_the_ID(), 'all_products_show_rules', true) as $pid) :
                            $product = wc_get_product($pid);
                            if ($product->is_type('variation')) :
                                $variation = new WC_Product_Variation($pid);
                        ?>
                                <option selected value="<?= $pid ?>"><?= $variation->get_formatted_name() . ' | ' . $pid ?></option>
                            <?php else : ?>
                                <option selected value="<?= $pid ?>"><?= $product->get_title() . ' | ' . $pid ?></option>
                        <?php
                            endif;
                        endforeach; ?>

                    </select>
                </div>
            </div>
        </div>

        <div id="wrap-rules" class="col-lg-12 pt-2 px-4">
            <button id="btn-new-field" type="button" class="btn btn-success btn-sm">فیلد جدید</button>
        </div>

        <div class="row" id="plswb_sortable">

            <?php foreach (get_post_meta(get_the_ID(), 'plswb_fields', true) as $key => $item) : ?>
                <div class="col-lg-12 wrap-section-fields  drag-card">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row px-3">
                                <div class="col-6">
                                    <button onclick="remove_filed(this)" type="button" class="btn btn-danger btn-sm">حذف فیلد</button>
                                </div>
                                <div class="col-6" style="text-align: left;">
                                    <button onclick="close_filed(this)" type="button" class="btn btn-primary btn-sm">بستن فیلد</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="plswb-card">
                                <div class="plswb-card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="ext_title">عنوان فیلد <span style="color: red;"> (الزامی) </span></label>
                                                <input required oninvalid="this.setCustomValidity('عنوان فیلد را وارد کنید.')" oninput="this.setCustomValidity('')" type="text" name="<?= 'ext_options[data]' . '[' . $key . '][title]' ?>" value="<?= $item['title'] ?>" id="ext_title" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="ext_help">متن راهنما</label>
                                                <input type="text" name="<?= 'ext_options[data]' . '[' . $key . '][help]' ?>" value="<?= $item['help'] ?>" id="ext_help" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <input class="form-check-input" type="checkbox" value="true" name="<?= 'ext_options[data]' . '[' . $key . '][required]' ?>" <?= $item['required'] ? 'checked' : '' ?> id="ext_required">
                                                <label class="form-check-label" for="ext_required">
                                                    الزامی
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 close-wrap">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="plswb-card">
                                        <div class="plswb-card-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="ext_type">نوع فیلد <span style="color: red;"> (الزامی) </span></label>
                                                        <select required oninvalid="this.setCustomValidity('نوع فیلد را انتخاب کنید.')" oninput="this.setCustomValidity('')" class="form-control" name="<?= 'ext_options[data]' . '[' . $key . '][type]' ?>" id="ext_type">
                                                            <option <?= $item['type'] == 'text' ? 'selected' : '' ?> value="text">متنی</option>
                                                            <option <?= $item['type'] == 'email' ? 'selected' : '' ?> value="email">ایمیل</option>
                                                            <option <?= $item['type'] == 'password' ? 'selected' : '' ?> value="password">رمز عبور</option>
                                                            <option <?= $item['type'] == 'number' ? 'selected' : '' ?> value="number">تعدادی</option>
                                                            <option <?= $item['type'] == 'number_char' ? 'selected' : '' ?> value="number_char">عدد</option>
                                                            <option <?= $item['type'] == 'textarea' ? 'selected' : '' ?> value="textarea">توضیحات متنی</option>
                                                            <option <?= $item['type'] == 'checkbox' ? 'selected' : '' ?> value="checkbox">تیک زدنی</option>
                                                            <option <?= $item['type'] == 'select' ? 'selected' : '' ?> value="select">انتخابی</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="ext_price">قیمت</label>
                                                        <input type="text" name="<?= 'ext_options[data]' . '[' . $key . '][price]' ?>" value="<?= $item['price'] ?>" id="ext_price" class="form-control">
                                                        <div class="form-text">چنانچه مقدار این فیلد به قیمت محصول اضافه می شود ، یک مبلغ برای آن وارد کنید.</div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="ext_value_select">مقدار فیلد انتخابی</label>
                                                        <input type="text" name="<?= 'ext_options[data]' . '[' . $key . '][value_select]' ?>" value="<?= $item['value_select'] ?>" id="ext_value_select" class="form-control">
                                                        <div class="form-text">چنانچه نوع فیلد را از نوع انتخابی انتخاب کرده اید ، مقدار هر گزینه رو با # جدا کنید.
                                                            مثال : گوگل#فیسبوک#اینستاگرام</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="plswb-card">
                                        <div class="plswb-card-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="">عدم نمایش</label>
                                                        <div class="col-lg-12">

                                                            <select class="org_products_not_show_rules products_rules_db form-control" name="<?= 'ext_options[data]' . '[' . $key . '][not_show_products_rules][]' ?>" id="not_show_products_rules" multiple="multiple">
                                                                <?php foreach ($item['not_show_products_rules'] as $pid) :
                                                                    $product = wc_get_product($pid);
                                                                    if ($product->is_type('variation')) :
                                                                        $variation = new WC_Product_Variation($pid);
                                                                ?>
                                                                        <option selected value="<?= $pid ?>"><?= $variation->get_formatted_name() . ' | ' . $pid ?></option>
                                                                    <?php else : ?>
                                                                        <option selected value="<?= $pid ?>"><?= $product->get_title() . ' | ' . $pid ?></option>
                                                                <?php
                                                                    endif;
                                                                endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-text">محصولات یا متغیرهایی را که قصد دارید این فیلد در آن ها نمایش داده نشود انتخاب کنید.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="plswb-card">
                                        <div class="plswb-card-body">
                                            <fieldset>
                                                <legend>
                                                    <h6>قوانین نمایش</h6>
                                                </legend>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <div class="">
                                                                <input class="form-check-input" type="checkbox" <?= $item['disable_org_show_products_rules'] ? 'checked' : '' ?> name="<?= 'ext_options[data]' . '[' . $key . '][disable_org_show_products_rules]' ?>" id="ext_disable_org_show_products_rules">
                                                                <label class="form-check-label" for="ext_disable_org_show_products_rules">
                                                                    غیر فعال کردن محصولات شامل کلی
                                                                </label>
                                                                <div class="form-text">اگر می خواهید محصولات انتخابی در بخش "محصولات شامل کلی" به این فیلد اعمال نشود ، این گزینه رو انتخاب کنید.
                                                                    توجه : در صورت انتخاب این گزینه باید حتما از "محصولات شامل درون فیلدی" استفاده نمایید.</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="">محصولات شامل درون فیلدی</label>
                                                            <div class="col-lg-12">
                                                                <select class="org_products_not_show_rules products_rules_db form-control" name="<?= 'ext_options[data]' . '[' . $key . '][inside_show_products_rules][]' ?>" id="inside_show_products_rules" multiple="multiple">
                                                                    <?php foreach ($item['inside_show_products_rules'] as $pid) :
                                                                        $product = wc_get_product($pid);
                                                                        if ($product->is_type('variation')) :
                                                                            $variation = new WC_Product_Variation($pid);
                                                                    ?>
                                                                            <option selected value="<?= $pid ?>"><?= $variation->get_formatted_name() . ' | ' . $pid ?></option>
                                                                        <?php else : ?>
                                                                            <option selected value="<?= $pid ?>"><?= $product->get_title() . ' | ' . $pid ?></option>
                                                                    <?php
                                                                        endif;
                                                                    endforeach; ?>

                                                                </select>
                                                            </div>
                                                            <div class="form-text">محصولات یا متغیرهایی را که قصد دارید این فیلد در آن ها نمایش داده نشود انتخاب کنید.</div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>





    </div>




    <?php
}



add_action('wp_ajax_get_products_plswb', 'get_products');
add_action('wp_ajax_get_nopriv_products_plswb', 'get_products');
add_action('wp_ajax_get_products_org_plswb', 'get_products_org');
add_action('wp_ajax_get_nopriv_products_org_plswb', 'get_products_org');

function get_products_org()
{

    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => -1,
    );
    $loop = new WP_Query($args);
    while ($loop->have_posts()) {
        $loop->the_post();

        $products[] = ["id" => get_the_ID(), "text" => get_the_title() . " | " . get_the_ID()];
    }
    wp_reset_postdata();


    $data_products = $products;

    if (isset($_POST['search']) && !empty($_POST['search'])) {

        $input = preg_quote($_POST['search'], '~');

        foreach ($products as  $value) {
            if (preg_grep('~' . $input . '~', $value)) {
                $products_new[] = $value;
            }
        }

        $data_products = $products_new;
    }

    $product['results'] = [
        [
            "text" => "محصولات",
            "children" => $data_products
        ],
    ];

    wp_send_json([
        'items' => $product
    ]);
}

function get_products()
{
    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => -1,
    );
    $loop = new WP_Query($args);
    while ($loop->have_posts()) {
        $loop->the_post();

        $products[] = ["id" => get_the_ID(), "text" => get_the_title() . " | " . get_the_ID()];

        $variations = new WC_Product_Variable(get_the_ID());
        foreach ($variations->get_children() as  $variation_id) {
            $variation = new WC_Product_Variation($variation_id);
            $variations_products[] = ["id" => $variation_id, "text" => strip_tags($variation->get_formatted_name()) . " | " . $variation_id];
        }
    }
    wp_reset_postdata();

    $data_products = $products;
    $data_variations_products = $variations_products;


    if (isset($_POST['search']) && !empty($_POST['search'])) {

        $input = preg_quote($_POST['search'], '~');

        foreach ($products as  $value) {
            if (preg_grep('~' . $input . '~', $value)) {
                $products_new[] = $value;
            }
        }
        foreach ($variations_products as  $value) {
            if (preg_grep('~' . $input . '~', $value)) {
                $variations_products_new[] = $value;
            }
        }

        $data_products = $products_new;
        $data_variations_products = $variations_products_new;
    }


    $product['results'] = [
        [
            "text" => "محصولات",
            "children" => $data_products
        ],
        [
            "text" => "متغیرها",
            "children" => $data_variations_products
        ]
    ];

    wp_send_json([
        'items' => $product
    ]);
}

add_action('save_post_extra_fields_plswb', function ($post_id) {

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (empty($_POST['org_products_show_rules']) && empty($_POST['ext_options']['data'])) {
        return;
    }

    $org_products_show_rules = $_POST['org_products_show_rules'];
    $extra_fields = $_POST['ext_options']['data'];

    update_post_meta($post_id, 'all_products_show_rules', $org_products_show_rules);
    update_post_meta($post_id, 'plswb_fields', $extra_fields);
});


function filter_woocommerce_account_orders_columns($columns)
{
    echo '<pre>', print_r($columns, 1), '</pre>';

    $columns['order-number'] = __('شماره سفارش', 'woocommerce');
    $columns['order-date'] = __('تاریخ', 'woocommerce');
    $columns['order-status'] = __('وضعیت', 'woocommerce');
    $columns['order-total'] = __('مجموع', 'woocommerce');
    $columns['order-actions'] = __('عملیات ها', 'woocommerce');

    return $columns;
}
add_filter('woocommerce_account_orders_columns', 'filter_woocommerce_account_orders_columns', 10, 1);


add_action('woocommerce_archive_description', 'custom_archive_description', 2);

function custom_archive_description()
{
    remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
    add_action('woocommerce_after_main_content', 'woocommerce_taxonomy_archive_description', 5);
}


add_action('wp_ajax_set_like_comment_product', 'set_like_comment_product');
add_action('wp_ajax_nopriv_set_like_comment_product', 'set_like_comment_product');
function set_like_comment_product()
{


    if (!isset($_COOKIE[$_POST['comment_id']])) {
        setcookie(
            $_POST['comment_id'],
            "isset",
            time() + (10 * 365 * 24 * 60 * 60),
            '/',
            $_SERVER['HTTP_HOST']
        );
        if (!empty(get_comment_meta($_POST['comment_id'], 'total_like', true))) {
            $total_like = (int)get_comment_meta($_POST['comment_id'], 'total_like', true) + 1;
        } else {
            $total_like = 1;
        }
        update_comment_meta($_POST['comment_id'], 'total_like', $total_like);
        wp_send_json([
            "total" => get_comment_meta($_POST['comment_id'], 'total_like', true),
            "status" => "set"
        ]);
    } else {
        $total_like = (int)get_comment_meta($_POST['comment_id'], 'total_like', true) - 1;
        update_comment_meta($_POST['comment_id'], 'total_like', $total_like);
        unset($_COOKIE[$_POST['comment_id']]);
        setcookie(
            $_POST['comment_id'],
            null,
            -1,
            '/',
            $_SERVER['HTTP_HOST']
        );
        wp_send_json([
            "total" => get_comment_meta($_POST['comment_id'], 'total_like', true),
            "status" => "unset"
        ]);
    }
}



add_action('wp_ajax_search_data_product', 'search_data_product');
add_action('wp_ajax_nopriv_search_data_product', 'search_data_product');
function search_data_product()
{
    $options = get_option('pidogame_framework')['search-product-likes_fields'];

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'post_status'   => 'publish',
        'orderby' => 'title',
        'order' => 'DESC',
        'search_prod_title' => $_POST['keyword'],
    );
    add_filter('posts_where', 'title_filter', 10, 2);
    $the_query = new WP_Query($args);
    remove_filter('posts_where', 'title_filter', 10, 2);
    $i = 0;
    if ($the_query->have_posts()) :
        while ($the_query->have_posts()) : $the_query->the_post();
            if ($i < 5) :
    ?>
                <a href="<?php echo esc_url(post_permalink()); ?>" class="d-flex text-dark text-hover-primary align-items-center mb-5">
                    <div class="symbol symbol-40px me-4">
                        <?php the_post_thumbnail() ?>
                    </div>
                    <div class="d-flex flex-column justify-content-start fw-bold">
                        <span class="fs-6 fw-bold"><?php the_title(); ?></span>
                    </div>
                </a>
            <?php
            endif;
            $i++;
        endwhile;

        if ($i > 5) :
            ?>
            <div class="text-center">
                <a href="<?= home_url('shop/?s=') . $_POST['keyword'] ?>" class="text-primary mb-5">نتایج بیشتر</a>
            </div>
            <div class="separator separator-solid my-5"></div>
        <?php
        endif;
        wp_reset_postdata();
    endif;
    if (!empty($options)) :
        ?>
        <h3 class="fs-5 text-muted m-0 pb-5" data-kt-search-element="category-title">محصولات پیشنهادی پیدوگیم</h3>
        <?php
        foreach ($options as $item) :
        ?>
            <a href="<?= $item['ls_link']['url'] ?>" target="<?= $item['ls_link']['target'] ?>" class="d-flex text-dark text-hover-primary align-items-center mb-5">
                <div class="symbol symbol-40px me-4">
                    <img src="<?= $item['ls_image'] ?>" alt="">
                </div>
                <div class="d-flex flex-column justify-content-start fw-bold">
                    <span class="fs-6 fw-bold"><?= $item['ls_title'] ?></span>
                </div>
            </a>
    <?php
        endforeach;
    endif;
    die();
}


function title_filter($where, &$wp_query)
{
    global $wpdb;
    if ($search_term = $wp_query->get('search_prod_title')) {
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql(like_escape($search_term)) . '%\'';
    }
    return $where;
}


add_filter("the_content", "plugin_myContentFilter");
function plugin_myContentFilter($content)
{
    if (!is_singular()) {
        $content = strip_tags(wp_trim_words($content, 20, '...'));
    }
    return $content;
}

add_filter("the_title", "plugin_myTitleFilter");
function plugin_myTitleFilter($title)
{
    if (!is_singular()) {
        $title = strip_tags(wp_trim_words($title, 6, '...'));
    }
    return $title;
}




register_nav_menu('main-menu', __('منوی کناری'));
register_nav_menu('setting-menu', __('دسترسی سریع'));



function get_all_order()
{
    $customer = wp_get_current_user();
    $customer_orders = get_posts(array(
        'numberposts' => -1,
        'meta_key' => '_customer_user',
        'orderby' => 'date',
        'order' => 'DESC',
        'meta_value' => get_current_user_id(),
        'post_type' => wc_get_order_types(),
        'post_status' => array_keys(wc_get_order_statuses()),
        // 'post_status' => array('wc-processing'),
    ));

    $Order_Array = []; //
    foreach ($customer_orders as $customer_order) {
        $orderq = wc_get_order($customer_order);
        $Order_Array[] = $orderq->get_id();
    }

    return $Order_Array;
}


add_shortcode('order_note_customer', 'view_order_note_customer');
function view_order_note_customer()
{
    foreach (get_all_order() as $order_id) {
        $customer_notes = wc_get_order_notes([
            'order_id' => $order_id,
            'type' => 'customer',
        ]);
        if ($customer_notes) {
            $notes[$order_id] = $customer_notes;
        }
    }


    $i = 0;
    foreach ($notes as $key => $values) {
        foreach ($values as $item) {
            $new_notes[] = [
                "id" => $item->id,
                "date" => ((array)$item->date_created)['date'],
                "content" => " سفارش $key | " . $item->content
            ];
        }
    }

    usort($new_notes, function ($v1, $v2) {
        return $v2['id'] <=> $v1['id'];
    });

    ?>
    <table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
        <thead>
            <tr>
                <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-number"><span class="nobr">شناسه اعلان</span></th>
                <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-status"><span class="nobr">متن اعلان</span></th>
                <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-date"><span class="nobr">تاریخ</span></th>
            </tr>
        </thead>

        <tbody>

            <?php foreach ($new_notes as $note) : ?>
                <?php if ($i < 20) : ?>
                    <tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-on-hold order">
                        <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-number" data-title="شماره سفارش">
                            <?= $note['id'] ?>

                        </td>
                        <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-status" data-title="وضعیت">
                            <?= $note['content'] ?>
                        </td>
                        <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-date" data-title="تاریخ">
                            <time datetime="2022-08-13T18:55:39+00:00"><?= plswb_get_date($note['date']) ?></time>

                        </td>

                    </tr>
                <?php endif; ?>
                <?php $i++; ?>
            <?php endforeach; ?>

        </tbody>
    </table>
<?php
}


function plswb_get_date($date)
{
    date_default_timezone_set('Asia/Tehran');
    return wp_date('Y/m/d - H:i', strtotime($date));
}



add_shortcode('plswb-check-order', 'plswb_check_order');
function plswb_check_order()
{
?>
    <style>
        .card .card-header {
            justify-content: center !important;
        }

        .pointer {
            cursor: pointer;
        }
    </style>
    <div class="card">
        <div class="card-header card-header-stretch">
            <div class="card-toolbar">
                <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
                    <li class="nav-item">
                        <a class="nav-link <?= (!isset($_GET['ch1']) && !isset($_GET['ch2'])) ? 'active' : '' ?> pointer">
                            <h3>مشخصات کاربری</h3>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= isset($_GET['ch1']) ? 'active' : '' ?> pointer">
                            <h3>شماره سفارش</h3>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= isset($_GET['ch2']) ? 'active' : '' ?> pointer">
                            <h3>مشاهده وضعیت</h3>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body">

            <div style="display: none;" id="alert-wrap">
                <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                    <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="black"></path>
                            <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="black"></path>
                        </svg>
                    </span>
                    <div class="d-flex flex-column">
                        <h4 class="mb-1 text-danger">خطا!</h4>
                        <span id="alert-message"></span>
                    </div>
                </div>
            </div>

            <form action="" method="post">
                <div class="tab-content">
                    <?php if (!isset($_GET['ch1']) && !isset($_GET['ch2'])) : ?>
                        <div class="tab-pane show <?= (!isset($_GET['ch1']) && !isset($_GET['ch2'])) ? 'active' : '' ?>" id="kt_tab_pane_4" role="tabpanel">
                            <div class="row text-center">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4">
                                    <div class="mb-5">
                                        <label for="ch_email">آدرس ایمیل حساب کاربری خود در پیدوگیم را وارد نمایید.</label>
                                        <input name="ch_email" id="ch_email" type="email" class="form-control form-control-solid" value="<?= @$_SESSION['email'] ?>" />
                                    </div>
                                </div>
                                <div class="col-lg-4"></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12" style="text-align: left;">
                                    <button data-url="<?= get_permalink() . '?ch1' ?>" type="button" class="btn btn-primary" id="check_email">
                                        <span class="indicator-label">
                                            ادامه
                                        </span>
                                        <span class="indicator-progress">
                                            لطفا صبر کنید<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_GET['ch1'])) : ?>
                        <div class="tab-pane show <?= isset($_GET['ch1']) ? 'active' : '' ?>" id="kt_tab_pane_4" role="tabpanel">
                            <div class="row text-center">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4">
                                    <div class="mb-5">
                                        <label for="ch_order_id">شماره سفارش خود را جهت پیگیری وارد نمایید.</label>
                                        <input name="ch_order_id" id="ch_order_id" type="number" class="form-control form-control-solid" value="<?= @$_SESSION['order_id'] ?>" />
                                    </div>
                                </div>
                                <div class="col-lg-4"></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="d-flex align-items-center justify-content-end">
                                        <a href="<?= get_permalink() ?>" class="btn btn-danger" style="margin-left: 1rem;">بازگشت</a>
                                        <button data-url="<?= get_permalink() . '?ch2' ?>" type="button" class="btn btn-primary" id="check_order">
                                            <span class="indicator-label">
                                                ادامه
                                            </span>
                                            <span class="indicator-progress">
                                                لطفا صبر کنید<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_GET['ch2'])) : ?>
                        <div class="tab-pane show <?= isset($_GET['ch2'])  ? 'active' : '' ?>" id="kt_tab_pane_4" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-6 text-center">
                                    <div class="row">
                                        <style>
                                            .badge-me {
                                                padding: .8rem;
                                                font-size: 14px;
                                            }
                                        </style>
                                        <div class="col-lg-12">
                                            <?php if (isset($_SESSION['order_info'])) :

                                                $order = $_SESSION['order_info'];

                                                $customer_notes = wc_get_order_notes([
                                                    'order_id' => $order['id'],
                                                    'type' => 'internal',
                                                ]);

                                                foreach ($customer_notes as $value) {
                                                    $status = explode('به', $value->content);
                                                    $status = explode('تغییر', $status[1]);

                                                    switch (trim($status[0])) {
                                                        case 'در انتظار بررسی':
                                                            $ms = 'on-hold';
                                                            break;
                                                        case 'لغو شده':
                                                            $ms = 'cancelled';
                                                            break;
                                                        case 'در حال انجام':
                                                            $ms = 'processing';
                                                            break;
                                                        case 'تکمیل شد':
                                                            $ms = 'completed';
                                                            break;
                                                        case 'در انتظار پرداخت':
                                                            $ms = 'pending';
                                                            break;
                                                        case 'ناموفق':
                                                            $ms = 'failed';
                                                            break;
                                                        case 'مسترد شده':
                                                            $ms = 'refunded';
                                                            break;
                                                        default:
                                                            $ms = "";
                                                            break;
                                                    }

                                                    $data_status[] = ["date" => ((array)$value->date_created)['date'], "status" => $ms];
                                                }

                                                switch ($order['status']) {
                                                    case 'on-hold':
                                                        $ms = '<span class="badge badge-me badge-warning">در انتظار بررسی</span>';
                                                        break;
                                                    case 'cancelled':
                                                        $ms = '<span class="badge badge-me badge-danger">لغو شده</span>';
                                                        break;
                                                    case 'processing':
                                                        $ms = '<span class="badge badge-me badge-primary">در حال انجام</span>';
                                                        break;
                                                    case 'completed':
                                                        $ms = '<span class="badge badge-me badge-success">تکمیل شد</span>';
                                                        break;
                                                    case 'pending':
                                                        $ms = '<span class="badge badge-me badge-warning">در انتظار پرداخت</span>';
                                                        break;
                                                    case 'failed':
                                                        $ms = '<span class="badge badge-me badge-danger">ناموفق</span>';
                                                        break;
                                                    case 'refunded':
                                                        $ms = '<span class="badge badge-me badge-danger">مسترد شده</span>';
                                                        break;
                                                    default:
                                                        $ms = "";
                                                        break;
                                                }
                                            ?>
                                                <div class="card shadow my-5">

                                                    <div class="card-body">
                                                        <h4>سفارش <span class="badge badge-me badge-secondary"><?= $order['id']; ?></span> هم اکنون در وضعیت <?= $ms ?> می باشد.</h4>
                                                        <hr>
                                                        <div class="row" style="margin-top: 2rem;margin-bottom: 1rem;">
                                                            <div class="col-lg-12">
                                                                <h3>جزئیات سفارش :</h3>
                                                            </div>
                                                        </div>
                                                        <?php foreach ($data_status as $item) : ?>
                                                            <?php if (!empty($item['status'])) :

                                                                switch ($item['status']) {
                                                                    case 'on-hold':
                                                                        $ms = 'در انتظار بررسی';
                                                                        break;
                                                                    case 'cancelled':
                                                                        $ms = 'لغو شده';
                                                                        break;
                                                                    case 'processing':
                                                                        $ms = 'در حال انجام';
                                                                        break;
                                                                    case 'completed':
                                                                        $ms = 'تکمیل شد';
                                                                        break;
                                                                    case 'pending':
                                                                        $ms = 'در انتظار پرداخت';
                                                                        break;
                                                                    case 'failed':
                                                                        $ms = 'ناموفق';
                                                                        break;
                                                                    case 'refunded':
                                                                        $ms = 'مسترد شده';
                                                                        break;
                                                                    default:
                                                                        break;
                                                                }

                                                            ?>
                                                                <div class="row mb-5">
                                                                    <div class="col-lg-6">
                                                                        <div>
                                                                            <h6>تاریخ :</h6>
                                                                            <div><?= plswb_get_date($item['date']) ?></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <h6>وضعیت :</h6>
                                                                        <div><?= $ms ?></div>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>

                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3"></div>

                            </div>

                            <div class="row mt-4">
                                <div class="col-lg-12 ">
                                    <div class="d-flex align-items-center justify-content-end">
                                        <a href="<?= get_permalink() . '?ch1' ?>" class="btn btn-danger" style="margin-left: 1rem;">بازگشت</a>
                                        <a target="_blank" href="<?= home_url('my-account/view-order/' . $order['id']) ?>" class="btn btn-primary">مشاهده سفارش</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php endif; ?>

                </div>
            </form>
        </div>
    </div>

<?php
}



add_action('wp_ajax_check_email_order', 'check_email_order');
add_action('wp_ajax_nopriv_check_email_order', 'check_email_order');
function check_email_order()
{
    if (!email_exists($_POST['email'])) {
        wp_send_json([
            "status" => 'invalid email',
            "message" => 'ایمیل معتبر نمی باشد!'
        ]);
    } else {
        $_SESSION['email'] = $_POST['email'];
        wp_send_json([
            "status" => 'valid email',
        ]);
    }
}
add_action('wp_ajax_check_id_order', 'check_id_order');
add_action('wp_ajax_nopriv_check_id_order', 'check_id_order');
function check_id_order()
{
    $order = wc_get_order($_POST['order_id']);


    if (!$order) {
        wp_send_json([
            "status" => 'invalid order',
            "message" => 'سفارشی با این شماره موجود نمی باشد!'
        ]);
    } else {
        $_SESSION['order_id'] = $_POST['order_id'];
        $_SESSION['order_info'] = $order->get_data();

        if ($_SESSION['order_info']['billing']['email'] != $_SESSION['email']) {
            wp_send_json([
                "status" => 'invalid order',
                "message" => 'شماره سفارش متعلق به شما نیست!'
            ]);
        } else {

            unset($_SESSION['email']);
            unset($_SESSION['order_id']);

            wp_send_json([
                "status" => 'valid order',
            ]);
        }
    }
}


function register_my_session()
{
    if (!session_id()) {
        session_start();
    }
}

add_action('init', 'register_my_session');
session_start();


add_action('wp_head', function () {
?>
    <script>
        var redirectUrl = <?= "'" . home_url('/cart') . "'" ?>;
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.8/dist/css/splide.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.8/dist/css/splide-core.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.8/dist/js/splide.min.js"></script>


<?php
});

add_action('wp_footer', function () {
?>

<?php
});



add_shortcode('plswb_breadcrumb', function () {
?>
    <ul class="breadcrumb breadcrumb-line fw-bold fs-7 mb-8">
        <?php
        if (function_exists('bcn_display')) bcn_display();
        ?>
    </ul>
<?php
});


function get_variation_price_by_id($product_id, $variation_id){
	$currency_symbol = get_woocommerce_currency_symbol();
	$product = new WC_Product_Variable($product_id);
	$variations = $product->get_available_variations();
	$var_data = [];
	foreach ($variations as $variation) {
		if($variation['variation_id'] == $variation_id){
			$display_regular_price = $variation['display_regular_price'].'<span class="currency">'. $currency_symbol .'</span>';
			$display_price = $variation['display_price'].'<span class="currency">'. $currency_symbol .'</span>';
		}
	}

	//Check if Regular price is equal with Sale price (Display price)
	if ($display_regular_price == $display_price){
		$display_price = false;
	}

	$priceArray = array(
		'display_regular_price' => $display_regular_price,
		'display_price' => $display_price
	);
	$priceObject = (object)$priceArray;
	return $priceObject;
}

