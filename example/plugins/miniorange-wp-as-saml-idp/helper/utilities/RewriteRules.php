<?php
/**
 * This file contains the `RewriteRules` class that is used
 * to add some custom rewrite rules to the .htaccess file.
 *
 * @package miniorange-wp-as-saml-idp\helper\utilities
 */

namespace IDP\Helper\Utilities;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use IDP\Helper\Traits\Instance;

/**
 * This class adds custom rewrite rules to the .htaccess
 * file to prevent direct access to the plugin directory,
 * and the certificate files.
 */
final class RewriteRules {

	use Instance;

	/**
	 * Private constructor to avoid direct object creation.
	 */
	private function __construct() {
		add_filter( 'mod_rewrite_rules', array( $this, 'output_htaccess' ) );
	}

	/**
	 * This function adds the custom rewrite rules to
	 * the .htaccess file.
	 *
	 * @param string $rules Rewrite rules formatted for .htaccess.
	 * @return string
	 */
	public function output_htaccess( $rules ) {
		$dir_name  = MSI_NAME;
		$new_rules = "IndexIgnore {$dir_name}* actions controllers exception helper includes schedulers views *.php\n" .
					'<FilesMatch "\.(key)$">' . "\n" .
						'Order allow,deny' . "\n" .
						'Deny from all' . "\n" .
					'</FilesMatch>';
		return $rules . $new_rules;
	}
}
