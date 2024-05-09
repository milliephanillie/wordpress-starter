<?php


namespace IDP\Exception;

use IDP\Helper\Constants\MoIDPMessages;
class NoServiceProviderConfiguredException extends \Exception
{
    public function __construct()
    {
        $aP = MoIDPMessages::showMessage("\116\117\137\123\120\137\103\117\x4e\106\x49\x47");
        $cT = 101;
        parent::__construct($aP, $cT, NULL);
    }
    public function __toString()
    {
        return __CLASS__ . "\x3a\x20\x5b{$this->code}\x5d\72\x20{$this->message}\xa";
    }
}
