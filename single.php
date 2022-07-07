<?php
$options = get_option('pidogame_framework');
global $post;
$args = array(
    'post_type'     =>  'post',
    'post_id'       =>  $post->ID,
    'status'        =>  "approve"
);
$comments = get_comments($args);

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
                                <span class="badge badge-light-success ms-1">مدیر وب سایت</span>
                            <?php endif ?>
                        </span>
                        <span class="text-muted fs-8 fw-bold lh-1 ss02"><?php comment_date('', $comment) ?></span>
                    </div>
                </div>
                <div class="d-flex align-items-center py-1">
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
        <div class="border border-left-3 rounded p-2 p-lg-6 mb-5 ms-5 ms-lg-10" id="comment-<?php echo $comment->comment_ID ?>">
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
                                    <span class="badge badge-light-success ms-1">مدیر وب سایت</span>
                                <?php endif ?>
                                در پاسخ به <a href="#comment-<?php echo $comment->comment_parent ?>" data-kt-scroll-toggle><?php echo get_comment_author($comment->comment_parent) ?></a>
                            </span>
                            <span class="text-muted fs-8 fw-bold lh-1 ss02"><?php comment_date('', $comment) ?></span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center py-1">
                        <a data-reply-id="<?php echo $comment->comment_ID ?>" href="#comment" class="reply-comment btn btn-sm btn-flex btn-color-gray-500 btn-active-light me-1" data-kt-scroll-toggle>پاسخ</a>
                    </div>
                </div>
                <div class="comment-content fs-5 fw-normal text-gray-800"><?php echo $comment->comment_content ?></div>
            </div>
            <div class="ps-10 mb-0"></div>
        </div>
        <?php if ($comment->get_children()) echoChildrenComment($comment) ?>
    <?php endforeach ?>
<?php }

