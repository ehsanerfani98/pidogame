<div class="aside-footer flex-column-auto pb-5 pb-lg-13" id="kt_aside_footer">
    <!--begin::Menu-->
    <div class="d-flex flex-center w-100 scroll-px" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-dismiss="click" title="شبکه های اجتماعی">
        <button type="button" class="btn btn-icon btn-custom w-50px h-50px" data-kt-menu-trigger="click" data-kt-menu-overflow="true" data-kt-menu-placement="top-start">
            <!--begin::Svg Icon-->
            <span class="svg-icon svg-icon-2 svg-icon-lg-1" style="color: white;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-share" viewBox="0 0 16 16">
                    <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </button>
        <!--begin::Menu 2-->
        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px" data-kt-menu="true">
            <!--begin::Menu item-->
            <div class="menu-item px-3">
                <div class="menu-content fs-6 text-dark fw-bolder px-3 py-4">شبکه های اجتماعی</div>
            </div>
            <!--end::Menu item-->
            <!--begin::Menu separator-->
            <div class="separator mb-3 opacity-75"></div>
            <!--end::Menu separator-->

            <?php
            $menu_name = 'setting-menu';
            $locations = get_nav_menu_locations();
            $menu = wp_get_nav_menu_object($locations[$menu_name]);
            $menuitems = wp_get_nav_menu_items($menu->term_id, array('order' => 'DESC'));
            foreach ($menuitems as $item) :
                if ($item->menu_item_parent == 0) :
            ?>
                    <div class="menu-item px-3">

                        <a href="<?= $item->url ?>" class="menu-link px-3">
                            <span class="svg-icon svg-icon-1 svg-icon-lg-2x svg-icon-<?= get_post_meta($item->ID, 'pidogame_framework_menu', true)['opt-menu-badge-color'] ?>" style="margin-left: 4px;">
                                <?= get_post_meta($item->ID, 'pidogame_framework_menu', true)['opt-menu-icon'] ?>
                            </span>
                            <?= $item->title ?>
                        </a>

                    </div>
                <?php endif; ?>
            <?php endforeach; ?>


        </div>
        <!--end::Menu 2-->
    </div>
    <!--end::Menu-->
</div>