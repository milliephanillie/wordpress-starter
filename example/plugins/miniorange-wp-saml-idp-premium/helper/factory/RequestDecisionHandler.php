<?php


namespace IDP\Helper\Factory;

use IDP\Helper\Constants\MoIDPConstants;
use IDP\Helper\SAML2\AuthnRequest;
use IDP\Helper\SAML2\LogoutRequest;
use IDP\Helper\WSFED\WsFedRequest;
class RequestDecisionHandler
{
    public static function getRequestHandler($p8, $nr, $GX, $BM = array())
    {
        switch ($p8) {
            case MoIDPConstants::SAML:
                return self::getSAMLRequestHandler($nr, $GX);
                goto bo;
            case MoIDPConstants::WS_FED:
                return self::getWSFedRequestHandler($nr, $GX);
                goto bo;
            case MoIDPConstants::LOGOUT_REQUEST:
                return self::getLogoutRequestHandler($BM[0], $BM[1], $BM[2], $BM[3]);
                goto bo;
            case MoIDPConstants::AUTHN_REQUEST:
                return new AuthnRequest($BM[0]);
                goto bo;
        }
        Uq:
        bo:
    }
    public static function getSAMLRequestHandler($nr, $GX)
    {
        $et = $nr["\x53\x41\115\114\x52\x65\161\x75\145\x73\x74"];
        $et = base64_decode($et);
        if (!array_key_exists("\x53\x41\115\114\122\145\161\x75\145\163\x74", $GX)) {
            goto Wt;
        }
        $et = gzinflate($et);
        Wt:
        $BG = new \DOMDocument();
        $BG->loadXML($et);
        $Yp = $BG->firstChild;
        if ($Yp->localName == "\114\157\x67\157\165\x74\122\145\x71\165\x65\x73\x74") {
            goto yd;
        }
        return new AuthnRequest($Yp);
        goto UF;
        yd:
        return new LogoutRequest($Yp);
        UF:
    }
    public static function getWSFedRequestHandler($nr, $GX)
    {
        return new WsFedRequest($nr);
    }
    public static function getAuthnRequestHandler($Wp)
    {
        return;
    }
    public static function getLogoutRequestHandler($iD, $B6, $t3, $tY)
    {
        $eX = new LogoutRequest();
        $eX->setIssuer($t3);
        $eX->setDestination($tY);
        $eX->setNameId($iD);
        $eX->setSessionIndexes($B6);
        return $eX;
    }
}
