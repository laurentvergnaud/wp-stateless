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
/** MySQL settings - You can get this info from your web host **/
/** The name of the database for WordPress */
define('DB_NAME', $_SERVER['WORDPRESS_DB_NAME']);
/** MySQL database username */
define('DB_USER', $_SERVER['WORDPRESS_DB_USER']);
/** MySQL database password */
define('DB_PASSWORD', $_SERVER['WORDPRESS_DB_PASSWORD']);
/** MySQL hostname */
define('DB_HOST', $_SERVER['WORDPRESS_DB_HOST'] . ':' . '3306');
/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');
/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
/** Disable WordPress file editor */
define( 'DISALLOW_FILE_EDIT', true );
define( 'COOKIEHASH', md5($_SERVER['WORDPRESS_DB_USER'] . 'secure cookies' .$_SERVER['WORDPRESS_DB_USER'] ) );	// Cookies hardening


/**#@+
* Authentication Unique Keys and Salts.
*
* Change these to different unique phrases!
* You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
* You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
*
* @since 2.6.0
*/
define('AUTH_KEY',         ';Nt1B%}o:v`@(#S>,T)*~6q:-y#ifmv6?7(DEsPRj^UQ[oPw+S>>OT33X[2G_xe0');
define('SECURE_AUTH_KEY',  'KGQvk$mJEW!Wu6[7;AzU_MIYL1Plw-bu.8-yu,S6;`#L?J%1swsNr1NNH,7+p=yo');
define('LOGGED_IN_KEY',    'Kj):^LPy|f5:Z3rE4a<,=^?d9;B+`wz.-Q{jl>ep2na $y8IX1TJloI]{w/lTTw9');
define('NONCE_KEY',        '2oQgL)U2bNf.1>3H=Ifr@eaXWqf SC:NgU9Io|XW/MTaRL=^{gstv4+J>A9u$SC$');
define('AUTH_SALT',        'lqJOg;,8k<00=K+HHw>}@F^EeM<$bjdgeVeSef_k<#23&^o:pac7)XEd59TFQG(F');
define('SECURE_AUTH_SALT', 'NP_w]]B8=6#H3L{i4<U_iDI6an>9Q;@!9n?;e>?:~YB:w<>iFt[v7siO&Awd<bM.');
define('LOGGED_IN_SALT',   'kZ)Kl_uj<}S{1R%7k`H>=fZMd2 %&4|mEj}Ts#i~fx:]bp X4sJ.fQqZy!zTs2]g');
define('NONCE_SALT',       'S1A^v!GH#Y#nMZ2%De73ex/{9@N]E:f LX:)nU|/4`t?HUCDxZly5n-JI4gw83U:');
/**#@-*/
/**
* WordPress Database Table prefix.
*
* You can have multiple installations in one database if you give each a unique
* prefix. Only numbers, letters, and underscores please!
*/
$table_prefix  = '6qu_';

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
define('WP_DEBUG_DISPLAY', false);
define('WP_DEBUG_LOG', false);

$sapi_type = php_sapi_name();
if ( $sapi_type == 'cli' ) {
define( 'WP_DEBUG', false );
error_reporting(0); 
@ini_set('display_errors', 0);
}

/**
* For developers: WordPress memory limit.
*
*/
define( 'WP_MEMORY_LIMIT', '512M' );

/**
 * Faaaster specific configurations 
 * 
 **/
 
// Disable OP Cache mu-plugin feature
define('HIDE_CACHE_CLEAR',false);
// Disable SSO mu-plugin feature
define('HIDE_SSO_LINK',false);
// Connexion error hiding
define('HIDE_WP_ERRORS', true);


// @ini_set('log_errors', 'On');
define( 'WPMU_PLUGIN_DIR', '/mu-plugin' );
define( 'DOCKET_CACHE_CONTENT_PATH', '/tmp/docket_cache' );
define( 'CONCATENATE_SCRIPTS', 'false' );
/* That's all, stop editing! Happy blogging. */
/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
define('ABSPATH', dirname(__FILE__) . '/');
/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
/** change permisssions for plugin installation */
define("FS_METHOD","direct");
