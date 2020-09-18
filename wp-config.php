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





if ( file_exists( dirname( __FILE__ ) . '/wp-config-local.php' ) ) {

        include( dirname( __FILE__ ) . '/wp-config-local.php' );

}

else {

	define('DB_NAME', 'opad');



	/** MySQL database username */

	define('DB_USER', 'opad2016');



	/** MySQL database password */

	define('DB_PASSWORD', 'opad2016');

	/** Defining WP_HOME and WP_SITEURL */

	define('WP_HOME', 'http://opad.com.ua/');

	define('WP_SITEURL', 'http://opad.com.ua/');



	define('WP_DEBUG', false);

};



// ** MySQL settings - You can get this info from your web host ** //

/** The name of the database for WordPress */





/** MySQL hostname */

//define('WP_CACHE', true); //Added by WP-Cache Manager

define( 'WPCACHEHOME', '/var/www/opad2016/data/www/opad.com.ua/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager

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

define('AUTH_KEY',         '#`Jh.f2hv^s7y!v!|u8z[);gftB6lX2rr9M]iapoBWjY7Qv$UP/{|K]HUlgrIIQZ');

define('SECURE_AUTH_KEY',  ']~FdxOQ7z37uq37xJ|%M>9`sb$T#.T-_#|D^Lb/s_cO3{m]]9OzF;DeBs6}O{6Bn');

define('LOGGED_IN_KEY',    '!2wvWk5S{7gQY.S[xJv<aH(!~|tVdd3s3k)K8;`-=*U7~zUCNO:ZG Exh8&!D})=');

define('NONCE_KEY',        'bq9!-TmMQ;ru|*yXkVu<Qj$|5<ef!e(gx-p[H2w%<VhgRfi-%EA[0e]@I{8:&1|^');

define('AUTH_SALT',        '3OIUOtx DL~i7r[X2b:tSDL:]aN|@t/D<rN{ `(`orCzKrj|TUH@}jj&mj]D&^#]');

define('SECURE_AUTH_SALT', 'Bdi#<iTPk.7UDEp]?VLP*g[p*$6^48S&8Pb:r&v?#GzCp<a|J* |7`U^m&5XO1)q');

define('LOGGED_IN_SALT',   'QW3$Ra~7+tVXOW_Nyd,[%W77y2QIhHAiJeAF695oPxNZ?a=ij8.;=2~,Khr;kK8#');

define('NONCE_SALT',       'p%$a)geo ]={{y0vJ|JrYkS[vQ| *v%lfjTg,Z<%_eA8vx[,@632MOUl%)e$!!Ya');



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





/* That's all, stop editing! Happy blogging. */

define('WP_DEBUG', true);

/** Absolute path to the WordPress directory. */

if ( !defined('ABSPATH') )

	define('ABSPATH', dirname(__FILE__) . '/');



/** Sets up WordPress vars and included files. */

require_once(ABSPATH . 'wp-settings.php');

