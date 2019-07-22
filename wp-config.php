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
define('CONCATENATE_SCRIPTS', false);// open again customize
define('DB_NAME', 'outsource');

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
define('AUTH_KEY',         'eO+{#DfoeRt&fm3qQm*sjrO&=?V%v_cZ3)VQ!laW~t4Pr=Ez,Q.VsZzOv`}2%aNz');
define('SECURE_AUTH_KEY',  'pY3?X]:(^O A#1Zp3i$^<SlRc>m9YO<^eAhxj3[G:3 =P,Bcs{z_~a{FLp[~98*X');
define('LOGGED_IN_KEY',    '`E~p6Iv}EeE]3jXb(rx6gM0YY; R0axNUJNtGj6+nuK?LRv&O;e5f$^I$^im2vp.');
define('NONCE_KEY',        'A<|SnxEk;:Bf:bv46FobC#CQo6#.0lDxG/<2:_=hro? T3<pC[}%i*gBWmKXpB(S');
define('AUTH_SALT',        '{[XDxe;z>b,3~9#xCx$2Hopk:Yb!<!heW!5)cDt[:$M4n$fp _K5yz~a301[kGU`');
define('SECURE_AUTH_SALT', '14h&pkzpiEPbPD7>c72Iny8O ~$UPzI~oQ8R*os?|/9S|Q=k]%t|,uY~2)B]|+^|');
define('LOGGED_IN_SALT',   'bNHX~0Z[c+BL.U$/6xl`))_%5=)O%%#HS|#=BXmOdpu:Gz|sjO2CvOb^Dpp`%:@L');
define('NONCE_SALT',       '~yvuWk)uc@n4sJH.Hh+eT3!-*^Jjkp)DJySa,h{B9M{ctk]m762Xehr/<>`-o5Dv');

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