get_header();
?>
<div class="d-flex flex-column flex-root">
    <div class="page d-flex flex-row flex-column-fluid">
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            <?php get_template_part('templates/page/header/header') ?>
            <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
                <?php get_template_part('templates/page/aside/aside') ?>
                <div class="content flex-row-fluid" id="kt_content">
                    <?php if (have_posts()) : while (have_posts()) : the_post() ?>
                            <ul class="breadcrumb breadcrumb-line fw-bold fs-7 mb-8">
                                <?php if (function_exists('bcn_display')) bcn_display() ?>
                            </ul>
                            <div class="card">
                                <div class="card-body p-lg-20 py-lg-10">
                                    <div class="d-flex flex-column flex-xl-row">
                                        <div class="flex-lg-row-fluid me-xl-15">
                                            <div class="mb-17">
                                                <div class="mb-8">
                                                    <div class="d-flex flex-wrap mb-6">
                                                        <div class="me-9 my-1">
                                                            <span class="svg-icon svg-icon-primary svg-icon-2 me-1">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                                                                    <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />
                                                                    <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />
                                                                    <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />
                                                                </svg>
                                                            </span>
                                                            <span class="fw-bolder text-gray-400 ss02"><?php the_time() ?></span>
                                                        </div>
                                                        <div class="me-9 my-1">
                                                            <span class="svg-icon svg-icon-primary svg-icon-2 me-1">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor" />
                                                                    <path d="M9.2 3H3C2.4 3 2 3.4 2 4V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V7C22 6.4 21.6 6 21 6H12L10.4 3.60001C10.2 3.20001 9.7 3 9.2 3Z" fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                            <?php
                                                            $category = get_the_category();
                                                            $categoryLabel = '';
                                                            for ($i = 0; $i < count($category); $i++) {
                                                                if ($i + 1 == count($category)) $categoryLabel .= '<a class="text-gray-400 text-hover-primary" href="' . get_category_link($category[$i]) . '">' . $category[$i]->name . '</a>';
                                                                else $categoryLabel .= '<a class="text-gray-400 text-hover-primary" href="' . get_category_link($category[$i]) . '">' . $category[$i]->name . '، </a>';
                                                            }
                                                            ?>
                                                            <span class="fw-bolder"><?php echo $categoryLabel ?></span>
                                                        </div>
                                                        <div class="my-1">
                                                            <span class="svg-icon svg-icon-primary svg-icon-2 me-1">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3" d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z" fill="black" />
                                                                    <path d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z" fill="black" />
                                                                </svg>
                                                            </span>
                                                            <?php
                                                            if (get_comments_number() == 0) $commentLabel = 'بدون دیدگاه';
                                                            else $commentLabel = get_comments_number() . ' دیدگاه';
                                                            ?>
                                                            <span class="fw-bolder text-gray-400 ss02"><?php echo $commentLabel ?></span>
                                                        </div>
                                                    </div>
                                                    <a class="text-dark fs-2 fw-bolder ss02">
                                                        <h1 class="fs-2 d-inline-block"><?php the_title() ?></h1>
                                                        <?php
                                                        $content = get_post_field('post_content', get_the_ID());
                                                        $countWords =  count(preg_split('~[\p{Z}\p{P}]+~u', strip_tags($content), -1, PREG_SPLIT_NO_EMPTY));
                                                        $readTime = ceil($countWords / 250);
                                                        ?>
                                                        <span class="fw-bolder text-muted fs-5 ps-1 ss02">مطالعه در <?php echo $readTime ?> دقیقه</span>
                                                    </a>
                                                    <div class="mt-8">
                                                        <img class="rounded w-100" src="<?php the_post_thumbnail_url() ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true) ?>">
                                                    </div>
                                                </div>
                                                <div class="mb-17 lh-xl text-gray-700 fs-5 ss02 img-rounded">
                                                    <?php the_content() ?>
                                                </div>
                                                <div class="d-flex align-items-center border-1 border-dashed card-rounded p-5 p-lg-10 mb-14">
                                                    <div class="text-center flex-shrink-0 me-7 me-lg-13">
                                                        <div class="symbol symbol-70px symbol-circle mb-2">
                                                            <img src="<?php echo get_avatar_url(get_the_author_meta('ID')) ?>">
                                                        </div>
                                                        <div class="mb-0">
                                                            <a class="text-gray-700 fw-bolder text-hover-primary"><?php the_author_meta('display_name') ?></a>
                                                            <span class="text-gray-400 fs-7 fw-bold d-block mt-1">نویسنده</span>
                                                        </div>
                                                    </div>
                                                    <div class="mb-0 fs-6">
                                                        <div class="text-muted fw-bold lh-lg mb-2 ss02"><?php the_author_meta('description') ?></div>
                                                    </div>
                                                </div>
                                                <?php
                                                $tags = get_the_tags();
                                                $tagsLabel = '';
                                                if ($tags) :
                                                    for ($i = 0; $i < count($tags); $i++) {
                                                        if ($i + 1 == count($tags)) $tagsLabel .= $tags[$i]->name;
                                                        else $tagsLabel .= $tags[$i]->name . ', ';
                                                    }
                                                ?>
                                                    <label class="form-label">برچسب ها:</label>
                                                    <input class="form-control form-control-solid" value="<?php echo $tagsLabel ?>" readonly id="kt_post_tags" />
                                                <?php endif ?>
                                            </div>
                                            <?php $related = getRelatedPosts(get_the_ID(), 4) ?>
                                            <?php if ($related->have_posts()) : ?>
                                                <div class="mb-17">
                                                    <div class="d-flex flex-stack mb-5">
                                                        <h3 class="text-dark">نوشته های مرتبط</h3>
                                                    </div>
                                                    <div class="separator separator-dashed mb-9"></div>
                                                    <div class="row g-10">
                                                        <?php while ($related->have_posts()) : $related->the_post(); ?>
                                                            <div class="col-md-6">
                                                                <div class="card-xl-stretch me-md-6">
                                                                    <a href="<?php the_permalink() ?>" class="d-block bgi-no-repeat bgi-size-cover bgi-position-center card-rounded position-relative min-h-175px mb-5" style="background-image:url('<?php the_post_thumbnail_url() ?>')"></a>
                                                                    <div class="m-0">
                                                                        <a href="<?php the_permalink() ?>" class="fs-4 text-dark fw-bolder text-hover-primary text-dark lh-base"><?php the_title() ?></a>
                                                                        <div class="fs-6 fw-bolder">
                                                                            <span class="text-muted ss02 mt-3 d-block">در <?php the_time() ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endwhile ?>
                                                    </div>
                                                </div>
                                            <?php endif;
                                            wp_reset_postdata() ?>
                                            <div id="comment">
                                                <div class="mt-17">
                                                    <div class="d-flex flex-stack mb-5">
                                                        <h3 class="text-dark">دیدگاه خود را بنویسید</h3>
                                                    </div>
                                                    <div class="separator separator-dashed mb-9"></div>
                                                    <div class="row g-10">
                                                        <form id="kt_post_submit_comment_form" class="form">
                                                            <?php if (!is_user_logged_in()) : ?>
                                                                <div class="row mb-3">
                                                                    <div class="col-md-6 fv-row">
                                                                        <input type="text" class="form-control" placeholder="نام" name="first_name" />
                                                                    </div>
                                                                    <div class="col-md-6 fv-row">
                                                                        <input type="text" class="form-control" placeholder="نام خانوادگی" name="last_name" />
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <div class="col-12 fv-row">
                                                                        <input type="text" class="form-control" placeholder="ایمیل" name="email" />
                                                                    </div>
                                                                </div>
                                                            <?php endif ?>
                                                            <div class="reply-alert alert bg-light-info d-flex flex-column flex-sm-row p-5 d-none">
                                                                <div class="symbol symbol-35px me-3 mb-4"></div>
                                                                <div class="d-flex flex-column pe-0 pe-sm-10">
                                                                    <span class="text-info fw-bold fs-7">در حال پاسخ دادن به <span class="reply-author"></span></span>
                                                                    <span class="reply-content fs-7 mt-1"></span>
                                                                </div>
                                                                <button type="button" class="reply-dismiss position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto">
                                                                    <span class="svg-icon svg-icon-1 svg-icon-info">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                                                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                                                        </svg>
                                                                    </span>
                                                                </button>
                                                            </div>
                                                            <div class="form-group fv-row">
                                                                <textarea name="comment" class="form-control mb-2 ss02" rows="4" placeholder="دیدگاه خود را در این قسمت وارد کنید..." maxlength="1000" data-kt-autosize="true"></textarea>
                                                            </div>
                                                            <div class="d-flex align-items-center justify-content-between py-2 mb-5">
                                                                <div class="text-primary fs-base fw-bold cursor-pointer" data-bs-toggle="collapse" data-bs-target="#kt_comments_rules"><?php echo $options['opt-comments-rules-title'] ?></div>
                                                                <button type="submit" class="btn btn-primary" data-comment-author-id="<?php echo get_current_user_id() ?>" data-post-id="<?php echo get_the_ID() ?>" id="kt_post_comment_submit">
                                                                    <span class="indicator-label">ثبت دیدگاه</span>
                                                                    <span class="indicator-progress">در حال ارسال...
                                                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                                </button>
                                                            </div>
                                                            <div class="collapse" id="kt_comments_rules">
                                                                <div class="text-gray-700 fs-6"><?php echo wpautop($options['opt-comments-rules-content']) ?></div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php if ($comments) : ?>
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
                                            <?php endif ?>
                                        </div>
                                        <div class="flex-column flex-lg-row-auto w-100 w-xl-300px mb-10 list-unstyled">
                                            <?php if (is_active_sidebar('blog-sidebar')) : ?>
                                                <?php dynamic_sidebar('blog-sidebar') ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php endwhile;
                    endif ?>
                </div>
            </div>
            <?php get_template_part('templates/page/footer/footer') ?>
        </div>
    </div>
</div>
<?php get_template_part('templates/page/drawers/drawers') ?>
<?php get_template_part('templates/page/scrolltop/scrolltop') ?>
<?php
get_footer();
