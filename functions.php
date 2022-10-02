<?php

require_once get_theme_file_path() . '/codestar/codestar-framework.php';
require_once get_theme_file_path() . '/options.php';
require_once get_theme_file_path() . '/plswb-code.php';



function mytheme_add_woocommerce_support()
{
	add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'mytheme_add_woocommerce_support');