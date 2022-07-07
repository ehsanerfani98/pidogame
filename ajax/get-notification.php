<?php
require_once("../../../../wp-load.php");

$post = get_post($_POST['id']);
$meta = get_post_meta($_POST['id'], 'pidogame_framework_notifications', true);
$array = array(
    'title'     =>  get_the_title($post),
    'content'   =>  wpautop($post->post_content),
    'date'      =>  get_the_date('', $post),
    'important' =>  $meta['opt-notifications-important']
);

print json_encode($array);
