<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch" id="#kt_header_menu" data-kt-menu="true">
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