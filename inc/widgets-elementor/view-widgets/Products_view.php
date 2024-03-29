<?php

if ($card_style == 'festival') : ?>

  <style>
    .plswb-card-yellow {
      position: relative;
      height: auto;
      border-radius: 20px;
      overflow: hidden;
    }

    .plswb-card-yellow::before {
      content: "";
      position: absolute;
      top: -50%;
      width: 100%;
      height: 100%;
      transform: skewY(345deg);
      transition: 0.5s;
    }

    .plswb-card-yellow:hover::before {
      top: -70%;
      transform: skewY(390deg);
    }

    /* .plswb-card-yellow::after {
  content: "PidoGame";
  position: absolute;
  bottom: 0;
  left: 0;
  font-weight: 600;
  font-size: 5.3em;
  color: rgba(0, 0, 0, 0.1);
} */

    .plswb-card-yellow .imgBox {
      position: relative;
      width: 100%;
      display: flex !important;
      justify-content: center;
      align-items: center;
      padding-top: 20px;
      z-index: 1;
    }

    .plswb-card-yellow .imgBox img {
      max-width: 58%;
    }

    /*
.plswb-card-yellow:hover .imgBox img {
  max-width: 50%;
    
}
*/
    .plswb-card-yellow .contentBox {
      position: relative;
      padding: 20px;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      z-index: 2;
    }

    .plswb-card-yellow .contentBox h3 {
      font-size: 18px;
      font-weight: 500;
    }

    .plswb-card-yellow .contentBox .price {
      font-size: 24px;
      color: white;
      font-weight: 700;
      letter-spacing: 1px;
    }

    .plswb-card-yellow .contentBox .buy {
      position: relative;
      top: 100px;
      opacity: 0;
      padding: 10px 30px;
      margin-top: 15px;
      color: #000000;
      text-decoration: none;
      border-radius: 30px;
      transition: 0.5s;
    }

    .plswb-card-yellow:hover .contentBox .buy {
      top: 0;
      opacity: 1;
    }

    .mouse {
      height: 300px;
      width: auto;
    }

    <?= '.cart_color_' . $wid . '::before{' . 'background:' . $cart_color . ';}'  ?><?= '.buy_' . $wid . '{' . 'background:' . $cart_button_color . ' !important;}'  ?>
  </style>
  <? if ($status_slider != 'yes') : ?>
    <section class="splide splide_<?= $wid ?>" aria-labelledby="carousel-heading">
      <div class="splide__track">
        <ul class="splide__list">
        <?php endif; ?>
        <? if ($status_slider == 'yes') : ?>
          <div class="row">
          <?php endif; ?>
          <?php

          if ($status_product == '_sale_price') {
            if ($status_product_ids == 'yes') {
              $product_ids = explode(',', $product_ids);
              $args = array(
                'post_type'        => ['product', 'product_variation'],
                'posts_per_page'   => $count,
                'meta_query' => WC()->query->get_meta_query(),
                'post__in' => array_merge(array(0), wc_get_product_ids_on_sale()),
                'orderby' => 'meta_value_num',
                'order'   => $orderby,
                'post__in'      => $product_ids,
              );
            } else {
              $term_id = $term_id == 'all' ? $category_ids : $term_id;
              $args = array(
                'post_type'        => ['product', 'product_variation'],
                'posts_per_page'   => $count,
                'meta_query' => WC()->query->get_meta_query(),
                'post__in' => array_merge(array(0), wc_get_product_ids_on_sale()),
                'orderby' => 'meta_value_num',
                'order'   => $orderby,
                'tax_query' => array(
                  array(
                    'taxonomy' => 'product_cat',
                    'field' => 'term_id',
                    'terms' => $term_id
                  )
                )
              );
            }
          } else {
            if ($status_product_ids == 'yes') {
              $product_ids = explode(',', $product_ids);
              $args = array(
                'post_type'        => ['product', 'product_variation'],
                'posts_per_page'   => $count,
                'meta_key' => $status_product,
                'orderby' => 'meta_value_num',
                'order'   => $orderby,
                'post__in'      => $product_ids,
              );
            } else {
              $term_id = $term_id == 'all' ? $category_ids : $term_id;
              $args = array(
                'post_type'        => ['product', 'product_variation'],
                'posts_per_page'   => $count,
                'meta_key' => $status_product,
                'orderby' => 'meta_value_num',
                'order'   => $orderby,
                'tax_query' => array(
                  array(
                    'taxonomy' => 'product_cat',
                    'field' => 'term_id',
                    'terms' => $term_id
                  )
                )
              );
            }
          }

          $query = new WP_Query($args);


          if ($query->have_posts()) :
            while ($query->have_posts()) :
              $query->the_post();
              $product = wc_get_product(get_the_ID());
          ?>
              <? if ($status_slider != 'yes') : ?>
                <li class="splide__slide py-5">
                <?php endif; ?>
                <? if ($status_slider == 'yes') : ?>
                  <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-5">
                  <?php endif; ?>
                  <div class="card plswb-card-yellow cart_color_<?= $wid ?>">

                    <div class="imgBox">
                      <?php the_post_thumbnail() ?>
                    </div>

                    <div class="contentBox">
                      <h3 class="text-gray-700"><?= wp_trim_words(get_the_title(), 5, ' ... '); ?></h3>
                      <h2 class="price"><?= number_format($product->get_price()) . ' ' . get_woocommerce_currency_symbol() ?></h2>
                      <a href="<?php the_permalink() ?>" class="buy buy_<?= $wid ?>">افزودن به سبد خرید</a>
                    </div>

                  </div>
                  <? if ($status_slider == 'yes') : ?>
                  </div>
                <?php endif; ?>
                <? if ($status_slider != 'yes') : ?>
                </li>
              <?php endif; ?>


          <?php
            endwhile;
            wp_reset_postdata();

          endif;
          ?>
          <? if ($status_slider == 'yes') : ?>
          </div>
        <?php endif; ?>

        <? if ($status_slider != 'yes') : ?>
        </ul>
      </div>
    </section>
  <?php endif; ?>

  <? if ($status_slider != 'yes') : ?>
    <? if ($display_column == 'yes') : ?>
      <script>
        var splide = new Splide('.splide_<?= $wid ?>', {
          direction: 'rtl',
          type: 'loop',
          rewind: true,
          pagination: false,
          gap: '.5rem',
          drag: 'free',
          snap: true,
          autoplay: <?= $display_auto == 'yes' ? 'true' : 'false' ?>,
          breakpoints: {
            640: {
              perPage: 1,
              gap: '.7rem',
            },
            480: {
              perPage: 1,
              gap: '.7rem',
            },
          },
        });

        splide.mount();
      </script>
    <?php else : ?>
      <script>
        var splide = new Splide('.splide_<?= $wid ?>', {
          direction: 'rtl',
          type: 'loop',
          perPage: <?= $count_column ?>,
          perMove: 1,
          rewind: true,
          // autoWidth: true,
          pagination: false,
          gap: '.5rem',
          drag: 'free',
          snap: true,
          autoplay: <?= $display_auto == 'yes' ? 'true' : 'false' ?>,
          breakpoints: {
            640: {
              perPage: 1,
              gap: '.7rem',
            },
            480: {
              perPage: 1,
              gap: '.7rem',
            },
          },
        });

        splide.mount();
      </script>
    <?php endif; ?>
  <?php endif; ?>

