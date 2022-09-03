<style>
  .plswb-card-yellow {
    position: relative;
    width: 320px;
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

  <?= '.cart_color_' . $wid . '::before{' . 'background:' . $cart_color . ';}'  ?>
  
  <?= '.buy_' . $wid . '{' . 'background:' . $cart_button_color . ' !important;}'  ?>
</style>
<section class="splide splide_<?= $wid ?>" aria-labelledby="carousel-heading">
  <div class="splide__track">
    <ul class="splide__list">
<!-- <div class="row"> -->
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
        <!-- <div class="col-lg-3"> -->
        <div class="card plswb-card-yellow cart_color_<?= $wid ?>">

          <div class="imgBox">
            <?php the_post_thumbnail() ?>
          </div>

          <div class="contentBox">
            <h3 class="text-gray-700"><?php the_title() ?></h3>
            <h2 class="price"><?= number_format($product->get_price()) . ' ' . get_woocommerce_currency_symbol() ?></h2>
            <a href="#" class="buy buy_<?= $wid ?>">افزودن به سبد خرید</a>
          </div>

        </div>
        <!-- </div> -->
      </li>

  <?php
    endwhile;
    wp_reset_postdata();

  endif;
  ?>
<!-- </div> -->
</ul>
  </div>
</section>


<script>
  var splide = new Splide('.splide_<?= $wid ?>', {
    direction: 'rtl',
    // type: 'loop',
    perPage: 3,
    perMove: 1,
    autoWidth: true,
    pagination: false,
    gap: '1rem',
    drag: 'free',
    snap: false,
    autoplay: false,
    breakpoints: {
      640: {
        perPage: 2,
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