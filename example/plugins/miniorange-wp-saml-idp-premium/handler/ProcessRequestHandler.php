<?php


namespace IDP\Handler;

use IDP\Helper\Constants\MoIDPConstants;
use IDP\Helper\Database\MoDbQueries;
use IDP\Helper\SAML2\AuthnRequest;
use IDP\Helper\Traits\Instance;
use IDP\Helper\Utilities\MoIDPUtility;
use IDP\Helper\WSFED\WsFedRequest;
final class ProcessRequestHandler extends BaseHandler
{
    use Instance;
    private $sendResponseHandler;
    private function __construct()
    {
        $this->sendResponseHandler = SendResponseHandler::instance();
    }
    public function mo_idp_authorize_user($Ae, $Jp)
    {
        switch ($Jp->getRequestType()) {
            case MoIDPConstants::AUTHN_REQUEST:
                $this->startProcessForSamlResponse($Ae, $Jp);
                goto Zd;
            case MoIDPConstants::WS_FED:
                $this->startProcessForWsFedResponse($Ae, $Jp);
                goto Zd;
        }
        uH:
        Zd:
    }
    public function startProcessForSamlResponse($Ae, $Jp)
    {
        if (is_user_logged_in()) {
            goto AR;
        }
        $this->setSAMLSessionCookies($Jp, $Ae);
        goto yQ;
        AR:
        $this->sendResponseHandler->mo_idp_send_response(array("\162\145\161\165\145\x73\164\124\171\160\x65" => $Jp->getRequestType(), "\141\x63\163\137\x75\x72\154" => $Jp->getAssertionConsumerServiceURL(), "\x69\163\x73\x75\x65\x72" => $Jp->getIssuer(), "\162\145\154\141\171\x53\x74\141\164\x65" => $Ae, "\x72\145\161\165\x65\163\164\111\104" => $Jp->getRequestID()));
        yQ:
    }
    public function startProcessForWsFedResponse($Ae, $Jp)
    {
        if (is_user_logged_in()) {
            goto yt;
        }
        $this->setWSFedSessionCookies($Jp, $Ae);
        goto dI;
        yt:
        $this->sendResponseHandler->mo_idp_send_response(array("\162\145\161\165\145\x73\x74\124\171\x70\x65" => $Jp->getRequestType(), "\143\x6c\151\145\156\164\122\x65\x71\165\145\163\164\111\144" => $Jp->getClientRequestId(), "\167\164\x72\x65\141\154\x6d" => $Jp->getWtrealm(), "\167\141" => $Jp->getWa(), "\x72\145\154\141\171\123\x74\x61\x74\x65" => $Ae, "\167\x63\164\170" => $Jp->getWctx()));
        dI:
    }
    public function setWSFedSessionCookies(WsFedRequest $Jp, $Ae)
    {
        if (!ob_get_contents()) {
            goto Wz;
        }
        ob_clean();
        Wz:
        setcookie("\x72\145\163\x70\157\156\x73\x65\x5f\x70\x61\x72\141\155\x73", "\151\163\123\145\x74", time() + 21600, "\57");
        setcookie("\155\x6f\111\144\x70\x73\145\156\144\x57\163\x46\145\144\x52\145\x73\160\x6f\x6e\163\145", "\x74\x72\x75\x65", time() + 21600, "\57");
        setcookie("\x77\x74\162\x65\141\154\155", $Jp->getWtrealm(), time() + 21600, "\57");
        setcookie("\167\x61", $Jp->getWa(), time() + 21600, "\x2f");
        setcookie("\x77\143\x74\x78", $Jp->getWctx(), time() + 21600, "\x2f");
        setcookie("\162\145\x6c\x61\171\123\164\141\164\x65", $Ae, time() + 21600, "\57");
        setcookie("\x63\154\151\145\156\x74\x52\x65\161\165\x65\163\x74\x49\x64", $Jp->getClientRequestId(), time() + 21600, "\x2f");
        $mK = wp_login_url();
        $mK = apply_filters("\x6d\x6f\137\151\x64\160\137\143\x75\x73\164\x6f\x6d\x5f\x6c\x6f\147\151\x6e\137\x75\162\154", $mK);
        wp_safe_redirect($mK);
        exit;
    }
    public function setSAMLSessionCookies(AuthnRequest $Jp, $Ae)
    {
        if (!ob_get_contents()) {
            goto Mm;
        }
        ob_clean();
        Mm:
        setcookie("\x72\145\x73\160\157\x6e\x73\145\x5f\160\x61\x72\141\155\x73", "\x69\x73\123\x65\164", time() + 21600, "\x2f");
        setcookie("\155\157\x49\144\x70\163\145\156\x64\123\101\115\114\x52\x65\163\x70\x6f\156\x73\145", "\164\x72\165\x65", time() + 21600, "\57");
        setcookie("\x61\143\x73\137\x75\162\154", $Jp->getAssertionConsumerServiceURL(), time() + 21600, "\57");
        setcookie("\x61\165\144\x69\145\156\143\145", $Jp->getIssuer(), time() + 21600, "\x2f");
        setcookie("\x72\145\154\x61\x79\123\164\141\164\x65", $Ae, time() + 21600, "\x2f");
        setcookie("\x72\x65\161\x75\145\x73\164\x49\104", $Jp->getRequestID(), time() + 21600, "\x2f");
        $mK = wp_login_url();
        $mK = apply_filters("\x6d\x6f\137\x69\x64\x70\137\x63\x75\163\164\157\x6d\x5f\x6c\x6f\147\151\x6e\x5f\x75\162\x6c", $mK);
        wp_safe_redirect($mK);
        exit;
    }
    public function setJWTSessionCookies(array $Jp, $Ae)
    {
        if (!ob_get_contents()) {
            goto HT;
        }
        ob_clean();
        HT:
        setcookie("\x72\145\163\x70\x6f\x6e\x73\x65\x5f\160\141\x72\x61\x6d\x73", "\151\163\123\145\164", time() + 21600, "\57");
        setcookie("\155\x6f\x49\x64\160\123\145\156\144\x4a\127\124\x52\145\x73\160\157\x6e\163\x65", "\x74\162\x75\145", time() + 21600, "\x2f");
        setcookie("\x6a\x77\x74\137\145\156\x64\160\157\x69\x6e\164", $Jp["\152\x77\x74\x5f\x65\156\x64\160\x6f\x69\x6e\x74"], time() + 21600, "\x2f");
        setcookie("\163\150\x61\162\x65\x64\x53\145\143\162\145\x74", $Jp["\163\x68\x61\162\x65\144\x53\145\x63\x72\x65\164"], time() + 21600, "\x2f");
        setcookie("\x72\145\x74\165\162\156\x5f\x74\x6f\x5f\x75\162\154", $Ae, time() + 21600, "\x2f");
        $mK = wp_login_url();
        $mK = apply_filters("\155\x6f\x5f\x69\144\x70\137\143\165\x73\164\157\x6d\x5f\154\x6f\147\151\156\137\x75\162\x6c", $mK);
        wp_safe_redirect($mK);
        exit;
    }
    public function checkAndLogoutUserFromLoggedInSPs($GU)
    {
        if (!MSI_DEBUG) {
            goto I0;
        }
        MoIDPUtility::mo_debug("\x43\x68\x65\143\x6b\x69\156\x67\40\151\146\x20\x74\x68\x65\162\x65\x27\163\x20\x61\40\166\x61\x6c\x69\144\40\123\120\x20\163\145\163\x73\151\x6f\156");
        I0:
        if (!MSI_DEBUG) {
            goto jp;
        }
        MoIDPUtility::mo_debug("\x53\x50\40\x43\157\x75\x6e\164\40\72\x20" . $_COOKIE["\155\x6f\137\x73\x70\x5f\143\x6f\x75\x6e\164"]);
        jp:
        if (!(!isset($_COOKIE["\x6d\157\x5f\163\160\137\143\x6f\x75\x6e\x74"]) || $_COOKIE["\x6d\157\137\163\x70\137\x63\157\165\x6e\x74"] < 1)) {
            goto cd;
        }
        return;
        cd:
        if (isset($_SESSION["\x6d\157\x5f\151\x64\160\x5f\154\157\147\157\165\x74\x5f\162\145\161\x75\145\x73\164\137\x69\163\163\165\145\x72"])) {
            goto UN;
        }
        $this->mo_idp_initiated_logout($GU);
        return;
        UN:
        $this->checkAndSwapSPInSessionForLogout($_COOKIE["\155\157\x5f\163\x70\137\61\137\x69\x73\163\x75\145\x72"], $_SESSION["\x6d\x6f\x5f\151\x64\160\x5f\x6c\x6f\147\x6f\x75\164\x5f\x72\x65\161\165\x65\x73\x74\x5f\151\163\x73\x75\145\162"], $_COOKIE["\x6d\157\137\163\x70\137\x63\157\x75\156\x74"]);
        $this->mo_idp_sp_initiated_logout($GU);
    }
    public function processLogoutResponseFromSP()
    {
        if (!(isset($_COOKIE["\155\157\x5f\x69\144\x70\x5f\154\141\x73\x74\137\x6c\157\147\147\x65\144\x5f\x69\156\x5f\x75\163\145\162"]) && !MoIDPUtility::isBlank($_COOKIE["\x6d\157\x5f\151\144\160\137\154\x61\x73\164\137\x6c\x6f\x67\x67\145\144\137\x69\x6e\x5f\165\163\145\162"]))) {
            goto Mh;
        }
        $GU = $_COOKIE["\x6d\157\x5f\151\x64\x70\x5f\154\x61\163\x74\137\x6c\157\147\x67\145\x64\x5f\x69\x6e\x5f\165\163\x65\162"];
        Mh:
        if (!(!array_key_exists("\155\157\x5f\x73\x70\x5f\x63\157\x75\156\164", $_COOKIE) || MoIDPUtility::isBlank($_COOKIE["\x6d\x6f\137\163\x70\137\143\157\x75\156\164"]) || $_COOKIE["\x6d\x6f\x5f\163\x70\137\143\x6f\x75\x6e\x74"] == 0)) {
            goto Rm;
        }
        wp_redirect(site_url());
        exit;
        Rm:
        if (isset($_COOKIE["\x6d\x6f\x5f\151\x64\x70\x5f\154\x6f\x67\157\x75\164\x5f\x72\x65\x71\165\145\163\164\137\x69\163\163\x75\x65\x72"]) && !MoIDPUtility::isBlank($_COOKIE["\155\157\137\151\x64\160\x5f\x6c\x6f\x67\157\165\x74\x5f\162\x65\161\x75\x65\x73\164\137\151\x73\163\165\x65\x72"])) {
            goto xf;
        }
        $this->mo_idp_initiated_logout($GU);
        goto jo;
        xf:
        $this->mo_idp_sp_initiated_logout($GU);
        jo:
    }
    private function checkAndSwapSPInSessionForLogout($dL, $Ww, $Fo)
    {
        if (!(strpos($dL, $Ww) === false)) {
            goto Az;
        }
        $T2 = '';
        $hi = array("\x65\170\160\151\162\x65\x73" => time() + 21600, "\160\141\x74\x68" => "\57", "\x73\x65\143\165\x72\x65" => true, "\x73\141\x6d\x65\163\151\164\x65" => "\x4e\x6f\156\x65");
        $Uy = 1;
        i1:
        if (!($Uy <= $Fo)) {
            goto yZ;
        }
        if (!(strpos($_COOKIE["\x6d\x6f\x5f\x73\x70\137" . $Uy . "\137\x69\163\163\x75\x65\x72"], $Ww) !== false)) {
            goto KR;
        }
        $T2 = $Uy;
        goto yZ;
        KR:
        LI:
        $Uy++;
        goto i1;
        yZ:
        if (!ob_get_contents()) {
            goto R3;
        }
        ob_clean();
        R3:
        $Pb = $_COOKIE["\155\x6f\x5f\163\160\x5f" . $T2 . "\137\x69\163\163\165\145\x72"];
        $hC = $_COOKIE["\155\157\x5f\163\x70\137" . $T2 . "\x5f\x73\x65\163\163\x69\x6f\x6e\x49\x6e\144\x65\170"];
        $bT = $_COOKIE["\x6d\x6f\137\163\x70\137\61\137\x73\145\163\163\x69\x6f\156\111\156\144\145\170"];
        setcookie("\x6d\x6f\x5f\163\160\137" . $T2 . "\137\151\x73\x73\x75\145\162", $dL, $hi);
        setcookie("\155\157\137\163\160\x5f" . $T2 . "\x5f\163\145\163\x73\x69\157\x6e\111\x6e\144\x65\x78", $bT, $hi);
        $_COOKIE["\155\x6f\x5f\x73\x70\x5f" . $T2 . "\137\x69\163\x73\165\145\162"] = $dL;
        $_COOKIE["\x6d\157\x5f\163\x70\x5f" . $T2 . "\137\x73\145\163\163\x69\157\156\111\x6e\x64\145\170"] = $bT;
        setcookie("\x6d\x6f\137\163\x70\x5f\61\137\x69\x73\163\x75\x65\162", $Pb, $hi);
        setcookie("\155\157\x5f\x73\160\137\x31\137\163\x65\x73\x73\x69\x6f\x6e\x49\156\144\145\x78", $hC, $hi);
        $_COOKIE["\x6d\x6f\137\163\x70\137\x31\x5f\x69\x73\163\165\x65\x72"] = $Pb;
        $_COOKIE["\x6d\x6f\x5f\x73\160\137\x31\137\x73\145\x73\x73\x69\x6f\x6e\x49\156\x64\x65\x78"] = $hC;
        Az:
    }
    private function mo_idp_initiated_logout($GU)
    {
        if (!MSI_DEBUG) {
            goto Ek;
        }
        MoIDPUtility::mo_debug("\x50\x72\x65\x70\141\162\x69\x6e\x67\x20\157\165\x74\40\x49\x44\120\x20\151\156\151\x74\x69\x61\164\145\144\40\x6c\x6f\147\x6f\x75\x74");
        Ek:
        if (!ob_get_contents()) {
            goto yx;
        }
        ob_clean();
        yx:
        global $dbIDPQueries;
        $current_user = get_user_by("\x49\x44", $GU);
        $hU = isset($_COOKIE["\155\157\x5f\x73\x70\137\x63\x6f\165\x6e\x74"]) ? $_COOKIE["\155\157\x5f\x73\x70\x5f\x63\x6f\165\156\x74"] : 0;
        if (!isset($_COOKIE["\155\157\x5f\163\160\137\x63\157\x75\156\164"])) {
            goto fV;
        }
        setcookie("\155\157\x5f\163\160\137\143\x6f\165\156\164", $hU - 1);
        fV:
        if (!($hU < 1)) {
            goto wU;
        }
        return;
        wU:
        if (!($hU == 1)) {
            goto wA;
        }
        MoIDPUtility::unsetCookieVariables(array("\155\157\137\163\x70\137\x63\157\165\x6e\164"));
        wA:
        $t3 = $_COOKIE["\155\157\x5f\x73\160\137" . $hU . "\x5f\x69\163\x73\165\x65\x72"];
        $B6 = $_COOKIE["\155\x6f\137\163\160\137" . $hU . "\137\163\x65\163\163\x69\x6f\156\x49\156\144\145\170"];
        MoIDPUtility::unsetCookieVariables(array("\x6d\x6f\137\163\160\137" . $hU . "\137\151\163\163\x75\x65\162", "\155\157\x5f\163\160\x5f" . $hU . "\x5f\x73\x65\x73\163\151\157\156\111\156\144\145\x78"));
        $Lm = $dbIDPQueries->get_sp_from_issuer($t3);
        if (!MSI_DEBUG) {
            goto De;
        }
        MoIDPUtility::mo_debug("\123\x65\156\144\151\156\x67\40\157\165\164\40\x49\x44\120\40\x69\x6e\151\164\x69\141\x74\145\x64\40\x6c\157\147\157\x75\164\x20\x72\x65\x71\165\x65\x73\164\x20\x74\x6f\40\x3a\x20" . $t3);
        De:
        $vX = get_site_option("\x6d\x6f\x5f\x69\x64\160\137\145\x6e\x74\151\x74\x79\137\151\144") ? get_site_option("\155\157\137\151\x64\x70\137\145\x6e\x74\151\164\171\137\151\x64") : MSI_URL;
        if (MoIDPUtility::isBlank($Lm->mo_idp_logout_url)) {
            goto Fx;
        }
        $this->sendResponseHandler->mo_idp_send_logout_request($Lm->mo_idp_nameid_attr === "\145\x6d\x61\151\154\x41\144\144\x72\145\x73\163" ? $current_user->user_email : $current_user->user_login, $vX, $Lm->mo_idp_logout_url, $Lm->mo_idp_logout_binding_type, $B6);
        Fx:
    }
    private function mo_idp_sp_initiated_logout($GU)
    {
        if (!MSI_DEBUG) {
            goto gL;
        }
        MoIDPUtility::mo_debug("\123\x65\x6e\x64\x69\x6e\x67\x20\157\165\x74\40\x53\120\40\x69\156\x69\x74\151\141\x74\145\144\x20\154\x6f\147\x6f\165\164\40\162\x65\163\160\157\156\x73\x65");
        gL:
        $hU = $_COOKIE["\155\157\137\163\x70\x5f\x63\x6f\x75\x6e\x74"];
        $t3 = $_COOKIE["\155\x6f\137\163\160\137" . $hU . "\x5f\151\163\x73\x75\145\162"];
        if ($hU == 1) {
            goto qQ;
        }
        if (isset($_COOKIE["\x6d\157\x5f\x69\x64\160\137\x6c\157\x67\x6f\x75\x74\x5f\162\x65\161\x75\145\x73\x74\137\x69\163\x73\165\145\162"])) {
            goto gg;
        }
        if (!ob_get_contents()) {
            goto L4;
        }
        ob_clean();
        L4:
        setcookie("\155\157\x5f\151\144\160\x5f\x6c\157\x67\x6f\x75\x74\137\x72\145\161\x75\145\163\x74\x5f\151\163\x73\165\145\x72", $_SESSION["\x6d\157\137\x69\144\x70\137\x6c\157\147\x6f\x75\x74\x5f\x72\x65\x71\x75\x65\x73\164\137\x69\163\x73\x75\145\162"], time() + 21600, "\x2f");
        setcookie("\155\157\x5f\x69\x64\160\137\x6c\157\x67\157\165\x74\x5f\162\145\154\141\x79\x5f\163\x74\x61\x74\145", $_SESSION["\155\x6f\x5f\x69\x64\x70\137\x6c\157\147\157\x75\164\137\x72\x65\154\141\171\x5f\163\164\x61\x74\145"], time() + 21600, "\57");
        setcookie("\x6d\157\x5f\x69\x64\x70\x5f\x6c\157\147\x6f\x75\x74\x5f\x72\145\x71\x75\x65\x73\x74\137\x69\x64", $_SESSION["\x6d\157\x5f\151\144\x70\137\x6c\157\147\x6f\165\x74\137\x72\145\161\165\145\163\164\x5f\x69\144"], time() + 21600, "\x2f");
        gg:
        $this->mo_idp_initiated_logout($GU);
        goto Cl;
        qQ:
        $ef = isset($_COOKIE["\155\157\x5f\151\x64\x70\137\154\x6f\x67\x6f\165\x74\x5f\162\x65\161\165\145\163\x74\x5f\151\x73\x73\x75\x65\162"]) ? $_COOKIE["\x6d\157\137\151\x64\160\137\154\157\x67\157\165\x74\x5f\x72\145\x71\x75\x65\163\x74\x5f\151\163\x73\x75\145\x72"] : $_SESSION["\x6d\x6f\137\x69\x64\160\x5f\154\157\147\157\165\x74\x5f\162\145\x71\165\145\x73\x74\x5f\151\x73\163\165\145\x72"];
        $mC = isset($_COOKIE["\x6d\157\x5f\151\144\x70\137\x6c\157\147\x6f\165\164\x5f\x72\x65\161\165\x65\x73\x74\137\151\144"]) ? $_COOKIE["\155\157\137\x69\144\160\137\x6c\x6f\147\157\165\164\x5f\x72\145\x71\x75\x65\163\x74\137\x69\144"] : $_SESSION["\155\157\137\x69\144\x70\137\154\157\x67\157\x75\164\137\162\x65\x71\165\145\x73\x74\x5f\x69\144"];
        $HD = urldecode(isset($_COOKIE["\x6d\x6f\x5f\151\x64\160\x5f\154\x6f\x67\157\165\x74\137\162\145\154\x61\171\x5f\x73\164\141\x74\145"]) ? $_COOKIE["\x6d\157\x5f\x69\x64\160\x5f\154\x6f\x67\157\x75\164\x5f\x72\x65\x6c\141\171\137\163\164\x61\164\x65"] : $_SESSION["\155\x6f\x5f\x69\x64\160\137\154\157\x67\x6f\165\x74\137\x72\145\x6c\x61\x79\x5f\163\164\141\x74\145"]);
        $this->sendResponseHandler->mo_idp_send_logout_response($ef, $mC, $HD);
        Cl:
    }
}
