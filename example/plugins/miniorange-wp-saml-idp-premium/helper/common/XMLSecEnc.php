<?php


namespace RobRichards\XMLSecLibs;

use DOMDocument;
use DOMElement;
use DOMNode;
use DOMXPath;
use Exception;
use RobRichards\XMLSecLibs\Utils\XPath as XPath;
class XMLSecEnc
{
    const template = "\x3c\x78\x65\x6e\x63\x3a\105\156\x63\x72\x79\160\164\145\x64\104\141\x74\x61\40\170\x6d\154\x6e\x73\x3a\x78\x65\x6e\143\75\47\x68\x74\164\160\72\x2f\57\x77\167\x77\x2e\167\x33\x2e\x6f\x72\147\x2f\62\60\60\61\x2f\60\x34\x2f\x78\155\154\x65\156\143\x23\47\x3e\12\40\x20\x20\74\170\145\x6e\x63\x3a\103\151\160\x68\145\x72\x44\x61\x74\x61\x3e\12\x20\x20\40\x20\x20\x20\74\x78\x65\x6e\143\x3a\x43\151\160\x68\x65\162\126\x61\x6c\x75\x65\x3e\x3c\57\170\145\156\143\x3a\x43\x69\x70\150\x65\x72\x56\141\x6c\165\x65\x3e\12\x20\40\40\x3c\x2f\170\145\x6e\x63\72\x43\151\x70\150\145\162\x44\x61\164\x61\76\xa\74\57\x78\145\x6e\143\x3a\105\x6e\143\162\171\160\x74\x65\x64\x44\x61\x74\141\76";
    const Element = "\150\x74\x74\160\72\x2f\57\167\x77\167\x2e\167\x33\x2e\157\x72\x67\57\62\60\x30\61\57\60\64\57\x78\155\154\145\156\x63\43\x45\154\x65\155\x65\156\164";
    const Content = "\150\164\x74\160\x3a\57\57\167\x77\x77\x2e\167\63\x2e\157\162\147\57\x32\x30\60\61\57\x30\x34\57\x78\155\154\145\156\x63\43\103\x6f\x6e\164\x65\156\x74";
    const URI = 3;
    const XMLENCNS = "\150\x74\x74\x70\72\57\x2f\x77\x77\167\56\167\63\56\x6f\x72\x67\x2f\x32\x30\60\61\57\x30\x34\57\x78\155\154\145\156\143\43";
    private $encdoc = null;
    private $rawNode = null;
    public $type = null;
    public $encKey = null;
    private $references = array();
    public function __construct()
    {
        $this->_resetTemplate();
    }
    private function _resetTemplate()
    {
        $this->encdoc = new DOMDocument();
        $this->encdoc->loadXML(self::template);
    }
    public function addReference($Zp, $jb, $p8)
    {
        if ($jb instanceof DOMNode) {
            goto lG;
        }
        throw new Exception("\x24\x6e\157\x64\145\x20\x69\163\40\156\x6f\x74\x20\x6f\x66\x20\164\x79\x70\145\x20\x44\117\x4d\x4e\x6f\x64\145");
        lG:
        $lt = $this->encdoc;
        $this->_resetTemplate();
        $dz = $this->encdoc;
        $this->encdoc = $lt;
        $ae = XMLSecurityDSig::generateGUID();
        $dx = $dz->documentElement;
        $dx->setAttribute("\x49\144", $ae);
        $this->references[$Zp] = array("\x6e\157\x64\145" => $jb, "\x74\x79\160\x65" => $p8, "\145\156\143\x6e\157\x64\x65" => $dz, "\x72\x65\x66\x75\162\151" => $ae);
    }
    public function setNode($jb)
    {
        $this->rawNode = $jb;
    }
    public function encryptNode($fF, $MP = true)
    {
        $jX = '';
        if (!empty($this->rawNode)) {
            goto RV;
        }
        throw new Exception("\x4e\157\144\145\40\x74\x6f\40\x65\x6e\x63\162\x79\x70\x74\x20\x68\141\x73\40\156\x6f\164\40\x62\145\145\x6e\40\x73\x65\164");
        RV:
        if ($fF instanceof XMLSecurityKey) {
            goto Z9;
        }
        throw new Exception("\111\156\x76\x61\x6c\151\x64\x20\x4b\145\x79");
        Z9:
        $QP = $this->rawNode->ownerDocument;
        $An = new DOMXPath($this->encdoc);
        $nO = $An->query("\57\x78\x65\156\x63\72\x45\x6e\x63\162\x79\160\x74\145\x64\x44\x61\x74\141\57\170\145\x6e\143\x3a\103\151\160\150\x65\162\104\141\x74\141\57\x78\145\x6e\x63\x3a\103\151\x70\150\145\162\126\x61\154\165\145");
        $fU = $nO->item(0);
        if (!($fU == null)) {
            goto eR;
        }
        throw new Exception("\105\x72\162\x6f\x72\x20\154\157\x63\x61\164\151\156\147\40\103\151\x70\x68\x65\162\126\x61\x6c\x75\x65\40\x65\x6c\145\155\145\156\x74\40\167\151\x74\150\x69\156\x20\164\145\155\160\154\x61\164\x65");
        eR:
        switch ($this->type) {
            case self::Element:
                $jX = $QP->saveXML($this->rawNode);
                $this->encdoc->documentElement->setAttribute("\124\171\160\x65", self::Element);
                goto Gj;
            case self::Content:
                $ZD = $this->rawNode->childNodes;
                foreach ($ZD as $Mr) {
                    $jX .= $QP->saveXML($Mr);
                    I8:
                }
                HN:
                $this->encdoc->documentElement->setAttribute("\124\x79\x70\x65", self::Content);
                goto Gj;
            default:
                throw new Exception("\x54\x79\160\145\x20\x69\x73\x20\143\x75\162\x72\x65\156\164\154\x79\40\x6e\x6f\x74\x20\163\165\160\160\157\162\164\145\144");
        }
        WN:
        Gj:
        $pk = $this->encdoc->documentElement->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\x78\145\156\143\x3a\105\x6e\143\162\x79\160\164\151\157\156\115\145\164\x68\157\x64"));
        $pk->setAttribute("\101\154\147\157\x72\151\x74\x68\155", $fF->getAlgorithm());
        $fU->parentNode->parentNode->insertBefore($pk, $fU->parentNode->parentNode->firstChild);
        $JR = base64_encode($fF->encryptData($jX));
        $Ev = $this->encdoc->createTextNode($JR);
        $fU->appendChild($Ev);
        if ($MP) {
            goto Ix;
        }
        return $this->encdoc->documentElement;
        goto A7;
        Ix:
        switch ($this->type) {
            case self::Element:
                if (!($this->rawNode->nodeType == XML_DOCUMENT_NODE)) {
                    goto y0;
                }
                return $this->encdoc;
                y0:
                $PC = $this->rawNode->ownerDocument->importNode($this->encdoc->documentElement, true);
                $this->rawNode->parentNode->replaceChild($PC, $this->rawNode);
                return $PC;
            case self::Content:
                $PC = $this->rawNode->ownerDocument->importNode($this->encdoc->documentElement, true);
                xD:
                if (!$this->rawNode->firstChild) {
                    goto Ow;
                }
                $this->rawNode->removeChild($this->rawNode->firstChild);
                goto xD;
                Ow:
                $this->rawNode->appendChild($PC);
                return $PC;
        }
        JW:
        sS:
        A7:
    }
    public function encryptReferences($fF)
    {
        $mG = $this->rawNode;
        $IT = $this->type;
        foreach ($this->references as $Zp => $Ey) {
            $this->encdoc = $Ey["\x65\x6e\143\156\157\x64\x65"];
            $this->rawNode = $Ey["\156\x6f\x64\x65"];
            $this->type = $Ey["\164\171\160\145"];
            try {
                $Cv = $this->encryptNode($fF);
                $this->references[$Zp]["\145\x6e\x63\156\157\144\145"] = $Cv;
            } catch (Exception $zU) {
                $this->rawNode = $mG;
                $this->type = $IT;
                throw $zU;
            }
            TM:
        }
        Q4:
        $this->rawNode = $mG;
        $this->type = $IT;
    }
    public function getCipherValue()
    {
        if (!empty($this->rawNode)) {
            goto uJ;
        }
        throw new Exception("\116\157\x64\x65\40\x74\x6f\40\x64\145\x63\x72\x79\160\164\x20\150\x61\x73\x20\x6e\x6f\164\40\x62\x65\145\156\40\163\x65\164");
        uJ:
        $QP = $this->rawNode->ownerDocument;
        $An = new DOMXPath($QP);
        $An->registerNamespace("\x78\155\x6c\x65\156\143\162", self::XMLENCNS);
        $PU = "\56\57\x78\x6d\154\x65\156\x63\x72\72\x43\x69\x70\150\x65\x72\104\x61\164\141\x2f\x78\155\x6c\145\x6e\x63\x72\72\x43\151\x70\x68\x65\162\x56\141\154\x75\x65";
        $bi = $An->query($PU, $this->rawNode);
        $jb = $bi->item(0);
        if ($jb) {
            goto y_;
        }
        return null;
        y_:
        return base64_decode($jb->nodeValue);
    }
    public function decryptNode($fF, $MP = true)
    {
        if ($fF instanceof XMLSecurityKey) {
            goto Dn;
        }
        throw new Exception("\111\156\x76\141\x6c\151\x64\40\x4b\145\171");
        Dn:
        $Qr = $this->getCipherValue();
        if ($Qr) {
            goto XY;
        }
        throw new Exception("\103\141\x6e\156\157\164\40\x6c\x6f\x63\x61\164\145\x20\145\x6e\x63\162\x79\x70\x74\145\x64\40\144\x61\164\141");
        goto AB;
        XY:
        $bL = $fF->decryptData($Qr);
        if ($MP) {
            goto Ik;
        }
        return $bL;
        goto Rx;
        Ik:
        switch ($this->type) {
            case self::Element:
                $wJ = new DOMDocument();
                $wJ->loadXML($bL);
                if (!($this->rawNode->nodeType == XML_DOCUMENT_NODE)) {
                    goto vt;
                }
                return $wJ;
                vt:
                $PC = $this->rawNode->ownerDocument->importNode($wJ->documentElement, true);
                $this->rawNode->parentNode->replaceChild($PC, $this->rawNode);
                return $PC;
            case self::Content:
                if ($this->rawNode->nodeType == XML_DOCUMENT_NODE) {
                    goto aW;
                }
                $QP = $this->rawNode->ownerDocument;
                goto UD;
                aW:
                $QP = $this->rawNode;
                UD:
                $XV = $QP->createDocumentFragment();
                $XV->appendXML($bL);
                $IY = $this->rawNode->parentNode;
                $IY->replaceChild($XV, $this->rawNode);
                return $IY;
            default:
                return $bL;
        }
        mP:
        MP:
        Rx:
        AB:
    }
    public function encryptKey($ho, $Nl, $xt = true)
    {
        if (!(!$ho instanceof XMLSecurityKey || !$Nl instanceof XMLSecurityKey)) {
            goto HJ;
        }
        throw new Exception("\111\156\x76\x61\154\151\x64\40\x4b\x65\171");
        HJ:
        $K1 = base64_encode($ho->encryptData($Nl->key));
        $BT = $this->encdoc->documentElement;
        $d8 = $this->encdoc->createElementNS(self::XMLENCNS, "\170\145\x6e\x63\72\105\x6e\143\x72\x79\160\164\145\x64\113\x65\x79");
        if ($xt) {
            goto Cg;
        }
        $this->encKey = $d8;
        goto U_;
        Cg:
        $aR = $BT->insertBefore($this->encdoc->createElementNS("\150\164\164\x70\x3a\57\57\x77\167\167\56\x77\63\x2e\x6f\x72\x67\57\62\x30\60\x30\x2f\x30\71\x2f\170\155\154\144\163\151\x67\43", "\144\163\151\147\72\113\145\x79\x49\x6e\x66\x6f"), $BT->firstChild);
        $aR->appendChild($d8);
        U_:
        $pk = $d8->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\x78\145\x6e\x63\x3a\x45\x6e\x63\162\171\160\164\x69\x6f\156\x4d\x65\x74\x68\157\x64"));
        $pk->setAttribute("\x41\154\x67\157\162\x69\164\150\155", $ho->getAlgorith());
        if (empty($ho->name)) {
            goto Wv;
        }
        $aR = $d8->appendChild($this->encdoc->createElementNS("\x68\x74\164\160\72\57\57\x77\167\167\56\167\63\56\157\x72\147\57\x32\60\60\60\57\60\71\57\170\x6d\154\x64\163\151\x67\43", "\x64\163\151\147\72\113\x65\171\x49\x6e\x66\157"));
        $aR->appendChild($this->encdoc->createElementNS("\150\x74\164\160\72\57\x2f\x77\167\167\x2e\167\x33\56\x6f\x72\147\57\62\x30\60\60\57\60\71\57\x78\155\154\144\x73\x69\x67\x23", "\x64\x73\151\147\x3a\x4b\145\x79\116\x61\155\x65", $ho->name));
        Wv:
        $Ce = $d8->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\170\145\156\x63\x3a\103\x69\x70\150\x65\162\104\x61\164\141"));
        $Ce->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\170\x65\x6e\143\x3a\x43\151\x70\x68\x65\162\x56\x61\x6c\165\x65", $K1));
        if (!(is_array($this->references) && count($this->references) > 0)) {
            goto nv;
        }
        $WH = $d8->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\x78\x65\156\x63\x3a\122\x65\x66\x65\x72\x65\156\143\x65\x4c\x69\x73\164"));
        foreach ($this->references as $Zp => $Ey) {
            $ae = $Ey["\x72\x65\x66\x75\x72\151"];
            $z9 = $WH->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\x78\145\x6e\x63\x3a\104\141\x74\141\122\x65\x66\x65\x72\x65\x6e\143\x65"));
            $z9->setAttribute("\x55\x52\x49", "\x23" . $ae);
            yh:
        }
        jv:
        nv:
        return;
    }
    public function decryptKey($d8)
    {
        if ($d8->isEncrypted) {
            goto qi;
        }
        throw new Exception("\113\145\x79\40\x69\163\40\x6e\157\164\x20\x45\x6e\x63\162\171\x70\x74\145\144");
        qi:
        if (!empty($d8->key)) {
            goto S2;
        }
        throw new Exception("\113\x65\x79\x20\151\x73\x20\x6d\151\163\x73\x69\x6e\147\40\144\x61\x74\x61\x20\164\x6f\40\160\145\162\x66\x6f\x72\155\40\164\150\145\40\x64\x65\x63\162\x79\x70\164\151\157\x6e");
        S2:
        return $this->decryptNode($d8, false);
    }
    public function locateEncryptedData($dx)
    {
        if ($dx instanceof DOMDocument) {
            goto t2;
        }
        $QP = $dx->ownerDocument;
        goto bm;
        t2:
        $QP = $dx;
        bm:
        if (!$QP) {
            goto tu;
        }
        $tR = new DOMXPath($QP);
        $PU = "\x2f\57\x2a\x5b\x6c\157\x63\141\154\x2d\156\141\155\145\x28\51\75\47\x45\156\x63\x72\x79\x70\x74\145\144\104\x61\x74\x61\x27\x20\x61\x6e\x64\x20\156\x61\155\145\163\160\x61\x63\145\x2d\x75\162\x69\x28\x29\75\x27" . self::XMLENCNS . "\x27\x5d";
        $bi = $tR->query($PU);
        return $bi->item(0);
        tu:
        return null;
    }
    public function locateKey($jb = null)
    {
        if (!empty($jb)) {
            goto b7;
        }
        $jb = $this->rawNode;
        b7:
        if ($jb instanceof DOMNode) {
            goto t6;
        }
        return null;
        t6:
        if (!($QP = $jb->ownerDocument)) {
            goto Oq;
        }
        $tR = new DOMXPath($QP);
        $tR->registerNamespace("\170\x6d\x6c\163\145\x63\x65\x6e\x63", self::XMLENCNS);
        $PU = "\56\x2f\57\x78\155\x6c\x73\x65\x63\x65\x6e\x63\x3a\x45\x6e\143\162\171\x70\x74\151\157\x6e\x4d\145\x74\150\157\x64";
        $bi = $tR->query($PU, $jb);
        if (!($PL = $bi->item(0))) {
            goto dR;
        }
        $AK = $PL->getAttribute("\101\x6c\x67\157\x72\x69\164\150\155");
        try {
            $fF = new XMLSecurityKey($AK, array("\x74\171\x70\145" => "\x70\162\151\x76\x61\x74\x65"));
        } catch (Exception $zU) {
            return null;
        }
        return $fF;
        dR:
        Oq:
        return null;
    }
    public static function staticLocateKeyInfo($PF = null, $jb = null)
    {
        if (!(empty($jb) || !$jb instanceof DOMNode)) {
            goto CU;
        }
        return null;
        CU:
        $QP = $jb->ownerDocument;
        if ($QP) {
            goto iR;
        }
        return null;
        iR:
        $tR = new DOMXPath($QP);
        $tR->registerNamespace("\x78\x6d\x6c\163\145\x63\x65\156\x63", self::XMLENCNS);
        $tR->registerNamespace("\x78\155\x6c\163\145\x63\144\x73\x69\x67", XMLSecurityDSig::XMLDSIGNS);
        $PU = "\x2e\x2f\170\x6d\154\x73\145\x63\144\x73\x69\147\x3a\x4b\145\x79\111\156\146\157";
        $bi = $tR->query($PU, $jb);
        $PL = $bi->item(0);
        if ($PL) {
            goto Q3;
        }
        return $PF;
        Q3:
        foreach ($PL->childNodes as $Mr) {
            switch ($Mr->localName) {
                case "\x4b\145\171\116\x61\x6d\x65":
                    if (empty($PF)) {
                        goto UT;
                    }
                    $PF->name = $Mr->nodeValue;
                    UT:
                    goto Za;
                case "\x4b\145\x79\126\x61\x6c\165\x65":
                    foreach ($Mr->childNodes as $qO) {
                        switch ($qO->localName) {
                            case "\x44\x53\101\113\x65\x79\x56\x61\x6c\165\145":
                                throw new Exception("\x44\123\x41\113\145\x79\126\x61\154\x75\x65\40\143\x75\x72\162\x65\156\x74\x6c\171\40\156\x6f\x74\x20\x73\165\x70\x70\157\162\164\x65\144");
                            case "\x52\123\x41\113\145\171\x56\141\x6c\165\x65":
                                $P7 = null;
                                $Ab = null;
                                if (!($tB = $qO->getElementsByTagName("\115\x6f\x64\x75\x6c\165\x73")->item(0))) {
                                    goto B2;
                                }
                                $P7 = base64_decode($tB->nodeValue);
                                B2:
                                if (!($bI = $qO->getElementsByTagName("\105\x78\x70\157\x6e\145\x6e\164")->item(0))) {
                                    goto aj;
                                }
                                $Ab = base64_decode($bI->nodeValue);
                                aj:
                                if (!(empty($P7) || empty($Ab))) {
                                    goto QL;
                                }
                                throw new Exception("\x4d\151\163\x73\151\156\x67\40\x4d\157\144\165\x6c\165\x73\x20\x6f\162\40\105\x78\x70\x6f\x6e\x65\156\164");
                                QL:
                                $R8 = XMLSecurityKey::convertRSA($P7, $Ab);
                                $PF->loadKey($R8);
                                goto BW;
                        }
                        E6:
                        BW:
                        lS:
                    }
                    Jc:
                    goto Za;
                case "\x52\x65\x74\162\151\x65\166\141\x6c\x4d\x65\x74\x68\157\144":
                    $p8 = $Mr->getAttribute("\124\x79\160\145");
                    if (!($p8 !== "\x68\x74\x74\x70\x3a\57\x2f\167\167\167\x2e\167\x33\x2e\x6f\x72\147\x2f\x32\60\x30\x31\57\x30\x34\57\170\x6d\x6c\145\x6e\x63\43\x45\156\143\x72\171\x70\x74\145\144\x4b\x65\x79")) {
                        goto ph;
                    }
                    goto Za;
                    ph:
                    $vZ = $Mr->getAttribute("\125\x52\x49");
                    if (!($vZ[0] !== "\x23")) {
                        goto Yv;
                    }
                    goto Za;
                    Yv:
                    $tW = substr($vZ, 1);
                    $PU = "\x2f\x2f\170\155\154\163\145\x63\145\156\143\72\105\156\x63\x72\171\160\x74\145\144\x4b\x65\171\x5b\100\111\x64\x3d\42" . XPath::filterAttrValue($tW, XPath::DOUBLE_QUOTE) . "\42\135";
                    $vm = $tR->query($PU)->item(0);
                    if ($vm) {
                        goto Kc;
                    }
                    throw new Exception("\x55\156\141\142\x6c\x65\x20\x74\x6f\x20\x6c\x6f\x63\141\164\145\40\105\156\x63\162\171\160\x74\145\144\x4b\x65\171\x20\x77\151\x74\x68\x20\x40\111\x64\75\47{$tW}\47\x2e");
                    Kc:
                    return XMLSecurityKey::fromEncryptedKeyElement($vm);
                case "\x45\156\143\x72\x79\160\164\x65\144\x4b\145\171":
                    return XMLSecurityKey::fromEncryptedKeyElement($Mr);
                case "\130\x35\x30\x39\104\x61\164\141":
                    if (!($I7 = $Mr->getElementsByTagName("\130\65\x30\x39\x43\x65\162\164\151\146\x69\143\141\x74\145"))) {
                        goto lA;
                    }
                    if (!($I7->length > 0)) {
                        goto mw;
                    }
                    $Iq = $I7->item(0)->textContent;
                    $Iq = str_replace(array("\15", "\xa", "\40"), '', $Iq);
                    $Iq = "\55\55\55\x2d\x2d\x42\105\107\x49\x4e\x20\103\x45\x52\124\111\x46\x49\103\x41\x54\x45\55\55\x2d\x2d\x2d\12" . chunk_split($Iq, 64, "\12") . "\x2d\55\55\x2d\x2d\x45\116\x44\40\x43\x45\x52\x54\111\106\x49\103\101\124\105\55\55\x2d\55\x2d\xa";
                    $PF->loadKey($Iq, false, true);
                    mw:
                    lA:
                    goto Za;
            }
            pe:
            Za:
            e9:
        }
        bM:
        return $PF;
    }
    public function locateKeyInfo($PF = null, $jb = null)
    {
        if (!empty($jb)) {
            goto Un;
        }
        $jb = $this->rawNode;
        Un:
        return self::staticLocateKeyInfo($PF, $jb);
    }
}
