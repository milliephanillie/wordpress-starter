<?php


namespace IDP\Exception;

use IDP\Helper\Constants\MoIDPMessages;
class InvalidServiceProviderException extends \Exception
{
    public function __construct()
    {
        $aP = MoIDPMessages::showMessage("\x49\x4e\126\101\114\111\x44\x5f\x53\120");
        $cT = 119;
        parent::__construct($aP, $cT, NULL);
    }
    public function __toString()
    {
        return __CLASS__ . "\x3a\40\x5b{$this->code}\x5d\x3a\x20{$this->message}\xa";
    }
}
