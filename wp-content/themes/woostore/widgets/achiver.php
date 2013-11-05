<?php
ob_start();
class achiver extends WP_Widget {

    function __construct() {

        parent::__construct(
                'archiver', __('My Archiver'), array('description' => __('Display Archives'))
        );
    }

    function widget($args, $instance) {
        global $wpdb, $wp_locale, $wp_query;
        $where = " where post_type = 'post' AND post_status = 'publish'";
        $query = "SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC";
        $results = $wpdb->get_results($query);

        $cYear = !empty($wp_query->query_vars['year']) ? $wp_query->query_vars['year'] : 0;
        $cMonth = !empty($wp_query->query_vars['monthnum']) ? $wp_query->query_vars['monthnum'] : 0;
        ?>
        <div class="widget widget_archive">
        <h3><?php echo empty($instance['title']) ? __('Archives', 'woocommerce' ) : $instance['title'] ?></h3>
        <ul class="archive">
        <?php
        foreach ((array) $results as $result) {
            $url = get_month_link($result->year, $result->month);
            /* translators: 1: month name, 2: 4-digit year */
            $text = sprintf(__('%1$s %2$d'), $wp_locale->get_month($result->month), $result->year);
            $output = get_archives_link($url, $text, $format, $before, $after);
            ?>
            
            <?php
            if ($cYear == $result->year && $cMonth == $result->month) {
                ?>
                <li class="current"><?php echo $output ?>
                <ul>
                <?php
                query_posts("year=$cYear&monthnum=$cMonth");
                if (have_posts())
                    while (have_posts()):
                        the_post(); $count++;
                       ?>
                    <li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
                    <?php
                    endwhile;
                    ?>
                </ul>
                    </li>
                <?php
            }else{
                ?>
                <li class=""><?php echo $output ?></li>
                <?php
            }
           
        }
        ?>
        </ul>
        </div>
        <?php 
    }

    public function update($new_instance, $old_instance) {

        $instance = $old_instance;

        $instance['title'] = $new_instance['title'];


        return $instance;
    }

    public function form($instance) {

        if (empty($instance['title'])) {

            $title = '';
        } else {

            $title = $instance['title'];
        }
        ?>



        <p>

            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 

            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />

        </p>



        <?php
    }

}




/**
 * Tag cloud widget class
 *
 * @since 2.8.0
 */
class My_Widget_Tag_Cloud extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __( "Your most used tags in cloud format") );
		parent::__construct('my_tag_cloud', __('My Tag Cloud'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$current_taxonomy = $this->_get_current_taxonomy($instance);
		if ( !empty($instance['title']) ) {
			$title = $instance['title'];
		} else {
			if ( 'post_tag' == $current_taxonomy ) {
				$title = __('Tags');
			} else {
				$tax = get_taxonomy($current_taxonomy);
				$title = $tax->labels->name;
			}
		}
		$title = apply_filters('widget_title', $title, $instance, $this->id_base);

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
		echo '<div class="tagcloud">';
		wp_tag_cloud( apply_filters('widget_tag_cloud_args', array('taxonomy' => $current_taxonomy, 'smallest' => 13, 'largest' => 16, 'unit' => 'px',) ) );
		echo "</div>\n";
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		$instance['taxonomy'] = stripslashes($new_instance['taxonomy']);
		return $instance;
	}

	function form( $instance ) {
		$current_taxonomy = $this->_get_current_taxonomy($instance);
?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
	<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if (isset ( $instance['title'])) {echo esc_attr( $instance['title'] );} ?>" /></p>
	<p><label for="<?php echo $this->get_field_id('taxonomy'); ?>"><?php _e('Taxonomy:') ?></label>
	<select class="widefat" id="<?php echo $this->get_field_id('taxonomy'); ?>" name="<?php echo $this->get_field_name('taxonomy'); ?>">
	<?php foreach ( get_taxonomies() as $taxonomy ) :
				$tax = get_taxonomy($taxonomy);
				if ( !$tax->show_tagcloud || empty($tax->labels->name) )
					continue;
	?>
		<option value="<?php echo esc_attr($taxonomy) ?>" <?php selected($taxonomy, $current_taxonomy) ?>><?php echo $tax->labels->name; ?></option>
	<?php endforeach; ?>
	</select></p><?php
	}

	function _get_current_taxonomy($instance) {
		if ( !empty($instance['taxonomy']) && taxonomy_exists($instance['taxonomy']) )
			return $instance['taxonomy'];

		return 'post_tag';
	}
}
?>

