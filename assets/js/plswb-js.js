

function extra_fields(event) {


    let myform = event.target;
    let fd = new FormData(myform);
    let meta_data_cart = [];
    let variation_id;
    let product_id;

    for (var [id, value] of fd.entries()) {
        if (id.startsWith('ext')) {
            let title = jQuery('#' + id).data('extra-title');
            meta_data_cart.push({
                title: title,
                value: value
            });
        } else {
            if (id == 'variation-id') {
                variation_id = value;
            } else if (id == 'product-id') {
                product_id = value;
            }
        }
    }

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
            })

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