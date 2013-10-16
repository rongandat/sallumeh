<?php
error_reporting(0);
/* ----------------------------------------------------------------------------------- */
/* Start WooThemes Functions - Please refrain from editing this section */
/* ----------------------------------------------------------------------------------- */

// Set path to WooFramework and theme specific functions
$functions_path = get_template_directory() . '/functions/';
$includes_path = get_template_directory() . '/includes/';
$includes_widgets = get_template_directory() . '/widgets/';

// WooFramework
require_once ($functions_path . 'admin-init.php' );   // Framework Init
require_once ($includes_widgets . 'lastestBlog.php' );   // Framework Init
require_once ($includes_widgets . 'banner.php' );   // Framework Init

/* ----------------------------------------------------------------------------------- */
/* Load the theme-specific files, with support for overriding via a child theme.
  /*----------------------------------------------------------------------------------- */

function myplugin_register_widgets() {
    register_widget('lastestBlog');
    register_widget('banner');
}

add_action('widgets_init', 'myplugin_register_widgets');

$includes = array(
    'includes/theme-options.php', // Options panel settings and custom settings
    'includes/theme-functions.php', // Custom theme functions
    'includes/theme-plugins.php', // Theme specific plugins integrated in a theme
    'includes/theme-actions.php', // Theme actions & user defined hooks
    'includes/theme-comments.php', // Custom comments/pingback loop
    'includes/theme-js.php', // Load JavaScript via wp_enqueue_script
    'includes/sidebar-init.php', // Initialize widgetized areas
    'includes/theme-widgets.php', // Theme widgets
    'includes/theme-install.php', // Theme Installation
    'includes/theme-woocommerce.php'  // WooCommerce overrides
);

// Allow child themes/plugins to add widgets to be loaded.
$includes = apply_filters('woo_includes', $includes);

foreach ($includes as $i) {
    locate_template($i, true);
}

/* ----------------------------------------------------------------------------------- */
/* You can add custom functions below */
/* ----------------------------------------------------------------------------------- */


register_sidebar(array(
    'name' => __('Home Sidebar', 'woocommerce'),
    'id' => 'sidebar-home',
    'description' => __('Home page', 'woocommerce'),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
));


/* ----------------------------------------------------------------------------------- */
/* Don't add any code below here or the sky will fall down */
/* ----------------------------------------------------------------------------------- */

remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
    echo '<section id="main">';
}

function my_theme_wrapper_end() {
    echo '</section>';
}

add_theme_support('woocommerce');

remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
remove_action('woocommerce_before_shop_loop', 'woocommerce_show_messages', 10);
add_action('woocommerce_before_shop_loop', 'woocommerce_breadcrumb', 20, 0);
add_action('woocommerce_before_shop_loop', 'woocommerce_show_messages', 30, 0);
/** Template pages ******************************************************* */
if (!function_exists('woocommerce_content')) {

    /**
     * Output WooCommerce content.
     *
     * This function is only used in the optional 'woocommerce.php' template
     * which people can add to their themes to add basic woocommerce support
     * without hooks or modifying core templates.
     *
     * @access public
     * @return void
     */
    function woocommerce_content() {
        ?>
        <div class="body-content-top">
            <div class="body-content">
                <?php
                if (is_singular('product')) {
                    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
                    remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
                    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
                    add_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 2);
                    do_action('woocommerce_before_shop_loop');
                    while (have_posts()) : the_post();

                        woocommerce_get_template_part('content', 'single-product');

                    endwhile;
                } else {
                    ?>
                    <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>

                        <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

                    <?php endif; ?>

                    <?php do_action('woocommerce_archive_description'); ?>

                    <?php if (have_posts()) : ?>

                        <?php do_action('woocommerce_before_shop_loop'); ?>

                        <?php woocommerce_product_loop_start(); ?>

                        <?php woocommerce_product_subcategories(); ?>

                        <?php while (have_posts()) : the_post(); ?>

                            <?php woocommerce_get_template_part('content', 'product'); ?>

                        <?php endwhile; // end of the loop.  ?>

                        <?php woocommerce_product_loop_end(); ?>

                        <?php do_action('woocommerce_after_shop_loop'); ?>

                    <?php elseif (!woocommerce_product_subcategories(array('before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false)))) : ?>

                        <?php woocommerce_get_template('loop/no-products-found.php'); ?>

                        <?php
                    endif;
                }
                ?>
                <div class="clb"></div>
            </div>
        </div>
        <?php
    }

}
?>