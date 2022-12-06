<div id="kt_header" class="header align-items-stretch d-flex flex-column mb-10 header-respons" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
    <div class="header-container px-4 d-flex align-items-center py-4" style="border-bottom-left-radius: unset; border-bottom-right-radius: unset;">
        <div class="d-flex topbar align-items-center d-lg-none ms-n2 me-3">
            <div class="btn btn-icon btn-color-gray-900 w-30px h-30px" id="kt_header_menu_mobile_toggle">
                <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
                        <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
                    </svg>
                </span>
            </div>
        </div>
        <?php get_template_part('templates/page/header/logo') ?>
        <div class="d-flex align-items-stretch justify-content-sm-between flex-lg-grow-1">
            <div class="menu menu-lg-rounded <!--menu-column--> menu-lg-row menu-state-bg menu-title-gray-700 menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch" id="#kt_header_menu" data-kt-menu="true">
                <?php
                $menu = headerMenuArray();
                foreach ($menu as $menuItem) :
                    if (empty($menuItem['children'])) : ?>
                        <div class="menu-item me-lg-1">
                <span class="menu-link py-3">
                    <a href="<?php echo $menuItem['url'] ?>">
                        <span class="menu-title ss02"><?php echo $menuItem['title'] ?></span>
                    </a>
                </span>
                        </div>
                    <?php else : ?>
                        <?php
                        $meta = get_post_meta($menuItem['ID'], 'pidogame_framework_menu', true);
                        if ($meta['opt-menu-mega']) : ?>
                            <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" class="menu-item menu-lg-down-accordion me-lg-1">
                    <span class="menu-link py-3">
                        <span class="menu-title ss02"><?php echo $menuItem['title'] ?></span>
                        <span class="menu-arrow d-lg-none"></span>
                    </span>
                                <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown w-100 w-lg-600px p-5 p-lg-5">
                                    <div class="row" data-kt-menu-dismiss="true">
                                        <?php
                                        $mod = count($menuItem['children']) % 3;
                                        if ($mod == 0) {
                                            $firstRow = count($menuItem['children']) / 3;
                                            $secondRow = count($menuItem['children']) / 3;
                                            $thirdRow = count($menuItem['children']) / 3;
                                        } elseif ($mod == 1) {
                                            $firstRow = intval(count($menuItem['children']) / 3) + 1;
                                            $secondRow = intval(count($menuItem['children']) / 3);
                                            $thirdRow = intval(count($menuItem['children']) / 3);
                                        } elseif ($mod == 2) {
                                            $firstRow = intval(count($menuItem['children']) / 3) + 1;
                                            $secondRow = intval(count($menuItem['children']) / 3) + 1;
                                            $thirdRow = intval(count($menuItem['children']) / 3);
                                        }
                                        ?>
                                        <div class="col-lg-4 border-left-lg-1">
                                            <div class="menu-inline menu-column menu-active-bg">
                                                <?php for ($i = 0; $i < $firstRow; $i++) : $thisMenuItem = array_values($menuItem['children'])[$i] ?>
                                                    <div class="menu-item">
                                                        <a href="<?php echo $thisMenuItem['url'] ?>" class="menu-link">
                                                            <?php $meta = get_post_meta($thisMenuItem['ID'], 'pidogame_framework_menu', true);
                                                            if (!empty($meta['opt-menu-icon'])) : ?>
                                                                <span class="menu-icon">
                                                        <span class="svg-icon svg-icon-2">
                                                            <?php echo $meta['opt-menu-icon'] ?>
                                                        </span>
                                                    </span>
                                                            <?php else : ?>
                                                                <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                            <?php endif ?>
                                                            <span class="menu-title ss02"><?php echo $thisMenuItem['title'] ?></span>
                                                            <?php $meta = get_post_meta($thisMenuItem['ID'], 'pidogame_framework_menu', true);
                                                            if ($meta['opt-menu-badge']) : ?>
                                                                <span class="badge badge-<?php echo $meta['opt-menu-badge-color'] ?>"><?php echo $meta['opt-menu-badge'] ?></span>
                                                            <?php endif ?>
                                                        </a>
                                                    </div>
                                                <?php endfor ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 border-left-lg-1">
                                            <div class="menu-inline menu-column menu-active-bg">
                                                <?php for ($i = $firstRow; $i < $firstRow + $secondRow; $i++) : $thisMenuItem = array_values($menuItem['children'])[$i] ?>
                                                    <div class="menu-item">
                                                        <a href="<?php echo $thisMenuItem['url'] ?>" class="menu-link">
                                                            <?php $meta = get_post_meta($thisMenuItem['ID'], 'pidogame_framework_menu', true);
                                                            if (!empty($meta['opt-menu-icon'])) : ?>
                                                                <span class="menu-icon">
                                                        <span class="svg-icon svg-icon-2">
                                                            <?php echo $meta['opt-menu-icon'] ?>
                                                        </span>
                                                    </span>
                                                            <?php else : ?>
                                                                <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                            <?php endif ?>
                                                            <span class="menu-title ss02"><?php echo $thisMenuItem['title'] ?></span>
                                                            <?php $meta = get_post_meta($thisMenuItem['ID'], 'pidogame_framework_menu', true);
                                                            if ($meta['opt-menu-badge']) : ?>
                                                                <span class="badge badge-<?php echo $meta['opt-menu-badge-color'] ?>"><?php echo $meta['opt-menu-badge'] ?></span>
                                                            <?php endif ?>
                                                        </a>
                                                    </div>
                                                <?php endfor ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 border-left-lg-1">
                                            <div class="menu-inline menu-column menu-active-bg">
                                                <?php for ($i = $firstRow + $secondRow; $i < $firstRow + $secondRow + $thirdRow; $i++) : $thisMenuItem = array_values($menuItem['children'])[$i] ?>
                                                    <div class="menu-item">
                                                        <a href="<?php echo $thisMenuItem['url'] ?>" class="menu-link">
                                                            <?php $meta = get_post_meta($thisMenuItem['ID'], 'pidogame_framework_menu', true);
                                                            if (!empty($meta['opt-menu-icon'])) : ?>
                                                                <span class="menu-icon">
                                                        <span class="svg-icon svg-icon-2">
                                                            <?php echo $meta['opt-menu-icon'] ?>
                                                        </span>
                                                    </span>
                                                            <?php else : ?>
                                                                <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                            <?php endif ?>
                                                            <span class="menu-title ss02"><?php echo $thisMenuItem['title'] ?></span>
                                                            <?php $meta = get_post_meta($thisMenuItem['ID'], 'pidogame_framework_menu', true);
                                                            if ($meta['opt-menu-badge']) : ?>
                                                                <span class="badge badge-<?php echo $meta['opt-menu-badge-color'] ?>"><?php echo $meta['opt-menu-badge'] ?></span>
                                                            <?php endif ?>
                                                        </a>
                                                    </div>
                                                <?php endfor ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php else : ?>
                            <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" class="menu-item menu-lg-down-accordion me-lg-1">
                    <span class="menu-link py-3">
                        <span class="menu-title ss02"><?php echo $menuItem['title'] ?></span>
                        <span class="menu-arrow d-lg-none"></span>
                    </span>
                                <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px">
                                    <?php foreach ($menuItem['children'] as $menuItem) : ?>
                                        <?php if (empty($menuItem['children'])) : ?>
                                            <div class="menu-item">
                                                <a class="menu-link py-3" href="<?php echo $menuItem['url'] ?>">
                                                    <?php $meta = get_post_meta($menuItem['ID'], 'pidogame_framework_menu', true);
                                                    if (!empty($meta['opt-menu-icon'])) : ?>
                                                        <span class="menu-icon">
                                                <span class="svg-icon svg-icon-2">
                                                    <?php echo $meta['opt-menu-icon'] ?>
                                                </span>
                                            </span>
                                                    <?php else : ?>
                                                        <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                                    <?php endif ?>
                                                    <span class="menu-title ss02"><?php echo $menuItem['title'] ?></span>
                                                    <?php $meta = get_post_meta($menuItem['ID'], 'pidogame_framework_menu', true);
                                                    if ($meta['opt-menu-badge']) : ?>
                                                        <span class="badge badge-<?php echo $meta['opt-menu-badge-color'] ?>"><?php echo $meta['opt-menu-badge'] ?></span>
                                                    <?php endif ?>
                                                </a>
                                            </div>
                                        <?php else : ?>
                                            <div data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-placement="left-start" class="menu-item menu-lg-down-accordion">
                                    <span class="menu-link py-3">
                                        <?php $meta = get_post_meta($menuItem['ID'], 'pidogame_framework_menu', true);
                                        if (!empty($meta['opt-menu-icon'])) : ?>
                                            <span class="menu-icon">
                                                <span class="svg-icon svg-icon-2">
                                                    <?php echo $meta['opt-menu-icon'] ?>
                                                </span>
                                            </span>
                                        <?php else : ?>
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                        <?php endif ?>
                                        <span class="menu-title ss02"><?php echo $menuItem['title'] ?></span>
                                        <?php $meta = get_post_meta($menuItem['ID'], 'pidogame_framework_menu', true);
                                        if ($meta['opt-menu-badge']) : ?>
                                            <span class="badge badge-<?php echo $meta['opt-menu-badge-color'] ?>"><?php echo $meta['opt-menu-badge'] ?></span>
                                        <?php endif ?>
                                        <span class="menu-arrow"></span>
                                    </span>
                                                <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg py-lg-4 w-lg-225px">
                                                    <?php foreach ($menuItem['children'] as $menuItem) : ?>
                                                        <div class="menu-item">
                                                            <a class="menu-link py-3" href="<?php echo $menuItem['url'] ?>">
                                                                <?php $meta = get_post_meta($menuItem['ID'], 'pidogame_framework_menu', true);
                                                                if (!empty($meta['opt-menu-icon'])) : ?>
                                                                    <span class="menu-icon">
                                                            <span class="svg-icon svg-icon-2">
                                                                <?php echo $meta['opt-menu-icon'] ?>
                                                            </span>
                                                        </span>
                                                                <?php else : ?>
                                                                    <span class="menu-bullet">
                                                            <span class="bullet bullet-dot"></span>
                                                        </span>
                                                                <?php endif ?>
                                                                <span class="menu-title ss02"><?php echo $menuItem['title'] ?></span>
                                                                <?php $meta = get_post_meta($menuItem['ID'], 'pidogame_framework_menu', true);
                                                                if ($meta['opt-menu-badge']) : ?>
                                                                    <span class="badge badge-<?php echo $meta['opt-menu-badge-color'] ?>"><?php echo $meta['opt-menu-badge'] ?></span>
                                                                <?php endif ?>
                                                            </a>
                                                        </div>
                                                    <?php endforeach ?>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        <?php endif ?>
                    <?php endif ?>
                <?php endforeach ?>

            </div>
            <div class="topbar d-flex align-items-stretch flex-shrink-0" style="margin-left: 35px">
                <?php get_template_part('templates/page/header/toolbar/toolbar') ?>
            </div>
        </div>
    </div>
    <div class="header-container container-xxl d-flex align-items-center">
        <div class="d-flex align-items-stretch" id="kt_header_nav">
            <div class="header-menu align-items-stretch h-lg-75px" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
                <?php get_template_part('templates/page/header/menu') ?>
            </div>
        </div>
    </div>
</div>
