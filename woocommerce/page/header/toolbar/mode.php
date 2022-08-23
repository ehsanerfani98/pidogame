<?php $options = get_option('pidogame_framework') ?>
<?php if ($options['opt-header-mode-switcher']) : ?>
<div class="d-flex align-items-center ms-3 ms-lg-5">
    <a class="btn btn-icon bg-secondary bg-opacity-75 bg-hover-opacity-100 btn-color-gray-900 w-30px h-30px w-md-40px h-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
        <i class="theme-mode-light-icon fonticon-sun fs-2 <?php if (getThemeMode() == 'dark') echo 'd-none' ?>"></i>
        <i class="theme-mode-dark-icon fonticon-moon fs-2 <?php if (getThemeMode() == 'light') echo 'd-none' ?>"></i>
    </a>
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-muted menu-active-bg menu-state-primary fw-bold py-4 fs-6 w-200px" data-kt-menu="true">
        <div class="menu-item px-3 my-1">
            <a class="theme-mode-light-btn menu-link px-3 <?php if (getThemeMode() == 'light') echo 'active' ?>">
                <span class="menu-icon">
                    <i class="fonticon-sun fs-2"></i>
                </span>
                <span class="menu-title">پوسته روشن</span>
            </a>
        </div>
        <div class="menu-item px-3 my-1">
            <a class="theme-mode-dark-btn menu-link px-3 <?php if (getThemeMode() == 'dark') echo 'active' ?>">
                <span class="menu-icon">
                    <i class="fonticon-moon fs-2"></i>
                </span>
                <span class="menu-title">پوسته تاریک</span>
            </a>
        </div>
    </div>
</div>
<?php endif ?>