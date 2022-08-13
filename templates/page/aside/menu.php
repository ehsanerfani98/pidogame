<div class="aside-menu flex-column-fluid pt-0 pb-5 py-lg-5" id="kt_aside_menu">
    <!--begin::Aside menu-->
    <div id="kt_aside_menu_wrapper" class="w-100 hover-scroll-overlay-y d-flex" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_search, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu" data-kt-scroll-offset="100px">
        <div id="kt_aside_menu" class="menu menu-column menu-title-gray-600 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-icon-gray-400 menu-arrow-gray-400 fw-bold fs-6 my-auto" data-kt-menu="true">

            <?php
            $menu_name = 'main-menu';
            $locations = get_nav_menu_locations();
            $menu = wp_get_nav_menu_object($locations[$menu_name]);
            $menuitems = wp_get_nav_menu_items($menu->term_id, array('order' => 'DESC'));
            foreach ($menuitems as $arr) {
                $parent_ids[] = $arr->menu_item_parent;
            }
            foreach ($menuitems as $item) :
                if ($item->menu_item_parent == 0) :
            ?>
                    <div data-kt-menu-trigger="click" data-kt-menu-placement="right-start" class="menu-item py-3">
                        <span class="menu-link" title="<?= $item->title ?>" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-1 svg-icon-lg-2x svg-icon-<?= get_post_meta( $item->ID, 'pidogame_framework_menu', true )['opt-menu-badge-color'] ?>">
                                <?= get_post_meta( $item->ID, 'pidogame_framework_menu', true )['opt-menu-icon'] ?>

                                </span>
                            </span>
                        </span>
                        <div class="menu-sub menu-sub-dropdown w-225px w-lg-275px px-1 py-4">
                            <?php
                            foreach ($menuitems as $sub) : ?>
                                <?php if (in_array($sub->ID, $parent_ids)) : ?>
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
                                                            <a class="menu-link" href="<?= $sub2->url ?>">
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
                                <?php elseif($sub->menu_item_parent == $item->ID) : ?>
                                    <div class="menu-item">
                                        <a class="menu-link" href="<?= $sub->url ?>">
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