<?php


namespace IDP\Helper\SAML2;

use IDP\Exception\InvalidSSOUserException;
use IDP\Helper\Utilities\MoIDPUtility;
use RobRichards\XMLSecLibs\XMLSecurityKey;
use RobRichards\XMLSecLibs\XMLSecurityDsig;
use RobRichards\XMLSecLibs\XMLSecEnc;
use IDP\Helper\Factory\ResponseHandlerFactory;
class GenerateResponse implements ResponseHandlerFactory
{
    private $xml;
    private $acsUrl;
    private $issuer;
    private $audience;
    private $sp_attr;
    private $requestID;
    private $subject;
    private $mo_idp_assertion_signed;
    private $mo_idp_encrypted_assertion;
    private $mo_idp_response_signed;
    private $mo_idp_nameid_attr;
    private $mo_idp_nameid_format;
    private $mo_idp_cert_encrypt;
    private $login;
    private $current_user;
    private $sessionIndex;
    function __construct($Ko, $t3, $Qn, $VH, $LE, $Lm, $km, $B6)
    {
        $this->xml = new \DOMDocument("\61\56\x30", "\165\164\x66\55\x38");
        $this->acsUrl = $Ko;
        $this->issuer = $t3;
        $this->audience = $Qn;
        $this->requestID = $VH;
        $this->login = $km;
        $this->sp_attr = $LE;
        $this->mo_idp_nameid_format = $Lm->mo_idp_nameid_format;
        $this->mo_idp_assertion_signed = $Lm->mo_idp_assertion_signed;
        $this->mo_idp_encrypted_assertion = $Lm->mo_idp_encrypted_assertion;
        $this->mo_idp_response_signed = $Lm->mo_idp_response_signed;
        $this->mo_idp_nameid_attr = $Lm->mo_idp_nameid_attr;
        $this->mo_idp_cert_encrypt = $Lm->mo_idp_cert_encrypt;
        $this->current_user = is_null($this->login) ? wp_get_current_user() : get_user_by("\x6c\157\x67\151\156", $this->login);
        $this->sessionIndex = $B6;
    }
    function generateResponse()
    {
        if (!MoIDPUtility::isBlank($this->current_user)) {
            goto Rd;
        }
        throw new InvalidSSOUserException();
        Rd:
        $ax = $this->getResponseParams();
        $DB = $this->createResponseElement($ax);
        $this->xml->appendChild($DB);
        $t3 = $this->buildIssuer();
        $DB->appendChild($t3);
        $JB = $this->buildStatus();
        $DB->appendChild($JB);
        $Nr = $this->buildStatusCode();
        $JB->appendChild($Nr);
        $mL = $this->buildAssertion($ax);
        $DB->appendChild($mL);
        if (!MSI_DEBUG) {
            goto lm;
        }
        MoIDPUtility::mo_debug("\x55\156\x65\x63\x6e\x63\162\171\160\164\145\144\40\x61\156\144\x20\165\x6e\163\151\x67\x6e\145\144\40\x53\x41\x4d\x4c\x20\122\145\x73\x70\x6f\x6e\x73\x65\x3a\40" . $this->xml->saveXML());
        lm:
        if (!$this->mo_idp_assertion_signed) {
            goto OO;
        }
        $zJ = MoIDPUtility::getPrivateKey();
        $this->signNode($zJ, $mL, $this->subject, $ax);
        OO:
        if (!$this->mo_idp_encrypted_assertion) {
            goto Wy;
        }
        $ad = $this->buildEncryptedAssertion($mL);
        $DB->removeChild($mL);
        $DB->appendChild($ad);
        Wy:
        if (!$this->mo_idp_response_signed) {
            goto mR;
        }
        $zJ = MoIDPUtility::getPrivateKey();
        $this->signNode($zJ, $DB, $JB, $ax);
        mR:
        $rR = $this->xml->saveXML();
        return $rR;
    }
    function getResponseParams()
    {
        $ax = array();
        $Vs = time();
        $ax["\x49\163\x73\165\x65\x49\x6e\163\x74\x61\x6e\x74"] = str_replace("\x2b\x30\x30\72\x30\x30", "\x5a", gmdate("\x63", $Vs));
        $ax["\116\x6f\164\x4f\156\x4f\162\101\146\x74\x65\x72"] = str_replace("\x2b\x30\60\x3a\x30\x30", "\132", gmdate("\x63", $Vs + 300));
        $ax["\x4e\157\x74\102\145\x66\157\x72\145"] = str_replace("\53\x30\x30\72\x30\60", "\x5a", gmdate("\x63", $Vs - 30));
        $ax["\x41\165\164\x68\156\111\x6e\x73\x74\141\156\164"] = str_replace("\x2b\x30\60\72\60\60", "\x5a", gmdate("\143", $Vs - 120));
        $ax["\x53\x65\163\163\151\157\x6e\116\157\x74\x4f\x6e\x4f\x72\x41\x66\164\x65\x72"] = str_replace("\x2b\x30\x30\x3a\60\x30", "\132", gmdate("\143", $Vs + 3600 * 8));
        $ax["\x49\x44"] = $this->generateUniqueID(40);
        $ax["\101\163\163\x65\162\x74\111\104"] = $this->generateUniqueID(40);
        $ax["\111\x73\163\165\x65\x72"] = $this->issuer;
        $xR = MoIDPUtility::getPublicCert();
        $fF = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, array("\164\171\x70\145" => "\x70\x75\x62\154\x69\143"));
        $fF->loadKey($xR, FALSE, TRUE);
        $ax["\170\x35\x30\x39"] = $fF->getX509Certificate();
        return $ax;
    }
    function createResponseElement($ax)
    {
        $DB = $this->xml->createElementNS("\x75\x72\156\72\157\141\163\x69\163\x3a\156\141\155\x65\163\72\164\143\72\123\x41\x4d\x4c\x3a\62\56\x30\72\160\162\157\164\157\143\x6f\x6c", "\x73\x61\x6d\x6c\160\x3a\122\x65\163\x70\x6f\x6e\x73\145");
        $DB->setAttribute("\x49\104", $ax["\x49\x44"]);
        $DB->setAttribute("\126\145\162\163\x69\157\x6e", "\x32\56\60");
        $DB->setAttribute("\x49\x73\163\x75\145\111\156\163\164\141\156\164", $ax["\x49\x73\163\x75\145\x49\x6e\163\x74\141\x6e\x74"]);
        $DB->setAttribute("\x44\x65\x73\164\151\x6e\x61\x74\151\x6f\x6e", $this->acsUrl);
        if (is_null($this->requestID)) {
            goto YA;
        }
        $DB->setAttribute("\111\x6e\122\145\x73\x70\x6f\156\163\x65\124\157", $this->requestID);
        YA:
        return $DB;
    }
    function buildIssuer()
    {
        $t3 = $this->xml->createElementNS("\x75\162\x6e\x3a\x6f\141\x73\x69\x73\72\156\141\x6d\x65\163\72\164\x63\72\123\x41\115\114\72\62\x2e\x30\x3a\x61\x73\x73\x65\162\x74\x69\157\x6e", "\163\x61\155\154\x3a\111\x73\x73\165\x65\162", $this->issuer);
        return $t3;
    }
    function buildStatus()
    {
        $JB = $this->xml->createElementNS("\165\162\156\x3a\157\141\x73\x69\x73\72\x6e\141\155\x65\163\x3a\164\x63\x3a\123\101\x4d\114\x3a\x32\56\60\72\x70\162\157\164\x6f\143\x6f\x6c", "\x73\x61\x6d\154\160\x3a\123\164\141\164\165\x73");
        return $JB;
    }
    function buildStatusCode()
    {
        $Nr = $this->xml->createElementNS("\165\x72\x6e\x3a\x6f\x61\163\151\163\x3a\x6e\141\x6d\x65\x73\x3a\164\x63\x3a\123\x41\115\114\72\x32\56\x30\x3a\x70\162\157\x74\x6f\143\157\x6c", "\x73\141\x6d\x6c\x70\72\123\x74\141\164\x75\163\103\x6f\144\145");
        $Nr->setAttribute("\126\x61\154\x75\x65", "\x75\x72\x6e\x3a\157\x61\163\x69\163\72\x6e\x61\x6d\145\163\72\164\x63\72\x53\101\115\x4c\x3a\x32\56\x30\x3a\x73\x74\x61\164\x75\163\x3a\123\x75\143\143\x65\163\163");
        return $Nr;
    }
    function buildAssertion($ax)
    {
        $mL = $this->xml->createElementNS("\x75\162\156\x3a\157\x61\163\151\163\72\x6e\141\x6d\x65\x73\x3a\x74\143\x3a\x53\x41\115\x4c\72\x32\56\x30\x3a\141\163\163\145\162\164\x69\x6f\156", "\163\141\155\x6c\72\x41\163\163\145\162\164\x69\x6f\x6e");
        $mL->setAttribute("\111\104", $ax["\x41\x73\163\x65\x72\x74\111\x44"]);
        $mL->setAttribute("\111\163\163\x75\x65\111\x6e\x73\x74\x61\156\x74", $ax["\111\x73\x73\x75\x65\x49\156\x73\164\x61\156\x74"]);
        $mL->setAttribute("\x56\145\162\x73\x69\157\156", "\x32\56\x30");
        $t3 = $this->buildIssuer();
        $mL->appendChild($t3);
        $AH = $this->buildSubject($ax);
        $this->subject = $AH;
        $mL->appendChild($AH);
        $rC = $this->buildCondition($ax);
        $mL->appendChild($rC);
        $E6 = $this->buildAuthnStatement($ax);
        $mL->appendChild($E6);
        if (!(isset($this->sp_attr) && !empty($this->sp_attr))) {
            goto RR;
        }
        $gC = $this->buildAttrStatement();
        $mL->appendChild($gC);
        RR:
        return $mL;
    }
    function buildSubject($ax)
    {
        $AH = $this->xml->createElement("\163\x61\155\154\72\123\x75\142\152\x65\143\164");
        $qe = $this->buildNameIdentifier();
        $AH->appendChild($qe);
        $np = $this->buildSubjectConfirmation($ax);
        $AH->appendChild($np);
        return $AH;
    }
    function buildNameIdentifier()
    {
        $Eg = !empty($this->mo_idp_nameid_attr) && $this->mo_idp_nameid_attr != "\x65\155\x61\x69\x6c\101\144\144\x72\x65\163\163" ? $this->mo_idp_nameid_attr : "\x75\x73\x65\x72\x5f\145\x6d\x61\151\154";
        $Ev = MoIDPUtility::isBlank($this->current_user->{$Eg}) ? get_user_meta($this->current_user->ID, $Eg, true) : $this->current_user->{$Eg};
        $Ev = apply_filters("\x67\x65\156\145\x72\x61\x74\145\x5f\x73\x61\x6d\154\137\x61\x74\164\162\x69\142\x75\164\145\137\x76\x61\x6c\x75\145", $Ev, $this->current_user, "\x4e\141\155\145\111\104", "\x4e\141\x6d\x65\111\x44");
        $qe = $this->xml->createElement("\x73\x61\x6d\154\72\116\x61\x6d\145\x49\x44", htmlspecialchars($Ev));
        $qe->setAttribute("\x46\x6f\162\155\x61\x74", "\x75\162\x6e\72\x6f\x61\x73\x69\x73\x3a\156\141\x6d\x65\163\x3a\164\143\x3a\x53\101\115\x4c\72" . $this->mo_idp_nameid_format);
        return $qe;
    }
    function buildSubjectConfirmation($ax)
    {
        $np = $this->xml->createElement("\163\141\x6d\x6c\x3a\x53\165\x62\152\x65\143\x74\103\157\x6e\x66\x69\x72\155\x61\164\x69\x6f\156");
        $np->setAttribute("\x4d\x65\x74\x68\157\x64", "\165\x72\156\72\157\141\163\151\163\72\x6e\x61\x6d\145\x73\x3a\x74\143\72\123\101\x4d\114\72\x32\56\x30\x3a\143\x6d\x3a\x62\x65\x61\x72\145\162");
        $iM = $this->getSubjectConfirmationData($ax);
        $np->appendChild($iM);
        return $np;
    }
    function getSubjectConfirmationData($ax)
    {
        $iM = $this->xml->createElement("\163\141\155\x6c\x3a\123\x75\142\152\145\x63\164\x43\x6f\x6e\146\x69\162\155\x61\x74\x69\157\x6e\104\x61\x74\141");
        $iM->setAttribute("\116\157\x74\117\x6e\117\x72\101\146\164\145\x72", $ax["\x4e\157\164\x4f\156\x4f\x72\101\x66\x74\145\x72"]);
        $iM->setAttribute("\122\x65\x63\x69\x70\151\x65\x6e\164", $this->acsUrl);
        if (is_null($this->requestID)) {
            goto VC;
        }
        $iM->setAttribute("\x49\156\x52\x65\x73\160\x6f\x6e\x73\145\x54\x6f", $this->requestID);
        VC:
        return $iM;
    }
    function buildCondition($ax)
    {
        $rC = $this->xml->createElement("\x73\x61\x6d\154\72\x43\x6f\156\x64\x69\164\151\157\x6e\163");
        $rC->setAttribute("\116\157\164\x42\145\146\157\x72\x65", $ax["\116\x6f\x74\102\x65\146\x6f\162\x65"]);
        $rC->setAttribute("\x4e\157\x74\117\x6e\117\x72\101\146\x74\x65\x72", $ax["\x4e\157\164\x4f\x6e\x4f\x72\101\x66\x74\145\x72"]);
        $Qn = $this->buildAudienceRestriction();
        $rC->appendChild($Qn);
        return $rC;
    }
    function buildAudienceRestriction()
    {
        $pL = $this->xml->createElement("\163\x61\x6d\x6c\x3a\x41\x75\144\x69\145\156\x63\x65\x52\x65\x73\164\162\x69\x63\x74\151\x6f\156");
        $Qn = $this->xml->createElement("\x73\x61\155\x6c\72\x41\x75\144\x69\145\x6e\x63\145", $this->audience);
        $pL->appendChild($Qn);
        return $pL;
    }
    function buildAuthnStatement($ax)
    {
        $E6 = $this->xml->createElement("\x73\x61\x6d\154\x3a\x41\165\164\x68\x6e\x53\164\141\x74\x65\x6d\x65\156\164");
        $E6->setAttribute("\x41\x75\164\150\x6e\x49\x6e\x73\164\141\x6e\x74", $ax["\x41\165\164\x68\156\111\156\x73\x74\141\156\164"]);
        $E6->setAttribute("\123\145\163\x73\151\x6f\156\x49\x6e\144\x65\170", $this->sessionIndex);
        $E6->setAttribute("\123\145\163\x73\x69\157\156\116\x6f\x74\117\156\117\x72\x41\146\164\x65\x72", $ax["\123\x65\163\163\151\x6f\x6e\x4e\x6f\x74\117\156\x4f\162\101\x66\164\145\162"]);
        $T1 = $this->xml->createElement("\x73\x61\155\x6c\72\x41\165\164\x68\x6e\x43\x6f\156\x74\x65\170\x74");
        $Ri = $this->xml->createElement("\163\x61\155\x6c\x3a\101\x75\x74\x68\156\103\157\156\x74\x65\170\164\103\x6c\141\x73\163\x52\x65\146", "\165\162\x6e\72\157\x61\x73\x69\163\x3a\156\x61\x6d\x65\x73\x3a\x74\143\x3a\x53\x41\115\x4c\x3a\62\56\60\72\x61\143\x3a\x63\154\141\x73\163\145\163\x3a\120\141\x73\x73\x77\157\162\144\120\162\x6f\164\x65\x63\164\145\x64\124\x72\x61\x6e\x73\x70\157\x72\x74");
        $T1->appendChild($Ri);
        $E6->appendChild($T1);
        return $E6;
    }
    function buildAttrStatement()
    {
        $gC = $this->xml->createElement("\163\141\155\154\72\x41\164\x74\162\x69\142\165\x74\x65\123\164\x61\x74\145\155\x65\156\x74");
        foreach ($this->sp_attr as $uy) {
            $Tq = $this->buildAttribute($uy->mo_sp_attr_name, $uy->mo_sp_attr_value, $uy->mo_attr_type);
            if (is_null($Tq)) {
                goto aB;
            }
            $gC->appendChild($Tq);
            aB:
            Zs:
        }
        sj:
        return $gC;
    }
    function buildAttribute($Nz, $oN, $p8)
    {
        if ($Nz === "\x67\162\x6f\x75\x70\x4d\x61\160\x4e\141\155\x65") {
            goto un;
        }
        if ($p8 == 0) {
            goto sM;
        }
        if (!($p8 == 2)) {
            goto vj;
        }
        $Ev = $oN;
        vj:
        goto uu;
        sM:
        $Ev = $this->current_user->{$oN};
        if (!empty($Ev)) {
            goto MB;
        }
        $Ev = get_user_meta($this->current_user->ID, $oN, TRUE);
        MB:
        uu:
        goto Zj;
        un:
        $Nz = $oN;
        $Ev = $this->current_user->roles;
        Zj:
        $Ev = apply_filters("\x67\145\x6e\x65\162\141\x74\x65\137\x73\141\x6d\x6c\x5f\141\164\x74\162\151\142\165\164\x65\137\166\x61\154\165\x65", $Ev, $this->current_user, $Nz, $oN);
        if (!empty($Ev)) {
            goto fs;
        }
        return null;
        fs:
        return $this->createAttributeNode($Ev, $Nz);
    }
    function createAttributeNode($Ev, $Nz)
    {
        $Tq = $this->xml->createElement("\x73\x61\155\154\72\101\164\x74\x72\x69\x62\x75\164\145");
        $Tq->setAttribute("\x4e\x61\x6d\x65", $Nz);
        $Tq->setAttribute("\116\x61\x6d\x65\106\157\x72\155\141\164", "\165\162\156\72\x6f\141\x73\x69\163\72\156\141\155\145\163\72\164\x63\72\x53\101\115\114\72\62\x2e\60\72\x61\x74\x74\x72\x6e\x61\155\x65\x2d\x66\x6f\162\x6d\x61\164\72\x75\156\163\160\145\143\151\146\151\x65\144");
        if (is_array($Ev)) {
            goto kc;
        }
        $Ev = apply_filters("\x6d\157\x64\151\146\x79\137\163\x61\x6d\154\137\x61\164\x74\162\x5f\x76\x61\154\165\x65", $Ev);
        $bj = $this->xml->createElement("\x73\141\x6d\154\x3a\101\164\x74\x72\x69\142\165\x74\145\x56\x61\154\x75\145", htmlspecialchars($Ev));
        $Tq->appendChild($bj);
        goto MD;
        kc:
        foreach ($Ev as $UV => $ak) {
            $ak = apply_filters("\x6d\x6f\144\x69\x66\171\137\163\x61\155\154\137\141\164\164\162\137\166\141\154\x75\x65", $ak);
            $bj = $this->xml->createElement("\163\141\155\x6c\72\x41\x74\x74\x72\x69\x62\165\164\145\126\141\154\165\145", htmlspecialchars($ak));
            $Tq->appendChild($bj);
            m3:
        }
        uk:
        MD:
        return $Tq;
    }
    function buildEncryptedAssertion($mL)
    {
        $ad = $this->xml->createElementNS("\165\162\x6e\72\157\x61\x73\x69\163\72\x6e\141\x6d\145\163\72\164\143\72\x53\x41\115\x4c\72\62\56\x30\72\141\x73\163\x65\162\164\x69\157\156", "\x73\141\x6d\x6c\160\72\x45\x6e\143\162\171\x70\164\145\x64\x41\x73\x73\145\162\x74\151\157\x6e");
        $Qr = $this->buildEncryptedData($mL);
        $ad->appendChild($ad->ownerDocument->importNode($Qr, TRUE));
        return $ad;
    }
    function buildEncryptedData($mL)
    {
        $Qr = new XMLSecEnc();
        $Qr->setNode($mL);
        $Qr->type = "\150\164\164\160\72\57\x2f\x77\x77\x77\x2e\x77\63\x2e\157\162\147\x2f\x32\60\x30\61\57\60\64\x2f\170\155\154\145\156\x63\x23\x45\154\x65\155\145\x6e\164";
        $LJ = $this->mo_idp_cert_encrypt;
        $K5 = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, array("\x74\x79\x70\x65" => "\x70\165\x62\x6c\x69\x63"));
        $K5->loadKey($LJ, FALSE, TRUE);
        $Bj = new XMLSecurityKey(XMLSecurityKey::AES256_CBC);
        $Bj->generateSessionKey();
        $Qr->encryptKey($K5, $Bj);
        $Tv = $Qr->encryptNode($Bj, FALSE);
        return $Tv;
    }
    function signNode($zJ, $jb, $AH, $ax)
    {
        $fF = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, array("\x74\x79\160\145" => "\160\x72\x69\166\141\164\x65"));
        $fF->loadKey($zJ, FALSE);
        $PW = new XMLSecurityDSig();
        $PW->setCanonicalMethod(XMLSecurityDSig::EXC_C14N);
        $PW->addReferenceList(array($jb), XMLSecurityDSig::SHA256, array("\x68\164\x74\160\x3a\57\x2f\x77\167\167\x2e\x77\x33\x2e\x6f\x72\x67\57\x32\x30\60\x30\57\60\71\x2f\170\155\x6c\x64\163\151\147\43\x65\x6e\166\145\x6c\x6f\x70\x65\144\55\163\151\147\156\x61\x74\x75\162\145", XMLSecurityDSig::EXC_C14N), array("\151\144\x5f\156\141\155\x65" => "\111\104", "\x6f\166\x65\x72\x77\162\151\x74\x65" => false));
        $PW->sign($fF);
        $PW->add509Cert($ax["\170\65\x30\x39"]);
        $PW->insertSignature($jb, $AH);
    }
    function generateUniqueID($B0)
    {
        return MoIDPUtility::generateRandomAlphanumericValue($B0);
    }
}
