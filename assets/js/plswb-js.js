

function extra_fields(event) {

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
            console.log(response);
        }
    });

    return false;

}



