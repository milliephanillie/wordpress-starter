<?php
/**
 * This file contains the `SPNameAlreadyInUseException` class that defines
 * an exception when the Service Provider name at the time of configuration
 * is already in use.
 *
 * @package miniorange-wp-as-saml-idp\exception
 */

namespace IDP\Exception;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use IDP\Helper\Constants\MoIDPMessages;

/**
 * Exception denotes that the Service Provider name entered at the time of
 * configuration is already in use.
 */
class SPNameAlreadyInUseException extends \Exception {

	/**
	 * Constructor function, which defines the `$code` and `$message` for
	 * the exception, and makes a call to the parent (`Exception`) constructor.
	 *
	 * @param object $sp Service Provider config object.
	 */
	public function __construct( $sp ) {
		$message = MoIDPMessages::show_message( 'SP_EXISTS' );
		$code    = 107;
		parent::__construct( $message, $code, null );
	}

	/**
	 * Returns the string representation of the exception,
	 * with exception code and the error message.
	 *
	 * @return string
	 */
	public function __toString() {
		return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
	}
}
