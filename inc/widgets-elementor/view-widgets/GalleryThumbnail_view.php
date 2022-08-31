<?php
$term = get_term($term_id, 'product_cat');
?>

<style>
    .flexbin {
        display: flex;
        overflow: hidden;
        flex-wrap: wrap;
        margin: -2.5px;
    }

    .flexbin:after {
        content: '';
        flex-grow: 999999999;
        min-width: 300px;
        height: 0;
    }

    .flexbin>* {
        position: relative;
        display: block;
        height: 200px;
        margin: 5px;
        flex-grow: 1;
    }

    .flexbin>*>img {
        height: 200px;
        object-fit: fill;
        max-width: 100%;
        min-width: 100%;
        vertical-align: bottom;
        border-radius: 20px;
    }



    @media (max-width: 980px) {
        .flexbin {
            display: flex;
            overflow: hidden;
            flex-wrap: wrap;
            margin: -2.5px;
        }

        .flexbin:after {
            content: '';
            flex-grow: 999999999;
            min-width: 150px;
            height: 0;
        }

        .flexbin>* {
            position: relative;
            display: block;
            height: 150px;
            margin: 2.5px;
            flex-grow: 1;
        }

        .flexbin>*>img {
            height: 150px;
            object-fit: fill;
            max-width: 100%;
            min-width: 100%;
            vertical-align: bottom;
        }

        .flexbin.flexbin-margin {
            margin: 2.5px;
        }
    }

    @media (max-width: 400px) {
        .flexbin {
            display: flex;
            overflow: hidden;
            flex-wrap: wrap;
            margin: -2.5px;
        }

        .flexbin:after {
            content: '';
            flex-grow: 999999999;
            min-width: 100px;
            height: 0;
        }

        .flexbin>* {
            position: relative;
            display: block;
            height: 100px;
            margin: 2.5px;
            flex-grow: 1;
        }

        .flexbin>*>img {
            height: 100px;
            object-fit: fill;
            max-width: 100%;
            min-width: 100%;
            vertical-align: bottom;
        }

        .flexbin.flexbin-margin {
            margin: 2.5px;
        }
    }
</style>

<div class="flexbin flexbin-margin">
    <?php
    $args = array(
        'post_type' => ['product'],
        'post_status' => ['publish'],
        'posts_per_page' => 5,
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $term_id
            )
        )
    );
    $query = new WP_Query($args);
$i = 0;
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
        switch ($i) {
            case 0:
                $size = 400;
                break;
            case 1:
                $size = 600;
                break;
            case 2:
                $size = 300;
                break;
            case 3:
                $size = 450;
                break;
            default:
            $size = 250;
            break;
        }
    ?>
            <a href="#">
                <img width="<?= $size ?>" src="<?php the_post_thumbnail_url(  ) ?>" alt="">
            </a>

    <?php
    $i++;
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
</div>