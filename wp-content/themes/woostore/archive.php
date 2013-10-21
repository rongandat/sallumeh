<?php get_header(); ?>
    <div class="body-content-top">
    <div class="body-content blogpage">
    <div id="content" class="col-full">
		<div id="main" class="col-left">
            
		<?php if ( $woo_options[ 'woo_breadcrumbs_show' ] == 'true' ) { ?>
			<?php woo_breadcrumbs(); ?> 
		<?php } ?>  

		<?php if (have_posts()) : $count = 0; ?>
             <h1 class="page-title">
            <?php if (is_category()) { ?>
        		<?php _e( 'Archive', 'woothemes' ); ?> | <?php echo single_cat_title(); ?>
        
            <?php } elseif (is_day()) { ?>
           <?php _e( 'Archive', 'woothemes' ); ?> | <?php the_time( get_option( 'date_format' ) ); ?>

            <?php } elseif (is_month()) { ?>
           <?php _e( 'Archive', 'woothemes' ); ?> | <?php the_time( 'F, Y' ); ?>

            <?php } elseif (is_year()) { ?>
           <?php _e( 'Archive', 'woothemes' ); ?> | <?php the_time( 'Y' ); ?>

            <?php } elseif (is_author()) { ?>
          <?php _e( 'Archive by Author', 'woothemes' ); ?></span>

            <?php } elseif (is_tag()) { ?>
            <?php _e( 'Tag Archives:', 'woothemes' ); ?> <?php echo single_tag_title( '', true); ?>
            
            <?php } ?>
            </h1>       
            <div class="fix"></div>
        
        <?php while (have_posts()) : the_post(); $count++; ?>
                                                                    
            <!-- Post Starts -->
            <div <?php post_class('post-info'); ?>>
                <div class="left-content">
                        <?php woo_post_meta(); ?>
                </div>
                
                <div class="right-content">
                    <h1 class="title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>

                    <?php if ( $woo_options['woo_post_content'] != 'content' ) woo_image( 'width=' . $woo_options['woo_thumb_w'] . '&height='.$woo_options['woo_thumb_h'] . '&class=thumbnail ' . $woo_options['woo_thumb_align'] ); ?> 

                    <div class="entry">
                                            <?php global $more; $more = 0; ?>	                                        
                        <?php if ( $woo_options['woo_post_content'] == 'content' ) { the_content(__( 'Read More...', 'woothemes' ) ); } else { the_excerpt(); } ?>
                    </div>
                            <div class="fix"></div>

                    <div class="content">    
                                            <span class="comments"><?php comments_popup_link( __( 'Leave a comment', 'woothemes' ), __( '1 Comment', 'woothemes' ), __( '% Comments', 'woothemes' ) ); ?></span>
                            <?php if ( $woo_options[ 'woo_post_content' ] == "excerpt" ) { ?>
                                            <span class="post-more-sep">&bull;</span>
                        <span class="read-more"><a href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'Continue Reading &rarr;', 'woothemes' ); ?>"><?php _e( 'Continue Reading &rarr;', 'woothemes' ); ?></a></span>
                        <?php } ?>
                    </div>
                           
                </div>

            </div><!-- /.post -->
            
        <?php endwhile; else: ?>
        
            <div <?php post_class(); ?>>
                <p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ) ?></p>
            </div><!-- /.post -->
        
        <?php endif; ?>  
    
			<?php woo_pagenav(); ?>
                
		</div><!-- /#main -->

        <?php get_sidebar(); ?>
                <div class="clb"></div>
    </div><!-- /#content -->
	</div>
    </div>	
<?php get_footer(); ?>