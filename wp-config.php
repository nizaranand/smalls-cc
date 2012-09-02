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
define('AUTH_KEY',         'a~>Q63xJl!A|m0m?5:9*^ddCK1w7lh`r}2WsSr>`*R7`%I#g!XA.rrowTZ0n6pNJ');
define('SECURE_AUTH_KEY',  '18KQL,FTMB?9#]^xzU?$maw]VT/,asjd?&[=m)^=7:M[fF}&s I+)pF7q25@Vxiq');
define('LOGGED_IN_KEY',    '`D!:i#aNf>9-`dzRexsIL7:KARMGG$5-<9_8h5PL$Cm%7bUPE$AP`?R$lVf9h_W ');
define('NONCE_KEY',        'nsjg.C6Z;Vm_DS?RAV:Vf+z0?<_4#WoUanFz}DuX!{gdJL{ea)] Zh6P#HTiFj13');
define('AUTH_SALT',        '_> LfhFyRqc$7t2-S,Rxu6E[p6s9[]eu^D*|ojxJ.iNIMen3P&wuOC0NN8+#P#-f');
define('SECURE_AUTH_SALT', '7p{ c>xsa|=dh[G-iDeA1RYV43V543QL[I#&%Z8tY,mMuP>5QHXM%E>:i$0-#y:.');
define('LOGGED_IN_SALT',   '2Vy9@p}/|An(|,3$I>*+3m99JY^mudG!:e6_.,|bZ!g[rjBt!186Zr_~zF?C{A0_');
define('NONCE_SALT',       '/zKh*!Am9Z!QKvE:yS~}3m,5tF?19V7v)h^tc}L7`^N51)[V{{Xnv_~^D5cn?@eV');

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
