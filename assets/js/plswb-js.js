

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

jQuery('#search-product').change(function (item) {
    jQuery.ajax({
        url: woocommerce_params.ajax_url,
        type: 'post',
        data: {
            action: 'search_data_product',
            keyword: jQuery('#search-product').val()
        },
        success: function (data) {
            jQuery('.wrap-search-product').html(data);
        }
    });
});


var processs = function(search) {
    var timeout = setTimeout(function() {
        var number = KTUtil.getRandomInt(1, 6);

        // Hide recently viewed
        suggestionsElement.classList.add("d-none");

        if (number === 3) {
            // Hide results
            resultsElement.classList.add("d-none");
            // Show empty message
            emptyElement.classList.remove("d-none");
        } else {
            // Show results
            resultsElement.classList.remove("d-none");
            // Hide empty message
            emptyElement.classList.add("d-none");
        }

        // Complete search
        search.complete();
    }, 1500);
}

var clear = function(search) {
    // Show recently viewed
    suggestionsElement.classList.remove("d-none");
    // Hide results
    resultsElement.classList.add("d-none");
    // Hide empty message
    emptyElement.classList.add("d-none");
}

// Input handler
const handleInput = () => {
    // Select input field
    const inputField = element.querySelector("[data-kt-search-element="input"]");

    // Handle keyboard press event
    inputField.addEventListener("keydown", e => {
        // Only apply action to Enter key press
        if(e.key === "Enter"){
            e.preventDefault(); // Stop form from submitting
        }
    });
}

// Elements
element = document.querySelector('#kt_docs_search_handler_basic');

if (!element) {
    return;
}

wrapperElement = element.querySelector("[data-kt-search-element="wrapper"]");
suggestionsElement = element.querySelector("[data-kt-search-element="suggestions"]");
resultsElement = element.querySelector("[data-kt-search-element="results"]");
emptyElement = element.querySelector("[data-kt-search-element="empty"]");

// Initialize search handler
searchObject = new KTSearch(element);

// Search handler
searchObject.on("kt.search.process", processs);

// Clear handler
searchObject.on("kt.search.clear", clear);

// Handle select
KTUtil.on(element, "[data-kt-search-element="customer"]", "click", function() {
    //modal.hide();
});

// Handle input enter keypress
handleInput();