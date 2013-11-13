<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'sallumeh');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'u`ucDi@}sZqdM}%/Tyy ^_@CK0O2t4j=m3C~vu`#GU=T:#.J2{[,F.j:tx:T3Jme');
define('SECURE_AUTH_KEY',  ')HKa;`t%$,kPY~k|P9L)F(06&2#~q-|c5 JJH|~>=xmGT,PnZ@LO<cKi$F)ZZa6B');
define('LOGGED_IN_KEY',    'T: ~@D]8/aP+gS/.hW:V<YTbCK5_v=plN_o#Fn6g7_{4v2|W8,<1#~]j1]rJ?Gu|');
define('NONCE_KEY',        'Qb YP=,YG,Wa1ml8[H]B bBo47B6z=|a_OLn}bN~`UN5[^3S0S%GP]QZ9^V2u_3*');
define('AUTH_SALT',        '-]Y_-8 _U)`O;@hGa7#1$JXN#46UVXw0Flr|!xVbK^39)?!B44ef{BaqveRX5lrR');
define('SECURE_AUTH_SALT', '>9;EF+SrK*25lsq/KFQl8kq9NPIzMMSy)FIJIei)&&t@LGc6HX@|4lT`uB$ql.oh');
define('LOGGED_IN_SALT',   '=rBtPEaW`VZ.F(NbAjDDy6S)${A(eM:ZN8uyfdSq_CRTH$u$Ul|~R12~k;_g8M%J');
define('NONCE_SALT',       '>7U|]X3S[{#@&Iv)W)FIZvQWPQfmD:|c:#8O5.mc_hE`+%_>]B~^&iBd-7r+|TB@');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
