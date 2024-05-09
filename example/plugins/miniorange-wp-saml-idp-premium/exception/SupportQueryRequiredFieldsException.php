<?php


namespace IDP\Exception;

use IDP\Helper\Constants\MoIDPMessages;
class SupportQueryRequiredFieldsException extends \Exception
{
    public function __construct()
    {
        $aP = MoIDPMessages::showMessage("\122\105\x51\125\111\x52\105\104\x5f\121\x55\105\x52\131\137\x46\x49\105\x4c\104\x53");
        $cT = 109;
        parent::__construct($aP, $cT, NULL);
    }
    public function __toString()
    {
        return __CLASS__ . "\x3a\40\x5b{$this->code}\x5d\x3a\40{$this->message}\xa";
    }
}
