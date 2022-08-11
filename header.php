<?php
$bodyClassArray = get_body_class();
$bodyClass = implode(' ', $bodyClassArray);
$templateDirectoryUri = get_template_directory_uri();

$alert = get_option('pidogame_framework')['plswb_alert'];
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
</head>

<body id="kt_body" class="<?php echo $bodyClass ?> page-bg header-fixed header-tablet-and-mobile-fixed aside-enabled <?php if ($themeMode == 'dark') echo 'dark-mode' ?>">

    <?php if (!empty($alert)) : ?>
        <div class="alert alert-dismissible bg-danger d-flex flex-column flex-sm-row w-100 py-2 px-5" style="margin: 0;border-radius: 0;z-index: 114;">

            <span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.3" d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z" fill="black"></path>
                    <path d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z" fill="black"></path>
                </svg>
            </span>

            <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                <h4 class="mb-2 text-light"></h4>

                <h4 class="text-gray-200">
                    <?= $alert['at_title'] ?>
                </h4>
            </div>

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