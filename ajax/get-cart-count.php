<?php
require_once("../../../../wp-load.php");

print WC()->cart->get_cart_contents_count();