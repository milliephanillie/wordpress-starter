<?php
/**
 * This file is a controller, which defines all the
 * required variables to be used in the pricing
 * (Licensing Plans) view.
 *
 * @package miniorange-wp-as-saml-idp\controllers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use IDP\Helper\Constants\MoIDPConstants;

wp_enqueue_script( 'mo_idp_pricing_script', MSI_PRICING_JS_URL, array( 'jquery' ), MSI_VERSION, true );
wp_enqueue_style( 'mo_idp_admin_settings_pricing_style', MSI_CSS_PRICING_URL, array(), MSI_VERSION );

$hostname    = MoIDPConstants::HOSTNAME;
$login_url   = $hostname . '/moas/login';
$username    = get_site_option( 'mo_idp_admin_email' );
$payment_url = $hostname . '/moas/initializepayment';

require MSI_DIR . 'views/pricing.php';
