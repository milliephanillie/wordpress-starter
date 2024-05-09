<?php


namespace IDP\Exception;

use IDP\Helper\Constants\MoIDPMessages;
class InvalidRequestVersionException extends \Exception
{
    public function __construct()
    {
        $aP = MoIDPMessages::showMessage("\x49\x4e\x56\x41\x4c\x49\104\x5f\x53\101\115\x4c\x5f\x56\x45\122\123\x49\117\x4e");
        $cT = 118;
        parent::__construct($aP, $cT, NULL);
    }
    public function __toString()
    {
        return __CLASS__ . "\72\x20\133{$this->code}\135\72\x20{$this->message}\12";
    }
}
