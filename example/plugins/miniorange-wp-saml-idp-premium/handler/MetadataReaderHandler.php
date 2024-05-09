<?php


namespace IDP\Handler;

use IDP\Exception\RequiredFieldsException;
use IDP\Exception\InvalidMetaDataFileException;
use IDP\Exception\InvalidMetaDataUrlException;
use IDP\Helper\Constants\MoIDPMessages;
use IDP\Helper\Database\MoDbQueries;
use IDP\Helper\Traits\Instance;
use IDP\Helper\Utilities\MoIDPUtility;
use IDP\Helper\SAML2\MetadataReader;
use IDP\Helper\Utilities\SAMLUtilities;
class MetadataReaderHandler extends SPSettingsUtility
{
    use Instance;
    private function __construct()
    {
    }
    public function handle_upload_metadata($d1)
    {
        if (!(isset($_FILES["\155\145\x74\x61\x64\x61\164\x61\x5f\146\151\x6c\145"]) || isset($d1["\155\x65\x74\141\x64\141\x74\141\x5f\x75\162\154"]))) {
            goto aX;
        }
        if (!empty($_FILES["\155\x65\x74\141\x64\141\x74\141\137\146\151\154\x65"]["\164\x6d\x70\137\156\141\x6d\x65"])) {
            goto Wq;
        }
        $mK = filter_var($d1["\155\145\164\141\144\x61\164\141\137\x75\x72\x6c"], FILTER_SANITIZE_URL);
        $R1 = curl_init();
        curl_setopt($R1, CURLOPT_URL, $mK);
        curl_setopt($R1, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($R1, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($R1, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($R1, CURLOPT_SSL_VERIFYHOST, false);
        $Do = curl_exec($R1);
        curl_close($R1);
        goto jK;
        Wq:
        $Do = @file_get_contents($_FILES["\x6d\145\164\141\x64\x61\164\141\x5f\x66\151\154\145"]["\x74\x6d\160\x5f\x6e\141\155\x65"]);
        jK:
        $this->upload_metadata($Do, $d1);
        aX:
    }
    public function handle_edit_metadata($d1)
    {
        if (!(isset($_FILES["\155\x65\164\x61\x64\x61\x74\141\137\146\151\x6c\145"]) || isset($d1["\x6d\x65\164\141\x64\x61\164\141\137\x75\x72\154"]))) {
            goto Yt;
        }
        if (!empty($_FILES["\155\x65\x74\x61\144\141\164\x61\x5f\146\x69\154\145"]["\164\x6d\160\137\x6e\141\155\145"])) {
            goto zF;
        }
        $mK = filter_var($d1["\155\x65\x74\141\x64\141\x74\x61\137\x75\x72\x6c"], FILTER_SANITIZE_URL);
        $R1 = curl_init();
        curl_setopt($R1, CURLOPT_URL, $mK);
        curl_setopt($R1, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($R1, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($R1, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($R1, CURLOPT_SSL_VERIFYHOST, false);
        $Do = curl_exec($R1);
        curl_close($R1);
        goto Vo;
        zF:
        $Do = @file_get_contents($_FILES["\155\x65\164\x61\x64\x61\x74\x61\x5f\146\151\x6c\145"]["\x74\155\x70\137\156\141\x6d\x65"]);
        Vo:
        $this->edit_metadata($Do, $d1);
        Yt:
    }
    private function upload_metadata($Do, $d1)
    {
        $mI = set_error_handler(array($this, "\x68\x61\156\x64\154\x65\130\x6d\154\x45\x72\162\x6f\x72"));
        $BG = new \DOMDocument();
        $BG->loadXML($Do);
        restore_error_handler();
        $SD = $BG->firstChild;
        if (!empty($SD)) {
            goto Xu;
        }
        if (empty($_FILES["\155\145\x74\x61\144\x61\x74\x61\137\146\x69\154\145"]["\164\155\160\x5f\156\x61\155\145"])) {
            goto b1;
        }
        throw new InvalidMetaDataFileException(MoIDPMessages::showMessage("\111\116\126\x41\x4c\111\104\137\x4d\105\124\x41\x44\x41\124\x41\137\x46\111\114\x45"));
        b1:
        if (empty($d1["\155\145\x74\x61\x64\141\x74\141\x5f\x75\162\154"])) {
            goto Fv;
        }
        throw new InvalidMetaDataUrlException();
        Fv:
        goto yJ;
        Xu:
        $ok = new MetadataReader($BG);
        $hB = $ok->getServiceProviders();
        if (!(empty($hB) && !empty($_FILES["\155\145\x74\141\x64\x61\x74\141\137\x66\x69\x6c\145"]["\164\155\x70\x5f\156\x61\x6d\145"]))) {
            goto w2;
        }
        throw new InvalidMetaDataFileException(MoIDPMessages::showMessage("\x49\116\x56\101\114\x49\104\x5f\x4d\x45\124\101\x44\101\124\101\x5f\106\x49\114\105"));
        w2:
        if (!(empty($hB) && !empty($d1["\155\x65\164\141\144\x61\164\x61\137\x75\x72\x6c"]))) {
            goto h4;
        }
        throw new InvalidMetaDataUrlException();
        h4:
        $this->_mo_idp_save_new_sp($hB[0], $d1);
        yJ:
    }
    private function edit_metadata($Do, $d1)
    {
        $mI = set_error_handler(array($this, "\x68\x61\156\144\154\x65\x58\x6d\x6c\x45\x72\x72\x6f\x72"));
        $BG = new \DOMDocument();
        $BG->loadXML($Do);
        restore_error_handler();
        $SD = $BG->firstChild;
        if (!empty($SD)) {
            goto Nv;
        }
        if (empty($_FILES["\155\145\164\x61\144\141\x74\141\137\x66\x69\154\x65"]["\164\x6d\160\137\x6e\x61\155\145"])) {
            goto FI;
        }
        throw new InvalidMetaDataFileException(MoIDPMessages::showMessage("\x49\x4e\126\x41\x4c\111\x44\137\x4d\x45\x54\x41\104\x41\124\101\x5f\x46\111\x4c\105"));
        FI:
        if (empty($d1["\155\x65\164\x61\x64\141\164\x61\137\165\162\154"])) {
            goto Pk;
        }
        throw new InvalidMetaDataUrlException();
        Pk:
        goto E0;
        Nv:
        $ok = new MetadataReader($BG);
        $hB = $ok->getServiceProviders();
        if (!(empty($hB) && !empty($_FILES["\155\x65\x74\x61\144\x61\164\x61\137\146\151\154\145"]["\x74\155\x70\x5f\x6e\x61\155\x65"]))) {
            goto bX;
        }
        throw new InvalidMetaDataFileException(MoIDPMessages::showMessage("\111\x4e\126\101\114\x49\104\137\115\x45\x54\101\104\x41\x54\x41\137\x46\111\114\105"));
        bX:
        if (!(empty($hB) && !empty($d1["\155\x65\x74\x61\144\x61\x74\141\x5f\x75\162\x6c"]))) {
            goto nC;
        }
        throw new InvalidMetaDataUrlException();
        nC:
        $this->_mo_idp_edit_sp($hB[0], $d1);
        E0:
    }
    public function handleXmlError($mZ, $oG, $u7, $wC)
    {
        if ($mZ == E_WARNING && substr_count($oG, "\x44\117\115\x44\157\x63\165\x6d\145\x6e\x74\72\x3a\154\x6f\141\144\x58\x4d\x4c\x28\x29") > 0) {
            goto u9;
        }
        return false;
        goto rW;
        u9:
        return;
        rW:
    }
    public function _mo_idp_save_new_sp($O1, $d1)
    {
        global $dbIDPQueries;
        $this->checkIfValidPlugin();
        if (!(MoIDPUtility::isBlank($d1["\x73\141\x6d\x6c\137\163\145\162\166\x69\x63\145\137\x6d\x65\x74\x61\x64\141\x74\141\137\160\x72\157\166\x69\x64\145\162"]) || MoIDPUtility::isBlank($O1->entityID) || MoIDPUtility::isBlank($O1->acsUrl) || MoIDPUtility::isBlank($O1->nameID))) {
            goto nW;
        }
        throw new RequiredFieldsException();
        nW:
        $Xc = $jX = array();
        $ly = $Xc["\x6d\157\137\151\x64\x70\137\x73\160\x5f\x6e\141\155\145"] = $jX["\x6d\x6f\137\x69\144\160\137\x73\160\x5f\x6e\141\x6d\x65"] = sanitize_text_field($d1["\x73\141\155\154\137\163\x65\162\166\151\x63\145\137\155\145\x74\x61\x64\x61\x74\141\x5f\160\162\x6f\166\151\144\x65\162"]);
        $t3 = $jX["\x6d\x6f\137\x69\x64\160\x5f\x73\x70\x5f\151\x73\x73\x75\x65\162"] = sanitize_text_field($O1->entityID);
        $this->checkIssuerAlreadyInUse($t3, NULL, $ly);
        $this->checkNameAlreaydInUse($ly);
        $jX = $this->collectData($O1, $jX);
        $N8 = $dbIDPQueries->insert_sp_data($jX);
        do_action("\x6d\157\x5f\x69\144\x70\137\163\x68\x6f\x77\137\x6d\x65\163\x73\x61\147\145", MoIDPMessages::showMessage("\123\x45\124\124\111\x4e\107\x53\x5f\123\101\126\x45\x44"), "\123\125\x43\x43\x45\123\x53");
    }
    public function _mo_idp_edit_sp($O1, $d1)
    {
        global $dbIDPQueries;
        $this->checkIfValidPlugin();
        if (!(MoIDPUtility::isBlank($d1["\163\x61\x6d\154\x5f\x73\145\162\166\151\x63\x65\137\x6d\145\x74\141\144\x61\164\x61\x5f\160\x72\157\166\151\x64\x65\162"]) || MoIDPUtility::isBlank($O1->entityID) || MoIDPUtility::isBlank($O1->acsUrl) || MoIDPUtility::isBlank($O1->nameID))) {
            goto HS;
        }
        throw new RequiredFieldsException();
        HS:
        $this->checkIfValidServiceProvider($d1, TRUE, "\x73\x65\x72\x76\x69\x63\145\137\x70\162\x6f\x76\151\x64\145\x72\x5f");
        $Xc = $jX = array();
        $tW = $Xc["\151\144"] = $d1["\x73\145\x72\166\151\x63\145\x5f\160\x72\157\166\151\x64\145\162\x5f"];
        $ly = $jX["\155\x6f\137\151\x64\x70\x5f\x73\x70\x5f\x6e\x61\155\x65"] = sanitize_text_field($d1["\x73\141\155\154\x5f\163\145\162\166\x69\x63\145\x5f\x6d\145\x74\141\x64\141\164\141\x5f\x70\x72\157\x76\x69\144\x65\x72"]);
        $t3 = $jX["\155\157\137\x69\144\x70\x5f\x73\x70\137\x69\x73\163\x75\145\162"] = sanitize_text_field($O1->entityID);
        $this->checkIssuerAlreadyInUse($t3, NULL, $ly);
        $this->checkNameAlreaydInUse($ly);
        $jX = $this->collectData($O1, $jX);
        $N8 = $dbIDPQueries->update_sp_data($jX, $Xc);
        do_action("\155\157\x5f\151\144\x70\137\163\150\x6f\x77\137\x6d\145\x73\x73\141\147\x65", MoIDPMessages::showMessage("\x53\x45\124\x54\111\x4e\x47\123\x5f\x53\x41\126\105\104"), "\x53\x55\103\x43\105\x53\x53");
    }
    private function collectData($O1, $jX)
    {
        $jX["\x6d\157\137\151\x64\160\137\141\143\163\x5f\x75\x72\x6c"] = sanitize_text_field($O1->acsUrl);
        $jX["\155\157\137\151\x64\160\x5f\156\x61\x6d\145\151\x64\137\146\x6f\x72\x6d\x61\164"] = sanitize_text_field($O1->nameID);
        $jX["\155\x6f\x5f\151\144\160\x5f\160\x72\x6f\x74\157\143\x6f\154\x5f\x74\171\x70\x65"] = sanitize_text_field("\123\x41\115\114");
        $lI = isset($O1->signingCertificate[0]) ? SAMLUtilities::sanitize_certificate(trim($O1->signingCertificate[0])) : NULL;
        $wG = isset($O1->encryptionCertificate[0]) ? SAMLUtilities::sanitize_certificate(trim($O1->encryptionCertificate[0])) : NULL;
        $Ae = NULL;
        $UB = isset($O1->sloBindingType) ? sanitize_text_field($O1->sloBindingType) : "\110\164\x74\x70\x52\x65\x64\x69\x72\145\x63\164";
        $VD = isset($O1->logoutDetails[$UB]) ? sanitize_text_field($O1->logoutDetails[$UB]) : NULL;
        if ($UB == "\110\124\124\x50\55\120\117\123\124") {
            goto Dq;
        }
        if ($UB == "\x48\124\x54\x50\x2d\122\x65\144\151\162\145\x63\164") {
            goto CS;
        }
        goto OC;
        Dq:
        $UB = "\x48\x74\164\160\x50\x6f\163\164";
        goto OC;
        CS:
        $UB = "\110\x74\x74\x70\122\145\144\151\162\x65\x63\x74";
        OC:
        $jX["\x6d\157\x5f\151\x64\160\137\154\157\147\x6f\x75\x74\x5f\165\x72\x6c"] = $VD;
        $jX["\x6d\x6f\137\151\144\x70\137\x63\x65\x72\x74"] = $lI;
        $jX["\x6d\x6f\137\151\x64\160\137\143\145\162\164\x5f\x65\x6e\143\x72\x79\x70\x74"] = $wG;
        $jX["\155\157\137\x69\x64\x70\137\x64\x65\x66\x61\x75\154\x74\x5f\x72\145\154\141\x79\x53\164\x61\x74\145"] = $Ae;
        $jX["\155\x6f\x5f\151\144\x70\x5f\x6c\x6f\x67\157\165\x74\137\x62\151\x6e\x64\151\x6e\x67\137\164\171\x70\x65"] = $UB;
        $jX["\x6d\157\x5f\151\144\x70\x5f\162\145\x73\160\x6f\156\x73\x65\x5f\163\x69\x67\156\x65\x64"] = isset($O1->assertionSigned) && strcmp($O1->assertionSigned, "\164\162\165\145") != 0 ? 1 : NULL;
        $jX["\x6d\x6f\137\151\x64\x70\x5f\x61\x73\x73\x65\x72\x74\x69\157\x6e\x5f\163\151\x67\x6e\x65\x64"] = isset($O1->assertionSigned) && strcmp($O1->assertionSigned, "\164\162\x75\145") == 0 ? 1 : NULL;
        $jX["\155\x6f\x5f\151\x64\x70\137\145\156\x63\162\171\160\x74\x65\144\x5f\x61\x73\x73\x65\162\x74\151\157\156"] = NULL;
        $this->checkIfValidEncryptionCertProvided($jX["\155\157\x5f\x69\x64\x70\x5f\x65\156\x63\162\171\x70\164\145\144\x5f\x61\x73\x73\145\162\x74\x69\157\x6e"], $jX["\x6d\x6f\137\x69\x64\x70\137\143\145\162\x74\137\x65\x6e\x63\x72\171\x70\164"]);
        return $jX;
    }
}
