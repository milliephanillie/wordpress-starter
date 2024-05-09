<?php


namespace IDP\Exception;

class JSErrorException extends \Exception
{
    public function __construct($aP)
    {
        $aP = $aP;
        $cT = 103;
        parent::__construct($aP, $cT, NULL);
    }
    public function __toString()
    {
        return __CLASS__ . "\72\40\133{$this->code}\135\x3a\40{$this->message}\12";
    }
}
