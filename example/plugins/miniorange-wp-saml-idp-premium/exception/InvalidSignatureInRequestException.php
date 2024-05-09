<?php


namespace IDP\Exception;

use IDP\Helper\Constants\MoIDPMessages;
class InvalidSignatureInRequestException extends \Exception
{
    public function __construct()
    {
        $aP = MoIDPMessages::showMessage("\x49\x4e\126\101\x4c\x49\x44\x5f\122\x45\x51\125\x45\x53\124\x5f\123\x49\x47\x4e\x41\124\x55\x52\105");
        $cT = 120;
        parent::__construct($aP, $cT, NULL);
    }
    public function __toString()
    {
        return __CLASS__ . "\72\x20\x5b{$this->code}\135\x3a\x20{$this->message}\12";
    }
}
