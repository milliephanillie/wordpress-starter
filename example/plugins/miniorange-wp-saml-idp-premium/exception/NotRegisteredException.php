<?php


namespace IDP\Exception;

use IDP\Helper\Constants\MoIDPMessages;
class NotRegisteredException extends \Exception
{
    public function __construct()
    {
        $aP = MoIDPMessages::showMessage("\x4e\117\x54\x5f\122\105\107\x5f\105\x52\x52\x4f\122");
        $cT = 102;
        parent::__construct($aP, $cT, NULL);
    }
    public function __toString()
    {
        return __CLASS__ . "\72\40\x5b{$this->code}\135\72\x20{$this->message}\12";
    }
}
