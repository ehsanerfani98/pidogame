<?php
global $product;
$args = array(
    'post_type'     =>  'product',
    'post_id'       =>  $product->id,
    'status'        =>  "approve"
);
$comments = get_comments($args);

function ifCommentIsBuyer($comment, $product)
{
    $bought = false;
    $customerOrders = get_posts(array(
        'numberposts'   =>  -1,
        'meta_key'      =>  '_customer_user',
        'meta_value'    =>  $comment->user_id,
        'post_type'     =>  'shop_order',
        'post_status'   =>  'wc-completed'
    ));
    foreach ($customerOrders as $customerOrder) {
        $order = wc_get_order($customerOrder);
        foreach ($order->get_items() as $item) {
            $productId = $item['product_id'];
            if ($productId == $product->id) $bought = true;
        }
    }
    return $bought;
}

function echoFirstLevelComment($comment)
{ ?>
    <div class="border rounded p-2 p-lg-6 mb-5" id="comment-<?php echo $comment->comment_ID ?>">
        <div class="mb-0">
            <div class="d-flex flex-stack flex-wrap mb-5">
                <div class="d-flex align-items-center py-1">
                    <div class="symbol symbol-35px me-2">
                        <?php echo get_avatar($comment) ?>
                    </div>
                    <div class="d-flex flex-column align-items-start justify-content-center">
                        <span class="text-gray-800 fs-7 fw-bold lh-1 mb-2">
                            <span class="comment-author">
                                <?php echo $comment->comment_author ?>
                            </span>
                            <?php if (user_can($comment->user_id, 'manage_options')) : ?>
                                <span class="badge badge-light-success ms-1">پشتیبانی پیدوگیم</span>
                            <?php else : ?>
                                <?php global $product; ?>
                                <?php if (ifCommentIsBuyer($comment, $product)) : ?>
                                    <span class="badge badge-light-primary ms-1">خریدار محصول</span>
                                <?php endif ?>
                            <?php endif ?>
                        </span>
                        <span class="text-muted fs-8 fw-bold lh-1 ss02"><?php comment_date('', $comment) ?></span>
                    </div>
                </div>
                <div class="d-flex align-items-center py-1">
                    <div class="rating me-2">
                        <?php $rating = get_comment_meta($comment->comment_ID, 'rating', true) ?>
                        <?php if ($rating > 0) : ?>
                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                <div class="rating-label <?php if ($i <= $rating) echo 'checked' ?>">
                                    <span class="svg-icon svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                </div>
                            <?php endfor ?>
                        <?php endif ?>
                    </div>
                    <a data-reply-id="<?php echo $comment->comment_ID ?>" href="#comment" class="reply-comment btn btn-sm btn-flex btn-color-gray-500 btn-active-light me-1" data-kt-scroll-toggle>پاسخ</a>
                </div>
            </div>
            <div class="comment-content fs-5 fw-normal text-gray-800"><?php echo $comment->comment_content ?></div>
        </div>
        <div class="ps-10 mb-0"></div>
    </div>
<?php }

function echoChildrenComment($comment)
{ ?>
    <?php foreach ($comment->get_children() as $comment) : ?>
        <div class="border-dashed border-primary rounded p-2 p-lg-6 mb-5 ms-5 ms-lg-10 bg-gray-100" id="comment-<?php echo $comment->comment_ID ?>">
            <div class="mb-0">
                <div class="d-flex flex-stack flex-wrap mb-5">
                    <div class="d-flex align-items-center py-1">
                        <div class="symbol symbol-35px me-2">
                            <?php echo get_avatar($comment) ?>
                        </div>
                        <div class="d-flex flex-column align-items-start justify-content-center">
                            <span class="text-gray-800 fs-7 fw-bold lh-1 mb-2">
                                <span class="comment-author">
                                    <?php echo $comment->comment_author ?>
                                </span>
                                <?php if (user_can($comment->user_id, 'manage_options')) : ?>
                                    <span class="badge badge-light-success ms-1">پشتیبانی پیدوگیم</span>
                                <?php else : ?>
                                    <?php global $product; ?>
                                    <?php if (ifCommentIsBuyer($comment, $product)) : ?>
                                        <span class="badge badge-light-primary ms-1">خریدار محصول</span>
                                    <?php endif ?>
                                <?php endif ?>
                                در پاسخ به <a href="#comment-<?php echo $comment->comment_parent ?>" data-kt-scroll-toggle><?php echo get_comment_author($comment->comment_parent) ?></a>
                            </span>
                            <span class="text-muted fs-8 fw-bold lh-1 ss02"><?php comment_date('', $comment) ?></span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center py-1">
                        <div class="rating me-2">
                            <?php $rating = get_comment_meta($comment->comment_ID, 'rating', true) ?>
                            <?php if ($rating > 0) : ?>
                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                    <div class="rating-label <?php if ($i <= $rating) echo 'checked' ?>">
                                        <span class="svg-icon svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    </div>
                                <?php endfor ?>
                            <?php endif ?>
                        </div>
                        <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M18.3721 4.65439C17.6415 4.23815 16.8052 4 15.9142 4C14.3444 4 12.9339 4.73924 12.003 5.89633C11.0657 4.73913 9.66 4 8.08626 4C7.19611 4 6.35789 4.23746 5.62804 4.65439C4.06148 5.54462 3 7.26056 3 9.24232C3 9.81001 3.08941 10.3491 3.25153 10.8593C4.12155 14.9013 9.69287 20 12.0034 20C14.2502 20 19.875 14.9013 20.7488 10.8593C20.9109 10.3491 21 9.81001 21 9.24232C21.0007 7.26056 19.9383 5.54462 18.3721 4.65439Z" fill="black" />
                            </svg></span>
                        <a data-reply-id="<?php echo $comment->comment_ID ?>" href="#comment" class="reply-comment btn btn-sm btn-flex btn-color-gray-500 btn-active-light me-1" data-kt-scroll-toggle>پاسخ</a>
                    </div>
                </div>
                <div class="comment-content fs-5 fw-normal text-gray-800"><?php echo $comment->comment_content ?></div>
            </div>
            <div class="ps-10 mb-0"></div>
        </div>
        <?php if ($comment->get_children()) echoChildrenComment($comment) ?>
    <?php endforeach ?>
<?php } ?>

<?php if ($comments) : ?>
    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="mt-17">
                <div class="d-flex flex-stack mb-5">
                    <h3 class="text-dark ss02">دیدگاه ها (<?php echo count($comments) ?> مورد)</h3>
                </div>
                <div class="separator separator-dashed mb-9"></div>
                <div class="row">
                    <div class="flex-column-fluid">
                        <?php
                        foreach ($comments as $comment) {
                            if ($comment->comment_parent == 0) {
                                echoFirstLevelComment($comment);
                                echoChildrenComment($comment);
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>