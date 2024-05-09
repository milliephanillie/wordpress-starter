<?php


namespace IDP\Helper\Utilities;

use RobRichards\XMLSecLibs\XMLSecurityDsig;
use RobRichards\XMLSecLibs\XMLSecurityKey;
use IDP\Helper\Factory\ResponseDecisionHandler;
use IDP\Helper\Factory\RequestDecisionHandler;
use IDP\Helper\Constants\MoIDPConstants;
class SAMLUtilities
{
    public static function generateID()
    {
        return "\137" . self::stringToHex(self::generateRandomBytes(21));
    }
    public static function stringToHex($kb)
    {
        $C_ = '';
        $Uy = 0;
        k4:
        if (!($Uy < strlen($kb))) {
            goto U5;
        }
        $C_ .= sprintf("\x25\60\62\170", ord($kb[$Uy]));
        jf:
        $Uy++;
        goto k4;
        U5:
        return $C_;
    }
    public static function generateRandomBytes($B0, $gr = TRUE)
    {
        return openssl_random_pseudo_bytes($B0);
    }
    public static function createLogoutRequest($iD, $B6, $t3, $tY, $Yy = "\x48\x74\x74\160\122\x65\144\x69\162\145\143\x74")
    {
        $x8 = RequestDecisionHandler::getRequestHandler(MoIDPConstants::LOGOUT_REQUEST, $_REQUEST, $_GET, array($iD, $B6, $t3, $tY));
        $PA = $x8->generateRequest();
        if (!MSI_DEBUG) {
            goto CY;
        }
        MoIDPUtility::mo_debug("\123\x41\x4d\114\x20\114\157\x67\x6f\x75\164\x20\122\145\x71\x75\x65\163\164\40\147\x65\156\x65\x72\141\x74\x65\x64\x3a\x20" . $PA);
        CY:
        if (!(empty($Yy) || $Yy == "\110\164\x74\x70\122\145\x64\151\x72\x65\143\164")) {
            goto Sl;
        }
        $D6 = gzdeflate($PA);
        $F0 = base64_encode($D6);
        $Bv = urlencode($F0);
        $PA = $Bv;
        Sl:
        return $PA;
    }
    public static function createLogoutResponse($sL, $t3, $tY, $Yy = "\x48\x74\x74\x70\122\x65\x64\151\162\145\x63\164")
    {
        $Zy = ResponseDecisionHandler::getResponseHandler(MoIDPConstants::LOGOUT_RESPONSE, array($sL, $t3, $tY));
        $Eq = $Zy->generateResponse();
        if (!MSI_DEBUG) {
            goto FW;
        }
        MoIDPUtility::mo_debug("\x53\x41\x4d\x4c\40\114\x6f\x67\x6f\x75\164\x20\122\145\x73\160\x6f\156\163\145\40\147\x65\x6e\145\162\x61\x74\145\144\72\40" . $Eq);
        FW:
        if (!(empty($Yy) || $Yy == "\x48\x74\x74\160\x52\x65\x64\x69\x72\145\143\164")) {
            goto oQ;
        }
        $D6 = gzdeflate($Eq);
        $F0 = base64_encode($D6);
        $Bv = urlencode($F0);
        $Eq = $Bv;
        oQ:
        return $Eq;
    }
    public static function generateTimestamp($aI = NULL)
    {
        if (!($aI === NULL)) {
            goto K4;
        }
        $aI = time();
        K4:
        return gmdate("\x59\55\155\55\144\x5c\x54\x48\x3a\151\72\163\134\132", $aI);
    }
    public static function xpQuery(\DomNode $jb, $PU)
    {
        static $Ec = NULL;
        if ($jb instanceof \DOMDocument) {
            goto js;
        }
        $QP = $jb->ownerDocument;
        goto l1;
        js:
        $QP = $jb;
        l1:
        if (!($Ec === NULL || !$Ec->document->isSameNode($QP))) {
            goto We;
        }
        $Ec = new \DOMXPath($QP);
        $Ec->registerNamespace("\163\x6f\x61\160\55\x65\156\166", "\150\x74\164\160\x3a\57\57\x73\x63\150\x65\x6d\x61\x73\x2e\x78\155\154\x73\157\141\160\56\157\x72\x67\57\x73\x6f\x61\160\57\x65\x6e\166\145\154\x6f\x70\145\x2f");
        $Ec->registerNamespace("\163\x61\x6d\154\x5f\x70\162\x6f\164\157\x63\x6f\154", "\x75\x72\x6e\x3a\157\x61\x73\151\x73\72\156\141\x6d\x65\x73\72\x74\x63\x3a\123\101\x4d\x4c\x3a\62\56\60\x3a\160\x72\157\x74\x6f\143\157\x6c");
        $Ec->registerNamespace("\163\141\x6d\154\x5f\x61\x73\163\x65\x72\164\151\157\x6e", "\165\162\156\x3a\157\x61\163\151\x73\x3a\x6e\141\x6d\x65\163\x3a\x74\143\x3a\x53\x41\x4d\x4c\x3a\62\x2e\x30\x3a\141\163\163\145\x72\164\151\x6f\x6e");
        $Ec->registerNamespace("\163\141\155\x6c\x5f\155\x65\164\141\x64\x61\x74\141", "\165\x72\156\x3a\157\x61\x73\x69\x73\72\156\x61\x6d\145\163\72\164\x63\72\x53\101\x4d\114\x3a\x32\x2e\x30\72\x6d\145\164\141\x64\x61\x74\x61");
        $Ec->registerNamespace("\x64\x73", "\150\164\164\x70\72\57\x2f\x77\x77\167\56\x77\x33\56\x6f\x72\x67\57\x32\60\60\60\x2f\x30\71\57\170\x6d\x6c\144\163\x69\x67\x23");
        $Ec->registerNamespace("\x78\x65\x6e\143", "\x68\164\x74\160\72\57\57\x77\167\x77\56\167\63\x2e\x6f\x72\x67\x2f\62\x30\x30\x31\57\x30\64\x2f\x78\x6d\x6c\145\x6e\143\43");
        We:
        $AN = $Ec->query($PU, $jb);
        $C_ = array();
        $Uy = 0;
        Qr:
        if (!($Uy < $AN->length)) {
            goto TN;
        }
        $C_[$Uy] = $AN->item($Uy);
        ZL:
        $Uy++;
        goto Qr;
        TN:
        return $C_;
    }
    public static function parseNameId(\DOMElement $Wp)
    {
        $C_ = array("\x56\x61\x6c\165\145" => trim($Wp->textContent));
        foreach (array("\x4e\141\x6d\145\x51\x75\x61\154\151\146\x69\x65\162", "\123\x50\116\141\x6d\x65\121\x75\x61\x6c\151\146\x69\145\x72", "\x46\x6f\x72\155\x61\x74") as $uy) {
            if (!$Wp->hasAttribute($uy)) {
                goto cv;
            }
            $C_[$uy] = $Wp->getAttribute($uy);
            cv:
            kI:
        }
        vC:
        return $C_;
    }
    public static function xsDateTimeToTimestamp($Vs)
    {
        $ZL = array();
        $XQ = "\57\136\x28\134\144\x5c\x64\x5c\144\134\x64\51\55\x28\x5c\x64\134\x64\51\x2d\x28\x5c\144\x5c\x64\51\x54\x28\x5c\144\x5c\x64\x29\72\x28\134\144\134\x64\x29\x3a\x28\x5c\x64\134\x64\x29\x28\x3f\x3a\x5c\56\x5c\x64\x2b\51\x3f\132\x24\x2f\x44";
        if (!(preg_match($XQ, $Vs, $ZL) == 0)) {
            goto pM;
        }
        echo sprintf("\111\156\166\141\x6c\151\144\40\x53\101\115\114\x32\x20\164\x69\x6d\x65\x73\164\x61\155\x70\x20\160\x61\163\x73\145\144\40\164\157\40\170\163\x44\x61\164\x65\x54\x69\x6d\145\124\x6f\x54\151\155\145\163\x74\x61\x6d\160\x3a\x20" . $Vs);
        exit;
        pM:
        $ud = intval($ZL[1]);
        $AY = intval($ZL[2]);
        $d6 = intval($ZL[3]);
        $ol = intval($ZL[4]);
        $xL = intval($ZL[5]);
        $jA = intval($ZL[6]);
        $XB = gmmktime($ol, $xL, $jA, $AY, $d6, $ud);
        return $XB;
    }
    public static function extractStrings(\DOMElement $IY, $yo, $Ar)
    {
        $C_ = array();
        $jb = $IY->firstChild;
        jb:
        if (!($jb !== NULL)) {
            goto Qy;
        }
        if (!($jb->namespaceURI !== $yo || $jb->localName !== $Ar)) {
            goto vo;
        }
        goto TX;
        vo:
        $C_[] = trim($jb->textContent);
        TX:
        $jb = $jb->nextSibling;
        goto jb;
        Qy:
        return $C_;
    }
    public static function validateElement(\DOMElement $BT)
    {
        $PW = new XMLSecurityDSig();
        $PW->idKeys[] = "\x49\x44";
        $sY = self::xpQuery($BT, "\x2e\x2f\x64\x73\x3a\123\151\147\156\x61\x74\165\x72\145");
        if (count($sY) === 0) {
            goto gX;
        }
        if (count($sY) > 1) {
            goto hC;
        }
        goto kU;
        gX:
        return FALSE;
        goto kU;
        hC:
        echo sprintf("\130\x4d\114\123\145\x63\72\x20\x6d\157\x72\145\x20\164\x68\x61\156\40\157\156\x65\40\x73\x69\147\x6e\x61\164\165\162\x65\40\145\154\x65\x6d\145\x6e\164\40\151\156\40\x72\x6f\x6f\x74\x2e");
        exit;
        kU:
        $sY = $sY[0];
        $PW->sigNode = $sY;
        $PW->canonicalizeSignedInfo();
        if ($PW->validateReference()) {
            goto Ic;
        }
        echo sprintf("\130\115\114\163\x65\x63\72\40\x64\151\x67\145\x73\164\40\166\141\154\151\x64\x61\x74\x69\157\x6e\40\x66\141\x69\x6c\x65\144");
        exit;
        Ic:
        $H7 = FALSE;
        foreach ($PW->getValidatedNodes() as $gQ) {
            if ($gQ->isSameNode($BT)) {
                goto jJ;
            }
            if ($BT->parentNode instanceof \DOMDocument && $gQ->isSameNode($BT->ownerDocument)) {
                goto Et;
            }
            goto Ll;
            jJ:
            $H7 = TRUE;
            goto ie;
            goto Ll;
            Et:
            $H7 = TRUE;
            goto ie;
            Ll:
            F2:
        }
        ie:
        if ($H7) {
            goto zh;
        }
        echo sprintf("\130\x4d\x4c\x53\x65\x63\72\x20\x54\x68\x65\x20\x72\157\157\x74\40\x65\154\x65\x6d\145\x6e\164\40\151\163\x20\x6e\157\164\40\163\x69\147\x6e\x65\144\56");
        exit;
        zh:
        $JX = array();
        foreach (self::xpQuery($sY, "\56\57\144\x73\x3a\x4b\x65\x79\111\156\146\157\57\x64\163\x3a\x58\65\x30\x39\x44\x61\x74\x61\x2f\x64\163\72\130\65\x30\x39\x43\x65\162\164\151\146\151\x63\141\x74\x65") as $P0) {
            $OD = trim($P0->textContent);
            $OD = str_replace(array("\15", "\xa", "\11", "\x20"), '', $OD);
            $JX[] = $OD;
            nG:
        }
        GZ:
        $C_ = array("\x53\151\147\156\141\x74\x75\x72\x65" => $PW, "\x43\x65\162\164\x69\x66\x69\x63\141\x74\145\163" => $JX);
        return $C_;
    }
    public static function validateSignature(array $eV, XMLSecurityKey $UV)
    {
        $PW = $eV["\x53\x69\x67\x6e\141\164\x75\162\x65"];
        $hp = self::xpQuery($PW->sigNode, "\56\57\144\163\72\x53\x69\147\156\x65\x64\111\156\x66\x6f\x2f\x64\163\x3a\x53\x69\x67\x6e\141\164\x75\162\x65\115\x65\x74\150\157\144");
        if (!empty($hp)) {
            goto hL;
        }
        echo sprintf("\115\x69\x73\x73\x69\x6e\147\x20\123\x69\147\156\x61\x74\165\x72\x65\x4d\x65\164\150\x6f\144\40\x65\154\145\155\145\x6e\x74");
        exit;
        hL:
        $hp = $hp[0];
        if ($hp->hasAttribute("\101\154\147\x6f\162\151\x74\150\x6d")) {
            goto C8;
        }
        echo sprintf("\x4d\151\x73\x73\151\156\x67\x20\101\x6c\147\157\162\151\164\150\155\55\141\x74\164\162\151\x62\165\x74\145\x20\157\x6e\x20\x53\x69\x67\x6e\141\164\x75\162\x65\x4d\145\164\150\x6f\x64\40\x65\x6c\145\155\x65\156\x74\56");
        exit;
        C8:
        $VI = $hp->getAttribute("\101\154\147\157\x72\x69\164\x68\x6d");
        if (!($UV->type === XMLSecurityKey::RSA_SHA256 && $VI !== $UV->type)) {
            goto Vc;
        }
        $UV = self::castKey($UV, $VI);
        Vc:
        if ($PW->verify($UV)) {
            goto pp;
        }
        echo sprintf("\x55\x6e\x61\142\154\x65\40\x74\157\x20\166\141\154\x69\144\141\164\x65\x20\x53\147\156\141\x74\x75\162\x65");
        exit;
        pp:
    }
    public static function castKey(XMLSecurityKey $UV, $Kv, $p8 = "\160\x75\142\x6c\x69\143")
    {
        if (!($UV->type === $Kv)) {
            goto oC;
        }
        return $UV;
        oC:
        $aR = openssl_pkey_get_details($UV->key);
        if (!($aR === FALSE)) {
            goto xh;
        }
        echo sprintf("\125\x6e\x61\142\x6c\145\40\164\x6f\40\x67\x65\x74\x20\x6b\x65\x79\40\144\145\164\x61\151\x6c\163\x20\x66\x72\157\x6d\x20\x58\x4d\x4c\x53\x65\143\165\x72\x69\164\x79\113\145\x79\x2e");
        exit;
        xh:
        if (isset($aR["\x6b\145\171"])) {
            goto jr;
        }
        echo sprintf("\x4d\151\163\x73\x69\156\x67\x20\153\145\x79\40\x69\x6e\x20\160\x75\142\154\151\143\40\x6b\x65\171\x20\144\x65\x74\x61\x69\x6c\x73\56");
        exit;
        jr:
        $M8 = new XMLSecurityKey($Kv, array("\164\x79\160\145" => $p8));
        $M8->loadKey($aR["\x6b\145\x79"]);
        return $M8;
    }
    public static function processRequest($jE, $FL)
    {
        $Hr = self::checkSign($jE, $FL);
        return $Hr;
    }
    public static function checkSign($jE, $FL)
    {
        $JX = $FL["\103\145\162\x74\x69\x66\151\143\x61\x74\x65\x73"];
        if (!(count($JX) === 0)) {
            goto tR;
        }
        return FALSE;
        tR:
        $f7 = array();
        $f7[] = $jE;
        $xY = self::findCertificate($f7, $JX);
        $GL = NULL;
        $UV = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, array("\164\171\160\145" => "\160\165\142\x6c\151\143"));
        $UV->loadKey($xY);
        try {
            self::validateSignature($FL, $UV);
            return TRUE;
        } catch (Exception $zU) {
            $GL = $zU;
        }
        if ($GL !== NULL) {
            goto ra;
        }
        return FALSE;
        goto oe;
        ra:
        throw $GL;
        oe:
    }
    private static function findCertificate(array $Qk, array $JX)
    {
        $GD = array();
        foreach ($JX as $lI) {
            $LQ = strtolower(sha1(base64_decode($lI)));
            if (in_array($LQ, $Qk, TRUE)) {
                goto XC;
            }
            $GD[] = $LQ;
            goto An;
            XC:
            $W7 = "\x2d\x2d\55\x2d\x2d\x42\105\107\111\x4e\40\103\x45\x52\x54\x49\106\111\x43\101\124\105\x2d\55\x2d\55\55\xa" . chunk_split($lI, 64) . "\x2d\55\55\55\x2d\105\x4e\104\x20\x43\x45\122\x54\x49\x46\x49\103\101\x54\x45\55\55\55\55\x2d\12";
            return $W7;
            An:
        }
        F9:
        echo sprintf("\125\156\x61\142\154\x65\40\164\x6f\40\x66\x69\156\144\40\x61\x20\143\145\x72\x74\x69\146\151\x63\x61\x74\x65\40\155\x61\164\143\150\151\x6e\147\40\x74\x68\145\40\x63\157\156\146\x69\147\x75\x72\x65\x64\x20\x66\x69\x6e\x67\145\x72\160\x72\151\x6e\x74\x2e");
        exit;
    }
    public static function parseBoolean(\DOMElement $jb, $vk, $Yl = null)
    {
        if ($jb->hasAttribute($vk)) {
            goto jX;
        }
        return $Yl;
        jX:
        $Ev = $jb->getAttribute($vk);
        switch (strtolower($Ev)) {
            case "\60":
            case "\x66\x61\x6c\163\145":
                return false;
            case "\61":
            case "\164\162\165\145":
                return true;
            default:
                throw new \Exception("\x49\x6e\166\x61\x6c\x69\x64\40\x76\141\x6c\x75\145\x20\157\x66\x20\x62\x6f\x6f\154\x65\x61\156\x20\141\x74\x74\162\x69\x62\165\x74\145\40" . var_export($vk, true) . "\x3a\40" . var_export($Ev, true));
        }
        m1:
        QU:
    }
    public static function insertSignature(XMLSecurityKey $UV, array $JX, \DOMElement $BT, \DomNode $OV = NULL)
    {
        $PW = new XMLSecurityDSig();
        $PW->setCanonicalMethod(XMLSecurityDSig::EXC_C14N);
        switch ($UV->type) {
            case XMLSecurityKey::RSA_SHA256:
                $p8 = XMLSecurityDSig::SHA256;
                goto Fe;
            case XMLSecurityKey::RSA_SHA384:
                $p8 = XMLSecurityDSig::SHA384;
                goto Fe;
            case XMLSecurityKey::RSA_SHA512:
                $p8 = XMLSecurityDSig::SHA512;
                goto Fe;
            default:
                $p8 = XMLSecurityDSig::SHA1;
        }
        JN:
        Fe:
        $PW->addReferenceList(array($BT), $p8, array("\150\164\x74\x70\72\57\x2f\x77\167\167\56\167\x33\56\x6f\x72\x67\57\x32\60\60\60\x2f\60\x39\57\170\155\x6c\144\163\151\147\43\145\156\x76\145\x6c\157\160\x65\144\x2d\x73\x69\x67\x6e\141\164\x75\x72\145", XMLSecurityDSig::EXC_C14N), array("\x69\x64\x5f\156\141\155\145" => "\x49\x44", "\x6f\166\x65\x72\x77\x72\151\164\x65" => FALSE));
        $PW->sign($UV);
        foreach ($JX as $I3) {
            $PW->add509Cert($I3, TRUE);
            r1:
        }
        Gt:
        $PW->insertSignature($BT, $OV);
    }
    public static function signXML($Wp, $lR, $vw, $yG = '')
    {
        $LF = array("\x74\171\x70\145" => "\160\x72\x69\166\x61\164\x65");
        $UV = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, $LF);
        $UV->loadKey($vw, TRUE);
        $B3 = file_get_contents($lR);
        $BG = new \DOMDocument();
        $BG->loadXML($Wp);
        $dx = $BG->firstChild;
        if (!empty($yG)) {
            goto xs;
        }
        self::insertSignature($UV, array($B3), $dx);
        goto RI;
        xs:
        $ZI = $BG->getElementsByTagName($yG)->item(0);
        self::insertSignature($UV, array($B3), $dx, $ZI);
        RI:
        $p2 = $dx->ownerDocument->saveXML($dx);
        if (!MSI_DEBUG) {
            goto fF;
        }
        MoIDPUtility::mo_debug("\x4c\x6f\x67\157\x75\164\40\122\145\x73\x70\x6f\x6e\163\145\x20\107\145\156\x65\x72\x61\x74\x65\144\72" . $p2);
        fF:
        return $p2;
    }
    public static function getEncryptionAlgorithm($pP)
    {
        switch ($pP) {
            case "\150\x74\164\x70\x3a\x2f\57\x77\167\x77\56\167\63\56\x6f\162\x67\57\x32\60\60\x31\x2f\x30\x34\57\170\x6d\154\145\156\143\43\x74\x72\x69\160\x6c\145\x64\x65\163\55\x63\142\x63":
                return XMLSecurityKey::TRIPLEDES_CBC;
                goto zN;
            case "\150\164\164\x70\72\57\x2f\x77\167\x77\56\167\x33\56\157\x72\147\57\62\60\60\61\57\x30\x34\x2f\170\155\154\x65\x6e\x63\43\x61\145\163\61\x32\70\x2d\143\x62\143":
                return XMLSecurityKey::AES128_CBC;
            case "\x68\164\164\x70\x3a\57\57\167\x77\167\56\x77\63\x2e\157\x72\x67\x2f\x32\x30\x30\61\57\x30\64\57\170\155\x6c\x65\156\143\x23\141\x65\x73\x31\71\62\55\143\142\x63":
                return XMLSecurityKey::AES192_CBC;
                goto zN;
            case "\x68\x74\x74\x70\x3a\57\57\x77\x77\167\56\167\x33\x2e\157\x72\x67\57\62\x30\x30\61\x2f\x30\x34\57\170\155\x6c\x65\156\x63\43\141\145\163\62\x35\x36\55\143\142\x63":
                return XMLSecurityKey::AES256_CBC;
                goto zN;
            case "\x68\164\x74\160\x3a\x2f\x2f\167\167\x77\56\167\63\x2e\x6f\162\x67\x2f\x32\x30\x30\61\x2f\x30\64\57\170\x6d\x6c\145\x6e\x63\x23\162\x73\141\x2d\x31\137\x35":
                return XMLSecurityKey::RSA_1_5;
                goto zN;
            case "\x68\x74\x74\160\72\x2f\57\x77\167\167\56\x77\x33\56\x6f\162\147\57\62\60\x30\61\57\60\x34\57\170\x6d\x6c\x65\x6e\x63\43\162\x73\141\x2d\157\x61\x65\x70\55\x6d\147\x66\61\x70":
                return XMLSecurityKey::RSA_OAEP_MGF1P;
                goto zN;
            case "\150\164\164\160\72\x2f\x2f\167\167\x77\56\167\63\56\x6f\x72\x67\57\x32\x30\x30\60\x2f\60\71\x2f\170\x6d\154\x64\x73\x69\x67\x23\144\163\141\55\163\150\141\61":
                return XMLSecurityKey::DSA_SHA1;
                goto zN;
            case "\x68\164\x74\x70\72\57\x2f\x77\x77\167\x2e\x77\x33\56\157\x72\147\x2f\62\x30\60\60\x2f\60\x39\x2f\x78\x6d\154\144\x73\x69\147\43\x72\x73\141\55\163\x68\x61\61":
                return XMLSecurityKey::RSA_SHA1;
                goto zN;
            case "\150\164\x74\x70\72\x2f\57\x77\x77\x77\56\167\63\56\157\x72\x67\x2f\62\x30\x30\x31\57\x30\64\57\170\155\x6c\144\x73\151\147\x2d\155\157\162\145\43\x72\x73\x61\x2d\163\150\141\x32\65\66":
                return XMLSecurityKey::RSA_SHA256;
                goto zN;
            case "\x68\164\x74\x70\x3a\57\57\x77\x77\167\x2e\167\x33\56\x6f\162\147\57\62\x30\60\61\57\60\x34\57\170\x6d\154\144\x73\151\147\x2d\x6d\x6f\162\145\43\162\163\x61\55\163\150\x61\63\70\x34":
                return XMLSecurityKey::RSA_SHA384;
                goto zN;
            case "\x68\x74\x74\160\72\57\x2f\x77\x77\x77\x2e\167\63\x2e\x6f\162\x67\57\x32\60\60\61\57\x30\64\x2f\x78\155\154\x64\163\151\147\55\155\x6f\x72\145\43\162\163\x61\x2d\163\x68\141\x35\61\x32":
                return XMLSecurityKey::RSA_SHA512;
                goto zN;
            default:
                echo sprintf("\111\x6e\x76\141\154\151\x64\40\x45\x6e\x63\x72\x79\x70\164\x69\x6f\x6e\40\115\145\164\150\x6f\x64\72\40" . $pP);
                exit;
                goto zN;
        }
        iY:
        zN:
    }
    public static function sanitize_certificate($I3)
    {
        $I3 = preg_replace("\x2f\x5b\xd\xa\135\53\57", '', $I3);
        $I3 = str_replace("\x2d", '', $I3);
        $I3 = str_replace("\x42\105\x47\x49\x4e\40\103\x45\122\x54\111\x46\x49\x43\x41\124\105", '', $I3);
        $I3 = str_replace("\x45\116\104\x20\103\105\x52\x54\111\106\111\x43\x41\124\x45", '', $I3);
        $I3 = str_replace("\40", '', $I3);
        $I3 = chunk_split($I3, 64, "\15\12");
        $I3 = "\x2d\x2d\x2d\x2d\55\102\105\107\x49\x4e\40\103\105\x52\124\x49\x46\x49\x43\101\124\105\x2d\55\x2d\55\55\xd\12" . $I3 . "\x2d\x2d\x2d\55\x2d\105\x4e\x44\x20\x43\105\x52\124\x49\106\x49\x43\x41\124\105\x2d\55\x2d\55\x2d";
        return $I3;
    }
    public static function desanitize_certificate($I3)
    {
        $I3 = preg_replace("\x2f\133\15\xa\135\x2b\57", '', $I3);
        $I3 = str_replace("\x2d\x2d\55\55\55\x42\x45\x47\x49\116\40\103\105\122\124\x49\106\111\103\x41\124\x45\55\55\55\x2d\55", '', $I3);
        $I3 = str_replace("\55\55\x2d\x2d\x2d\105\x4e\104\x20\x43\x45\122\124\111\106\x49\103\x41\x54\105\55\x2d\x2d\55\55", '', $I3);
        $I3 = str_replace("\x20", '', $I3);
        return $I3;
    }
}
