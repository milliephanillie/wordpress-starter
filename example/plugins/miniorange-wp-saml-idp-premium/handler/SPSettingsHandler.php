<?php


namespace IDP\Handler;

use IDP\Helper\Constants\MoIDPMessages;
use IDP\Helper\Database\MoDbQueries;
use IDP\Helper\Traits\Instance;
use IDP\Helper\Utilities\MoIDPUtility;
use IDP\Helper\Utilities\SAMLUtilities;
final class SPSettingsHandler extends SPSettingsUtility
{
    use Instance;
    private function __construct()
    {
    }
    public function _mo_idp_save_new_sp($d1)
    {
        global $dbIDPQueries;
        $this->checkIfValidPlugin();
        $this->checkIfRequiredFieldsEmpty(array("\151\144\x70\137\x73\160\x5f\x6e\x61\155\145" => $d1, "\151\x64\x70\x5f\x73\160\137\x69\x73\163\x75\x65\162" => $d1, "\x69\144\x70\137\x61\143\163\x5f\x75\x72\x6c" => $d1, "\x69\x64\x70\x5f\156\x61\x6d\x65\151\144\x5f\x66\x6f\162\155\141\x74" => $d1));
        $Xc = $jX = array();
        $ly = $Xc["\155\x6f\x5f\x69\x64\x70\x5f\163\x70\137\x6e\x61\155\145"] = $jX["\155\157\137\151\144\160\137\163\160\x5f\156\x61\x6d\x65"] = sanitize_text_field($d1["\151\x64\x70\x5f\x73\x70\x5f\156\141\155\145"]);
        $t3 = $jX["\155\x6f\x5f\x69\144\x70\137\x73\x70\x5f\x69\163\x73\165\145\162"] = sanitize_text_field($d1["\x69\144\160\x5f\x73\160\x5f\151\x73\163\165\145\x72"]);
        $this->checkIssuerAlreadyInUse($t3, NULL, $ly);
        $this->checkNameAlreaydInUse($ly);
        $jX = $this->collectData($d1, $jX);
        $N8 = $dbIDPQueries->insert_sp_data($jX);
        do_action("\155\x6f\137\x69\144\x70\x5f\x73\150\157\167\137\x6d\x65\x73\x73\x61\147\145", MoIDPMessages::showMessage("\x53\x45\124\x54\x49\116\107\x53\x5f\x53\101\126\x45\x44"), "\x53\x55\103\103\x45\123\x53");
    }
    public function _mo_idp_edit_sp($d1)
    {
        global $dbIDPQueries;
        $this->checkIfValidPlugin();
        $this->checkIfRequiredFieldsEmpty(array("\151\x64\160\x5f\163\160\137\x6e\141\x6d\x65" => $d1, "\x69\144\x70\x5f\x73\160\137\x69\163\163\165\x65\162" => $d1, "\x69\x64\160\x5f\141\x63\163\137\165\x72\x6c" => $d1, "\151\x64\x70\x5f\x6e\141\x6d\x65\151\144\x5f\146\157\162\x6d\141\x74" => $d1));
        $this->checkIfValidServiceProvider($d1, TRUE, "\163\145\162\166\151\x63\x65\137\x70\162\157\166\151\x64\145\162");
        $jX = $Xc = array();
        $tW = $Xc["\151\x64"] = $d1["\163\x65\x72\166\x69\x63\145\137\x70\162\x6f\166\151\144\x65\x72"];
        $ly = $jX["\x6d\157\137\x69\x64\x70\x5f\163\x70\137\x6e\141\x6d\x65"] = sanitize_text_field($d1["\x69\144\160\x5f\163\160\137\156\x61\x6d\x65"]);
        $t3 = $jX["\155\157\x5f\151\x64\x70\x5f\163\160\137\x69\163\163\165\x65\x72"] = sanitize_text_field($d1["\151\x64\x70\x5f\163\x70\137\x69\163\x73\x75\145\162"]);
        $this->checkIfValidServiceProvider($dbIDPQueries->get_sp_data($tW));
        $this->checkIssuerAlreadyInUse($t3, $tW, NULL);
        $this->checkNameAlreaydInUse($ly, $tW);
        $jX = $this->collectData($d1, $jX);
        $dbIDPQueries->update_sp_data($jX, $Xc);
        do_action("\155\x6f\137\151\144\x70\x5f\163\150\157\x77\137\155\x65\x73\x73\x61\x67\145", MoIDPMessages::showMessage("\123\x45\124\x54\111\116\x47\x53\x5f\x53\x41\126\x45\104"), "\123\x55\103\103\105\x53\123");
    }
    public function mo_idp_delete_sp_settings($d1)
    {
        global $dbIDPQueries;
        MoIDPUtility::startSession();
        $this->checkIfValidPlugin();
        $LI = array();
        $LI["\151\144"] = $d1["\x73\160\x5f\x69\144"];
        $kc["\155\157\137\163\160\137\x69\144"] = $d1["\x73\x70\137\151\x64"];
        $dbIDPQueries->delete_sp($LI, $kc);
        if (!array_key_exists("\x53\x50", $_SESSION)) {
            goto o_;
        }
        unset($_SESSION["\x53\x50"]);
        o_:
        do_action("\155\157\x5f\151\x64\160\x5f\x73\150\x6f\x77\137\155\x65\x73\x73\141\147\145", MoIDPMessages::showMessage("\123\x50\x5f\x44\105\x4c\x45\124\105\104"), "\123\x55\103\x43\x45\123\123");
    }
    public function mo_idp_change_name_id($d1)
    {
        global $dbIDPQueries;
        $this->checkIfValidPlugin();
        $this->checkIfValidServiceProvider($d1, TRUE, "\163\x65\x72\166\x69\143\x65\137\x70\x72\x6f\x76\151\x64\x65\162");
        $jX = $Xc = array();
        $Kn = $Xc["\151\144"] = $d1["\163\x65\x72\166\151\143\145\137\160\x72\157\x76\x69\x64\x65\162"];
        $jX["\155\157\137\151\144\x70\137\x6e\141\x6d\x65\151\144\137\141\x74\164\x72"] = $d1["\x69\x64\160\x5f\x6e\x61\155\x65\151\x64\x5f\141\x74\164\x72"];
        $dbIDPQueries->update_sp_data($jX, $Xc);
        do_action("\x6d\x6f\137\151\144\160\137\163\150\157\167\137\155\145\163\163\141\147\x65", MoIDPMessages::showMessage("\x53\105\124\124\x49\116\x47\123\137\123\x41\x56\x45\104"), "\x53\125\x43\103\x45\123\x53");
    }
    public function _mo_sp_change_settings($d1)
    {
        $this->checkIfValidPlugin();
        $this->checkIfValidServiceProvider($d1, TRUE, "\x73\x65\162\166\x69\143\x65\x5f\160\162\x6f\166\x69\x64\x65\x72");
    }
    private function collectData($d1, $jX)
    {
        $jX["\x6d\157\x5f\151\144\160\x5f\x61\143\163\137\165\x72\154"] = sanitize_text_field($d1["\151\144\160\x5f\141\x63\x73\x5f\165\x72\x6c"]);
        $jX["\x6d\157\x5f\151\144\160\x5f\156\141\x6d\145\151\x64\137\146\157\x72\x6d\141\164"] = sanitize_text_field($d1["\151\144\160\x5f\156\141\155\x65\151\x64\137\146\x6f\x72\155\141\164"]);
        $jX["\155\x6f\137\x69\x64\160\137\x70\162\157\164\157\x63\157\x6c\x5f\164\x79\160\x65"] = sanitize_text_field($d1["\155\x6f\137\x69\x64\x70\x5f\160\162\x6f\x74\x6f\x63\157\x6c\x5f\x74\171\x70\145"]);
        $VD = isset($d1["\151\x64\160\x5f\x6c\157\x67\x6f\x75\x74\x5f\165\162\x6c"]) ? sanitize_text_field($d1["\x69\x64\x70\x5f\x6c\x6f\x67\157\165\164\x5f\165\162\154"]) : NULL;
        $lI = isset($d1["\x6d\157\137\151\144\x70\x5f\143\145\x72\x74"]) ? SAMLUtilities::sanitize_certificate(trim($d1["\155\157\x5f\x69\x64\x70\x5f\143\145\x72\164"])) : NULL;
        $wG = isset($d1["\x6d\x6f\137\x69\144\x70\x5f\143\x65\162\164\137\x65\x6e\143\162\x79\160\164"]) ? SAMLUtilities::sanitize_certificate(trim($d1["\x6d\x6f\x5f\151\x64\x70\x5f\x63\x65\162\x74\137\x65\156\x63\162\x79\x70\164"])) : NULL;
        $Ae = isset($d1["\x69\x64\160\x5f\x64\145\146\x61\x75\154\164\137\162\145\154\x61\171\x53\x74\x61\x74\145"]) ? sanitize_text_field($d1["\x69\144\x70\137\144\145\x66\141\165\x6c\x74\137\x72\145\x6c\141\171\x53\164\141\x74\145"]) : NULL;
        $UB = isset($d1["\x6d\157\x5f\x69\x64\160\137\154\x6f\x67\157\165\x74\137\x62\x69\156\x64\151\156\147\137\x74\x79\160\x65"]) ? $d1["\155\157\137\151\144\160\x5f\154\x6f\x67\157\x75\164\x5f\142\x69\x6e\144\x69\156\x67\x5f\x74\171\160\145"] : "\x48\164\x74\160\x52\145\144\151\162\x65\143\x74";
        $jX["\155\157\x5f\151\x64\x70\137\x6c\x6f\x67\157\165\x74\x5f\165\162\x6c"] = $VD;
        $jX["\x6d\x6f\137\151\x64\x70\x5f\143\x65\x72\x74"] = $lI;
        $jX["\155\157\x5f\x69\144\x70\137\x63\145\162\164\x5f\145\x6e\143\162\x79\160\x74"] = $wG;
        $jX["\x6d\157\x5f\151\144\160\137\144\x65\146\x61\x75\154\164\137\162\x65\154\141\x79\x53\x74\141\x74\x65"] = $Ae;
        $jX["\155\x6f\x5f\x69\x64\160\137\154\157\147\157\165\x74\137\x62\151\x6e\x64\151\x6e\147\x5f\x74\x79\x70\x65"] = $UB;
        $jX["\155\x6f\x5f\x69\144\160\x5f\x72\x65\x73\160\157\156\163\x65\137\x73\x69\147\156\145\x64"] = isset($d1["\151\x64\160\137\162\145\x73\160\157\x6e\163\145\x5f\x73\x69\147\156\145\x64"]) ? $d1["\x69\144\x70\x5f\162\x65\x73\x70\157\x6e\x73\145\137\x73\151\147\x6e\145\x64"] : NULL;
        $jX["\155\157\x5f\151\144\160\137\141\x73\x73\x65\162\164\151\157\x6e\x5f\x73\x69\x67\x6e\145\144"] = isset($d1["\151\x64\160\x5f\x61\163\x73\x65\162\x74\x69\x6f\x6e\x5f\x73\151\x67\156\145\x64"]) ? $d1["\x69\x64\160\x5f\x61\x73\x73\x65\x72\164\x69\157\x6e\137\163\x69\x67\156\x65\144"] : NULL;
        $jX["\x6d\x6f\x5f\151\144\x70\x5f\145\x6e\x63\x72\171\160\164\145\x64\137\141\x73\x73\x65\162\x74\x69\157\156"] = isset($d1["\x69\x64\x70\x5f\145\156\143\x72\171\x70\164\x65\144\137\141\x73\163\145\162\x74\151\x6f\156"]) ? $d1["\151\x64\x70\137\x65\x6e\143\x72\171\160\164\x65\144\137\x61\163\163\145\x72\164\x69\157\x6e"] : NULL;
        $this->checkIfValidEncryptionCertProvided($jX["\155\x6f\137\151\144\160\x5f\145\x6e\x63\x72\171\160\x74\145\144\x5f\x61\163\163\145\162\164\x69\x6f\x6e"], $jX["\x6d\x6f\x5f\x69\144\x70\x5f\x63\145\x72\164\137\x65\x6e\x63\x72\171\x70\x74"]);
        return $jX;
    }
    public function show_sso_users($d1)
    {
        $this->checkIfValidPlugin();
        update_site_option("\155\x6f\x5f\x69\144\160\137\x73\x68\x6f\x77\x5f\163\163\157\x5f\165\x73\x65\162\x73", array_key_exists("\163\x68\x6f\167\137\163\x73\157\137\x75\163\x65\162\163", $d1) ? TRUE : FALSE);
        do_action("\155\x6f\137\151\144\160\137\163\x68\157\x77\x5f\x6d\x65\163\x73\141\x67\145", MoIDPMessages::showMessage("\x53\105\124\124\x49\x4e\x47\x53\x5f\x53\x41\126\x45\x44"), "\x53\125\103\x43\x45\x53\123");
    }
}
