<?php


namespace IDP\Exception;

use IDP\Helper\Constants\MoIDPMessages;
class MissingIDException extends \Exception
{
    public function __construct()
    {
        $aP = MoIDPMessages::showMessage("\x4d\x49\123\123\111\116\x47\137\111\104\137\106\x52\117\x4d\137\122\105\x51\125\105\x53\124");
        $cT = 125;
        parent::__construct($aP, $cT, NULL);
    }
    public function __toString()
    {
        return __CLASS__ . "\72\40\x5b{$this->code}\135\x3a\40{$this->message}\xa";
    }
}
