<?php
require_once("../../../../wp-load.php");

$type = $_POST['type'];
$productId = $_POST['productId'];
$content = $_POST['content'];
$rating = $_POST['rating'];
$userId = $_POST['userId'];
if ($_POST['replyId']) $parent = $_POST['replyId'];
else $parent = 0;

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

if ($type == 'user') {
    $user = new WP_User($userId);
    $displayName = $user->display_name;
    $email = $user->user_email;
} elseif ($type == 'guest') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $displayName = $firstName . ' ' . $lastName;
}

$commentId = wp_insert_comment(array(
    'comment_post_ID'       =>  $productId,
    'comment_author'        =>  $displayName,
    'comment_author_email'  =>  $email,
    'comment_content'       =>  $content,
    'comment_type'          =>  'review',
    'comment_parent'        =>  $parent,
    'user_id'               =>  $userId,
    'comment_author_IP'     =>  $ip,
    'comment_approved'      =>  0,
));

if ($commentId) update_comment_meta($commentId, 'rating', $rating);
