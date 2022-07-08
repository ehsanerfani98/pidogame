<?php
$meta = get_post_meta(get_the_ID(), 'pidogame_framework_products', true);
global $product;
$attachmentIds = $product->get_gallery_image_ids();
if (!empty($attachmentIds)) :
?>
    <div class="separator my-5"></div>
    <div class="tns tns-default" style="direction: ltr;">
        <div data-tns="true" data-tns-loop="false" data-tns-autoplay="false" data-tns-swipe-angle="false" data-tns-controls="true" data-tns-nav="false" data-tns-items="1" data-tns-responsive="{768: {items: 2}, 1200: {items: 4}}" data-tns-dots="false" data-tns-prev-button="#kt_gallery_slider_prev" data-tns-next-button="#kt_gallery_slider_next">
            <?php if ($meta['opt-product-trailer-video']) : ?>
                <div class="text-center px-5 py-5">
                    <!-- <a class="position-relative d-block overlay" data-fslightbox="lightbox-html5" href="<?php echo $meta['opt-product-trailer-video'] ?>">
                        <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px" style="background-image:url('<?php echo $meta['opt-product-trailer-image']['url'] ?>')"></div>
                        <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                            <i class="bi bi-play-fill text-white fs-3x"></i>
                        </div>
                        <span class="position-absolute top-0 start-50 translate-middle badge badge-danger">تریلر محصول<i class="bi bi-play-fill text-inverse-danger me-1"></i></span>
                    </a> -->


                    <a onclick="removeHiddenVideo()" class="d-block bgi-no-repeat bgi-size-cover bgi-position-center rounded position-relative min-h-175px" style="background-image:url('assets/media/stock/600x400/img-23.jpg')" data-fslightbox="lightbox-vimeo" href="#vimeo">
                        <!--begin::Icon-->
                        <img src="assets/media/svg/misc/video-play.svg" class="position-absolute top-50 start-50 translate-middle" alt="" />
                        <!--end::Icon-->
                    </a>
                    <iframe id="vimeo" style="display:none" src="http://tv.pidogame.com/games/2491.webm" width="1920px" height="1080px" frameBorder="0" allow="autoplay; fullscreen" allowFullScreen></iframe>
                    <script>
                        jQuery('document').ready(function() {
                            console.log('dddd');
                        });
                        // function removeHiddenVideo() {
                        //     console.log('fffff');
                        //     jQuery('#viemo').css({
                        //         "display": "unset",
                        //         "height": "unset"
                        //     });;
                        // }
                    </script>
                </div>
            <?php endif ?>
            <?php foreach ($attachmentIds as $attachmentId) :
                $imageUrl = wp_get_attachment_url($attachmentId) ?>
                <div class="text-center px-5 py-5">
                    <a class="d-block overlay" data-fslightbox="lightbox-basic" href="<?php echo $imageUrl ?>">
                        <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px" style="background-image:url('<?php echo $imageUrl ?>')"></div>
                        <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                            <i class="bi bi-eye-fill text-white fs-3x"></i>
                        </div>
                    </a>
                </div>
            <?php endforeach ?>
        </div>
        <button class="btn btn-icon btn-active-color-primary" id="kt_gallery_slider_prev">
            <span class="svg-icon svg-icon-3x">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M11.2657 11.4343L15.45 7.25C15.8642 6.83579 15.8642 6.16421 15.45 5.75C15.0358 5.33579 14.3642 5.33579 13.95 5.75L8.40712 11.2929C8.01659 11.6834 8.01659 12.3166 8.40712 12.7071L13.95 18.25C14.3642 18.6642 15.0358 18.6642 15.45 18.25C15.8642 17.8358 15.8642 17.1642 15.45 16.75L11.2657 12.5657C10.9533 12.2533 10.9533 11.7467 11.2657 11.4343Z" fill="currentColor"></path>
                </svg>
            </span>
        </button>
        <button class="btn btn-icon btn-active-color-primary" id="kt_gallery_slider_next">
            <span class="svg-icon svg-icon-3x">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z" fill="currentColor"></path>
                </svg>
            </span>
        </button>
    </div>
    <div class="separator my-5"></div>
<?php else : ?>
    <div class="separator my-7"></div>
<?php endif ?>