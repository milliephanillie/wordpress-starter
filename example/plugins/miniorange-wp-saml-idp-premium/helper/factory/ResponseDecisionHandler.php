<?php


namespace IDP\Helper\Factory;

use IDP\Helper\Constants\MoIDPConstants;
use IDP\Helper\SAML2\GenerateLogoutResponse;
use IDP\Helper\SAML2\GenerateResponse;
use IDP\Helper\WSFED\GenerateWsFedResponse;
use IDP\Helper\JWT\GenerateJwtToken;
class ResponseDecisionHandler
{
    public static function getResponseHandler($p8, $BM)
    {
        switch ($p8) {
            case MoIDPConstants::LOGOUT_RESPONSE:
                return new GenerateLogoutResponse($BM[0], $BM[1], $BM[2]);
                goto JL;
            case MoIDPConstants::SAML_RESPONSE:
                return new GenerateResponse($BM[0], $BM[1], $BM[2], $BM[3], $BM[4], $BM[5], $BM[6], $BM[7]);
                goto JL;
            case MoIDPConstants::WS_FED_RESPONSE:
                return new GenerateWsFedResponse($BM[0], $BM[1], $BM[2], $BM[3], $BM[4], $BM[5], $BM[6]);
                goto JL;
            case MoIDPConstants::JWT_RESPONSE:
                return new GenerateJwtToken($BM[1], $BM[2], $BM[3], $BM[4], $BM[6]);
                goto JL;
        }
        p3:
        JL:
    }
}
