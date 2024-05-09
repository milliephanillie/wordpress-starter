<?php


namespace IDP\Helper\WSFED;

use IDP\Helper\Utilities\MoIDPUtility;
use RobRichards\XMLSecLibs\XMLSecurityKey;
use RobRichards\XMLSecLibs\XMLSecurityDsig;
use IDP\Exception\InvalidSSOUserException;
use IDP\Helper\Factory\ResponseHandlerFactory;
class GenerateWsFedResponse implements ResponseHandlerFactory
{
    private $xml;
    private $issuer;
    private $wtrealm;
    private $wa;
    private $wctx;
    private $subject;
    private $mo_idp_nameid_attr;
    private $mo_idp_nameid_format;
    private $currentUser;
    function __construct($S_, $G1, $pZ, $t3, $Lm, $LE, $km)
    {
        $this->xml = new \DOMDocument("\x31\56\60", "\165\164\146\x2d\70");
        $this->xml->preserveWhiteSpace = false;
        $this->xml->formatOutput = false;
        $this->wctx = $pZ;
        $this->issuer = $t3;
        $this->wtrealm = $S_;
        $this->sp_attr = $LE;
        $this->wa = $G1;
        $this->mo_idp_nameid_format = $Lm->mo_idp_nameid_format;
        $this->mo_idp_nameid_attr = $Lm->mo_idp_nameid_attr;
        $this->current_user = is_null($km) ? wp_get_current_user() : get_user_by("\x6c\x6f\x67\151\x6e", $km);
    }
    function generateResponse()
    {
        if (!MoIDPUtility::isBlank($this->current_user)) {
            goto ff;
        }
        throw new InvalidSSOUserException();
        ff:
        $ax = $this->getResponseParams();
        $DB = $this->createResponseElement($ax);
        $this->xml->appendChild($DB);
        $zJ = MoIDPUtility::getPrivateKey();
        $this->signNode($zJ, $DB->firstChild->nextSibling->nextSibling->firstChild, NULL, $ax);
        $XY = $this->xml->saveXML();
        return $XY;
    }
    function getResponseParams()
    {
        $ax = array();
        $Vs = time();
        $ax["\x49\163\x73\x75\145\x49\x6e\x73\x74\141\156\164"] = str_replace("\x2b\60\60\72\x30\60", "\132", gmdate("\x63", $Vs));
        $ax["\116\157\164\117\x6e\117\162\x41\x66\x74\145\x72"] = str_replace("\53\x30\x30\x3a\60\x30", "\x5a", gmdate("\x63", $Vs + 300));
        $ax["\x4e\157\x74\x42\x65\146\157\x72\x65"] = str_replace("\x2b\60\60\72\60\x30", "\x5a", gmdate("\x63", $Vs - 30));
        $ax["\101\165\x74\x68\156\x49\156\x73\x74\x61\x6e\x74"] = str_replace("\53\60\60\x3a\60\60", "\132", gmdate("\x63", $Vs - 120));
        $ax["\101\x73\163\145\162\164\x49\104"] = $this->generateUniqueID(40);
        $xR = MoIDPUtility::getPublicCert();
        $fF = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, array("\164\171\x70\145" => "\x70\x75\142\154\151\x63"));
        $fF->loadKey($xR, FALSE, TRUE);
        $ax["\x78\65\60\71"] = $fF->getX509Certificate();
        return $ax;
    }
    function generateUniqueID($B0)
    {
        return MoIDPUtility::generateRandomAlphanumericValue($B0);
    }
    function createResponseElement($ax)
    {
        $DB = $this->xml->createElementNS("\x68\164\x74\x70\72\57\x2f\x73\143\x68\145\155\x61\163\56\x78\x6d\154\163\x6f\x61\x70\56\157\x72\x67\x2f\167\x73\x2f\x32\x30\x30\x35\x2f\60\x32\57\x74\x72\165\x73\x74", "\164\x3a\122\x65\x71\x75\145\163\x74\x53\x65\x63\x75\162\x69\x74\x79\124\x6f\153\x65\x6e\x52\145\163\160\x6f\156\163\145");
        $Tr = $this->createResponseElementLifetime($ax);
        $DB->appendChild($Tr);
        $dY = $this->createResponseElementAppliesTo($ax);
        $DB->appendChild($dY);
        $TZ = $this->create_RequestedSecurityToken($ax);
        $DB->appendChild($TZ);
        $R6 = $this->create_TokenType();
        $DB->appendChild($R6);
        $lQ = $this->create_RequestType();
        $DB->appendChild($lQ);
        $it = $this->create_KeyType();
        $DB->appendChild($it);
        return $DB;
    }
    function create_RequestType()
    {
        $DB = $this->xml->createElement("\x74\72\124\x6f\153\145\x6e\x54\171\160\145", "\x75\x72\156\72\157\x61\x73\x69\x73\x3a\x6e\x61\155\x65\x73\72\164\x63\x3a\123\101\x4d\x4c\x3a\61\x2e\x30\x3a\x61\163\163\x65\162\x74\151\157\x6e");
        return $DB;
    }
    function create_KeyType()
    {
        $DB = $this->xml->createElement("\x74\72\x4b\145\171\124\x79\160\145", "\150\x74\164\x70\x3a\57\57\x73\x63\150\145\x6d\x61\x73\x2e\x78\x6d\154\x73\157\141\x70\x2e\157\x72\147\57\167\163\x2f\x32\x30\x30\65\x2f\60\65\x2f\151\x64\145\x6e\164\x69\x74\x79\57\116\x6f\x50\162\x6f\157\146\113\145\x79");
        return $DB;
    }
    function create_TokenType()
    {
        $DB = $this->xml->createElement("\x74\72\122\x65\x71\165\145\163\164\124\x79\x70\145", "\x68\x74\x74\160\72\57\57\x73\143\x68\145\155\x61\163\x2e\170\155\x6c\163\x6f\141\160\56\x6f\162\147\x2f\x77\163\x2f\62\60\60\x35\x2f\x30\x32\x2f\164\x72\165\163\x74\57\x49\x73\x73\x75\x65");
        return $DB;
    }
    function create_RequestedSecurityToken($ax)
    {
        $DB = $this->xml->createElement("\x74\x3a\122\x65\161\x75\x65\x73\x74\145\144\x53\145\143\165\x72\x69\164\171\x54\157\153\145\156");
        $Tr = $this->create_Assertion($ax);
        $DB->appendChild($Tr);
        return $DB;
    }
    function create_Assertion($ax)
    {
        $mL = $this->xml->createElementNS("\x75\x72\156\72\157\x61\163\151\163\72\x6e\x61\x6d\145\x73\x3a\x74\143\x3a\x53\101\115\x4c\x3a\61\56\x30\x3a\141\163\x73\x65\162\x74\x69\x6f\x6e", "\x73\141\155\x6c\72\x41\163\163\145\x72\164\151\x6f\x6e");
        $mL->setAttribute("\115\141\x6a\x6f\162\x56\145\x72\x73\151\x6f\x6e", "\61");
        $mL->setAttribute("\115\x69\x6e\157\162\126\x65\162\163\151\157\x6e", "\61");
        $mL->setAttribute("\x41\163\163\145\162\x74\151\157\156\x49\x44", $ax["\x41\163\x73\x65\162\x74\x49\104"]);
        $mL->setAttribute("\x49\x73\x73\x75\145\162", $this->issuer);
        $mL->setAttribute("\x49\x73\163\x75\145\111\x6e\x73\164\x61\156\164", $ax["\111\163\163\x75\145\x49\x6e\x73\164\141\x6e\x74"]);
        $Bm = $this->createSamlConditions($ax);
        $mL->appendChild($Bm);
        if (!(isset($this->sp_attr) && !empty($this->sp_attr))) {
            goto H6;
        }
        $gC = $this->createAttributeStatement($ax);
        $mL->appendChild($gC);
        H6:
        $rJ = $this->createAuthenticationStatement($ax);
        $mL->appendChild($rJ);
        return $mL;
    }
    function signNode($zJ, $jb, $AH, $ax)
    {
        $fF = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, array("\x74\x79\160\145" => "\x70\162\x69\x76\x61\x74\x65"));
        $fF->loadKey($zJ, FALSE);
        $PW = new XMLSecurityDSig();
        $PW->setCanonicalMethod(XMLSecurityDSig::EXC_C14N);
        $PW->addReferenceList(array($jb), XMLSecurityDSig::SHA256, array("\x68\x74\164\160\72\x2f\57\x77\167\167\x2e\x77\63\56\x6f\162\x67\x2f\x32\60\60\60\57\60\71\57\x78\x6d\154\x64\163\151\147\43\x65\156\x76\x65\154\157\x70\x65\144\x2d\x73\151\147\156\x61\x74\x75\x72\145", XMLSecurityDSig::EXC_C14N), array("\151\144\137\x6e\141\155\145" => "\101\x73\x73\x65\x72\x74\151\x6f\x6e\x49\x44", "\x6f\x76\145\162\167\162\151\x74\x65" => false));
        $PW->sign($fF);
        $PW->add509Cert($ax["\x78\65\60\71"]);
        $PW->insertSignature($jb, NULL);
    }
    function creatSignedInfo()
    {
        $DB = $this->xml->createElement("\x64\x73\72\x53\151\147\x6e\145\144");
        $Tr = $this->createCanonicalizationMethod();
        $DB->appendChild($Tr);
        return $DB;
    }
    function createCanonicalizationMethod()
    {
        $DB = $this->xml->createElement("\x64\x73\x3a\103\141\156\x6f\x6e\x69\x63\x61\154\151\x7a\x61\x74\151\x6f\156\x4d\x65\164\x68\157\x64");
        $DB->setAttribute("\101\154\147\157\x72\x69\164\x68\x6d", "\x68\164\164\160\72\x2f\x2f\167\x77\167\56\x77\63\56\x6f\x72\147\x2f\62\x30\60\61\57\61\x30\x2f\x78\x6d\154\x2d\145\170\143\x2d\x63\61\64\x6e\x23");
        return $DB;
    }
    function createAuthenticationStatement($ax)
    {
        $DB = $this->xml->createElement("\163\x61\x6d\154\72\101\165\x74\150\x65\156\x74\x69\x63\x61\x74\x69\x6f\x6e\123\164\x61\164\145\155\x65\156\x74");
        $DB->setAttribute("\101\165\164\150\145\156\x74\151\143\141\x74\151\157\156\x4d\145\164\x68\x6f\x64", "\x75\162\156\72\x6f\x61\x73\151\163\x3a\x6e\141\x6d\x65\x73\72\x74\143\72\x53\101\x4d\x4c\x3a\x32\56\x30\x3a\x61\143\72\x63\x6c\141\163\163\145\x73\72\120\x61\163\163\167\157\x72\x64\x50\x72\157\x74\x65\x63\164\x65\x64\124\162\141\156\x73\160\x6f\x72\164");
        $DB->setAttribute("\101\x75\x74\150\145\x6e\164\x69\143\141\x74\x69\157\156\111\156\x73\164\x61\156\x74", $ax["\101\165\x74\x68\x6e\x49\156\163\164\141\x6e\x74"]);
        $Tr = $this->createSubject();
        $this->subject = $Tr;
        $DB->appendChild($Tr);
        return $DB;
    }
    function createAttributeStatement($ax)
    {
        $gC = $this->xml->createElement("\163\141\155\154\72\x41\164\164\x72\151\x62\165\x74\x65\123\x74\x61\x74\145\x6d\x65\x6e\x74");
        $AH = $this->createSubject();
        $this->subject = $AH;
        $gC->appendChild($AH);
        foreach ($this->sp_attr as $uy) {
            $Tq = $this->buildAttribute($ax, $uy->mo_sp_attr_name, $uy->mo_sp_attr_value, $uy->mo_attr_type);
            if (is_null($Tq)) {
                goto z0;
            }
            $gC->appendChild($Tq);
            z0:
            tr:
        }
        Gx:
        return $gC;
    }
    function buildAttribute($ax, $Nz, $oN, $p8)
    {
        if ($Nz === "\x67\162\157\x75\160\x4d\x61\x70\116\x61\155\x65") {
            goto GH;
        }
        if ($p8 == 0) {
            goto HL;
        }
        if (!($p8 == 2)) {
            goto W8;
        }
        $Ev = $oN;
        W8:
        goto J9;
        HL:
        $Ev = $this->current_user->{$oN};
        J9:
        goto Yw;
        GH:
        $Nz = $oN;
        $Ev = $this->current_user->roles;
        Yw:
        if (!empty($Ev)) {
            goto PP;
        }
        $Ev = get_user_meta($this->current_user->ID, $oN, TRUE);
        PP:
        $Ev = apply_filters("\147\145\156\x65\x72\141\x74\x65\137\x77\163\x66\145\x64\137\141\164\164\162\151\142\x75\x74\145\x5f\166\x61\x6c\x75\x65", $Ev, $this->current_user, $Nz);
        if (!empty($Ev)) {
            goto S_;
        }
        return null;
        S_:
        return $this->createAttributeNode($Ev, $Nz);
    }
    function createAttributeNode($Ev, $Nz)
    {
        $Tq = $this->xml->createElement("\163\141\x6d\x6c\72\101\164\x74\162\x69\142\x75\164\145");
        $Tq->setAttribute("\x41\x74\x74\x72\151\142\165\x74\x65\116\141\x6d\145", $Nz);
        $Tq->setAttribute("\x41\x74\164\x72\151\142\x75\x74\145\x4e\141\155\x65\163\160\x61\143\x65", "\150\164\x74\x70\72\x2f\57\163\143\x68\145\155\141\163\x2e\170\x6d\x6c\163\x6f\141\160\56\157\162\x67\57\143\x6c\141\151\x6d\x73");
        if (is_array($Ev)) {
            goto qB;
        }
        $Ev = apply_filters("\155\x6f\x64\x69\x66\x79\137\167\x73\146\145\144\137\x61\x74\x74\x72\137\166\x61\154\165\x65", $Ev);
        $bj = $this->xml->createElement("\163\x61\x6d\154\72\x41\164\164\162\x69\x62\165\x74\x65\126\141\154\165\145", htmlspecialchars($Ev));
        $Tq->appendChild($bj);
        goto RZ;
        qB:
        foreach ($Ev as $UV => $ak) {
            $ak = apply_filters("\155\157\x64\x69\146\x79\137\x77\x73\x66\x65\144\x5f\141\x74\164\x72\137\x76\141\154\x75\x65", $ak);
            $bj = $this->xml->createElement("\163\x61\155\x6c\72\101\x74\x74\x72\151\x62\x75\x74\145\126\141\154\x75\x65", htmlspecialchars($ak));
            $Tq->appendChild($bj);
            nJ:
        }
        AI:
        RZ:
        return $Tq;
    }
    function createSubjectConfirmation()
    {
        $DB = $this->xml->createElement("\x73\x61\155\x6c\x3a\x53\x75\142\152\145\143\164\x43\x6f\x6e\x66\x69\x72\155\x61\164\x69\157\x6e");
        $Tr = $this->createConfirmationMethod();
        $DB->appendChild($Tr);
        return $DB;
    }
    function createConfirmationMethod()
    {
        $DB = $this->xml->createElement("\x73\x61\x6d\x6c\x3a\103\x6f\156\146\x69\x72\x6d\141\x74\x69\x6f\156\115\145\164\150\x6f\144", "\165\162\156\x3a\x6f\x61\163\151\163\x3a\156\141\155\x65\163\72\x74\143\72\123\x41\x4d\x4c\x3a\x31\x2e\60\x3a\x63\155\x3a\x62\x65\x61\162\x65\162");
        return $DB;
    }
    function createSubject()
    {
        $DB = $this->xml->createElement("\163\x61\155\154\72\x53\165\x62\152\x65\143\x74");
        $Tr = $this->createNameId();
        $DB->appendChild($Tr);
        $dY = $this->createSubjectConfirmation();
        $DB->appendChild($dY);
        return $DB;
    }
    function createNameId()
    {
        $Eg = !empty($this->mo_idp_nameid_attr) && $this->mo_idp_nameid_attr != "\x65\x6d\141\x69\x6c\101\x64\x64\x72\x65\x73\x73" ? $this->mo_idp_nameid_attr : "\x75\163\145\162\137\145\x6d\x61\x69\154";
        $Ev = MoIDPUtility::isBlank($this->current_user->{$Eg}) ? get_user_meta($this->current_user->ID, $Eg, true) : $this->current_user->{$Eg};
        $Ev = apply_filters("\x67\x65\x6e\145\x72\x61\x74\145\137\x77\x73\146\x65\144\137\141\x74\164\x72\151\142\165\164\145\137\x76\141\154\165\x65", $Ev, $this->current_user, "\116\141\155\145\111\x44");
        $DB = $this->xml->createElement("\x73\141\x6d\154\72\116\x61\x6d\145\111\x64\145\x6e\x74\151\x66\151\145\x72", htmlspecialchars($Ev));
        $DB->setAttribute("\x46\x6f\x72\x6d\x61\x74", "\165\162\x6e\72\x6f\x61\163\x69\x73\x3a\x6e\x61\155\x65\x73\72\x74\143\x3a\x53\101\115\x4c\x3a" . $this->mo_idp_nameid_format);
        return $DB;
    }
    function createSamlConditions($ax)
    {
        $DB = $this->xml->createElement("\x73\141\155\154\x3a\x43\x6f\156\x64\151\x74\x69\x6f\x6e\163");
        $DB->setAttribute("\x4e\x6f\164\x42\145\x66\x6f\162\145", $ax["\x4e\157\x74\x42\145\146\x6f\x72\145"]);
        $DB->setAttribute("\x4e\x6f\164\117\x6e\x4f\162\101\146\x74\145\162", $ax["\x4e\157\164\x4f\156\x4f\x72\101\x66\164\145\162"]);
        $Tr = $this->createSamlAudience();
        $DB->appendChild($Tr);
        return $DB;
    }
    function createSamlAudience()
    {
        $DB = $this->xml->createElement("\x73\141\x6d\x6c\72\101\x75\144\151\145\156\x63\145\122\145\x73\x74\162\x69\143\x74\x69\157\156\103\157\x6e\144\151\x74\151\x6f\x6e");
        $Tr = $this->buildAudience();
        $DB->appendChild($Tr);
        return $DB;
    }
    function buildAudience()
    {
        $DB = $this->xml->createElement("\x73\x61\x6d\x6c\72\101\x75\144\151\x65\x6e\x63\x65", $this->wtrealm);
        return $DB;
    }
    function createResponseElementLifetime($ax)
    {
        $DB = $this->xml->createElement("\164\x3a\x4c\x69\x66\x65\x74\151\x6d\145");
        $Tr = $this->createLifetime($ax);
        $dY = $this->expireLifetime($ax);
        $DB->appendChild($Tr);
        $DB->appendChild($dY);
        return $DB;
    }
    function createResponseElementAppliesTo($ax)
    {
        $DB = $this->xml->createElementNS("\x68\x74\x74\160\72\x2f\57\163\143\150\x65\x6d\x61\x73\x2e\170\x6d\x6c\163\157\141\160\x2e\x6f\x72\147\x2f\167\x73\x2f\62\60\60\x34\57\60\x39\57\160\157\154\x69\x63\171", "\167\163\x70\x3a\101\x70\x70\x6c\x69\x65\163\124\x6f");
        $Tr = $this->buildAppliesTO($ax);
        $DB->appendChild($Tr);
        return $DB;
    }
    function buildAppliesTO($ax)
    {
        $DB = $this->xml->createElementNS("\x68\x74\164\160\x3a\x2f\57\x77\x77\x77\56\x77\63\56\x6f\162\x67\x2f\x32\x30\x30\65\57\x30\70\57\141\144\x64\x72\x65\x73\163\x69\x6e\x67", "\167\163\x61\72\x45\156\x64\x70\x6f\x69\156\x74\122\145\x66\145\x72\x65\x6e\143\x65");
        $Tr = $this->createAddress();
        $DB->appendChild($Tr);
        return $DB;
    }
    function createAddress()
    {
        $DB = $this->xml->createElement("\167\163\141\72\x41\x64\144\x72\x65\x73\163", $this->wtrealm);
        return $DB;
    }
    function createLifetime($ax)
    {
        $NP = $ax["\x49\x73\163\x75\145\111\x6e\x73\164\x61\x6e\x74"];
        $DB = $this->xml->createElementNS("\150\x74\164\160\72\57\57\144\x6f\x63\x73\x2e\157\x61\163\151\x73\x2d\157\160\145\156\56\x6f\x72\147\x2f\x77\x73\x73\x2f\x32\60\x30\x34\57\x30\61\x2f\157\x61\x73\151\163\x2d\62\x30\60\64\x30\61\55\x77\x73\x73\55\x77\x73\163\145\143\x75\x72\151\164\x79\55\165\x74\x69\x6c\x69\164\x79\55\61\x2e\60\x2e\170\x73\x64", "\x77\x73\165\72\103\x72\145\141\x74\145\x64", $NP);
        return $DB;
    }
    function expireLifetime($ax)
    {
        $Pd = $ax["\x4e\157\164\x4f\156\x4f\162\x41\x66\164\145\x72"];
        $DB = $this->xml->createElementNS("\150\164\164\160\72\57\57\x64\157\x63\x73\56\157\141\163\151\x73\55\x6f\x70\145\x6e\56\x6f\x72\x67\57\167\163\163\57\62\x30\60\x34\57\60\61\x2f\x6f\x61\163\151\163\55\x32\60\x30\64\60\x31\55\167\163\163\x2d\x77\163\x73\x65\x63\165\x72\151\164\171\55\x75\x74\x69\154\151\x74\171\x2d\61\x2e\x30\56\x78\163\144", "\x77\163\165\x3a\x45\x78\160\151\162\145\x73", $Pd);
        return $DB;
    }
}
