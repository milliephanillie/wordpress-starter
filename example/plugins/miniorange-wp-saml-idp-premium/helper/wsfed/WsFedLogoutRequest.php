<?php


namespace IDP\Helper\WSFED;

use IDP\Helper\Constants\MoIDPConstants;
use IDP\Helper\Factory\RequestHandlerFactory;
use IDP\Helper\Utilities\MoIDPUtility;
class LogoutRequest implements RequestHandlerFactory
{
    private $requestType = MoIDPConstants::WSFED_LOGOUT_REQUEST;
    public function __construct($F7)
    {
    }
    public function generateRequest()
    {
    }
    public function getRequestType()
    {
        return $this->getRequestType();
    }
    function generateUniqueID($B0)
    {
        return MoIDPUtility::generateRandomAlphanumericValue($B0);
    }
}