<?php else : ?>

  <style>
    .wrap-cart-plswb {
      border-radius: 10px;
      height: auto;
      box-shadow: rgba(33, 35, 38, 0.1) 0px 10px 10px -10px;
    }

    .image-cart-plswb {
      text-align: center;
      height: 165px !important;
    }

    .image-cart-plswb img {
      width: 100% !important;
      height: 100% !important;
      object-fit: fill;
    }

    .image-cart-plswb img {
      border-top-left-radius: 6px;
      border-top-right-radius: 6px;
    }

    .wrap-content-product .price{
        margin: 0.5rem;
    }

    .title-cart-plswb h4 {
      font-size: 12px;
      color: #999;
    }

    .icon-device {
      background: rgb(0 158 247 / 16%);
      width: 1.4rem;
      height: 1.2rem;
      border-radius: 20%;
      position: relative;
    }

    .icon-device svg {
      width: 10px;
      height: 10px;
      position: absolute;
      right: 4px;
      top: 2.2px;
    }

    .device_name {
      display: flex;
      flex-direction: row-reverse;
      align-items: center;
      gap: .3rem;
      flex-wrap: wrap;
    }

    .device_name h5 {
      font-weight: bold;
      margin: 0;
      font-size: 12px;
      direction: ltr;
    }

    .device-cart-plswb {
      margin-top: 1rem;
      margin-bottom: .5rem;
      align-items: center;
    }

    .platform,
    .creator {
      display: flex;
      flex-direction: column;
    }

    .platform .title,
    .creator .title {
      font-size: 12px;
      color: #999;
      margin-bottom: .5rem;
    }

    .platform .content,
    .creator .content {
      font-size: 10px;
      font-weight: bold;
    }

    .platform .content {
      background: #fff6de;
      border-radius: 4px;
      color: #ffb100;
      padding: .2rem .4rem;
    }

    .creator .content {
      background: #deffee;
      border-radius: 4px;
      color: #35bb76;
      padding: .2rem .4rem;
    }

    .platform-cart-plswb {
      display: flex;
      align-items: center;
      gap: 4rem;
    }

    .sale-plswb {
      position: absolute;
      top: 10px;
      z-index: 1 !important;
      left: 10px;
      width: 60px;
      height: 35px;
      border-radius: 50px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      font-size: 14px;
      border: 2px solid #ffffff;
    }
  </style>
  <?php

  if ($status_product == '_sale_price') {
    if ($status_product_ids == 'yes') {
      $product_ids = explode(',', $product_ids);
      $args = array(
        'post_type'        => ['product', 'product_variation'],
        'posts_per_page'   => $count,
        'meta_query' => WC()->query->get_meta_query(),
        'post__in' => array_merge(array(0), wc_get_product_ids_on_sale()),
        'orderby' => 'meta_value_num',
        'order'   => $orderby,
        'post__in'      => $product_ids,
      );
    } else {
      $term_id = $term_id == 'all' ? $category_ids : $term_id;
      $args = array(
        'post_type'        => ['product', 'product_variation'],
        'posts_per_page'   => $count,
        'meta_query' => WC()->query->get_meta_query(),
        'post__in' => array_merge(array(0), wc_get_product_ids_on_sale()),
        'orderby' => 'meta_value_num',
        'order'   => $orderby,
        'tax_query' => array(
          array(
            'taxonomy' => 'product_cat',
            'field' => 'term_id',
            'terms' => $term_id
          )
        )
      );
    }
  } else {
    if ($status_product_ids == 'yes') {
      $product_ids = explode(',', $product_ids);
      $args = array(
        'post_type'        => ['product', 'product_variation'],
        'posts_per_page'   => $count,
        'meta_key' => $status_product,
        'orderby' => 'meta_value_num',
        'order'   => $orderby,
        'post__in'      => $product_ids,
      );
    } else {
      $term_id = $term_id == 'all' ? $category_ids : $term_id;
      $args = array(
        'post_type'        => ['product', 'product_variation'],
        'posts_per_page'   => $count,
        'meta_key' => $status_product,
        'orderby' => 'meta_value_num',
        'order'   => $orderby,
        'tax_query' => array(
          array(
            'taxonomy' => 'product_cat',
            'field' => 'term_id',
            'terms' => $term_id
          )
        )
      );
    }
  }

  $query = new WP_Query($args);


  if ($query->have_posts()) :
  ?>
    <? if ($status_slider != 'yes') : ?>
      <section class="splide splide_<?= $wid ?>" aria-labelledby="carousel-heading">
        <div class="splide__track">
          <ul class="splide__list">
          <?php endif; ?>

          <? if ($status_slider == 'yes') : ?>
            <div class="row">
            <?php endif; ?>

            <?php
            while ($query->have_posts()) :
              $query->the_post();
              global $product;
              $meta = get_post_meta(get_the_ID(), 'pidogame_framework_products', true);
            ?>

              <? if ($status_slider != 'yes') : ?>
                <li class="splide__slide py-5">
                  <div>
                  <?php endif; ?>

                  <? if ($status_slider == 'yes') : ?>
                  <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-5">
                    <?php endif; ?>

                    <a href="<?php the_permalink() ?>">
                      <div class="wrap-cart-plswb card">

                        <? if ($rule_percent != 'yes') : ?>
                          <?php
                          if ($product->is_type('simple')) {
                            $percentage = intval((($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price()) * 100);
                            if ($percentage != 0 && $percentage != 100) :
                          ?>
                              <div class="sale-plswb bg-danger text-white">
                                <?= $percentage . '%'; ?>
                              </div>
                            <?php
                            endif;
                          } else {
                            if (count((new WC_Product_Variable(get_the_ID()))->get_children()) > 0) {
                              foreach ($product->get_available_variations() as $variation) {
                                if ($variation['variation_is_active']) {
                                  $variationProduct = new WC_Product_Variation($variation['variation_id']);
                                  if ($variationProduct->is_on_sale()) {
                                    $percentage = intval((($variationProduct->get_regular_price() - $variationProduct->get_sale_price()) / $variationProduct->get_regular_price()) * 100);
                                    $percents[] = $percentage;
                                  }
                                }
                              }

                              $percentage = max(array_unique($percents));
                              unset($percents);
                            }
                            if ($percentage != 0) :
                            ?>
                              <div class="sale-plswb bg-danger text-white">
                                <?= $percentage . '%'; ?>
                              </div>
                          <?php
                            endif;
                          }
                          ?>
                        <?php endif; ?>

                        <div class="image-cart-plswb">
                          <?php if (file_exists(get_attached_file(get_post_thumbnail_id(get_the_ID())))) : ?>
                            <?php the_post_thumbnail() ?>
                          <?php else : ?>
                            <img class="no-image" src="<?= IMAGES_URL . 'no-image-found.png' ?>" alt="">
                          <?php endif; ?>
                        </div>

                        <? if ($rule_title_fa != 'yes' || $rule_title_en != 'yes') : ?>

                          <div class="wrap-content-product mt-2 px-4 py-3">

                            <? if ($rule_title_fa != 'yes') : ?>
                              <div class="title-cart-plswb">
                                <h4><?= wp_trim_words(get_the_title(), 5, ' ... '); ?></h4>
                              </div>
                            <?php endif; ?>

                            <? if ($rule_title_en != 'yes') : ?>
                              <div class="device-cart-plswb">
                                <div class="device_name">
                                  <span class="svg-icon svg-icon-primary svg-icon-1hx"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                      <path d="M10 4L18 12L10 20H14L21.3 12.7C21.7 12.3 21.7 11.7 21.3 11.3L14 4H10Z" fill="black" />
                                      <path opacity="0.3" d="M3 4L11 12L3 20H7L14.3 12.7C14.7 12.3 14.7 11.7 14.3 11.3L7 4H3Z" fill="black" />
                                    </svg></span>
                                  <h5><?= wp_trim_words( $meta['opt-product-subtitle'], 5, ' ... '); ?></h5>
                                </div>
                              </div>
                            <?php endif; ?>
                          </div>
                        <?php endif; ?>


                        <? if ($rule_price != 'yes' || $rule_timer_off != 'yes') : ?>
                          <div class="separator separator-solid"></div>
                        <?php endif; ?>

                        <? if ($rule_price != 'yes' || $rule_timer_off != 'yes') : ?>

                          <div class="wrap-content-product">
                            <? if ($rule_timer_off != 'yes') : ?>

                              <?php $salesPriceTo = null;
                              if ($product->is_type('simple')) {
                                $salesPriceTo = get_post_meta(get_the_ID(), '_sale_price_dates_to', true);
                              } else {
                                if (count((new WC_Product_Variable(get_the_ID()))->get_children()) > 0) {

                                  $salesPriceTo = get_post_meta($product->get_available_variations()[0]['variation_id'], '_sale_price_dates_to', true);
                                }
                              }
                              if ($salesPriceTo) :
                                $salesPriceDateTo = date("Y-m-j H:i:s", $salesPriceTo);
                                $now = new DateTime();
                                $futureDate = new DateTime($salesPriceDateTo);
                                $interval = $futureDate->diff($now);
                                $diff = $interval->format("%a روز و %h ساعت و %i دقیقه") ?>
                                <div class="text-center">
                                  <span class="badge badge-danger ss02"><?php echo $diff ?> باقی مانده</span>
                                </div>
                              <?php endif; ?>

                            <?php endif; ?>

                            <? if ($rule_price != 'yes') : ?>
                              <div class="price text-gray-700 bg-light text-center mt-2 rounded">
                                <div class="d-flex justify-content-around align-items-center bg-light py-2">
                                  <?php echo $product->get_price_html(); ?>
                                </div>
                              </div>
                            <?php endif; ?>
                          </div>
                        <?php endif; ?>

                        <? if ($rule_button != 'yes') : ?>
                          <?php if ($product->is_in_stock()) : ?>
                            <div class="card-footer py-1 text-center bg-primary bg-opacity-75">
                              <a href="<?php the_permalink() ?>" class="d-block fw-bolder fs-6 py-2 text-white">خرید محصول</a>
                            </div>
                          <?php else : ?>
                            <div class="card-footer py-1 text-center bg-danger bg-opacity-75">
                              <a class="d-block fw-bolder fs-6 py-2 text-white">ناموجود</a>
                            </div>
                          <?php endif; ?>
                        <?php endif; ?>
                      </div>
                    </a>

                    <? if ($status_slider == 'yes') : ?>
                    </div>
                  <?php endif; ?>

                  <? if ($status_slider != 'yes') : ?>
                  </div>
                </li>
              <?php endif; ?>

            <?php
            endwhile;
            wp_reset_postdata();
            ?>

            <? if ($status_slider == 'yes') : ?>
            </div>
          <?php endif; ?>

          <? if ($status_slider != 'yes') : ?>
          </ul>
        </div>
      </section>
    <?php endif; ?>

  <?php endif; ?>

  <? if ($status_slider != 'yes') : ?>
    <? if ($display_column == 'yes') : ?>
      <script>
        var splide = new Splide('.splide_<?= $wid ?>', {
          direction: 'rtl',
          type: 'loop',
          rewind: true,
          pagination: false,
          gap: '.5rem',
          drag: 'free',
          snap: true,
          autoplay: <?= $display_auto == 'yes' ? 'true' : 'false' ?>,
          breakpoints: {
            640: {
              perPage: 1,
              gap: '.7rem',
            },
            480: {
              perPage: 1,
              gap: '.7rem',
            },
          },
        });

        splide.mount();
      </script>
    <?php else : ?>
      <script>
        var splide = new Splide('.splide_<?= $wid ?>', {
          direction: 'rtl',
          type: 'loop',
          perPage: <?= $count_column ?>,
          perMove: 1,
          rewind: true,
          // autoWidth: true,
          pagination: false,
          gap: '.5rem',
          drag: 'free',
          snap: true,
          autoplay: <?= $display_auto == 'yes' ? 'true' : 'false' ?>,
          breakpoints: {
            640: {
              perPage: 1,
              gap: '.7rem',
            },
            480: {
              perPage: 1,
              gap: '.7rem',
            },
          },
        });

        splide.mount();
      </script>
    <?php endif; ?>
  <?php endif; ?>

<?php endif; ?>