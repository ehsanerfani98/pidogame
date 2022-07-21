<?php
$bodyClassArray = get_body_class();
$bodyClass = implode(' ', $bodyClassArray);
$templateDirectoryUri = get_template_directory_uri();
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