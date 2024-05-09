<?php


namespace IDP\Exception;

use IDP\Helper\Constants\MoIDPMessages;
class PasswordResetFailedException extends \Exception
{
    public function __construct()
    {
        $aP = MoIDPMessages::showMessage("\105\122\122\117\x52\x5f\117\103\103\x55\122\x52\105\104");
        $cT = 116;
        parent::__construct($aP, $cT, NULL);
    }
    public function __toString()
    {
        return __CLASS__ . "\72\x20\133{$this->code}\x5d\72\40{$this->message}\12";
    }
}
