<?php


use IDP\Helper\Utilities\MoIDPUtility as MoIDPUtility;
use IDP\Helper\Utilities\TabDetails;
use IDP\Helper\Utilities\Tabs;
function get_user_data_select_box($Al, $Z2, $Lm, $uy = null, $mw = 0)
{
    echo "\x3c\x74\144\76\74\x73\145\154\x65\x63\164\40" . $Al . "\x20\x73\x74\171\154\145\x3d\42\x77\151\144\x74\150\x3a\71\x30\x25\x22\40\x6e\x61\155\145\x3d\42\155\x6f\137\x69\x64\160\137\141\x74\164\162\151\x62\165\x74\145\137\155\141\160\x70\151\x6e\x67\137\x76\141\154\133" . $mw . "\135\x22\40";
    echo !MoIDPUtility::micr() || !isset($Lm) ? "\x64\151\163\x61\142\154\x65\144" : '';
    echo "\x3e\x3c\157\160\164\151\x6f\x6e\x20\166\141\154\x75\x65\75\42\x22\x3e\123\145\154\x65\143\x74\40\x55\163\x65\162\40\x44\x61\x74\141\40\x74\157\x20\142\145\40\x73\x65\156\x74\74\57\157\160\x74\x69\x6f\x6e\76";
    foreach ($Z2 as $UV => $Ev) {
        echo "\74\x6f\160\164\x69\x6f\x6e\x20\x76\x61\x6c\165\145\75\42" . $UV . "\42";
        if (is_null($uy)) {
            goto Sb;
        }
        echo $uy->mo_sp_attr_value === $UV ? "\x73\x65\154\145\x63\164\145\144" : '';
        Sb:
        echo "\x3e" . $UV . "\74\57\x6f\160\164\x69\157\x6e\x3e";
        KF:
    }
    qA:
    echo "\x3c\x2f\x74\162\x3e\74\57\x74\x64\x3e";
}
function get_nameid_select_box($Al, $Lm)
{
    $Z2 = get_user_info_list();
    $qe = !empty($Lm->mo_idp_nameid_attr) && $Lm->mo_idp_nameid_attr != "\x65\155\x61\151\x6c\x41\144\x64\x72\145\163\x73" ? $Lm->mo_idp_nameid_attr : "\x75\163\x65\162\x5f\x65\x6d\x61\151\154";
    if (isset($Lm) && !empty($Lm)) {
        goto qq;
    }
    echo "\x3c\144\151\x76\x20\143\154\x61\x73\x73\x3d\42\155\x6f\137\151\144\160\x5f\x6e\x6f\164\x65\x22\x20\x73\x74\x79\x6c\x65\75\42\160\141\x64\x64\x69\156\x67\72\x30\x2e\x35\x65\155\x3b\x22\76\x50\x6c\x65\141\x73\145\x20\x43\157\156\x66\151\x67\x75\x72\x65\x20\141\x20\x53\145\162\166\151\143\x65\40\120\x72\157\166\x69\144\145\162\74\57\144\151\x76\x3e";
    goto BY;
    qq:
    echo "\x3c\x73\145\154\x65\143\164\x20" . $Al . "\40\163\164\171\x6c\145\75\x27\x77\x69\144\x74\150\72\66\x30\45\x27\40\156\x61\x6d\x65\x3d\x27\151\144\x70\x5f\156\x61\x6d\145\151\x64\x5f\x61\x74\x74\x72\47";
    echo !MoIDPUtility::micr() || !isset($Lm) ? "\x64\x69\163\x61\142\x6c\x65\144" : '';
    echo "\76\74\157\160\x74\x69\157\x6e\x20\166\141\x6c\165\145\75\x27\x27\x3e\123\x65\x6c\x65\x63\164\40\x44\141\164\x61\x20\164\157\x20\142\145\40\163\x65\x6e\x74\40\151\156\x20\x74\150\x65\40\x4e\141\x6d\x65\x49\104\74\x2f\x6f\x70\164\x69\157\x6e\x3e";
    foreach ($Z2 as $UV => $Ev) {
        echo "\x3c\157\160\x74\151\x6f\156\x20\x76\x61\x6c\x75\x65\75\47" . $UV . "\x27";
        if (is_null($Lm)) {
            goto BM;
        }
        echo $qe === $UV ? "\163\145\154\x65\143\x74\145\144" : '';
        BM:
        echo "\76" . $UV . "\x3c\x2f\157\160\164\x69\x6f\x6e\x3e";
        Aw:
    }
    m7:
    echo "\74\57\163\145\x6c\x65\x63\x74\76";
    BY:
}
function get_service_provider_dropdown($LT)
{
    global $dbIDPQueries;
    $Q4 = MoIDPUtility::micr();
    $Lm = null;
    if (!(isset($LT) && !empty($LT))) {
        goto Ab;
    }
    echo "\x3c\x73\160\x61\156\40\163\164\171\x6c\x65\75\42\146\x6f\156\164\x2d\163\x69\172\145\x3a\x31\63\160\170\x3b\146\x6c\157\x61\164\72\162\151\147\150\x74\x3b\x6d\x61\x72\147\x69\x6e\55\x74\157\x70\x3a\55\x31\60\160\170\73\40\x6d\141\x72\x67\x69\x6e\55\162\x69\147\150\x74\72\61\60\160\x78\42\x3e\12\x9\x9\x9\x9\40\x20\40\x20\x3c\x73\x65\154\145\143\x74\x20\x6e\x61\x6d\x65\75\x22\163\145\162\166\151\x63\x65\x5f\x70\162\157\x76\151\144\x65\x72\x22\40\162\145\161\165\x69\x72\145\144\40" . (!$Q4 || !isset($LT) ? "\144\x69\x73\x61\x62\x6c\x65\144" : '') . "\x3e\12\11\x9\x9\11\40\40\40\40\40\40\40\x20\74\x6f\x70\x74\x69\x6f\156\x20\x64\151\x73\x61\x62\154\x65\x64\x20\x76\141\154\165\145\x3d\x22\42\76\123\x65\x6c\145\143\x74\40\123\x50\x3c\57\157\160\x74\151\x6f\x6e\x3e";
    $tW = isset($_SESSION["\123\120"]) ? $_SESSION["\123\x50"] : $LT[0]->id;
    foreach ($LT as $Lm) {
        echo "\x3c\x6f\160\164\x69\157\x6e\x20";
        echo $tW === $Lm->id ? "\163\145\x6c\x65\143\164\145\144" : '';
        echo "\x20\166\x61\154\x75\x65\75\47" . $Lm->id . "\x27\x3e" . $Lm->mo_idp_sp_name . "\x3c\x2f\157\x70\164\x69\157\x6e\76";
        oy:
    }
    YM:
    $Lm = $dbIDPQueries->get_sp_data($tW);
    echo "\40\x20\x20\x20\x3c\57\x73\x65\x6c\x65\x63\x74\76\12\x9\x9\11\74\x2f\x73\x70\x61\156\76\xa\11\x9\x9\x3c\146\x6f\162\155\40\163\x74\x79\154\145\75\42\x64\151\163\x70\x6c\x61\171\x3a\156\157\x6e\145\42\40\x69\x64\75\x22\x63\x68\141\156\x67\x65\x5f\163\160\x22\40\155\x65\x74\150\157\144\75\42\x70\x6f\x73\x74\x22\x20\x61\x63\164\151\x6f\156\x3d\42\42\76\12\x9\x9\x9\11\x3c\151\x6e\x70\x75\x74\40\164\x79\x70\145\x3d\42\x68\151\x64\144\x65\156\x22\40\156\141\x6d\x65\75\42\157\x70\x74\x69\x6f\x6e\42\x20\166\x61\154\x75\x65\x3d\42\x6d\x6f\x5f\163\150\157\x77\137\x73\160\x5f\x73\x65\x74\164\151\x6e\147\163\x22\40\x2f\76\12\x9\11\11\x9\x3c\x69\156\x70\x75\x74\40\x74\171\160\x65\75\42\x68\x69\x64\144\145\x6e\42\40\x6e\141\155\x65\75\42\x73\145\x72\166\151\x63\145\137\160\162\x6f\166\x69\x64\145\x72\x22\40\x76\141\154\165\145\75\42\42\40\x2f\76\12\x9\x9\11\74\x2f\146\x6f\x72\155\x3e";
    Ab:
    return $Lm;
}
function get_sp_attr_name_value($Lm, $Al)
{
    global $dbIDPQueries;
    $ne = array();
    $nM = 0;
    $Z2 = get_user_info_list();
    if (isset($Lm) && !empty($Lm)) {
        goto y3;
    }
    echo "\x3c\164\x72\40\151\144\75\42\x63\162\x6f\x77\x5f\60\42\x3e\xa\11\x9\x9\x9\11\74\164\144\76\74\x64\x69\166\40\x63\x6c\x61\163\163\75\x22\x6d\157\137\151\144\x70\137\x6e\157\x74\145\x22\76\x50\x6c\145\x61\163\x65\40\x43\x6f\156\x66\x69\147\x75\x72\x65\x20\x61\x20\x53\145\x72\166\151\143\x65\40\x50\x72\157\x76\x69\144\x65\162\x3c\x2f\144\x69\166\x3e\x3c\57\164\x64\x3e\xa\11\11\x9\11\11\x3c\x74\144\x3e\x3c\x64\151\x76\40\143\154\x61\163\163\x3d\42\x6d\x6f\x5f\x69\144\160\137\156\x6f\164\145\42\76\x50\x6c\145\x61\163\145\40\x43\157\156\146\151\x67\x75\162\x65\40\141\x20\x53\x65\162\166\x69\143\145\40\x50\162\157\166\151\x64\145\162\74\x2f\x64\x69\166\76\x3c\57\164\x64\76\12\x9\11\x9\x9\x20\40\x3c\x2f\164\x72\x3e";
    goto e0;
    y3:
    $LE = $dbIDPQueries->get_sp_attributes($Lm->id);
    $BO = $dbIDPQueries->get_sp_role_attribute($Lm->id);
    if (isset($LE) && !empty($LE)) {
        goto eh;
    }
    echo "\x3c\x74\x72\x20\151\x64\75\42\162\x6f\167\137\x30\x22\x3e\74\164\144\x3e\x3c\151\156\160\x75\164\40\x74\171\160\145\75\x22\164\145\170\x74\42\40\x6e\x61\155\x65\75\42\155\157\137\x69\144\x70\x5f\141\x74\164\162\151\142\x75\x74\145\137\x6d\x61\x70\x70\x69\156\x67\x5f\x6e\141\155\x65\x5b\x30\135\42\40\160\x6c\x61\x63\x65\x68\x6f\x6c\x64\145\162\75\x22\x4e\x61\x6d\x65\42\x2f\76\x3c\57\164\x64\x3e";
    get_user_data_select_box($Al, $Z2, $Lm);
    goto eq;
    eh:
    foreach ($LE as $uy) {
        if (!($uy->mo_sp_attr_name != "\x67\162\157\165\160\x4d\x61\160\116\141\155\x65")) {
            goto BX;
        }
        echo "\74\x74\x72\x20\151\144\x3d\x22\162\x6f\167\137" . $nM . "\42\x3e";
        echo "\40\x20\74\164\144\x3e\12\40\40\x20\x20\x20\x20\40\x20\40\x20\x20\x20\40\x20\40\x20\40\x20\40\x20\x20\x20\40\x20\x20\40\x20\x20\40\40\40\40\74\151\156\160\165\x74\x20\40\164\x79\x70\145\x3d\x22\164\x65\x78\164\42\x20" . $Al . "\40\12\40\x20\x20\x20\x20\40\40\40\x20\x20\x20\x20\40\x20\x20\x20\x20\x20\x20\x20\40\x20\x20\x20\x20\x20\40\40\x20\40\x20\40\40\40\x20\40\x20\x20\x20\x20\x6e\141\x6d\145\x3d\x22\x6d\157\x5f\151\x64\x70\137\x61\x74\164\x72\x69\142\165\x74\x65\x5f\155\141\160\x70\x69\x6e\147\137\156\x61\155\x65\x5b" . $nM . "\x5d\42\40\xa\x20\x20\40\x20\x20\40\40\x20\40\40\x20\x20\x20\40\40\x20\40\40\40\40\x20\x20\x20\x20\40\40\x20\40\x20\x20\x20\x20\x20\40\x20\40\x20\x20\x20\40\160\x6c\x61\x63\x65\x68\x6f\x6c\x64\x65\x72\x3d\x22\116\141\155\145\x22\x20\xa\x20\x20\x20\x20\40\x20\40\40\40\40\x20\40\40\x20\x20\x20\x20\x20\40\x20\x20\x20\40\40\x20\x20\x20\x20\x20\40\x20\40\40\40\40\40\40\x20\x20\x20\x76\141\x6c\165\x65\x3d\42" . $uy->mo_sp_attr_name . "\42\x2f\x3e\12\x20\x20\x20\x20\x20\40\x20\x20\x20\40\40\x20\x20\x20\40\40\x20\40\40\40\40\40\40\x20\x20\x20\x20\x20\x3c\x2f\x74\144\76";
        get_user_data_select_box($Al, $Z2, $Lm, $uy, $nM);
        $nM += 1;
        BX:
        zz:
    }
    Bb:
    eq:
    if (!(isset($BO) && !empty($BO))) {
        goto PJ;
    }
    $ne["\147\x72\157\165\160\115\141\160\116\141\x6d\x65"] = $BO->mo_sp_attr_value;
    PJ:
    e0:
    $ne["\165\163\145\162\137\151\156\146\157"] = $Z2;
    $ne["\x63\x6f\165\156\x74\x65\x72"] = $nM;
    return $ne;
}
function get_user_info_list()
{
    global $dbIDPQueries;
    $current_user = wp_get_current_user();
    $Z2 = $dbIDPQueries->getDistinctMetaAttributes();
    foreach ($Z2 as $UV => $Ev) {
        $lS[$Ev->meta_key] = $Ev->meta_key;
        G2:
    }
    zm:
    foreach ($current_user->data as $UV => $Ev) {
        $lS[$UV] = $UV;
        Ib:
    }
    ik:
    $lS = apply_filters("\165\163\x65\162\x5f\x69\x6e\146\x6f\137\141\164\x74\x72\x5f\154\x69\163\164", $lS);
    return $lS;
}
function check_is_curl_installed()
{
    if (MoIDPUtility::isCurlInstalled()) {
        goto Pt;
    }
    echo "\x3c\x64\x69\166\x20\151\x64\x3d\42\x68\145\154\x70\x5f\x63\165\162\154\137\167\x61\x72\156\151\156\147\137\x74\x69\164\x6c\x65\x22\x20\143\154\x61\x73\163\75\x22\155\157\137\167\160\x75\x6d\137\x74\x69\x74\x6c\x65\137\x70\x61\156\x65\x6c\42\76\12\11\11\11\40\40\40\40\74\160\x3e\12\11\x9\11\x20\40\x20\40\x20\40\40\x20\74\146\x6f\x6e\x74\x20\143\x6f\x6c\x6f\162\x3d\x22\43\x46\106\60\60\x30\60\x22\76\xa\x9\11\x9\40\40\40\40\x20\40\x20\40\40\40\x20\40\127\141\x72\156\151\156\147\72\x20\120\x48\x50\40\x63\125\x52\x4c\x20\x65\170\x74\145\x6e\163\151\157\156\x20\151\x73\40\x6e\157\164\x20\151\x6e\163\164\141\x6c\154\x65\144\40\157\162\40\x64\x69\163\x61\x62\154\145\144\56\x20\xa\11\11\x9\40\40\40\40\40\x20\40\40\40\x20\40\40\x3c\x73\x70\141\156\40\x73\164\x79\x6c\x65\x3d\x22\x63\157\x6c\157\x72\x3a\x62\x6c\165\145\x22\76\x43\154\x69\x63\153\40\150\x65\162\145\74\57\x73\x70\141\x6e\76\x20\146\157\x72\40\151\x6e\163\164\x72\x75\143\x74\151\157\x6e\163\40\x74\x6f\x20\145\156\x61\142\154\145\40\x69\164\x2e\xa\40\x20\40\x20\40\40\x20\40\40\x20\40\x20\x20\x20\x20\x20\40\40\x20\x20\74\57\146\x6f\x6e\164\x3e\12\x20\x20\x20\x20\x20\x20\40\x20\40\40\40\40\x20\x20\x20\x20\74\x2f\160\76\xa\x9\11\x3c\x2f\x64\151\x76\76\12\11\11\x3c\144\x69\x76\40\x68\151\144\x64\x65\156\x3d\x22\x22\40\151\x64\x3d\42\x68\x65\x6c\x70\137\x63\165\162\154\137\167\141\162\156\x69\x6e\147\x5f\x64\x65\163\143\x22\x20\x63\x6c\x61\163\163\75\42\x6d\x6f\137\167\160\165\155\137\150\145\154\x70\137\144\145\x73\143\42\x3e\12\x9\11\x9\x3c\165\154\x3e\xa\x9\11\x9\x9\x3c\x6c\x69\x3e\123\x74\x65\160\x20\61\72\46\156\x62\x73\x70\x3b\x26\156\142\163\160\73\46\x6e\142\x73\160\x3b\x26\156\x62\x73\x70\x3b\117\160\x65\x6e\x20\x70\150\x70\x2e\151\x6e\x69\x20\x66\151\x6c\x65\40\x6c\x6f\x63\x61\164\145\x64\x20\x75\x6e\x64\145\x72\x20\x70\150\x70\x20\151\156\x73\x74\x61\x6c\154\x61\164\151\157\x6e\x20\146\157\x6c\x64\x65\x72\56\x3c\57\154\x69\76\xa\x9\11\x9\x9\x3c\154\151\x3e\123\164\145\x70\40\62\72\46\x6e\x62\x73\x70\x3b\46\x6e\x62\163\160\73\x26\x6e\142\163\x70\73\46\x6e\142\163\160\73\x53\145\x61\162\143\150\x20\146\x6f\162\40\x3c\142\x3e\x65\170\x74\145\156\163\151\x6f\156\x3d\x70\150\x70\x5f\x63\165\x72\x6c\56\144\x6c\154\x3c\57\x62\76\x20\74\x2f\154\151\76\xa\x9\11\x9\11\74\154\x69\76\x53\164\145\x70\40\x33\x3a\46\156\x62\163\160\73\46\x6e\142\163\160\x3b\46\x6e\x62\x73\160\73\46\x6e\x62\163\x70\73\125\x6e\x63\x6f\155\x6d\145\156\164\40\151\164\40\142\x79\x20\x72\145\155\x6f\x76\x69\x6e\x67\40\x74\x68\x65\x20\163\x65\155\151\55\x63\157\x6c\157\156\50\x3c\142\x3e\x3b\74\57\x62\76\51\x20\x69\x6e\40\146\x72\x6f\x6e\164\x20\x6f\146\40\x69\164\56\74\x2f\x6c\151\76\xa\x9\x9\11\11\x3c\x6c\x69\76\123\x74\x65\x70\40\x34\72\46\156\x62\163\160\73\46\x6e\142\x73\x70\73\46\156\142\163\x70\x3b\x26\x6e\x62\x73\160\73\x52\x65\x73\x74\141\x72\x74\x20\164\150\145\x20\101\x70\x61\x63\x68\145\x20\x53\145\x72\x76\x65\162\x2e\x3c\x2f\154\151\76\12\x9\11\11\74\57\x75\x6c\x3e\12\x9\x9\x9\106\x6f\x72\40\x61\x6e\171\40\146\165\x72\164\150\x65\x72\40\161\x75\x65\x72\151\145\x73\54\x20\160\154\x65\x61\163\x65\40\74\141\40\x68\162\x65\x66\75\x22\155\141\x69\154\x74\x6f\72\151\156\146\157\x40\x78\x65\143\165\162\x69\x66\171\x2e\x63\x6f\x6d\42\x3e\x63\157\x6e\164\141\x63\164\40\165\163\x3c\57\x61\x3e\56\11\x9\11\11\11\x9\x9\x9\xa\x9\11\74\57\x64\x69\166\x3e";
    Pt:
}
function is_customer_registered_idp($Q4, $rt)
{
    if (!(!$Q4 || !$rt)) {
        goto wH;
    }
    echo "\x3c\x64\151\166\x20\163\164\x79\x6c\145\75\x22\144\x69\163\160\154\x61\x79\72\142\154\157\x63\153\x3b\155\141\x72\147\151\x6e\x2d\x74\157\x70\72\61\x30\160\170\x3b\x63\157\x6c\x6f\x72\x3a\162\x65\x64\73\12\x20\40\x20\x20\x20\40\40\x20\40\40\x20\40\40\x20\40\40\x20\x20\x20\40\40\40\40\40\40\40\x62\x61\x63\153\147\162\x6f\165\x6e\144\55\143\157\154\157\x72\x3a\x72\147\142\141\50\62\65\x31\54\40\62\x33\x32\54\40\60\54\x20\x30\x2e\61\x35\51\73\xa\x20\40\x20\40\40\40\40\x20\x20\40\40\x20\x20\40\x20\40\40\40\x20\x20\x20\x20\x20\40\40\40\x70\x61\x64\x64\151\x6e\147\72\x35\160\x78\x3b\x62\157\x72\144\145\162\x3a\x73\157\x6c\x69\x64\x20\x31\x70\170\x20\162\147\142\141\x28\62\x35\x35\54\x20\60\x2c\x20\x39\54\40\x30\x2e\63\66\51\73\42\76\12\40\40\40\40\x20\40\40\40\x20\x20\40\x20\40\x20\x20\40\131\157\165\x20\x77\151\154\x6c\40\x68\141\x76\x65\40\164\x6f\40\74\x61\40\x68\x72\145\x66\x3d\42" . getRegistrationURL() . "\42\x3e\x43\x6f\x6d\160\x6c\145\164\x65\40\171\x6f\x75\x72\40\101\x63\164\x69\x76\x61\164\x69\x6f\x6e\x20\120\x72\157\143\145\x73\x73\40\x3c\x2f\x61\76\x20\xa\x20\x20\x20\40\40\40\40\x20\x20\40\40\x20\x20\40\x20\x20\151\x6e\x20\157\162\144\145\x72\x20\164\x6f\40\142\x65\40\141\142\x6c\x65\x20\164\x6f\40\x75\160\x67\162\x61\144\x65\56\12\40\x20\40\40\40\x20\x20\x20\x20\40\x20\40\x20\74\x2f\x64\x69\x76\76";
    wH:
}
function is_plugin_active_multi_host($XT)
{
    if (!$XT) {
        goto r7;
    }
    echo "\x3c\x64\151\x76\x20\163\x74\171\x6c\x65\x3d\42\x64\x69\163\160\x6c\141\x79\72\x62\x6c\x6f\143\153\x3b\x6d\x61\162\x67\151\x6e\x2d\x74\x6f\160\x3a\61\x30\x70\170\x3b\x63\x6f\x6c\x6f\162\72\162\145\144\x3b\xa\x20\40\40\x20\x20\40\x20\x20\x20\40\40\40\40\40\x20\x20\40\40\x20\x20\x20\40\40\x20\x20\40\142\x61\x63\153\x67\x72\157\165\x6e\144\55\143\157\154\157\162\72\162\x67\142\141\x28\62\65\61\x2c\40\x32\x33\62\x2c\40\x30\x2c\40\60\x2e\61\x35\x29\73\xa\40\x20\40\x20\40\x20\40\x20\x20\x20\40\40\40\x20\40\x20\40\x20\x20\x20\x20\x20\40\x20\40\40\x70\141\144\144\151\156\147\72\x35\160\170\x3b\142\x6f\162\144\x65\x72\72\163\x6f\x6c\151\144\40\61\x70\170\40\x72\147\142\141\x28\62\x35\x35\x2c\40\x30\54\40\71\54\x20\60\56\x33\66\x29\73\42\76\xa\x20\40\x20\x20\40\40\x20\x20\x20\40\x20\40\40\40\x20\x20\x59\x6f\165\x20\141\x72\x65\x20\165\163\151\x6e\147\x20\x74\150\x69\163\x20\x6c\151\x63\145\x6e\163\x65\40\153\x65\171\x20\x6f\x6e\40\x6d\165\x6c\164\151\160\154\145\40\127\x6f\x72\x64\x50\162\145\x73\x73\x20\167\x65\x62\163\x69\x74\x65\x73\x2e\40\x50\x6c\x65\x61\x73\145\x20\x64\x65\141\x63\164\151\x76\x61\164\x65\x20\164\150\x65\40\x50\162\x65\155\151\x75\155\40\160\154\x75\x67\x69\x6e\x20\x6f\156\x20\x6f\164\150\x65\x72\40\151\x6e\163\x74\141\x6e\143\x65\163\x2c\12\x20\40\x20\x20\x20\x20\40\x20\40\40\x20\x20\x20\40\x20\40\x6f\162\40\165\x70\147\x72\x61\x64\x65\40\171\157\x75\x72\40\154\151\x63\145\x6e\x73\x65\x20\x69\x6e\40\157\x72\144\x65\162\x20\x74\157\x20\143\x6f\156\x74\151\156\x75\x65\40\165\x73\151\156\x67\x20\164\150\145\40\120\162\145\155\x69\x75\x6d\x20\160\x6c\165\147\x69\156\56\12\x20\x20\x20\x20\40\x20\40\x20\40\40\x20\40\40\74\x2f\144\151\166\x3e";
    r7:
}
function get_custom_sp_attr_name_value($Lm, $Al)
{
    global $dbIDPQueries;
    $nM = 0;
    if (isset($Lm) && !empty($Lm)) {
        goto IA;
    }
    echo "\x3c\x74\162\x20\x69\144\75\x22\x63\162\x6f\x77\x5f\60\x22\76\xa\40\x20\x20\40\40\x20\x20\40\x20\x20\x20\x20\40\40\x20\40\74\x74\x64\x3e\12\x20\x20\x20\x20\40\40\x20\40\x20\x20\40\40\x20\x20\40\40\40\40\x20\x20\74\144\x69\166\40\143\x6c\141\x73\163\75\42\x6d\157\137\151\x64\x70\x5f\156\157\x74\145\42\40\163\x74\171\x6c\x65\x3d\x22\x70\141\144\144\x69\156\147\x3a\x30\56\65\145\155\73\42\76\12\x20\x20\x20\x20\40\x20\x20\x20\x20\x20\40\x20\x20\40\x20\40\x20\x20\x20\40\x20\40\x20\x20\120\154\145\x61\x73\145\x20\103\157\156\146\151\x67\x75\162\x65\x20\141\x20\123\x65\x72\166\x69\x63\x65\x20\120\162\157\x76\x69\144\145\162\12\x20\x20\40\x20\x20\x20\x20\40\x20\40\40\x20\40\40\x20\x20\40\40\x20\x20\74\57\x64\151\x76\76\xa\x20\x20\40\40\40\40\40\40\x20\x20\x20\40\40\x20\40\40\74\57\164\144\x3e\12\40\x20\x20\x20\x20\40\x20\40\x20\40\x20\x20\40\40\x20\40\x3c\x74\144\x3e\xa\40\x20\40\x20\40\x20\x20\40\x20\x20\40\40\40\40\x20\40\40\x20\x20\40\x3c\x64\x69\166\x20\143\154\141\x73\163\75\42\155\157\x5f\151\144\x70\x5f\x6e\x6f\x74\145\42\x20\x73\x74\171\x6c\x65\75\x22\x70\141\x64\144\151\156\147\x3a\x30\56\x35\145\155\x3b\x22\76\xa\40\x20\40\x20\40\x20\x20\40\x20\x20\40\x20\40\x20\40\x20\x20\40\x20\x20\x20\40\40\x20\120\x6c\x65\141\163\x65\x20\103\x6f\156\146\x69\x67\x75\162\x65\40\141\x20\x53\x65\x72\166\x69\x63\x65\x20\120\x72\157\166\x69\144\145\162\xa\40\40\x20\40\x20\x20\40\x20\40\40\40\x20\x20\x20\40\40\40\40\40\x20\x3c\x2f\x64\x69\x76\76\12\40\40\x20\40\x20\40\40\40\40\40\x20\40\x20\x20\x20\x20\x3c\x2f\x74\x64\x3e\xa\40\x20\40\40\40\40\40\x20\40\40\x20\x20\40\40\74\x2f\164\x72\76";
    goto xQ;
    IA:
    $LE = $dbIDPQueries->get_custom_sp_attr($Lm->id);
    if (isset($LE) && !empty($LE)) {
        goto Gm;
    }
    echo "\x3c\164\x72\x20\x69\144\75\42\x63\x72\x6f\x77\137\60\x22\76\xa\x9\11\11\11\11\x3c\164\x64\x3e\12\x9\11\x9\x9\11\x20\40\x20\40\74\x69\156\x70\x75\164\x20\x20\x74\171\160\x65\x3d\42\164\x65\x78\164\x22\x20\xa\11\x9\x9\x9\x9\x20\40\40\40\x20\x20\40\40\x20\x20\40\x20\162\x65\x71\165\151\162\x65\x64\40\xa\x9\x9\11\x9\11\40\40\x20\x20\x20\x20\x20\x20\40\x20\40\x20\156\x61\155\x65\75\42\x6d\x6f\x5f\x69\144\x70\137\141\x74\164\162\151\142\165\x74\145\x5f\155\x61\x70\x70\x69\x6e\147\137\x6e\141\155\145\x5b\60\135\x22\x20\12\11\x9\x9\x9\11\40\40\40\40\40\x20\40\x20\x20\x20\40\x20\x70\154\x61\x63\145\150\157\x6c\x64\x65\162\75\x22\116\x61\155\145\x22\57\76\12\x20\40\40\40\x20\40\x20\x20\40\x20\x20\x20\x20\x20\x20\40\x20\x20\40\x20\74\57\164\144\x3e\12\11\11\x9\11\11\74\x74\x64\x3e\xa\11\11\11\x9\11\x20\40\x20\x20\x3c\x69\156\x70\x75\164\x20\x20\164\x79\x70\x65\x3d\x22\x74\x65\x78\x74\x22\40\xa\x9\11\x9\x9\x9\40\40\x20\40\40\x20\x20\x20\x20\x20\x20\40\162\x65\161\165\151\x72\145\144\40\xa\11\x9\x9\x9\x9\x20\40\40\40\x20\x20\x20\x20\x20\40\x20\x20\x6e\x61\x6d\145\x3d\x22\155\x6f\137\151\144\x70\137\x61\x74\x74\162\151\142\x75\x74\145\x5f\x6d\x61\160\160\151\x6e\x67\137\166\141\154\x5b\60\x5d\42\40\12\x9\x9\x9\x9\11\x20\40\40\40\x20\x20\40\x20\x20\x20\40\x20\163\164\x79\x6c\145\x3d\x22\x77\x69\144\164\x68\72\71\x30\45\x22\40\12\x9\x9\11\11\11\x20\x20\40\x20\x20\x20\x20\x20\x20\40\40\40\160\x6c\141\143\145\x68\157\x6c\144\x65\x72\75\x22\x56\x61\154\x75\x65\x22\57\x3e\12\x20\x20\40\x20\x20\x20\x20\40\40\40\40\40\x20\40\40\x20\x20\40\x20\x20\x3c\x2f\164\x64\x3e\xa\11\x9\11\x9\x20\x20\x3c\x2f\164\x72\x3e";
    goto EI;
    Gm:
    foreach ($LE as $uy) {
        echo "\x3c\164\x72\40\x69\144\x3d\42\x63\162\x6f\x77\x5f" . $nM . "\42\76";
        echo "\x20\x20\40\x20\74\164\144\76\xa\40\40\x20\40\x20\40\x20\x20\x20\x20\x20\40\40\40\40\x20\40\40\x20\x20\40\x20\x20\x20\40\x20\x20\40\x20\40\x20\40\74\151\156\160\165\164\40\40\164\171\x70\145\x3d\x22\164\x65\170\164\42\x20" . $Al . "\x20\12\40\40\40\x20\x20\40\40\40\x20\x20\x20\40\x20\40\x20\x20\40\40\x20\x20\x20\40\x20\x20\40\x20\40\40\x20\40\x20\x20\x20\x20\40\x20\40\x20\x20\40\162\x65\x71\165\x69\162\x65\x64\x20\x6e\x61\155\x65\x3d\42\155\157\137\x69\144\x70\x5f\x61\164\164\x72\x69\142\165\x74\x65\137\x6d\141\x70\x70\151\x6e\147\137\156\x61\155\145\133" . $nM . "\135\42\x20\xa\x20\40\x20\40\40\40\40\x20\40\x20\40\40\40\40\x20\40\x20\40\40\40\x20\x20\40\x20\40\x20\40\40\40\40\40\x20\x20\x20\x20\x20\x20\40\40\40\160\x6c\141\x63\145\150\x6f\x6c\x64\145\x72\x3d\x22\116\x61\x6d\145\42\40\12\40\40\x20\x20\x20\40\40\40\x20\x20\x20\40\x20\x20\40\x20\40\x20\40\x20\x20\x20\x20\x20\x20\x20\40\40\40\40\40\40\x20\x20\40\x20\x20\40\x20\40\166\141\154\x75\x65\75\42" . $uy->mo_sp_attr_name . "\42\x2f\76\12\40\40\40\40\x20\40\x20\x20\40\x20\x20\x20\x20\40\40\x20\40\40\40\x20\40\x20\x20\40\x20\40\x20\40\x20\40\x3c\57\x74\144\x3e";
        echo "\40\x20\40\40\74\164\x64\76\12\40\x20\40\x20\40\40\40\40\40\40\x20\x20\40\40\40\40\x20\40\40\40\40\x20\40\40\x20\40\40\40\x20\40\40\40\x3c\151\x6e\x70\165\164\40\40\164\171\160\x65\75\42\x74\x65\x78\164\42\40\xa\40\40\x20\x20\x20\40\x20\x20\40\x20\x20\x20\40\x20\x20\40\40\x20\40\40\40\x20\40\x20\x20\x20\x20\40\x20\x20\x20\40\x20\x20\40\x20\40\40\x20\40\x73\164\x79\154\145\x3d\x22\167\x69\x64\164\150\72\71\60\45\73\42\x20\12\40\x20\40\40\x20\40\40\x20\x20\40\x20\x20\x20\x20\40\40\x20\40\40\40\x20\x20\x20\x20\40\x20\x20\40\x20\40\40\40\x20\x20\40\x20\40\40\x20\40\156\x61\155\145\x3d\42\x6d\x6f\x5f\151\144\160\x5f\x61\x74\164\x72\x69\142\165\164\x65\x5f\x6d\141\160\160\151\156\147\x5f\x76\x61\154\133" . $nM . "\x5d\42\x20\xa\40\x20\x20\x20\x20\x20\40\40\40\x20\40\x20\x20\40\x20\40\40\40\x20\x20\40\x20\x20\x20\x20\40\40\x20\40\x20\x20\40\40\x20\x20\x20\x20\40\x20\40\x70\154\x61\x63\x65\x68\157\154\144\145\162\75\x22\x56\x61\x6c\x75\145\x22\40\12\x20\40\x20\40\40\x20\40\40\40\40\40\40\x20\x20\x20\40\40\40\40\40\x20\x20\40\40\x20\x20\x20\x20\40\40\x20\40\40\40\x20\40\40\40\x20\40\166\x61\x6c\x75\x65\x3d\x22" . htmlspecialchars($uy->mo_sp_attr_value) . "\x22\x2f\x3e\xa\40\x20\x20\40\x20\x20\40\x20\x20\x20\x20\40\40\40\40\x20\x20\40\x20\40\x20\40\40\x20\40\x20\x20\x20\40\40\74\x2f\x74\x64\x3e";
        $nM += 1;
        up:
    }
    mc:
    EI:
    xQ:
    $ne["\x63\x6f\165\x6e\164\x65\x72"] = $nM;
    return $ne;
}
function show_protocol_options($Lm, $pU)
{
    if (MoIDPUtility::isBlank($Lm)) {
        goto rJ;
    }
    return;
    rJ:
    echo "\12\11\11\x3c\150\63\76\xa\x9\x9\11\x3c\144\x69\166\x20\x63\x6c\x61\x73\163\x3d\x22\143\145\x6e\x74\145\x72\x22\40\x69\144\x3d\42\160\162\157\164\157\x63\x6f\x6c\104\151\166\42\x20\163\164\171\154\145\x3d\42\x77\x69\x64\x74\x68\72\x31\60\60\x25\x3b\x22\76\12\11\x9\x9\x9\74\x64\x69\166\x20\143\154\141\163\x73\x3d\42\x70\x72\x6f\164\157\143\157\x6c\x5f\x63\x68\157\151\143\145\x5f\x73\x61\x6d\x6c\40\143\145\x6e\x74\145\162\x20" . ($pU == "\x53\101\x4d\x4c" ? "\163\145\154\x65\143\x74\x65\144" : '') . "\x22\40\x64\x61\164\x61\55\164\157\147\x67\x6c\x65\x3d\x22\x61\x64\144\137\x73\x70\42\76\xa\11\11\x9\11\40\40\x20\x20\123\x41\x4d\x4c\xa\x20\40\x20\x20\x20\40\40\x20\x20\40\40\40\40\x20\x20\x20\x3c\x2f\x64\x69\166\x3e\12\x9\x9\11\11\74\144\x69\166\40\x63\x6c\x61\x73\x73\75\42\160\162\157\164\x6f\143\157\x6c\x5f\143\150\157\151\x63\145\137\x77\x73\x66\x65\x64\x20\x63\x65\x6e\x74\145\x72\x20" . ($pU == "\x57\123\x46\x45\104" ? "\x73\x65\x6c\145\x63\164\145\144" : '') . "\42\40\x64\141\x74\141\x2d\164\x6f\147\x67\x6c\x65\x3d\42\x61\x64\x64\x5f\x77\163\x66\145\x64\x5f\141\160\160\x22\x3e\12\11\x9\x9\x9\40\40\x20\40\127\123\55\x46\x45\x44\xa\x20\40\40\40\x20\40\40\40\40\x20\40\40\40\x20\40\40\x3c\57\144\x69\166\x3e\xa\11\x9\11\11\x3c\x64\x69\x76\40\143\154\141\163\163\x3d\x22\x70\162\x6f\x74\x6f\x63\157\154\x5f\x63\150\157\x69\x63\x65\137\x6a\x77\164\40\143\145\156\164\145\x72\40" . ($pU == "\112\x57\x54" ? "\163\145\154\145\x63\164\x65\144" : '') . "\x22\40\144\141\x74\141\55\164\x6f\147\x67\x6c\145\x3d\x22\x61\x64\144\137\152\167\164\x5f\x61\x70\160\x22\76\12\11\11\x9\11\40\x20\40\x20\112\127\124\xa\x20\40\x20\40\x20\40\x20\40\40\x20\x20\x20\x20\40\40\x20\x3c\x2f\144\x69\x76\x3e\12\x9\x9\11\x3c\x2f\x64\x69\x76\76\12\11\x9\11\74\x62\x72\x2f\76\12\11\11\x9\74\144\151\x76\40\x68\x69\x64\x64\x65\156\40\x63\x6c\x61\163\x73\75\42\x6c\x6f\141\x64\x65\162\x20\x6d\157\x5f\x69\x64\160\137\x6e\x6f\x74\145\42\76\12\11\x9\11\x20\40\40\x20\74\x69\155\147\x20\x73\x72\143\75\x22" . MSI_LOADER . "\42\76\12\x20\40\x20\x20\x20\40\x20\x20\40\x20\x20\40\x3c\x2f\144\x69\x76\x3e\12\11\11\74\57\x68\63\76";
}