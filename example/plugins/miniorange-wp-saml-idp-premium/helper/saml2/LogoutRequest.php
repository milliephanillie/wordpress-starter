<?php


namespace IDP\Helper\SAML2;

use IDP\Helper\Constants\MoIDPConstants;
use IDP\Helper\Utilities\MoIDPUtility;
use IDP\Helper\Utilities\SAMLUtilities;
use IDP\Helper\Factory\RequestHandlerFactory;
use IDP\Exception\InvalidRequestVersionException;
use IDP\Exception\MissingNameIdException;
use IDP\Exception\InvalidNumberOfNameIDsException;
use IDP\Exception\MissingIDException;
class LogoutRequest implements RequestHandlerFactory
{
    private $xml;
    private $tagName;
    private $id;
    private $issuer;
    private $destination;
    private $issueInstant;
    private $certificates;
    private $validators;
    private $notOnOrAfter;
    private $encryptedNameId;
    private $nameId;
    private $sessionIndexes;
    private $requestType = MoIDPConstants::LOGOUT_REQUEST;
    public function __construct(\DOMElement $Wp = NULL)
    {
        $this->xml = new \DOMDocument("\x31\56\60", "\165\164\x66\55\x38");
        if (!($Wp === NULL)) {
            goto OH;
        }
        return;
        OH:
        $this->xml = $Wp;
        $this->tagName = "\x4c\x6f\147\157\165\164\x52\x65\x71\165\145\x73\x74";
        $this->id = $this->generateUniqueID(40);
        $this->issueInstant = time();
        $this->certificates = array();
        $this->validators = array();
        $this->issueInstant = SAMLUtilities::xsDateTimeToTimestamp($Wp->getAttribute("\x49\163\x73\x75\x65\111\x6e\163\x74\x61\156\x74"));
        $this->parseID($Wp);
        $this->checkSAMLVersion($Wp);
        if (!$Wp->hasAttribute("\104\x65\163\164\x69\x6e\x61\164\x69\157\x6e")) {
            goto bn;
        }
        $this->destination = $Wp->getAttribute("\104\x65\163\x74\x69\156\x61\164\x69\x6f\156");
        bn:
        $this->parseIssuer($Wp);
        $this->parseAndValidateSignature($Wp);
        if (!$Wp->hasAttribute("\116\157\164\x4f\x6e\117\162\x41\146\x74\145\162")) {
            goto Wi;
        }
        $this->notOnOrAfter = SAMLUtilities::xsDateTimeToTimestamp($Wp->getAttribute("\116\x6f\164\x4f\156\117\162\101\146\164\x65\162"));
        Wi:
        $this->parseNameId($Wp);
        $this->parseSessionIndexes($Wp);
    }
    public function generateRequest()
    {
        $DB = $this->createSAMLLogoutRequest();
        $this->xml->appendChild($DB);
        $t3 = $this->buildIssuer();
        $DB->appendChild($t3);
        $iD = $this->buildNameId();
        $DB->appendChild($iD);
        $B6 = $this->buildSessionIndex();
        $DB->appendChild($B6);
        $KN = $this->xml->saveXML();
        return $KN;
    }
    protected function createSAMLLogoutRequest()
    {
        $DB = $this->xml->createElementNS("\x75\x72\x6e\x3a\157\141\163\151\163\72\x6e\141\155\x65\163\72\x74\x63\72\x53\x41\x4d\114\x3a\62\56\x30\x3a\160\x72\x6f\x74\157\143\157\154", "\163\x61\155\154\x70\72\x4c\157\x67\157\165\164\122\x65\161\x75\x65\163\x74");
        $DB->setAttribute("\x49\104", $this->generateUniqueID(40));
        $DB->setAttribute("\x56\x65\162\163\x69\x6f\x6e", "\62\56\60");
        $DB->setAttribute("\x49\x73\x73\x75\x65\x49\156\163\x74\141\156\x74", str_replace("\53\60\60\72\x30\x30", "\x5a", gmdate("\143", time())));
        $DB->setAttribute("\x44\x65\163\x74\x69\156\141\x74\151\157\x6e", $this->destination);
        return $DB;
    }
    protected function buildIssuer()
    {
        return $this->xml->createElementNS("\165\x72\x6e\x3a\157\141\x73\151\163\x3a\x6e\141\x6d\145\x73\x3a\x74\x63\72\x53\x41\115\x4c\72\62\x2e\x30\x3a\141\x73\x73\145\162\x74\151\x6f\x6e", "\163\141\x6d\154\72\111\x73\x73\165\x65\x72", $this->issuer);
    }
    protected function buildNameId()
    {
        return $this->xml->createElementNS("\165\x72\156\72\x6f\141\x73\x69\x73\72\x6e\141\x6d\x65\x73\x3a\164\143\72\123\x41\x4d\114\x3a\x32\x2e\x30\x3a\141\x73\163\x65\162\x74\x69\157\x6e", "\163\141\x6d\154\72\116\141\x6d\145\111\x44", $this->nameId);
    }
    protected function buildSessionIndex()
    {
        return $this->xml->createElement("\163\x61\155\x6c\x70\72\x53\145\x73\x73\151\x6f\x6e\111\x6e\x64\145\x78", is_array($this->sessionIndexes) ? $this->sessionIndexes[0] : $this->sessionIndexes);
    }
    protected function parseID($Wp)
    {
        if ($Wp->hasAttribute("\x49\104")) {
            goto Ah;
        }
        throw new MissingIDException();
        Ah:
        $this->id = $Wp->getAttribute("\x49\104");
    }
    protected function checkSAMLVersion($Wp)
    {
        if (!($Wp->getAttribute("\126\145\x72\163\151\157\x6e") !== "\x32\56\x30")) {
            goto wm;
        }
        throw InvalidRequestVersionException();
        wm:
    }
    protected function parseIssuer($Wp)
    {
        $t3 = SAMLUtilities::xpQuery($Wp, "\x2e\x2f\x73\x61\155\x6c\x5f\x61\x73\x73\145\x72\x74\151\x6f\156\x3a\x49\163\163\165\145\162");
        if (empty($t3)) {
            goto AD;
        }
        $this->issuer = trim($t3[0]->textContent);
        AD:
    }
    protected function parseSessionIndexes($Wp)
    {
        $this->sessionIndexes = array();
        $Ip = SAMLUtilities::xpQuery($Wp, "\56\57\163\141\x6d\154\x5f\x70\162\157\x74\x6f\143\x6f\154\72\x53\x65\163\x73\151\x6f\156\111\156\144\x65\x78");
        foreach ($Ip as $B6) {
            $this->sessionIndexes[] = trim($B6->textContent);
            cj:
        }
        Go:
    }
    protected function parseAndValidateSignature($Wp)
    {
        try {
            $jq = SAMLUtilities::validateElement($Wp);
            if (!($jq !== FALSE)) {
                goto OI;
            }
            $this->certificates = $jq["\103\x65\162\x74\x69\146\151\x63\x61\x74\145\x73"];
            $this->validators[] = array("\106\165\156\x63\164\151\157\156" => array("\123\x41\x4d\x4c\x55\164\x69\x6c\x69\164\x69\145\163", "\166\141\154\x69\144\x61\164\145\x53\x69\x67\156\141\x74\x75\162\145"), "\x44\x61\x74\x61" => $jq);
            OI:
        } catch (Exception $zU) {
        }
    }
    protected function parseNameId($Wp)
    {
        $iD = SAMLUtilities::xpQuery($Wp, "\x2e\x2f\163\x61\x6d\154\137\141\x73\163\145\162\164\x69\x6f\156\72\x4e\x61\155\145\111\104\x20\x7c\x20\x2e\57\x73\x61\x6d\154\x5f\141\x73\x73\145\x72\x74\151\157\156\x3a\x45\156\143\x72\171\x70\x74\145\144\111\x44\x2f\170\145\x6e\x63\x3a\105\156\143\162\171\160\x74\x65\144\104\141\x74\141");
        if (empty($iD)) {
            goto oM;
        }
        if (count($iD) > 1) {
            goto Vr;
        }
        goto lF;
        oM:
        throw new MissingNameIdException();
        goto lF;
        Vr:
        throw new InvalidNumberOfNameIDsException();
        lF:
        $iD = $iD[0];
        if ($iD->localName === "\x45\x6e\x63\162\171\160\164\145\144\104\141\164\x61") {
            goto mG;
        }
        $this->nameId = SAMLUtilities::parseNameId($iD);
        goto US;
        mG:
        $this->encryptedNameId = $iD;
        US:
    }
    function generateUniqueID($B0)
    {
        return MoIDPUtility::generateRandomAlphanumericValue($B0);
    }
    public function __toString()
    {
        $FZ = "\114\x4f\107\x4f\x55\x54\40\122\x45\x51\x55\x45\x53\124\x20\120\x41\122\x41\115\x53\40\x5b";
        $FZ .= "\124\x61\x67\x4e\141\x6d\x65\x20\75\40" . $this->tagName;
        $FZ .= "\x2c\40\166\x61\x6c\151\x64\x61\x74\x6f\x72\163\x20\75\x20\x20" . implode("\54", $this->validators);
        $FZ .= "\x2c\40\111\x44\40\x3d\40" . $this->id;
        $FZ .= "\x2c\40\111\163\163\x75\x65\162\x20\x3d\40" . $this->issuer;
        $FZ .= "\54\x20\116\x6f\164\40\117\x6e\x20\x4f\x72\40\101\x66\164\x65\162\x20\x3d\40" . $this->notOnOrAfter;
        $FZ .= "\x2c\x20\104\145\163\164\x69\x6e\x61\164\x69\x6f\x6e\x20\75\x20" . $this->destination;
        $FZ .= "\x2c\x20\105\156\143\x72\x79\160\x74\x65\144\x20\116\141\155\145\x49\104\x20\75\x20" . $this->encryptedNameId;
        $FZ .= "\x2c\x20\x49\163\163\x75\145\x20\111\x6e\163\x74\141\x6e\x74\x20\x3d\x20" . $this->issueInstant;
        $FZ .= "\54\x20\123\x65\163\x73\x69\157\x6e\40\111\156\x64\145\x78\145\163\40\75\x20" . implode("\x2c", $this->sessionIndexes);
        $FZ .= "\135";
        return $FZ;
    }
    public function getXml()
    {
        return $this->xml;
    }
    public function setXml($Wp)
    {
        $this->xml = $Wp;
        return $this;
    }
    public function getTagName()
    {
        return $this->tagName;
    }
    public function setTagName($zC)
    {
        $this->tagName = $zC;
        return $this;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($tW)
    {
        $this->id = $tW;
        return $this;
    }
    public function getIssuer()
    {
        return $this->issuer;
    }
    public function setIssuer($t3)
    {
        $this->issuer = $t3;
        return $this;
    }
    public function getDestination()
    {
        return $this->destination;
    }
    public function setDestination($tY)
    {
        $this->destination = $tY;
        return $this;
    }
    public function getIssueInstant()
    {
        return $this->issueInstant;
    }
    public function setIssueInstant($h6)
    {
        $this->issueInstant = $h6;
        return $this;
    }
    public function getCertificates()
    {
        return $this->certificates;
    }
    public function setCertificates($JX)
    {
        $this->certificates = $JX;
        return $this;
    }
    public function getValidators()
    {
        return $this->validators;
    }
    public function setValidators($aN)
    {
        $this->validators = $aN;
        return $this;
    }
    public function getNotOnOrAfter()
    {
        return $this->notOnOrAfter;
    }
    public function setNotOnOrAfter($Lg)
    {
        $this->notOnOrAfter = $Lg;
        return $this;
    }
    public function getEncryptedNameId()
    {
        return $this->encryptedNameId;
    }
    public function setEncryptedNameId($Jt)
    {
        $this->encryptedNameId = $Jt;
        return $this;
    }
    public function getNameId()
    {
        return $this->nameId;
    }
    public function setNameId($iD)
    {
        $this->nameId = $iD;
        return $this;
    }
    public function getSessionIndexes()
    {
        return $this->sessionIndexes;
    }
    public function setSessionIndexes($Ip)
    {
        $this->sessionIndexes = $Ip;
        return $this;
    }
    public function getRequestType()
    {
        return $this->requestType;
    }
    public function setRequestType($Ch)
    {
        $this->requestType = $Ch;
        return $this;
    }
}
