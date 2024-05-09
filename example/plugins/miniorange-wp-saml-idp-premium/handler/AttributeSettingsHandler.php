<?php


namespace IDP\Handler;

use IDP\Exception\JSErrorException;
use IDP\Helper\Constants\MoIDPMessages;
use IDP\Helper\Database\MoDbQueries;
use IDP\Helper\Traits\Instance;
use IDP\Helper\Utilities\MoIDPUtility;
final class AttributeSettingsHandler extends SPSettingsUtility
{
    use Instance;
    public function mo_add_role_attribute($d1)
    {
        global $dbIDPQueries;
        $this->checkIfValidPlugin();
        $this->checkIfValidServiceProvider($d1, TRUE, "\x73\x65\162\166\151\x63\145\x5f\x70\x72\x6f\166\151\x64\145\162");
        $this->checkIfJSErrorMessage($d1);
        $jX = $Xc = array();
        $MG = null;
        $Kn = $Xc["\151\144"] = $d1["\x73\145\x72\x76\x69\143\145\x5f\x70\x72\x6f\166\151\x64\x65\x72"];
        if (!isset($d1["\x69\x64\160\137\162\x6f\154\x65\x5f\x61\x74\164\162\151\142\x75\164\145"])) {
            goto V9;
        }
        $Rf = $jX["\155\157\137\x69\144\160\137\x65\x6e\141\x62\154\x65\x5f\x67\x72\x6f\x75\160\137\x6d\x61\160\x70\x69\156\147"] = $d1["\x69\144\160\x5f\162\x6f\x6c\x65\x5f\141\164\x74\162\151\142\x75\x74\x65"];
        V9:
        if (empty($Rf)) {
            goto eU;
        }
        $MG = "\x67\162\x6f\x75\160\115\141\x70\116\141\155\x65";
        $zX = sanitize_text_field($d1["\x6d\157\137\151\x64\x70\x5f\x72\x6f\x6c\x65\x5f\155\x61\160\x70\x69\x6e\x67\137\156\141\155\x65"]);
        eU:
        $LE = $dbIDPQueries->get_sp_role_attribute($Kn);
        if (!isset($LE)) {
            goto NY;
        }
        $S1["\155\157\137\163\x70\137\151\144"] = $Kn;
        $S1["\x6d\x6f\x5f\163\160\x5f\x61\x74\164\162\137\x6e\x61\x6d\x65"] = "\147\162\x6f\x75\160\x4d\141\x70\116\141\x6d\x65";
        $S1["\x6d\x6f\x5f\141\164\x74\162\x5f\x74\x79\160\145"] = 1;
        $dbIDPQueries->delete_sp_attributes($S1);
        NY:
        if (is_null($MG)) {
            goto av;
        }
        if (MoIDPUtility::isBlank($zX)) {
            goto kz;
        }
        $s4 = array();
        $s4["\155\157\137\163\160\137\x69\x64"] = $Kn;
        $s4["\x6d\157\137\x73\x70\137\141\x74\164\162\x5f\x6e\x61\155\x65"] = sanitize_text_field($MG);
        $s4["\x6d\x6f\x5f\163\x70\x5f\x61\x74\164\x72\137\x76\141\x6c\165\145"] = sanitize_text_field($zX);
        $s4["\155\x6f\137\141\164\x74\162\x5f\x74\x79\x70\x65"] = 1;
        $dbIDPQueries->insert_sp_attributes($s4);
        $dbIDPQueries->update_sp_data($jX, $Xc);
        kz:
        av:
        do_action("\155\x6f\137\x69\x64\160\137\163\150\x6f\x77\137\x6d\x65\163\x73\141\147\x65", MoIDPMessages::showMessage("\x53\105\x54\x54\111\116\107\123\x5f\123\x41\x56\105\x44"), "\x53\125\103\x43\105\123\x53");
    }
    public function mo_idp_save_attr_settings($d1)
    {
        global $dbIDPQueries;
        $this->checkIfValidPlugin();
        $this->checkIfValidServiceProvider($d1, TRUE, "\163\x65\x72\x76\151\143\x65\137\160\x72\157\166\151\144\x65\162");
        $this->checkIfJSErrorMessage($d1);
        $jX = $Xc = array();
        $Kn = $Xc["\x69\144"] = $d1["\x73\x65\162\166\x69\x63\145\x5f\160\162\x6f\x76\x69\144\145\x72"];
        $MG = isset($d1["\155\157\x5f\151\x64\x70\137\x61\x74\x74\x72\151\142\x75\164\145\x5f\155\141\160\160\x69\x6e\x67\137\156\x61\x6d\145"]) ? $d1["\155\x6f\x5f\x69\144\x70\x5f\141\x74\x74\x72\x69\x62\x75\x74\145\137\155\141\160\x70\x69\156\x67\x5f\x6e\x61\x6d\145"] : '';
        $zX = isset($d1["\x6d\x6f\x5f\x69\144\160\x5f\x61\164\x74\162\x69\142\165\x74\145\x5f\155\x61\160\x70\x69\156\x67\x5f\x76\x61\154"]) ? $d1["\155\157\x5f\x69\x64\160\137\x61\164\x74\x72\151\x62\x75\x74\x65\x5f\x6d\141\160\x70\x69\x6e\147\137\166\141\154"] : '';
        $LE = $dbIDPQueries->get_sp_attributes($Kn);
        if (!isset($LE)) {
            goto nB;
        }
        $S1["\155\157\x5f\163\160\137\x69\144"] = $Kn;
        $S1["\x6d\157\137\x61\x74\164\162\x5f\x74\x79\x70\x65"] = 0;
        $dbIDPQueries->delete_sp_attributes($S1);
        nB:
        if (empty($MG)) {
            goto st;
        }
        foreach ($MG as $UV => $Ev) {
            if (MoIDPUtility::isBlank($Ev)) {
                goto og;
            }
            $s4 = array();
            $s4["\155\157\x5f\x73\x70\137\151\144"] = $Kn;
            $s4["\155\157\137\163\x70\137\x61\x74\164\162\137\156\x61\x6d\145"] = sanitize_text_field($Ev);
            $s4["\155\157\x5f\163\x70\x5f\x61\164\x74\x72\137\166\141\154\165\145"] = sanitize_text_field($zX[$UV]);
            $dbIDPQueries->insert_sp_attributes($s4);
            og:
            Bd:
        }
        bF:
        st:
        do_action("\x6d\157\137\151\x64\x70\x5f\163\150\x6f\167\137\x6d\145\163\163\x61\147\x65", MoIDPMessages::showMessage("\123\105\x54\124\111\116\107\123\137\x53\x41\126\105\x44"), "\123\125\x43\x43\105\123\x53");
    }
    public function mo_save_custom_idp_attr($d1)
    {
        global $dbIDPQueries;
        $this->checkIfValidPlugin();
        $this->checkIfValidServiceProvider($d1, TRUE, "\163\x65\162\x76\x69\x63\x65\x5f\x70\162\x6f\166\x69\x64\x65\x72");
        $this->checkIfJSErrorMessage($d1);
        $jX = $Xc = array();
        $Kn = $Xc["\151\x64"] = $d1["\163\145\x72\x76\151\143\145\137\160\x72\x6f\x76\x69\x64\x65\x72"];
        $MG = isset($d1["\155\157\137\x69\x64\x70\x5f\x61\x74\164\162\151\x62\x75\164\145\137\x6d\x61\x70\x70\x69\x6e\x67\x5f\156\141\x6d\145"]) ? $d1["\155\157\137\x69\144\x70\137\x61\x74\x74\x72\151\x62\x75\x74\145\x5f\x6d\x61\x70\x70\151\156\x67\x5f\x6e\x61\155\x65"] : '';
        $zX = isset($d1["\155\157\137\151\x64\x70\137\141\x74\164\x72\x69\x62\165\x74\145\137\x6d\x61\160\160\x69\x6e\x67\137\x76\x61\x6c"]) ? $d1["\155\x6f\137\151\144\x70\137\x61\164\x74\162\x69\x62\165\164\x65\137\x6d\141\x70\x70\x69\x6e\x67\x5f\x76\x61\x6c"] : '';
        $LE = $dbIDPQueries->get_custom_sp_attr($Kn);
        if (!isset($LE)) {
            goto lY;
        }
        $S1["\x6d\157\x5f\x73\x70\x5f\x69\x64"] = $Kn;
        $S1["\155\x6f\x5f\x61\x74\x74\162\137\x74\171\160\x65"] = 2;
        $dbIDPQueries->delete_sp_attributes($S1);
        lY:
        if (empty($MG)) {
            goto RG;
        }
        foreach ($MG as $UV => $Ev) {
            if (MoIDPUtility::isBlank($Ev)) {
                goto Vw;
            }
            $s4 = array();
            $s4["\155\157\x5f\x73\160\x5f\151\x64"] = $Kn;
            $s4["\x6d\157\x5f\163\160\137\x61\x74\164\162\137\156\x61\155\x65"] = sanitize_text_field(stripslashes($Ev));
            $s4["\x6d\157\137\163\x70\x5f\141\x74\x74\x72\x5f\x76\141\x6c\165\x65"] = sanitize_text_field(stripslashes($zX[$UV]));
            $s4["\155\157\137\141\164\164\x72\137\164\171\160\x65"] = 2;
            $dbIDPQueries->insert_sp_attributes($s4);
            Vw:
            R_:
        }
        bR:
        RG:
        do_action("\155\x6f\x5f\x69\x64\x70\137\163\x68\157\167\137\x6d\x65\x73\x73\141\147\145", MoIDPMessages::showMessage("\x53\105\x54\x54\111\116\x47\x53\x5f\123\101\126\105\104"), "\x53\125\103\x43\105\123\x53");
    }
}
