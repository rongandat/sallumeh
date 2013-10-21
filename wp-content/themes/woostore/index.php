<?php get_header(); ?>
<?php global $woo_options; ?>

<div id="content" class="col-full">
    <div id="main" class="col-left">      

        <?php get_template_part('includes/slider'); ?>

        <?php if (isset($woo_options['woo_homepage_content']) && $woo_options['woo_homepage_content'] != 'Disabled') { ?>
            <div class="home-content">
                <?php
                if ($woo_options['woo_homepage_content'] == "Show latest blog post") {
                    query_posts('showposts=1');
                } else {
                    query_posts('page_id=' . get_page_id($woo_options['woo_homepage_content']));
                }
                ?>
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>		        					
                        <h2 class="title"><?php the_title(); ?></h2>
                        <div class="entry">
                            <?php the_content(); ?>
                        </div>
                    <?php endwhile;
                endif;
                ?>
                <div class="fix"></div>
            </div><!-- /.home-content -->


        <?php } ?>
	<div class="clb"></div>	
        <div class="banner">
            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Home Sidebar")) : endif; ?>
            
           
        </div>
        <div class="clb"></div>

    </div><!-- /#main -->

</div><!-- /#content -->

<?php get_footer(); ?>