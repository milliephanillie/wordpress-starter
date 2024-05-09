<?php


use IDP\Helper\Utilities\MoIDPUtility;
use IDP\Helper\Utilities\TabDetails;
use IDP\Helper\Utilities\Tabs;
use IDP\Helper\Constants\MoIDPConstants;
$Q4 = MoIDPUtility::micr();
$rt = MoIDPUtility::iclv();
$XT = MoIDPUtility::mo_idp_lk_multi_host();
$KH = MSI_DIR . "\x63\157\156\x74\162\157\154\154\145\x72\163\x2f";
$Sj = TabDetails::instance();
$Rb = $Sj->_tabDetails;
$CJ = $Sj->_parentSlug;
$tk = $Rb[Tabs::PROFILE];
$pw = $Rb[Tabs::SIGN_IN_SETTINGS];
$TB = $Rb[Tabs::LICENSE];
$Sp = $Rb[Tabs::METADATA];
$tx = $Rb[Tabs::IDP_CONFIG];
$Dz = $Rb[Tabs::ATTR_SETTINGS];
$dE = $Rb[Tabs::SUPPORT];
require_once MoIDPConstants::VIEWS_COMMON_ELEMENTS;
require_once MoIDPConstants::SSO_IDP_NAVBAR;
if (!isset($_GET["\x70\141\147\145"])) {
    goto X7;
}
$A7 = $Q4 && $rt ? "\163\x73\x6f\x2d\x69\144\160\x2d\x70\162\157\146\x69\154\145\x2e\x70\150\x70" : "\x73\163\157\x2d\151\144\160\x2d\162\x65\147\151\x73\164\x72\141\164\151\157\156\56\x70\150\x70";
switch ($_GET["\160\141\147\145"]) {
    case $Sp->_menuSlug:
        require_once MoIDPConstants::SSO_IDP_DATA;
        goto jg;
    case $tx->_menuSlug:
        require_once MoIDPConstants::SSO_IDP_SETTINGS;
        goto jg;
    case $tk->_menuSlug:
        require_once $KH . $A7;
        goto jg;
    case $pw->_menuSlug:
        require_once MoIDPConstants::SSO_SIGNIN_SETTINGS;
        goto jg;
    case $Dz->_menuSlug:
        require_once MoIDPConstants::SSO_ATTR_SETTINGS;
        goto jg;
    case $TB->_menuSlug:
        require_once MoIDPConstants::SSO_PRICING;
        goto jg;
    case $dE->_menuSlug:
        require_once MoIDPConstants::SSO_IDP_SUPPORT;
        goto jg;
    case $CJ:
        require_once MoIDPConstants::PLUGIN_DETAILS;
        goto jg;
}
OJ:
jg:
require_once MoIDPConstants::CONTACT_BUTTON;
X7:
