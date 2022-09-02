<?php

echo $term_id."<br>";
echo $count."<br>";

?>
<!--  -->
<!-- <section class="splide" aria-labelledby="carousel-heading">
  <div class="splide__track">
    <ul class="splide__list"> -->
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

          the_title( );

      ?>
       

      <?php
        endwhile;
        wp_reset_postdata();
      endif;

     
      ?>

    <!-- </ul>

  </div>
</section> -->