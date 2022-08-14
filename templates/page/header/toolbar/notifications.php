<?php $options = get_option('pidogame_framework');
if ($options['opt-header-notifications-switcher']) :
    $importantCounter = 0;
    $args = array(
        'post_type'         =>  'notifications',
        'posts_per_page'    =>  $options['opt-header-notifications-number']
    );
    $theQuery = new WP_Query($args);
    if ($theQuery->have_posts()) {
        while ($theQuery->have_posts()) {
            $theQuery->the_post();
            $meta = get_post_meta(get_the_ID(), 'pidogame_framework_notifications', true);
            if ($meta['opt-notifications-important'] == true) $importantCounter++;
        }
    }
?>
    <div class="d-flex align-items-center ms-3 ms-lg-5">
        <div class="btn btn-icon bg-secondary bg-opacity-75 bg-hover-opacity-100 btn-color-gray-900 w-30px h-30px w-md-40px h-md-40px position-relative pulse  pulse-danger" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-start">
            <span class="svg-icon svg-icon-1">
                <?php if ($importantCounter > 0) : ?>
                    <span class="position-absolute top-0 start-0 translate-middle badge badge-circle badge-warning ss02"><?php echo $importantCounter ?></span>
                <?php endif ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.3" d="M12 22C13.6569 22 15 20.6569 15 19C15 17.3431 13.6569 16 12 16C10.3431 16 9 17.3431 9 19C9 20.6569 10.3431 22 12 22Z" fill="black" />
                    <path d="M19 15V18C19 18.6 18.6 19 18 19H6C5.4 19 5 18.6 5 18V15C6.1 15 7 14.1 7 13V10C7 7.6 8.7 5.6 11 5.1V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V5.1C15.3 5.6 17 7.6 17 10V13C17 14.1 17.9 15 19 15ZM11 10C11 9.4 11.4 9 12 9C12.6 9 13 8.6 13 8C13 7.4 12.6 7 12 7C10.3 7 9 8.3 9 10C9 10.6 9.4 11 10 11C10.6 11 11 10.6 11 10Z" fill="black" />
                </svg>
            </span>
            <span class="pulse-ring border-5" ></span>
        </div>
        <div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true">
            <div class="d-flex flex-column bgi-no-repeat rounded-top" style="background-image:url('<?php echo $options['opt-header-notifications-header-image']['url'] ?>')">
                <h3 class="text-white fw-bold px-9 mt-10 mb-6"><?php echo $options['opt-header-notifications-title'] ?>
                    <?php if ($importantCounter > 0) : ?>
                        <span class="fs-8 opacity-75 ps-3 ss02"><?php echo $importantCounter ?> مورد مهم</span>
                    <?php endif ?>
                </h3>
                <ul class="nav nav-line-tabs nav-line-tabs-2x nav-stretch fw-semibold px-9" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-white opacity-75 opacity-state-100 pb-4 active" data-bs-toggle="tab" href="#public-alert" aria-selected="true" role="tab">عمومی</a>
                    </li>
                    <?php if (is_user_logged_in()) : ?>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-white opacity-75 opacity-state-100 pb-4" data-bs-toggle="tab" href="#private-alert" aria-selected="false" role="tab" tabindex="-1">خصوصی</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade active show" id="public-alert" role="tabpanel">
                    <?php if ($theQuery->have_posts()) : ?>
                        <div class="scroll-y mh-325px my-5 px-8">
                            <?php while ($theQuery->have_posts()) : $theQuery->the_post();
                                $meta = get_post_meta(get_the_ID(), 'pidogame_framework_notifications', true) ?>
                                <div class="d-flex flex-stack py-4">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-35px me-4">
                                            <span class="symbol-label bg-light-<?php echo $meta['opt-notifications-color'] ?>">
                                                <span class="svg-icon svg-icon-2 svg-icon-<?php echo $meta['opt-notifications-color'] ?>">
                                                    <?php echo $meta['opt-notifications-icon'] ?>
                                                </span>
                                            </span>
                                        </div>
                                        <div class="mb-0 me-2">
                                            <a role="button" class="fs-6 text-gray-800 text-hover-primary fw-bolder" data-bs-toggle="modal" data-bs-target="#kt_notification_modal" data-bs-notification-id="<?php echo get_the_ID() ?>"><?php the_title() ?></a>
                                            <?php if ($meta['opt-notifications-important'] == true) : ?>
                                                <span class="svg-icon svg-icon-primary svg-icon-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                        <path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="#00A3FF" />
                                                        <path class="permanent" d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white" />
                                                    </svg>
                                                </span>
                                            <?php endif ?>
                                            <div class="text-gray-400 fs-7"><?php echo $meta['opt-notifications-subtitle'] ?></div>
                                        </div>
                                    </div>
                                    <span class="badge badge-light fs-8 ss02"><?php the_time() ?></span>
                                </div>
                            <?php endwhile;
                            wp_reset_postdata() ?>
                        </div>
                        <?php if ($options['opt-header-notifications-link']['url']) : ?>
                            <div class="py-3 text-center border-top">
                                <a target="<?php echo $options['opt-header-notifications-link']['target'] ?>" href="<?php echo $options['opt-header-notifications-link']['url'] ?>" class="btn btn-color-gray-600 btn-active-color-primary"><?php echo $options['opt-header-notifications-link']['text'] ?>
                                    <span class="svg-icon svg-icon-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="currentColor" />
                                            <path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        <?php endif ?>
                    <?php else : ?>
                        <div class="d-flex flex-column px-9">
                            <div class="pt-10 pb-0">
                                <h3 class="text-dark text-center fw-bolder"><?php echo $options['opt-header-notifications-empty-title'] ?></h3>
                                <div class="text-center text-gray-600 fw-bold pt-1"><?php echo $options['opt-header-notifications-empty-subtitle'] ?></div>
                            </div>
                            <div class="text-center px-4 mt-4">
                                <img class="mw-100 mh-200px" alt="<?php echo $options['opt-header-notifications-empty-image']['alt'] ?>" src="<?php echo $options['opt-header-notifications-empty-image']['url'] ?>">
                            </div>
                        </div>
                    <?php endif ?>
                </div>
                <?php if (is_user_logged_in()) : ?>
                    <div class="tab-pane fade show" id="private-alert" role="tabpanel">
                        <div class="scroll-y mh-325px my-5 px-8">
                            <?php


                            foreach (get_all_order() as $order_id) {

                                $customer_notes = wc_get_order_notes([
                                    'order_id' => $order_id,
                                    'type' => 'customer',
                                ]);
                                if ($customer_notes) {
                                    $notes[$order_id] = $customer_notes;
                                }
                            }

                            $i = 0;
                            foreach ($notes as $key => $values) {
                                foreach ($values as $item) {
                                        $new_notes[] = [
                                            "id" => $item->id,
                                            "date" => ((array)$item->date_created)['date'],
                                            "content" => " شماره سفارش $key | " . $item->content
                                        ];
                                }
                            }

                            usort($new_notes, function ($v1, $v2) {
                                return $v2['id'] <=> $v1['id'];
                            });

                            ?>

                            <?php foreach ($new_notes as $note) : ?>
                            <?php if ($i < 5) : ?>
                                <div class="d-flex flex-stack py-4">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-35px me-4">
                                            <span class="symbol-label bg-light-primary">
                                                <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM14.5 4.5C10.4 4.5 7 7.9 7 12C7 16.1 10.4 19.5 14.5 19.5C18.6 19.5 22 16.1 22 12C22 7.9 18.6 4.5 14.5 4.5Z" fill="black" />
                                                        <path opacity="0.3" d="M22 12C22 16.1 18.6 19.5 14.5 19.5C10.4 19.5 7 16.1 7 12C7 7.9 10.4 4.5 14.5 4.5C18.6 4.5 22 7.9 22 12ZM12 7C9.2 7 7 9.2 7 12C7 14.8 9.2 17 12 17C14.8 17 17 14.8 17 12C17 9.2 14.8 7 12 7Z" fill="black" />
                                                    </svg>
                                                </span>
                                            </span>
                                        </div>
                                        <div class="mb-0 me-2">
                                            <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold"><?= $note['content'] ?></a>
                                        </div>
                                    </div>
                                    <span class="badge badge-light fs-8"><?= wp_date('F j, Y - g:i A', strtotime($note['date'])) ?></span>
                                </div>
                            <?php endif; ?>
                            <?php $i++; ?>
                            <?php endforeach; ?>

                        </div>
                        <div class="py-3 text-center border-top">
                            <a target="" href="<?= home_url('my-account/alerts/') ?>" class="btn btn-color-gray-600 btn-active-color-primary">مشاهده همه <span class="svg-icon svg-icon-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="currentColor"></rect>
                                        <path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif ?>