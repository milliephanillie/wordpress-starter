<?php


namespace IDP\Exception;

use IDP\Helper\Constants\MoIDPMessages;
class MissingWaAttributeException extends \Exception
{
    public function __construct()
    {
        $aP = MoIDPMessages::showMessage("\x4d\x49\x53\x53\111\116\x47\137\127\x41\137\101\x54\124\122");
        $cT = 127;
        parent::__construct($aP, $cT, NULL);
    }
    public function __toString()
    {
        return __CLASS__ . "\72\x20\x5b{$this->code}\135\72\40{$this->message}\12";
    }
}
