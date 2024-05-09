<?php


namespace IDP\Exception;

use IDP\Helper\Constants\MoIDPMessages;
class MissingIssuerValueException extends \Exception
{
    public function __construct()
    {
        $aP = MoIDPMessages::showMessage("\x4d\111\123\x53\x49\116\x47\x5f\111\x53\x53\x55\x45\x52\137\126\x41\x4c\125\x45");
        $cT = 123;
        parent::__construct($aP, $cT, NULL);
    }
    public function __toString()
    {
        return __CLASS__ . "\72\x20\133{$this->code}\x5d\x3a\40{$this->message}\xa";
    }
}
