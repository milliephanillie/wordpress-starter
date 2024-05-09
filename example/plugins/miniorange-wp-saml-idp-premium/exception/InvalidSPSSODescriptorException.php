<?php


namespace IDP\Exception;

use IDP\Helper\Constants\MoIDPMessages;
class InvalidSPSSODescriptorException extends \Exception
{
    public function __construct($aP)
    {
        $aP = MoIDPMessages::showMessage($aP);
        $cT = 131;
        parent::__construct($aP, $cT, NULL);
    }
    public function __toString()
    {
        return __CLASS__ . "\x3a\x20\x5b{$this->code}\x5d\x3a\x20{$this->message}\xa";
    }
}
