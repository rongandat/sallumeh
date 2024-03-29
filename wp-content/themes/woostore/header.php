<?php

/**

 * Header Template

 *

 * Here we setup all logic and HTML that is required for the header section of all screens.

 *

 */

 global $woo_options;

 global $woocommerce;

?>



<?php 

	$http_or_https = (is_ssl()) ? 'https:' : 'http:';	

?>

<!DOCTYPE html>

<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->

<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->

<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->

<!--[if IE 9 ]>    <html <?php language_attributes(); ?> class="no-js ie9"> <![endif]-->

<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->

<head profile="http://gmpg.org/xfn/11">

<link href='http://fonts.googleapis.com/css?family=Bilbo+Swash+Caps' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Roboto:700,300italic,700italic,300' rel='stylesheet' type='text/css'>

<title><?php woo_title(); ?></title>

<?php woo_meta(); ?>



<!-- The main stylesheet -->

<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css">



<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php $GLOBALS['feedurl'] = get_option('woo_feed_url'); if ( !empty($feedurl) ) { echo $feedurl; } else { echo get_bloginfo_rss('rss2_url'); } ?>" />



<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />



<!-- Load Modernizr which enables HTML5 elements & feature detects -->

<script src="<?php echo get_template_directory_uri(); ?>/includes/js/libs/modernizr-2.0.6.min.js"></script>	

      

<?php wp_head(); ?>

<?php woo_head(); ?>



<!-- Load Google HTML5 shim to provide support for <IE9 -->

<!--[if lt IE 9]>

<script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>

<![endif]-->



</head>

<?php 

global $current_user;

get_currentuserinfo();

?>

<body <?php body_class(get_option('woo_site_layout')); ?>>

<?php woo_top(); ?>

<div id="wrapper">



	<?php if ( function_exists( 'has_nav_menu') && has_nav_menu( 'top-menu' ) ) { ?>



	<div id="top">

		<div class="col-full">

			<?php wp_nav_menu( array( 'depth' => 6, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'top-nav', 'menu_class' => 'nav fl', 'theme_location' => 'top-menu' ) ); ?>

		</div>

	</div><!-- /#top -->



    <?php } ?>



	<div id="header" class="col-full">



            <div class="logo">

                <?php

                if ($woo_options['woo_texttitle'] != 'true') :

                    $logo = $woo_options['woo_logo'];

                    if (is_ssl()) {

                        $logo = preg_replace("/^http:/", "https:", $woo_options['woo_logo']);

                    }

                    ?>

                    <a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('description'); ?>">

                        <img src="<?php if ($logo) echo $logo; else {

                        echo get_template_directory_uri(); ?>/images/logo.png<?php } ?>" alt="<?php bloginfo('name'); ?>" />

                    </a>

                <?php endif; ?>

            </div>

            <div class="menu">

                

                <div class="head-menu">

                    <ul>

                        <?php if(!empty($current_user->ID)): ?>

                        <li class="user_login">

                            <span class="wellcome"><?php echo __('WELCOME ','woothemes') ?></span> <?php echo $current_user->display_name ?>

                          
                        </li>

                        <li>|</li>

                        <?php endif; ?>

                        <li>

                            <div id="" class="fr">

                                <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>">

                                    <span> 

                                        <?php

//                                        echo sprintf(_n('%d item &ndash; ', '%d items &ndash; ', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);

//                                        echo $woocommerce->cart->get_cart_total();

                                        echo __('SHOPPING CART','woothemes')

                                        ?>

                                    </span>

                                </a>

                            </div>

                        </li>

                        <li>|</li>

                        <li class="account">

                            <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="<?php _e('My Account', 'woothemes'); ?>"><?php _e('Account', 'woothemes'); ?></a>

                        </li>

                        <?php

                        if (sizeof($woocommerce->cart->cart_contents) > 0) :

                            echo '<li>|</li><li class="checkout"><a href="' . $woocommerce->cart->get_checkout_url() . '">' . __('Checkout', 'woothemes') . '</a></li>';

                        endif;

                        ?>

                        <li>|</li>

                        <li><a href="#">Search</a></li>

                    </ul>

	    

	    	<form role="search" method="get" id="searchform" class="searchform" action="<?php echo home_url(); ?>">

				<input type="text" value="<?php the_search_query(); ?>" name="s" id="s"  class="field s" placeholder="" />


		</form>

                </div>

                <div id="navigation" class="col-full">

                    <?php

                    if (function_exists('has_nav_menu') && has_nav_menu('primary-menu')) {

                        wp_nav_menu(array('depth' => 6, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'main-nav', 'menu_class' => 'nav fl', 'theme_location' => 'primary-menu'));

                    } else {

                        ?>

                        <ul id="main-nav" class="nav fl">

                            <?php

                            if (isset($woo_options['woo_custom_nav_menu']) AND $woo_options['woo_custom_nav_menu'] == 'true') {

                                if (function_exists('woo_custom_navigation_output'))

                                    woo_custom_navigation_output();

                            } else {

                                ?>

                                <?php if (is_page()) $highlight = "page_item";

                                else $highlight = "page_item current_page_item"; ?>

                                <li class="<?php echo $highlight; ?>"><a href="<?php echo home_url('/'); ?>"><?php _e('Home', 'woothemes') ?></a></li>

                                <?php

                                wp_list_pages('sort_column=menu_order&depth=6&title_li=&exclude=');

                            }

                            ?>

                        </ul><!-- /#nav -->

<?php } ?>



                    



                </div><!-- /#navigation -->

            </div>

            <div class="clb"></div>

	</div><!-- /#header -->

	

	<div id="body" class="col-full">



	