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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         '|Xm*z;Cx=~WLZH!9+acQ{TNV_PkiRwSv^`Vo&Yk$(PfK8 Wc*Eza-]XtxP~#ggm!');
define('SECURE_AUTH_KEY',  'p4TG3cQr!xX$[R:Z?Gb-u[|oo1KMn!u%5s>2C!H+5xd9)!!ul-$g/|+PU[uw$^k*');
define('LOGGED_IN_KEY',    'w&Ey2@O;||ztq=W.*tCT`{-0f,8F6)X;hKVXd$oin$N+9$-M@m%3gX->t-DLLP0W');
define('NONCE_KEY',        ':4^``KF8>{nB]LIC+:xHDC!EHBBbX-]6G+.TAp2f/m/4tm!E%0m!<VC?0uMi~;]b');
define('AUTH_SALT',        'E8O[?%zX[M D<}Q-D.XtFg]eg0K^$4ow7J Kyu>b6]8!oa:&!gjm4%/-o,4&6raF');
define('SECURE_AUTH_SALT', 'oNE$Dj>.Gz W`9~)[-f^G4r.(3tOK~J^D;uc!-}y[/I^xnvR,bj%Qc9ey|BN6QQQ');
define('LOGGED_IN_SALT',   'pqv$0Jn1,?kd?;)x:#dlCD{;9XLhW${xZfeKFr?H?ja(If@SG^naVue>B/+eX,A5');
define('NONCE_SALT',       'vzD]YrsUpAw16fGV6sP:j6-A2~G03Y4:|nKvE0([w/_j>m#9+;kWw ]L.K(c<||u');

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
