<?php


use IDP\Helper\Constants\MoIDPConstants;
use IDP\Handler\RegistrationHandler;
$CF = MoIDPConstants::HOSTNAME;
$W5 = RegistrationHandler::instance();
$mK = $CF . "\57\x6d\157\x61\x73\57\154\157\147\151\x6e" . "\77\162\x65\144\x69\x72\x65\143\164\x55\162\154\x3d" . $CF . "\x2f\x6d\x6f\x61\x73\x2f\x76\151\145\x77\154\151\143\145\x6e\163\x65\x6b\145\x79\163";
$q1 = get_site_option("\155\x6f\137\151\x64\160\137\x61\x64\155\x69\156\137\145\x6d\141\151\154");
$I_ = MSI_DIR . "\166\151\x65\x77\x73\x2f\x72\145\147\x69\x73\x74\x72\x61\x74\x69\157\156\57";
$tn = $W5->_nonce;
if (get_site_option("\x6d\157\137\151\144\160\137\166\145\162\x69\x66\x79\137\143\x75\x73\164\x6f\155\x65\162")) {
    goto LF;
}
if (trim(get_site_option("\155\x6f\137\151\x64\160\x5f\x61\x64\x6d\151\x6e\x5f\145\155\141\x69\x6c")) != '' && trim(get_site_option("\155\157\x5f\151\x64\160\x5f\141\144\155\151\156\x5f\141\x70\151\x5f\153\x65\x79")) == '' && get_site_option("\x6d\157\x5f\151\x64\x70\137\x6e\x65\x77\x5f\x72\x65\147\x69\x73\164\x72\x61\x74\x69\x6f\x6e") != "\164\x72\x75\145") {
    goto Q_;
}
if (get_site_option("\155\x6f\137\151\x64\160\137\162\145\147\151\x73\164\162\141\164\x69\157\156\137\x73\164\141\164\x75\163") == "\x4d\x4f\137\117\x54\120\137\x44\105\114\x49\x56\105\122\x45\x44\137\123\125\103\103\x45\123\x53" || get_site_option("\155\x6f\137\x69\x64\x70\x5f\162\x65\147\x69\x73\x74\x72\141\x74\151\x6f\156\137\163\x74\x61\164\165\163") == "\115\x4f\137\x4f\x54\120\x5f\x56\101\114\111\x44\101\x54\x49\x4f\116\137\x46\x41\x49\114\x55\122\105" || get_site_option("\155\157\x5f\x69\144\160\x5f\162\145\x67\151\163\x74\x72\x61\164\x69\x6f\156\x5f\x73\x74\x61\x74\x75\x73") == "\115\x4f\137\x4f\x54\120\137\104\105\x4c\111\x56\x45\122\105\x44\x5f\x46\x41\111\x4c\x55\x52\105") {
    goto Hq;
}
if (!$Q4) {
    goto c4;
}
if ($Q4 && !$rt) {
    goto Cy;
}
require_once MoIDPConstants::SSO_IDP_SETTINGS;
goto NA;
Cy:
require_once MoIDPConstants::VIEWS_VERIFY_LK;
NA:
goto C_;
c4:
delete_site_option("\160\x61\163\x73\x77\x6f\162\x64\x5f\155\x69\x73\x6d\x61\x74\x63\150");
update_site_option("\x6d\x6f\137\x69\144\x70\x5f\x6e\x65\167\137\x72\x65\147\151\163\164\x72\x61\164\x69\157\156", "\x74\162\165\145");
$current_user = wp_get_current_user();
require_once MoIDPConstants::VIEWS_NEW_REGISTRATION;
C_:
goto bk;
Hq:
require_once MoIDPConstants::VIEWS_VERIFY_OTP;
bk:
goto DJ;
Q_:
require_once MoIDPConstants::VIEWS_VERIFY_CUSTOMER;
DJ:
goto bz;
LF:
require_once MoIDPConstants::VIEWS_VERIFY_CUSTOMER;
bz:
