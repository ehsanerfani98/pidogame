<?php
require_once("../../../../wp-load.php");

$productId = $_POST['productId'];
foreach (WC()->cart->get_cart() as $cartItemKey => $cartItem) {
    if ($cartItem['product_id'] == $productId) {
        WC()->cart->remove_cart_item($cartItemKey);
    }
}
