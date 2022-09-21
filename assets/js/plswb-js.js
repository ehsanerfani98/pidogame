

function extra_fields(event) {

    let myform = event.target;
    let fd = new FormData(myform);
    let meta_data_cart = [];
    let variation_id;
    let product_id;

    for (var [id, value] of fd.entries()) {
        if (id.startsWith('ext')) {
            let title = jQuery('#' + id).data('extra-title');
            if (jQuery('#' + id).is(':checked')) {
                meta_data_cart.push({
                    title: title,
                    value: value,
                    status: 'on'
                });
            } else {
                meta_data_cart.push({
                    title: title,
                    value: value,
                });
            }

        } else {
            if (id == 'variation-id') {
                variation_id = value;
                btn_id = value;
            } else if (id == 'product-id') {
                product_id = value;
                btn_id = value;
            }
        }
    }

    // console.log(btn_id);
    // jQuery('#btn_' + btn_id).attr('data-kt-indicator', 'on');
    jQuery('#btn_' + variation_id).attr('data-kt-indicator', 'on');

    var metaData = {
        meta_data_cart
    };

    var data = {
        action: 'woocommerce_ajax_add_to_cart',
        product_id: product_id,
        quantity: 1,
        variation_id: variation_id,
        meta: metaData
    };

    jQuery.ajax({
        type: "post",
        url: woocommerce_params.ajax_url,
        data: data,
        success: function (response) {
            jQuery('.display-count-display').text(response.count);
            Swal.fire({
                text: "محصول مورد نظر با موفقیت به سبد خرید شما افزوده شد.",
                icon: "success",
                buttonsStyling: !1,
                showCancelButton: true,
                confirmButtonText: "مشاهده سبد خرید",
                cancelButtonText: "ادامه خرید",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: 'btn btn-light'
                }
            }).then(function (e) {
                if (e.isConfirmed == true) redirectUrl && (location.href = redirectUrl);
            });

            jQuery('#btn_' + variation_id).removeAttr('data-kt-indicator');


            // console.log(response);
        }
    });

    return false;

}

function open_fields(item) {
    jQuery('.show-btn-options').removeClass('d-none');
    jQuery('.wrap_open_fields').removeClass('d-flex').addClass('d-none');
    jQuery(item).parents().eq(1).find('.wrap_open_fields').removeClass('d-none').addClass('d-flex');
    jQuery(item).parent().addClass('d-none');
}

function setLikeComment(item, comment_id) {
    jQuery.ajax({
        type: "post",
        url: woocommerce_params.ajax_url,
        data: {
            action: 'set_like_comment_product',
            comment_id: comment_id,
        },
        success: function (response) {
            if (response.status == "set") {
                $(item).removeClass('svg-icon-muted').addClass('svg-icon-danger');
            } else {
                $(item).removeClass('svg-icon-danger').addClass('svg-icon-muted');
            }
            $(item).parent().find('#like-total').html('(' + response.total + ')');
        }
    });
}

jQuery('#free-payment-add-to-cart').click(function (e) {

    jQuery('#free-payment-add-to-cart').attr('data-kt-indicator', 'on');

    let meta_data_cart = [];

    var title = jQuery('#free-title').val();
    var amount = jQuery('#free-amount').val();
    var qty = jQuery('#free-qty').val();
    var product_id = jQuery('#pid').val();

    meta_data_cart.push({
        title: title,
        value: amount,
        status: 'on'
    });

    var metaData = {
        meta_data_cart
    };

    var data = {
        action: 'woocommerce_ajax_add_to_cart_free_payment',
        product_id: product_id,
        quantity: qty,
        meta: metaData
    };


    jQuery.ajax({
        type: "post",
        url: woocommerce_params.ajax_url,
        data: data,
        success: function (response) {
            jQuery('.display-count-display').text(response.count);
            jQuery('#free-payment-add-to-cart').removeAttr('data-kt-indicator');
            Swal.fire({
                text: "محصول مورد نظر با موفقیت به سبد خرید شما افزوده شد.",
                icon: "success",
                buttonsStyling: !1,
                showCancelButton: true,
                confirmButtonText: "مشاهده سبد خرید",
                cancelButtonText: "ادامه خرید",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: 'btn btn-light'
                }
            }).then(function (e) {
                if (e.isConfirmed == true) redirectUrl && (location.href = redirectUrl);
            });

        }
    });

    return false;

});


jQuery('#check_email').click(function () {
    var btn = this;
    var url = jQuery(this).data('url');
    jQuery('#alert-wrap').slideUp();

    btn.setAttribute("data-kt-indicator", "on");

    jQuery.ajax({
        type: "post",
        url: woocommerce_params.ajax_url,
        data: {
            action: 'check_email_order',
            email: jQuery('#ch_email').val(),
        },
        success: function (response) {
            if (response.status == 'invalid email') {
                jQuery('#alert-message').html(response.message);
                jQuery('#alert-wrap').slideDown();
            } else {
                window.location.href = url;
            }
            btn.removeAttribute("data-kt-indicator");
        }
    });
});

jQuery('#check_order').click(function () {
    var btn = this;
    var url = jQuery(this).data('url');
    jQuery('#alert-wrap').slideUp();

    btn.setAttribute("data-kt-indicator", "on");

    jQuery.ajax({
        type: "post",
        url: woocommerce_params.ajax_url,
        data: {
            action: 'check_id_order',
            order_id: jQuery('#ch_order_id').val(),
        },
        success: function (response) {
            if (response.status == 'invalid order') {
                jQuery('#alert-message').html(response.message);
                jQuery('#alert-wrap').slideDown();
            } else {
                window.location.href = url;
            }
            btn.removeAttribute("data-kt-indicator");
        }
    });
});

$('.wc-forward').addClass('btn btn-danger').removeClass('button');
$('.woocommerce-table--custom-fields').addClass('table table-striped table-rounded border gy-7 gs-7').removeClass('woocommerce-table shop_table ');
$('.order_details').addClass('bg-success rounded p-5 text-white');
$('.woocommerce-bacs-bank-details').addClass('p-5 bg-gray-100 rounded');

$('.term-description').addClass('card');


$('input[required]').on('invalid', function() {
    console.log(this.checkValidity());
    // this.setCustomValidity("پر کردن این فیلد الزامی است");
});


