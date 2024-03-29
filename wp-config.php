<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', '');

/** MySQL database username */
define('DB_USER', '');

/** MySQL database password */
define('DB_PASSWORD', '');

define('FS_METHOD', 'direct');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**Increase WordPress Memory Limit */
define( 'WP_MEMORY_LIMIT', '256M' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'a750:}*rghZa-97yK|NhR|X[pQYa@8S9g]SL$._w!nuP?dpzxH59 /~9b7g;AXRy');
define('SECURE_AUTH_KEY',  '/BbM>8En,/[>65_+zZ-^5%NU(h4m-U*LIyQI2ZC?B#<]_U.+(.K4aY>Ea:z$sS-Y');
define('LOGGED_IN_KEY',    'F jl]D8@BRTOl<.^:[g;+L$A#ZLdy(2(JId9>q;7QJj_}C(xL&Y=gLV }H.BW@n>');
define('NONCE_KEY',        '+Ho=ui;[2Upz?mTq9sQ+8(#4#WdR=79~{2r`G-E|tz%>V{|:BMJ4Bkd-4Kdl0wnO');
define('AUTH_SALT',        'Y= |-^OYafl_5jX/6d+.lBg,Aj(dN/4nG{J5^6IY/|@LVO0M_7=5<Y_)Doyl?CW ');
define('SECURE_AUTH_SALT', '&%Aw/3eTBOgSW0!/g%Q#2y,E7cg]_9Mh5{SmrgzY|F6_|dLN)!S7WP8?#a[RYRP$');
define('LOGGED_IN_SALT',   'kez:or%#Lu/!1{J{RS47+U~yZtw/oXV~cH1`A-y_dZ&+s@t^hPQ58=lASWRGL!b8');
define('NONCE_SALT',       '>i,ur77X36Qsc`|E`WNF}%5Fc-x4L{kWwg:5Z>46S-rV28VVv6]vM-#_&Vk$1X}:');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', true);

// Tell WordPress to log everything to /wp-content/debug.log
define('WP_DEBUG_LOG', false);

// Turn off the display of error messages on your site
define('WP_DEBUG_DISPLAY', false);
/* That's all, stop editing! Happy blogging. */

/* Harden Wordpress */
define('DISALLOW_FILE_EDIT', true);

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
