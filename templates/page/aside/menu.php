<div class="aside-menu flex-column-fluid pt-0 pb-5 py-lg-5" id="kt_aside_menu">
    <!--begin::Aside menu-->
    <div id="kt_aside_menu_wrapper" class="w-100 hover-scroll-overlay-y d-flex" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_search, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu" data-kt-scroll-offset="100px">
        <div id="kt_aside_menu" class="menu menu-column menu-title-gray-600 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-icon-gray-400 menu-arrow-gray-400 fw-bold fs-6 my-auto" data-kt-menu="true">

            <?php
            $menu_name = 'main-menu';
            $locations = get_nav_menu_locations();
            $menu = wp_get_nav_menu_object($locations[$menu_name]);
            $menuitems = wp_get_nav_menu_items($menu->term_id, array('order' => 'DESC'));
            foreach ($menuitems as $item) :
                if ($item->menu_item_parent == 0) :
            ?>
                    <div data-kt-menu-trigger="click" data-kt-menu-placement="right-start" class="menu-item py-3">
                        <span class="menu-link" title="<?= $item->title ?>" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-1 svg-icon-lg-2x">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M5 8.04999L11.8 11.95V19.85L5 15.85V8.04999Z" fill="currentColor" />
                                        <path d="M20.1 6.65L12.3 2.15C12 1.95 11.6 1.95 11.3 2.15L3.5 6.65C3.2 6.85 3 7.15 3 7.45V16.45C3 16.75 3.2 17.15 3.5 17.25L11.3 21.75C11.5 21.85 11.6 21.85 11.8 21.85C12 21.85 12.1 21.85 12.3 21.75L20.1 17.25C20.4 17.05 20.6 16.75 20.6 16.45V7.45C20.6 7.15 20.4 6.75 20.1 6.65ZM5 15.85V7.95L11.8 4.05L18.6 7.95L11.8 11.95V19.85L5 15.85Z" fill="currentColor" />
                                    </svg>
                                </span>
                            </span>
                        </span>
                        <div class="menu-sub menu-sub-dropdown w-225px w-lg-275px px-1 py-4">
                            <?php
                            foreach ($menuitems as $sub) : ?>
                                <?php if ($sub->menu_item_parent == $sub->ID) : ?>
                                    <?php if ($sub->menu_item_parent == $item->ID) : ?>
                                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                            <span class="menu-link">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title"><?= $sub->title ?></span>
                                                <span class="menu-arrow"></span>
                                            </span>
                                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                                <?php
                                                foreach ($menuitems as $sub2) : ?>
                                                    <?php if ($sub2->menu_item_parent == $sub->ID) : ?>
                                                        <div class="menu-item">
                                                            <a class="menu-link" href="/shop">
                                                                <span class="menu-bullet">
                                                                    <span class="bullet bullet-dot"></span>
                                                                </span>
                                                                <span class="menu-title"><?= $sub2->title ?></span>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <div class="menu-item">
                                        <a class="menu-link" href="/rules">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title"><?= $sub->title ?></span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>

                        </div>
                    </div>
            <?php
                endif;

            endforeach; ?>

        </div>
    </div>
</div>