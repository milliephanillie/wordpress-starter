<?php


namespace IDP\Handler;

use IDP\Helper\Constants\MoIDPMessages;
use IDP\Helper\Traits\Instance;
use IDP\Helper\Utilities\MoIDPUtility;
use IDP\Helper\Utilities\PluginPageDetails;
use IDP\Helper\Utilities\TabDetails;
use IDP\Helper\Utilities\Tabs;
final class RegistrationHandler extends RegistrationUtility
{
    use Instance;
    private function __construct()
    {
        $this->_nonce = "\x72\145\x67\137\150\x61\156\x64\x6c\145\x72";
    }
    public function _idp_register_customer($d1)
    {
        $q1 = sanitize_email($d1["\x65\155\x61\x69\154"]);
        $u9 = sanitize_text_field($d1["\x70\x61\163\163\167\x6f\x72\144"]);
        $lr = sanitize_text_field($d1["\143\x6f\x6e\146\151\162\155\120\x61\x73\163\167\157\162\x64"]);
        $this->checkIfRegReqFieldsEmpty(array($q1, $u9, $lr));
        $this->checkPwdStrength($u9, $lr);
        $this->pwdAndCnfrmPwdMatch($u9, $lr);
        update_site_option("\155\157\137\x69\x64\x70\x5f\141\x64\x6d\151\x6e\137\145\x6d\141\151\154", $q1);
        update_site_option("\x6d\x6f\137\151\x64\160\137\x61\x64\155\x69\156\x5f\x70\x61\x73\163\x77\157\162\x64", $u9);
        $Qj = json_decode(MoIDPUtility::checkCustomer(), true);
        switch ($Qj["\163\x74\141\x74\x75\163"]) {
            case "\x43\x55\x53\x54\117\x4d\x45\122\x5f\116\117\x54\137\x46\117\x55\116\104":
                $this->_create_user_without_verification($q1, $u9);
                goto rv;
            default:
                $this->_get_current_customer($q1, $u9);
                goto rv;
        }
        jn:
        rv:
    }
    public function _mo_idp_phone_verification($d1)
    {
        $z6 = sanitize_text_field($d1["\x70\x68\157\x6e\145\137\156\165\x6d\142\x65\162"]);
        $z6 = str_replace("\x20", '', $z6);
        $this->isValidPhoneNumber($z6);
        update_site_option("\155\157\x5f\x63\165\163\164\157\x6d\x65\162\137\166\141\x6c\x69\x64\x61\x74\x69\x6f\x6e\x5f\x61\x64\x6d\x69\x6e\x5f\160\x68\x6f\x6e\x65", $z6);
        $this->_send_otp_token('', $z6, "\x53\115\123");
    }
    public function save_success_customer_config($tW, $HZ, $GP, $hr)
    {
        update_site_option("\x6d\x6f\x5f\x69\x64\160\137\x61\144\155\151\x6e\x5f\143\x75\x73\164\157\x6d\145\162\137\x6b\x65\171", $tW);
        update_site_option("\x6d\157\x5f\x69\x64\x70\x5f\x61\x64\155\151\156\137\141\160\151\137\x6b\x65\x79", $HZ);
        update_site_option("\x6d\157\x5f\x69\144\x70\137\143\x75\163\x74\x6f\155\x65\162\137\164\x6f\153\x65\156", $GP);
        delete_site_option("\155\x6f\137\x69\144\x70\137\x76\x65\162\x69\146\x79\137\x63\x75\163\x74\x6f\155\145\x72");
        delete_site_option("\x6d\157\x5f\x69\144\160\137\x6e\145\x77\137\162\145\147\x69\163\164\162\x61\164\151\x6f\156");
        delete_site_option("\x6d\x6f\x5f\151\x64\160\137\141\144\155\151\156\137\x70\141\x73\163\x77\x6f\162\x64");
        delete_site_option("\x6d\x6f\x5f\x69\144\x70\137\162\x65\147\x69\x73\164\162\x61\164\x69\x6f\156\137\163\x74\141\164\x75\163");
    }
    public function _mo_idp_go_back()
    {
        $this->isValidRequest();
        wp_clear_scheduled_hook("\x6d\157\137\151\144\160\x5f\x76\x65\162\x73\151\157\x6e\137\x63\x68\x65\x63\x6b");
        delete_site_option("\155\157\x5f\x69\144\x70\137\x74\162\x61\x6e\163\x61\143\x74\151\157\156\x49\144");
        delete_site_option("\x6d\x6f\x5f\x69\144\x70\x5f\141\144\x6d\x69\x6e\137\x70\141\163\x73\167\x6f\162\x64");
        delete_site_option("\x6d\157\137\x69\144\160\137\x72\x65\147\x69\163\x74\x72\x61\164\x69\157\156\x5f\163\x74\x61\164\x75\x73");
        delete_site_option("\x6d\157\x5f\151\x64\x70\x5f\141\x64\x6d\x69\156\x5f\x70\x68\x6f\x6e\145");
        delete_site_option("\x6d\157\x5f\x69\144\x70\x5f\x6e\145\167\137\162\x65\x67\151\163\x74\162\141\x74\x69\157\156");
        delete_site_option("\155\x6f\x5f\151\144\160\137\x61\x64\x6d\151\x6e\137\143\x75\163\x74\x6f\155\x65\x72\137\153\145\x79");
        delete_site_option("\x6d\157\137\151\144\160\x5f\x61\x64\x6d\x69\156\137\141\x70\151\x5f\153\x65\x79");
        delete_site_option("\x6d\157\x5f\x69\x64\x70\137\141\144\155\151\156\137\145\x6d\141\151\154");
        if (!($_POST["\157\160\x74\151\157\x6e"] === "\x72\145\x6d\x6f\x76\x65\x5f\151\x64\x70\137\x61\143\143\x6f\x75\x6e\x74")) {
            goto L3;
        }
        delete_site_option("\x73\155\154\x5f\x69\144\160\137\154\153");
        delete_site_option("\x74\137\163\151\164\x65\x5f\x73\164\x61\164\x75\x73");
        delete_site_option("\x73\151\x74\x65\x5f\x69\144\160\137\x63\153\154");
        delete_site_option("\163\155\x6c\x5f\151\144\160\137\x6c\145\x64");
        L3:
        update_site_option("\x6d\157\137\x69\x64\160\x5f\166\x65\x72\x69\x66\x79\x5f\143\165\x73\164\x6f\x6d\x65\162", $_POST["\x6f\160\164\x69\157\x6e"] === "\162\145\x6d\x6f\x76\145\137\151\144\160\x5f\141\x63\143\157\x75\x6e\164");
        update_site_option("\155\157\x5f\151\144\x70\137\x6e\145\x77\x5f\162\145\x67\151\x73\164\162\141\164\x69\x6f\156", $_POST["\157\x70\164\x69\157\x6e"] === "\x6d\157\137\151\144\x70\x5f\147\157\x5f\x62\x61\x63\153");
        $sO = remove_query_arg("\x70\x61\147\145", $_SERVER["\122\105\x51\125\x45\x53\x54\137\x55\122\111"]);
        $tk = TabDetails::instance()->_tabDetails[Tabs::PROFILE];
        wp_redirect(add_query_arg(array("\160\141\x67\145" => $tk->_menuSlug), $sO));
    }
    public function _mo_idp_forgot_password()
    {
        $q1 = get_site_option("\155\157\137\x69\x64\160\137\x61\x64\155\x69\156\137\x65\x6d\141\x69\x6c");
        $Qj = json_decode(MoIDPUtility::forgotPassword($q1), true);
        $this->checkIfPasswordResetSuccesfully($Qj, "\163\x74\x61\x74\x75\x73");
        do_action("\155\x6f\x5f\x69\x64\160\x5f\163\x68\x6f\x77\x5f\155\x65\x73\163\x61\147\145", MoIDPMessages::showMessage("\120\x41\123\123\x5f\122\105\x53\x45\x54"), "\x53\x55\103\103\x45\123\x53");
    }
    public function _mo_idp_verify_customer($d1)
    {
        $q1 = sanitize_email($d1["\145\155\x61\151\x6c"]);
        $u9 = sanitize_text_field($d1["\x70\x61\163\x73\167\157\162\144"]);
        $this->checkIfRequiredFieldsEmpty(array($q1, $u9));
        $this->_get_current_customer($q1, $u9);
    }
    public function _send_otp_token($q1, $z6, $bw)
    {
        $Qj = json_decode(MoIDPUtility::sendOtpToken($bw, $q1, $z6), true);
        $this->checkIfOTPSentSuccessfully($Qj, "\x73\164\141\164\165\163");
        update_site_option("\x6d\x6f\137\x69\x64\x70\137\164\x72\141\156\x73\141\x63\x74\x69\157\156\x49\144", $Qj["\x74\x78\111\x64"]);
        update_site_option("\x6d\x6f\x5f\x69\x64\160\137\x72\x65\147\x69\x73\x74\x72\141\164\x69\x6f\156\x5f\x73\164\141\x74\x75\x73", "\115\117\137\x4f\x54\120\x5f\104\105\114\x49\x56\x45\122\105\x44\x5f\x53\x55\103\x43\105\x53\x53");
        if ($bw == "\x45\115\101\111\x4c") {
            goto n1;
        }
        do_action("\155\157\137\151\144\160\137\x73\150\x6f\x77\137\155\x65\x73\x73\x61\x67\x65", MoIDPMessages::showMessage("\x50\x48\x4f\116\105\137\117\124\x50\137\123\x45\x4e\124", array("\160\150\157\156\x65" => $z6)), "\x53\x55\103\x43\105\123\123");
        goto oW;
        n1:
        do_action("\155\157\137\151\x64\x70\137\x73\x68\x6f\x77\137\155\x65\163\x73\x61\147\145", MoIDPMessages::showMessage("\x45\115\x41\111\114\x5f\117\124\x50\x5f\x53\105\116\124", array("\145\155\x61\151\x6c" => $q1)), "\123\125\x43\x43\x45\123\x53");
        oW:
    }
    public function _get_current_customer($q1, $u9)
    {
        $Qj = MoIdpUtility::getCustomerKey($q1, $u9);
        $eF = json_decode($Qj, true);
        if (json_last_error() == JSON_ERROR_NONE) {
            goto ce;
        }
        update_site_option("\155\157\x5f\151\x64\160\x5f\x76\x65\162\x69\x66\x79\x5f\x63\165\163\x74\157\155\x65\162", true);
        delete_site_option("\155\x6f\x5f\x69\144\160\137\156\x65\x77\x5f\162\145\x67\x69\163\x74\162\x61\x74\x69\x6f\x6e");
        do_action("\155\x6f\137\x69\x64\160\x5f\x73\x68\157\x77\x5f\155\x65\x73\163\141\147\x65", MoIDPMessages::showMessage("\101\103\x43\x4f\125\x4e\124\x5f\x45\x58\111\123\x54\123"), "\105\x52\x52\117\x52");
        goto Vv;
        ce:
        update_site_option("\x6d\157\137\151\144\160\x5f\x61\x64\x6d\x69\156\x5f\145\x6d\141\x69\154", $q1);
        $this->save_success_customer_config($eF["\151\x64"], $eF["\141\x70\x69\113\145\x79"], $eF["\x74\157\153\145\x6e"], $eF["\141\x70\160\123\x65\143\x72\145\164"]);
        if (!get_site_option("\163\155\x6c\x5f\x69\x64\x70\137\x6c\x6b")) {
            goto b4;
        }
        $this->verifyILK(get_site_option("\163\x6d\x6c\137\151\144\x70\x5f\154\x6b"));
        b4:
        Vv:
    }
    public function _idp_validate_otp($d1)
    {
        $UR = sanitize_text_field($d1["\x6f\x74\160\x5f\x74\157\153\145\156"]);
        $this->checkIfOTPEntered(array("\x6f\164\x70\137\x74\157\153\x65\156" => $d1));
        $Qj = json_decode(MoIDPUtility::validateOtpToken(get_site_option("\155\157\x5f\151\x64\x70\137\164\x72\141\156\163\x61\143\164\x69\x6f\x6e\x49\144"), $UR), true);
        $this->checkIfOTPValidationPassed($Qj, "\163\x74\x61\164\x75\x73");
        $eF = json_decode(MoIDPUtility::createCustomer(), true);
        if (strcasecmp($eF["\x73\164\141\164\165\163"], "\103\x55\x53\124\x4f\x4d\x45\122\137\x55\x53\105\x52\116\x41\x4d\105\137\101\x4c\x52\x45\101\104\x59\137\105\x58\111\123\x54\x53") == 0) {
            goto Kb;
        }
        if (!(strcasecmp($eF["\x73\x74\141\164\x75\x73"], "\x53\x55\103\103\x45\x53\x53") == 0)) {
            goto KO;
        }
        $this->save_success_customer_config($eF["\x69\144"], $eF["\141\160\151\x4b\145\x79"], $eF["\x74\157\x6b\x65\156"], $eF["\141\x70\160\123\145\143\x72\x65\x74"]);
        do_action("\155\157\137\151\x64\160\137\x73\150\157\x77\x5f\x6d\x65\163\163\141\147\x65", MoIDPMessages::showMessage("\x4e\x45\x57\137\122\105\107\x5f\123\125\x43\x43\105\x53"), "\123\125\x43\x43\x45\x53\x53");
        KO:
        goto Jw;
        Kb:
        do_action("\x6d\157\x5f\x69\x64\x70\x5f\163\x68\x6f\x77\137\155\145\x73\x73\141\147\x65", MoIDPMessages::showMessage("\101\x43\103\117\125\x4e\x54\137\105\130\x49\123\x54\123"), "\123\x55\103\x43\x45\x53\123");
        Jw:
    }
    public function _create_user_without_verification($q1, $u9)
    {
        $eF = json_decode(MoIDPUtility::createCustomer(), true);
        if (strcasecmp($eF["\163\164\141\164\165\163"], "\x43\125\123\x54\117\115\105\122\x5f\125\x53\x45\122\116\x41\115\105\x5f\x41\114\122\x45\101\x44\131\x5f\105\130\x49\x53\124\123") == 0) {
            goto yT;
        }
        if (!(strcasecmp($eF["\163\x74\141\x74\165\163"], "\x53\125\x43\103\105\123\x53") == 0)) {
            goto Yy;
        }
        $this->save_success_customer_config($eF["\151\144"], $eF["\141\x70\x69\x4b\x65\171"], $eF["\164\157\x6b\x65\x6e"], $eF["\141\x70\160\x53\145\143\162\x65\164"]);
        do_action("\x6d\x6f\137\x69\x64\x70\137\x73\x68\x6f\167\137\155\x65\163\163\x61\x67\145", MoIDPMessages::showMessage("\116\105\127\x5f\x52\x45\x47\137\x53\x55\103\103\x45\123"), "\123\125\x43\103\x45\x53\123");
        Yy:
        goto TT;
        yT:
        $this->_get_current_customer($q1, $u9);
        TT:
    }
    public function verifyILK($cT)
    {
        $UV = get_site_option("\x6d\x6f\x5f\151\x64\x70\137\x63\165\163\164\157\155\145\x72\x5f\164\x6f\x6b\145\x6e");
        $cT = \AESEncryption::decrypt_data($cT, $UV);
        $Qj = json_decode(MoIDPUtility::vml($cT), true);
        if (array_key_exists("\x73\x74\x61\164\165\x73", $Qj) && strcasecmp($Qj["\x73\164\141\x74\x75\x73"], "\123\x55\x43\x43\x45\x53\x53") == 0) {
            goto K1;
        }
        delete_site_option("\x73\155\x6c\x5f\x69\144\x70\137\154\x6b");
        do_action("\155\157\137\151\x64\160\x5f\163\150\157\167\137\155\x65\x73\163\141\x67\x65", moIDPMessages::showMessage("\x49\116\x56\101\x4c\111\104\137\114\x49\103\105\116\x53\105"), "\x45\x52\122\117\x52");
        goto fq;
        K1:
        do_action("\x6d\157\x5f\x69\x64\x70\137\163\x68\157\x77\137\155\x65\163\x73\141\147\x65", moIDPMessages::showMessage("\122\x45\107\137\123\125\x43\103\105\x53\123"), "\123\125\103\103\x45\123\123");
        fq:
    }
}
