<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

global $product, $woocommerce, $woocommerce_loop;

$upsells = $product->get_upsells();
if (sizeof($upsells) == 0)
    return;

$meta_query = $woocommerce->query->get_meta_query();

$args = array(
    'post_type' => 'product',
    'ignore_sticky_posts' => 1,
    'no_found_rows' => 1,
    'posts_per_page' => $posts_per_page,
    'orderby' => $orderby,
    'post__in' => $upsells,
    'post__not_in' => array($product->id),
    'meta_query' => $meta_query
);

$products = new WP_Query($args);

$woocommerce_loop['columns'] = $columns;

if ($products->have_posts()) :
    ?>

    <div class="related products">

        <h2><?php _e('You may also like&hellip;', 'woocommerce') ?></h2>

        <?php woocommerce_product_loop_start(); ?>

        <?php while ($products->have_posts()) : $products->the_post(); ?>

            <?php woocommerce_get_template_part('content', 'product'); ?>

        <?php endwhile; // end of the loop. ?>

    <?php woocommerce_product_loop_end(); ?>

    </div>
    
<?php
endif;

wp_reset_postdata();
?>

<script>
        jQuery(document).ready(function() {
            var htabs = (jQuery('#tab-description').height() >  jQuery('#comments').height())?jQuery('#tab-description').height():jQuery('#comments').height();
            var hdesc = (jQuery('.images').height() >  jQuery('.product-content').height())?jQuery('.images').height():jQuery('.product-content').height();
            var lheighttabs = htabs+hdesc+60;
            var rheighttabs = jQuery('.related').height();
            if(lheighttabs > rheighttabs)
                jQuery('.related').css('height',lheighttabs);
        })
    </script>