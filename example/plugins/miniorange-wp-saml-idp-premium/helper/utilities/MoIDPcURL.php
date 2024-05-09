<?php


namespace IDP\Helper\Utilities;

use IDP\Helper\Constants\MoIDPConstants;
use IDP\Helper\Utilities\MoIDPUtility;
class MoIDPcURL
{
    public static function create_customer($q1, $GT, $u9, $z6 = '', $aV = '', $td = '')
    {
        $mK = MoIDPConstants::HOSTNAME . "\57\155\157\141\x73\x2f\x72\145\163\x74\57\x63\165\163\164\157\x6d\145\162\57\x61\x64\x64";
        $eF = MoIDPConstants::DEFAULT_CUSTOMER_KEY;
        $HZ = MoIDPConstants::DEFAULT_API_KEY;
        $ke = array("\143\157\x6d\160\x61\x6e\171\x4e\141\x6d\145" => $GT, "\141\162\145\141\x4f\x66\x49\x6e\164\145\x72\145\163\x74" => MoIDPConstants::AREA_OF_INTEREST, "\146\x69\162\x73\164\156\x61\155\x65" => $aV, "\x6c\x61\163\x74\x6e\x61\155\145" => $td, "\145\x6d\x61\x69\x6c" => $q1, "\160\x68\x6f\156\x65" => $z6, "\160\141\x73\163\x77\157\162\144" => $u9);
        $p0 = json_encode($ke);
        $cF = self::createAuthHeader($eF, $HZ);
        $Zy = self::callAPI($mK, $p0, $cF);
        return $Zy;
    }
    public static function get_customer_key($q1, $u9)
    {
        $mK = MoIDPConstants::HOSTNAME . "\x2f\x6d\157\141\x73\x2f\162\x65\163\x74\57\143\165\x73\x74\157\155\145\x72\57\153\145\171";
        $eF = MoIDPConstants::DEFAULT_CUSTOMER_KEY;
        $HZ = MoIDPConstants::DEFAULT_API_KEY;
        $ke = array("\145\155\x61\151\154" => $q1, "\160\141\163\x73\x77\x6f\162\x64" => $u9);
        $p0 = json_encode($ke);
        $cF = self::createAuthHeader($eF, $HZ);
        $Zy = self::callAPI($mK, $p0, $cF);
        return $Zy;
    }
    public static function submit_contact_us($IW, $lx, $PU)
    {
        $current_user = wp_get_current_user();
        $mK = MoIDPConstants::HOSTNAME . "\57\x6d\x6f\141\x73\57\162\145\163\164\x2f\x63\x75\163\164\x6f\155\145\x72\x2f\143\x6f\156\x74\141\143\164\x2d\x75\163";
        $PU = "\x5b\127\x50\40\x49\104\x50\40\120\154\x75\x67\x69\156\135\72\40" . $PU;
        $eF = MoIDPConstants::DEFAULT_CUSTOMER_KEY;
        $HZ = MoIDPConstants::DEFAULT_API_KEY;
        $ke = array("\146\151\162\163\164\116\141\155\145" => $current_user->user_firstname, "\x6c\x61\163\164\x4e\x61\155\145" => $current_user->user_lastname, "\143\157\x6d\160\x61\x6e\171" => $_SERVER["\x53\x45\122\x56\x45\122\137\x4e\101\115\x45"], "\143\x63\105\x6d\x61\151\x6c" => MoIDPConstants::FEEDBACK_EMAIL, "\x65\155\x61\x69\x6c" => $IW, "\x70\150\x6f\x6e\x65" => $lx, "\x71\x75\145\x72\171" => $PU);
        $p0 = json_encode($ke);
        $cF = self::createAuthHeader($eF, $HZ);
        $Zy = self::callAPI($mK, $p0, $cF);
        return true;
    }
    public static function mius($eF, $HZ, $cT)
    {
        $mK = MoIDPConstants::HOSTNAME . "\57\x6d\x6f\x61\163\x2f\x61\x70\x69\x2f\x62\x61\x63\x6b\x75\160\x63\x6f\x64\x65\x2f\165\160\144\x61\x74\x65\x73\164\141\x74\x75\x73";
        $ke = array("\143\157\x64\145" => $cT, "\x63\165\163\x74\157\155\x65\162\x4b\145\x79" => $eF);
        $p0 = json_encode($ke);
        $cF = self::createAuthHeader($eF, $HZ);
        $Zy = self::callAPI($mK, $p0, $cF);
        return $Zy;
    }
    public static function notify($eF, $HZ, $Je, $Qj, $AH)
    {
        $mK = MoIDPConstants::HOSTNAME . "\57\x6d\x6f\x61\163\x2f\141\160\151\57\156\157\164\151\146\x79\57\x73\x65\156\144";
        $ke = array("\143\165\163\164\157\155\145\x72\x4b\x65\171" => $eF, "\x73\x65\156\144\105\x6d\141\x69\154" => true, "\x65\x6d\x61\151\154" => array("\x63\165\163\164\x6f\155\x65\162\x4b\x65\x79" => $eF, "\x66\x72\157\155\105\x6d\141\151\x6c" => "\151\x6e\146\x6f\x40\x78\x65\x63\165\162\151\146\171\x2e\x63\x6f\155", "\142\x63\143\x45\155\141\151\x6c" => "\163\141\x6d\154\163\x75\x70\x70\x6f\x72\x74\100\x78\x65\x63\x75\x72\151\x66\x79\56\143\157\155", "\146\162\x6f\x6d\x4e\x61\155\x65" => "\x6d\151\x6e\x69\117\x72\141\156\x67\145", "\x74\x6f\105\x6d\141\151\154" => $Je, "\x74\157\116\141\x6d\145" => $Je, "\x73\165\142\x6a\145\143\x74" => $AH, "\x63\x6f\x6e\164\145\156\x74" => $Qj));
        $p0 = json_encode($ke);
        $cF = self::createAuthHeader($eF, $HZ);
        $Zy = self::callAPI($mK, $p0, $cF);
    }
    public static function ccl($eF, $HZ)
    {
        $mK = MoIDPConstants::HOSTNAME . "\x2f\x6d\157\141\163\x2f\162\145\163\x74\57\x63\165\163\164\x6f\x6d\145\x72\57\x6c\x69\143\x65\x6e\x73\x65";
        $ke = array("\x63\165\163\x74\x6f\x6d\x65\x72\111\144" => $eF, "\x61\x70\160\x6c\x69\x63\141\x74\x69\x6f\156\116\141\155\145" => "\167\160\x5f\163\x61\155\x6c\x5f\x69\144\160");
        $p0 = json_encode($ke);
        $cF = self::createAuthHeader($eF, $HZ);
        $Zy = self::callAPI($mK, $p0, $cF);
        return $Zy;
    }
    public static function vml($eF, $HZ, $cT, $LH, $XT = false)
    {
        $mK = MoIDPConstants::HOSTNAME . "\57\x6d\x6f\x61\163\57\141\160\x69\x2f\x62\141\x63\x6b\165\x70\x63\157\144\145\x2f\166\145\162\151\x66\x79";
        if (!$XT) {
            goto Dk;
        }
        $mK = MoIDPConstants::HOSTNAME . "\x2f\155\x6f\141\163\x2f\141\x70\x69\x2f\x62\141\143\x6b\x75\x70\x63\x6f\x64\x65\x2f\x63\150\x65\x63\x6b";
        Dk:
        $ke = array("\x63\157\x64\x65" => $cT, "\143\165\x73\164\x6f\155\145\x72\x4b\145\x79" => $eF, "\141\x64\144\x69\164\151\x6f\x6e\x61\154\x46\151\145\154\x64\x73" => array("\146\151\x65\154\144\61" => $LH));
        $p0 = json_encode($ke);
        $cF = self::createAuthHeader($eF, $HZ);
        $Zy = self::callAPI($mK, $p0, $cF);
        return $Zy;
    }
    public static function send_otp_token($bw, $z6, $q1)
    {
        $mK = MoIDPConstants::HOSTNAME . "\57\x6d\157\141\163\57\141\160\151\57\x61\x75\164\x68\57\x63\x68\141\x6c\x6c\145\x6e\x67\145";
        $eF = MoIDPConstants::DEFAULT_CUSTOMER_KEY;
        $HZ = MoIDPConstants::DEFAULT_API_KEY;
        $ke = array("\143\x75\x73\x74\x6f\155\x65\162\x4b\145\x79" => $eF, "\x65\x6d\x61\151\154" => $q1, "\160\150\x6f\156\145" => $z6, "\x61\x75\164\x68\124\x79\160\145" => $bw, "\164\162\x61\x6e\x73\x61\x63\164\x69\x6f\x6e\x4e\x61\155\145" => MoIDPConstants::AREA_OF_INTEREST);
        $p0 = json_encode($ke);
        $cF = self::createAuthHeader($eF, $HZ);
        $Zy = self::callAPI($mK, $p0, $cF);
        return $Zy;
    }
    public static function validate_otp_token($yj, $uP)
    {
        $mK = MoIDPConstants::HOSTNAME . "\x2f\x6d\157\x61\163\57\141\x70\151\x2f\141\165\164\x68\57\166\141\154\x69\x64\x61\x74\x65";
        $eF = MoIDPConstants::DEFAULT_CUSTOMER_KEY;
        $HZ = MoIDPConstants::DEFAULT_API_KEY;
        $ke = array("\x74\170\x49\x64" => $yj, "\164\x6f\x6b\145\156" => $uP);
        $p0 = json_encode($ke);
        $cF = self::createAuthHeader($eF, $HZ);
        $Zy = self::callAPI($mK, $p0, $cF);
        return $Zy;
    }
    public static function check_customer($q1)
    {
        $mK = MoIDPConstants::HOSTNAME . "\57\155\x6f\x61\163\57\x72\x65\163\164\x2f\143\x75\x73\164\157\155\145\162\57\143\150\x65\x63\153\x2d\x69\146\x2d\x65\x78\x69\163\x74\x73";
        $eF = MoIDPConstants::DEFAULT_CUSTOMER_KEY;
        $HZ = MoIDPConstants::DEFAULT_API_KEY;
        $ke = array("\145\x6d\x61\x69\154" => $q1);
        $p0 = json_encode($ke);
        $cF = self::createAuthHeader($eF, $HZ);
        $Zy = self::callAPI($mK, $p0, $cF);
        return $Zy;
    }
    public static function forgot_password($q1, $eF, $HZ)
    {
        $mK = MoIDPConstants::HOSTNAME . "\x2f\x6d\x6f\141\x73\x2f\x72\145\163\x74\57\143\165\163\164\157\x6d\145\162\x2f\x70\x61\x73\163\167\157\x72\144\55\x72\x65\163\x65\164";
        $ke = array("\145\155\x61\151\154" => $q1);
        $p0 = json_encode($ke);
        $cF = self::createAuthHeader($eF, $HZ);
        $Zy = self::callAPI($mK, $p0, $cF);
        return $Zy;
    }
    private static function createAuthHeader($eF, $HZ)
    {
        $kH = round(microtime(true) * 1000);
        $kH = number_format($kH, 0, '', '');
        $AS = $eF . $kH . $HZ;
        $cF = hash("\163\x68\141\65\x31\62", $AS);
        $Oc = ["\x43\x6f\156\164\x65\156\164\55\124\171\x70\145" => "\141\160\x70\154\x69\143\141\164\x69\x6f\156\57\152\x73\157\156", "\103\x75\x73\164\x6f\x6d\145\x72\x2d\x4b\145\x79" => "{$eF}", "\x54\151\x6d\145\x73\164\x61\x6d\x70" => "{$kH}", "\x41\x75\x74\150\x6f\162\x69\172\141\x74\x69\157\156" => "{$cF}"];
        return $Oc;
    }
    private static function callAPI($mK, $be, $ZC = array("\x43\157\x6e\x74\x65\156\164\x2d\x54\171\160\145" => "\141\x70\x70\x6c\151\143\x61\x74\x69\x6f\x6e\57\x6a\163\157\x6e"))
    {
        $BM = ["\155\145\164\x68\x6f\144" => "\x50\x4f\x53\124", "\x62\157\x64\171" => $be, "\x74\151\155\x65\x6f\165\164" => "\x31\x30\x30\x30\60", "\x72\145\x64\x69\x72\x65\143\x74\151\x6f\156" => "\61\60", "\x68\x74\164\x70\166\x65\x72\163\151\157\x6e" => "\61\x2e\60", "\142\x6c\157\143\153\x69\156\147" => true, "\x68\x65\141\x64\145\x72\x73" => $ZC, "\163\x73\x6c\x76\145\x72\151\x66\x79" => MSI_TEST ? false : true];
        $Zy = wp_remote_post($mK, $BM);
        if (!is_wp_error($Zy)) {
            goto qu;
        }
        wp_die("\x53\x6f\x6d\x65\164\150\x69\x6e\x67\x20\167\145\156\x74\x20\167\162\x6f\156\x67\x3a\40\x3c\142\x72\x2f\x3e\40{$Zy->get_error_message()}");
        qu:
        return wp_remote_retrieve_body($Zy);
    }
}
