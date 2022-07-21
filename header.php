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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/assets/plugins/custom/Iris/src/iris.js"></script>

    <?php wp_head() ?>
</head>

<body id="kt_body" class="<?php echo $bodyClass ?> page-bg header-fixed header-tablet-and-mobile-fixed aside-enabled <?php if ($themeMode == 'dark') echo 'dark-mode' ?>">