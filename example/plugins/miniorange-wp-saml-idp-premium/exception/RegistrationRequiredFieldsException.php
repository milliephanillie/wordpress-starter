<?php


namespace IDP\Exception;

use IDP\Helper\Constants\MoIDPMessages;
class RegistrationRequiredFieldsException extends \Exception
{
    public function __construct()
    {
        $aP = MoIDPMessages::showMessage("\122\105\x51\125\111\x52\x45\104\137\x52\x45\107\x49\x53\x54\x52\x41\124\111\117\x4e\x5f\x46\x49\x45\x4c\x44\x53");
        $cT = 111;
        parent::__construct($aP, $cT, NULL);
    }
    public function __toString()
    {
        return __CLASS__ . "\x3a\x20\x5b{$this->code}\135\72\40{$this->message}\xa";
    }
}
