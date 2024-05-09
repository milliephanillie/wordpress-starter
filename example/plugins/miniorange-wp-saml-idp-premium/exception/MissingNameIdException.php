<?php


namespace IDP\Exception;

use IDP\Helper\Constants\MoIDPMessages;
class MissingNameIdException extends \Exception
{
    public function __construct()
    {
        $aP = MoIDPMessages::showMessage("\x4d\111\123\x53\111\x4e\x47\137\x4e\101\115\105\x49\104");
        $cT = 126;
        parent::__construct($aP, $cT, NULL);
    }
    public function __toString()
    {
        return __CLASS__ . "\x3a\x20\133{$this->code}\x5d\x3a\x20{$this->message}\xa";
    }
}
