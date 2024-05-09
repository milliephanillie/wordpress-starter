<?php


namespace IDP\Exception;

use IDP\Helper\Constants\MoIDPMessages;
class IssuerValueAlreadyInUseException extends \Exception
{
    public function __construct($Lm)
    {
        $aP = MoIDPMessages::showMessage("\111\x53\123\125\x45\x52\137\x45\x58\x49\123\124\x53", array("\156\x61\x6d\x65" => $Lm->mo_idp_sp_name));
        $cT = 106;
        parent::__construct($aP, $cT, NULL);
    }
    public function __toString()
    {
        return __CLASS__ . "\72\40\x5b{$this->code}\x5d\72\40{$this->message}\12";
    }
}
