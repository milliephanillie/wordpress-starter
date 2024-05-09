<?php


namespace IDP\Exception;

use IDP\Helper\Constants\MoIDPMessages;
class SPNameAlreadyInUseException extends \Exception
{
    public function __construct($Lm)
    {
        $aP = MoIDPMessages::showMessage("\x53\x50\137\105\130\x49\123\124\123");
        $cT = 107;
        parent::__construct($aP, $cT, NULL);
    }
    public function __toString()
    {
        return __CLASS__ . "\72\40\x5b{$this->code}\135\72\x20{$this->message}\xa";
    }
}
