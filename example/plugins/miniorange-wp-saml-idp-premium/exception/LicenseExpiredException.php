<?php


namespace IDP\Exception;

use IDP\Helper\Constants\MoIDPMessages;
class LicenseExpiredException extends \Exception
{
    public function __construct()
    {
        $aP = MoIDPMessages::showMessage("\x4c\x49\103\x45\x4e\123\x45\x5f\x45\130\120\x49\x52\x45\104");
        $cT = 132;
        parent::__construct($aP, $cT, NULL);
    }
    public function __toString()
    {
        return __CLASS__ . "\x3a\40\133{$this->code}\135\72\40{$this->message}\12";
    }
}
