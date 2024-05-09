<?php


namespace IDP\Exception;

use IDP\Helper\Constants\MoIDPMessages;
class OTPRequiredException extends \Exception
{
    public function __construct()
    {
        $aP = MoIDPMessages::showMessage("\x52\x45\121\x55\x49\122\x45\104\x5f\x4f\124\x50");
        $cT = 113;
        parent::__construct($aP, $cT, NULL);
    }
    public function __toString()
    {
        return __CLASS__ . "\72\40\x5b{$this->code}\x5d\72\40{$this->message}\12";
    }
}
