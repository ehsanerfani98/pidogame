<?php
$options = get_option('pidogame_framework');
if (is_user_logged_in()) :
    $currentUser = wp_get_current_user();
?>
    <div class="d-flex align-items-center ms-3 ms-lg-5" id="kt_header_user_menu_toggle">
        <div class="btn btn-icon w-30px h-30px w-md-40px h-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-start">
            <img class="h-100 w-100 rounded" src="<?php echo get_avatar_url($currentUser->ID) ?>" />
        </div>
        <div class=" menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
            <div class="menu-item px-3">
                <div class="menu-content d-flex align-items-center px-3">
                    <div class="symbol symbol-50px me-5">
                        <img src="<?php echo get_avatar_url($currentUser->ID) ?>" />
                    </div>
                    <div class="d-flex flex-column">
                        <div class="fw-bolder d-flex align-items-center fs-5">
                            <?php echo $currentUser->display_name ?>
                            <span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2 ss02"><?php
                            foreach (get_option( 'avans_plugin_setting' )['avans_user_levels'] as $key => $value) {
                                var_dump(do_shortcode( '[avans-user-score]', ignore_html ));
                                if($value['min_score'] == do_shortcode( '[avans-user-score]', ignore_html )){
                                    echo $value['level'];
                                }
                                }
                             ?></span>
                        </div>
                        <a class="fw-bold text-muted fs-7"><?php echo $currentUser->user_email ?></a>
                    </div>
                </div>
            </div>
            <div class="separator my-2"></div>
            <?php if (has_nav_menu('header-user-first')) headerFirstUserMenu() ?>
            <div class="separator my-2"></div>
            <?php
            if(function_exists('woo_wallet')):
            ?>
                <div class="menu-item px-5 mb-1">
                    <a target="_blank" href="<?= home_url( 'my-account/woo-wallet/' ) ?>" class="menu-link px-5">
                        <span class="menu-title position-relative"><?php echo $options['opt-header-user-wallet-link']['text'] ?>
                            <span class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0 ss02">
                            <?= woo_wallet()->wallet->get_wallet_balance(get_current_user_id()) ?>
                                <img class="w-15px h-15px rounded-1 ms-2" src="<?php echo get_template_directory_uri() ?>/assets/media/flags/iran.svg" />
                            </span>
                        </span>
                    </a>
                </div>
            <?php endif;  ?>
            <?php if (has_nav_menu('header-user-second')) headerSecondUserMenu() ?>
            <?php if ($options['opt-header-user-theme-switcher']) : ?>
                <div class="separator my-2"></div>
                <div class="menu-item px-5">
                    <div class="menu-content px-5">
                        <label class="form-check form-switch form-check-custom form-check-solid pulse pulse-success" for="kt_user_menu_dark_mode_toggle">
                            <input class="form-check-input w-30px h-20px" type="checkbox" value="1" name="mode" id="kt_user_menu_dark_mode_toggle" <?php if (getThemeMode() == 'dark') echo 'checked="checked"' ?> />
                            <span class="pulse-ring ms-n1"></span>
                            <span class="form-check-label text-gray-600 fs-7"><?php echo $options['opt-header-user-theme-label'] ?></span>
                        </label>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
<?php else : ?>
    <div class="d-none d-md-flex align-items-center">
        <a target="<?php echo $options['opt-header-user-login-link']['target'] ?>" href="<?php echo $options['opt-header-user-login-link']['url'] ?>" class="btn btn-secondary ms-5"><?php echo $options['opt-header-user-login-link']['text'] ?></a>
        <a target="<?php echo $options['opt-header-user-sign-up-link']['target'] ?>" href="<?php echo $options['opt-header-user-sign-up-link']['url'] ?>" class="btn btn-primary ms-2"><?php echo $options['opt-header-user-sign-up-link']['text'] ?></a>
    </div>
    <div class="d-flex d-md-none align-items-center ms-3">
        <a class="btn btn-icon bg-secondary bg-opacity-75 bg-hover-opacity-100 btn-color-gray-900 w-30px h-30px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-start" data-kt-menu-flip="bottom">
            <span class="svg-icon svg-icon-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="currentColor" />
                    <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="currentColor" />
                </svg>
            </span>
        </a>
        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-muted menu-active-bg menu-state-primary fw-bold py-4 fs-6 w-150px" data-kt-menu="true">
            <div class="menu-item px-3 my-1">
                <a target="<?php echo $options['opt-header-user-login-link']['target'] ?>" href="<?php echo $options['opt-header-user-login-link']['url'] ?>" class="menu-link px-3">
                    <span class="menu-icon">
                        <i class="las la-user fs-1"></i>
                    </span>
                    <span class="menu-title"><?php echo $options['opt-header-user-login-link']['text'] ?></span>
                </a>
            </div>
            <div class="menu-item px-3 my-1">
                <a target="<?php echo $options['opt-header-user-sign-up-link']['target'] ?>" href="<?php echo $options['opt-header-user-sign-up-link']['url'] ?>" class="menu-link px-3">
                    <span class="menu-icon">
                        <i class="las la-user-plus fs-1"></i>
                    </span>
                    <span class="menu-title"><?php echo $options['opt-header-user-sign-up-link']['text'] ?></span>
                </a>
            </div>
        </div>
    </div>
<?php endif ?>