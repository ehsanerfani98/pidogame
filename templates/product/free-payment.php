<div class="d-flex flex-column flex-root">
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start">
        <div class="content flex-row-fluid" id="kt_content">
            <form action="" method="post">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h1><?php the_title() ?></h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php

                        the_content();


                        ?>
                    </div>
                    <div class="card-footer border border-primary border-dashed pb-0">
                        <input type="hidden" id="pid" value="<?php the_ID() ?>">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">عنوان محصول درخواستی</label>
                                    <input required id="free-title" style="text-align: right;" type="text" class="form-control form-control-solid" placeholder="عنوان محصول را وارد کنید" />
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput2" class="required form-label">مبلغ محصول درخواستی (تومان)</label>
                                    <input required id="free-amount" style="text-align: right;" type="number" class="form-control form-control-solid" placeholder="مبلغ محصول را وارد کنید" />
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput3" class="form-label">تعداد درخواستی</label>
                                    <br>
                                    <div class="position-relative w-100px d-inline-block" data-kt-dialer="true" data-kt-dialer-min="1" data-kt-dialer-max="" data-kt-dialer-step="1">
                                        <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease"><span class="svg-icon svg-icon-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                                                    <rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="currentColor"></rect>
                                                </svg></span></button>
                                        <input name="" id="free-qty" type="text" class="form-control form-control-solid border-0 text-center ss02 w-100px" readonly data-kt-dialer-control="input">
                                        <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase"><span class="svg-icon svg-icon-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                                                    <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor"></rect>
                                                    <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor"></rect>
                                                </svg></span></button>

                                    </div>


                                </div>

                            </div>
                            <div class="col-lg-3" style="text-align: left;">
                                <label style="width: 100%;" for="exampleFormControlInput4" class="form-label"></label>

                                <button type="button" class="btn btn-primary" id="free-payment-add-to-cart">
                                    <span class="indicator-label">
                                        افزودن به سبد خرید
                                    </span>
                                    <span class="indicator-progress">
                                        در حال پردازش ... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>