<?php
$options = get_option('pidogame_framework');
if (is_user_logged_in()) :
    $currentUser = wp_get_current_user();
?>
