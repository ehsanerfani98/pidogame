<?php
$meta = get_post_meta(get_the_ID(), 'pidogame_framework_products', true);
global $product;
?>
<div class="card overlay overflow-hidden w-100">
    <div class="card-body p-0">
        <div class="ar-16-8 ar-md-16-6 ar-lg-16-6 ar-xl-16-4 bgi-size-cover bgi-position-center" style="background-image: url(<?php echo $meta['opt-product-wallpaper-image']['url'] ?>)"></div>
        <div class="overlay-layer opacity-50 bg-black"></div>
        <div class="overlay-layer opacity-100 d-flex d-lg-none">
            <div class="d-flex flex-grow-1 flex-center py-5 px-5">
                <div>
                    <h1 class="text-white"><?php the_title() ?></h1>
                    <h3 class="fs-5 text-muted mt-2 ss02"><?php echo $meta['opt-product-subtitle'] ?></h3>
                    <div class="symbol symbol-25px me-2 d-block mt-4">
                        <span class="symbol-label bg-info d-inline-flex">
                            <i class="bi bi-mouse3-fill fs-8 text-white"></i>
                        </span>
                        <?php if ($product->get_attribute('device')) : ?>
                            <span class="text-white ms-2"><?php echo str_replace(',', '،', $product->get_attribute('device')) ?></span>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="d-block d-lg-none mt-5">
            <?php get_template_part('templates/product/gift/header-card') ?>
        </div>
    </div>
    <div class="col-12 col-md-6 d-block d-lg-none">
        <p class="lh-xl mt-5 text-gray-700 ss02"><?php echo get_the_excerpt() ?></p>
        <div class="notice gift-notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
            <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
                    <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect>
                    <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect>
                </svg>
            </span>
            <div class="d-flex flex-stack flex-grow-1">
                <div class="fw-bold">
                    <h4 class="text-gray-900 fw-bolder"><?php echo $meta['opt-product-modal-form-warning-title'] ?></h4>
                    <div class="fs-6 text-gray-600 mt-2 ss02"><?php echo wpautop($meta['opt-product-modal-form-warning-content']) ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-none d-lg-flex row px-12 position-relative" style="margin-top: -160px">
    <div class="col-lg-5 col-xl-4">
        <?php get_template_part('templates/product/gift/header-card') ?>
    </div>
    <div class="col-lg-7 col-xl-8 mt-16">
        <h1 class="text-white"><?php the_title() ?></h1>
        <h3 class="fs-5 text-muted mt-2 ss02"><?php echo $meta['opt-product-subtitle'] ?></h3>
        <div class="symbol symbol-25px me-2 d-block mt-4">
            <span class="symbol-label bg-info d-inline-flex">
                <i class="bi bi-mouse3-fill fs-8 text-white"></i>
            </span>
            <?php if ($product->get_attribute('device')) : ?>
                <span class="text-white ms-2"><?php echo str_replace(',', '،', $product->get_attribute('device')) ?></span>
            <?php endif ?>
        </div>
        <p class="lh-xl pt-10 text-gray-700 ss02"><?php echo get_the_excerpt() ?></p>
        <div class="notice gift-notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
            <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
                    <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect>
                    <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect>
                </svg>
            </span>
            <div class="d-flex flex-stack flex-grow-1">
                <div class="fw-bold">
                    <h4 class="text-gray-900 fw-bolder"><?php echo $meta['opt-product-modal-form-warning-title'] ?></h4>
                    <div class="fs-6 text-gray-600 mt-2 ss02"><?php echo wpautop($meta['opt-product-modal-form-warning-content']) ?></div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-12">
        <div class="row">
            <div class="card">
                <div class="card-body px-2 py-5">
                    <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6">
                        <li class="nav-item">
                            <a class="brt nav-link active btn btn-flex btn-active-light-primary" data-bs-toggle="tab" href="#kt_tab_pane_4">
                                <span class="svg-icon svg-icon-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16">
                                        <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z" />
                                        <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                                    </svg>
                                </span>
                                <span class="d-flex flex-column align-items-start">
                                    <span class="fs-4 fw-bolder">توضیحات بازی</span>
                                    <span class="fs-7">Game Description</span>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="brt nav-link btn btn-flex btn-active-light-primary" data-bs-toggle="tab" href="#kt_tab_pane_5">
                                <span class="svg-icon svg-icon-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                                        <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                        <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z" />
                                    </svg>
                                </span>
                                <span class="d-flex flex-column align-items-start">
                                    <span class="fs-4 fw-bolder">نظرات</span>
                                    <span class="fs-7">Comments</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active px-2" id="kt_tab_pane_4" role="tabpanel" style="line-height: 2.7">
                            <div class="mt-xl-4 mt-lg-3 mt-md-2 mt-1 lh-xl text-gray-700 fs-6 ss02 img-rounded">
                                <?php the_content() ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_5" role="tabpanel">
                            <?php
                            get_template_part('templates/product/game/new-comment');
                            get_template_part('templates/product/game/comments');
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>