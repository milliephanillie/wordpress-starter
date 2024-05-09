<?php


namespace IDP\Exception;

use IDP\Helper\Constants\MoIDPMessages;
class InvalidNumberOfNameIDsException extends \Exception
{
    public function __construct()
    {
        $aP = MoIDPMessages::showMessage("\x49\116\126\101\x4c\x49\x44\137\116\117\137\x4f\x46\137\116\101\x4d\105\111\104\123");
        $cT = 124;
        parent::__construct($aP, $cT, NULL);
    }
    public function __toString()
    {
        return __CLASS__ . "\72\x20\133{$this->code}\x5d\x3a\x20{$this->message}\xa";
    }
}
