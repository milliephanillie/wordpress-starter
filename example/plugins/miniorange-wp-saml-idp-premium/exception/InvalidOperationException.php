<?php


namespace IDP\Exception;

use IDP\Helper\Constants\MoIDPMessages;
class InvalidOperationException extends \Exception
{
    public function __construct()
    {
        $aP = MoIDPMessages::showMessage("\111\x4e\x56\x41\x4c\111\x44\x5f\x4f\x50");
        $cT = 105;
        parent::__construct($aP, $cT, NULL);
    }
    public function __toString()
    {
        return __CLASS__ . "\72\40\133{$this->code}\x5d\72\40{$this->message}\xa";
    }
}
