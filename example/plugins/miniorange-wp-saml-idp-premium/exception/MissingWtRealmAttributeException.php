<?php


namespace IDP\Exception;

use IDP\Helper\Constants\MoIDPMessages;
class MissingWtRealmAttributeException extends \Exception
{
    public function __construct()
    {
        $aP = MoIDPMessages::showMessage("\115\x49\123\123\111\x4e\x47\137\127\x54\122\105\x41\x4c\x4d\137\x41\x54\x54\122");
        $cT = 128;
        parent::__construct($aP, $cT, NULL);
    }
    public function __toString()
    {
        return __CLASS__ . "\x3a\x20\x5b{$this->code}\135\x3a\x20{$this->message}\12";
    }
}
