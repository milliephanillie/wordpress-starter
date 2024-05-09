<?php


namespace IDP\Helper\SAML2;

use IDP\Helper\Factory\ResponseHandlerFactory;
use IDP\Helper\Utilities\MoIDPUtility;
class GenerateLogoutResponse implements ResponseHandlerFactory
{
    private $xml;
    private $id;
    private $version;
    private $destination;
    private $inResponseTo;
    private $issuer;
    private $status;
    public function __construct($sL, $t3, $tY)
    {
        $this->xml = new \DOMDocument("\x31\56\60", "\165\x74\x66\55\x38");
        $this->issuer = $t3;
        $this->destination = $tY;
        $this->inResponseTo = $sL;
    }
    public function generateResponse()
    {
        $DB = $this->createLogoutResponseElement();
        $this->xml->appendChild($DB);
        $t3 = $this->buildIssuer();
        $DB->appendChild($t3);
        $JB = $this->buildStatus();
        $DB->appendChild($JB);
        $j5 = $this->xml->saveXML();
        return $j5;
    }
    protected function createLogoutResponseElement()
    {
        $DB = $this->xml->createElementNS("\x75\x72\156\72\x6f\141\x73\x69\x73\72\156\x61\155\x65\163\x3a\x74\x63\x3a\x53\x41\115\x4c\72\x32\56\x30\72\x70\162\x6f\x74\x6f\x63\x6f\x6c", "\x73\x61\155\154\160\x3a\114\157\x67\157\165\164\x52\145\163\x70\x6f\156\x73\x65");
        $DB->setAttribute("\x49\104", $this->generateUniqueID(40));
        $DB->setAttribute("\x56\145\x72\163\x69\157\x6e", "\x32\x2e\x30");
        $DB->setAttribute("\x49\163\x73\165\x65\111\156\163\x74\141\156\x74", str_replace("\x2b\x30\x30\x3a\x30\60", "\132", gmdate("\x63", time())));
        $DB->setAttribute("\104\x65\x73\x74\151\156\141\164\x69\x6f\156", $this->destination);
        $DB->setAttribute("\111\156\x52\x65\x73\160\157\x6e\x73\x65\x54\x6f", $this->inResponseTo);
        return $DB;
    }
    protected function buildIssuer()
    {
        return $this->xml->createElementNS("\165\162\x6e\x3a\157\141\x73\151\x73\72\x6e\141\155\145\163\72\164\x63\72\123\x41\115\x4c\72\62\x2e\60\72\x61\x73\163\145\x72\164\151\157\156", "\x73\x61\x6d\154\x3a\x49\163\163\x75\x65\x72", $this->issuer);
    }
    protected function buildStatus()
    {
        $nK = $this->xml->createElementNS("\x75\162\x6e\72\x6f\141\163\151\163\x3a\x6e\x61\155\145\x73\x3a\x74\143\x3a\x53\101\x4d\x4c\72\62\x2e\60\x3a\160\x72\x6f\x74\x6f\143\x6f\154", "\163\x61\x6d\154\x70\72\x53\x74\x61\164\x75\163");
        $nK->appendChild($this->createStatusCode());
        return $nK;
    }
    protected function createStatusCode()
    {
        $Nr = $this->xml->createElementNS("\165\x72\156\x3a\157\141\163\x69\x73\72\x6e\141\155\145\163\72\164\x63\72\123\x41\x4d\x4c\72\x32\x2e\60\72\160\162\x6f\164\x6f\x63\x6f\154", "\x73\x61\x6d\x6c\x70\x3a\x53\x74\x61\164\x75\x73\x43\157\144\145");
        $Nr->setAttribute("\126\141\x6c\165\x65", "\x75\162\x6e\72\x6f\x61\163\x69\x73\x3a\156\x61\x6d\x65\163\72\x74\x63\x3a\123\x41\115\114\72\62\x2e\x30\x3a\163\164\141\x74\x75\163\x3a\123\165\143\x63\145\x73\x73");
        return $Nr;
    }
    function generateUniqueID($B0)
    {
        return MoIDPUtility::generateRandomAlphanumericValue($B0);
    }
}
