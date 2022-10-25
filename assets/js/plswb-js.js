

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
            jQuery('#wrap-cart-count').html('<span id="header-cart-count" class="position-absolute top-0 start-0 translate-middle badge badge-circle badge-primary ss02 display-count-display">' + response.count + '</span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"> <path d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z" fill="currentColor" /> <path opacity="0.3" d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z" fill="currentColor" /> <path opacity="0.3" d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z" fill="currentColor" /> </svg>');
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

jQuery('.wc-forward').addClass('btn btn-danger').removeClass('button');
jQuery('.woocommerce-table--custom-fields').addClass('table table-striped table-rounded border gy-7 gs-7').removeClass('woocommerce-table shop_table ');
jQuery('.order_details').addClass('bg-success rounded p-5 text-white');
jQuery('.woocommerce-bacs-bank-details').addClass('p-5 bg-gray-100 rounded');

jQuery('.term-description').addClass('card');

// var label_completed = $('.woocommerce-orders-table__row--status-completed').text();
// $('.woocommerce-orders-table__row--status-completed').html('<span class="label_completed">'+ label_completed +'</span>');

var status_collection = jQuery('.woocommerce-orders-table__row');

var status_label
jQuery.each(status_collection, function (index, value) {
    if (jQuery(value).hasClass('woocommerce-orders-table__row--status-on-hold')) {
        status_label = jQuery(value).find('.woocommerce-orders-table__cell-order-status').text();
        jQuery(value).find('.woocommerce-orders-table__cell-order-status').html('<span class="hold_label">' + status_label + '</span>');
    }
    if (jQuery(value).hasClass('woocommerce-orders-table__row--status-completed')) {
        status_label = jQuery(value).find('.woocommerce-orders-table__cell-order-status').text();
        jQuery(value).find('.woocommerce-orders-table__cell-order-status').html('<span class="completed_label">' + status_label + '</span>');
    }
    if (jQuery(value).hasClass('woocommerce-orders-table__row--status-processing')) {
        status_label = jQuery(value).find('.woocommerce-orders-table__cell-order-status').text();
        jQuery(value).find('.woocommerce-orders-table__cell-order-status').html('<span class="processing_label">' + status_label + '</span>');
    }
    if (jQuery(value).hasClass('woocommerce-orders-table__row--status-refunded')) {
        status_label = jQuery(value).find('.woocommerce-orders-table__cell-order-status').text();
        jQuery(value).find('.woocommerce-orders-table__cell-order-status').html('<span class="refunded_label">' + status_label + '</span>');
    }
});

