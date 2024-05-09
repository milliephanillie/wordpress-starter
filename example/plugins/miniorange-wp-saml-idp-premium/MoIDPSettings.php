<?php
/*
Plugin Name: Login using WordPress Users
Plugin URI: https://plugins.miniorange.com/wordpress-saml-idp
Description: (Premium) Convert your WordPress into an IDP.
Version: 13.1.2
Requires at least: 5.6
Requires PHP: 7.3
Author: miniOrange
Author URI: https://miniorange.com/
*/


if (defined("\101\102\123\x50\101\124\110")) {
    goto nN;
}
exit;
nN:
define("\115\x53\111\137\120\x4c\x55\x47\x49\116\x5f\x4e\101\x4d\105", plugin_basename(__FILE__));
$CU = substr(MSI_PLUGIN_NAME, 0, strpos(MSI_PLUGIN_NAME, "\x2f"));
define("\x4d\x53\x49\x5f\116\101\115\x45", $CU);
const AUTOLOAD = "\x61\165\x74\157\154\157\141\144\x2e\x70\x68\x70";
require_once AUTOLOAD;
\IDP\MoIDP::instance();
