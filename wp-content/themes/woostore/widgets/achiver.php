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
?>

