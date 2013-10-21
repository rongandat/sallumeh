<?php get_header(); ?>
<?php global $woo_options; ?>
       <div class="body-content-top">
    <div class="body-content blogpage">
    <div id="content" class="page col-full">
		<div id="main" class="col-left">
	
        <?php if (have_posts()) : $count = 0; ?>
        <?php while (have_posts()) : the_post(); $count++; ?>
            <h1 class="page-title"><?php the_title(); ?></h1>       
            <?php woocommerce_breadcrumb(); ?>  
            <div <?php post_class(); ?>>

                <div class="entry page-info">
                	<?php the_content(); ?>

					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'woothemes' ), 'after' => '</div>' ) ); ?>
               	</div><!-- /.entry -->

				<?php edit_post_link( __( '{ Edit }', 'woothemes' ), '<span class="small">', '</span>' ); ?>
                
            </div><!-- /.post -->
            
            <?php $comm = $woo_options[ 'woo_comments' ]; if ( ($comm == "page" || $comm == "both") ) : ?>
                <?php comments_template(); ?>
            <?php endif; ?>
                                                
		<?php endwhile; else: ?>
			<div <?php post_class(); ?>>
            	<p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ) ?></p>
            </div><!-- /.post -->
        <?php endif; ?>  
        
		</div><!-- /#main -->

        <?php get_sidebar(); ?>
                <div class="clb"></div>
    </div><!-- /#content -->
	</div>
           </div>
<?php get_footer(); ?>