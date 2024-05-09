<?php


namespace IDP\Exception;

use IDP\Helper\Constants\MoIDPMessages;
class PasswordStrengthException extends \Exception
{
    public function __construct()
    {
        $aP = MoIDPMessages::showMessage("\111\116\x56\101\x4c\111\104\x5f\x50\101\x53\x53\137\x53\124\122\105\116\x47\124\110");
        $cT = 110;
        parent::__construct($aP, $cT, NULL);
    }
    public function __toString()
    {
        return __CLASS__ . "\x3a\x20\133{$this->code}\x5d\x3a\40{$this->message}\12";
    }
}
