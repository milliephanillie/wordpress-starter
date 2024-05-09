<?php


namespace IDP\Helper\SAML2;

use IDP\Helper\Utilities\MoIDPUtility;
use IDP\Helper\Utilities\SAMLUtilities;
use IDP\Exception\InvalidSPSSODescriptorException;
class MetadataReader
{
    private $identityProviders;
    private $serviceProviders;
    public function __construct(\DOMNode $Wp = NULL)
    {
        $this->identityProviders = array();
        $this->serviceProviders = array();
        $vy = SAMLUtilities::xpQuery($Wp, "\56\57\x73\x61\x6d\x6c\x5f\155\x65\x74\x61\144\x61\164\141\72\x45\156\164\151\164\x79\x44\145\163\x63\x72\x69\160\x74\157\x72");
        foreach ($vy as $V5) {
            $K9 = SAMLUtilities::xpQuery($V5, "\x2e\57\x73\x61\155\x6c\x5f\155\145\x74\141\144\141\164\x61\72\123\120\x53\123\117\x44\x65\x73\x63\162\151\x70\164\x6f\162");
            if (!(isset($K9) && !empty($K9))) {
                goto a1;
            }
            array_push($this->serviceProviders, new ServiceProviders($V5));
            a1:
            gZ:
        }
        zG:
    }
    public function getIdentityProviders()
    {
        return $this->identityProviders;
    }
    public function getServiceProviders()
    {
        return $this->serviceProviders;
    }
}
class ServiceProviders
{
    public $spName;
    public $nameID;
    public $entityID;
    public $acsUrl;
    public $signedRequest;
    public $assertionSigned;
    public $logoutDetails;
    public $sloBindingType;
    public $signingCertificate;
    public $encryptionCertificate;
    public function __construct(\DOMElement $Wp = NULL)
    {
        $this->spName = '';
        $this->sloBindingType = '';
        $this->loginDetails = array();
        $this->logoutDetails = array();
        $this->signingCertificate = array();
        $this->encryptionCertificate = array();
        $this->nameID = "\165\162\x6e\x3a\157\x61\163\x69\x73\x3a\x6e\141\155\145\x73\x3a\x74\143\72\123\101\115\114\72\x31\x2e\x31\72\x6e\141\x6d\145\151\144\x2d\x66\x6f\162\x6d\141\x74\72\x65\155\x61\x69\x6c\101\x64\x64\x72\145\x73\x73";
        if (!$Wp->hasAttribute("\x65\156\x74\151\164\x79\x49\x44")) {
            goto G4;
        }
        $this->entityID = $Wp->getAttribute("\x65\156\164\x69\164\171\111\104");
        G4:
        $K9 = SAMLUtilities::xpQuery($Wp, "\x2e\x2f\163\141\155\x6c\x5f\155\145\x74\141\144\141\164\x61\72\123\x50\123\123\x4f\104\x65\163\x63\162\x69\160\164\157\x72");
        if (count($K9) > 1) {
            goto u6;
        }
        if (empty($K9)) {
            goto k5;
        }
        goto OD;
        u6:
        throw new InvalidSPSSODescriptorException("\115\x4f\x52\105\137\123\x50");
        goto OD;
        k5:
        throw new InvalidSPSSODescriptorException("\x4d\x49\123\x53\x49\116\x47\137\123\120");
        OD:
        if (!$K9[0]->hasAttribute("\x41\x75\x74\x68\156\122\x65\x71\x75\145\163\x74\x73\x53\x69\x67\x6e\145\144")) {
            goto cX;
        }
        $this->signedRequest = $K9[0]->getAttribute("\x41\165\164\x68\x6e\x52\x65\x71\165\x65\x73\x74\x73\x53\x69\x67\156\x65\x64");
        cX:
        if (!$K9[0]->hasAttribute("\x57\141\156\x74\101\x73\x73\x65\x72\164\x69\x6f\x6e\x73\x53\151\147\156\x65\144")) {
            goto vk;
        }
        $this->assertionSigned = $K9[0]->getAttribute("\x57\x61\156\164\x41\x73\163\x65\x72\x74\x69\x6f\x6e\163\123\x69\x67\x6e\x65\x64");
        vk:
        $Tl = $K9[0];
        $eV = SAMLUtilities::xpQuery($Wp, "\56\x2f\163\x61\x6d\x6c\x5f\155\x65\x74\141\144\x61\164\x61\72\105\x78\164\x65\156\163\151\x6f\x6e\x73");
        if (!$eV) {
            goto ej;
        }
        $this->parseInfo($Tl);
        ej:
        $this->parseSSOService($Tl);
        $this->parseSLOService($Tl);
        $this->parsex509Certificate($Tl);
        $this->parseAcsURL($Tl);
    }
    private function parseInfo($Wp)
    {
        $A8 = SAMLUtilities::xpQuery($Wp, "\x2e\x2f\x6d\x64\165\x69\72\x55\111\111\156\146\157\x2f\x6d\x64\165\x69\72\104\x69\163\160\154\x61\x79\x4e\141\155\145");
        foreach ($A8 as $Zp) {
            if (!($Zp->hasAttribute("\170\155\154\72\154\x61\x6e\x67") && $Zp->getAttribute("\170\155\x6c\72\x6c\x61\x6e\147") == "\145\156")) {
                goto It;
            }
            $this->spName = $Zp->textContent;
            It:
            Lb:
        }
        mZ:
    }
    private function parseSSOService($Wp)
    {
        $B2 = SAMLUtilities::xpQuery($Wp, "\56\x2f\x73\141\155\154\137\155\145\x74\141\144\x61\164\141\x3a\123\151\x6e\147\154\145\123\151\x67\156\117\156\x53\x65\x72\x76\151\x63\x65");
        foreach ($B2 as $kZ) {
            $PY = str_replace("\165\162\156\72\x6f\141\x73\x69\x73\72\156\141\x6d\145\x73\x3a\164\x63\72\x53\101\115\114\x3a\62\x2e\x30\x3a\x62\151\x6e\x64\x69\156\147\163\x3a", '', $kZ->getAttribute("\102\151\156\144\x69\x6e\x67"));
            $this->loginDetails = array_merge($this->loginDetails, array($PY => $kZ->getAttribute("\x4c\157\143\x61\164\151\x6f\156")));
            qb:
        }
        QE:
    }
    private function parseSLOService($Wp)
    {
        $QF = SAMLUtilities::xpQuery($Wp, "\x2e\57\x73\141\155\154\x5f\155\x65\164\x61\x64\141\x74\x61\72\123\x69\x6e\147\x6c\145\114\x6f\x67\157\165\x74\x53\145\162\x76\151\x63\145");
        if (!$QF) {
            goto HD;
        }
        $this->sloBindingType = str_replace("\165\x72\156\72\x6f\141\x73\x69\163\72\x6e\141\x6d\x65\x73\x3a\164\143\x3a\x53\x41\115\114\72\x32\56\x30\72\142\x69\156\144\151\156\x67\163\x3a", '', $QF[0]->getAttribute("\x42\151\156\x64\151\x6e\x67"));
        HD:
        foreach ($QF as $K0) {
            $PY = str_replace("\x75\x72\x6e\x3a\x6f\141\163\x69\163\72\x6e\x61\155\145\x73\x3a\x74\143\x3a\123\101\115\114\x3a\x32\x2e\60\72\142\x69\156\144\x69\x6e\x67\163\x3a", '', $K0->getAttribute("\102\151\x6e\144\x69\156\x67"));
            $this->logoutDetails = array_merge($this->logoutDetails, array($PY => $K0->getAttribute("\114\157\143\x61\164\x69\157\156")));
            H0:
        }
        ZX:
    }
    private function parsex509Certificate($Wp)
    {
        foreach (SAMLUtilities::xpQuery($Wp, "\56\57\163\141\x6d\154\137\155\145\164\141\x64\141\164\141\x3a\113\145\171\104\145\163\143\162\151\x70\x74\x6f\x72") as $JY) {
            if ($JY->hasAttribute("\x75\163\x65")) {
                goto Rc;
            }
            $this->parseSigningCertificate($JY);
            goto rG;
            Rc:
            if ($JY->getAttribute("\x75\163\x65") == "\x65\x6e\143\x72\171\160\164\x69\x6f\x6e") {
                goto Ys;
            }
            $this->parseSigningCertificate($JY);
            goto hb;
            Ys:
            $this->parseEncryptionCertificate($JY);
            hb:
            rG:
            qm:
        }
        b2:
    }
    private function parseSigningCertificate($Wp)
    {
        $P0 = SAMLUtilities::xpQuery($Wp, "\56\x2f\x64\x73\72\113\x65\x79\111\x6e\146\157\x2f\144\163\72\130\65\x30\71\x44\x61\164\141\57\x64\x73\x3a\130\x35\60\x39\x43\x65\x72\x74\x69\146\151\143\x61\164\145");
        $OD = trim($P0[0]->textContent);
        $OD = str_replace(array("\15", "\xa", "\x9", "\40"), '', $OD);
        if (empty($P0)) {
            goto ML;
        }
        array_push($this->signingCertificate, SAMLUtilities::sanitize_certificate($OD));
        ML:
    }
    private function parseEncryptionCertificate($Wp)
    {
        $P0 = SAMLUtilities::xpQuery($Wp, "\x2e\x2f\144\x73\72\113\145\171\111\156\146\x6f\57\x64\x73\72\130\x35\60\x39\x44\141\x74\141\57\144\163\x3a\x58\x35\60\x39\103\145\162\x74\151\146\151\x63\x61\164\x65");
        $OD = trim($P0[0]->textContent);
        $OD = str_replace(array("\15", "\xa", "\11", "\x20"), '', $OD);
        if (empty($P0)) {
            goto Ld;
        }
        array_push($this->encryptionCertificate, $OD);
        Ld:
    }
    private function parseAcsURL($Wp)
    {
        $S5 = SAMLUtilities::xpQuery($Wp, "\x2e\57\x73\141\x6d\154\137\x6d\145\x74\141\x64\141\x74\x61\72\101\x73\163\x65\162\x74\151\x6f\x6e\103\x6f\156\163\165\155\x65\162\123\x65\162\166\151\143\x65");
        if (!$S5[0]->hasAttribute("\x4c\157\143\x61\164\151\157\x6e")) {
            goto Ry;
        }
        $this->acsUrl = $S5[0]->getAttribute("\114\x6f\x63\141\164\x69\x6f\156");
        Ry:
    }
}
