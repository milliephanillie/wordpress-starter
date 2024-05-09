<?php


namespace RobRichards\XMLSecLibs;

use DOMDocument;
use DOMElement;
use DOMNode;
use DOMXPath;
use Exception;
use RobRichards\XMLSecLibs\Utils\XPath as XPath;
class XMLSecurityDSig
{
    const XMLDSIGNS = "\x68\164\164\x70\72\x2f\x2f\x77\x77\x77\x2e\167\x33\56\x6f\162\147\57\62\x30\x30\x30\x2f\x30\x39\57\170\x6d\x6c\144\163\x69\147\43";
    const SHA1 = "\x68\x74\x74\160\72\x2f\57\167\167\x77\56\167\x33\x2e\x6f\x72\x67\57\62\60\x30\x30\57\x30\71\57\170\155\x6c\x64\163\x69\x67\43\x73\150\x61\61";
    const SHA256 = "\150\x74\164\160\x3a\x2f\x2f\167\167\x77\x2e\167\63\x2e\157\162\147\57\x32\x30\x30\61\57\60\x34\x2f\x78\155\x6c\x65\x6e\x63\x23\163\150\141\x32\65\x36";
    const SHA384 = "\x68\164\x74\x70\72\57\57\167\167\167\56\167\63\56\157\162\x67\57\x32\x30\x30\x31\57\60\x34\x2f\x78\155\x6c\x64\163\151\147\x2d\155\x6f\x72\145\x23\163\x68\141\x33\x38\x34";
    const SHA512 = "\150\164\164\160\x3a\57\x2f\x77\167\x77\x2e\167\x33\56\x6f\162\147\57\62\60\x30\61\57\x30\x34\57\x78\155\x6c\145\x6e\x63\x23\x73\150\x61\65\61\x32";
    const RIPEMD160 = "\x68\164\x74\160\x3a\57\x2f\167\x77\167\56\x77\x33\56\157\x72\147\x2f\x32\x30\x30\61\57\60\x34\57\x78\155\154\x65\156\143\43\162\x69\x70\x65\x6d\x64\61\66\x30";
    const C14N = "\x68\164\164\x70\72\57\x2f\x77\x77\167\56\167\63\x2e\x6f\x72\147\x2f\124\122\57\x32\60\60\x31\x2f\122\105\103\55\x78\x6d\154\55\143\x31\64\156\55\62\x30\x30\x31\60\x33\x31\x35";
    const C14N_COMMENTS = "\x68\164\x74\x70\72\57\57\x77\x77\x77\56\x77\63\x2e\x6f\162\147\x2f\124\x52\57\62\x30\x30\x31\57\x52\105\103\55\x78\x6d\x6c\x2d\x63\x31\64\x6e\x2d\62\60\x30\61\x30\63\61\65\43\x57\151\x74\x68\103\x6f\155\155\145\156\164\163";
    const EXC_C14N = "\150\164\164\160\72\57\x2f\x77\x77\167\56\167\63\x2e\x6f\162\147\57\62\x30\x30\x31\57\x31\x30\x2f\170\x6d\x6c\55\x65\x78\143\55\143\61\64\156\43";
    const EXC_C14N_COMMENTS = "\150\164\x74\x70\72\x2f\x2f\167\167\167\56\167\63\x2e\157\x72\147\57\x32\60\x30\x31\x2f\x31\60\57\170\155\x6c\x2d\145\170\x63\55\x63\x31\64\156\43\127\x69\x74\x68\103\x6f\x6d\155\145\156\164\163";
    const template = "\74\x64\x73\72\123\x69\x67\x6e\141\164\165\x72\145\x20\170\155\154\x6e\163\72\x64\x73\75\42\150\x74\x74\x70\72\x2f\57\167\x77\x77\x2e\167\63\56\x6f\162\x67\x2f\x32\x30\x30\60\57\x30\x39\57\170\155\154\144\x73\151\x67\x23\x22\76\12\40\40\x3c\144\163\x3a\x53\151\x67\x6e\145\144\111\x6e\x66\157\x3e\xa\40\x20\40\40\74\144\163\x3a\x53\151\x67\156\141\164\165\162\145\115\x65\x74\150\157\x64\40\57\x3e\xa\40\40\74\57\x64\163\72\x53\151\147\x6e\x65\144\111\x6e\146\x6f\76\12\74\x2f\x64\163\72\x53\x69\x67\x6e\141\164\x75\162\x65\x3e";
    const BASE_TEMPLATE = "\74\123\151\147\156\x61\x74\x75\x72\x65\x20\x78\x6d\x6c\156\163\x3d\42\150\x74\164\160\x3a\x2f\57\x77\167\167\56\167\63\x2e\x6f\x72\147\x2f\x32\x30\60\x30\57\x30\71\57\170\x6d\154\144\163\151\147\43\x22\x3e\xa\40\x20\x3c\123\151\x67\156\145\144\x49\156\x66\157\x3e\xa\40\40\x20\x20\74\123\x69\x67\x6e\x61\164\x75\x72\x65\115\x65\x74\x68\x6f\144\40\57\76\12\40\x20\x3c\57\x53\x69\147\x6e\x65\144\111\156\146\x6f\76\12\x3c\x2f\x53\151\x67\156\x61\x74\165\x72\x65\x3e";
    public $sigNode = null;
    public $idKeys = array();
    public $idNS = array();
    private $signedInfo = null;
    private $xPathCtx = null;
    private $canonicalMethod = null;
    private $prefix = '';
    private $searchpfx = "\163\x65\x63\144\x73\x69\x67";
    private $validatedNodes = null;
    public function __construct($t1 = "\x64\163")
    {
        $JH = self::BASE_TEMPLATE;
        if (empty($t1)) {
            goto Xf;
        }
        $this->prefix = $t1 . "\72";
        $lK = array("\x3c\x53", "\x3c\x2f\123", "\170\155\154\x6e\x73\x3d");
        $MP = array("\x3c{$t1}\72\x53", "\74\x2f{$t1}\72\x53", "\x78\x6d\x6c\156\x73\72{$t1}\75");
        $JH = str_replace($lK, $MP, $JH);
        Xf:
        $DW = new DOMDocument();
        $DW->loadXML($JH);
        $this->sigNode = $DW->documentElement;
    }
    private function resetXPathObj()
    {
        $this->xPathCtx = null;
    }
    private function getXPathObj()
    {
        if (!(empty($this->xPathCtx) && !empty($this->sigNode))) {
            goto nM;
        }
        $tR = new DOMXPath($this->sigNode->ownerDocument);
        $tR->registerNamespace("\x73\145\143\144\163\x69\x67", self::XMLDSIGNS);
        $this->xPathCtx = $tR;
        nM:
        return $this->xPathCtx;
    }
    public static function generateGUID($t1 = "\160\146\170")
    {
        $PH = md5(uniqid(mt_rand(), true));
        $nt = $t1 . substr($PH, 0, 8) . "\55" . substr($PH, 8, 4) . "\x2d" . substr($PH, 12, 4) . "\55" . substr($PH, 16, 4) . "\x2d" . substr($PH, 20, 12);
        return $nt;
    }
    public static function generate_GUID($t1 = "\160\146\x78")
    {
        return self::generateGUID($t1);
    }
    public function locateSignature($S2, $Vz = 0)
    {
        if ($S2 instanceof DOMDocument) {
            goto dT;
        }
        $QP = $S2->ownerDocument;
        goto ea;
        dT:
        $QP = $S2;
        ea:
        if (!$QP) {
            goto pC;
        }
        $tR = new DOMXPath($QP);
        $tR->registerNamespace("\x73\x65\143\144\163\151\x67", self::XMLDSIGNS);
        $PU = "\x2e\x2f\57\x73\x65\143\x64\x73\x69\x67\72\123\x69\147\156\x61\x74\x75\x72\145";
        $bi = $tR->query($PU, $S2);
        $this->sigNode = $bi->item($Vz);
        $PU = "\x2e\x2f\163\x65\143\144\x73\x69\147\x3a\123\151\x67\x6e\x65\x64\111\x6e\146\157";
        $bi = $tR->query($PU, $this->sigNode);
        if (!($bi->length > 1)) {
            goto fY;
        }
        throw new Exception("\x49\x6e\x76\x61\154\x69\144\40\163\x74\x72\165\143\164\165\x72\x65\x20\55\x20\124\x6f\157\x20\155\141\156\x79\x20\123\151\147\156\145\x64\111\x6e\146\157\x20\145\x6c\145\x6d\145\x6e\164\x73\x20\146\x6f\x75\x6e\144");
        fY:
        return $this->sigNode;
        pC:
        return null;
    }
    public function createNewSignNode($Zp, $Ev = null)
    {
        $QP = $this->sigNode->ownerDocument;
        if (!is_null($Ev)) {
            goto KH;
        }
        $jb = $QP->createElementNS(self::XMLDSIGNS, $this->prefix . $Zp);
        goto zk;
        KH:
        $jb = $QP->createElementNS(self::XMLDSIGNS, $this->prefix . $Zp, $Ev);
        zk:
        return $jb;
    }
    public function setCanonicalMethod($pP)
    {
        switch ($pP) {
            case "\150\x74\164\160\x3a\x2f\x2f\x77\167\x77\56\167\63\x2e\x6f\162\147\57\x54\122\x2f\x32\60\60\x31\x2f\122\x45\x43\55\x78\155\154\x2d\x63\61\x34\156\55\x32\60\x30\x31\60\x33\x31\65":
            case "\x68\x74\x74\160\72\57\x2f\167\167\167\56\167\x33\56\x6f\162\x67\x2f\x54\x52\x2f\x32\x30\60\x31\57\x52\x45\103\55\170\155\154\x2d\143\x31\x34\156\x2d\62\x30\x30\61\x30\63\61\65\43\127\151\164\150\103\157\155\x6d\145\x6e\x74\x73":
            case "\150\x74\164\160\72\57\x2f\167\167\x77\x2e\x77\63\56\x6f\162\x67\x2f\62\60\60\x31\x2f\x31\60\57\x78\x6d\x6c\55\x65\x78\x63\55\143\61\64\x6e\43":
            case "\x68\x74\164\x70\x3a\x2f\x2f\167\167\167\56\167\x33\56\x6f\162\x67\x2f\x32\x30\x30\x31\x2f\x31\x30\x2f\170\x6d\x6c\55\x65\170\143\x2d\x63\x31\64\x6e\43\127\151\164\x68\x43\157\155\x6d\x65\156\x74\x73":
                $this->canonicalMethod = $pP;
                goto zQ;
            default:
                throw new Exception("\x49\x6e\x76\141\154\x69\x64\x20\103\x61\x6e\157\x6e\151\x63\141\154\x20\x4d\145\164\x68\157\x64");
        }
        jk:
        zQ:
        if (!($tR = $this->getXPathObj())) {
            goto NI;
        }
        $PU = "\x2e\57" . $this->searchpfx . "\72\123\151\147\x6e\x65\144\x49\x6e\x66\x6f";
        $bi = $tR->query($PU, $this->sigNode);
        if (!($yz = $bi->item(0))) {
            goto hl;
        }
        $PU = "\56\x2f" . $this->searchpfx . "\x43\141\156\x6f\156\151\143\x61\154\x69\172\141\x74\x69\157\156\x4d\145\x74\150\x6f\144";
        $bi = $tR->query($PU, $yz);
        if ($aQ = $bi->item(0)) {
            goto aA;
        }
        $aQ = $this->createNewSignNode("\103\141\x6e\157\156\151\x63\141\x6c\151\172\141\164\151\x6f\156\115\x65\164\150\157\x64");
        $yz->insertBefore($aQ, $yz->firstChild);
        aA:
        $aQ->setAttribute("\101\x6c\x67\157\162\151\x74\150\155", $this->canonicalMethod);
        hl:
        NI:
    }
    private function canonicalizeData($jb, $z2, $Fu = null, $qd = null)
    {
        $gt = false;
        $I4 = false;
        switch ($z2) {
            case "\x68\x74\164\x70\x3a\57\57\x77\167\167\56\167\63\x2e\x6f\x72\147\57\x54\x52\x2f\62\x30\60\61\x2f\x52\105\103\x2d\170\x6d\x6c\x2d\143\x31\x34\156\55\62\60\60\61\x30\63\61\x35":
                $gt = false;
                $I4 = false;
                goto p7;
            case "\150\x74\x74\x70\x3a\x2f\57\167\x77\167\x2e\x77\x33\56\157\x72\x67\x2f\x54\x52\x2f\x32\x30\60\x31\57\122\105\x43\x2d\x78\x6d\x6c\55\143\x31\64\x6e\55\62\60\x30\x31\x30\x33\61\65\43\127\151\x74\150\x43\x6f\155\x6d\145\156\164\163":
                $I4 = true;
                goto p7;
            case "\150\164\x74\x70\72\57\x2f\x77\167\167\56\167\x33\56\x6f\x72\147\x2f\x32\x30\60\61\57\61\x30\57\170\x6d\x6c\x2d\145\x78\143\x2d\x63\61\x34\156\x23":
                $gt = true;
                goto p7;
            case "\x68\164\164\160\72\x2f\x2f\x77\167\x77\56\167\63\x2e\x6f\x72\x67\x2f\x32\x30\60\x31\57\61\x30\x2f\x78\x6d\154\55\x65\170\143\55\x63\x31\64\156\43\127\x69\x74\150\x43\157\155\155\145\x6e\x74\163":
                $gt = true;
                $I4 = true;
                goto p7;
        }
        mg:
        p7:
        if (!(is_null($Fu) && $jb instanceof DOMNode && $jb->ownerDocument !== null && $jb->isSameNode($jb->ownerDocument->documentElement))) {
            goto mm;
        }
        $dx = $jb;
        KC:
        if (!($uC = $dx->previousSibling)) {
            goto rp;
        }
        if (!($uC->nodeType == XML_PI_NODE || $uC->nodeType == XML_COMMENT_NODE && $I4)) {
            goto ut;
        }
        goto rp;
        ut:
        $dx = $uC;
        goto KC;
        rp:
        if (!($uC == null)) {
            goto M4;
        }
        $jb = $jb->ownerDocument;
        M4:
        mm:
        return $jb->C14N($gt, $I4, $Fu, $qd);
    }
    public function canonicalizeSignedInfo()
    {
        $QP = $this->sigNode->ownerDocument;
        $z2 = null;
        if (!$QP) {
            goto nF;
        }
        $tR = $this->getXPathObj();
        $PU = "\x2e\57\163\x65\x63\144\163\x69\x67\72\123\x69\147\156\145\144\x49\x6e\146\157";
        $bi = $tR->query($PU, $this->sigNode);
        if (!($bi->length > 1)) {
            goto qW;
        }
        throw new Exception("\111\x6e\x76\141\x6c\151\144\x20\163\164\162\x75\x63\164\x75\x72\x65\x20\x2d\x20\x54\x6f\157\x20\x6d\141\156\171\40\x53\x69\x67\156\x65\x64\x49\x6e\146\x6f\x20\145\154\145\x6d\x65\x6e\164\163\40\x66\157\165\x6e\x64");
        qW:
        if (!($mf = $bi->item(0))) {
            goto Qt;
        }
        $PU = "\x2e\x2f\x73\145\143\144\x73\x69\147\72\x43\141\x6e\157\156\151\143\x61\x6c\151\x7a\141\164\x69\x6f\x6e\x4d\145\164\150\x6f\144";
        $bi = $tR->query($PU, $mf);
        $qd = null;
        if (!($aQ = $bi->item(0))) {
            goto p1;
        }
        $z2 = $aQ->getAttribute("\101\154\x67\157\x72\x69\x74\x68\155");
        foreach ($aQ->childNodes as $jb) {
            if (!($jb->localName == "\111\156\x63\x6c\x75\163\151\166\x65\116\x61\x6d\x65\163\160\x61\x63\x65\163")) {
                goto O9;
            }
            if (!($wU = $jb->getAttribute("\x50\162\145\x66\151\x78\114\151\163\164"))) {
                goto dN;
            }
            $Fp = array_filter(explode("\x20", $wU));
            if (!(count($Fp) > 0)) {
                goto Tl;
            }
            $qd = array_merge($qd ? $qd : array(), $Fp);
            Tl:
            dN:
            O9:
            fA:
        }
        gr:
        p1:
        $this->signedInfo = $this->canonicalizeData($mf, $z2, null, $qd);
        return $this->signedInfo;
        Qt:
        nF:
        return null;
    }
    public function calculateDigest($Ez, $jX, $bc = true)
    {
        switch ($Ez) {
            case self::SHA1:
                $uM = "\163\x68\141\61";
                goto iK;
            case self::SHA256:
                $uM = "\163\x68\x61\62\65\66";
                goto iK;
            case self::SHA384:
                $uM = "\x73\150\x61\63\70\x34";
                goto iK;
            case self::SHA512:
                $uM = "\x73\x68\x61\65\x31\62";
                goto iK;
            case self::RIPEMD160:
                $uM = "\162\151\160\145\x6d\144\61\x36\x30";
                goto iK;
            default:
                throw new Exception("\x43\141\156\156\157\164\40\x76\x61\154\151\x64\141\x74\145\40\144\151\x67\x65\163\164\x3a\40\x55\156\x73\x75\160\160\157\162\164\145\144\x20\101\154\x67\157\162\151\x74\x68\155\x20\x3c{$Ez}\76");
        }
        px:
        iK:
        $VP = hash($uM, $jX, true);
        if (!$bc) {
            goto aH;
        }
        $VP = base64_encode($VP);
        aH:
        return $VP;
    }
    public function validateDigest($G9, $jX)
    {
        $tR = new DOMXPath($G9->ownerDocument);
        $tR->registerNamespace("\163\145\x63\x64\163\x69\147", self::XMLDSIGNS);
        $PU = "\x73\164\162\151\x6e\147\x28\56\57\163\145\143\x64\x73\151\147\x3a\x44\151\147\x65\163\x74\115\145\164\150\157\x64\57\100\101\154\x67\x6f\x72\151\x74\x68\155\x29";
        $Ez = $tR->evaluate($PU, $G9);
        $C3 = $this->calculateDigest($Ez, $jX, false);
        $PU = "\163\x74\x72\x69\x6e\x67\x28\x2e\x2f\x73\145\x63\144\x73\x69\x67\72\104\151\147\x65\x73\x74\x56\141\x6c\165\145\x29";
        $sV = $tR->evaluate($PU, $G9);
        return $C3 === base64_decode($sV);
    }
    public function processTransforms($G9, $Zx, $Yc = true)
    {
        $jX = $Zx;
        $tR = new DOMXPath($G9->ownerDocument);
        $tR->registerNamespace("\163\145\143\x64\x73\151\x67", self::XMLDSIGNS);
        $PU = "\x2e\x2f\163\x65\143\144\163\151\x67\x3a\124\162\141\156\163\x66\157\162\x6d\x73\57\163\x65\143\x64\163\x69\x67\x3a\124\162\141\156\163\x66\x6f\x72\155";
        $g_ = $tR->query($PU, $G9);
        $Kh = "\x68\164\x74\x70\x3a\57\57\x77\167\x77\x2e\167\63\x2e\x6f\x72\x67\x2f\124\122\57\x32\60\x30\61\57\122\105\x43\55\x78\155\x6c\x2d\143\61\x34\x6e\55\62\x30\x30\x31\x30\x33\61\65";
        $Fu = null;
        $qd = null;
        foreach ($g_ as $gB) {
            $Kv = $gB->getAttribute("\101\154\x67\157\162\151\x74\150\155");
            switch ($Kv) {
                case "\150\164\164\x70\72\x2f\57\x77\167\x77\56\167\63\56\157\x72\147\x2f\x32\x30\x30\61\x2f\61\60\57\x78\155\154\x2d\145\170\x63\55\143\61\x34\x6e\43":
                case "\150\164\x74\160\x3a\57\57\167\x77\167\x2e\167\63\x2e\x6f\162\x67\57\x32\60\60\x31\x2f\x31\x30\57\170\155\154\x2d\x65\170\143\55\x63\61\x34\x6e\x23\127\x69\x74\150\103\x6f\x6d\x6d\145\x6e\x74\163":
                    if (!$Yc) {
                        goto ZF;
                    }
                    $Kh = $Kv;
                    goto rO;
                    ZF:
                    $Kh = "\150\164\x74\160\72\57\x2f\x77\167\167\56\x77\x33\56\x6f\162\147\x2f\62\x30\x30\x31\x2f\61\x30\x2f\x78\155\x6c\55\x65\x78\143\55\x63\61\64\156\43";
                    rO:
                    $jb = $gB->firstChild;
                    zp:
                    if (!$jb) {
                        goto J8;
                    }
                    if (!($jb->localName == "\x49\156\x63\154\x75\163\151\x76\x65\116\x61\x6d\145\163\x70\141\x63\145\x73")) {
                        goto DM;
                    }
                    if (!($wU = $jb->getAttribute("\120\162\145\x66\x69\170\114\x69\163\x74"))) {
                        goto eI;
                    }
                    $Fp = array();
                    $Ub = explode("\40", $wU);
                    foreach ($Ub as $wU) {
                        $ak = trim($wU);
                        if (empty($ak)) {
                            goto tq;
                        }
                        $Fp[] = $ak;
                        tq:
                        Ho:
                    }
                    GY:
                    if (!(count($Fp) > 0)) {
                        goto XS;
                    }
                    $qd = $Fp;
                    XS:
                    eI:
                    goto J8;
                    DM:
                    $jb = $jb->nextSibling;
                    goto zp;
                    J8:
                    goto s7;
                case "\150\164\164\160\x3a\x2f\57\167\167\x77\x2e\x77\63\56\x6f\162\x67\57\x54\x52\x2f\62\x30\60\61\57\122\x45\103\55\170\155\154\55\143\61\64\x6e\x2d\62\x30\x30\x31\60\63\x31\65":
                case "\x68\x74\164\160\x3a\57\x2f\167\x77\x77\56\167\x33\x2e\x6f\x72\147\x2f\124\122\57\x32\60\60\61\57\122\x45\x43\55\170\155\x6c\55\143\x31\x34\x6e\x2d\62\x30\60\61\x30\63\x31\65\x23\x57\151\164\150\x43\157\155\x6d\145\156\164\163":
                    if (!$Yc) {
                        goto Cj;
                    }
                    $Kh = $Kv;
                    goto Ir;
                    Cj:
                    $Kh = "\x68\x74\x74\x70\72\x2f\57\167\167\x77\56\x77\x33\56\x6f\x72\147\57\x54\122\x2f\x32\x30\60\61\x2f\122\x45\x43\x2d\x78\x6d\x6c\x2d\143\x31\64\x6e\x2d\62\60\x30\61\x30\x33\x31\65";
                    Ir:
                    goto s7;
                case "\150\x74\x74\160\x3a\57\57\167\167\x77\56\x77\63\x2e\x6f\162\147\x2f\124\122\57\x31\x39\71\x39\x2f\122\105\x43\55\170\x70\x61\164\x68\x2d\61\x39\71\71\61\61\61\x36":
                    $jb = $gB->firstChild;
                    q1:
                    if (!$jb) {
                        goto xk;
                    }
                    if (!($jb->localName == "\x58\120\141\x74\150")) {
                        goto Sy;
                    }
                    $Fu = array();
                    $Fu["\x71\165\x65\162\171"] = "\x28\x2e\x2f\57\x2e\x20\x7c\x20\x2e\x2f\x2f\100\52\x20\x7c\x20\x2e\x2f\57\156\141\155\145\x73\x70\x61\x63\x65\x3a\x3a\52\51\133" . $jb->nodeValue . "\135";
                    $Fu["\156\x61\x6d\x65\x73\160\141\143\x65\x73"] = array();
                    $DG = $tR->query("\56\57\156\x61\x6d\145\x73\160\141\143\145\72\x3a\52", $jb);
                    foreach ($DG as $io) {
                        if (!($io->localName != "\170\155\154")) {
                            goto SL;
                        }
                        $Fu["\156\141\155\145\163\160\x61\x63\x65\x73"][$io->localName] = $io->nodeValue;
                        SL:
                        SZ:
                    }
                    jS:
                    goto xk;
                    Sy:
                    $jb = $jb->nextSibling;
                    goto q1;
                    xk:
                    goto s7;
            }
            Fr:
            s7:
            Ot:
        }
        DW:
        if (!$jX instanceof DOMNode) {
            goto sx;
        }
        $jX = $this->canonicalizeData($Zx, $Kh, $Fu, $qd);
        sx:
        return $jX;
    }
    public function processRefNode($G9)
    {
        $Q_ = null;
        $Yc = true;
        if ($vZ = $G9->getAttribute("\125\x52\111")) {
            goto Jv;
        }
        $Yc = false;
        $Q_ = $G9->ownerDocument;
        goto k1;
        Jv:
        $M7 = parse_url($vZ);
        if (!empty($M7["\160\x61\164\x68"])) {
            goto ml;
        }
        if ($kV = $M7["\146\x72\141\x67\x6d\x65\x6e\164"]) {
            goto HP;
        }
        $Q_ = $G9->ownerDocument;
        goto ep;
        HP:
        $Yc = false;
        $An = new DOMXPath($G9->ownerDocument);
        if (!($this->idNS && is_array($this->idNS))) {
            goto tl;
        }
        foreach ($this->idNS as $c0 => $wk) {
            $An->registerNamespace($c0, $wk);
            DT:
        }
        wO:
        tl:
        $Qp = "\x40\111\144\x3d\42" . XPath::filterAttrValue($kV, XPath::DOUBLE_QUOTE) . "\x22";
        if (!is_array($this->idKeys)) {
            goto vA;
        }
        foreach ($this->idKeys as $UP) {
            $Qp .= "\x20\157\162\x20\x40" . XPath::filterAttrName($UP) . "\x3d\x22" . XPath::filterAttrValue($kV, XPath::DOUBLE_QUOTE) . "\42";
            T5:
        }
        Kl:
        vA:
        $PU = "\x2f\x2f\x2a\133" . $Qp . "\x5d";
        $Q_ = $An->query($PU)->item(0);
        ep:
        ml:
        k1:
        $jX = $this->processTransforms($G9, $Q_, $Yc);
        if ($this->validateDigest($G9, $jX)) {
            goto QA;
        }
        return false;
        QA:
        if (!$Q_ instanceof DOMNode) {
            goto cw;
        }
        if (!empty($kV)) {
            goto T7;
        }
        $this->validatedNodes[] = $Q_;
        goto Y3;
        T7:
        $this->validatedNodes[$kV] = $Q_;
        Y3:
        cw:
        return true;
    }
    public function getRefNodeID($G9)
    {
        if (!($vZ = $G9->getAttribute("\125\x52\111"))) {
            goto Wr;
        }
        $M7 = parse_url($vZ);
        if (!empty($M7["\160\x61\164\150"])) {
            goto of;
        }
        if (!($kV = $M7["\x66\162\x61\x67\x6d\x65\x6e\x74"])) {
            goto r0;
        }
        return $kV;
        r0:
        of:
        Wr:
        return null;
    }
    public function getRefIDs()
    {
        $xz = array();
        $tR = $this->getXPathObj();
        $PU = "\x2e\57\x73\145\143\144\x73\x69\x67\x3a\123\151\147\156\145\x64\111\156\x66\x6f\133\x31\x5d\57\x73\x65\x63\x64\x73\x69\x67\x3a\x52\x65\146\x65\162\x65\x6e\x63\x65";
        $bi = $tR->query($PU, $this->sigNode);
        if (!($bi->length == 0)) {
            goto W4;
        }
        throw new Exception("\x52\x65\146\x65\162\145\x6e\x63\x65\x20\x6e\x6f\144\145\163\40\x6e\x6f\164\40\x66\157\x75\x6e\144");
        W4:
        foreach ($bi as $G9) {
            $xz[] = $this->getRefNodeID($G9);
            U0:
        }
        Rj:
        return $xz;
    }
    public function validateReference()
    {
        $q9 = $this->sigNode->ownerDocument->documentElement;
        if ($q9->isSameNode($this->sigNode)) {
            goto CI;
        }
        if (!($this->sigNode->parentNode != null)) {
            goto XB;
        }
        $this->sigNode->parentNode->removeChild($this->sigNode);
        XB:
        CI:
        $tR = $this->getXPathObj();
        $PU = "\x2e\x2f\163\145\x63\x64\163\151\x67\x3a\x53\x69\x67\156\145\144\x49\156\146\157\133\61\x5d\x2f\x73\145\143\x64\163\x69\147\72\122\x65\146\x65\162\145\x6e\143\145";
        $bi = $tR->query($PU, $this->sigNode);
        if (!($bi->length == 0)) {
            goto SX;
        }
        throw new Exception("\x52\145\x66\x65\162\145\156\x63\145\x20\x6e\157\144\145\163\40\156\157\164\40\146\157\165\156\144");
        SX:
        $this->validatedNodes = array();
        foreach ($bi as $G9) {
            if ($this->processRefNode($G9)) {
                goto Tx;
            }
            $this->validatedNodes = null;
            throw new Exception("\x52\x65\x66\x65\162\145\156\143\145\x20\x76\141\x6c\151\x64\x61\x74\x69\157\x6e\40\146\141\151\x6c\x65\x64");
            Tx:
            uK:
        }
        S9:
        return true;
    }
    private function addRefInternal($gI, $jb, $Kv, $XH = null, $P3 = null)
    {
        $t1 = null;
        $ub = null;
        $nA = "\111\x64";
        $EU = true;
        $YL = false;
        if (!is_array($P3)) {
            goto vs;
        }
        $t1 = empty($P3["\x70\162\x65\146\x69\170"]) ? null : $P3["\x70\x72\145\x66\151\x78"];
        $ub = empty($P3["\160\162\x65\x66\x69\170\x5f\156\163"]) ? null : $P3["\x70\162\x65\x66\151\170\137\x6e\163"];
        $nA = empty($P3["\151\144\x5f\x6e\x61\155\145"]) ? "\x49\x64" : $P3["\x69\144\x5f\x6e\x61\x6d\x65"];
        $EU = !isset($P3["\x6f\166\145\x72\x77\x72\x69\x74\145"]) ? true : (bool) $P3["\157\x76\x65\162\167\162\151\x74\145"];
        $YL = !isset($P3["\146\x6f\162\x63\145\137\x75\162\x69"]) ? false : (bool) $P3["\146\157\x72\143\145\137\165\162\151"];
        vs:
        $Oh = $nA;
        if (empty($t1)) {
            goto Ip;
        }
        $Oh = $t1 . "\72" . $Oh;
        Ip:
        $G9 = $this->createNewSignNode("\x52\145\x66\145\162\145\x6e\143\145");
        $gI->appendChild($G9);
        if (!$jb instanceof DOMDocument) {
            goto m8;
        }
        if ($YL) {
            goto RD;
        }
        goto nq;
        m8:
        $vZ = null;
        if ($EU) {
            goto u3;
        }
        $vZ = $ub ? $jb->getAttributeNS($ub, $nA) : $jb->getAttribute($nA);
        u3:
        if (!empty($vZ)) {
            goto HI;
        }
        $vZ = self::generateGUID();
        $jb->setAttributeNS($ub, $Oh, $vZ);
        HI:
        $G9->setAttribute("\x55\122\111", "\x23" . $vZ);
        goto nq;
        RD:
        $G9->setAttribute("\125\122\111", '');
        nq:
        $Zl = $this->createNewSignNode("\124\162\141\x6e\x73\146\x6f\162\x6d\x73");
        $G9->appendChild($Zl);
        if (is_array($XH)) {
            goto E5;
        }
        if (!empty($this->canonicalMethod)) {
            goto c3;
        }
        goto No;
        E5:
        foreach ($XH as $gB) {
            $EE = $this->createNewSignNode("\124\162\x61\156\x73\x66\x6f\x72\155");
            $Zl->appendChild($EE);
            if (is_array($gB) && !empty($gB["\150\164\x74\x70\72\x2f\x2f\167\x77\x77\x2e\167\63\x2e\157\x72\147\x2f\124\122\x2f\x31\x39\71\x39\57\122\105\x43\x2d\x78\x70\x61\x74\150\55\x31\x39\x39\x39\x31\x31\61\66"]) && !empty($gB["\x68\164\164\x70\x3a\x2f\57\x77\167\x77\x2e\x77\x33\x2e\157\x72\x67\x2f\124\122\x2f\61\71\x39\71\x2f\122\x45\103\55\170\160\141\164\150\x2d\x31\x39\x39\71\61\61\61\66"]["\x71\x75\145\x72\x79"])) {
                goto oo;
            }
            $EE->setAttribute("\x41\x6c\147\x6f\x72\x69\x74\150\x6d", $gB);
            goto J2;
            oo:
            $EE->setAttribute("\x41\154\147\x6f\x72\x69\x74\x68\155", "\150\164\x74\160\72\57\57\x77\x77\x77\x2e\167\x33\x2e\x6f\162\147\x2f\124\x52\x2f\61\x39\71\x39\x2f\x52\105\103\x2d\x78\x70\141\164\x68\x2d\61\x39\x39\x39\x31\61\x31\x36");
            $rj = $this->createNewSignNode("\x58\120\141\164\150", $gB["\150\164\164\x70\72\x2f\57\x77\167\x77\x2e\167\x33\x2e\157\x72\x67\57\124\122\57\x31\x39\x39\71\57\x52\105\103\x2d\170\160\x61\x74\x68\x2d\61\71\71\x39\61\61\61\x36"]["\x71\165\145\162\x79"]);
            $EE->appendChild($rj);
            if (empty($gB["\150\164\x74\160\72\x2f\x2f\167\167\x77\x2e\167\x33\x2e\x6f\x72\x67\57\x54\x52\57\61\x39\71\x39\57\x52\105\103\x2d\x78\160\141\164\150\x2d\61\x39\71\x39\x31\x31\x31\66"]["\x6e\x61\155\145\163\160\141\143\x65\163"])) {
                goto m0;
            }
            foreach ($gB["\x68\164\x74\160\72\x2f\57\167\167\x77\56\167\x33\x2e\x6f\x72\147\x2f\124\x52\57\61\x39\x39\x39\x2f\122\x45\103\x2d\x78\160\x61\164\x68\55\61\x39\x39\x39\61\61\61\x36"]["\x6e\x61\x6d\x65\x73\160\x61\143\145\163"] as $t1 => $ds) {
                $rj->setAttributeNS("\x68\x74\164\160\x3a\x2f\57\x77\x77\167\56\167\63\56\157\x72\x67\57\62\60\x30\60\x2f\170\155\154\156\163\x2f", "\x78\155\x6c\x6e\163\72{$t1}", $ds);
                qC:
            }
            HM:
            m0:
            J2:
            j1:
        }
        yP:
        goto No;
        c3:
        $EE = $this->createNewSignNode("\124\x72\x61\x6e\163\x66\x6f\162\x6d");
        $Zl->appendChild($EE);
        $EE->setAttribute("\101\x6c\x67\x6f\162\151\164\150\155", $this->canonicalMethod);
        No:
        $ty = $this->processTransforms($G9, $jb);
        $C3 = $this->calculateDigest($Kv, $ty);
        $gs = $this->createNewSignNode("\x44\151\147\145\x73\164\115\145\164\x68\157\x64");
        $G9->appendChild($gs);
        $gs->setAttribute("\101\154\x67\157\162\151\x74\x68\155", $Kv);
        $sV = $this->createNewSignNode("\x44\x69\147\145\163\x74\126\x61\154\165\145", $C3);
        $G9->appendChild($sV);
    }
    public function addReference($jb, $Kv, $XH = null, $P3 = null)
    {
        if (!($tR = $this->getXPathObj())) {
            goto VX;
        }
        $PU = "\56\x2f\x73\145\143\x64\x73\151\147\72\123\x69\147\x6e\145\144\x49\156\x66\157";
        $bi = $tR->query($PU, $this->sigNode);
        if (!($oO = $bi->item(0))) {
            goto Yd;
        }
        $this->addRefInternal($oO, $jb, $Kv, $XH, $P3);
        Yd:
        VX:
    }
    public function addReferenceList($CP, $Kv, $XH = null, $P3 = null)
    {
        if (!($tR = $this->getXPathObj())) {
            goto Se;
        }
        $PU = "\x2e\57\x73\x65\x63\144\163\x69\x67\x3a\x53\151\147\x6e\145\144\111\156\146\157";
        $bi = $tR->query($PU, $this->sigNode);
        if (!($oO = $bi->item(0))) {
            goto kp;
        }
        foreach ($CP as $jb) {
            $this->addRefInternal($oO, $jb, $Kv, $XH, $P3);
            pN:
        }
        BZ:
        kp:
        Se:
    }
    public function addObject($jX, $nu = null, $WC = null)
    {
        $Ul = $this->createNewSignNode("\x4f\142\152\145\x63\x74");
        $this->sigNode->appendChild($Ul);
        if (empty($nu)) {
            goto S7;
        }
        $Ul->setAttribute("\x4d\x69\155\145\124\171\x70\145", $nu);
        S7:
        if (empty($WC)) {
            goto sV;
        }
        $Ul->setAttribute("\x45\x6e\143\x6f\144\x69\x6e\x67", $WC);
        sV:
        if ($jX instanceof DOMElement) {
            goto fD;
        }
        $iv = $this->sigNode->ownerDocument->createTextNode($jX);
        goto Th;
        fD:
        $iv = $this->sigNode->ownerDocument->importNode($jX, true);
        Th:
        $Ul->appendChild($iv);
        return $Ul;
    }
    public function locateKey($jb = null)
    {
        if (!empty($jb)) {
            goto oL;
        }
        $jb = $this->sigNode;
        oL:
        if ($jb instanceof DOMNode) {
            goto e3;
        }
        return null;
        e3:
        if (!($QP = $jb->ownerDocument)) {
            goto ER;
        }
        $tR = new DOMXPath($QP);
        $tR->registerNamespace("\x73\x65\x63\144\163\x69\147", self::XMLDSIGNS);
        $PU = "\x73\x74\x72\151\x6e\x67\50\56\x2f\163\145\143\x64\163\151\x67\72\123\x69\147\x6e\x65\144\111\x6e\146\x6f\57\163\x65\143\x64\163\151\x67\x3a\123\151\147\x6e\x61\164\165\x72\x65\115\x65\x74\x68\x6f\144\57\100\101\154\x67\157\x72\x69\x74\150\155\51";
        $Kv = $tR->evaluate($PU, $jb);
        if (!$Kv) {
            goto nH;
        }
        try {
            $fF = new XMLSecurityKey($Kv, array("\x74\x79\x70\145" => "\x70\x75\142\x6c\x69\x63"));
        } catch (Exception $zU) {
            return null;
        }
        return $fF;
        nH:
        ER:
        return null;
    }
    public function verify($fF)
    {
        $QP = $this->sigNode->ownerDocument;
        $tR = new DOMXPath($QP);
        $tR->registerNamespace("\x73\x65\x63\x64\163\151\147", self::XMLDSIGNS);
        $PU = "\163\164\162\x69\x6e\147\x28\x2e\57\163\x65\x63\144\163\151\x67\72\x53\x69\x67\156\x61\164\165\162\x65\x56\141\154\165\145\x29";
        $cB = $tR->evaluate($PU, $this->sigNode);
        if (!empty($cB)) {
            goto oY;
        }
        throw new Exception("\125\x6e\x61\x62\x6c\145\x20\164\x6f\40\x6c\x6f\143\141\x74\145\x20\123\151\x67\x6e\x61\164\x75\162\145\126\x61\154\165\x65");
        oY:
        return $fF->verifySignature($this->signedInfo, base64_decode($cB));
    }
    public function signData($fF, $jX)
    {
        return $fF->signData($jX);
    }
    public function sign($fF, $DE = null)
    {
        if (!($DE != null)) {
            goto uG;
        }
        $this->resetXPathObj();
        $this->appendSignature($DE);
        $this->sigNode = $DE->lastChild;
        uG:
        if (!($tR = $this->getXPathObj())) {
            goto g8;
        }
        $PU = "\56\x2f\163\x65\143\144\x73\x69\147\x3a\x53\x69\x67\156\x65\x64\111\x6e\146\x6f";
        $bi = $tR->query($PU, $this->sigNode);
        if (!($oO = $bi->item(0))) {
            goto kD;
        }
        $PU = "\56\x2f\163\145\143\144\x73\x69\147\x3a\x53\151\147\156\x61\x74\x75\x72\x65\115\x65\x74\150\x6f\x64";
        $bi = $tR->query($PU, $oO);
        $nx = $bi->item(0);
        $nx->setAttribute("\101\x6c\x67\157\162\x69\164\x68\155", $fF->type);
        $jX = $this->canonicalizeData($oO, $this->canonicalMethod);
        $cB = base64_encode($this->signData($fF, $jX));
        $Fx = $this->createNewSignNode("\x53\151\x67\156\x61\x74\x75\162\145\126\x61\154\x75\145", $cB);
        if ($Ak = $oO->nextSibling) {
            goto RQ;
        }
        $this->sigNode->appendChild($Fx);
        goto wP;
        RQ:
        $Ak->parentNode->insertBefore($Fx, $Ak);
        wP:
        kD:
        g8:
    }
    public function appendCert()
    {
    }
    public function appendKey($fF, $IY = null)
    {
        $fF->serializeKey($IY);
    }
    public function insertSignature($jb, $w8 = null)
    {
        $BG = $jb->ownerDocument;
        $sY = $BG->importNode($this->sigNode, true);
        if ($w8 == null) {
            goto dZ;
        }
        return $jb->insertBefore($sY, $w8);
        goto pG;
        dZ:
        return $jb->insertBefore($sY);
        pG:
    }
    public function appendSignature($t2, $OV = false)
    {
        $w8 = $OV ? $t2->firstChild : null;
        return $this->insertSignature($t2, $w8);
    }
    public static function get509XCert($lI, $vE = true)
    {
        $UA = self::staticGet509XCerts($lI, $vE);
        if (empty($UA)) {
            goto DU;
        }
        return $UA[0];
        DU:
        return '';
    }
    public static function staticGet509XCerts($UA, $vE = true)
    {
        if ($vE) {
            goto UI;
        }
        return array($UA);
        goto sZ;
        UI:
        $jX = '';
        $H8 = array();
        $mr = explode("\xa", $UA);
        $yA = false;
        foreach ($mr as $m2) {
            if (!$yA) {
                goto p2;
            }
            if (!(strncmp($m2, "\55\x2d\x2d\55\55\x45\x4e\104\40\x43\x45\122\x54\111\106\x49\x43\x41\x54\x45", 20) == 0)) {
                goto Nh;
            }
            $yA = false;
            $H8[] = $jX;
            $jX = '';
            goto gY;
            Nh:
            $jX .= trim($m2);
            goto su;
            p2:
            if (!(strncmp($m2, "\55\55\x2d\55\55\x42\105\x47\111\x4e\x20\103\105\x52\124\x49\106\111\x43\x41\x54\x45", 22) == 0)) {
                goto N1;
            }
            $yA = true;
            N1:
            su:
            gY:
        }
        MZ:
        return $H8;
        sZ:
    }
    public static function staticAdd509Cert($a0, $lI, $vE = true, $Gb = false, $tR = null, $P3 = null)
    {
        if (!$Gb) {
            goto TH;
        }
        $lI = file_get_contents($lI);
        TH:
        if ($a0 instanceof DOMElement) {
            goto g4;
        }
        throw new Exception("\111\x6e\166\x61\x6c\x69\144\40\x70\141\162\x65\156\164\x20\116\x6f\144\x65\x20\160\141\x72\x61\x6d\x65\x74\x65\162");
        g4:
        $l7 = $a0->ownerDocument;
        if (!empty($tR)) {
            goto Yq;
        }
        $tR = new DOMXPath($a0->ownerDocument);
        $tR->registerNamespace("\163\145\x63\x64\x73\151\147", self::XMLDSIGNS);
        Yq:
        $PU = "\x2e\x2f\163\145\x63\x64\163\x69\x67\72\113\x65\171\111\x6e\x66\157";
        $bi = $tR->query($PU, $a0);
        $aR = $bi->item(0);
        $Rs = '';
        if (!$aR) {
            goto La;
        }
        $wU = $aR->lookupPrefix(self::XMLDSIGNS);
        if (empty($wU)) {
            goto GV;
        }
        $Rs = $wU . "\72";
        GV:
        goto F0;
        La:
        $wU = $a0->lookupPrefix(self::XMLDSIGNS);
        if (empty($wU)) {
            goto VH;
        }
        $Rs = $wU . "\72";
        VH:
        $ie = false;
        $aR = $l7->createElementNS(self::XMLDSIGNS, $Rs . "\113\145\x79\111\x6e\x66\x6f");
        $PU = "\56\57\163\145\x63\x64\163\x69\147\72\117\x62\x6a\x65\x63\164";
        $bi = $tR->query($PU, $a0);
        if (!($RY = $bi->item(0))) {
            goto WH;
        }
        $RY->parentNode->insertBefore($aR, $RY);
        $ie = true;
        WH:
        if ($ie) {
            goto zg;
        }
        $a0->appendChild($aR);
        zg:
        F0:
        $UA = self::staticGet509XCerts($lI, $vE);
        $Fz = $l7->createElementNS(self::XMLDSIGNS, $Rs . "\130\65\x30\71\104\141\164\x61");
        $aR->appendChild($Fz);
        $Q9 = false;
        $EX = false;
        if (!is_array($P3)) {
            goto Xc;
        }
        if (empty($P3["\151\163\163\x75\x65\162\x53\145\162\151\141\x6c"])) {
            goto DN;
        }
        $Q9 = true;
        DN:
        if (empty($P3["\163\x75\142\152\145\143\164\x4e\141\x6d\145"])) {
            goto w3;
        }
        $EX = true;
        w3:
        Xc:
        foreach ($UA as $Ky) {
            if (!($Q9 || $EX)) {
                goto Qc;
            }
            if (!($OD = openssl_x509_parse("\55\55\55\55\55\x42\x45\x47\111\116\40\x43\105\x52\x54\x49\x46\x49\103\x41\x54\105\55\55\55\55\x2d\12" . chunk_split($Ky, 64, "\12") . "\55\55\x2d\55\x2d\x45\116\x44\40\x43\x45\x52\124\111\x46\111\103\x41\124\x45\x2d\55\x2d\x2d\55\xa"))) {
                goto L8;
            }
            if (!($EX && !empty($OD["\163\x75\142\x6a\145\x63\x74"]))) {
                goto V8;
            }
            if (is_array($OD["\x73\x75\142\152\145\x63\164"])) {
                goto mi;
            }
            $BS = $OD["\163\x75\x62\152\x65\143\164"];
            goto IM;
            mi:
            $YJ = array();
            foreach ($OD["\x73\165\142\152\145\x63\x74"] as $UV => $Ev) {
                if (is_array($Ev)) {
                    goto Pc;
                }
                array_unshift($YJ, "{$UV}\75{$Ev}");
                goto Qd;
                Pc:
                foreach ($Ev as $Oe) {
                    array_unshift($YJ, "{$UV}\75{$Oe}");
                    lp:
                }
                WS:
                Qd:
                yy:
            }
            Pv:
            $BS = implode("\54", $YJ);
            IM:
            $lF = $l7->createElementNS(self::XMLDSIGNS, $Rs . "\130\65\60\x39\x53\x75\x62\x6a\145\143\x74\116\141\155\145", $BS);
            $Fz->appendChild($lF);
            V8:
            if (!($Q9 && !empty($OD["\x69\163\163\x75\x65\x72"]) && !empty($OD["\x73\x65\162\x69\141\x6c\x4e\x75\155\x62\145\x72"]))) {
                goto oE;
            }
            if (is_array($OD["\x69\x73\x73\165\145\162"])) {
                goto NG;
            }
            $Wg = $OD["\x69\x73\x73\165\145\162"];
            goto PL;
            NG:
            $YJ = array();
            foreach ($OD["\x69\163\163\165\145\x72"] as $UV => $Ev) {
                array_unshift($YJ, "{$UV}\75{$Ev}");
                EB:
            }
            nm:
            $Wg = implode("\54", $YJ);
            PL:
            $lA = $l7->createElementNS(self::XMLDSIGNS, $Rs . "\x58\x35\60\71\x49\163\163\x75\145\x72\123\x65\x72\151\x61\154");
            $Fz->appendChild($lA);
            $yR = $l7->createElementNS(self::XMLDSIGNS, $Rs . "\x58\65\x30\71\x49\163\163\165\x65\x72\x4e\141\155\145", $Wg);
            $lA->appendChild($yR);
            $yR = $l7->createElementNS(self::XMLDSIGNS, $Rs . "\x58\x35\60\x39\x53\x65\x72\151\141\154\116\x75\x6d\x62\x65\x72", $OD["\163\145\x72\151\x61\x6c\x4e\165\155\142\x65\x72"]);
            $lA->appendChild($yR);
            oE:
            L8:
            Qc:
            $bz = $l7->createElementNS(self::XMLDSIGNS, $Rs . "\x58\65\60\x39\103\x65\x72\x74\x69\146\151\x63\141\164\145", $Ky);
            $Fz->appendChild($bz);
            ON:
        }
        gk:
    }
    public function add509Cert($lI, $vE = true, $Gb = false, $P3 = null)
    {
        if (!($tR = $this->getXPathObj())) {
            goto ZD;
        }
        self::staticAdd509Cert($this->sigNode, $lI, $vE, $Gb, $tR, $P3);
        ZD:
    }
    public function appendToKeyInfo($jb)
    {
        $a0 = $this->sigNode;
        $l7 = $a0->ownerDocument;
        $tR = $this->getXPathObj();
        if (!empty($tR)) {
            goto YR;
        }
        $tR = new DOMXPath($a0->ownerDocument);
        $tR->registerNamespace("\x73\145\x63\144\163\151\147", self::XMLDSIGNS);
        YR:
        $PU = "\56\57\x73\145\x63\144\163\x69\x67\x3a\x4b\145\171\x49\156\146\157";
        $bi = $tR->query($PU, $a0);
        $aR = $bi->item(0);
        if ($aR) {
            goto eZ;
        }
        $Rs = '';
        $wU = $a0->lookupPrefix(self::XMLDSIGNS);
        if (empty($wU)) {
            goto Jf;
        }
        $Rs = $wU . "\72";
        Jf:
        $ie = false;
        $aR = $l7->createElementNS(self::XMLDSIGNS, $Rs . "\113\145\x79\111\156\146\157");
        $PU = "\56\x2f\163\x65\143\144\163\151\x67\x3a\x4f\x62\152\145\x63\x74";
        $bi = $tR->query($PU, $a0);
        if (!($RY = $bi->item(0))) {
            goto km;
        }
        $RY->parentNode->insertBefore($aR, $RY);
        $ie = true;
        km:
        if ($ie) {
            goto AW;
        }
        $a0->appendChild($aR);
        AW:
        eZ:
        $aR->appendChild($jb);
        return $aR;
    }
    public function getValidatedNodes()
    {
        return $this->validatedNodes;
    }
}
