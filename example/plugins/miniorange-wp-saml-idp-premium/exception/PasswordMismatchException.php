<?php


namespace IDP\Exception;

use IDP\Helper\Constants\MoIDPMessages;
class PasswordMismatchException extends \Exception
{
    public function __construct()
    {
        $aP = MoIDPMessages::showMessage("\x50\101\x53\123\x5f\115\111\x53\115\x41\x54\103\x48");
        $cT = 122;
        parent::__construct($aP, $cT, NULL);
    }
    public function __toString()
    {
        return __CLASS__ . "\72\40\133{$this->code}\135\x3a\x20{$this->message}\12";
    }
}
