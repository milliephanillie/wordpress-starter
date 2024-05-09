<?php


namespace IDP\Exception;

use IDP\Helper\Constants\MoIDPMessages;
class InvalidPhoneException extends \Exception
{
    public function __construct($z6)
    {
        $aP = MoIDPMessages::showMessage("\x45\122\122\117\x52\x5f\120\x48\x4f\116\x45\x5f\x46\x4f\x52\x4d\101\124", array("\x70\150\x6f\x6e\145" => $z6));
        $cT = 112;
        parent::__construct($aP, $cT, NULL);
    }
    public function __toString()
    {
        return __CLASS__ . "\x3a\40\133{$this->code}\x5d\x3a\x20{$this->message}\12";
    }
}
