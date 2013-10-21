<?php global $woo_options; ?>

<div id="footer">
    <div class="footer-menu">
        <?php
        if (function_exists('has_nav_menu') && has_nav_menu('footer-menu')) {
            wp_nav_menu(array('depth' => 6, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'main-nav', 'menu_class' => 'nav fl', 'theme_location' => 'footer-menu'));
        }
        ?>
    </div>
    <div class="socials">
        <a class="social instagram" href="<?php echo $woo_options['woo_footer_instagram_link'] ?>"></a>
        <a class="social facebook" href="<?php echo $woo_options['woo_footer_facebook_link'] ?>"></a>
        <a class="social twitter" href="<?php echo $woo_options['woo_footer_twitter_link'] ?>"></a>
        <a class="social pinterest" href="<?php echo $woo_options['woo_footer_pinterest_link'] ?>"></a>
    </div>
</div>

</div><!--/#container-->


</div><!-- /#wrapper -->
<?php wp_footer(); ?>
<?php woo_foot(); ?>
</body>
</html>