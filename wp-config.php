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
define('DB_NAME', 'jsmalls');

/** MySQL database username */
define('DB_USER', 'jsmalls');

/** MySQL database password */
define('DB_PASSWORD', 'Ed9WSxB/hOY');

/** MySQL hostname */
define('DB_HOST', 'ma.sdf.org');

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
define('AUTH_KEY',         '} R,y_i-}$?<&W]-2#%-g?IPfR{xG_K+Mk0Ya-.g-t3N4e+=(oWuS.8A]IP5~{$s');
define('SECURE_AUTH_KEY',  'd8o)IC%![sxRk9xG]t88{]yGv|A,t+^GFG3]l/NhYBm3CCT3Cc`ab:sQ-c}AEKQ+');
define('LOGGED_IN_KEY',    'TF^GI.HU#?1c$QK r|!%1/~j,e`RqbKv[7N3Z8]q?bz/K3n>5I~JE|;-Z[2JM+Cv');
define('NONCE_KEY',        'B5|!P_u>tKc[_gJfU6B`s^4$GWB:[rRtxUB%02Whj[cx4R]x/cS]Je<dKB|h,`ei');
define('AUTH_SALT',        ')vkM<tI4B`S.`D-v;<L-{oBp0j|73,j&^Nru-A^ 0Vj+OV(S_V+BchlC=dDbzF&O');
define('SECURE_AUTH_SALT', 'eVRBq5Zdk+^P|WeUa;meXylf8ww<ZuFpv*KH6s}u~wU2 _H6*)`{)O#{|14g{DZ7');
define('LOGGED_IN_SALT',   '7eyo8?67<[re~lyPCI(@o.}{k| hct&c&;Rho3m+<@9gS(9o5U^~ 7xm@%3:OR~a');
define('NONCE_SALT',       '&YOq]0%6|bMo1n[:S3+v>Z{44Ex!<VI3.wdbk9;w|[RT+m=q~{Y)s(^X3E.;,+K~');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'smalls_cc_';

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
define('MULTISITE', true);

define('SUBDOMAIN_INSTALL', true);

$base = '/';

define('DOMAIN_CURRENT_SITE', 'smalls.cc');

define('PATH_CURRENT_SITE', '/');

define('SITE_ID_CURRENT_SITE', 1);

define('BLOG_ID_CURRENT_SITE', 1);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
