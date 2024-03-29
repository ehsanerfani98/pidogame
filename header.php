<?php
$bodyClassArray = get_body_class();
$bodyClass = implode(' ', $bodyClassArray);
$templateDirectoryUri = get_template_directory_uri();

$alert = get_option('pidogame_framework')['at_title'];
$data_alert = get_option('pidogame_framework');
?>

<!DOCTYPE html>
<html direction="rtl" dir="rtl" style="direction: rtl">

<head lang="<?php echo get_locale() ?>">
    <title><?php wp_title() ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- <link rel="shortcut icon" href="/assets/media/logos/favicon.ico" /> -->
    <link href="<?php echo $templateDirectoryUri ?>/assets/custom/css/iransansx.min.css" rel="stylesheet" type="text/css" />
    <?php switch (getThemeMode()) {
        case 'light':
            echo "<link href='{$templateDirectoryUri}/assets/plugins/global/plugins.bundle.rtl.css' rel='stylesheet' type='text/css' />";
            echo "<link href='{$templateDirectoryUri}/assets/css/style.bundle.rtl.css' rel='stylesheet' type='text/css' />";
            break;
        case 'dark':
            echo "<link href='{$templateDirectoryUri}/assets/plugins/global/plugins.dark.bundle.rtl.css' rel='stylesheet' type='text/css' />";
            echo "<link href='{$templateDirectoryUri}/assets/css/style.dark.bundle.rtl.css' rel='stylesheet' type='text/css' />";
            break;
        default:
            echo "<link href='{$templateDirectoryUri}/assets/plugins/global/plugins.bundle.rtl.css' rel='stylesheet' type='text/css' />";
            echo "<link href='{$templateDirectoryUri}/assets/css/style.bundle.rtl.css' rel='stylesheet' type='text/css' />";
            break;
    } ?>

    <link href="<?php echo $templateDirectoryUri ?>/assets/custom/css/style.bundle.css" rel="stylesheet" type="text/css" />

    <?php wp_head() ?>
    <style>
        .bg-plswb {
            background: <?= $data_alert['at_image'] ?> !important;
        }
    </style>
</head>

<body id="kt_body" class="<?php echo $bodyClass ?> page-bg header-fixed header-tablet-and-mobile-fixed aside-enabled <?php if ($themeMode == 'dark') echo 'dark-mode' ?>">

    <?php if (!empty($alert)) : ?>
        <div class="alert alert-dismissible bg-plswb d-flex flex-column flex-sm-row w-100 py-2 px-5 align-items-center" style="margin: 0;border-radius: 0;z-index: 114;">


            <span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.3" d="M14.1 15.013C14.6 16.313 14.5 17.813 13.7 19.113C12.3 21.513 9.29999 22.313 6.89999 20.913C5.29999 20.013 4.39999 18.313 4.39999 16.613C5.09999 17.013 5.99999 17.313 6.89999 17.313C8.39999 17.313 9.69998 16.613 10.7 15.613C11.1 15.713 11.5 15.813 11.9 15.813C12.7 15.813 13.5 15.513 14.1 15.013ZM8.5 12.913C8.5 12.713 8.39999 12.513 8.39999 12.313C8.39999 11.213 8.89998 10.213 9.69998 9.613C9.19998 8.313 9.30001 6.813 10.1 5.513C10.6 4.713 11.2 4.11299 11.9 3.71299C10.4 2.81299 8.49999 2.71299 6.89999 3.71299C4.49999 5.11299 3.70001 8.113 5.10001 10.513C5.80001 11.813 7.1 12.613 8.5 12.913ZM16.9 7.313C15.4 7.313 14.1 8.013 13.1 9.013C14.3 9.413 15.1 10.513 15.3 11.713C16.7 12.013 17.9 12.813 18.7 14.113C19.2 14.913 19.3 15.713 19.3 16.613C20.8 15.713 21.8 14.113 21.8 12.313C21.9 9.513 19.7 7.313 16.9 7.313Z" fill="black" />
                    <path d="M9.69998 9.61307C9.19998 8.31307 9.30001 6.81306 10.1 5.51306C11.5 3.11306 14.5 2.31306 16.9 3.71306C18.5 4.61306 19.4 6.31306 19.4 8.01306C18.7 7.61306 17.8 7.31306 16.9 7.31306C15.4 7.31306 14.1 8.01306 13.1 9.01306C12.7 8.91306 12.3 8.81306 11.9 8.81306C11.1 8.81306 10.3 9.11307 9.69998 9.61307ZM8.5 12.9131C7.1 12.6131 5.90001 11.8131 5.10001 10.5131C4.60001 9.71306 4.5 8.91306 4.5 8.01306C3 8.91306 2 10.5131 2 12.3131C2 15.1131 4.2 17.3131 7 17.3131C8.5 17.3131 9.79999 16.6131 10.8 15.6131C9.49999 15.1131 8.7 14.1131 8.5 12.9131ZM18.7 14.1131C17.9 12.8131 16.7 12.0131 15.3 11.7131C15.3 11.9131 15.4 12.1131 15.4 12.3131C15.4 13.4131 14.9 14.4131 14.1 15.0131C14.6 16.3131 14.5 17.8131 13.7 19.1131C13.2 19.9131 12.6 20.5131 11.9 20.9131C13.4 21.8131 15.3 21.9131 16.9 20.9131C19.3 19.6131 20.1 16.5131 18.7 14.1131Z" fill="black" />
                </svg></span>

            <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                <h4 class="mb-2 text-light"></h4>

                <h4 class="text-gray-100" style="font-size: 14px; line-height: 2;">
                    <?= $data_alert['at_title'] ?>
                </h4>
            </div>
            <?php if (!empty($data_alert['at_link']['url'])) : ?>
                <a target="<?= $data_alert['at_link']['target'] ?>" href="<?= $data_alert['at_link']['url'] ?>" class="btn btn-light" style="padding: 0.5rem 1rem; height: 32px;">مشاهده</a>
            <?php endif; ?>
            <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                <span class="svg-icon svg-icon-2x svg-icon-light">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
                    </svg>
                </span>
            </button>
        </div>
    <?php endif; ?>