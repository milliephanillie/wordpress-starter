<?php


use IDP\Helper\Utilities\MoIDPUtility;
use IDP\Helper\Constants\MoIDPConstants;
global $dbIDPQueries;
$LT = $dbIDPQueries->get_sp_list();
$Al = !$Q4 || !$rt ? "\x64\151\163\x61\142\x6c\x65\144" : '';
$zc = $_GET["\x70\141\147\145"];
$rA = isset($_GET["\141\143\x74\x69\x6f\x6e"]) ? $_GET["\x61\143\x74\x69\x6f\x6e"] : '';
$pU = $rA == "\x61\x64\144\137\x77\163\146\145\144\x5f\x61\x70\x70" ? "\127\x53\106\105\104" : ($rA == "\x61\144\144\x5f\152\167\x74\137\x61\x70\160" ? "\x4a\127\x54" : "\x53\x41\115\114");
$wE = remove_query_arg(array("\x61\x63\x74\151\x6f\x6e", "\151\144"), $_SERVER["\x52\105\121\x55\x45\123\124\137\125\122\111"]);
$KS = remove_query_arg(array("\141\143\164\x69\157\x6e", "\x69\144"), $_SERVER["\x52\105\x51\x55\x45\123\x54\x5f\x55\x52\111"]);
$hu = add_query_arg(array("\160\x61\147\145" => $tx->_menuSlug), $_SERVER["\122\105\121\125\x45\123\x54\137\x55\122\111"]);
$vB = add_query_arg(array("\160\141\x67\x65" => $Dz->_menuSlug), $_SERVER["\122\105\121\125\105\x53\x54\x5f\125\122\111"]);
$zs = add_query_arg(array("\141\x63\x74\151\x6f\156" => "\x64\145\x6c\145\x74\x65\137\163\160\137\163\145\164\x74\x69\156\x67\x73"), $_SERVER["\122\105\121\x55\x45\123\124\137\x55\x52\x49"]) . "\x26\x69\x64\75";
$sf = add_query_arg(array("\141\x63\164\151\x6f\x6e" => "\141\144\144\x5f\163\160"), $_SERVER["\x52\105\x51\125\105\123\124\137\x55\122\x49"]);
$Ql = add_query_arg(array("\x61\143\164\x69\x6f\x6e" => "\x73\150\157\167\x5f\x69\144\x70\137\x73\145\164\x74\x69\x6e\x67\163"), $_SERVER["\x52\x45\121\125\105\123\124\137\x55\122\111"]) . "\46\x69\144\x3d";
$c2 = "\x43\x6f\x70\171\x20\x61\x6e\x64\x20\x50\141\x73\x74\145\40\x74\x68\x65\x20\x63\157\156\164\x65\156\164\x20\x66\162\157\x6d\x20\164\x68\x65\40\x64\157\x77\156\x6c\x6f\x61\144\x65\x64\x20\143\145\x72\164\x69\146\x69\143\x61\164\x65\40" . "\157\162\40\143\157\160\x79\40\x74\150\x65\40\143\x6f\156\164\145\x6e\164\x20\145\156\x63\x6c\x6f\x73\x65\x64\x20\x69\156\40\x27\130\65\60\x39\103\145\x72\x74\x69\146\151\x63\141\x74\x65\47\40\164\141\x67\x20\50\x68\141\x73\x20\x70\141\162\x65\x6e\x74\40" . "\x74\x61\147\x20\x27\113\145\x79\x44\145\163\143\162\x69\160\164\x6f\162\40\165\x73\x65\75\x73\x69\x67\x6e\151\156\147\47\51\40\x69\x6e\x20\123\120\x2d\x4d\x65\x74\141\x64\141\x74\x61\40\x58\115\x4c\40\x66\x69\154\x65";
$A6 = "\x43\157\x70\171\40\141\156\x64\40\x50\141\163\x74\145\40\x74\x68\145\40\143\157\x6e\x74\x65\x6e\x74\40\x66\x72\157\x6d\40\164\x68\145\x20\x64\x6f\167\x6e\x6c\157\x61\144\x65\x64\40\143\145\x72\x74\x69\x66\x69\143\141\x74\x65\x20\157\162\x20" . "\143\x6f\160\171\40\164\x68\145\x20\143\x6f\156\164\145\156\164\40\x65\156\x63\154\157\163\145\144\40\x69\156\40\47\x58\x35\x30\71\103\x65\x72\x74\151\146\x69\x63\x61\164\145\47\40\x74\141\147\x20\x28\x68\141\163\40\160\141\162\145\156\x74\x20\x74\141\147\x20" . "\x27\x4b\x65\171\x44\145\x73\x63\162\x69\160\164\157\162\x20\165\163\x65\x3d\x65\x6e\143\162\171\160\x74\x69\157\156\47\51\40\x69\x6e\40\123\x50\x2d\x4d\145\164\x61\144\141\164\x61\x20\130\x4d\x4c\40\146\x69\x6c\145";
$h9 = TRUE;
if (isset($rA) && $rA == "\x73\150\x6f\x77\x5f\151\144\x70\137\163\145\x74\x74\x69\x6e\x67\163") {
    goto ox;
}
if (isset($rA) && $rA == "\144\x65\x6c\145\x74\145\137\163\x70\x5f\163\145\x74\x74\x69\x6e\147\x73") {
    goto mD;
}
if (isset($rA) && ($rA == "\141\x64\x64\x5f\x73\x70" || $rA == "\x61\x64\144\137\x77\163\x66\145\x64\x5f\141\x70\x70") || $rA == "\x61\x64\x64\137\x6a\167\x74\137\141\x70\x70") {
    goto XH;
}
if (empty($LT)) {
    goto kb;
}
$FY = MoIDPUtility::gssc();
$Qj = get_site_option("\155\157\x5f\151\x64\160\x5f\163\x70\137\143\157\x75\x6e\x74");
$UK = max((int) $Qj - (int) $FY, 0);
$x6 = $dbIDPQueries->get_users();
$UV = get_site_option("\155\157\137\151\x64\160\x5f\143\x75\x73\164\x6f\155\x65\x72\137\164\157\153\145\x6e");
$Bk = \AESEncryption::decrypt_data(get_site_option("\x6d\x6f\137\x69\x64\x70\x5f\165\x73\162\x5f\x6c\x6d\x74"), $UV);
$fD = MoIDPUtility::isBlank($Bk) ? null : $Bk - $x6;
$il = get_site_option("\x6d\157\x5f\x69\x64\160\137\x73\x68\x6f\x77\x5f\163\x73\157\137\165\163\x65\x72\x73") ? "\x63\150\145\143\153\x65\144" : '';
require_once MoIDPConstants::VIEWS_IDP_LIST;
goto aY;
kb:
$Oc = $pU == "\123\101\x4d\114" ? "\x41\104\x44\x20\x4e\105\127\x20\x53\x41\x4d\114\x20\123\x45\x52\x56\x49\103\105\x20\120\122\x4f\126\x49\104\x45\122" : ($pU == "\x4a\127\x54" ? "\x41\x44\104\40\x4e\x45\x57\x20\112\127\124\40\x41\x50\120" : "\x41\104\x44\x20\x4e\x45\127\40\127\x53\x2d\106\x45\104\x20\123\x45\122\x56\111\103\105\40\120\x52\117\126\111\x44\105\122");
$r5 = '';
$Lm = '';
if ($pU == "\x4a\127\124") {
    goto lD;
}
if ($pU == "\127\x53\106\105\104") {
    goto sz;
}
require_once MoIDPConstants::VIEWS_IDP_SETTINGS;
goto KS;
sz:
require_once MoIDPConstants::VIEWS_IDP_WSFED_SETTINGS;
KS:
goto JD;
lD:
require_once MoIDPConstants::VIEWS_IDP_JWT_SETTINGS;
JD:
aY:
goto ap;
XH:
$Lm = '';
$FY = MoIDPUtility::gssc();
$Qj = json_decode(MoIDPUtility::ccl(), true);
$Oc = $pU == "\x53\101\x4d\x4c" ? "\101\x44\104\40\x4e\x45\127\40\123\101\x4d\114\x20\123\x45\122\x56\x49\x43\x45\40\x50\x52\117\x56\x49\x44\105\122" : ($pU == "\x4a\x57\124" ? "\x41\x44\x44\x20\x4e\105\x57\40\112\x57\x54\40\x41\x50\x50" : "\101\104\x44\40\116\x45\x57\x20\x57\123\x2d\x46\105\x44\x20\x53\105\x52\126\x49\103\105\x20\x50\122\117\126\111\x44\105\122");
$r5 = '';
$CF = MoIDPConstants::HOSTNAME;
$YP = $CF . "\x2f\155\157\141\x73\57\154\157\x67\151\156";
$QQ = get_site_option("\155\157\x5f\x69\x64\160\x5f\141\144\155\151\156\137\145\155\x61\151\154");
if (strcasecmp($Qj["\x73\x74\x61\164\165\163"], "\123\125\x43\103\x45\123\x53") == 0 && $Qj["\156\157\x4f\146\123\120"] > $FY) {
    goto x0;
}
require_once MoIDPConstants::VIEWS_IDP_ERROR;
goto Z1;
x0:
update_site_option("\x6d\157\137\151\144\160\x5f\x73\160\x5f\143\x6f\165\x6e\164", $Qj["\156\157\117\x66\123\x50"]);
if ($pU == "\112\127\124") {
    goto Rl;
}
if ($pU == "\127\123\x46\x45\104") {
    goto ve;
}
require_once MoIDPConstants::VIEWS_IDP_SETTINGS;
goto UM;
ve:
require_once MoIDPConstants::VIEWS_IDP_WSFED_SETTINGS;
UM:
goto gJ;
Rl:
require_once MoIDPConstants::VIEWS_IDP_JWT_SETTINGS;
gJ:
Z1:
ap:
goto b0;
mD:
$Lm = $dbIDPQueries->get_sp_data($_GET["\x69\144"]);
require_once MoIDPConstants::VIEWS_IDP_DELETE;
b0:
goto I_;
ox:
$Lm = $dbIDPQueries->get_sp_data($_GET["\151\144"]);
$Oc = "\x45\x44\x49\124\40" . (!empty($Lm) ? $Lm->mo_idp_sp_name : "\x49\104\x50") . "\40\x53\105\124\x54\x49\x4e\x47\x53";
$h9 = FALSE;
$Ig = $Lm->mo_idp_protocol_type == "\112\x57\124" ? "\x74\x65\x73\x74\x5f\x6a\167\164" : "\164\x65\163\164\x43\157\x6e\x66\x69\147";
$r5 = site_url() . "\x2f\x3f\157\x70\x74\151\x6f\x6e\x3d" . $Ig . "\x26\141\x63\x73\75" . $Lm->mo_idp_acs_url . "\x26\x69\163\163\x75\145\162\75" . $Lm->mo_idp_sp_issuer . "\x26\144\x65\146\x61\x75\x6c\x74\122\145\154\141\x79\x53\164\x61\x74\x65\x3d" . $Lm->mo_idp_default_relayState;
if ($Lm->mo_idp_protocol_type == "\112\127\x54") {
    goto zc;
}
if ($Lm->mo_idp_protocol_type == "\127\x53\106\x45\x44") {
    goto IQ;
}
require_once MoIDPConstants::VIEWS_IDP_SETTINGS;
goto Ke;
IQ:
require_once MoIDPConstants::VIEWS_IDP_WSFED_SETTINGS;
Ke:
goto um;
zc:
require_once MoIDPConstants::VIEWS_IDP_JWT_SETTINGS;
um:
I_:
