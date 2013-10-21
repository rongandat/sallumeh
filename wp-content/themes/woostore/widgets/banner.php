<?php

class banner extends WP_Widget {
    var $image_field = 'image';  // the image field ID
    
    function __construct() {
        parent::__construct(
                'banner', __('Banner'), array('description' => __('Display the banner'))
        );
    }

    function widget($args, $instance) {
        extract($args);
        $image_id = esc_attr(isset($instance[$this->image_field]) ? $instance[$this->image_field] : 0 );
        $image = new WidgetImageField($this, $image_id);
        ?>
        <div class="banner2">
            <a href="<?php echo $instance['link'] ?>" <?php if ($instance['link_target'] == 'new_window') echo 'target="_blank"' ?>>
                <img src="<?php echo $image->get_image_src('full'); ?>"/>
            </a>
        </div>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];       
        $instance[$this->image_field] = intval(strip_tags($new_instance[$this->image_field]));   
        $instance['link'] = strip_tags($new_instance['link']);
        $instance['link_target'] = strip_tags($new_instance['link_target']);
        return $instance;
    }

    public function form($instance) {
        if (empty($instance['title'])) {
            $title = '';
        } else {
            $title = $instance['title'];
        }
        $image_id = esc_attr(isset($instance[$this->image_field]) ? $instance[$this->image_field] : 0 );
        $image = new WidgetImageField($this, $image_id);       
        ?>
       
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        
        
        <div id="div_main_image">
            <label><?php _e('Main Image:'); ?></label>
        <?php echo $image->get_widget_field('main_image','main'); ?>
        </div>       
        <p id="div_link">
            <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo esc_attr($instance['link']); ?>" />
            <select name="<?php echo $this->get_field_name('link_target'); ?>" id="<?php echo $this->get_field_id('link_target'); ?>">
                <option value="new_window" <?php if ($instance['link_target'] == 'new_window') echo "selected='true'"; ?>><?php _e('New Window'); ?></option>
                <option value="stay_in_window" <?php if ($instance['link_target'] == 'stay_in_window') echo "selected='true'"; ?>><?php _e('Stay in window'); ?></option>              
            </select>
        </p>        
        <?php
    }

}
?>
