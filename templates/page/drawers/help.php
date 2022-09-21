<div id="kt_help" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="help" data-kt-drawer-activate="true" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'350px', 'md': '525px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_help_toggle" data-kt-drawer-close="#kt_help_close">
    <!--begin::Card-->
    <div class="card shadow-none rounded-0 w-100">
        <!--begin::Header-->
        <div class="card-header" id="kt_help_header">
            <h5 class="card-title fw-bold text-gray-600"><?= get_option('pidogame_framework')['help_title_menu_opened'] ?></h5>
            <div class="card-toolbar">
                <button type="button" class="btn btn-sm btn-icon explore-btn-dismiss me-n5" id="kt_help_close">
                    <!--begin::Svg Icon-->
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </button>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body" id="kt_help_body">
            <!--begin::Content-->
            <div id="kt_help_scroll" class="hover-scroll-overlay-y" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-wrappers="#kt_help_body" data-kt-scroll-dependencies="#kt_help_header" data-kt-scroll-offset="5px">


                <?php if (get_option('pidogame_framework')['help_item_wrap']) : ?>
                    <?php foreach (get_option('pidogame_framework')['help_item_wrap'] as $item) :

                        switch ($item['help_color_icon']) {
                            case 'warning':
                                $bg = 'bg-light-warning';
                                $fc = 'svg-icon-warning';
                                break;

                            case 'primary':
                                $bg = 'bg-light-primary';
                                $fc = 'svg-icon-primary';
                                break;

                            case 'info':
                                $bg = 'bg-light-info';
                                $fc = 'svg-icon-info';
                                break;

                            case 'success':
                                $bg = 'bg-light-success';
                                $fc = 'svg-icon-success';
                                break;

                            case 'danger':
                                $bg = 'bg-light-danger';
                                $fc = 'svg-icon-danger';
                                break;

                            default:
                                # code...
                                break;
                        }


                    ?>
                        <div class="d-flex align-items-center mb-7">
                            <!--begin::Icon-->
                            <div class="d-flex flex-center w-50px h-50px w-lg-75px h-lg-75px flex-shrink-0 rounded <?= $bg ?>">
                                <!--begin::Svg Icon-->
                                <span class="svg-icon <?= $fc ?> svg-icon-2x svg-icon-lg-3x">
                                    <i class="<?= $fc ?> <?= $item['help_icon_code'] ?>"></i>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Icon-->
                            <!--begin::Info-->
                            <div class="d-flex flex-stack flex-grow-1 ms-4 ms-lg-6">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column me-2 me-lg-5">
                                    <!--begin::Title-->
                                    <a href="<?= $item['help_link']['url'] ?>" class="text-dark text-hover-primary fw-bolder fs-6 fs-lg-4 mb-1"><?= $item['help_title'] ?></a>
                                    <!--end::Title-->
                                    <!--begin::Description-->
                                    <div class="text-muted fw-bold fs-7 fs-lg-6"><?= $item['help_content'] ?></div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Svg Icon-->
                                <span class="svg-icon svg-icon-gray-400 svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="black" />
                                        <path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Info-->
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <!--end::Content-->
            <?php if (get_option('pidogame_framework')['faq_title']) : ?>
                <div class="row" style="margin-top: -1.5rem;">
                    <a href="<?= get_option('pidogame_framework')['faq_link']['url'] ?>" class="btn btn-block btn-primary"><?= get_option('pidogame_framework')['faq_title'] ?></a>
                </div>
            <?php endif; ?>

        </div>
        <!--end::Body-->
    </div>
    <!--end::Card-->
</div>