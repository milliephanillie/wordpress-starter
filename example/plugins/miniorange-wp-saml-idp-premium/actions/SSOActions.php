<?php


namespace IDP\Actions;

use IDP\Exception\InvalidRequestInstantException;
use IDP\Handler\ProcessRequestHandler;
use IDP\Handler\ReadRequestHandler;
use IDP\Handler\SendResponseHandler;
use IDP\Helper\Constants\MoIDPMessages;
use IDP\Helper\Constants\MoIDPConstants;
use IDP\Helper\Database\MoDbQueries;
use IDP\Helper\SAML2\AuthnRequest;
use IDP\Helper\Traits\Instance;
use IDP\Helper\Utilities\MoIDPUtility;
use IDP\Exception\NotRegisteredException;
use IDP\Exception\InvalidRequestVersionException;
use IDP\Exception\InvalidServiceProviderException;
use IDP\Exception\InvalidSignatureInRequestException;
use IDP\Exception\InvalidSSOUserException;
use IDP\Exception\LicenseExpiredException;
class SSOActions
{
    use Instance;
    private $readRequestHandler;
    private $sendResponseHandler;
    private $requestProcessHandler;
    private $requestParams = array("\x53\101\115\x4c\122\x65\x71\165\x65\163\x74", "\x6f\160\x74\151\x6f\156", "\167\x74\x72\x65\x61\154\155", "\x53\x41\x4d\114\122\145\163\160\x6f\156\x73\145");
    private function __construct()
    {
        $this->readRequestHandler = ReadRequestHandler::instance();
        $this->sendResponseHandler = SendResponseHandler::instance();
        $this->requestProcessHandler = ProcessRequestHandler::instance();
        add_action("\x69\x6e\x69\x74", array($this, "\137\x68\x61\x6e\144\x6c\x65\x5f\x53\123\117"));
        add_action("\167\x70\137\x6c\157\x67\151\x6e", array($this, "\x6d\x6f\x5f\151\x64\160\137\x68\141\x6e\144\x6c\x65\x5f\160\157\163\x74\x5f\x6c\157\x67\151\x6e"), 99);
        add_action("\x77\160\137\x6c\x6f\x67\x6f\x75\x74", array($this, "\155\157\x5f\151\x64\x70\x5f\154\x6f\x67\157\x75\x74"), 1, 1);
        add_filter("\x6d\x6f\144\151\x66\x79\x5f\x73\x61\x6d\x6c\137\141\164\164\162\x5f\x76\x61\154\165\145", array($this, "\155\157\144\x69\x66\x79\125\x73\145\162\x41\x74\x74\162\x69\142\x75\x74\x65\x44\141\x74\x65\126\x61\x6c\x75\145"), 1, 1);
        add_action("\155\x6f\x5f\x63\x68\145\x63\x6b\x5f\x62\x65\x66\157\162\145\137\x6d\151\x73\162", array($this, "\155\x6f\137\151\144\x70\137\x72\x65\163\164\162\x69\143\164\137\x75\163\x65\x72\163"), 1, 3);
        add_filter("\155\157\x5f\151\144\160\137\143\165\x73\x74\x6f\155\137\x6c\157\147\x69\156\137\165\162\154", array($this, "\x6d\157\x5f\x69\x64\x70\x5f\x72\x65\x74\165\x72\156\x5f\143\165\163\164\157\155\137\x6c\157\x67\151\156"), 10, 1);
    }
    public function _handle_SSO()
    {
        $no = array_keys($_REQUEST);
        $hj = array_intersect($no, $this->requestParams);
        if (!(count($hj) <= 0)) {
            goto Vt;
        }
        return;
        Vt:
        try {
            $this->_route_data(array_values($hj)[0]);
        } catch (NotRegisteredException $zU) {
            if (!MSI_DEBUG) {
                goto PK;
            }
            MoIDPUtility::mo_debug("\105\x78\143\x65\x70\164\151\x6f\x6e\x20\x4f\143\x63\x75\x72\x72\x65\144\x20\144\165\162\151\x6e\x67\40\123\x53\x4f\40" . $zU);
            PK:
            wp_die(MoIDPMessages::SAML_INVALID_OPERATION);
        } catch (InvalidRequestInstantException $zU) {
            if (!MSI_DEBUG) {
                goto Hb;
            }
            MoIDPUtility::mo_debug("\x45\x78\143\x65\x70\x74\x69\x6f\x6e\40\117\143\x63\x75\x72\x72\145\144\x20\144\x75\x72\x69\156\x67\x20\x53\x53\117\40" . $zU);
            Hb:
            wp_die($zU->getMessage());
        } catch (InvalidRequestVersionException $zU) {
            if (!MSI_DEBUG) {
                goto GP;
            }
            MoIDPUtility::mo_debug("\x45\170\143\145\160\x74\x69\157\x6e\40\117\x63\143\165\x72\x72\x65\144\x20\x64\x75\x72\x69\x6e\147\x20\123\123\x4f\x20" . $zU);
            GP:
            wp_die($zU->getMessage());
        } catch (InvalidServiceProviderException $zU) {
            if (!MSI_DEBUG) {
                goto RC;
            }
            MoIDPUtility::mo_debug("\105\x78\143\145\160\x74\151\x6f\156\40\117\x63\143\x75\x72\162\145\x64\x20\x64\165\162\x69\x6e\147\40\123\123\x4f\x20" . $zU);
            RC:
            wp_die($zU->getMessage());
        } catch (InvalidSignatureInRequestException $zU) {
            if (!MSI_DEBUG) {
                goto Lz;
            }
            MoIDPUtility::mo_debug("\x45\x78\x63\x65\160\x74\x69\x6f\x6e\x20\117\143\143\165\x72\x72\145\144\x20\144\x75\x72\151\156\147\40\123\x53\x4f\40" . $zU);
            Lz:
            wp_die($zU->getMessage());
        } catch (InvalidSSOUserException $zU) {
            if (!MSI_DEBUG) {
                goto jY;
            }
            MoIDPUtility::mo_debug("\105\x78\x63\145\x70\164\x69\157\x6e\x20\x4f\x63\x63\x75\162\162\145\144\40\144\x75\162\151\x6e\x67\40\x53\123\x4f\x20" . $zU);
            jY:
            wp_die($zU->getMessage());
        } catch (LicenseExpiredException $zU) {
            if (!MSI_DEBUG) {
                goto Tz;
            }
            MoIDPUtility::mo_debug("\105\x78\x63\x65\x70\164\x69\x6f\156\x20\x4f\143\x63\x75\162\x72\x65\x64\40\144\x75\x72\151\x6e\147\40\123\123\x4f\40" . $zU);
            Tz:
            wp_die($zU->getMessage());
        } catch (\Exception $zU) {
            if (!MSI_DEBUG) {
                goto FY;
            }
            MoIDPUtility::mo_debug("\x45\170\143\x65\160\164\151\x6f\x6e\x20\x4f\143\x63\x75\162\162\x65\x64\x20\144\x75\162\151\x6e\147\x20\x53\123\x4f\40" . $zU);
            FY:
            wp_die($zU->getMessage());
        }
    }
    public function _route_data($Jz)
    {
        switch ($Jz) {
            case $this->requestParams[0]:
                $this->readRequestHandler->_read_request($_REQUEST, $_GET, MoIDPConstants::SAML);
                goto lI;
            case $this->requestParams[1]:
                $this->_initiate_saml_response($_REQUEST);
                goto lI;
            case $this->requestParams[2]:
                $this->readRequestHandler->_read_request($_REQUEST, $_GET, MoIDPConstants::WS_FED);
                goto lI;
            case $this->requestParams[3]:
                $this->readRequestHandler->_read_saml_response($_REQUEST, $_GET);
                goto lI;
        }
        uE:
        lI:
    }
    public function mo_idp_handle_post_login($km)
    {
        if (!(array_key_exists("\162\145\163\160\157\156\x73\145\137\x70\141\162\141\x6d\163", $_COOKIE) && !MoIDPUtility::isBlank($_COOKIE["\162\145\x73\x70\157\156\163\145\x5f\160\x61\x72\141\155\x73"]))) {
            goto lK;
        }
        try {
            if (!(isset($_COOKIE["\155\x6f\111\x64\160\163\145\x6e\x64\x53\x41\x4d\x4c\x52\x65\x73\160\x6f\156\x73\145"]) && strcmp($_COOKIE["\x6d\157\x49\144\x70\x73\145\156\144\x53\101\115\x4c\x52\x65\163\x70\157\x6e\x73\x65"], "\164\162\165\x65") == 0)) {
                goto xz;
            }
            $this->sendResponseHandler->mo_idp_send_response(["\162\x65\x71\165\x65\x73\x74\124\x79\x70\145" => MoIDPConstants::AUTHN_REQUEST, "\x61\x63\x73\137\165\x72\x6c" => $_COOKIE["\x61\x63\163\137\165\162\x6c"], "\151\163\163\165\145\162" => $_COOKIE["\141\x75\x64\151\145\x6e\143\145"], "\162\145\154\141\171\x53\x74\141\x74\x65" => $_COOKIE["\x72\x65\x6c\141\171\123\x74\141\x74\145"], "\162\145\x71\x75\145\x73\x74\111\x44" => array_key_exists("\162\x65\x71\x75\145\x73\x74\111\104", $_COOKIE) ? $_COOKIE["\162\145\161\x75\145\x73\164\111\x44"] : null], $km);
            xz:
            if (!(isset($_COOKIE["\155\x6f\x49\144\x70\163\x65\x6e\144\127\163\106\x65\144\x52\x65\x73\160\x6f\156\163\145"]) && strcmp($_COOKIE["\155\157\111\144\x70\x73\x65\156\x64\127\163\106\x65\144\x52\145\163\160\157\x6e\163\145"], "\164\162\x75\x65") == 0)) {
                goto AT;
            }
            $this->sendResponseHandler->mo_idp_send_response(["\162\x65\161\165\145\x73\164\124\171\160\145" => MoIDPConstants::WS_FED, "\x63\x6c\x69\x65\156\164\x52\145\x71\165\x65\x73\164\x49\144" => $_COOKIE["\143\x6c\x69\x65\156\x74\x52\145\161\x75\145\163\164\111\144"], "\x77\x74\162\x65\x61\154\155" => $_COOKIE["\x77\164\162\x65\141\154\155"], "\x77\x61" => $_COOKIE["\x77\141"], "\162\x65\154\x61\x79\123\x74\x61\x74\145" => $_COOKIE["\x72\145\x6c\x61\x79\x53\164\141\164\x65"], "\x77\143\x74\x78" => $_COOKIE["\167\143\164\x78"]], $km);
            AT:
            if (!(isset($_COOKIE["\x6d\x6f\x49\x64\x70\123\x65\156\x64\112\127\x54\x52\145\163\x70\x6f\x6e\163\x65"]) && strcmp($_COOKIE["\155\157\x49\144\160\x53\145\x6e\144\112\x57\124\122\145\163\x70\x6f\x6e\x73\145"], "\164\162\165\145") == 0)) {
                goto LK;
            }
            $this->sendResponseHandler->mo_idp_send_response(["\x72\x65\161\x75\x65\x73\164\x54\x79\160\145" => MoIDPConstants::JWT, "\152\x77\164\137\x65\x6e\144\160\157\151\x6e\164" => $_COOKIE["\x6a\167\164\x5f\x65\156\x64\160\x6f\x69\x6e\x74"], "\163\x68\141\x72\145\x64\x53\x65\x63\162\145\164" => $_COOKIE["\163\150\x61\162\145\x64\123\145\143\x72\x65\x74"], "\x72\145\x74\165\x72\156\x5f\164\157\137\x75\162\154" => $_COOKIE["\162\x65\164\165\162\156\137\x74\157\137\165\x72\154"]], $km);
            LK:
        } catch (NotRegisteredException $zU) {
            if (!MSI_DEBUG) {
                goto Ck;
            }
            MoIDPUtility::mo_debug("\x45\170\143\x65\x70\164\151\x6f\x6e\40\x4f\x63\x63\x75\162\x72\145\144\40\144\165\162\x69\x6e\x67\40\x53\x53\117\40" . $zU);
            Ck:
            wp_die(MoIDPMessages::SAML_INVALID_OPERATION);
        } catch (InvalidSSOUserException $zU) {
            if (!MSI_DEBUG) {
                goto oz;
            }
            MoIDPUtility::mo_debug("\105\170\143\x65\160\164\151\157\x6e\40\x4f\x63\x63\x75\x72\162\x65\x64\40\144\165\x72\x69\x6e\x67\40\x53\x53\x4f\x20" . $zU);
            oz:
            wp_die($zU->getMessage());
        } catch (LicenseExpiredException $zU) {
            if (!MSI_DEBUG) {
                goto Db;
            }
            MoIDPUtility::mo_debug("\x45\x78\x63\145\x70\x74\x69\157\156\x20\117\x63\143\x75\x72\162\x65\x64\40\144\x75\x72\151\156\147\x20\123\x53\117\40" . $zU);
            Db:
            wp_die($zU->getMessage());
        }
        lK:
    }
    private function _initiate_saml_response($nr)
    {
        if ($_REQUEST["\157\160\x74\x69\x6f\156"] == "\x74\145\x73\164\x43\x6f\156\146\x69\x67") {
            goto TL;
        }
        if ($_REQUEST["\157\x70\x74\151\x6f\x6e"] === "\163\141\155\154\x5f\x75\x73\x65\162\137\x6c\157\x67\x69\156") {
            goto q4;
        }
        if ($_REQUEST["\x6f\160\x74\151\157\x6e"] === "\x74\145\x73\164\x5f\152\167\164") {
            goto Iw;
        }
        if ($_REQUEST["\x6f\x70\x74\x69\157\156"] === "\152\x77\164\x5f\x6c\x6f\x67\151\x6e") {
            goto ei;
        }
        if ($_REQUEST["\x6f\160\x74\x69\157\x6e"] === "\x6d\x6f\x5f\x69\144\x70\x5f\x6d\145\164\141\144\x61\164\x61") {
            goto p5;
        }
        goto d4;
        TL:
        $this->sendSAMLResponseBasedOnRequestData($nr);
        goto d4;
        q4:
        $this->sendSAMLResponseBasedOnSPName($_REQUEST["\163\x70"], $_REQUEST["\162\x65\x6c\141\171\123\x74\141\164\145"]);
        goto d4;
        Iw:
        $this->sendJWTTestToken($_REQUEST);
        goto d4;
        ei:
        $this->sendJwtToken($_REQUEST["\163\160"], $_REQUEST["\x72\x65\x6c\x61\x79\123\164\141\164\145"]);
        goto d4;
        p5:
        MoIDPUtility::showMetadata();
        d4:
    }
    private function sendSAMLResponseBasedOnRequestData($nr)
    {
        $xa = !array_key_exists("\x64\x65\146\x61\x75\x6c\164\x52\x65\154\141\171\123\x74\141\164\145", $nr) || MoIDPUtility::isBlank($_REQUEST["\144\x65\x66\141\x75\x6c\x74\122\x65\154\141\x79\123\164\141\164\145"]) ? "\x2f" : $_REQUEST["\x64\145\x66\x61\x75\x6c\x74\122\145\x6c\x61\x79\x53\x74\141\x74\145"];
        $this->sendResponseHandler->mo_idp_send_response(["\162\145\161\x75\x65\163\164\x54\171\160\145" => MoIDPConstants::AUTHN_REQUEST, "\x61\143\163\137\165\x72\154" => $_REQUEST["\x61\143\x73"], "\x69\163\x73\x75\145\162" => $_REQUEST["\151\163\x73\165\x65\162"], "\162\145\154\141\171\123\164\141\x74\145" => $xa]);
    }
    private function sendSAMLResponseBasedOnSPName($qj, $Ae)
    {
        global $dbIDPQueries;
        $Lm = $dbIDPQueries->get_sp_from_name($qj);
        if (MoIDPUtility::isBlank($Lm)) {
            goto em;
        }
        $xa = !MoIDPUtility::isBlank($Ae) ? $Ae : (MoIDPUtility::isBlank($Lm->mo_idp_default_relayState) ? "\57" : $Lm->mo_idp_default_relayState);
        if (is_user_logged_in()) {
            goto gK;
        }
        $ks = new AuthnRequest();
        $ks = $ks->setAssertionConsumerServiceURL($Lm->mo_idp_acs_url)->setIssuer($Lm->mo_idp_sp_issuer)->setRequestID(null);
        $this->requestProcessHandler->setSAMLSessionCookies($ks, $xa);
        gK:
        $this->sendResponseHandler->mo_idp_send_response(["\x72\x65\x71\165\145\163\x74\x54\x79\x70\x65" => MoIDPConstants::AUTHN_REQUEST, "\x61\x63\163\x5f\165\x72\x6c" => $Lm->mo_idp_acs_url, "\151\163\x73\x75\x65\x72" => $Lm->mo_idp_sp_issuer, "\162\x65\154\x61\171\123\164\x61\164\145" => $xa]);
        em:
    }
    public function mo_idp_logout($GU)
    {
        if (!($GU != 0)) {
            goto m9;
        }
        if (!ob_get_contents()) {
            goto AY;
        }
        ob_clean();
        AY:
        setcookie("\155\157\x5f\x69\x64\x70\x5f\x6c\x61\163\x74\137\154\157\147\x67\x65\x64\x5f\x69\x6e\x5f\x75\163\145\162", $GU, time() + 600, "\57");
        m9:
        MoIDPUtility::startSession();
        if ($GU != 0) {
            goto IY;
        }
        if (!MSI_DEBUG) {
            goto WF;
        }
        MoIDPUtility::mo_debug("\x55\163\145\162\40\x61\154\x72\145\141\x64\171\40\154\x6f\147\x67\145\x64\40\x6f\165\x74\56\x20\123\145\156\144\151\x6e\147\x20\154\157\147\157\165\164\x20\162\145\x73\160\157\x6e\163\x65\x2e");
        WF:
        $ef = array_key_exists("\155\157\137\151\x64\160\137\x6c\x6f\x67\157\x75\164\x5f\162\x65\161\x75\x65\163\x74\x5f\151\x73\163\x75\x65\162", $_SESSION) ? $_SESSION["\x6d\157\x5f\151\x64\160\x5f\x6c\157\147\x6f\x75\x74\137\162\145\161\x75\145\163\164\x5f\x69\x73\163\165\145\x72"] : NULL;
        $mC = array_key_exists("\x6d\157\137\151\144\x70\137\x6c\x6f\147\x6f\x75\x74\x5f\162\145\161\x75\x65\163\164\137\151\x64", $_SESSION) ? $_SESSION["\155\x6f\137\151\144\x70\x5f\x6c\x6f\x67\x6f\x75\x74\x5f\162\x65\161\x75\145\163\164\x5f\x69\x64"] : NULL;
        $HD = array_key_exists("\155\157\137\x69\x64\x70\137\x6c\157\147\157\x75\164\x5f\162\x65\154\141\171\137\x73\x74\x61\x74\145", $_SESSION) ? $_SESSION["\155\157\x5f\151\144\160\x5f\x6c\x6f\x67\157\x75\164\137\x72\145\154\141\171\x5f\163\164\141\164\x65"] : NULL;
        if (MoIDPUtility::isBlank($ef)) {
            goto pU;
        }
        $this->sendResponseHandler->mo_idp_send_logout_response($ef, $mC, $HD);
        pU:
        goto qy;
        IY:
        $this->requestProcessHandler->checkAndLogoutUserFromLoggedInSPs($GU);
        qy:
    }
    private function sendJWTTestToken($nr)
    {
        $this->sendResponseHandler->mo_idp_send_response(["\x72\x65\161\x75\x65\163\x74\124\171\x70\145" => MoIDPConstants::JWT, "\152\x77\x74\137\x65\x6e\x64\x70\x6f\151\156\x74" => $nr["\x61\x63\x73"], "\x73\x68\141\162\x65\x64\123\x65\x63\162\145\164" => $nr["\x69\x73\x73\165\x65\162"], "\162\x65\x74\x75\162\x6e\x5f\x74\157\137\165\x72\154" => $nr["\144\145\146\x61\165\154\x74\x52\x65\154\x61\171\123\x74\141\x74\x65"]]);
    }
    private function sendJWTToken($qj, $Ae)
    {
        global $dbIDPQueries;
        $Lm = $dbIDPQueries->get_sp_from_name($qj);
        $xa = !MoIDPUtility::isBlank($Ae) ? $Ae : (MoIDPUtility::isBlank($Lm->mo_idp_default_relayState) ? "\x2f" : $Lm->mo_idp_default_relayState);
        if (is_user_logged_in()) {
            goto I3;
        }
        $ks = ["\152\x77\164\x5f\145\156\144\160\x6f\x69\156\164" => $Lm->mo_idp_acs_url, "\x73\150\141\x72\x65\144\x53\145\143\162\x65\x74" => $Lm->mo_idp_sp_issuer, "\x72\145\x74\165\162\156\x5f\x74\157\x5f\x75\162\154" => $xa];
        $this->requestProcessHandler->setJWTSessionCookies($ks, $xa);
        I3:
        if (MoIDPUtility::isBlank($Lm)) {
            goto N4;
        }
        $this->sendResponseHandler->mo_idp_send_response(["\162\x65\x71\165\145\163\x74\x54\x79\x70\x65" => MoIDPConstants::JWT, "\152\x77\x74\x5f\145\156\x64\x70\x6f\x69\x6e\164" => $Lm->mo_idp_acs_url, "\163\150\141\162\145\144\x53\145\143\x72\x65\164" => $Lm->mo_idp_sp_issuer, "\162\145\164\x75\x72\156\137\x74\x6f\137\165\x72\154" => $xa]);
        N4:
    }
    public function modifyUserAttributeDateValue($Ev)
    {
        $F2 = array("\x64\56\x6d\56\x59", "\144\57\x6d\57\x59", "\x64\55\x6d\55\131", "\x59\x2f\x6d\57\x64", "\x59\x2d\155\x2d\x64", "\131\x2e\155\56\x64", "\x6d\x2e\x64\56\x59", "\155\x2d\x64\x2d\x59", "\155\x2f\x64\x2f\131");
        $WK = false;
        foreach ($F2 as $FR) {
            $EV = \DateTime::createFromFormat($FR, $Ev);
            $WK = $EV && $EV->format($FR) == $Ev ? true : false;
            if (!$WK) {
                goto tw;
            }
            $Ev = str_replace("\57", "\55", $Ev);
            $Ev = date("\x6d\x2d\x64\55\131", strtotime($Ev));
            $Ev = str_replace("\55", "\x2f", $Ev);
            tw:
            ks:
        }
        ZM:
        return $Ev;
    }
    function mo_idp_restrict_users($current_user, $BM, $km)
    {
        if (!empty(get_site_option("\x6d\x6f\x5f\151\x64\160\137\162\x6f\154\145\x5f\x62\141\163\x65\x64\137\162\x65\x73\x74\x72\151\x63\164\x69\157\x6e"))) {
            goto Ss;
        }
        return;
        Ss:
        $y7 = !is_array(get_site_option("\155\157\137\151\144\x70\137\x73\x73\157\x5f\x61\154\x6c\157\x77\x65\144\x5f\162\x6f\154\x65\x73")) ? array() : MoIDPUtility::sanitizeAssociativeArray(get_site_option("\155\157\x5f\151\x64\x70\137\163\x73\157\137\x61\154\x6c\x6f\167\145\144\137\x72\157\154\145\x73"));
        $wr = $current_user->roles;
        $qG = end($wr);
        foreach ($wr as $BD) {
            if (!isset($y7[$BD])) {
                goto HQ;
            }
            return;
            goto o1;
            HQ:
            if (!($qG === $BD)) {
                goto ma;
            }
            throw new InvalidSSOUserException();
            ma:
            o1:
            M_:
        }
        ze:
    }
    public function mo_idp_return_custom_login($mK)
    {
        $fx = get_site_option("\x6d\157\137\x69\x64\x70\x5f\143\165\x73\x74\x6f\x6d\137\154\157\147\151\x6e\x5f\165\x72\x6c");
        if (!(isset($fx) && !empty($fx))) {
            goto Qi;
        }
        $mK = $fx;
        Qi:
        return $mK;
    }
}
