<?php
global $woo_options;
$count = 0;
global $post;
?>

<?php if (isset($woo_options['woo_slider']) && $woo_options['woo_slider'] == 'true') { ?>


    <?php $slides = get_posts(array('suppress_filters' => 0, 'post_type' => 'slide', 'numberposts' => $woo_options['woo_slider_entries'])); ?>
    <?php if (!empty($slides)) { ?>


        <div class="slider-wrapper">
            <div id="slider" class="nivoSlider">
                <?php foreach ($slides as $post) {
                    setup_postdata($post);
                    ?>
                    <?php
                    $has_image = get_post_meta($post->ID, 'image', true);
                    $has_url = get_post_meta($post->ID, 'slide-url', true);
                    $post_thumb = get_option('woo_post_image_support') == 'true' && has_post_thumbnail();
                    $title = $woo_options['woo_slider_title'] == "true";
                    $content = $woo_options['woo_slider_content'] == "true";

                    // layouts
                    $layout = get_post_meta($post->ID, 'slide_layout', true);
                    if ($layout == "") {
                        $layout = "bottom";
                    }
                    if ($layout == "right") {
                        $slide_content_class = 'right';
                    } elseif ($layout == "top") {
                        $slide_content_class = 'top';
                    } elseif ($layout == "bottom") {
                        $slide_content_class = 'bottom';
                    } elseif ($layout == "none") {
                        $slide_content_class = 'off';
                    } else {
                        $slide_content_class = 'left';
                    }
                    ?>
                    <?php if ($has_image || $post_thumb) {
                        $count++;
                        ?>

                        <?php
                        $new_window = get_post_meta($post->ID, 'slide_new_window', true);
                        ?>
                                <?php if ($has_url != '') { ?>
                                    <?php if ($new_window == 1) { ?>
                                <a target="_blank" href="<?php echo $has_url; ?>">
                                    <?php } else { ?>   	
                                    <a href="<?php echo $has_url; ?>">
                                    <?php } ?>   	
                                <?php } ?>
                            <?php } ?>
                            <?php if ($woo_options['woo_slider_autoheight'] == "true") { ?>
                                <?php woo_image('key=image&class=slide-img&link=img&meta=' . get_the_title() . ''); ?>
            <?php } else { ?>
                            <?php woo_image('key=image&height=' . $woo_options['woo_slider_fixed_height'] . 'width=' . $woo_options['woo_slider_fixed_width'] . '&&class=slide-img&link=img&meta=' . get_the_title() . ''); ?>
                        <?php } ?>
            <?php if ($has_url != '') { ?></a><?php } ?>                 


        <?php } ?>		
            </div>
        </div><!-- /.slides_container -->


    <?php } else { ?>
        <div <?php post_class(); ?>>
            <p class="woo-sc-box note"><?php _e('Please add some Slides to display the Featured Slider.', 'woothemes'); ?></p>
        </div><!-- /.post -->
    <?php } ?>

    <?php
} // end enabled ?>