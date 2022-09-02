
<section class="splide" aria-labelledby="carousel-heading">
  <div class="splide__track">
    <ul class="splide__list">
      <?php

      $args = array(
        'post_type'        => 'product',
        'posts_per_page'   => $count,
        'tax_query' => array(
          array(
            'taxonomy' => 'product_cat',
            'field' => 'term_id',
            'terms' => $term_id
          )
        )
      );
      $query = new WP_Query($args);


      if ($query->have_posts()) :
        while ($query->have_posts()) :
          $query->the_post();
          $product = wc_get_product(get_the_ID());


      ?>
          <li class="splide__slide py-5">
            <div class="card plswb-card-yellow">

              <div class="imgBox">
                <?php the_post_thumbnail() ?>
              </div>

              <div class="contentBox">
                <h3 class="text-gray-600"><?php the_title() ?></h3>
                <h2 class="price"><?= number_format($product->get_price()) .' '. get_woocommerce_currency_symbol() ?></h2>
                <a href="#" class="buy">افزودن به سبد خرید</a>
              </div>

            </div>
          </li>

      <?php
        endwhile;
        wp_reset_postdata();

      endif;
      ?>

    </ul>

  </div>
</section>




