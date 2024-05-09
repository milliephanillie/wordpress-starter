<?php


use IDP\Helper\Utilities\TabDetails;
use IDP\Helper\Utilities\Tabs;
use IDP\SplClassLoader;
use IDP\Helper\Constants\MoIDPConstants;
define("\x4d\x53\111\137\x56\105\x52\123\x49\x4f\x4e", "\x31\63\x2e\61\x2e\62");
define("\x4d\123\x49\137\x44\102\137\x56\x45\x52\x53\111\x4f\116", "\61\x2e\x34");
define("\115\123\111\137\104\111\x52", plugin_dir_path(__FILE__));
define("\115\123\x49\x5f\125\122\114", plugin_dir_url(__FILE__));
define("\115\x53\111\x5f\x43\x53\123\x5f\x55\122\114", MSI_URL . "\x69\x6e\143\x6c\165\144\145\163\57\143\163\x73\57\x6d\157\137\151\144\x70\x5f\163\164\171\154\x65\x2e\155\151\x6e\x2e\x63\x73\163\77\166\x65\162\163\x69\x6f\x6e\75" . MSI_VERSION);
define("\x4d\123\111\137\112\123\x5f\x55\x52\114", MSI_URL . "\151\x6e\143\154\x75\x64\x65\x73\x2f\152\x73\57\163\145\164\164\151\x6e\147\x73\56\x6d\x69\156\56\152\x73\x3f\x76\145\162\x73\x69\157\156\75" . MSI_VERSION);
define("\x4d\x53\x49\137\120\x52\111\x43\111\x4e\x47\137\x4a\123\x5f\x55\122\114", MSI_URL . "\x69\x6e\x63\x6c\165\144\145\163\57\152\163\x2f\160\x72\151\143\151\x6e\x67\56\155\x69\x6e\56\152\x73\x3f\x76\145\162\x73\151\157\156\75" . MSI_VERSION);
define("\115\123\111\137\x49\103\x4f\116", MSI_URL . "\151\156\143\154\165\144\145\163\x2f\151\155\141\147\x65\163\x2f\x6d\x69\x6e\151\157\x72\141\x6e\147\x65\x5f\x69\143\157\x6e\x2e\x70\156\147");
define("\x4d\x53\x49\137\x4c\117\x47\117\x5f\125\122\114", MSI_URL . "\x69\156\143\154\165\144\x65\x73\57\x69\155\141\x67\145\x73\x2f\x6c\x6f\147\157\x2e\x70\156\147");
define("\115\x53\111\x5f\x4d\x4f\x4c\x4f\107\x4f\x5f\x55\122\114", MSI_URL . "\151\156\143\154\x75\x64\x65\x73\x2f\x69\x6d\x61\147\145\x73\57\155\157\x5f\x6c\x6f\x67\157\x2e\160\x6e\x67");
define("\x4d\x53\111\x5f\x4c\x4f\101\104\105\x52", MSI_URL . "\151\156\x63\154\165\144\145\163\x2f\x69\155\x61\x67\x65\x73\57\x6c\157\x61\x64\x65\162\x2e\147\151\x66");
define("\x4d\123\111\x5f\x54\105\x53\x54", FALSE);
define("\115\x53\x49\x5f\x44\x45\x42\x55\x47", FALSE);
define("\115\123\x49\137\x4c\113\137\x44\x45\102\x55\x47", FALSE);
define("\x4d\123\x49\x5f\123\x50\x4c\137\x43\x4c\101\x53\123\137\114\x4f\101\x44\x45\122", "\x53\160\x6c\103\x6c\141\163\x73\114\157\x61\144\x65\162\56\x70\150\160");
function includeLibFiles()
{
    if (class_exists("\122\157\x62\122\151\143\x68\x61\x72\x64\x73\134\130\x4d\x4c\123\x65\x63\x4c\x69\142\163\x5c\x58\x4d\114\x53\x65\x63\x75\x72\x69\164\171\113\145\171")) {
        goto h_;
    }
    require_once MoIDPConstants::XML_SECURITY_KEY;
    h_:
    if (class_exists("\x52\157\142\122\x69\x63\x68\x61\162\x64\x73\134\x58\115\x4c\123\x65\143\114\151\142\163\134\x58\115\114\123\145\143\x45\x6e\x63")) {
        goto cZ;
    }
    require_once MoIDPConstants::XML_SEC_ENC;
    cZ:
    if (class_exists("\x52\x6f\x62\122\x69\x63\x68\x61\162\x64\163\x5c\130\115\114\x53\x65\143\x4c\x69\142\163\x5c\x58\x4d\114\123\145\x63\x75\x72\151\164\x79\x44\x53\151\x67")) {
        goto de;
    }
    require_once MoIDPConstants::XML_SECURITY_DSIG;
    de:
    if (class_exists("\x52\x6f\142\x52\x69\143\x68\x61\162\144\163\134\130\x4d\x4c\123\145\x63\114\151\x62\x73\134\125\x74\151\x6c\163\x5c\130\120\141\164\150")) {
        goto RS;
    }
    require_once MoIDPConstants::XPATH;
    RS:
    if (class_exists("\x41\x45\x53\105\156\143\162\x79\160\164\x69\x6f\156")) {
        goto GT;
    }
    require_once MoIDPConstants::AES_ENCRYPTION;
    GT:
}
function getRegistrationURL()
{
    return add_query_arg(["\160\x61\x67\145" => TabDetails::instance()->_tabDetails[Tabs::PROFILE]->_menuSlug], $_SERVER["\122\x45\x51\x55\x45\123\x54\137\125\x52\111"]);
}
require_once MSI_SPL_CLASS_LOADER;
$yi = new SplClassLoader("\111\x44\x50", realpath(__DIR__ . DIRECTORY_SEPARATOR . "\56\x2e"));
$yi->register();
includeLibFiles();
