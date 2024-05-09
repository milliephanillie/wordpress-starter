<?php


namespace IDP\Exception;

use IDP\Helper\Constants\MoIDPMessages;
class OTPSendingFailedException extends \Exception
{
    public function __construct()
    {
        $aP = MoIDPMessages::showMessage("\x45\x52\x52\x4f\x52\x5f\123\105\x4e\104\x49\x4e\107\137\x4f\x54\120");
        $cT = 115;
        parent::__construct($aP, $cT, NULL);
    }
    public function __toString()
    {
        return __CLASS__ . "\x3a\40\x5b{$this->code}\135\x3a\40{$this->message}\12";
    }
}
