<?php


namespace IDP\Handler;

use IDP\Exception\InvalidServiceProviderException;
use IDP\Exception\InvalidSignatureInRequestException;
use IDP\Helper\Constants\MoIDPConstants;
use IDP\Helper\Database\MoDbQueries;
use IDP\Helper\Factory\RequestDecisionHandler;
use IDP\Helper\SAML2\AuthnRequest;
use IDP\Helper\SAML2\LogoutRequest;
use IDP\Helper\Traits\Instance;
use IDP\Helper\Utilities\MoIDPUtility;
use IDP\Helper\Utilities\SAMLUtilities;
use IDP\Helper\WSFED\WsFedRequest;
use RobRichards\XMLSecLibs\XMLSecurityKey;
final class ReadRequestHandler extends BaseHandler
{
    use Instance;
    private $requestProcessHandler;
    private function __construct()
    {
        $this->requestProcessHandler = ProcessRequestHandler::instance();
    }
    public function _read_request(array $nr, array $GX, $p8)
    {
        if (!MSI_DEBUG) {
            goto He;
        }
        MoIDPUtility::mo_debug("\x52\145\141\144\151\x6e\147\x20\x53\101\x4d\x4c\x20\122\145\161\165\x65\x73\x74");
        He:
        $this->checkIfValidPlugin();
        $Jp = RequestDecisionHandler::getRequestHandler($p8, $nr, $GX);
        $Ae = array_key_exists("\x52\145\154\141\x79\x53\164\141\x74\145", $nr) ? $nr["\122\145\x6c\141\x79\123\x74\x61\x74\145"] : "\x2f";
        switch ($Jp->getRequestType()) {
            case MoIDPConstants::LOGOUT_REQUEST:
                $this->mo_idp_process_logout_request($Jp, $Ae);
                goto j2;
            case MoIDPConstants::AUTHN_REQUEST:
                $this->mo_idp_process_assertion_request($Jp, $Ae, $GX);
                goto j2;
            case MoIDPConstants::WS_FED:
                $this->mo_idp_process_ws_fed_request($Jp, $Ae);
                goto j2;
        }
        BD:
        j2:
    }
    public function mo_idp_process_ws_fed_request(WsFedRequest $hI, $Ae)
    {
        global $dbIDPQueries;
        if (!MSI_DEBUG) {
            goto sO;
        }
        MoIDPUtility::mo_debug($hI);
        sO:
        $this->checkIfValidPlugin();
        $Lm = $dbIDPQueries->get_sp_from_issuer($hI->getWtRealm());
        $this->checkIfValidSP($Lm);
        $wA = $Lm->mo_idp_acs_url;
        $this->requestProcessHandler->mo_idp_authorize_user($Ae, $hI);
    }
    private function mo_idp_process_assertion_request(AuthnRequest $os, $Ae, $GX)
    {
        global $dbIDPQueries;
        if (!MSI_DEBUG) {
            goto XM;
        }
        MoIDPUtility::mo_debug($os);
        XM:
        $t3 = $os->getIssuer();
        $wA = $os->getAssertionConsumerServiceURL();
        $Lm = $dbIDPQueries->get_sp_from_issuer($t3);
        $Lm = !isset($Lm) ? $dbIDPQueries->get_sp_from_acs($wA) : $Lm;
        $this->checkIfValidSP($Lm);
        $t3 = $Lm->mo_idp_sp_issuer;
        $wA = $Lm->mo_idp_acs_url;
        $os->setIssuer($t3);
        $os->setAssertionConsumerServiceURL($wA);
        $FL = SAMLUtilities::validateElement($os->getXml());
        $A2 = $Lm->mo_idp_cert;
        $A2 = XMLSecurityKey::getRawThumbprint($A2);
        $A2 = iconv("\x55\124\x46\55\70", "\x43\120\x31\x32\x35\x32\57\57\x49\x47\x4e\x4f\x52\105", $A2);
        $A2 = preg_replace("\57\134\163\53\57", '', $A2);
        if (empty($A2)) {
            goto WY;
        }
        if ($FL !== FALSE) {
            goto yY;
        }
        if (array_key_exists("\123\151\147\156\141\x74\x75\x72\x65", $GX)) {
            goto dP;
        }
        throw new InvalidSignatureInRequestException();
        goto RK;
        yY:
        $this->validateSignatureInRequest($A2, $FL);
        goto RK;
        dP:
        if (array_key_exists("\122\145\x6c\141\171\x53\x74\x61\164\x65", $GX)) {
            goto B_;
        }
        $FL = "\123\101\115\x4c\122\x65\161\x75\x65\x73\x74\x3d" . urlencode($GX["\123\101\115\x4c\122\145\161\165\x65\x73\164"]) . "\x26\123\151\x67\x41\154\x67\x3d" . urlencode($GX["\123\151\x67\101\x6c\x67"]);
        goto Vg;
        B_:
        $FL = "\123\x41\x4d\x4c\x52\145\x71\165\x65\163\164\x3d" . urlencode($GX["\x53\x41\115\x4c\122\145\161\x75\x65\x73\164"]) . "\x26\x52\x65\x6c\x61\171\x53\164\141\164\x65\75" . urlencode($GX["\122\145\x6c\x61\x79\x53\x74\141\164\x65"]) . "\46\x53\x69\x67\x41\x6c\147\75" . urlencode($GX["\123\151\147\101\x6c\147"]);
        Vg:
        $VI = $GX["\x53\151\147\101\x6c\147"];
        $UV = new XMLSecurityKey($VI, array("\164\x79\x70\145" => "\160\x75\x62\154\151\143"));
        $UV->loadKey($Lm->mo_idp_cert);
        $Ag = $UV->verifySignature($FL, base64_decode($GX["\x53\x69\147\x6e\141\x74\165\x72\145"]));
        if (!($Ag !== 1)) {
            goto hG;
        }
        throw new InvalidSignatureInRequestException();
        hG:
        RK:
        WY:
        $Ae = MoIDPUtility::isBlank($Lm->mo_idp_default_relayState) ? $Ae : $Lm->mo_idp_default_relayState;
        $this->requestProcessHandler->mo_idp_authorize_user($Ae, $os);
    }
    public function checkIfValidSP($Lm)
    {
        if (!MoIDPUtility::isBlank($Lm)) {
            goto LA;
        }
        throw new InvalidServiceProviderException();
        LA:
    }
    public function validateSignatureInRequest($A2, $FL)
    {
        if (SAMLUtilities::processRequest($A2, $FL)) {
            goto Ub;
        }
        throw new InvalidSignatureInRequestException();
        Ub:
    }
    public function _read_saml_response(array $nr, array $GX)
    {
        if (!MSI_DEBUG) {
            goto rB;
        }
        MoIDPUtility::mo_debug("\122\145\141\144\151\156\147\x20\x53\101\x4d\114\40\x52\145\163\x70\x6f\x6e\x73\145");
        rB:
        $this->checkIfValidPlugin();
        $rR = $nr["\123\101\115\x4c\122\x65\x73\x70\157\x6e\x73\145"];
        $Ae = array_key_exists("\122\145\x6c\x61\171\x53\164\x61\x74\145", $nr) ? $nr["\x52\x65\x6c\x61\x79\123\x74\141\164\145"] : "\57";
        $rR = base64_decode($rR);
        if (!(array_key_exists("\123\101\115\114\122\145\163\160\x6f\x6e\x73\x65", $GX) && !empty($GX["\123\x41\x4d\x4c\x52\145\x73\160\x6f\156\x73\x65"]))) {
            goto j_;
        }
        $rR = gzinflate($rR);
        j_:
        $BG = new \DOMDocument();
        $BG->loadXML($rR);
        $gN = $BG->firstChild;
        if (!($gN->localName != "\x4c\157\x67\x6f\x75\164\122\x65\163\160\157\156\163\x65")) {
            goto LB;
        }
        return;
        LB:
        $this->requestProcessHandler->processLogoutResponseFromSP();
    }
    private function mo_idp_process_logout_request($eX, $Ae)
    {
        if (!MSI_DEBUG) {
            goto Hd;
        }
        MoIDPUtility::mo_debug($eX);
        Hd:
        MoIDPUtility::startSession();
        $_SESSION["\x6d\x6f\137\x69\144\160\137\154\157\x67\157\165\164\137\162\145\161\x75\x65\163\164\x5f\x69\x73\163\x75\x65\x72"] = $eX->getIssuer();
        $_SESSION["\x6d\157\x5f\151\x64\160\x5f\x6c\157\x67\157\165\x74\x5f\162\145\161\165\145\163\164\137\x69\144"] = $eX->getId();
        $_SESSION["\155\157\x5f\151\x64\x70\137\x6c\157\147\157\x75\x74\x5f\162\x65\154\x61\171\x5f\163\164\x61\x74\145"] = $Ae;
        wp_logout();
    }
}
