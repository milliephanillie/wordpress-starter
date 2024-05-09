<?php


global $dbIDPQueries, $wp_roles;
use IDP\Helper\Utilities\MoIDPUtility;
use IDP\Helper\Constants\MoIDPConstants;
$Lm = $dbIDPQueries->get_sp_list();
$gX = wp_logout_url(site_url());
$Al = $Q4 && $rt ? '' : "\x64\151\163\141\142\154\145\144\x20\164\151\x74\x6c\x65\75\x22\104\151\x73\141\x62\x6c\145\x64\56\40\103\157\x6e\146\151\x67\165\162\145\40\171\157\x75\x72\x20\x53\x65\x72\x76\151\x63\145\40\x50\x72\157\166\151\x64\145\162\x22";
$fh = add_query_arg(array("\160\x61\147\x65" => $tk->_menuSlug), $_SERVER["\122\x45\121\125\105\123\x54\137\x55\x52\111"]);
$iy = esc_url(get_site_option("\155\x6f\x5f\x69\144\160\x5f\143\x75\x73\x74\157\155\x5f\x6c\x6f\x67\x69\x6e\137\x75\x72\x6c"));
$Uj = $wp_roles->role_names;
$GB = array_keys($wp_roles->role_names);
$KX = array_values($wp_roles->role_names);
$XO = '';
$Bh = get_site_option("\155\x6f\x5f\x69\x64\x70\137\163\163\157\137\141\x6c\154\157\167\145\x64\137\x72\157\x6c\145\163");
$y7 = !is_array($Bh) ? array() : MoIDPUtility::sanitizeAssociativeArray($Bh);
$bX = get_site_option("\155\157\137\x69\144\160\x5f\162\x6f\154\x65\x5f\142\141\x73\x65\x64\x5f\x72\x65\163\x74\162\151\143\x74\x69\157\x6e");
$KG = empty($bX) ? '' : "\143\150\145\x63\x6b\x65\x64";
$zq = empty($bX) ? "\150\151\144\144\x65\x6e" : '';
$Jl = end($GB);
foreach ($GB as $BD) {
    if (isset($y7[$BD])) {
        goto G0;
    }
    goto U9;
    goto AA;
    G0:
    if (!($Jl === $BD)) {
        goto Jj;
    }
    $XO = "\143\x68\x65\x63\x6b\145\x64";
    Jj:
    AA:
    XA:
}
U9:
require_once MoIDPConstants::VIEWS_SIGNIN_SETTINGS;
