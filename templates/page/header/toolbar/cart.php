<?php $options = get_option('pidogame_framework') ?>
<?php if ($options['opt-header-cart-switcher']) : ?>
    <div class="d-flex align-items-center ms-3 ms-lg-5">
        <a href="<?= home_url('cart') ?>" id="header-cart-btn11111111" class="btn btn-icon bg-secondary bg-opacity-75 bg-hover-opacity-100 btn-color-gray-900 w-30px h-30px w-md-40px h-md-40px position-relative" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-start">
            <span class="svg-icon svg-icon-1" id="wrap-cart-count">
                <?php if (WC()->cart->get_cart_contents_count() > 0) : ?>
                    <span id="header-cart-count" class="position-absolute top-0 start-0 translate-middle badge badge-circle badge-primary ss02 display-count-display"><?= count(WC()->cart->get_cart()) ?></span>
                <?php endif ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z" fill="currentColor" />
                    <path opacity="0.3" d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z" fill="currentColor" />
                    <path opacity="0.3" d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z" fill="currentColor" />
                </svg>
            </span>
        </a>
        <!-- <div id="header-cart-wrap" class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true">
            <div id="header-cart-loading" class="text-center py-10">
                <div class="spinner-border text-primary" role="status"></div>
                <span class="text-primary d-block mt-2">در حال بررسی...</span>
            </div>
        </div> -->
    </div>
<?php endif ?>