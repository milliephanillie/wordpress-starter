<?php


namespace IDP\Exception;

use IDP\Helper\Constants\MoIDPMessages;
class InvalidRequestInstantException extends \Exception
{
    public function __construct()
    {
        $aP = MoIDPMessages::showMessage("\111\x4e\126\x41\114\111\104\137\x52\105\121\x55\105\x53\x54\137\x49\116\x53\124\101\x4e\x54");
        $cT = 117;
        parent::__construct($aP, $cT, NULL);
    }
    public function __toString()
    {
        return __CLASS__ . "\x3a\40\x5b{$this->code}\135\72\40{$this->message}\xa";
    }
}
