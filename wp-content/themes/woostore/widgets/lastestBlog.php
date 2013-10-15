<?php

class lastestBlog extends WP_Widget {

    function __construct() {
        parent::__construct(
                'lasttest_blog', __('Lastest Blog'), array('description' => __('Display the lastest blog'))
        );
    }

    function MyNewWidget() {
        // Instantiate the parent object
        parent::__construct(false, 'Lastest Blog');
    }

    function widget($args, $instance) {
        // Widget output
        $args = array(
            'numberposts' => 1,
            'offset' => 0,
            'category' => 0,
            'orderby' => 'post_date',
            'order' => 'DESC',
            'post_status' => 'publish',
            'suppress_filters' => true
        );

        $recent_posts = wp_get_recent_posts($args, ARRAY_A);
        $thumb_url = wp_get_attachment_image(get_post_thumbnail_id($recent_posts[0]['ID']), array(194, 220), true);
        ?>
        <div class="blog">
            <div class="blog-image">
                <img src="<?php echo get_template_directory_uri() ?>/img/blog.png"/>
            </div>
            <div class="image">
                <?php echo $thumb_url ?>
            </div>
            <div class="content">
                <?php echo substr($recent_posts[0]['post_content'], 0, 98) ?>...
                <a href="<?php echo get_permalink( $recent_posts[0]['ID'] ); ?>">Read more</a>
            </div>
        </div>
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    function form($instance) {
        // Output admin widget options form
        if ($instance) {
            $title = esc_attr($instance['title']);
        } else {
            $title = __('Lastest Blog');
        }
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

        <?php
    }

}
?>
