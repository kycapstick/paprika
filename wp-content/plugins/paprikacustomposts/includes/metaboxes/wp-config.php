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
define('DB_NAME', 'paprika_wp');

/** MySQL database username */
define('DB_USER', 'paprika');

/** MySQL database password */
define('DB_PASSWORD', 'papr1ka');

/** MySQL hostname */
define('DB_HOST', 'localhost:/tmp/mysql5.sock');

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
define('AUTH_KEY',         '1^@Ua*4{hsu?>oKX.O-m:0:r(V)-3y3Uqy(km&F1!cwIz&KLS?=Y`cjc `v-KP]?');
define('SECURE_AUTH_KEY',  'a[@|+sA,+Ase`;tto&AwPz5/7G44rm?nMM`,e.eETeZR{Kb1uibGtwf8Uk2R3r<P');
define('LOGGED_IN_KEY',    '&vr@:M@&-ZK~J)t!B;Ij)mi[^pn98X7i~;q5YG%:QT!38#^/f^Z[HBFT{q0C,|58');
define('NONCE_KEY',        'O~&QSx2l%8bgWf[U-hD*%>BU)/P|APYb`z[JK$pZ1D<i1A-=GIW<t8/eQnRwccf)');
define('AUTH_SALT',        'co|rcD <RB+bU@/@t.660_c+=).V{Y49T<>ko}@xM!0a_D;6/qLv3qJjI;>L%f{T');
define('SECURE_AUTH_SALT', 'b.qln_!?u^KzKd]6+:R+:.$[l;nH/f|^pL4Y1pL&h)Ck  hZr-{%rlQyjT>#AH.!');
define('LOGGED_IN_SALT',   'clYPA5u3NVP3J$yk-(a|.n:G~G!~@b!xa8u`2.|-8 ^+?-GP!2)=Q|byQ50^)SX9');
define('NONCE_SALT',       ':`pFIC[6HX//p/B&KPx n8pu+h)rM$5;GV3^x.X0o/B^/bkMsWD;tw&r{o9I`L|a');

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
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
