<?php


use IDP\Helper\Utilities\MoIDPUtility;
use IDP\Helper\Constants\MoIDPConstants;
use IDP\Helper\Utilities\SAMLUtilities;
$rS = site_url("\57\x3f\157\x70\x74\x69\157\x6e\75\155\157\137\151\144\x70\x5f\155\145\164\141\144\x61\164\x61");
$CW = MSI_DIR . "\x6d\x65\164\x61\x64\x61\164\141\56\x78\155\154";
$r3 = get_site_option("\x6d\157\x5f\151\x64\x70\137\160\162\157\x74\x6f\143\157\x6c");
$Wq = MSI_URL;
$xI = is_multisite() ? get_sites() : null;
$gT = is_null($xI) ? site_url("\57") : get_site_url($xI[0]->blog_id, "\x2f");
$ot = MoIDPUtility::getPublicCertURL();
$I3 = SAMLUtilities::desanitize_certificate(MoIDPUtility::getPublicCert());
$b6 = openssl_x509_parse(MoIDPUtility::getPublicCert());
$qJ = date(DATE_RFC2822, $b6["\x76\x61\x6c\151\x64\x54\157\137\x74\151\x6d\145\x5f\x74"]);
$J3 = add_query_arg(array("\160\x61\147\x65" => $tx->_menuSlug), $_SERVER["\122\x45\x51\125\x45\x53\124\137\125\x52\111"]);
$Dr = get_site_option("\155\x6f\x5f\x69\x64\160\137\145\156\164\x69\164\x79\137\151\144") ? get_site_option("\x6d\x6f\x5f\x69\144\x70\137\x65\156\164\151\x74\x79\x5f\x69\144") : $Wq;
$nc = "\x53\x65\x74\55\x4d\x73\x6f\154\104\157\x6d\141\151\x6e\x41\x75\x74\150\x65\x6e\x74\x69\143\x61\x74\151\x6f\x6e\40\x2d\x41\x75\x74\x68\145\x6e\164\151\x63\x61\x74\x69\157\x6e\40\106\x65\x64\x65\x72\141\x74\x65\x64\x20\x2d\104\x6f\x6d\141\x69\x6e\116\141\155\x65\40" . "\x20\x3c\142\76\x26\154\164\x3b\x79\x6f\x75\162\x5f\144\x6f\x6d\x61\151\156\46\147\x74\x3b\74\57\x62\76\40" . "\x2d\111\x73\163\x75\x65\162\x55\162\151\x20\42" . $Dr . "\42\40\55\x4c\157\x67\x4f\146\x66\125\x72\151\40\42" . $gT . "\42\40\55\120\x61\x73\163\151\x76\x65\x4c\157\147\117\x6e\x55\162\x69\x20\42" . $gT . "\42\x20\x2d\x53\x69\x67\x6e\151\156\147\103\x65\x72\x74\151\x66\x69\143\141\x74\145\40\x22" . $I3 . "\42\x20\55\x50\x72\145\x66\145\x72\x72\x65\144\101\165\164\x68\145\156\x74\151\143\141\164\151\157\156\x50\x72\x6f\x74\x6f\143\x6f\x6c\x20\x57\x53\106\x45\104";
if (!(!file_exists($CW) || filesize($CW) == 0)) {
    goto GL;
}
MoIDPUtility::createMetadataFile();
GL:
require_once MoIDPConstants::VIEWS_IDP_DATA;
