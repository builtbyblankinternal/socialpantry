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
if(trim($_SERVER['SERVER_NAME']) == 'localhost')
{
 /* The name of the database for WordPress */
 define('DB_NAME', 'wp_socialpantry');

 /* MySQL database username */
 define('DB_USER', 'root');

 /* MySQL database password */
 define('DB_PASSWORD', '');

 /* MySQL hostname */
 define('DB_HOST', 'localhost');
}
else
{
 /* The name of the database for WordPress */
 define('DB_NAME', 'wp_socialpantry');

 /* MySQL database username */
 define('DB_USER', 'root');

 /* MySQL database password */
 define('DB_PASSWORD', 'D3v20!4');

 /* MySQL hostname */
 define('DB_HOST', 'localhost');
}
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
define('AUTH_KEY',         'Lt[n0a%_qUu0FJVNW@ y|G)0?aby|_[&aknJnT% OzJP=zcYX=>&7]vbJ u-?B-Q');
define('SECURE_AUTH_KEY',  '^)~DKYlp>mLHl-,pOT-*m^jFx296S!21Dy.Bni*7Q;r*jP`-Oh9XgB)$.z1V1seu');
define('LOGGED_IN_KEY',    '( NNS:?T#gX:{T9|G+)V)>/$xfVW*9uFR4/%u5nuH7t|T<~pN>=T7`^tXs?([}L&');
define('NONCE_KEY',        'XR/(}++MVdr+5PsE+T;pCoKY:V&c@pcEJZ1}TklKKz3`5gLbR3Dcl~+Lf/85hOvG');
define('AUTH_SALT',        '7BTC18e>[b@Z!|VUtHVENp^cMmNX8^zC!luz~X@HXbS.c([U.[cX^Z{)QxoCY);Y');
define('SECURE_AUTH_SALT', '2[0 ?R`[qMJbpI,xAklM0(RlYV7=eEI*;`-S1 u2HkYm,,Bq N,FX;Sygf:=dRp-');
define('LOGGED_IN_SALT',   'WTd&NSlRvSgBj)?&b>FF+e1C&yFbXJ?P:ldf?SDfa(A$3_xJB]xQ1[%eO:K%d99K');
define('NONCE_SALT',       'LtDZdZ_%Y$;QfTeM.#(tdP`=^#@e6]17^#G%cnY/5C4D jWS._Jc0lJO%Ww1xB(5');

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
