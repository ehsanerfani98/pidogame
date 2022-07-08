<?php $options = get_option('pidogame_framework');
global $product; ?>
<div id="comment" class="row">
    <div class="col-12 col-xl-12">
        <div class="mt-17">
            <div class="d-flex flex-stack mb-5">
                <h3 class="text-dark">دیدگاه خود را بنویسید</h3>
            </div>
            <div class="separator separator-dashed mb-9"></div>
            <div class="row g-10">
                <form id="kt_product_submit_comment_form" class="form">
                    <div class="mb-5 fv-row">
                        <label class="d-inline-block fs-6 fw-bold text-gray-700">امتیاز شما به محصول:</label>
                        <div class="d-inline-block ms-2">
                            <input class="rating-input" name="rating" value="0" checked type="radio" id="kt_rating_input_0" />
                            <label class="rating-label" for="kt_rating_input_1">
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                            </label>
                            <input class="rating-input" name="rating" value="1" type="radio" id="kt_rating_input_1" />
                            <label class="rating-label" for="kt_rating_input_2">
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                            </label>
                            <input class="rating-input" name="rating" value="2" type="radio" id="kt_rating_input_2" />
                            <label class="rating-label" for="kt_rating_input_3">
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                            </label>
                            <input class="rating-input" name="rating" value="3" type="radio" id="kt_rating_input_3" />
                            <label class="rating-label" for="kt_rating_input_4">
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                            </label>
                            <input class="rating-input" name="rating" value="4" type="radio" id="kt_rating_input_4" />
                            <label class="rating-label" for="kt_rating_input_5">
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                            </label>
                            <input class="rating-input" name="rating" value="5" type="radio" id="kt_rating_input_5" />
                        </div>
                    </div>
                    <?php if (!is_user_logged_in()) : ?>
                        <div class="row mb-3">
                            <div class="col-md-6 fv-row">
                                <input type="text" class="form-control" placeholder="نام" name="first_name" />
                            </div>
                            <div class="col-md-6 fv-row">
                                <input type="text" class="form-control" placeholder="نام خانوادگی" name="last_name" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 fv-row">
                                <input type="text" class="form-control" placeholder="ایمیل" name="email" />
                            </div>
                        </div>
                    <?php endif ?>
                    <div class="reply-alert alert bg-light-info d-flex flex-column flex-sm-row p-5 d-none">
                        <div class="symbol symbol-35px me-3 mb-4"></div>
                        <div class="d-flex flex-column pe-0 pe-sm-10">
                            <span class="text-info fw-bold fs-7">در حال پاسخ دادن به <span class="reply-author"></span></span>
                            <span class="reply-content fs-7 mt-1"></span>
                        </div>
                        <button type="button" class="reply-dismiss position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto">
                            <span class="svg-icon svg-icon-1 svg-icon-info">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                </svg>
                            </span>
                        </button>
                    </div>
                    <div class="form-group fv-row">
                        <textarea name="comment" class="form-control mb-2 ss02" rows="4" placeholder="دیدگاه خود را در این قسمت وارد کنید..." maxlength="1000" data-kt-autosize="true"></textarea>
                    </div>
                    <div class="d-flex align-items-center justify-content-between py-2 mb-5">
                        <div class="text-primary fs-base fw-bold cursor-pointer" data-bs-toggle="collapse" data-bs-target="#kt_comments_rules"><?php echo $options['opt-comments-rules-title'] ?></div>
                        <button type="submit" class="btn btn-primary" data-comment-author-id="<?php echo get_current_user_id() ?>" data-product-id="<?php echo $product->id ?>" id="kt_product_comment_submit">
                            <span class="indicator-label">ثبت دیدگاه</span>
                            <span class="indicator-progress">در حال ارسال...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <div class="collapse" id="kt_comments_rules">
                        <div class="text-gray-700 fs-6"><?php echo wpautop($options['opt-comments-rules-content']) ?></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>