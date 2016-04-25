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
define('DB_NAME', 'tawasulc_wpdb');

/** MySQL database username */
define('DB_USER', 'tawasulc_wpuser');

/** MySQL database password */
define('DB_PASSWORD', ',26P,Lw[xfXX');

/** MySQL hostname */
define('DB_HOST', 'tawasulccom.ipagemysql.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'U}{b@JhCgSy+c*e]c!e|ghV?5A#~mAmaTj*Sgd%2cUpfk$??t_Ts4hs}}JI?;!,4');
define('SECURE_AUTH_KEY',  'OvLn2WzSywtUuEj6w||crOc=ENR6yu:nE+0gE_CF2`7$|{R#%|jefGWj10f6N>=O');
define('LOGGED_IN_KEY',    ' ~>4Km=-!n/r1b}w#1PO;3 Q)zN&x:NNj]@tEY6.0XUYUi;SF-*y5yh_uc=OFO;>');
define('NONCE_KEY',        'LK`a|A<|5B3Imv=&O.5c7S0Su_N|w+JQu~E9F#R~+}x{6:2{6f}gMDa&>H!5}Bvy');
define('AUTH_SALT',        '^GXk+3YK_Uty 1;Q[YJ[]sXn$C_W&$@Jba=Ryjq$T5K7#V8f=~iw#@Sv]5`3ON8N');
define('SECURE_AUTH_SALT', '2|{LceYewqJf.u`JAF%Z&G,D-y5W)@#6+Y7vYeeXPP{+-,!aIm.!7Uv=#_p|p!yC');
define('LOGGED_IN_SALT',   '++|6&dycO4b]}H<<Cjrdl#u7g|xJcro^|b%O-8VXVPdp`z2za/1B6D#Jar5KFs._');
define('NONCE_SALT',       ' X2MAMs>jv#0N{yqF}<z 5Z0e)hdm|He&]<;+ZEsFs/i<_M]NM-v?lp-W~k!Wt,]');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'tc_';

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');