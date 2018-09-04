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
define('DB_NAME', 'crypto_wp');

/** MySQL database username */
define('DB_USER', 'cryptoweb');

/** MySQL database password */
define('DB_PASSWORD', 'sx9sibyZcRc0vf5b');

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
define('AUTH_KEY',         'lH-[i=KY4;bb(]>X:ufX1R$1]&nwx>=o+}5jmYu~ceUl/TwI:qV}}I_(i?*Tcae ');
define('SECURE_AUTH_KEY',  'f%1&?|/;o;y_ Z6K2CP6>+b<T+qP.}`-?p+})H0+VB|8r_oW@~3odD fe{0|BW_>');
define('LOGGED_IN_KEY',    '1)2cdH<-qZPA|J5mW?6^h6S$t-Gh6as5JJyb@Nj5``;zPStaGC!K<gr0Rz^-}1B|');
define('NONCE_KEY',        ' N1TMuy-yc?|QZir~uJEG_`Kb $a8$Tv?|sT#,!-/bA5b4wn,//a,:kng$_*/,~6');
define('AUTH_SALT',        '|SMSl%@8-R:+$$9Zr3sS/~1+@|V=>ccGS()`f,CE+,:/pysF+&D1.81fwIsnfoht');
define('SECURE_AUTH_SALT', '},`}%v<x,mdfb{r7{%88n*0LQ9zx;|u*ALD$z-IKQd$-6|Lvl3HiNMby%zh}9QCz');
define('LOGGED_IN_SALT',   'fp97=+1N6h2oFZseWZz.y|VqEhAjSg(Jm-{Xc&YuUu*7Nn5*|]7lJH;%2m)/LMOq');
define('NONCE_SALT',       'BCcL7TU4%Q!(d{ZUJ0:/Pz.MKh2-D>pO>uKqZu3/|}U4f,B!)r=Nd:-99`61mcV~');

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
define('WP_DEBUG', false);

define('FS_METHOD', 'direct');
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
