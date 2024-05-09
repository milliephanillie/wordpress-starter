<?php


namespace IDP\Exception;

use IDP\Helper\Constants\MoIDPMessages;
class InvalidMetaDataFileException extends \Exception
{
    public function __construct($nV)
    {
        $aP = $nV;
        $cT = 129;
        parent::__construct($aP, $cT, NULL);
    }
    public function __toString()
    {
        return __CLASS__ . "\x3a\x20\x5b{$this->code}\x5d\72\x20{$this->message}\12";
    }
}
