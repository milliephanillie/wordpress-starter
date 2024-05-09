<?php


namespace IDP\Helper\SAML2;

use IDP\Helper\Utilities\MoIDPUtility;
use IDP\Helper\Utilities\SAMLUtilities;
class MetadataGenerator
{
    private $xml;
    private $issuer;
    private $samlLoginURL;
    private $wantAssertionSigned;
    private $x509Certificate;
    private $nameIdFormats;
    private $singleSignOnServiceURLs;
    private $singleLogoutServiceURLs;
    function __construct($t3, $y0, $LO, $eN, $fQ, $Ed, $wb)
    {
        $this->xml = new \DOMDocument("\x31\56\x30", "\x75\x74\x66\55\x38");
        $this->xml->preserveWhiteSpace = FALSE;
        $this->xml->formatOutput = TRUE;
        $this->issuer = $t3;
        $this->wantAssertionSigned = $y0;
        $this->x509Certificate = $LO;
        $this->nameIDFormats = array("\165\162\156\72\x6f\141\x73\x69\x73\72\156\x61\x6d\145\x73\72\164\143\x3a\x53\101\115\x4c\72\x31\x2e\x31\72\x6e\x61\x6d\145\x69\x64\55\146\157\162\x6d\141\x74\x3a\145\155\x61\151\154\101\144\144\162\x65\163\163", "\x75\x72\156\x3a\157\x61\x73\x69\163\x3a\156\x61\155\x65\163\72\164\143\72\x53\101\x4d\114\x3a\61\x2e\x31\72\x6e\x61\155\x65\151\144\x2d\x66\x6f\x72\155\141\x74\x3a\x75\x6e\x73\160\x65\143\151\146\x69\x65\x64");
        $this->singleSignOnServiceURLs = array("\165\x72\x6e\72\157\141\163\151\x73\72\x6e\141\155\x65\x73\72\x74\x63\x3a\x53\x41\x4d\x4c\72\x32\56\60\x3a\x62\151\x6e\144\x69\156\147\x73\72\110\124\x54\x50\55\x50\117\123\x54" => $eN, "\x75\162\x6e\72\157\x61\x73\151\x73\x3a\156\141\155\145\163\x3a\x74\x63\72\123\x41\115\x4c\x3a\62\x2e\60\72\x62\x69\x6e\144\x69\x6e\147\x73\x3a\x48\x54\124\120\x2d\122\145\144\151\x72\x65\143\164" => $fQ);
        $this->singleLogoutServiceURLs = array("\165\162\x6e\72\x6f\141\163\x69\x73\x3a\156\141\155\145\163\72\164\143\x3a\x53\x41\115\114\72\x32\x2e\x30\x3a\x62\151\x6e\144\x69\x6e\x67\163\x3a\110\124\124\120\x2d\120\117\123\124" => $Ed, "\165\x72\156\x3a\157\141\x73\x69\x73\72\x6e\141\x6d\145\163\72\x74\x63\72\123\x41\115\114\x3a\62\x2e\x30\x3a\142\151\156\144\x69\x6e\x67\163\x3a\x48\x54\124\120\x2d\122\145\x64\151\162\x65\143\164" => $wb);
    }
    public function generateMetadata()
    {
        $T9 = $this->createEntityDescriptorElement();
        $this->xml->appendChild($T9);
        $j2 = $this->createIdpDescriptorElement();
        $T9->appendChild($j2);
        $UV = $this->createKeyDescriptorElement();
        $j2->appendChild($UV);
        $QY = $this->createSLOUrls();
        foreach ($QY as $hV) {
            $j2->appendChild($hV);
            YY:
        }
        Ty:
        $N5 = $this->createNameIdFormatElements();
        foreach ($N5 as $dH) {
            $j2->appendChild($dH);
            ME:
        }
        l4:
        $mc = $this->createSSOUrls();
        foreach ($mc as $wS) {
            $j2->appendChild($wS);
            wc:
        }
        Uu:
        $I1 = $this->createOrganizationElement();
        $J1 = $this->createContactPersonElement();
        $T9->appendChild($I1);
        $T9->appendChild($J1);
        $ok = $this->xml->saveXML();
        return $ok;
    }
    private function createEntityDescriptorElement()
    {
        $T9 = $this->xml->createElementNS("\165\x72\x6e\x3a\157\x61\x73\x69\163\72\156\141\x6d\x65\163\x3a\x74\143\72\123\x41\115\114\72\x32\56\x30\x3a\x6d\145\x74\141\144\141\x74\141", "\105\x6e\164\x69\x74\171\104\x65\x73\143\162\x69\160\x74\157\x72");
        $T9->setAttribute("\145\156\164\151\164\x79\x49\x44", $this->issuer);
        return $T9;
    }
    private function createIdpDescriptorElement()
    {
        $j2 = $this->xml->createElementNS("\x75\162\x6e\72\157\x61\163\x69\x73\x3a\x6e\x61\x6d\145\x73\72\x74\x63\72\x53\x41\x4d\x4c\72\62\x2e\x30\x3a\x6d\145\x74\x61\144\141\x74\x61", "\111\104\120\x53\x53\x4f\x44\x65\163\x63\162\151\x70\164\x6f\162");
        $j2->setAttribute("\127\141\x6e\x74\101\165\164\x68\x6e\x52\145\161\x75\x65\x73\164\x73\x53\x69\147\x6e\145\144", $this->wantAssertionSigned);
        $j2->setAttribute("\160\162\157\164\x6f\143\157\154\x53\165\x70\x70\157\x72\164\x45\x6e\x75\x6d\x65\162\141\164\151\157\x6e", "\x75\162\156\72\x6f\x61\163\151\x73\x3a\156\x61\155\x65\x73\x3a\x74\x63\72\123\101\115\x4c\72\62\x2e\x30\72\160\162\x6f\164\x6f\x63\157\x6c");
        return $j2;
    }
    private function createKeyDescriptorElement()
    {
        $UV = $this->xml->createElement("\113\145\171\x44\x65\163\143\162\x69\x70\x74\x6f\x72");
        $UV->setAttribute("\x75\163\x65", "\163\151\147\x6e\151\156\x67");
        $aR = $this->generateKeyInfo();
        $UV->appendChild($aR);
        return $UV;
    }
    private function generateKeyInfo()
    {
        $aR = $this->xml->createElementNS("\x68\164\x74\x70\x3a\57\x2f\167\167\x77\x2e\167\63\x2e\x6f\162\x67\57\x32\x30\x30\x30\x2f\60\x39\57\x78\155\x6c\144\x73\151\147\43", "\144\163\x3a\113\145\x79\111\x6e\146\157");
        $tK = $this->xml->createElementNS("\x68\164\164\160\x3a\57\57\167\x77\x77\x2e\167\x33\56\157\x72\x67\57\62\x30\x30\x30\57\60\71\57\170\x6d\x6c\x64\x73\x69\147\43", "\144\x73\72\x58\x35\60\71\x44\141\x74\141");
        $jl = SAMLUtilities::desanitize_certificate($this->x509Certificate);
        $we = $this->xml->createElementNS("\150\164\164\x70\72\57\x2f\x77\167\167\56\167\63\x2e\157\x72\147\x2f\62\x30\x30\x30\x2f\x30\71\x2f\x78\155\154\144\163\151\147\43", "\x64\x73\x3a\130\x35\x30\71\103\x65\x72\164\151\x66\x69\x63\x61\x74\145", $jl);
        $tK->appendChild($we);
        $aR->appendChild($tK);
        return $aR;
    }
    private function createNameIdFormatElements()
    {
        $N5 = array();
        foreach ($this->nameIDFormats as $e1) {
            array_push($N5, $this->xml->createElementNS("\x75\162\156\72\x6f\141\163\x69\163\72\156\141\155\x65\163\72\164\143\x3a\123\101\x4d\x4c\x3a\62\x2e\x30\x3a\155\x65\x74\x61\x64\141\164\x61", "\116\x61\155\x65\111\x44\x46\x6f\162\155\141\x74", $e1));
            Wh:
        }
        hM:
        return $N5;
    }
    private function createSSOUrls()
    {
        $mc = array();
        foreach ($this->singleSignOnServiceURLs as $PY => $mK) {
            $Ln = $this->xml->createElementNS("\165\x72\156\72\x6f\141\163\151\163\x3a\x6e\141\155\x65\x73\x3a\164\x63\x3a\x53\x41\x4d\114\x3a\x32\x2e\x30\x3a\x6d\x65\x74\x61\144\141\x74\141", "\123\x69\x6e\x67\154\x65\123\x69\x67\156\117\x6e\123\145\x72\166\x69\x63\x65");
            $Ln->setAttribute("\x42\x69\x6e\144\151\x6e\x67", $PY);
            $Ln->setAttribute("\114\x6f\x63\x61\164\x69\x6f\156", $mK);
            array_push($mc, $Ln);
            uV:
        }
        W5:
        return $mc;
    }
    private function createSLOUrls()
    {
        $QY = array();
        foreach ($this->singleLogoutServiceURLs as $PY => $mK) {
            $hV = $this->xml->createElementNS("\165\162\156\x3a\x6f\x61\163\x69\163\x3a\x6e\x61\155\x65\x73\72\x74\x63\x3a\123\x41\115\x4c\x3a\62\x2e\60\72\155\x65\164\141\x64\x61\x74\x61", "\123\151\156\147\154\145\x4c\x6f\x67\157\165\164\123\x65\162\x76\151\x63\x65");
            $hV->setAttribute("\102\x69\156\144\x69\x6e\147", $PY);
            $hV->setAttribute("\x4c\157\x63\x61\x74\x69\x6f\156", $mK);
            array_push($QY, $hV);
            EV:
        }
        xl:
        return $QY;
    }
    private function createRoleDescriptorElement()
    {
        $bV = $this->xml->createElement("\x52\157\154\x65\x44\x65\x73\x63\x72\x69\160\x74\157\x72");
        $bV->setAttributeNS("\150\164\164\160\x3a\57\x2f\167\167\167\56\167\x33\56\x6f\x72\x67\57\62\x30\60\x30\57\x78\155\x6c\x6e\x73\57", "\170\x6d\154\156\x73\72\x78\163\x69", "\x68\x74\x74\x70\72\x2f\x2f\167\167\x77\56\x77\x33\x2e\x6f\162\147\x2f\x32\x30\60\61\x2f\130\x4d\x4c\x53\143\150\145\155\141\55\x69\156\163\164\141\x6e\143\145");
        $bV->setAttributeNS("\150\x74\164\x70\x3a\x2f\57\x77\x77\x77\56\x77\63\x2e\x6f\x72\147\57\x32\60\60\x30\x2f\x78\x6d\x6c\x6e\x73\57", "\170\x6d\154\156\x73\x3a\x66\x65\144", "\x68\164\x74\x70\72\57\x2f\144\157\143\163\x2e\x6f\141\163\x69\x73\x2d\157\x70\x65\156\x2e\157\x72\x67\x2f\x77\163\146\145\144\x2f\x66\x65\144\145\162\141\164\x69\x6f\x6e\57\x32\60\60\67\60\x36");
        $bV->setAttribute("\123\145\x72\166\x69\x63\x65\x44\x69\163\160\x6c\141\171\x4e\x61\x6d\145", "\155\x69\x6e\x69\x4f\162\141\156\147\145\x20\x49\156\x63");
        $bV->setAttribute("\x78\x73\x69\x3a\164\171\160\145", "\x66\x65\x64\x3a\123\145\143\165\162\x69\164\171\x54\x6f\153\145\156\x53\x65\162\166\x69\x63\x65\x54\171\x70\145");
        $bV->setAttribute("\x70\162\x6f\x74\x6f\x63\x6f\x6c\x53\165\160\x70\x6f\162\x74\x45\156\x75\x6d\145\162\141\x74\x69\157\x6e", "\150\x74\x74\160\72\57\57\x64\x6f\143\163\56\x6f\141\x73\151\x73\55\x6f\160\x65\156\x2e\157\x72\147\57\x77\x73\x2d\x73\x78\57\167\x73\55\x74\162\x75\x73\x74\57\62\x30\x30\x35\x31\62\40\150\164\x74\x70\x3a\x2f\57\163\x63\x68\145\x6d\x61\163\x2e\170\155\154\163\157\141\160\56\x6f\162\x67\57\167\x73\x2f\62\60\x30\x35\57\x30\x32\x2f\x74\x72\x75\x73\164\x20\x68\x74\164\160\72\57\x2f\144\x6f\x63\163\56\157\x61\x73\151\163\x2d\x6f\160\x65\156\56\157\x72\147\57\x77\x73\x66\x65\144\x2f\x66\x65\x64\x65\162\x61\164\x69\x6f\x6e\57\62\x30\60\67\60\66");
        return $bV;
    }
    private function createTokenTypesElement()
    {
        $kF = $this->xml->createElement("\x66\145\144\x3a\x54\157\153\145\x6e\x54\171\160\x65\163\x4f\146\x66\x65\x72\145\x64");
        $tT = $this->xml->createElement("\x66\x65\x64\x3a\124\157\153\x65\156\124\x79\160\145");
        $tT->setAttribute("\x55\x72\151", "\x75\162\156\72\157\141\x73\151\163\x3a\156\141\155\145\163\x3a\x74\x63\x3a\x53\x41\115\x4c\72\61\x2e\60\72\141\x73\x73\145\162\x74\151\x6f\x6e");
        $kF->appendChild($tT);
        return $kF;
    }
    private function createPassiveRequestEndpoints()
    {
        $cX = $this->xml->createElement("\146\145\x64\72\120\141\x73\163\x69\x76\x65\122\x65\161\x75\x65\163\x74\x6f\162\105\x6e\144\x70\157\x69\156\164");
        $e2 = $this->xml->createElementNS("\150\164\164\x70\72\x2f\57\167\167\167\56\x77\63\56\x6f\162\147\x2f\62\x30\60\x35\57\x30\x38\57\141\144\144\162\145\163\x73\x69\x6e\147", "\x61\x64\x3a\105\x6e\x64\x70\x6f\x69\x6e\x74\122\x65\146\x65\162\145\156\x63\145");
        $e2->appendChild($this->xml->createElement("\101\x64\x64\162\x65\163\163", $this->singleSignOnServiceURLs["\165\162\156\x3a\157\141\163\151\x73\72\156\141\155\145\163\72\164\143\72\123\101\115\114\72\x32\x2e\x30\x3a\142\x69\156\x64\151\x6e\147\x73\x3a\x48\x54\x54\x50\55\x50\117\x53\124"]));
        $cX->appendChild($e2);
        return $cX;
    }
    private function createOrganizationElement()
    {
        $I1 = $this->xml->createElementNS("\x75\x72\x6e\x3a\157\141\x73\x69\x73\x3a\156\141\x6d\145\163\x3a\x74\143\72\123\x41\x4d\x4c\72\x32\56\60\x3a\x6d\145\164\x61\144\141\x74\141", "\155\x64\x3a\x4f\x72\147\141\x6e\151\172\x61\x74\x69\157\x6e");
        $Zp = $this->xml->createElementNS("\165\162\156\72\x6f\x61\163\151\x73\72\156\141\155\145\x73\x3a\x74\143\72\x53\101\115\114\72\62\x2e\x30\72\155\145\164\141\x64\141\x74\x61", "\x6d\144\72\117\162\x67\x61\156\151\172\141\164\151\157\x6e\116\141\x6d\x65", "\x6d\x69\x6e\x69\117\162\141\156\x67\x65");
        $Zp->setAttribute("\170\155\x6c\x3a\154\141\156\147", "\x65\x6e\55\125\x53");
        $n4 = $this->xml->createElementNS("\x75\x72\x6e\x3a\157\141\x73\x69\163\x3a\156\x61\155\145\x73\x3a\164\143\72\x53\101\115\114\x3a\x32\56\60\x3a\x6d\x65\164\141\144\141\164\x61", "\155\x64\72\x4f\162\147\x61\x6e\x69\172\141\x74\151\157\x6e\104\151\163\160\x6c\x61\x79\116\x61\155\145", "\x6d\x69\156\x69\117\162\x61\156\x67\145");
        $n4->setAttribute("\x78\155\154\x3a\154\141\x6e\x67", "\145\156\55\125\x53");
        $Bl = $this->xml->createElementNS("\165\x72\x6e\x3a\157\141\163\151\163\72\x6e\x61\155\x65\163\x3a\x74\x63\72\123\x41\x4d\114\x3a\x32\x2e\60\x3a\x6d\x65\x74\141\144\x61\164\x61", "\x6d\144\72\117\162\x67\141\x6e\151\x7a\x61\x74\151\157\156\x55\122\x4c", "\150\164\x74\x70\163\72\57\57\155\151\x6e\x69\157\x72\141\x6e\x67\x65\56\x63\x6f\155");
        $Bl->setAttribute("\x78\x6d\x6c\72\x6c\141\156\147", "\x65\156\55\x55\123");
        $I1->appendChild($Zp);
        $I1->appendChild($n4);
        $I1->appendChild($Bl);
        return $I1;
    }
    private function createContactPersonElement()
    {
        $cq = $this->xml->createElementNS("\165\162\156\72\157\141\163\x69\x73\x3a\156\141\155\145\x73\x3a\164\x63\x3a\123\101\115\114\72\62\x2e\60\72\x6d\145\164\141\x64\x61\x74\x61", "\x6d\x64\x3a\x43\157\x6e\x74\x61\143\x74\120\145\x72\x73\157\x6e");
        $cq->setAttribute("\x63\x6f\x6e\x74\141\x63\164\124\171\x70\145", "\164\145\x63\150\x6e\x69\x63\x61\154");
        $Zp = $this->xml->createElementNS("\x75\x72\x6e\72\157\141\x73\151\x73\72\156\141\155\145\x73\72\x74\143\x3a\x53\101\x4d\x4c\72\62\56\x30\72\x6d\145\x74\x61\144\141\164\x61", "\x6d\x64\x3a\x47\151\166\x65\x6e\116\x61\x6d\x65", "\155\151\156\151\117\162\x61\x6e\x67\x65");
        $FJ = $this->xml->createElementNS("\165\x72\156\x3a\157\141\163\x69\163\x3a\x6e\x61\x6d\145\163\72\x74\143\72\123\x41\x4d\x4c\x3a\x32\56\60\72\x6d\145\x74\141\x64\x61\x74\141", "\155\x64\72\123\165\162\116\x61\155\x65", "\123\165\160\160\157\x72\164");
        $q1 = $this->xml->createElementNS("\x75\162\156\x3a\x6f\141\163\x69\163\x3a\x6e\x61\x6d\x65\x73\72\164\143\72\x53\x41\x4d\x4c\x3a\62\x2e\x30\72\x6d\145\164\x61\144\141\164\141", "\155\144\72\x45\155\x61\x69\x6c\x41\144\x64\x72\x65\163\x73", "\x69\156\146\157\100\x78\145\x63\x75\x72\151\146\x79\x2e\143\157\155");
        $cq->appendChild($Zp);
        $cq->appendChild($FJ);
        $cq->appendChild($q1);
        return $cq;
    }
}
