<?php


namespace IDP\Helper\SAML2;

use IDP\Helper\Utilities\SAMLUtilities;
use IDP\Helper\Constants\MoIDPConstants;
use IDP\Helper\Factory\RequestHandlerFactory;
use IDP\Exception\InvalidRequestInstantException;
use IDP\Exception\InvalidRequestVersionException;
use IDP\Exception\MissingIssuerValueException;
class AuthnRequest implements RequestHandlerFactory
{
    private $xml;
    private $nameIdPolicy;
    private $forceAuthn;
    private $isPassive;
    private $RequesterID = array();
    private $assertionConsumerServiceURL;
    private $protocolBinding;
    private $requestedAuthnContext;
    private $namespaceURI;
    private $destination;
    private $issuer;
    private $version;
    private $issueInstant;
    private $requestID;
    private $requestType = MoIDPConstants::AUTHN_REQUEST;
    public function __construct(\DOMElement $Wp = null)
    {
        $this->nameIdPolicy = array();
        $this->forceAuthn = false;
        $this->isPassive = false;
        if (!($Wp === null)) {
            goto Ti;
        }
        return;
        Ti:
        $this->xml = $Wp;
        $this->forceAuthn = SAMLUtilities::parseBoolean($Wp, "\106\157\162\x63\145\x41\165\164\150\156", false);
        $this->isPassive = SAMLUtilities::parseBoolean($Wp, "\x49\x73\x50\141\163\163\x69\166\145", false);
        if (!$Wp->hasAttribute("\x41\x73\163\145\162\164\x69\x6f\156\103\157\156\x73\165\155\145\x72\123\x65\162\166\x69\x63\x65\125\x52\114")) {
            goto ad;
        }
        $this->assertionConsumerServiceURL = $Wp->getAttribute("\101\x73\163\145\162\164\x69\x6f\156\103\157\156\163\165\x6d\x65\x72\x53\x65\x72\x76\151\x63\145\x55\122\114");
        ad:
        if (!$Wp->hasAttribute("\x50\x72\x6f\164\x6f\x63\157\x6c\x42\x69\x6e\x64\151\x6e\147")) {
            goto Lh;
        }
        $this->protocolBinding = $Wp->getAttribute("\x50\162\x6f\164\157\x63\157\154\102\151\x6e\144\151\x6e\147");
        Lh:
        if (!$Wp->hasAttribute("\101\x74\x74\x72\151\142\165\x74\145\x43\157\156\163\165\155\x69\x6e\x67\123\x65\x72\166\x69\143\145\111\156\144\145\170")) {
            goto Ug;
        }
        $this->attributeConsumingServiceIndex = (int) $Wp->getAttribute("\x41\164\x74\x72\x69\x62\x75\164\145\103\157\156\x73\x75\x6d\151\x6e\147\123\x65\x72\x76\x69\x63\x65\111\156\x64\145\x78");
        Ug:
        if (!$Wp->hasAttribute("\x41\x73\x73\145\x72\164\x69\x6f\x6e\x43\x6f\x6e\x73\x75\x6d\145\162\x53\x65\x72\166\151\x63\145\111\156\x64\x65\170")) {
            goto qt;
        }
        $this->assertionConsumerServiceIndex = (int) $Wp->getAttribute("\101\x73\x73\145\x72\164\x69\x6f\156\103\157\156\163\x75\x6d\x65\162\x53\145\162\x76\x69\x63\x65\x49\156\x64\x65\x78");
        qt:
        if (!$Wp->hasAttribute("\x44\x65\x73\164\151\x6e\141\164\x69\x6f\x6e")) {
            goto q3;
        }
        $this->destination = $Wp->getAttribute("\104\145\163\x74\151\156\141\164\x69\x6f\x6e");
        q3:
        if (!isset($Wp->namespaceURI)) {
            goto K2;
        }
        $this->namespaceURI = $Wp->namespaceURI;
        K2:
        if (!$Wp->hasAttribute("\126\x65\162\x73\151\x6f\156")) {
            goto VE;
        }
        $this->version = $Wp->getAttribute("\x56\145\x72\x73\x69\x6f\x6e");
        VE:
        if (!$Wp->hasAttribute("\111\x73\163\x75\x65\111\x6e\163\x74\141\x6e\164")) {
            goto WA;
        }
        $this->issueInstant = $Wp->getAttribute("\x49\x73\163\x75\x65\111\156\163\164\x61\x6e\164");
        WA:
        if (!$Wp->hasAttribute("\x49\x44")) {
            goto t7;
        }
        $this->requestID = $Wp->getAttribute("\111\104");
        t7:
        $this->checkAuthnRequestIssueInstant();
        $this->checkSAMLRequestVersion();
        $this->parseNameIdPolicy($Wp);
        $this->parseIssuer($Wp);
        $this->parseRequestedAuthnContext($Wp);
        $this->parseScoping($Wp);
    }
    protected function parseIssuer(\DOMElement $Wp)
    {
        $t3 = SAMLUtilities::xpQuery($Wp, "\56\x2f\163\x61\155\x6c\137\141\x73\x73\145\162\164\x69\x6f\156\72\111\x73\163\x75\145\162");
        if (!empty($t3)) {
            goto Qu;
        }
        throw new MissingIssuerValueException();
        Qu:
        $this->issuer = trim($t3[0]->textContent);
    }
    protected function parseNameIdPolicy(\DOMElement $Wp)
    {
        $n6 = SAMLUtilities::xpQuery($Wp, "\56\57\163\141\155\x6c\x5f\x70\162\157\x74\x6f\x63\x6f\x6c\x3a\116\141\155\x65\111\x44\x50\157\154\x69\x63\171");
        if (!empty($n6)) {
            goto FJ;
        }
        return;
        FJ:
        $n6 = $n6[0];
        if (!$n6->hasAttribute("\x46\157\x72\x6d\141\x74")) {
            goto tg;
        }
        $this->nameIdPolicy["\x46\157\x72\155\x61\x74"] = $n6->getAttribute("\x46\157\x72\x6d\x61\164");
        tg:
        if (!$n6->hasAttribute("\123\120\x4e\141\155\145\121\x75\141\x6c\151\146\151\x65\162")) {
            goto dA;
        }
        $this->nameIdPolicy["\x53\120\116\x61\155\145\x51\165\141\154\151\x66\151\145\162"] = $n6->getAttribute("\123\120\116\x61\155\x65\x51\165\141\x6c\x69\x66\x69\x65\x72");
        dA:
        if (!$n6->hasAttribute("\x41\154\x6c\x6f\167\103\x72\x65\x61\x74\145")) {
            goto g7;
        }
        $this->nameIdPolicy["\101\x6c\x6c\x6f\x77\103\162\x65\141\x74\145"] = SAMLUtilities::parseBoolean($n6, "\x41\154\x6c\x6f\x77\x43\x72\145\141\x74\145", false);
        g7:
    }
    protected function parseRequestedAuthnContext(\DOMElement $Wp)
    {
        $vG = SAMLUtilities::xpQuery($Wp, "\56\x2f\x73\x61\155\x6c\137\160\x72\157\164\x6f\x63\x6f\154\72\122\145\x71\x75\145\x73\x74\x65\144\101\x75\x74\x68\x6e\x43\x6f\x6e\164\145\x78\x74");
        if (!empty($vG)) {
            goto ey;
        }
        return;
        ey:
        $vG = $vG[0];
        $D9 = array("\101\x75\x74\150\x6e\x43\x6f\x6e\164\145\x78\164\x43\x6c\141\x73\x73\x52\x65\x66" => array(), "\x43\x6f\155\x70\141\162\x69\x73\x6f\156" => "\145\170\x61\143\164");
        $WS = SAMLUtilities::xpQuery($vG, "\x2e\57\163\141\155\154\x5f\x61\163\163\x65\162\164\x69\157\156\72\x41\x75\x74\150\x6e\103\x6f\x6e\x74\x65\x78\x74\103\x6c\141\163\x73\122\145\x66");
        foreach ($WS as $Uy) {
            $D9["\101\x75\x74\150\x6e\103\157\x6e\x74\145\x78\164\103\154\x61\x73\x73\x52\x65\x66"][] = trim($Uy->textContent);
            iZ:
        }
        ow:
        if (!$vG->hasAttribute("\103\x6f\155\160\x61\162\x69\x73\x6f\x6e")) {
            goto GI;
        }
        $D9["\103\x6f\155\x70\141\162\x69\163\x6f\x6e"] = $vG->getAttribute("\103\157\x6d\x70\141\162\x69\x73\x6f\156");
        GI:
        $this->requestedAuthnContext = $D9;
    }
    protected function parseScoping(\DOMElement $Wp)
    {
        $ii = SAMLUtilities::xpQuery($Wp, "\x2e\x2f\x73\141\x6d\x6c\x5f\x70\x72\x6f\164\157\x63\x6f\x6c\x3a\123\143\157\x70\x69\156\147");
        if (!empty($ii)) {
            goto bG;
        }
        return;
        bG:
        $ii = $ii[0];
        if (!$ii->hasAttribute("\120\x72\157\170\x79\x43\x6f\165\x6e\x74")) {
            goto qp;
        }
        $this->ProxyCount = (int) $ii->getAttribute("\120\162\x6f\x78\x79\x43\x6f\x75\x6e\164");
        qp:
        $TL = SAMLUtilities::xpQuery($ii, "\56\x2f\163\x61\x6d\x6c\x5f\160\162\157\164\157\x63\157\x6c\72\111\104\120\x4c\x69\163\x74\57\x73\141\155\154\x5f\160\x72\x6f\164\x6f\143\157\x6c\72\111\104\x50\105\x6e\164\162\x79");
        foreach ($TL as $gH) {
            if ($gH->hasAttribute("\x50\162\x6f\x76\x69\x64\x65\x72\x49\x44")) {
                goto Gr;
            }
            throw new \Exception("\103\x6f\x75\x6c\144\x20\x6e\x6f\x74\x20\x67\145\164\40\x50\x72\157\x76\x69\x64\145\x72\111\x44\x20\x66\162\157\x6d\x20\123\143\157\160\151\156\x67\x2f\111\x44\x50\x45\156\x74\162\171\x20\x65\x6c\x65\155\145\156\x74\40\x69\x6e\x20\101\165\x74\150\156\122\x65\x71\165\145\x73\x74\40\157\x62\x6a\145\143\x74");
            Gr:
            $this->IDPList[] = $gH->getAttribute("\120\x72\x6f\x76\x69\x64\145\162\111\104");
            Mn:
        }
        k7:
        $wX = SAMLUtilities::xpQuery($ii, "\56\x2f\x73\x61\x6d\154\137\160\x72\157\x74\157\x63\157\x6c\x3a\x52\x65\161\x75\x65\163\x74\145\162\x49\104");
        foreach ($wX as $Pe) {
            $this->RequesterID[] = trim($Pe->textContent);
            Pe:
        }
        yF:
    }
    public function checkAuthnRequestIssueInstant()
    {
        if (!(strtotime($this->issueInstant) >= time() + 60)) {
            goto bQ;
        }
        throw new InvalidRequestInstantException();
        bQ:
    }
    public function checkSAMLRequestVersion()
    {
        if (!($this->version !== "\62\x2e\x30")) {
            goto pI;
        }
        throw new InvalidRequestVersionException();
        pI:
    }
    public function generateRequest()
    {
        return;
    }
    public function __toString()
    {
        $FZ = "\133\40\101\x55\124\110\116\x20\122\105\121\x55\x45\123\x54\x20\120\x41\122\x41\x4d\123";
        $FZ .= "\54\x20\x4e\x61\155\145\163\160\x61\143\145\125\x52\111\40\x3d\40" . $this->namespaceURI;
        $FZ .= "\54\x20\120\162\157\164\157\143\x6f\154\102\x69\156\144\151\x6e\147\x20\x3d\40" . $this->protocolBinding;
        $FZ .= "\x2c\x20\111\x44\40\75\40" . $this->requestID;
        $FZ .= "\54\x20\111\x73\x73\165\145\162\x20\75\x20" . $this->issuer;
        $FZ .= "\54\x20\101\103\x53\40\125\122\114\x20\x3d\x20" . $this->assertionConsumerServiceURL;
        $FZ .= "\x2c\x20\104\x65\163\164\151\156\141\164\x69\157\156\40\75\40" . $this->destination;
        $FZ .= "\x2c\x20\x46\157\162\x6d\141\x74\40\75\x20" . implode("\54", $this->nameIdPolicy);
        $FZ .= "\54\x20\x41\x6c\154\x6f\167\40\x43\x72\145\x61\x74\x65\x20\x3d\40" . implode("\x2c", $this->nameIdPolicy);
        $FZ .= "\54\40\106\157\x72\x63\145\40\x41\165\x74\150\x6e\40\x3d\40" . $this->forceAuthn;
        $FZ .= "\x2c\x20\111\163\x73\165\x65\x20\111\x6e\163\164\x61\x6e\x74\x20\x3d\x20" . $this->issueInstant;
        $FZ .= "\54\40\126\x65\162\163\151\x6f\x6e\40\x3d\40" . $this->version;
        $FZ .= "\x2c\40\x52\145\161\x75\x65\x73\164\145\162\111\104\40\75\x20" . implode("\x2c", $this->RequesterID);
        $FZ .= "\x5d";
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
    public function getNameIdPolicy()
    {
        return $this->nameIdPolicy;
    }
    public function setNameIdPolicy($n6)
    {
        $this->nameIdPolicy = $n6;
        return $this;
    }
    public function getForceAuthn()
    {
        return $this->forceAuthn;
    }
    public function setForceAuthn($vu)
    {
        $this->forceAuthn = $vu;
        return $this;
    }
    public function getIsPassive()
    {
        return $this->isPassive;
    }
    public function setIsPassive($qN)
    {
        $this->isPassive = $qN;
        return $this;
    }
    public function getRequesterID()
    {
        return $this->RequesterID;
    }
    public function setRequesterID($py)
    {
        $this->RequesterID = $py;
        return $this;
    }
    public function getAssertionConsumerServiceURL()
    {
        return $this->assertionConsumerServiceURL;
    }
    public function setAssertionConsumerServiceURL($o7)
    {
        $this->assertionConsumerServiceURL = $o7;
        return $this;
    }
    public function getProtocolBinding()
    {
        return $this->protocolBinding;
    }
    public function setProtocolBinding($uq)
    {
        $this->protocolBinding = $uq;
        return $this;
    }
    public function getRequestedAuthnContext()
    {
        return $this->requestedAuthnContext;
    }
    public function setRequestedAuthnContext($vG)
    {
        $this->requestedAuthnContext = $vG;
        return $this;
    }
    public function getNamespaceURI()
    {
        return $this->namespaceURI;
    }
    public function setNamespaceURI($yo)
    {
        $this->namespaceURI = $yo;
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
    public function getIssuer()
    {
        return $this->issuer;
    }
    public function setIssuer($t3)
    {
        $this->issuer = $t3;
        return $this;
    }
    public function getVersion()
    {
        return $this->version;
    }
    public function setVersion($rX)
    {
        $this->version = $rX;
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
    public function getRequestID()
    {
        return $this->requestID;
    }
    public function setRequestID($VH)
    {
        $this->requestID = $VH;
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
