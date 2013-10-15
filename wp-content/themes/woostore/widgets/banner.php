<?php

class banner extends WP_Widget {

    function __construct() {
        parent::__construct(
                'banner', __('Banner'), array('description' => __('Display the banner'))
        );
    }

    function MyNewWidget() {
        // Instantiate the parent object
        parent::__construct(false, 'Banner');
    }

    function widget($args, $instance) {
        ?>
        <div class="banner2">
            <img src="<?php echo get_template_directory_uri() ?>/img/banner2.png"/>
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
            $title = __('Banner');
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
