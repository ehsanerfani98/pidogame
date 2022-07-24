

function extra_fields(event) {

    var button = jQuery(event.target).find('button');

    button.setAttribute("data-kt-indicator", "on");

    let myform = event.target;
    let fd = new FormData(myform);
    let meta_data_cart = [];
    let variation_id;
    let product_id;

    for (var [id, value] of fd.entries()) {
        if (id.startsWith('ext')) {
            let title = jQuery('#' + id).data('extra-title');
            meta_data_cart.push( {
                title : title,
                value : value
            });
        } else {
            if (id == 'variation-id') {
                variation_id = value;
            } else if (id == 'product-id') {
                product_id = value;
            }
        }
    }

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
        url: woocommerce_params .ajax_url,
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
            button.removeAttribute("data-kt-indicator");

            // console.log(response);
        }
    });

    return false;

}



