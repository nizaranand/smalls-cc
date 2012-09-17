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
define('AUTH_KEY',         'LYSdl)+]YJnC$KKAVsobs]]h4]6N2-O1PCnw?;6ax/`5@@8m|K{.f/}L*wqry@H2');
define('SECURE_AUTH_KEY',  '-3MpPnC&;o:&lWlN8YDTF&9Q*z( ]v~^p~?@Mes[0&eA-`}u%NGn?s&^pLK7`,#z');
define('LOGGED_IN_KEY',    'xI:kSy12j~3V6Zk $$#|e{WBsDo7-lCz$8kZ8Ou3%ax6d=9Mu*@z{Va^6JU![y}]');
define('NONCE_KEY',        'TV2s+,Wf$yic;]$-<T,RxI0fY?.TTk`yz6`H)6*_Py{I][^#e/ /m[tLda|nB,}o');
define('AUTH_SALT',        'cHAt]ZzTZ5<|vK4%pevIGt14.Gt-*SP4EV>]h-`QinQ_3jg{IP4rP*kLQ{VcS8XP');
define('SECURE_AUTH_SALT', '68m0QJ{,lO1~ 6zrTzLX<XSj7 g #yTJ7AoQ=z|3V78O2$2sd/M{oimO}n]g|.]B');
define('LOGGED_IN_SALT',   'N^jZxsI]+}7`Nk|taV)Z`&E4Oojv:Kt^OXKFuPfQ)MRp).TK_uLpW4`x7RG,K~z,');
define('NONCE_SALT',       'jQut?}wP3B0]y^P%HSu&eRp~+sNrRrOF.B#Gho7-n3;)V9;[O>*d6&X;HA):!])Q');

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
