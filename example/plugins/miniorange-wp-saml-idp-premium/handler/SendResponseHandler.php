<?php


namespace IDP\Handler;

use IDP\Helper\Constants\MoIDPConstants;
use IDP\Helper\Database\MoDbQueries;
use IDP\Helper\Factory\ResponseDecisionHandler;
use IDP\Helper\Traits\Instance;
use IDP\Helper\Utilities\MoIDPUtility;
use IDP\Helper\Utilities\SAMLUtilities;
use RobRichards\XMLSecLibs\XMLSecurityKey;
final class SendResponseHandler extends BaseHandler
{
    use Instance;
    private function __construct()
    {
    }
    public function mo_idp_send_response($BM, $km = NULL)
    {
        if (!MSI_DEBUG) {
            goto bJ;
        }
        MoIDPUtility::mo_debug("\107\145\x6e\x65\162\x61\x74\x69\x6e\x67\40\114\157\x67\x69\156\40\122\x65\x73\x70\x6f\156\163\145");
        bJ:
        $this->checkIfValidPlugin();
        $this->checkValidDomain();
        $this->checkIfValidLicense();
        $current_user = wp_get_current_user();
        $current_user = !MoIDPUtility::isBlank($current_user->ID) ? $current_user : get_user_by("\x6c\157\x67\x69\156", $km);
        if (strcasecmp($BM["\x72\145\x71\165\x65\x73\164\x54\171\x70\x65"], MoIDPConstants::AUTHN_REQUEST) == 0) {
            goto CO;
        }
        if (strcasecmp($BM["\162\145\161\x75\145\163\x74\124\x79\x70\x65"], MoIDPConstants::WS_FED) == 0) {
            goto vp;
        }
        if (strcasecmp($BM["\x72\x65\161\x75\x65\x73\x74\x54\171\x70\x65"], MoIDPConstants::JWT) == 0) {
            goto PE;
        }
        goto rH;
        CO:
        $BM = $this->getSAMLResponseParams($BM);
        goto rH;
        vp:
        $BM = $this->getWSFedResponseParams($BM);
        goto rH;
        PE:
        $BM = $this->getJWTResponseParams($BM);
        rH:
        do_action("\155\x6f\x5f\143\x68\145\x63\153\137\142\x65\146\157\x72\x65\137\155\x69\x73\x72", $current_user, $BM, $km);
        MoIDPUtility::cutol($current_user);
        $wt = ResponseDecisionHandler::getResponseHandler($BM[0], array($BM[1], $BM[2], $BM[3], $BM[4], $BM[5], $BM[6], $km, $BM[8]));
        $Zy = $wt->generateResponse();
        if (!MSI_DEBUG) {
            goto aL;
        }
        MoIDPUtility::mo_debug("\x4c\157\147\x69\156\40\x52\145\163\160\x6f\x6e\163\145\x20\147\x65\156\x65\162\141\x74\145\144\72\40" . $Zy);
        aL:
        if (!ob_get_contents()) {
            goto FB;
        }
        ob_clean();
        FB:
        MoIDPUtility::unsetCookieVariables(array("\162\145\x73\x70\157\156\163\x65\137\160\141\162\141\155\x73", "\155\157\111\144\x70\163\145\156\144\123\x41\115\x4c\x52\145\163\x70\157\x6e\163\x65", "\x61\143\x73\x5f\x75\x72\x6c", "\141\x75\x64\151\x65\x6e\143\x65", "\162\x65\x6c\141\171\x53\x74\x61\164\145", "\162\145\x71\x75\145\x73\x74\x49\104", "\x6d\157\x49\144\160\x73\145\x6e\144\x57\163\106\x65\x64\x52\145\163\160\x6f\x6e\163\x65", "\167\164\162\x65\x61\x6c\155", "\x77\x61", "\167\x63\164\x78", "\x63\154\151\145\156\164\122\x65\x71\165\145\x73\164\111\x64"));
        if (strcasecmp($BM[0], MoIDPConstants::SAML_RESPONSE) == 0) {
            goto Aj;
        }
        if (strcasecmp($BM[0], MoIDPConstants::WS_FED_RESPONSE) == 0) {
            goto Wm;
        }
        if (strcasecmp($BM[0], MoIDPConstants::JWT_RESPONSE) == 0) {
            goto uL;
        }
        goto IB;
        Aj:
        $this->_send_response($Zy, $BM[7], $BM[1]);
        goto IB;
        Wm:
        $this->_send_ws_fed_response($Zy, $BM[5]->mo_idp_acs_url . "\77\x63\x6c\151\145\x6e\164\122\x65\161\x75\145\163\164\111\144\75" . $BM[8], $BM[3], $BM[2]);
        goto IB;
        uL:
        $this->_send_jwt_response($BM[4]->mo_idp_acs_url . "\77\152\167\x74\75" . $Zy, $BM[6]);
        IB:
    }
    public function getSAMLResponseParams($BM)
    {
        global $dbIDPQueries;
        $Ko = $BM["\141\143\x73\x5f\165\162\x6c"];
        $Qn = $BM["\151\x73\163\x75\145\x72"];
        $Ae = isset($BM["\x72\x65\x6c\x61\x79\x53\164\141\x74\x65"]) ? $BM["\x72\x65\x6c\x61\171\x53\x74\x61\x74\x65"] : NULL;
        $VH = isset($BM["\x72\x65\161\165\145\163\164\111\104"]) ? $BM["\162\x65\161\x75\145\x73\x74\x49\104"] : NULL;
        $B6 = "\137" . MoIDPUtility::generateRandomAlphanumericValue(30);
        MoIDPUtility::addSPCookie($Qn, $B6);
        $xI = is_multisite() ? get_sites() : null;
        $gT = is_null($xI) ? site_url("\x2f") : get_site_url($xI[0]->blog_id, "\x2f");
        $t3 = get_site_option("\155\x6f\137\151\144\x70\x5f\145\x6e\x74\x69\164\171\x5f\x69\x64") ? get_site_option("\155\x6f\137\x69\x64\x70\x5f\145\156\x74\151\164\x79\137\151\x64") : MSI_URL;
        $Lm = $dbIDPQueries->get_sp_from_acs($Ko);
        $tW = !empty($Lm) ? $Lm->id : null;
        $LE = $dbIDPQueries->get_all_sp_attributes($tW);
        return array(MoIDPConstants::SAML_RESPONSE, $Ko, $t3, $Qn, $VH, $LE, $Lm, $Ae, $B6);
    }
    public function getWSFedResponseParams($BM)
    {
        global $dbIDPQueries;
        $aq = $BM["\143\x6c\151\145\x6e\x74\122\145\x71\165\145\163\164\x49\144"];
        $S_ = $BM["\167\164\x72\145\x61\154\155"];
        $G1 = $BM["\167\141"];
        $Ae = isset($BM["\x72\x65\154\x61\x79\123\164\x61\164\145"]) ? $BM["\x72\145\x6c\141\x79\x53\164\x61\x74\145"] : NULL;
        $pZ = isset($BM["\167\143\164\x78"]) ? $BM["\167\x63\x74\x78"] : NULL;
        $xI = is_multisite() ? get_sites() : null;
        $gT = is_null($xI) ? site_url("\x2f") : get_site_url($xI[0]->blog_id, "\57");
        $t3 = get_site_option("\155\x6f\x5f\x69\x64\160\137\145\156\164\x69\x74\x79\x5f\x69\144") ? get_site_option("\x6d\x6f\137\x69\144\160\x5f\x65\x6e\x74\x69\164\171\137\151\x64") : MSI_URL;
        $Lm = $dbIDPQueries->get_sp_from_issuer($S_);
        $tW = !empty($Lm) ? $Lm->id : null;
        $LE = $dbIDPQueries->get_all_sp_attributes($tW);
        return array(MoIDPConstants::WS_FED_RESPONSE, $S_, $G1, $pZ, $t3, $Lm, $LE, $Ae, $aq);
    }
    private function _send_response($aK, $Ae, $Ko)
    {
        if (!MSI_DEBUG) {
            goto tP;
        }
        MoIDPUtility::mo_debug("\x53\x65\x6e\x64\151\156\147\40\x53\x41\115\x4c\40\x4c\x6f\x67\x69\x6e\40\x52\145\163\160\x6f\156\x73\145");
        tP:
        $aK = base64_encode($aK);
        echo "\12\x9\x9\x3c\x68\x74\155\154\76\xa\11\x9\x9\x3c\x68\x65\x61\x64\76\12\x9\x9\11\x9\74\x6d\x65\x74\x61\40\x68\x74\164\160\x2d\x65\161\165\151\166\x3d\42\x63\141\x63\150\145\55\x63\x6f\156\x74\x72\157\x6c\42\x20\x63\157\156\164\x65\156\164\75\x22\156\157\x2d\x63\x61\x63\x68\145\42\x3e\12\x9\x9\11\11\74\x6d\x65\164\x61\40\150\x74\x74\160\55\x65\x71\x75\151\x76\x3d\42\x70\x72\x61\147\155\141\42\x20\x63\x6f\x6e\164\x65\156\x74\x3d\42\156\157\x2d\143\141\x63\x68\x65\42\76\12\x9\11\x9\74\x2f\x68\x65\141\x64\76\12\11\x9\11\x3c\x62\x6f\x64\171\76\xa\x9\x9\11\74\146\x6f\162\x6d\x20\151\144\75\42\162\x65\x73\x70\157\x6e\x73\145\146\157\x72\155\42\40\x61\143\164\x69\x6f\x6e\75\x22" . $Ko . "\x22\x20\155\145\164\150\x6f\x64\75\x22\x70\x6f\x73\x74\x22\x3e\xa\x9\x9\x9\11\74\x69\156\x70\x75\164\40\x74\171\x70\145\75\x22\150\151\x64\x64\145\x6e\x22\x20\x6e\x61\x6d\145\75\42\x53\101\x4d\x4c\x52\x65\x73\160\x6f\156\163\145\x22\x20\x76\x61\x6c\x75\x65\75\42" . htmlspecialchars($aK) . "\x22\x20\x2f\x3e";
        if (!($Ae != "\x2f")) {
            goto yr;
        }
        echo "\74\151\x6e\160\x75\164\40\164\x79\x70\x65\75\42\x68\151\x64\x64\x65\156\x22\x20\156\x61\x6d\x65\75\42\x52\145\x6c\x61\171\x53\x74\141\164\x65\x22\40\x76\x61\x6c\165\x65\75\42" . $Ae . "\42\40\x2f\x3e";
        yr:
        echo "\x3c\57\x66\157\162\155\76\xa\x9\11\x9\74\57\x62\x6f\x64\x79\x3e\12\x9\x9\74\163\x63\162\x69\x70\164\76\12\11\x9\x9\x64\x6f\x63\x75\x6d\x65\x6e\x74\x2e\x67\145\x74\x45\x6c\x65\x6d\145\x6e\164\102\x79\111\x64\x28\47\162\145\x73\160\x6f\x6e\163\145\146\157\162\x6d\x27\51\56\163\165\142\x6d\x69\x74\x28\51\x3b\11\12\x9\11\74\57\x73\143\162\x69\160\x74\76\xa\11\11\74\x2f\150\x74\x6d\154\76";
        exit;
    }
    private function _send_ws_fed_response($U1, $Ko, $pZ, $G1)
    {
        if (!MSI_DEBUG) {
            goto U1;
        }
        MoIDPUtility::mo_debug("\123\145\x6e\144\151\x6e\x67\40\x57\x53\x2d\x46\x45\x44\40\x4c\157\x67\x69\156\x20\122\145\163\160\x6f\x6e\x73\145");
        U1:
        echo "\xa\11\x9\x3c\150\164\x6d\154\76\12\x9\11\x9\x3c\150\x65\x61\144\x3e\xa\x9\x9\11\11\x3c\155\x65\164\141\40\x68\164\164\160\x2d\x65\x71\165\151\x76\x3d\42\x63\x61\x63\150\x65\55\143\x6f\x6e\164\x72\x6f\x6c\42\x20\x63\157\156\x74\145\156\x74\75\42\156\x6f\x2d\x63\x61\x63\150\x65\x22\76\xa\x9\x9\11\x9\74\x6d\x65\164\141\x20\x68\164\x74\x70\x2d\145\x71\x75\x69\166\x3d\x22\x70\162\141\x67\x6d\141\42\x20\143\x6f\x6e\x74\145\x6e\x74\x3d\x22\x6e\157\x2d\143\141\143\150\x65\42\76\xa\11\11\x9\x3c\x2f\x68\145\141\x64\76\xa\11\11\11\74\142\x6f\144\171\76\xa\x9\11\x9\11\x3c\x66\x6f\162\x6d\40\151\144\75\42\x72\145\163\x70\157\x6e\163\x65\x66\x6f\162\155\42\x20\x61\x63\164\151\157\156\x3d\42" . $Ko . "\x22\40\x6d\x65\164\x68\x6f\x64\75\x22\x70\x6f\x73\164\42\76\12\x9\11\11\11\11\74\151\156\160\x75\164\x20\164\x79\x70\145\x3d\x22\x68\x69\x64\x64\x65\x6e\x22\x20\x6e\141\155\145\x3d\42\167\x61\x22\x20\x76\x61\154\x75\x65\x3d\x22" . $G1 . "\x22\40\x2f\76\xa\11\11\11\xa\x9\x9\x9\x9\x9\74\151\156\160\165\x74\40\x74\171\x70\145\x3d\x22\x68\x69\x64\x64\145\156\42\x20\156\x61\x6d\145\75\42\167\x72\145\163\x75\x6c\164\42\40\x76\x61\154\x75\145\x3d\x22" . htmlentities($U1) . "\x22\x20\x2f\x3e\12\x9\x9\11\11\x9\x3c\x69\x6e\160\x75\x74\40\x74\x79\160\145\75\x22\150\151\144\144\145\x6e\x22\40\156\141\155\145\75\x22\x77\x63\164\x78\x22\x20\166\141\x6c\x75\145\75\42" . $pZ . "\x22\x20\x2f\x3e";
        echo "\11\x3c\x2f\x66\x6f\x72\x6d\x3e\12\11\11\11\74\57\x62\x6f\144\171\76\12\11\x9\11\x3c\x73\143\x72\x69\x70\164\x3e\xa\x9\11\x9\11\x64\x6f\143\165\x6d\145\x6e\x74\56\147\x65\164\x45\154\x65\155\x65\x6e\x74\x42\x79\x49\x64\x28\47\x72\145\163\x70\157\156\x73\x65\x66\x6f\x72\155\x27\51\x2e\x73\x75\142\155\151\164\x28\51\x3b\x9\xa\11\x9\x9\x3c\x2f\x73\x63\x72\151\160\164\76\xa\x9\11\74\57\150\x74\x6d\154\76";
        exit;
    }
    private function _send_jwt_response($mK, $XZ)
    {
        if (!MSI_DEBUG) {
            goto lW;
        }
        MoIDPUtility::mo_debug("\123\x65\156\x64\151\156\x67\40\112\x57\x54\40\x4c\157\147\x69\x6e\40\122\145\163\x70\x6f\156\x73\x65");
        lW:
        $mK = !MoIDPUtility::isBlank($XZ) ? $mK . "\46\x72\145\164\x75\162\156\x5f\164\x6f\75" . $XZ : $mK;
        header("\114\x6f\x63\x61\x74\151\x6f\156\72\40" . $mK);
        exit;
    }
    public function getJWTResponseParams($BM)
    {
        global $dbIDPQueries;
        $Sv = $BM["\x6a\x77\164\137\x65\x6e\x64\160\x6f\151\x6e\164"];
        $uj = $BM["\x73\150\141\x72\145\144\123\145\143\162\x65\x74"];
        $XZ = $BM["\162\145\x74\165\x72\x6e\x5f\x74\157\x5f\x75\x72\x6c"];
        $xI = is_multisite() ? get_sites() : null;
        $gT = is_null($xI) ? site_url("\x2f") : get_site_url($xI[0]->blog_id, "\x2f");
        $Lm = $dbIDPQueries->get_sp_from_acs($Sv);
        $tW = !empty($Lm) ? $Lm->id : null;
        $LE = $dbIDPQueries->get_all_sp_attributes($tW);
        $VI = $Lm->mo_idp_nameid_format;
        return array(MoIDPConstants::JWT_RESPONSE, $Sv, $VI, $uj, $Lm, $LE, $XZ, NULL, NULL);
    }
    public function _send_logout_request($Y_, $Ae, $TK)
    {
        if (!MSI_DEBUG) {
            goto jw;
        }
        MoIDPUtility::mo_debug("\x53\145\x6e\144\151\156\x67\40\123\x41\115\x4c\40\x4c\x6f\147\157\165\x74\x20\x52\x65\x71\x75\145\163\x74");
        jw:
        $x8 = htmlspecialchars($Y_);
        $Y_ = base64_encode($Y_);
        echo "\x3c\146\x6f\x72\155\40\151\x64\x3d\42\x72\145\x71\x75\x65\x73\164\146\x6f\162\155\42\40\x61\143\x74\151\x6f\x6e\75\42" . $TK . "\42\40\155\145\x74\150\x6f\x64\75\42\x70\157\163\x74\42\76\12\11\x9\11\x3c\x69\156\x70\165\x74\x20\x74\171\160\x65\75\42\150\151\144\x64\x65\156\42\40\156\141\x6d\x65\75\42\123\101\x4d\x4c\x52\x65\x71\165\x65\x73\164\x22\40\x76\141\154\165\x65\x3d\42" . $Y_ . "\x22\x20\x2f\x3e";
        if (!($Ae != "\x2f")) {
            goto Ky;
        }
        echo "\74\151\x6e\x70\x75\x74\x20\164\171\160\145\x3d\x22\150\151\x64\144\x65\x6e\42\x20\156\141\x6d\x65\75\x22\x52\145\154\x61\171\x53\164\141\x74\x65\x22\x20\166\x61\154\165\145\75\x22" . $Ae . "\42\x20\57\x3e";
        Ky:
        echo "\x3c\x2f\x66\x6f\162\x6d\x3e\12\x9\x9\74\163\x63\x72\151\160\164\x3e\xa\11\x9\11\x64\157\143\165\x6d\145\156\x74\x2e\x67\145\164\x45\154\x65\155\145\156\x74\102\x79\x49\x64\x28\42\x72\145\161\x75\x65\x73\x74\146\x6f\x72\x6d\x22\51\x2e\163\165\x62\x6d\151\164\x28\51\73\11\xa\11\x9\x3c\57\163\x63\162\151\x70\164\x3e";
        exit;
    }
    public function _send_logout_response($aK, $Ae, $TK)
    {
        if (!MSI_DEBUG) {
            goto tZ;
        }
        MoIDPUtility::mo_debug("\123\145\156\x64\151\x6e\147\x20\123\x41\x4d\114\40\114\x6f\x67\x6f\165\x74\40\122\145\x73\160\x6f\156\163\145");
        tZ:
        $aK = base64_encode($aK);
        $Zy = htmlspecialchars($aK);
        echo "\74\x66\157\x72\x6d\x20\151\x64\x3d\42\x72\145\x73\160\x6f\156\163\145\146\157\x72\x6d\x22\40\141\143\x74\x69\157\x6e\x3d\42" . $TK . "\42\40\155\145\x74\x68\x6f\x64\75\x22\160\x6f\x73\164\42\x3e\xa\x9\x9\x9\11\x3c\151\x6e\x70\x75\164\40\x74\x79\x70\x65\x3d\x22\x68\151\144\144\145\156\42\40\156\141\155\x65\75\x22\123\x41\115\x4c\122\145\x73\160\x6f\156\163\145\42\x20\166\141\x6c\x75\145\x3d\x22" . $Zy . "\x22\57\76\12\11\x9\x9\x9\74\151\x6e\160\165\x74\x20\164\171\x70\x65\x3d\42\x68\x69\x64\x64\x65\x6e\x22\40\156\x61\x6d\x65\x3d\42\x52\x65\154\141\171\123\x74\141\164\x65\42\x20\x76\x61\154\165\145\x3d\x22" . $Ae . "\x22\40\x2f\x3e\12\x9\x9\11\x9\x3c\x2f\146\157\162\x6d\x3e\xa\11\11\11\74\163\143\162\x69\x70\x74\76\xa\11\11\x9\x9\144\157\143\x75\x6d\145\x6e\164\x2e\147\145\x74\x45\x6c\x65\x6d\x65\156\164\x42\171\111\144\x28\42\x72\x65\163\160\157\x6e\x73\145\146\157\x72\x6d\x22\x29\x2e\163\x75\x62\x6d\x69\164\50\51\x3b\11\xa\11\11\11\x3c\x2f\163\143\162\x69\x70\164\x3e";
        exit;
    }
    public function mo_idp_send_logout_response($t3, $mC, $HD)
    {
        global $dbIDPQueries;
        if (!MSI_DEBUG) {
            goto iO;
        }
        MoIDPUtility::mo_debug("\107\145\x6e\x65\162\x61\x74\151\x6e\x67\40\123\x41\x4d\x4c\x20\114\157\x67\x6f\x75\164\40\122\x65\163\x70\x6f\156\163\x65");
        iO:
        if (!isset($_SESSION["\155\157\x5f\x69\x64\160\x5f\x6c\157\x67\157\x75\x74\137\x72\145\x71\165\145\x73\164\x5f\151\163\x73\165\145\162"])) {
            goto mO;
        }
        unset($_SESSION["\155\157\137\151\144\x70\x5f\x6c\157\147\157\165\x74\137\x72\145\x71\165\145\x73\164\137\x69\x73\x73\165\x65\x72"]);
        mO:
        if (!isset($_SESSION["\x6d\157\137\151\144\x70\137\154\x6f\147\157\165\x74\x5f\162\x65\161\x75\145\x73\164\x5f\x69\x64"])) {
            goto O8;
        }
        unset($_SESSION["\x6d\157\x5f\x69\144\x70\137\x6c\157\147\157\x75\164\137\162\145\x71\165\145\163\x74\x5f\151\144"]);
        O8:
        if (!isset($_SESSION["\155\x6f\x5f\151\x64\160\137\x6c\157\x67\x6f\165\164\x5f\x72\145\154\141\x79\x5f\163\x74\x61\164\145"])) {
            goto w1;
        }
        unset($_SESSION["\155\157\x5f\x69\x64\160\x5f\154\157\147\x6f\165\x74\137\x72\145\x6c\x61\x79\137\163\x74\141\x74\145"]);
        w1:
        if (!ob_get_contents()) {
            goto Qa;
        }
        ob_clean();
        Qa:
        MoIDPUtility::unsetCookieVariables(array("\x6d\157\x5f\151\144\160\x5f\x6c\x6f\x67\157\x75\x74\137\162\145\161\x75\x65\x73\x74\x5f\x69\163\163\x75\x65\162", "\x6d\157\137\x69\144\x70\x5f\x6c\x6f\147\x6f\165\164\137\162\145\161\165\145\x73\164\x5f\x69\144", "\x6d\157\x5f\151\x64\x70\137\x6c\x6f\x67\x6f\165\164\x5f\x72\x65\154\141\171\137\163\x74\141\x74\x65", "\155\x6f\x5f\x73\160\137\x63\x6f\165\x6e\x74", "\x6d\157\x5f\163\x70\x5f\x31\x5f\x69\x73\x73\x75\145\162"));
        $Lm = $dbIDPQueries->get_sp_from_issuer($t3);
        $t3 = get_site_option("\155\157\x5f\151\x64\x70\x5f\145\156\164\x69\x74\171\x5f\x69\x64") ? get_site_option("\155\157\137\151\x64\160\137\x65\156\164\151\x74\x79\x5f\x69\144") : MSI_URL;
        $tY = $Lm->mo_idp_logout_url;
        $nN = $Lm->mo_idp_logout_binding_type;
        if ($nN == "\x48\x74\164\160\x52\145\144\151\162\145\x63\164") {
            goto MA;
        }
        $xi = SAMLUtilities::createLogoutResponse($mC, $t3, $tY, "\110\164\x74\160\120\x6f\x73\x74");
        $vw = MoIDPUtility::getPrivateKeyPath();
        $lR = MoIDPUtility::getPublicCertPath();
        $d9 = SAMLUtilities::signXML($xi, $lR, $vw, "\x53\164\x61\164\x75\x73");
        $this->_send_logout_response($d9, $HD, $tY);
        goto vX;
        MA:
        $xi = SAMLUtilities::createLogoutResponse($mC, $t3, $tY);
        $gX = $tY;
        $gX .= strpos($tY, "\x3f") !== FALSE ? "\x26" : "\x3f";
        $gX .= "\x53\x41\115\114\x52\x65\x73\x70\x6f\x6e\163\x65\75" . $xi . "\46\122\x65\154\141\x79\123\164\x61\164\145\75" . urlencode($HD) . "\x26\123\x69\x67\101\154\147\x3d" . urlencode(XMLSecurityKey::RSA_SHA256);
        $LF = array("\x74\171\x70\145" => "\x70\x72\x69\x76\x61\x74\x65");
        $UV = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, $LF);
        $u4 = MoIDPUtility::getPrivateKeyPath();
        $UV->loadKey($u4, TRUE);
        $N1 = $UV->signData($gX);
        $N1 = base64_encode($N1);
        $yM = $gX;
        $yM .= strpos($yM, "\77") !== false ? "\x26" : "\x3f";
        $yM .= "\123\x69\x67\x6e\x61\x74\165\x72\145\x3d" . urlencode($N1);
        header("\114\x6f\143\x61\164\151\x6f\156\x3a\40" . $yM);
        exit;
        vX:
    }
    public function mo_idp_send_logout_request($iD, $t3, $gX, $nN, $B6)
    {
        if (!MSI_DEBUG) {
            goto tt;
        }
        MoIDPUtility::mo_debug("\107\145\x6e\x65\x72\141\x74\151\x6e\x67\40\x53\x41\115\114\40\x4c\157\147\157\165\x74\40\122\x65\x71\x75\x65\x73\164");
        tt:
        $Ae = "\x2f";
        if ($nN == "\110\x74\x74\x70\x50\157\x73\x74") {
            goto fg;
        }
        $et = SAMLUtilities::createLogoutRequest($iD, $B6, $t3, $gX);
        $et = "\x53\x41\x4d\114\x52\145\161\165\145\x73\164\x3d" . $et . "\46\x52\145\x6c\141\171\123\x74\141\164\x65\75" . urlencode($Ae) . "\46\123\151\147\x41\x6c\x67\75" . urlencode(XMLSecurityKey::RSA_SHA256);
        $LF = array("\164\171\160\x65" => "\x70\x72\151\166\x61\x74\145");
        $UV = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, $LF);
        $u4 = MoIDPUtility::getPrivateKeyPath();
        $UV->loadKey($u4, TRUE);
        $N1 = $UV->signData($et);
        $N1 = base64_encode($N1);
        $yM = $gX;
        $yM .= strpos($gX, "\77") !== false ? "\46" : "\77";
        $yM .= $et . "\46\123\151\147\x6e\141\x74\x75\162\x65\x3d" . urlencode($N1);
        header("\x4c\157\143\141\164\151\157\156\x3a\40" . $yM);
        exit;
        goto rZ;
        fg:
        $et = SAMLUtilities::createLogoutRequest($iD, $B6, $t3, $gX, "\x48\164\x74\x70\x50\x6f\163\x74");
        $vw = MoIDPUtility::getPrivateKeyPath();
        $lR = MoIDPUtility::getPublicCertPath();
        $Y_ = SAMLUtilities::signXML($et, $lR, $vw, "\116\141\155\145\x49\x44");
        $this->_send_logout_request($Y_, $Ae, $gX);
        rZ:
    }
}
