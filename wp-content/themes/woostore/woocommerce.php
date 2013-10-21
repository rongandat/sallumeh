<?php get_header(); ?>
<?php global $woo_options; ?>

<div id="content" class="page col-full">
    <div id="main" class="col-left">

        <?php if ($woo_options['woo_breadcrumbs_show'] == 'true') { ?>
            <?php woo_breadcrumbs(); ?>  
        <?php } ?>  			

        <?php if (have_posts()) : ?>
            <?php woocommerce_content(); ?>         
        <?php else: ?>
            <div class="body-content-top">
                <div class="body-content">
                </div>
            </div>
        <?php endif; ?>  

    </div><!-- /#main -->

    <?php // get_sidebar(); ?>

</div><!-- /#content -->

<?php get_footer(); ?>