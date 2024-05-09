<?php


namespace IDP\Exception;

use IDP\Helper\Constants\MoIDPMessages;
class InvalidSSOUserException extends \Exception
{
    public function __construct()
    {
        $aP = MoIDPMessages::showMessage("\x49\116\126\101\x4c\111\x44\x5f\x55\x53\x45\x52");
        $cT = 121;
        parent::__construct($aP, $cT, NULL);
    }
    public function __toString()
    {
        return __CLASS__ . "\72\40\x5b{$this->code}\x5d\72\40{$this->message}\12";
    }
}
