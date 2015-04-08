<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link https://codex.wordpress.org/Editing_wp-config.php Editing
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
define('DB_NAME', 'pushplus');

/** MySQL database username */
define('DB_USER', 'pushplus');

/** MySQL database password */
define('DB_PASSWORD', 'Pu$hp1u$');

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
define('AUTH_KEY',         'gK]2Xczm@>Fz`)2qp%hL}CyJGFE+XhlV{P+7Pt/pSoX$hxIHZ-O2+*ej`Wl39KdE');
define('SECURE_AUTH_KEY',  'Aw3kx+nNeYH#6Z{|Z}Fa!<B=nb(!XVVYW/Ck?@m}$1.L*.s B>RnyeP.pOx-.);D');
define('LOGGED_IN_KEY',    'J>R&M@JNF^eOx-`&FpZ2]ym:2;-rD=|1FeT*_A]y)z];w$]1@oWz34dw(l>#b2|P');
define('NONCE_KEY',        'p.-8N@p0=|GGuax4 =eo>bmMkOT>hwt/7,Fu4eC6C7dMQpjm+sfv(]YU#[]pmnI%');
define('AUTH_SALT',        '+q>>bax69i`NxHCS`-eDo*9-z4.~WvK3iGK+Uz[{isc9S>F.mnp3W1-{g*b+u4sZ');
define('SECURE_AUTH_SALT', '575cw0DU7-z9)y}$j}gVr[FCZdN+nh2NXd~k|xc|^AeE,Q%>5ZwYU%qu]jol#z|A');
define('LOGGED_IN_SALT',   '(/b;Bpv<+ebXhDF-Lqre|&xKcojtW,}O-t}8vMz1C&]j#vKi!c[aN:MRiR}Fzq00');
define('NONCE_SALT',       '-I;gWbcp=]u3)wi^Y`p!DH-?Nv0cPU-/T47Iu:}QHonkJ,J?5Tm`W+B,NmvB*B:R');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
