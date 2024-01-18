<?php

/* Path to the WordPress codebase you'd like to test. Add a forward slash in the end. */
define('ABSPATH', '/app/');

/*
 * Path to the theme to test with.
 *
 * The 'default' theme is symlinked from test/phpunit/data/themedir1/default into
 * the themes directory of the WordPress installation defined above.
 */
define( 'WP_DEFAULT_THEME', 'default' );

// Test with multisite enabled.
// Alternatively, use the tests/phpunit/multisite.xml configuration file.
// define( 'WP_TESTS_MULTISITE', true );

// Force known bugs to be run.
// Tests with an associated Trac ticket that is still open are normally skipped.
// define( 'WP_TESTS_FORCE_KNOWN_BUGS', true );

// Test with WordPress debug mode (default).
define( 'WP_DEBUG', true );

// ** MySQL settings ** //

// This configuration file will be used by the copy of WordPress being tested.
// wordpress/wp-config.php will be ignored.

// WARNING WARNING WARNING!
// These tests will DROP ALL TABLES in the database with the prefix named below.
// DO NOT use a production database or one that is shared with something else.

define( 'DB_NAME', getenv( 'DB_NAME' ) ?: 'wordpress' );
define( 'DB_USER', getenv( 'DB_USER' ) ?: 'root' );
define( 'DB_PASSWORD', getenv( 'DB_PASS' ) ?: 'root' );
define( 'DB_HOST', getenv( 'DB_HOST' ) ?: 'db:3306' );
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 */
define('AUTH_KEY',         '53I: +P{4?[T|k:0vVEF+iAIYZgz`&:+h L1QnsulCn(#P:+!/@h&f%+Mc{2-PPC');
define('SECURE_AUTH_KEY',  '-*K 3a.]/7^-~|v:^1_%ngoOnlO-71h vh#84DT1j_-:Gh-=Ft6wG5Z=+fa}+|<%');
define('LOGGED_IN_KEY',    'b~f%``~FB}B@O.RB;`Utr(rW#xLDA6zE<;/=tD Ue ?J-K{tM7uc0^<wS].RL~4n');
define('NONCE_KEY',        '?[?-f_T.#K!vS; 6KF+O<`5Lxy~8o5try,*@$2m)Qbot||?m%ZtXD={UV],7|ivx');
define('AUTH_SALT',        'H$$Hf(!nK53|RaH<`Rr xgJ(Y{Fp_WDYnXCv`CndrgR6|YbxG-,T]C1/&adC5@n_');
define('SECURE_AUTH_SALT', 'qDjmJmj#BO9$`+]7x-vRg0?MPwh+NRAY}oiu?gD#Csnr^|h_,,t>c+K{*v5XJNdh');
define('LOGGED_IN_SALT',   'n!cdR?I0l#1_,*t*<p+Wjz[LUIjQD1k96>S*1UFEze+2z/3c-G:3|s#vM`-L7IAx');
define('NONCE_SALT',       'p!8.B:RLB#L%KJt9N@[)eG$Jx*JPd9MKj;7b8$ZZ 3:/+PfvsLk$Ps6B(~E$jWqX');

$table_prefix = 'wpphpunittests_';   // Only numbers, letters, and underscores please!

define( 'WP_TESTS_DOMAIN', 'example.org' );
define( 'WP_TESTS_EMAIL', 'admin@example.org' );
define( 'WP_TESTS_TITLE', 'Test Blog' );

define( 'WP_PHP_BINARY', 'php' );

define( 'WPLANG', '' );
