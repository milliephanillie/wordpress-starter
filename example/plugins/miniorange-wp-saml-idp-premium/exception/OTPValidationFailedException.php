<?php


namespace IDP\Exception;

use IDP\Helper\Constants\MoIDPMessages;
class OTPValidationFailedException extends \Exception
{
    public function __construct()
    {
        $aP = MoIDPMessages::showMessage("\111\x4e\x56\101\x4c\x49\104\x5f\x4f\x54\x50");
        $cT = 114;
        parent::__construct($aP, $cT, NULL);
    }
    public function __toString()
    {
        return __CLASS__ . "\x3a\40\x5b{$this->code}\x5d\x3a\x20{$this->message}\xa";
    }
}
