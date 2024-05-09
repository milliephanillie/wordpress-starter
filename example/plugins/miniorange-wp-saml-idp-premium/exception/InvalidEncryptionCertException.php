<?php


namespace IDP\Exception;

use IDP\Helper\Constants\MoIDPMessages;
class InvalidEncryptionCertException extends \Exception
{
    public function __construct()
    {
        $aP = MoIDPMessages::showMessage("\111\x4e\x56\x41\114\111\104\137\105\x4e\103\122\131\x50\x54\x5f\103\105\x52\124");
        $cT = 108;
        parent::__construct($aP, $cT, NULL);
    }
    public function __toString()
    {
        return __CLASS__ . "\x3a\x20\x5b{$this->code}\x5d\x3a\40{$this->message}\xa";
    }
}
