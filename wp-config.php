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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '%uOwx~zxUFmZE@<7gn?MQC>0|.|T,EIhLv+)6=<%m&1f5MRHwd6` aSFG&1FAb8u');
define('SECURE_AUTH_KEY',  'f5x`sRzcv}?&}rr*)}-cV,#3m:%xtre<UMIgN^D~/yO;Z%}?!SfW)kG1~>kF,q#&');
define('LOGGED_IN_KEY',    '/{RZ:{N<*XO2}h=O^h& 3LD({t W(7b<ch.1u8h44-1e9,jQSUS*hA}=0W$(Q@M3');
define('NONCE_KEY',        '1m^}lB!T_}9~qLhc27$KT@SR`6)QBo1zeD.wm!_7=K|]0?eMUA+X)`6jxXq06W?=');
define('AUTH_SALT',        '?),&>-G/$EZL6v X!30^k_Q|J%)#E<I nO:&1kEPM!4=!=}i1*a;5`{3S-2B_<l^');
define('SECURE_AUTH_SALT', 'q?:Z!CjCV!)}r[jC<%I<+3Qv:KfKq{aLT&1dR6a($,~3f$,3)|PRE*2jX2l..*]Q');
define('LOGGED_IN_SALT',   'sDR%p@D!gQl8(z#n+7CwN#rSr%]5+O)JDCVE2jw+:~4v]&ioI;HI,zObSZ{QO9a]');
define('NONCE_SALT',       '%eXnqD+4%1(yK7b+E0P79@jsU9>}L 9HQAfEjHG0e[>+[II=Q:-f=Urr?JW``.YJ');

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
