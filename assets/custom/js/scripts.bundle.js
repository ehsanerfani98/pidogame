

jQuery(function () {

    // Post tags
    var tagsInput = document.querySelector("#kt_post_tags");
    new Tagify(tagsInput, {
        templates: {
            tag: function (tagData) {
                try {
                    var link = tagData.value.replaceAll(' ', '-');
                    return `<tag title='${tagData.value}' contenteditable='false' spellcheck="false" class='tagify__tag ${tagData.class ? tagData.class : ""}' ${this.getAttributes(tagData)}><x title='remove tag' class='tagify__tag__removeBtn'></x><div class="d-flex align-items-center"><a class="text-gray-700" href='/?tag=${link}'><span class='tagify__tag-text'>${tagData.value}</span></a></div></tag>`
                }
                catch (err) { }
            },
        }
    });

    // Change theme mode
    $(".theme-mode-light-btn").on("click", function () {
        KTApp.setThemeMode("light", function () {
            $(".theme-mode-dark-btn").removeClass("active");
            $(".theme-mode-dark-icon").addClass("d-none");
            $(".theme-mode-light-btn").addClass("active");
            $(".theme-mode-light-icon").removeClass("d-none");
            $("#kt_user_menu_dark_mode_toggle").prop("checked", false);
            var date = new Date(Date.now() + 365 * 24 * 60 * 60 * 1000); // +365 day from now
            var options = { expires: date };
            KTCookie.set("theme_mode", "light", options);
        });
    })
    $(".theme-mode-dark-btn").on("click", function () {
        KTApp.setThemeMode("dark", function () {
            $(".theme-mode-light-btn").removeClass("active");
            $(".theme-mode-light-icon").addClass("d-none");
            $(".theme-mode-dark-btn").addClass("active");
            $(".theme-mode-dark-icon").removeClass("d-none");
            $("#kt_user_menu_dark_mode_toggle").prop("checked", true);
            var date = new Date(Date.now() + 365 * 24 * 60 * 60 * 1000); // +365 day from now
            var options = { expires: date };
            KTCookie.set("theme_mode", "dark", options);
        });
    })
    $('#kt_user_menu_dark_mode_toggle').on("change", function () {
        if (this.checked) {
            KTApp.setThemeMode("dark", function () {
                $(".theme-mode-light-btn").removeClass("active");
                $(".theme-mode-light-icon").addClass("d-none");
                $(".theme-mode-dark-btn").addClass("active");
                $(".theme-mode-dark-icon").removeClass("d-none");
                var date = new Date(Date.now() + 365 * 24 * 60 * 60 * 1000); // +365 day from now
                var options = { expires: date };
                KTCookie.set("theme_mode", "dark", options);
            });
        } else {
            KTApp.setThemeMode("light", function () {
                $(".theme-mode-dark-btn").removeClass("active");
                $(".theme-mode-dark-icon").addClass("d-none");
                $(".theme-mode-light-btn").addClass("active");
                $(".theme-mode-light-icon").removeClass("d-none");
                var date = new Date(Date.now() + 365 * 24 * 60 * 60 * 1000); // +365 day from now
                var options = { expires: date };
                KTCookie.set("theme_mode", "light", options);
            });
        }
    })

    // Get header cart items
    $("#header-cart-btn").on("click", function () {
        if (document.getElementById("header-cart-loading") !== null) {
            $.ajax({
                url: templateDirectory + '/ajax/get-header-cart.php',
                type: 'GET',
                success: function (result) {
                    $("#header-cart-wrap").append(result);
                    $("#header-cart-loading").remove();
                }
            });
        }
    })
    $(document).on('click', '#header-cart-remove-item', function () {
        var productId = $(this).data("product-id");
        $.ajax({
            url: templateDirectory + '/ajax/remove-cart-product.php',
            type: 'POST',
            data: { productId: productId },
            success: function () {
                $.ajax({
                    url: templateDirectory + '/ajax/get-header-cart.php',
                    type: 'GET',
                    success: function (result) {
                        $("#header-cart-wrap").empty();
                        $("#header-cart-wrap").append(result);
                        $.ajax({
                            url: templateDirectory + '/ajax/get-cart-count.php',
                            type: 'GET',
                            success: function (result) {
                                if (result > 0) {
                                    $("#header-cart-count").text(result);
                                } else {
                                    $("#header-cart-count").remove();
                                }
                            }
                        });
                    }
                });
            }
        });
    })

    // Notification modal
    var notificationModal = document.getElementById('kt_notification_modal');
    if (notificationModal) {
        notificationModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var recipient = button.getAttribute('data-bs-notification-id');
            var modalTitle = notificationModal.querySelector('.modal-title-label');
            var modalBody = notificationModal.querySelector('.modal-body');
            var modalBadge = notificationModal.querySelector('.modal-badge');
            var modalDate = notificationModal.querySelector('.notification-date');
            $.ajax({
                url: templateDirectory + '/ajax/get-notification.php',
                type: 'POST',
                data: { id: recipient },
                success: function (result) {
                    var resultArray = JSON.parse(result);
                    modalTitle.textContent = resultArray['title'];
                    modalBody.innerHTML = resultArray['content'];
                    if (resultArray['important'] == true) modalBadge.textContent = 'مهم';
                    else modalBadge.textContent = null;
                    modalDate.textContent = resultArray['date'];
                }
            })
        })
    }

    // Comments
    $('textarea[name="comment"]').maxlength({
        warningClass: "badge badge-primary ss02",
        limitReachedClass: "badge badge-danger ss02"
    })

    const checkRating = function () {
        const value = document.querySelector('input[name="rating"]:checked').value;
        if (value === '0') {
            return {
                valid: false,
                message: "امتیاز خود را انتخاب کنید"
            };
        }
        return {
            valid: true,
        };
    }

    var KTProductCommentSubmit = (function () {
        var t, e, i;
        return {
            init: function () {
                (i = document.querySelector("#kt_product_submit_comment_form")),
                    (t = document.getElementById("kt_product_comment_submit")),
                    (e = FormValidation.formValidation(i, {
                        fields: {
                            rating: { validators: { callback: { callback: checkRating } } },
                            comment: { validators: { notEmpty: { message: "متن دیدگاه خود را وارد نمایید" } } },
                            first_name: { validators: { notEmpty: { message: "نام مورد نیاز است" } } },
                            email: { validators: { notEmpty: { message: "آدرس ایمیل مورد نیاز است" }, emailAddress: { message: "ایمیل وارد شده معتبر نیست" } } },
                        },
                        plugins: { trigger: new FormValidation.plugins.Trigger(), bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) },
                    })),
                    t.addEventListener("click", function (i) {
                        i.preventDefault(),
                            e &&
                            e.validate().then(function (e) {
                                "Valid" == e
                                    ? (t.setAttribute("data-kt-indicator", "on"),
                                        (t.disabled = !0),
                                        userId = t.getAttribute('data-comment-author-id'),
                                        productId = t.getAttribute('data-product-id'),
                                        content = document.getElementsByName("comment")[0].value,
                                        rating = document.querySelector('input[name="rating"]:checked').value,
                                        replyId = document.querySelector('.reply-alert').getAttribute('data-reply-to'),
                                        userId == 0
                                            ? (
                                                firstName = document.getElementsByName("first_name")[0].value,
                                                lastName = document.getElementsByName("last_name")[0].value,
                                                email = document.getElementsByName("email")[0].value,
                                                $.ajax({
                                                    url: templateDirectory + '/ajax/post-product-comment.php',
                                                    type: 'POST',
                                                    data: { type: 'guest', productId: productId, userId: userId, firstName: firstName, lastName: lastName, email: email, content: content, rating: rating, replyId: replyId },
                                                    success: function () {
                                                        t.removeAttribute("data-kt-indicator");
                                                        t.disabled = !1;
                                                        t.isConfirmed;
                                                        Swal.fire({
                                                            text: "دیدگاه شما با موفقیت ثبت شد و پس از تایید توسط مدیریت وب سایت نمایش داده خواهد شد.",
                                                            icon: "success",
                                                            buttonsStyling: !1,
                                                            confirmButtonText: "متوجه شدم!",
                                                            customClass: { confirmButton: "btn btn-primary" },
                                                        });
                                                        $("#kt_product_submit_comment_form").trigger('reset');
                                                    }
                                                })
                                            )
                                            : (
                                                $.ajax({
                                                    url: templateDirectory + '/ajax/post-product-comment.php',
                                                    type: 'POST',
                                                    data: { type: 'user', productId: productId, userId: userId, content: content, rating: rating, replyId: replyId },
                                                    success: function () {
                                                        t.removeAttribute("data-kt-indicator");
                                                        t.disabled = !1;
                                                        t.isConfirmed;
                                                        Swal.fire({
                                                            text: "دیدگاه شما با موفقیت ثبت شد و پس از تایید توسط مدیریت وب سایت نمایش داده خواهد شد.",
                                                            icon: "success",
                                                            buttonsStyling: !1,
                                                            confirmButtonText: "متوجه شدم!",
                                                            customClass: { confirmButton: "btn btn-primary" },
                                                        });
                                                        $("#kt_product_submit_comment_form").trigger('reset');
                                                    }
                                                })
                                            )
                                    )
                                    : Swal.fire({
                                        text: "با عرض پوزش، برخی اطلاعات وارد شده صحیح نمی باشند، لطفا دوباره تلاش کنید.",
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "متوجه شدم!",
                                        customClass: { confirmButton: "btn btn-primary" },
                                    })
                            });
                    });
            },
        };
    })()

    var KTPostCommentSubmit = (function () {
        var t, e, i;
        return {
            init: function () {
                (i = document.querySelector("#kt_post_submit_comment_form")),
                    (t = document.getElementById("kt_post_comment_submit")),
                    (e = FormValidation.formValidation(i, {
                        fields: {
                            comment: { validators: { notEmpty: { message: "متن دیدگاه خود را وارد نمایید" } } },
                            first_name: { validators: { notEmpty: { message: "نام مورد نیاز است" } } },
                            email: { validators: { notEmpty: { message: "آدرس ایمیل مورد نیاز است" }, emailAddress: { message: "ایمیل وارد شده معتبر نیست" } } },
                        },
                        plugins: { trigger: new FormValidation.plugins.Trigger(), bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) },
                    })),
                    t.addEventListener("click", function (i) {
                        i.preventDefault(),
                            e &&
                            e.validate().then(function (e) {
                                "Valid" == e
                                    ? (t.setAttribute("data-kt-indicator", "on"),
                                        (t.disabled = !0),
                                        userId = t.getAttribute('data-comment-author-id'),
                                        postId = t.getAttribute('data-post-id'),
                                        content = document.getElementsByName("comment")[0].value,
                                        replyId = document.querySelector('.reply-alert').getAttribute('data-reply-to'),
                                        userId == 0
                                            ? (
                                                firstName = document.getElementsByName("first_name")[0].value,
                                                lastName = document.getElementsByName("last_name")[0].value,
                                                email = document.getElementsByName("email")[0].value,
                                                $.ajax({
                                                    url: templateDirectory + '/ajax/post-post-comment.php',
                                                    type: 'POST',
                                                    data: { type: 'guest', postId: postId, userId: userId, firstName: firstName, lastName: lastName, email: email, content: content, replyId: replyId },
                                                    success: function () {
                                                        t.removeAttribute("data-kt-indicator");
                                                        t.disabled = !1;
                                                        t.isConfirmed;
                                                        Swal.fire({
                                                            text: "دیدگاه شما با موفقیت ثبت شد و پس از تایید توسط مدیریت وب سایت نمایش داده خواهد شد.",
                                                            icon: "success",
                                                            buttonsStyling: !1,
                                                            confirmButtonText: "متوجه شدم!",
                                                            customClass: { confirmButton: "btn btn-primary" },
                                                        });
                                                        $("#kt_post_submit_comment_form").trigger('reset');
                                                    }
                                                })
                                            )
                                            : (
                                                $.ajax({
                                                    url: templateDirectory + '/ajax/post-post-comment.php',
                                                    type: 'POST',
                                                    data: { type: 'user', postId: postId, userId: userId, content: content, replyId: replyId },
                                                    success: function () {
                                                        t.removeAttribute("data-kt-indicator");
                                                        t.disabled = !1;
                                                        t.isConfirmed;
                                                        Swal.fire({
                                                            text: "دیدگاه شما با موفقیت ثبت شد و پس از تایید توسط مدیریت وب سایت نمایش داده خواهد شد.",
                                                            icon: "success",
                                                            buttonsStyling: !1,
                                                            confirmButtonText: "متوجه شدم!",
                                                            customClass: { confirmButton: "btn btn-primary" },
                                                        });
                                                        $("#kt_post_submit_comment_form").trigger('reset');
                                                    }
                                                })
                                            )
                                    )
                                    : Swal.fire({
                                        text: "با عرض پوزش، برخی اطلاعات وارد شده صحیح نمی باشند، لطفا دوباره تلاش کنید.",
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "متوجه شدم!",
                                        customClass: { confirmButton: "btn btn-primary" },
                                    })
                            });
                    });
            },
        };
    })()


    /*============ Style ============*/
    // Select2 variables (Buy product modal)
    $('#kt_modal_product_buy .variations tr').each(function () {
        var current = $(this);
        current.find('th.label label').unwrap().removeAttr('for').addClass('required fs-5 fw-bold mb-2');
        current.find('td.value select').unwrap().prop("required", true).addClass('form-select form-select-solid').attr('data-allow-clear', 'true').select2({
            placeholder: 'انتخاب کنید',
            minimumResultsForSearch: -1
        })
        current.wrapAll('<div class="d-flex flex-column mb-10"></div>').contents().unwrap();
    })
    $('#kt_modal_product_buy .variations').addClass('d-block');
    $('#kt_modal_product_buy .variations').find('tbody').addClass('d-block');
    $('.reset_variations').remove();
    $('.woocommerce-variation').addClass('d-none');

    // Quantity modify (Buy product modal)
    $('#kt_modal_product_buy').find('.quantity').prepend('<button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease"><span class="svg-icon svg-icon-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect><rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="currentColor"></rect></svg></span></button>');
    $('#kt_modal_product_buy').find('.quantity').append('<button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase"><span class="svg-icon svg-icon-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect><rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor"></rect><rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor"></rect></svg></span></button>');
    $('#kt_modal_product_buy').find('.quantity').find('input').attr('type', 'text').addClass('form-control form-control-solid border-0 text-center ss02 w-100px').attr('readonly', true).attr('data-kt-dialer-control', 'input').removeAttr('inputmode').removeAttr('autocomplete').removeAttr('size').removeAttr('title');
    $('#kt_modal_product_buy').find('.quantity').addClass('position-relative w-100px d-inline-block');
    var addToCartMin = parseInt($('#kt_modal_product_buy').find('.quantity').find('input').attr('min'));
    var addToCartMax = parseInt($('#kt_modal_product_buy').find('.quantity').find('input').attr('max'));
    var addToCartStep = parseInt($('#kt_modal_product_buy').find('.quantity').find('input').attr('step'));
    var addToCartDialerElement = document.querySelector(".quantity");
    var addToCartDialerObject = new KTDialer(addToCartDialerElement, {
        min: addToCartMin,
        max: addToCartMax,
        step: addToCartStep
    })

    // Add to cart button and stock and notice modify (Buy product modal)
    $('#kt_modal_product_buy').find('.single_add_to_cart_button').addClass('btn btn-primary ms-2').removeClass('button alt');
    $('#kt_modal_product_buy').find('.stock').remove();
    $('.modal-body').find('.yith-wcwl-add-to-wishlist').remove();
    $('#kt_modal_product_buy .quantity,#kt_modal_product_buy .single_add_to_cart_button').wrapAll('<div class="text-center"></div>');
    $('#kt_modal_product_buy').find('.notice p').last().addClass('mb-0');
    $('.single_add_to_cart_button').append('<span class="price-badge badge badge-light-primary ms-2 ss02"></span>');
    /*============ Style ============*/


    /*============ Process ============*/
    // Add price to button and change quantity (Buy product modal)
    // $('#kt_modal_product_buy input').change(function () {
    //     var addToCartMin = parseInt($('#kt_modal_product_buy').find('.quantity').find('input').attr('min'));
    //     var addToCartMax = parseInt($('#kt_modal_product_buy').find('.quantity').find('input').attr('max'));
    //     addToCartDialerObject.setMinValue(addToCartMin);
    //     addToCartDialerObject.setMaxValue(addToCartMax);
    //     addToCartDialerObject.update();
    // })

    // Change price by quantity increase
    if (Object.keys(addToCartDialerObject).length !== 0) {
        addToCartDialerObject.on('kt.dialer.increase', function () {
            var quantityValueBefore = parseInt(addToCartDialerObject.getValue());
            addToCartDialerObject.on('kt.dialer.increased', function () {
                var quantityValue = parseInt(addToCartDialerObject.getValue());
                if (quantityValue !== quantityValueBefore) {
                    var badge = $('.price-badge').text();
                    badgePrice = badge.replaceAll(',', '');
                    badgePrice = parseInt(badgePrice);
                    if (badgePrice) {
                        newPrice = (quantityValue * badgePrice) / (quantityValue - 1);
                        var newPriceHtml = newPrice.toLocaleString();
                        $('.price-badge').empty().text(newPriceHtml + ' تومان');
                    }
                }
            })
        })
        // Change price by quantity decrease
        addToCartDialerObject.on('kt.dialer.decrease', function () {
            var quantityValueBefore = parseInt(addToCartDialerObject.getValue());
            addToCartDialerObject.on('kt.dialer.decreased', function () {
                var quantityValue = parseInt(addToCartDialerObject.getValue());
                if (quantityValue !== quantityValueBefore) {
                    var badge = $('.price-badge').text();
                    badgePrice = badge.replaceAll(',', '');
                    badgePrice = parseInt(badgePrice);
                    if (badgePrice) {
                        newPrice = (quantityValue * badgePrice) / (quantityValue + 1);
                        var newPriceHtml = newPrice.toLocaleString();
                        $('.price-badge').empty().text(newPriceHtml + ' تومان');
                    }
                }
            })
        })
    }

    // $('.shop_table').wrapAll("<div class='card'><div class='card-body'></div></div>");
    // $('.shop_table').find('.quantity').prepend('<button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease"><span class="svg-icon svg-icon-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect><rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="currentColor"></rect></svg></span></button>');
    // $('.shop_table').find('.quantity').append('<button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase"><span class="svg-icon svg-icon-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect><rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor"></rect><rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor"></rect></svg></span></button>');
    // $('.shop_table').find('.quantity').find('input').attr('type', 'text').addClass('form-control form-control-solid border-0 text-center ss02 w-100px').attr('readonly', true).attr('data-kt-dialer-control', 'input').removeAttr('inputmode').removeAttr('autocomplete').removeAttr('size').removeAttr('title');
    // $('.shop_table').find('.quantity').addClass('position-relative w-100px d-inline-block');
    // var addToShopMin = parseInt($('.shop_table').find('.quantity').find('input').attr('min'));
    // var addToShopMax = parseInt($('.shop_table').find('.quantity').find('input').attr('max'));
    // var addToShopStep = parseInt($('.shop_table').find('.quantity').find('input').attr('step'));
    // var addToShopDialerElement = document.querySelector(".quantity");
    // var addToShopDialerObject = new KTDialer(addToShopDialerElement, {
    //     min: addToShopMin,
    //     max: addToShopMax,
    //     step: addToShopStep
    // })




    // Change attributes on modal (Buy product modal)
    var productBuyModal = document.getElementById('kt_modal_product_buy');
    if (productBuyModal) {
        productBuyModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            $(button).each(function () {
                $.each(this.attributes, function () {
                    if (this.specified && this.name.startsWith('data-bs-attribute')) {
                        var recipient = this.name.replace('data-bs-', '');
                        $('#kt_modal_product_buy').find('[name="' + recipient + '"]').val(this.value).trigger('change');
                    }
                });
            });
        })
    }


    // Reply comment
    $('.reply-comment').click(function () {
        var replyId = $(this).attr('data-reply-id');
        $('.reply-alert').attr('data-reply-to', replyId);
        var authorProfile = $('#comment-' + replyId).find('.symbol').html();
        $('.reply-alert').find('.symbol').html(authorProfile);
        var commentAuthor = $('#comment-' + replyId).find('.comment-author').html();
        $('.reply-alert').find('.reply-author').html(commentAuthor);
        var commentContent = $('#comment-' + replyId).find('.comment-content').html();
        $('.reply-alert').find('.reply-content').html(commentContent);
        $('.reply-alert').removeClass('d-none');
    })
    $('.reply-dismiss').click(function () {
        $('.reply-alert').addClass('d-none');
        $('.reply-alert').removeAttr('data-reply-to');
    })

    // Gift card add to cart
    $('.gift-card-add-to-cart-btn').click(function () {
        var addToCartDialerElement = $(this).parent().find('[data-kt-dialer="true"]')[0];
        var redirectUrl = $(this).attr("data-kt-redirect-url");
        var addToCartDialerObject = KTDialer.getInstance(addToCartDialerElement);

        var addToCartUrl = $(this).attr('data-url') + '&quantity=' + addToCartDialerObject.getValue();
        $.ajax({
            url: addToCartUrl,
            type: 'GET',
            success: function () {
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
        })
    })

    $($('.gift-card-back')).each(function () {
        var current = $(this);
        var giftCardAddToCartDialerElement = current.find('[data-kt-dialer="true"]')[0];
        var giftCardAddToCartDialerObject = KTDialer.getInstance(giftCardAddToCartDialerElement);
        giftCardAddToCartDialerObject.on('kt.dialer.increase', function () {
            var quantityValueBefore = parseInt(giftCardAddToCartDialerObject.getValue());
            giftCardAddToCartDialerObject.on('kt.dialer.increased', function () {
                var quantityValue = parseInt(giftCardAddToCartDialerObject.getValue());
                if (quantityValue !== quantityValueBefore) {
                    var badge = current.find('.gift-card-price-badge').text();
                    badgePrice = badge.replaceAll(',', '');
                    badgePrice = parseInt(badgePrice);
                    if (badgePrice) {
                        newPrice = (quantityValue * badgePrice) / (quantityValue - 1);
                        var newPriceHtml = newPrice.toLocaleString();
                        current.find('.gift-card-price-badge').empty().text(newPriceHtml + ' تومان');
                    }
                }
            })
        })
        giftCardAddToCartDialerObject.on('kt.dialer.decrease', function () {
            var quantityValueBefore = parseInt(giftCardAddToCartDialerObject.getValue());
            giftCardAddToCartDialerObject.on('kt.dialer.decreased', function () {
                var quantityValue = parseInt(giftCardAddToCartDialerObject.getValue());
                if (quantityValue !== quantityValueBefore) {
                    var badge = current.find('.gift-card-price-badge').text();
                    badgePrice = badge.replaceAll(',', '');
                    badgePrice = parseInt(badgePrice);
                    if (badgePrice) {
                        newPrice = (quantityValue * badgePrice) / (quantityValue + 1);
                        var newPriceHtml = newPrice.toLocaleString();
                        current.find('.gift-card-price-badge').empty().text(newPriceHtml + ' تومان');
                    }
                }
            })
        })
    })

    // Gift card filter
    var optionFormat = function (item) {
        if (!item.id) return item.text;
        var span = document.createElement('span');
        var imgUrl = item.element.getAttribute('data-kt-select2-icon');
        var template = '';
        template += '<img src="' + imgUrl + '" class="rounded-circle h-20px me-2"/>';
        template += item.text;
        span.innerHTML = template;
        return $(span);
    }
    $('.gift-card-select').select2({
        templateSelection: optionFormat,
        templateResult: optionFormat,
        minimumResultsForSearch: -1
    })

    function changeSelect() {
        var collection = $('.gift-card-col');
        var selects = $('.gift-card-select');

        selects.each(function () {
            var currentSelect = $(this);
            var name = currentSelect.attr('name');
            var value = currentSelect.find(':selected').val();
            for (let i = 0; i < collection.length; i++) {
                const element = collection.eq(i);
                var attr = element.attr('data-attribute_' + name);
                if (attr !== undefined && value !== undefined && attr !== '' && value !== '') {
                    if (attr !== value) {
                        element.removeClass('d-block').addClass('d-none');
                    }
                }
            }
        })
    }
    function changeSearch() {
        var value = $('.gift-cards-search').val().toLowerCase();
        $('.gift-card-title').filter(function () {
            if ($(this).text().toLowerCase().indexOf(value) > -1) {
                $(this).closest('.gift-card-col').removeClass('d-none').addClass('d-block');
            }
            else {
                $(this).closest('.gift-card-col').removeClass('d-block').addClass('d-none');
            }
        })
    }
    function changeDeliveryTime() {
        var collection = $('.gift-card-col');
        var value = $('select[name="delivery-time"]').find(':selected').val();
        var value = $.trim(value);
        for (let i = 0; i < collection.length; i++) {
            const element = collection.eq(i);
            var text = $.trim(element.find('.delivery-time').text());
            if (value !== undefined && value !== '') {
                if (text !== value) {
                    element.removeClass('d-block').addClass('d-none');
                }
            }
        }
    }
    $('.gift-card-select').on('select2:select select2:clear', function () {
        $('.gift-card-col').removeClass('d-none').addClass('d-block');
        changeSearch();
        changeSelect();
        changeDeliveryTime();
        $('#select_filter').removeClass('d-block').addClass('d-none');
        $('#cards_section').removeClass('d-none').addClass('d-flex');
        if ($('.gift-card-col.d-block').length === 0) $('#no_card_div').removeClass('d-none').addClass('d-block');
        else $('#no_card_div').removeClass('d-block').addClass('d-none');
    })
    $('.gift-cards-search').on('keyup', function () {
        $('.gift-card-col').removeClass('d-none').addClass('d-block');
        changeSearch();
        changeSelect();
        changeDeliveryTime();
        if ($('#select_filter.d-block').length == 0) {
            if ($('.gift-card-col.d-block').length === 0) $('#no_card_div').removeClass('d-none').addClass('d-block');
            else $('#no_card_div').removeClass('d-block').addClass('d-none');
        }
    })
    $('select[name="delivery-time"]').on('select2:select select2:clear', function () {
        if ($('#select_filter.d-block').length === 0) {
            $('.gift-card-col').removeClass('d-none').addClass('d-block');
            changeSearch();
            changeSelect();
            changeDeliveryTime();
            $('#select_filter').removeClass('d-block').addClass('d-none');
            $('#cards_section').removeClass('d-none').addClass('d-flex');
            if ($('.gift-card-col.d-block').length === 0) $('#no_card_div').removeClass('d-none').addClass('d-block');
            else $('#no_card_div').removeClass('d-block').addClass('d-none');
        }
    })
    $('input[type=radio].first-filter-radio').change(function () {
        var name = this.getAttribute('name');
        $('select[name="' + name + '"]').val(this.value).trigger('change').trigger('select2:select');
    })

    // On content load
    KTUtil.onDOMContentLoaded(function () {
        if (document.querySelector("#kt_product_submit_comment_form")) KTProductCommentSubmit.init();
        if (document.querySelector("#kt_post_submit_comment_form")) KTPostCommentSubmit.init();
    })

});


// let slideIndex = 1;
// showSlides(slideIndex);

// function plusSlides(n) {
//     showSlides(slideIndex += n);
// }

// function currentSlide(n) {
//     showSlides(slideIndex = n);
// }


