<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'localwordpress');

/** MySQL database username */
define('DB_USER', 'wp_user');

/** MySQL database password */
define('DB_PASSWORD', '1Shirasima!1');

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
define('AUTH_KEY',         'j>-lkG/$1.-r_2c =0_N0 Tqa(ydR.C.;}>TPm)_W)+Dc0r}%-OW!AB ?Bdoq/T&');
define('SECURE_AUTH_KEY',  '%^/?<AUbAB-o{X3r$+Lf|Z(?UB@p1zSIr+v!X+uCp4uh<]>-K99~+r}#_<lsUbjD');
define('LOGGED_IN_KEY',    'n*+ fKZX1;2ien$2{1+MX][j0SgnM`i91+wFW4.sczq!:{f=WnKB_p-T=||sP$d?');
define('NONCE_KEY',        '#8U{4|)gt--#UhAr{Ge#91lp<R<5AzNo&vQ9`WPNZR_VRoEZ ~OD{wOtdI/$q@-+');
define('AUTH_SALT',        'e>+LRymj!PDuPQxQv*r-f-_9u8yegsMBbx=eE,=G8CuDdJaE3`fjRH4n|Eq_ksC7');
define('SECURE_AUTH_SALT', 'jkP+adNy:vwj=)F#L;DtEY70vEsh||sj$Aqi!EIAqP%-zS E@+DFZ@)8-x?AaV5|');
define('LOGGED_IN_SALT',   '?,=2T8u+i`-:m]z--}+2@Q>$eZZg?|f.Bvrx|D&s7!&2mFB  3oKzUZNW#cl=uHK');
define('NONCE_SALT',       ':Bop-Y{Y4+#,odU+I3{E]x$oT@(Z_P|Sy*gb)2Rb81>X>*I*?B %^zg!#{aSjAj(');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = '_2';

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
