<?php
/*
  Template Name: Shopping
 */
?>

<?php get_header(); ?>
<div class="body-content-top">
    <div class="body-content">
        <?php if (have_posts()) : $count = 0; ?>
            <h1 class="detal"><?php the_title(); ?></h1>
            <?php
            $args = array(
                'separator' => '/',
                'show_posts_page' => FALSE
            );
            ?>
            <?php woo_breadcrumbs($args); ?> 
            </nav>
            <?php
            while (have_posts()) : the_post();
                $count++;
                ?>
                <?php the_content(); ?>
        <?php edit_post_link(__('{ Edit }', 'woothemes'), '<span class="small">', '</span>'); ?>


            <?php endwhile; ?>
<?php endif; ?>  
        <div class="clb"></div>
    </div>
</div>

<?php get_footer(); ?>