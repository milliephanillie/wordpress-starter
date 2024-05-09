<?php


namespace IDP\Exception;

use IDP\Helper\Constants\MoIDPMessages;
class RequiredFieldsException extends \Exception
{
    public function __construct()
    {
        $aP = MoIDPMessages::showMessage("\122\105\121\x55\111\x52\x45\x44\x5f\106\111\105\114\104\123");
        $cT = 104;
        parent::__construct($aP, $cT, NULL);
    }
    public function __toString()
    {
        return __CLASS__ . "\x3a\x20\133{$this->code}\x5d\72\x20{$this->message}\xa";
    }
}
