<?php


namespace IDP\Exception;

use IDP\Helper\Constants\MoIDPMessages;
class InvalidMetaDataUrlException extends \Exception
{
    public function __construct()
    {
        $aP = MoIDPMessages::showMessage("\x49\116\x56\x41\x4c\111\104\137\x55\x52\114");
        $cT = 130;
        parent::__construct($aP, $cT, NULL);
    }
    public function __toString()
    {
        return __CLASS__ . "\72\x20\133{$this->code}\x5d\x3a\x20{$this->message}\12";
    }
}
