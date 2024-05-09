<?php


namespace IDP\Handler;

use IDP\Handler\BaseHandler;
use IDP\Helper\Constants\MoIDPMessages;
use IDP\Helper\Traits\Instance;
use IDP\Helper\Utilities\MoIDPUtility;
use IDP\Schedulers\SchedulerFactory;
final class LKHandler extends BaseHandler
{
    use Instance;
    private function __construct()
    {
    }
    public function _mo_verify_license($d1)
    {
        $this->checkIfRequiredFieldsEmpty(array("\151\x64\160\x5f\x6c\x6b" => $d1));
        $cT = trim($d1["\151\x64\160\x5f\154\x6b"]);
        $ne = json_decode(MoIDPUtility::ccl(), true);
        $so = array_key_exists("\156\157\x4f\146\x55\x73\145\162\x73", $ne) ? $ne["\x6e\157\117\x66\125\163\x65\162\x73"] : null;
        $nh = array_key_exists("\x6c\151\x63\145\156\x73\145\x45\170\x70\x69\162\171", $ne) ? strtotime($ne["\x6c\151\x63\x65\x6e\x73\x65\105\x78\x70\x69\x72\x79"]) === false ? null : strtotime($ne["\x6c\x69\x63\x65\156\163\145\x45\170\x70\151\162\x79"]) : null;
        switch ($ne["\163\164\x61\164\165\163"]) {
            case "\123\x55\103\x43\x45\123\123":
                $this->_vlk_success($cT, $so, $nh);
                goto vV;
            default:
                $this->_vlk_fail();
                goto vV;
        }
        Eb:
        vV:
    }
    public function _vlk_success($cT, $so, $nh)
    {
        $Qj = json_decode(MoIDPUtility::vml($cT), true);
        if (array_key_exists("\163\164\141\x74\165\x73", $Qj)) {
            goto P7;
        }
        do_action("\x6d\157\x5f\x69\144\x70\x5f\163\150\157\167\x5f\x6d\145\x73\163\x61\x67\x65", MoIDPMessages::showMessage("\105\122\122\x4f\x52\137\x4f\x43\x43\x55\x52\122\x45\104"), "\105\122\122\x4f\122");
        goto QD;
        P7:
        if (strcasecmp($Qj["\163\x74\141\x74\165\x73"], "\x53\125\x43\x43\x45\123\x53") == 0) {
            goto rt;
        }
        if (!(strcasecmp($Qj["\163\164\141\x74\x75\163"], "\x46\x41\x49\114\x45\x44") == 0)) {
            goto eM;
        }
        if (strcasecmp($Qj["\x6d\145\x73\163\x61\147\145"], "\x43\157\144\145\x20\150\x61\x73\x20\105\x78\160\x69\162\x65\144") == 0) {
            goto aG;
        }
        do_action("\x6d\157\x5f\x69\x64\x70\137\x73\150\157\x77\137\x6d\145\163\x73\x61\147\145", MoIDPMessages::showMessage("\x45\116\124\105\122\x45\104\x5f\x49\x4e\x56\x41\x4c\x49\x44\x5f\x4b\105\x59"), "\x45\x52\122\x4f\122");
        goto iP;
        aG:
        do_action("\x6d\157\137\x69\x64\x70\137\x73\x68\x6f\167\137\155\145\163\163\x61\147\x65", MoIDPMessages::showMessage("\114\111\103\105\116\123\x45\x5f\x4b\x45\131\137\111\116\137\x55\123\105"), "\x45\122\122\117\122");
        iP:
        eM:
        goto fZ;
        rt:
        $UV = get_site_option("\155\x6f\x5f\151\144\x70\x5f\143\x75\x73\x74\157\155\145\162\137\164\x6f\x6b\x65\x6e");
        update_site_option("\x73\155\154\x5f\151\144\160\x5f\x6c\153", \AESEncryption::encrypt_data($cT, $UV));
        update_site_option("\x73\x69\x74\145\x5f\x69\144\160\x5f\x63\x6b\x6c", \AESEncryption::encrypt_data("\164\162\165\x65", $UV));
        update_site_option("\164\x5f\163\151\x74\145\x5f\163\x74\x61\x74\165\163", \AESEncryption::encrypt_data("\x66\x61\154\x73\x65", $UV));
        if (MoIdpUtility::isBlank($so)) {
            goto U3;
        }
        update_site_option("\x6d\x6f\137\x69\x64\160\x5f\x75\x73\x72\137\x6c\155\x74", \AESEncryption::encrypt_data($so, $UV));
        U3:
        if (MoIdpUtility::isBlank($nh)) {
            goto vz;
        }
        update_site_option("\x73\x6d\x6c\x5f\151\144\160\x5f\154\x65\x64", \AESEncryption::encrypt_data($nh, $UV));
        vz:
        do_action("\155\157\x5f\151\144\x70\x5f\x73\150\157\167\137\155\x65\163\x73\141\x67\x65", MoIDPMessages::showMessage("\114\x49\103\105\x4e\123\105\x5f\126\x45\x52\x49\106\x49\x45\104"), "\x53\x55\x43\x43\x45\x53\123");
        fZ:
        QD:
    }
    public function _vlk_fail()
    {
        $UV = get_site_option("\x6d\x6f\x5f\x69\144\x70\x5f\143\x75\x73\164\157\155\145\x72\x5f\x74\157\153\x65\x6e");
        update_site_option("\163\x69\164\x65\137\151\x64\160\x5f\x63\153\154", \AESEncryption::encrypt_data("\146\141\x6c\x73\x65", $UV));
        do_action("\155\157\x5f\x69\x64\x70\137\163\150\157\167\x5f\x6d\145\x73\x73\141\x67\145", MoIDPMessages::showMessage("\x4e\x4f\124\x5f\125\120\x47\x52\101\104\x45\x44\x5f\131\105\124", array("\165\x72\154" => "\x68\164\x74\x70\163\x3a\57\57\160\154\x75\x67\x69\x6e\x73\56\155\151\x6e\151\157\x72\x61\x6e\147\145\56\x63\x6f\x6d\x2f\x77\x6f\x72\x64\x70\x72\x65\x73\163\x2d\x73\141\x6d\x6c\55\151\x64\x70\43\x70\x72\x69\143\x69\156\147")), "\x45\x52\122\117\122");
    }
    public static function checkLForR($cM)
    {
        if (!MSI_DEBUG) {
            goto le;
        }
        MoIDPUtility::mo_debug("\101\x6c\x65\162\164\x20\165\163\x65\162\x20\x74\150\x61\164\40\150\145\40\156\x65\x65\144\163\40\x74\157\x20\162\145\156\145\167\40\x68\151\163\40\x6c\x69\143\x65\156\x73\x65");
        le:
        $TY = SchedulerFactory::getInstance();
        if ($cM == "\x33\60") {
            goto yI;
        }
        if ($cM == "\61\x35") {
            goto XX;
        }
        if ($cM == "\x35") {
            goto GD;
        }
        MoIDPUtility::slrfae();
        $TY->unset5DaySchedule();
        $TY->setFinalCheckSchedule();
        goto rU;
        GD:
        MoIDPUtility::slrae($cM);
        $TY->unset10DaySchedule();
        $TY->set5DaySchedule("\60");
        rU:
        goto KV;
        XX:
        MoIDPUtility::slrae($cM);
        $TY->unset15DaySchedule();
        $TY->set10DaySchedule("\x35");
        KV:
        goto VQ;
        yI:
        MoIDPUtility::slrae($cM);
        $TY->unsetYearlySchedule();
        $TY->set15DaySchedule("\61\65");
        VQ:
    }
    public static function CheckIfUserHasRHisL()
    {
        if (!MSI_DEBUG) {
            goto Hf;
        }
        MoIDPUtility::mo_debug("\103\x68\145\143\153\151\x6e\x67\x20\151\x66\40\165\163\x65\162\x20\150\141\x73\x20\x72\x65\x6e\x65\167\145\x64\40\x68\151\x73\x20\154\151\143\x65\x6e\x73\x65");
        Hf:
        SchedulerFactory::getInstance()->unsetFinalCheckSchedule();
        MoIDPUtility::spdae();
        do_action("\x73\164\141\x72\164\x64\160\x72\157\x63\145\163\163");
    }
    public function refresh_sp_users_count()
    {
        $Qj = json_decode(MoIDPUtility::ccl(), true);
        if ($Qj) {
            goto Wn;
        }
        do_action("\155\x6f\x5f\151\144\x70\x5f\163\x68\x6f\167\137\155\145\x73\163\x61\x67\x65", MoIDPMessages::showMessage("\x45\122\122\117\122\x5f\x4f\103\x43\125\122\x52\105\x44"), "\105\x52\122\x4f\122");
        goto dp;
        Wn:
        update_site_option("\x6d\x6f\x5f\151\x64\x70\x5f\163\x70\137\x63\x6f\165\156\164", $Qj["\x6e\x6f\x4f\146\123\120"]);
        $so = array_key_exists("\x6e\157\117\146\x55\163\x65\162\163", $Qj) ? $Qj["\x6e\x6f\117\x66\125\163\145\x72\x73"] : null;
        $nh = array_key_exists("\x6c\151\143\145\x6e\x73\145\105\170\160\151\162\171", $Qj) ? strtotime($Qj["\154\151\143\x65\156\163\x65\x45\170\x70\151\x72\x79"]) === false ? null : strtotime($Qj["\x6c\x69\143\145\x6e\163\145\x45\x78\160\151\x72\x79"]) : null;
        $UV = get_site_option("\155\x6f\137\x69\x64\x70\x5f\x63\x75\x73\164\x6f\x6d\145\162\137\x74\x6f\x6b\145\156");
        if (!($nh > time() + 31 * 24 * 3600)) {
            goto my;
        }
        delete_site_option("\151\x64\160\x5f\x6c\151\143\x65\156\x73\x65\137\141\154\145\162\164\137\x73\x65\x6e\164");
        my:
        if (MoIdpUtility::isBlank($so)) {
            goto iJ;
        }
        update_site_option("\x6d\157\x5f\x69\x64\160\x5f\x75\163\x72\137\154\155\164", \AESEncryption::encrypt_data($so, $UV));
        iJ:
        if (MoIdpUtility::isBlank($nh)) {
            goto wx;
        }
        update_site_option("\x73\x6d\154\x5f\x69\144\x70\x5f\154\x65\x64", \AESEncryption::encrypt_data($nh, $UV));
        wx:
        dp:
    }
}
