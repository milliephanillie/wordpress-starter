<?php


namespace IDP\Helper\Utilities;

use IDP\Helper\Constants\MoIDPConstants;
use IDP\Helper\SAML2\MetadataGenerator;
use IDP\Exception\InvalidSSOUserException;
use IDP\Exception\InvalidOperationException;
class MoIDPUtility
{
    public static function getHiddenPhone($z6)
    {
        $NQ = "\170\170\x78\170\x78\x78\170" . substr($z6, strlen($z6) - 3);
        return $NQ;
    }
    public static function isBlank($Ev)
    {
        if (!(!isset($Ev) || empty($Ev))) {
            goto lg;
        }
        return TRUE;
        lg:
        return FALSE;
    }
    public static function isCurlInstalled()
    {
        return in_array("\143\165\162\154", get_loaded_extensions());
    }
    public static function startSession()
    {
        if (!(!session_id() || session_id() == '' || !isset($_SESSION))) {
            goto t9;
        }
        session_start();
        t9:
    }
    public static function validatePhoneNumber($z6)
    {
        return preg_match(MoIDPConstants::PATTERN_PHONE, $z6, $ZL);
    }
    public static function getCurrPageUrl()
    {
        $jz = "\150\x74\x74\160";
        if (!(isset($_SERVER["\x48\x54\124\x50\x53"]) && $_SERVER["\110\124\124\x50\x53"] == "\x6f\x6e")) {
            goto Sx;
        }
        $jz .= "\163";
        Sx:
        $jz .= "\72\57\57";
        if ($_SERVER["\123\105\x52\x56\105\122\x5f\120\117\122\x54"] != "\70\60") {
            goto YF;
        }
        $jz .= $_SERVER["\123\105\122\x56\105\122\137\116\101\115\x45"] . $_SERVER["\x52\105\121\125\x45\x53\124\137\x55\122\x49"];
        goto L2;
        YF:
        $jz .= $_SERVER["\123\105\x52\126\x45\122\x5f\x4e\101\115\x45"] . "\72" . $_SERVER["\123\105\122\x56\105\122\137\120\x4f\x52\x54"] . $_SERVER["\122\105\121\125\x45\123\124\x5f\x55\122\x49"];
        L2:
        if (!function_exists("\x61\x70\160\154\171\137\146\x69\x6c\x74\145\x72\x73")) {
            goto B3;
        }
        apply_filters("\x77\x70\160\142\137\x63\165\x72\160\141\x67\x65\x75\162\x6c", $jz);
        B3:
        return $jz;
    }
    public static function addSPCookie($t3, $B6 = '')
    {
        $hi = array("\x65\x78\160\151\162\145\x73" => time() + 21600, "\x70\x61\164\150" => "\57", "\163\x65\143\165\162\x65" => true, "\x73\141\x6d\145\x73\151\164\145" => "\x4e\157\x6e\145");
        if (!isset($_COOKIE["\x6d\157\x5f\x73\x70\x5f\x63\x6f\165\156\164"])) {
            goto EM;
        }
        $Uy = 1;
        fa:
        if (!($Uy <= $_COOKIE["\x6d\x6f\137\x73\x70\x5f\143\x6f\165\156\164"])) {
            goto rb;
        }
        if (!($_COOKIE["\x6d\157\x5f\163\160\137" . $Uy . "\x5f\x69\x73\163\x75\145\162"] == $t3)) {
            goto me;
        }
        return;
        me:
        fp:
        $Uy++;
        goto fa;
        rb:
        EM:
        $hU = isset($_COOKIE["\x6d\157\x5f\163\x70\x5f\x63\x6f\x75\x6e\164"]) ? $_COOKIE["\155\157\137\x73\160\x5f\143\x6f\x75\156\164"] + 1 : 1;
        setcookie("\x6d\x6f\137\x73\x70\137\143\157\x75\x6e\164", $hU, $hi);
        setcookie("\x6d\x6f\x5f\163\x70\x5f" . $hU . "\137\x69\x73\163\165\145\x72", $t3, $hi);
        setcookie("\155\x6f\x5f\163\x70\x5f" . $hU . "\137\163\145\163\x73\x69\157\156\111\156\144\x65\x78", $B6, $hi);
    }
    public static function getHiddenEmail($q1)
    {
        if (!(!isset($q1) || trim($q1) === '')) {
            goto s6;
        }
        return '';
        s6:
        $WR = strlen($q1);
        $Yf = substr($q1, 0, 1);
        $Pb = strrpos($q1, "\100");
        $J0 = substr($q1, $Pb - 1, $WR);
        $Uy = 1;
        yb:
        if (!($Uy < $Pb)) {
            goto ci;
        }
        $Yf = $Yf . "\x78";
        gc:
        $Uy++;
        goto yb;
        ci:
        $U2 = $Yf . $J0;
        return $U2;
    }
    public static function micr()
    {
        $q1 = get_site_option("\155\x6f\137\x69\x64\x70\137\x61\144\x6d\x69\x6e\137\145\155\141\x69\154");
        $eF = get_site_option("\155\157\x5f\151\x64\x70\137\141\x64\155\151\x6e\x5f\143\x75\163\164\x6f\x6d\x65\x72\137\153\145\x79");
        return !$q1 || !$eF || !is_numeric(trim($eF)) ? false : true;
    }
    public static function gssc()
    {
        global $dbIDPQueries;
        return $dbIDPQueries->get_sp_count();
    }
    public static function createCustomer()
    {
        $q1 = get_site_option("\x6d\x6f\137\151\144\x70\137\141\x64\x6d\x69\x6e\x5f\145\155\x61\x69\154");
        $z6 = get_site_option("\x6d\157\x5f\151\x64\160\137\141\x64\x6d\151\156\x5f\x70\150\x6f\156\145");
        $u9 = get_site_option("\155\x6f\137\x69\144\160\x5f\141\144\x6d\151\x6e\137\160\x61\x73\163\167\157\162\144");
        $Ta = get_site_option("\155\157\x5f\x69\144\x70\137\x63\x6f\155\x70\x61\156\x79\137\156\x61\155\x65");
        $jK = get_site_option("\155\157\x5f\151\144\160\x5f\146\151\162\163\x74\x5f\x6e\x61\155\x65");
        $dw = get_site_option("\155\157\137\x69\x64\160\137\x6c\141\x73\x74\137\156\x61\155\x65");
        $Qj = MoIDPcURL::create_customer($q1, $Ta, $u9, $z6, $jK, $dw);
        return $Qj;
    }
    public static function getCustomerKey($q1, $u9)
    {
        $Qj = MoIDPcURL::get_customer_key($q1, $u9);
        return $Qj;
    }
    public static function checkCustomer()
    {
        $q1 = get_site_option("\155\157\137\x69\144\160\137\141\x64\155\x69\156\137\x65\155\x61\x69\x6c");
        $Qj = MoIDPcURL::check_customer($q1);
        return $Qj;
    }
    public static function sendOtpToken($l1, $q1 = '', $z6 = '')
    {
        $Qj = MoIDPcURL::send_otp_token($l1, $z6, $q1);
        return $Qj;
    }
    public static function validateOtpToken($yj, $uP)
    {
        $Qj = MoIDPcURL::validate_otp_token($yj, $uP);
        return $Qj;
    }
    public static function submitContactUs($q1, $z6, $PU)
    {
        MoIDPcURL::submit_contact_us($q1, $z6, $PU);
        return true;
    }
    public static function forgotPassword($q1)
    {
        $q1 = get_site_option("\x6d\157\x5f\151\144\x70\x5f\x61\144\155\x69\x6e\137\145\155\x61\x69\154");
        $eF = get_site_option("\x6d\157\137\151\144\160\137\141\x64\x6d\x69\x6e\137\143\x75\x73\164\157\x6d\145\162\x5f\x6b\x65\x79");
        $HZ = get_site_option("\155\x6f\x5f\151\144\x70\x5f\141\x64\155\x69\156\137\x61\160\151\137\153\145\x79");
        $Qj = MoIDPcURL::forgot_password($q1, $eF, $HZ);
        return $Qj;
    }
    public static function ccl()
    {
        $eF = get_site_option("\155\x6f\137\x69\144\160\x5f\141\x64\x6d\151\156\137\x63\165\163\x74\x6f\155\145\x72\137\153\145\171");
        $HZ = get_site_option("\x6d\157\137\151\x64\x70\x5f\x61\144\x6d\x69\156\137\x61\160\151\137\x6b\x65\x79");
        $Qj = MoIDPcURL::ccl($eF, $HZ);
        return $Qj;
    }
    public static function unsetCookieVariables($Tx)
    {
        foreach ($Tx as $Xl) {
            unset($_COOKIE[$Xl]);
            setcookie($Xl, '', time() - 86400, "\x2f");
            U8:
        }
        ZN:
    }
    public static function getPublicCertPath()
    {
        return MSI_DIR . "\x69\156\143\154\x75\x64\145\163" . DIRECTORY_SEPARATOR . "\162\x65\x73\x6f\x75\x72\x63\x65\x73" . DIRECTORY_SEPARATOR . "\x69\x64\160\55\163\x69\147\156\151\156\x67\x2e\x63\x72\164";
    }
    public static function getPrivateKeyPath()
    {
        return MSI_DIR . "\151\x6e\143\154\x75\144\145\163" . DIRECTORY_SEPARATOR . "\x72\145\163\x6f\x75\162\143\145\x73" . DIRECTORY_SEPARATOR . "\151\x64\160\55\x73\x69\x67\156\151\156\x67\x2e\x6b\x65\171";
    }
    public static function getPublicCert()
    {
        return file_get_contents(MSI_DIR . "\x69\156\143\x6c\165\144\145\x73" . DIRECTORY_SEPARATOR . "\162\145\163\x6f\165\162\x63\x65\163" . DIRECTORY_SEPARATOR . "\151\144\x70\x2d\x73\x69\x67\156\x69\x6e\x67\56\x63\x72\164");
    }
    public static function getPrivateKey()
    {
        return file_get_contents(MSI_DIR . "\151\156\143\154\x75\144\145\163" . DIRECTORY_SEPARATOR . "\162\x65\x73\x6f\165\162\x63\145\163" . DIRECTORY_SEPARATOR . "\151\x64\x70\55\163\x69\x67\x6e\x69\x6e\147\x2e\x6b\x65\x79");
    }
    public static function getPublicCertURL()
    {
        return MSI_URL . "\151\156\x63\x6c\165\144\x65\163" . DIRECTORY_SEPARATOR . "\162\x65\163\x6f\x75\x72\x63\145\163" . DIRECTORY_SEPARATOR . "\151\144\x70\x2d\163\151\x67\x6e\151\156\147\56\x63\x72\164";
    }
    public static function mo_debug($aP)
    {
        error_log("\x5b\x4d\117\x2d\x4d\123\x49\55\x4c\x4f\107\x5d\133" . date("\x6d\55\144\x2d\x59", time()) . "\x5d\x3a\40" . $aP);
    }
    public static function createMetadataFile()
    {
        $xI = is_multisite() ? get_sites() : null;
        $YP = is_null($xI) ? site_url("\57") : get_site_url($xI[0]->blog_id, "\57");
        $gX = is_null($xI) ? site_url("\57") : get_site_url($xI[0]->blog_id, "\x2f");
        $M1 = get_site_option("\155\157\137\151\x64\160\x5f\x65\156\164\151\164\171\x5f\151\x64") ? get_site_option("\155\x6f\x5f\151\x64\160\137\x65\156\164\x69\x74\x79\x5f\x69\x64") : MSI_URL;
        $I3 = self::getPublicCert();
        $Qo = new MetadataGenerator($M1, TRUE, $I3, $YP, $YP, $gX, $gX);
        $ok = $Qo->generateMetadata();
        if (!MSI_DEBUG) {
            goto Ta;
        }
        MoIDPUtility::mo_debug("\x4d\145\164\x61\x64\x61\164\141\40\107\145\156\145\x72\x61\164\x65\x64\72\40" . $ok);
        Ta:
        $h_ = fopen(MSI_DIR . "\155\145\164\x61\x64\x61\164\141\x2e\170\155\x6c", "\x77");
        fwrite($h_, $ok);
        fclose($h_);
    }
    public static function showMetadata()
    {
        $xI = is_multisite() ? get_sites() : null;
        $YP = is_null($xI) ? site_url("\57") : get_site_url($xI[0]->blog_id, "\57");
        $gX = is_null($xI) ? site_url("\x2f") : get_site_url($xI[0]->blog_id, "\x2f");
        $M1 = get_site_option("\155\157\x5f\x69\144\160\x5f\145\x6e\164\151\164\x79\137\x69\x64") ? get_site_option("\x6d\157\x5f\x69\x64\160\x5f\x65\x6e\164\151\164\x79\x5f\x69\x64") : MSI_URL;
        $I3 = self::getPublicCert();
        $Qo = new MetadataGenerator($M1, TRUE, $I3, $YP, $YP, $gX, $gX);
        $ok = $Qo->generateMetadata();
        if (!ob_get_contents()) {
            goto n7;
        }
        ob_clean();
        n7:
        header("\103\x6f\x6e\x74\145\x6e\x74\55\x54\171\x70\x65\72\x20\164\x65\170\x74\57\170\x6d\154");
        echo $ok;
        exit;
    }
    public static function generateRandomAlphanumericValue($B0)
    {
        $R3 = "\141\x62\143\x64\x65\146\x30\x31\62\63\64\65\x36\67\x38\x39";
        $th = strlen($R3);
        $Rc = '';
        $Uy = 0;
        nk:
        if (!($Uy < $B0)) {
            goto TZ;
        }
        $Rc .= substr($R3, rand(0, 15), 1);
        Jn:
        $Uy++;
        goto nk;
        TZ:
        return "\x61" . $Rc;
    }
    public static function iclv()
    {
        $UV = get_site_option("\x6d\x6f\x5f\x69\x64\160\x5f\143\x75\x73\164\157\155\145\x72\x5f\164\157\153\145\x6e");
        $sk = \AESEncryption::decrypt_data(get_site_option("\x73\x69\x74\145\137\x69\144\160\x5f\x63\153\x6c"), $UV);
        $oc = get_site_option("\163\x6d\154\x5f\x69\x64\160\137\x6c\x6b");
        $q1 = get_site_option("\x6d\157\137\x69\144\160\x5f\x61\144\x6d\151\156\137\x65\x6d\x61\x69\x6c");
        $eF = get_site_option("\155\157\137\x69\144\x70\x5f\141\x64\x6d\x69\156\x5f\x63\165\x73\164\x6f\155\145\x72\x5f\153\145\171");
        return !($sk != "\164\162\x75\x65" || !$oc || !$q1 || !$eF || !is_numeric(trim($eF)));
    }
    public static function cled()
    {
        $UV = get_site_option("\155\x6f\x5f\x69\x64\160\x5f\143\165\x73\164\157\x6d\145\x72\x5f\x74\157\153\x65\x6e");
        $WK = get_site_option("\163\x6d\x6c\x5f\x69\144\160\137\x6c\x65\x64");
        $nh = null;
        if ($WK == null) {
            goto qR;
        }
        $nh = \AESEncryption::decrypt_data($WK, $UV);
        goto Vj;
        qR:
        $Qj = json_decode(self::ccl(), true);
        update_site_option("\155\157\x5f\x69\x64\x70\x5f\x73\160\x5f\x63\157\165\156\x74", $Qj["\156\157\117\146\123\x50"]);
        $so = array_key_exists("\156\x6f\117\146\x55\163\145\x72\x73", $Qj) ? $Qj["\x6e\x6f\x4f\146\125\x73\x65\162\163"] : null;
        $nh = array_key_exists("\154\x69\x63\x65\156\163\145\105\x78\160\151\x72\171", $Qj) ? strtotime($Qj["\154\151\x63\145\x6e\163\145\105\170\x70\x69\x72\x79"]) === false ? null : strtotime($Qj["\154\151\x63\x65\156\163\x65\105\x78\160\x69\x72\171"]) : null;
        if (self::isBlank($so)) {
            goto Tp;
        }
        update_site_option("\x6d\x6f\137\151\x64\160\x5f\x75\x73\162\137\154\x6d\164", \AESEncryption::encrypt_data($so, $UV));
        Tp:
        if (self::isBlank($nh)) {
            goto LZ;
        }
        update_site_option("\163\x6d\x6c\x5f\x69\144\x70\x5f\154\x65\144", \AESEncryption::encrypt_data($nh, $UV));
        LZ:
        Vj:
        $Ew = new \DateTime("\x40{$nh}");
        $r1 = new \DateTime();
        $k0 = $r1->diff($Ew)->format("\45\162\45\x61");
        if (!($k0 <= 30)) {
            goto tQ;
        }
        $SX = get_site_option("\151\144\160\x5f\x6c\x69\x63\145\156\163\145\x5f\x61\154\x65\162\x74\137\x73\145\156\164");
        if ($k0 > 7) {
            goto UV;
        }
        if ($k0 <= 7 && $k0 > 0) {
            goto ho;
        }
        if ($k0 <= 0 && $k0 > -15) {
            goto g2;
        }
        if (!($k0 <= -15)) {
            goto AH;
        }
        if (!($SX == null || $SX <= 0 && $SX > -15)) {
            goto Rq;
        }
        self::spdae();
        update_site_option("\151\x64\160\x5f\x6c\151\x63\x65\x6e\163\145\x5f\141\154\145\x72\x74\137\163\145\156\x74", $k0);
        Rq:
        return true;
        AH:
        goto Me;
        g2:
        if (!($SX == null || $SX <= 7 && $SX > 0)) {
            goto Ra;
        }
        self::slrfae();
        update_site_option("\x69\x64\160\x5f\x6c\151\143\145\156\163\145\137\x61\154\x65\162\164\137\163\145\156\x74", $k0);
        Ra:
        Me:
        goto FH;
        ho:
        if (!($SX == null || $SX <= 30 && $SX > 7)) {
            goto pn;
        }
        self::slrae($k0);
        update_site_option("\x69\144\160\x5f\x6c\151\x63\145\156\163\145\137\141\x6c\145\x72\164\137\163\145\156\164", $k0);
        pn:
        FH:
        goto P1;
        UV:
        if (!($SX == null)) {
            goto y5;
        }
        self::slrae($k0);
        update_site_option("\151\144\160\x5f\154\151\143\x65\x6e\163\145\137\x61\x6c\145\x72\x74\137\163\x65\x6e\164", $k0);
        y5:
        P1:
        tQ:
        return false;
    }
    public static function cvd()
    {
        $Qu = get_site_option("\151\x64\x70\x5f\166\154\x5f\x63\150\x65\x63\x6b\x5f\x74");
        if (empty($Qu)) {
            goto ht;
        }
        $Qu = intval($Qu);
        if (!(time() - $Qu < 3600 * 24 * 3)) {
            goto Av;
        }
        return false;
        Av:
        ht:
        $cT = get_site_option("\x73\x6d\x6c\137\151\x64\x70\x5f\x6c\x6b");
        $UV = get_site_option("\x6d\157\137\151\x64\x70\137\143\165\163\164\157\155\145\162\x5f\164\x6f\x6b\x65\x6e");
        if (!self::mo_idp_lk_multi_host()) {
            goto nf;
        }
        $cT = \AESEncryption::decrypt_data($cT, $UV);
        $Qj = json_decode(MoIDPUtility::vml($cT, true), true);
        if (strcasecmp($Qj["\x73\164\x61\164\165\x73"], "\123\x55\103\103\105\x53\123") == 0) {
            goto Pf;
        }
        return true;
        goto j9;
        Pf:
        delete_site_option("\151\144\x70\137\166\x6c\x5f\143\150\x65\x63\x6b\x5f\163");
        update_site_option("\151\x64\x70\137\166\154\x5f\x63\150\145\x63\153\x5f\x74", time());
        return false;
        j9:
        nf:
        if (empty($cT)) {
            goto t3;
        }
        $cT = \AESEncryption::decrypt_data($cT, $UV);
        $Qj = json_decode(MoIDPUtility::vml($cT, true), true);
        if (!(strcasecmp($Qj["\x73\164\x61\x74\x75\x73"], "\123\x55\103\103\x45\x53\x53") != 0)) {
            goto Zb;
        }
        update_site_option("\x69\144\160\x5f\166\154\x5f\143\150\145\x63\153\137\163", \AESEncryption::encrypt_data("\146\141\x6c\x73\145", $UV));
        Zb:
        t3:
        update_site_option("\151\x64\x70\x5f\166\154\137\x63\x68\x65\x63\x6b\x5f\164", time());
        return false;
    }
    public static function mo_idp_lk_multi_host()
    {
        $UV = get_site_option("\155\157\137\151\144\160\x5f\143\x75\163\x74\157\155\x65\x72\137\164\x6f\x6b\x65\x6e");
        $ws = get_site_option("\x69\x64\160\137\x76\x6c\x5f\x63\150\x65\143\x6b\137\163");
        if (empty($ws)) {
            goto w5;
        }
        $ws = \AESEncryption::decrypt_data($ws, $UV);
        if (!($ws == "\x66\x61\x6c\163\x65")) {
            goto sH;
        }
        return true;
        sH:
        w5:
        return false;
    }
    public static function vml($cT, $XT = false)
    {
        $eF = get_site_option("\x6d\157\137\151\144\x70\x5f\x61\x64\x6d\151\156\x5f\143\165\x73\x74\x6f\155\145\x72\x5f\153\x65\171");
        $HZ = get_site_option("\155\x6f\137\151\144\160\137\x61\144\155\x69\x6e\x5f\141\x70\151\x5f\x6b\x65\x79");
        $Qj = MoIDPcURL::vml($eF, $HZ, $cT, site_url(), $XT);
        return $Qj;
    }
    public static function mius()
    {
        $eF = get_site_option("\155\x6f\137\x69\x64\x70\x5f\141\144\155\151\156\137\x63\165\x73\x74\x6f\155\x65\x72\x5f\153\x65\x79");
        $HZ = get_site_option("\x6d\x6f\137\151\144\160\137\x61\x64\x6d\x69\x6e\x5f\x61\160\151\x5f\153\x65\x79");
        $UV = get_site_option("\155\x6f\x5f\151\144\x70\x5f\x63\165\x73\x74\x6f\x6d\145\162\x5f\164\157\x6b\145\x6e");
        $cT = \AESEncryption::decrypt_data(get_site_option("\163\x6d\154\x5f\151\x64\x70\137\x6c\x6b"), $UV);
        $Qj = MoIDPcURL::mius($eF, $HZ, $cT);
        return $Qj;
    }
    public static function suedae($GR)
    {
        if (!MSI_DEBUG) {
            goto Z2;
        }
        MoIDPUtility::mo_debug("\123\145\156\144\151\156\x67\40\165\x73\145\162\40\145\170\x63\145\x65\x64\x65\144\40\144\x65\154\141\x79\145\x64\x20\x61\x6c\145\162\x74\x20\145\x6d\x61\151\x6c");
        Z2:
        $eF = MoIDPConstants::DEFAULT_CUSTOMER_KEY;
        $HZ = MoIDPConstants::DEFAULT_API_KEY;
        $Je = get_site_option("\155\157\x5f\151\144\160\137\141\x64\x6d\151\156\137\145\155\141\151\x6c");
        $Qj = "\110\x65\x6c\x6c\x6f\54\74\142\162\x3e\74\x62\x72\76\131\157\165\x20\150\141\x76\145\40\160\x75\x72\143\150\x61\163\x65\x64\40\x6c\151\143\145\156\163\x65\40\146\157\162\x20\127\x6f\162\x64\x50\x72\145\163\x73\40\123\x41\x4d\x4c\x20\62\x2e\x30\40\111\104\120\40\x50\x6c\165\147\151\156\40\x66\x6f\x72\x20\x3c\x62\76" . $GR . "\40\165\x73\x65\x72\163\74\57\142\76\x2e\40\12\11\11\11\11\x9\11\101\163\40\x6e\165\155\142\145\x72\x20\x6f\146\x20\165\x73\x65\162\x73\x20\x6f\x6e\40\171\157\165\162\40\x73\x69\164\145\40\150\x61\166\145\40\x67\162\157\x77\156\40\164\x6f\x20\155\157\x72\x65\x20\x74\150\141\x6e\x20" . $GR . "\x20\165\x73\145\162\x73\40\x6e\x6f\x77\x2c\40\x79\x6f\165\x20\163\150\x6f\165\x6c\x64\x20\x75\160\147\162\x61\x64\145\x20\171\x6f\165\162\x20\165\x73\145\162\x20\12\x9\x9\x9\11\x9\11\154\151\x63\145\156\x73\145\x20\146\157\162\x20\141\40\x73\155\x6f\x6f\164\x68\x20\123\123\x4f\40\x65\x78\x70\145\x72\151\x65\156\x63\145\x20\146\x6f\x72\40\x79\157\165\x72\x20\x75\x73\x65\x72\x73\x20\157\156\40\x79\157\165\x72\x20\163\x69\164\145\x20\74\142\76" . get_bloginfo() . "\x3c\57\142\x3e\56\74\x62\x72\x3e\x3c\142\162\x3e\xa\11\11\11\x9\11\x9\x50\154\x65\x61\x73\x65\x20\162\145\x61\x63\x68\40\x6f\165\x74\x20\164\157\x20\x75\x73\40\141\x74\x20\74\141\x20\150\162\x65\146\75\x27\155\x61\x69\154\164\157\72\x69\x6e\146\157\x40\170\145\x63\165\x72\x69\x66\x79\56\143\157\x6d\47\x3e\151\156\146\x6f\100\x78\145\x63\x75\x72\x69\146\x79\x2e\143\157\x6d\74\57\x61\76\40\x6f\162\x20\165\x73\x65\x20\164\x68\x65\40\x53\x75\x70\x70\157\x72\164\40\106\157\162\155\40\x69\x6e\40\x74\150\145\x20\160\x6c\165\x67\151\156\x20\x74\157\x20\165\x70\x67\162\141\144\x65\40\x74\150\145\x20\x6c\x69\143\145\x6e\x73\145\x20\164\x6f\40\x63\x6f\x6e\164\x69\x6e\165\145\40\165\x73\x69\156\x67\x20\x6f\165\x72\x20\x70\x6c\165\x67\x69\156\x2e\12\x9\x9\11\x9\x9\x9\x3c\142\162\76\x3c\142\162\76\x54\x68\141\x6e\153\x73\x2c\x3c\142\x72\x3e\155\x69\156\151\x4f\162\141\156\147\x65";
        $AH = "\105\x78\143\x65\145\x64\145\144\x20\114\x69\143\x65\x6e\x73\x65\40\114\x69\x6d\x69\x74\40\x46\x6f\162\40\116\x6f\x20\117\146\x20\125\x73\145\x72\x73\40\55\40\x57\157\x72\144\120\x72\x65\163\163\x20\x53\x41\x4d\x4c\x20\x32\56\60\40\111\x44\120\x20\x50\x6c\165\x67\x69\x6e\x20\x7c\x20" . get_bloginfo();
        update_site_option("\165\x73\145\162\137\145\x78\143\x65\145\x64\145\144\137\x64\x65\154\141\x79\x65\x64\137\x61\x6c\145\x72\x74\x5f\x65\155\141\151\154\137\x73\145\x6e\x74", 1);
        $s_ = MSI_LK_DEBUG ? time() + 1800 : time() + 691200;
        if (!MSI_DEBUG) {
            goto sA;
        }
        MoIDPUtility::mo_debug("\x53\x65\x74\x74\151\156\x67\x20\104\145\154\x61\171\x65\x64\x20\x54\151\155\x65\x20\72\x20" . $s_ . "\40\x43\x75\162\162\x65\156\164\x20\124\x69\155\x65\x20\72\x20" . time());
        sA:
        update_site_option("\144\145\x6c\x61\171\x5f\165\163\x65\x72\137\162\x65\163\164\x72\151\x63\x74\151\157\x6e", $s_);
        MoIDPcURL::notify($eF, $HZ, $Je, $Qj, $AH);
    }
    public static function sueae($GR)
    {
        if (!MSI_DEBUG) {
            goto S1;
        }
        MoIDPUtility::mo_debug("\123\x65\156\144\x69\x6e\x67\40\x75\163\145\162\40\145\x78\x63\145\x65\144\145\x64\40\141\154\145\x72\x74\x20\x65\155\141\151\x6c");
        S1:
        $eF = MoIDPConstants::DEFAULT_CUSTOMER_KEY;
        $HZ = MoIDPConstants::DEFAULT_API_KEY;
        $Je = get_site_option("\155\157\137\151\x64\x70\137\x61\144\155\151\x6e\137\145\x6d\x61\x69\x6c");
        $Qj = "\110\x65\154\154\157\54\74\x62\162\x3e\x3c\x62\162\x3e\x59\x6f\x75\x20\150\141\x76\145\x20\x70\165\x72\x63\150\141\163\x65\x64\40\x6c\151\x63\x65\x6e\163\x65\x20\x66\157\x72\40\x57\x6f\x72\x64\x50\162\145\163\x73\40\x53\101\115\x4c\x20\62\x2e\60\40\111\104\120\40\120\154\x75\x67\151\156\40\x66\x6f\x72\x20\74\142\76" . $GR . "\40\165\x73\145\162\163\74\x2f\142\76\56\40\xa\11\x9\x9\x9\x9\x9\101\163\x20\x6e\165\155\142\x65\x72\40\x6f\x66\x20\165\163\x65\x72\163\40\x6f\x6e\x20\171\x6f\165\x72\40\x73\x69\164\x65\40\150\141\x76\x65\x20\147\x72\157\167\x6e\40\164\x6f\x20\x6d\x6f\162\145\40\164\150\141\x6e\x20" . $GR . "\x20\165\x73\x65\162\x73\x20\x6e\157\x77\x20\141\156\144\x20\x74\x68\x65\x20\x37\40\x64\x61\x79\163\x20\147\x72\141\x63\x65\x20\x70\145\162\151\x6f\144\x20\xa\11\11\x9\x9\x9\x9\151\163\40\x6f\166\145\x72\x2c\40\156\145\167\40\x75\163\x65\162\x73\40\x77\151\154\154\x20\156\157\x74\x20\x62\145\40\x61\x62\x6c\145\40\x74\x6f\x20\x75\163\145\40\123\123\117\x20\x63\x61\160\x61\142\x69\154\x69\164\x69\x65\x73\40\146\x6f\x72\40\171\x6f\x75\x72\x20\x73\x69\164\145\x20\x3c\142\x3e" . get_bloginfo() . "\74\57\142\x3e\x2e\74\x62\162\x3e\74\142\162\x3e\12\11\11\11\11\x9\x9\120\154\145\141\163\145\x20\x72\x65\x61\143\x68\40\x6f\x75\x74\x20\164\157\x20\165\163\40\x61\x74\x20\x3c\141\40\150\162\x65\x66\x3d\x27\155\141\151\x6c\164\157\x3a\151\156\x66\157\100\x78\x65\143\x75\x72\151\x66\x79\56\143\157\x6d\47\x3e\151\156\146\x6f\100\170\145\143\165\162\151\x66\171\x2e\143\x6f\155\x3c\x2f\x61\x3e\40\x6f\162\x20\x75\163\x65\40\164\150\x65\40\123\165\x70\x70\x6f\162\164\40\106\x6f\162\155\40\151\156\x20\164\150\x65\40\160\154\x75\x67\x69\156\40\x74\x6f\x20\165\x70\x67\162\x61\x64\x65\x20\164\x68\145\40\x6c\x69\143\x65\156\x73\x65\40\164\x6f\40\143\157\x6e\164\151\156\x75\x65\x20\x75\163\x69\x6e\x67\x20\157\165\162\x20\160\x6c\x75\x67\x69\156\x2e\12\x9\11\11\x9\11\11\x3c\x62\x72\x3e\74\x62\162\x3e\124\150\x61\156\153\163\54\74\142\x72\76\x6d\151\156\x69\x4f\162\x61\x6e\147\x65";
        $AH = "\x45\x78\x63\x65\x65\x64\x65\144\40\114\151\143\145\x6e\163\x65\x20\114\151\x6d\151\x74\x20\x46\157\162\x20\x4e\x6f\40\117\x66\40\125\163\x65\x72\163\x20\x2d\40\x57\x6f\x72\x64\x50\x72\145\163\163\x20\x53\x41\115\114\40\x32\x2e\60\40\111\x44\x50\40\120\x6c\x75\x67\x69\156\x20\174\x20" . get_bloginfo();
        update_site_option("\x75\x73\x65\162\137\x65\170\143\145\145\x64\x65\144\x5f\x61\154\145\x72\x74\x5f\x65\155\141\x69\154\x5f\x73\145\x6e\x74", 1);
        MoIDPcURL::notify($eF, $HZ, $Je, $Qj, $AH);
    }
    public static function slrae($mJ)
    {
        if (!MSI_DEBUG) {
            goto ak;
        }
        MoIDPUtility::mo_debug("\123\145\156\x64\151\x6e\x67\40\154\151\x63\x65\x6e\x73\x65\x20\x72\x65\x6e\x65\167\40\141\x6c\x65\162\x74\x20\145\155\141\151\x6c");
        ak:
        $eF = MoIDPConstants::DEFAULT_CUSTOMER_KEY;
        $HZ = MoIDPConstants::DEFAULT_API_KEY;
        $Je = get_site_option("\155\x6f\x5f\x69\x64\160\x5f\x61\x64\155\151\156\x5f\x65\x6d\x61\x69\154");
        $Qj = "\110\145\x6c\x6c\157\x2c\x3c\142\162\76\74\142\x72\76\x54\x68\x69\163\x20\x65\x6d\x61\151\x6c\x20\151\163\40\x74\x6f\40\156\157\164\151\146\171\40\171\157\165\40\164\x68\141\x74\40\x79\157\x75\x72\x20\x31\40\x79\x65\x61\x72\x20\154\x69\x63\145\156\163\145\x20\146\157\x72\40\x57\157\x72\x64\120\162\145\x73\163\40\123\101\x4d\114\40\62\56\60\x20\x49\x44\x50\x20\x50\x6c\165\x67\151\x6e\x20\167\x69\154\154\x20\145\170\x70\151\x72\x65\40\12\11\x9\x9\11\x9\x9\151\x6e\x20" . $mJ . "\x20\144\141\171\163\56\x20\124\150\x65\x20\x70\x6c\x75\147\x69\x6e\x20\x77\x69\x6c\x6c\x20\163\x74\x6f\x70\40\167\x6f\x72\x6b\x69\x6e\x67\x20\141\146\x74\x65\162\x20\164\x68\x65\40\154\x69\x63\145\156\163\x65\144\x20\160\x65\x72\x69\x6f\x64\x20\145\170\160\151\162\x65\163\56\74\x62\x72\76\74\x62\162\76\xa\x9\x9\x9\x9\x9\x9\131\x6f\x75\40\x77\x69\154\x6c\40\x6e\x65\x65\144\x20\x74\x6f\x20\x72\145\156\145\167\x20\x79\x6f\x75\x72\40\154\151\x63\145\x6e\163\145\x20\164\157\x20\143\x6f\156\x74\x69\156\x75\x65\40\165\x73\151\x6e\x67\40\164\x68\x65\40\160\x6c\x75\147\151\156\40\x6f\x6e\40\171\157\165\x72\40\x77\145\142\x73\x69\164\145\x20\74\x62\x3e" . get_bloginfo() . "\74\57\142\76\56\12\11\11\x9\x9\11\x9\74\x62\x72\x3e\x3c\x62\x72\76\103\x6f\x6e\x74\141\143\164\x20\165\x73\40\141\x74\40\x3c\141\x20\x68\162\x65\x66\75\47\155\x61\x69\x6c\164\157\x3a\x69\x6e\146\157\x40\170\145\143\165\x72\x69\146\171\x2e\x63\x6f\155\47\76\x69\156\x66\x6f\x40\x78\145\143\x75\162\151\x66\171\56\143\x6f\x6d\x3c\x2f\141\76\x20\151\146\x20\x79\157\165\40\x77\x69\163\x68\x20\x74\x6f\x20\162\x65\156\x65\x77\40\171\x6f\165\162\x20\154\151\143\145\156\163\145\56\x3c\x62\x72\x3e\x3c\x62\x72\76\x54\x68\x61\156\153\x73\54\x3c\142\162\76\x6d\x69\156\x69\117\162\x61\156\147\x65";
        $AH = "\x4c\151\x63\145\x6e\163\145\40\105\170\160\x69\x72\x79\x20\55\40\x57\x6f\x72\x64\x50\x72\145\x73\163\x20\123\x41\115\114\x20\x32\56\x30\x20\x49\104\x50\40\120\154\165\x67\x69\x6e\x20\174\40" . get_bloginfo();
        MoIDPcURL::notify($eF, $HZ, $Je, $Qj, $AH);
    }
    public static function slrfae()
    {
        if (!MSI_DEBUG) {
            goto aF;
        }
        MoIDPUtility::mo_debug("\123\145\x6e\144\151\x6e\x67\x20\x6c\151\143\x65\x6e\x73\145\40\x72\145\156\145\167\x20\146\151\x6e\x61\154\x20\141\x6c\x65\x72\164\x20\x65\155\x61\x69\154");
        aF:
        $eF = MoIDPConstants::DEFAULT_CUSTOMER_KEY;
        $HZ = MoIDPConstants::DEFAULT_API_KEY;
        $Je = get_site_option("\155\x6f\x5f\x69\144\x70\x5f\141\x64\155\151\x6e\137\145\155\x61\x69\x6c");
        $Qj = "\110\145\x6c\x6c\157\54\74\x62\162\76\74\x62\x72\76\131\x6f\x75\162\x20\x31\40\171\x65\141\162\x20\x6c\x69\143\x65\x6e\x73\145\40\x66\157\x72\40\127\x6f\x72\x64\x50\162\145\163\163\40\x53\x41\x4d\x4c\x20\x32\x2e\x30\40\111\x44\120\40\120\154\165\147\x69\156\40\150\141\x73\x20\x65\170\160\151\x72\x65\144\x20\146\157\x72\x20\171\x6f\165\x72\40\x77\x65\x62\163\151\x74\145\40\x3c\x62\x3e" . get_bloginfo() . "\x3c\57\142\x3e\x2e\x20\xa\x9\x9\11\11\x9\11\124\x68\x65\x20\160\x6c\165\x67\x69\156\40\x77\x69\x6c\154\x20\163\164\157\160\40\x77\x6f\162\153\151\156\x67\x20\163\157\x6f\156\x2e\74\142\x72\76\x3c\142\162\x3e\131\157\165\40\x77\151\x6c\x6c\40\156\x65\x65\144\x20\164\x6f\40\162\x65\x6e\x65\167\40\x79\157\165\x72\x20\x6c\151\143\145\156\x73\145\x20\x74\x6f\40\143\x6f\x6e\x74\151\156\165\145\40\165\163\x69\156\147\x20\164\150\145\40\x70\154\165\147\x69\156\x2e\xa\11\11\x9\11\x9\11\103\x6f\x6e\164\141\143\x74\40\165\163\40\141\x74\40\x3c\x61\40\x68\x72\x65\x66\75\47\155\x61\151\154\164\x6f\72\x69\x6e\x66\x6f\x40\x78\x65\143\x75\x72\x69\146\x79\x2e\x63\x6f\155\47\x3e\x69\x6e\146\x6f\x40\x78\x65\143\x75\x72\x69\146\x79\56\x63\157\x6d\x3c\x2f\x61\76\40\x69\146\40\171\x6f\165\40\x77\x69\x73\150\x20\164\x6f\x20\x72\x65\x6e\145\x77\40\x79\157\165\x72\x20\154\x69\143\x65\156\x73\145\x2e\x3c\142\x72\76\74\142\x72\76\124\x68\x61\x6e\153\163\54\74\x62\x72\76\x6d\x69\x6e\x69\x4f\162\141\156\147\x65";
        $AH = "\x4c\151\x63\145\156\x73\145\x20\x45\170\160\151\162\145\144\40\x2d\x20\127\157\x72\144\x50\x72\x65\x73\163\40\123\x41\x4d\x4c\x20\62\56\x30\40\x49\x44\120\x20\120\154\x75\147\x69\156\x20\174\x20" . get_bloginfo();
        MoIDPcURL::notify($eF, $HZ, $Je, $Qj, $AH);
    }
    public static function spdae()
    {
        if (!MSI_DEBUG) {
            goto sd;
        }
        MoIDPUtility::mo_debug("\123\145\x6e\x64\x69\x6e\147\40\x70\154\165\x67\151\x6e\40\x64\145\141\143\x74\x69\166\x61\164\145\144\40\x65\155\x61\x69\x6c");
        sd:
        $eF = MoIDPConstants::DEFAULT_CUSTOMER_KEY;
        $HZ = MoIDPConstants::DEFAULT_API_KEY;
        $Je = get_site_option("\x6d\x6f\x5f\151\144\160\137\141\x64\x6d\151\156\137\145\155\x61\x69\154");
        $Qj = "\110\145\154\x6c\x6f\54\x3c\x62\x72\x3e\74\x62\162\x3e\x59\x6f\x75\162\40\61\x20\171\x65\141\162\x20\x6c\x69\143\x65\x6e\x73\145\x20\146\157\162\x20\127\x6f\x72\144\x50\x72\x65\x73\x73\40\123\x41\x4d\x4c\40\62\56\60\x20\x49\104\120\x20\x50\154\x75\147\151\156\40\150\141\163\40\x65\170\160\151\162\x65\144\56\x20\131\157\165\x20\x68\x61\x76\145\x20\156\x6f\164\40\x72\145\156\145\167\x65\x64\40\171\x6f\x75\162\40\154\151\x63\145\156\163\145\x20\167\151\x74\150\x69\156\x20\xa\11\x9\11\11\11\11\164\x68\x65\40\61\65\x20\x64\x61\171\163\40\x67\162\x61\143\x65\x20\160\x65\162\151\157\x64\x20\147\151\x76\145\x6e\x20\x74\157\40\x79\x6f\165\56\x20\x54\x68\145\40\x53\x53\117\40\x68\141\x73\x20\142\x65\x65\x6e\x20\x64\x69\x73\x61\142\154\x65\144\x20\x6f\x6e\x20\x79\x6f\165\x72\40\167\x65\x62\163\151\x74\145\40\x3c\x62\x3e" . get_bloginfo() . "\x3c\x2f\142\76\x2e\x3c\142\x72\76\x3c\142\x72\76\xa\11\11\11\11\11\11\103\x6f\x6e\164\141\x63\164\40\x75\x73\40\x61\164\40\x3c\x61\40\x68\162\x65\146\75\47\x6d\141\151\154\x74\x6f\x3a\x69\x6e\x66\x6f\x40\170\145\143\x75\162\151\x66\171\x2e\x63\x6f\155\47\x3e\151\156\146\157\100\x78\x65\x63\x75\162\151\146\x79\x2e\143\157\155\x3c\x2f\x61\76\x20\x69\x66\40\171\157\x75\40\x77\151\163\x68\x20\x74\157\x20\x72\x65\x6e\145\x77\40\x79\x6f\x75\162\x20\x6c\x69\143\x65\x6e\163\145\56\74\x62\162\76\x3c\x62\162\76\x54\x68\141\x6e\x6b\x73\54\74\x62\x72\x3e\155\x69\x6e\151\x4f\x72\x61\156\147\145";
        $AH = "\x4c\151\143\x65\156\x73\145\x20\105\170\x70\151\x72\145\144\40\55\40\x57\157\x72\144\120\x72\145\x73\x73\40\x53\x41\115\114\x20\x32\x2e\60\40\111\x44\x50\x20\x50\154\165\147\x69\x6e\40\x7c\x20" . get_bloginfo();
        MoIDPcURL::notify($eF, $HZ, $Je, $Qj, $AH);
    }
    public static function suwae($GR, $B5)
    {
        if (!MSI_DEBUG) {
            goto E9;
        }
        MoIDPUtility::mo_debug("\x53\145\156\x64\151\x6e\147\40\165\x73\x65\x72\x20\167\x61\x72\156\x69\156\x67\40\141\154\145\162\x74\40\x65\x6d\141\x69\154");
        E9:
        $eF = MoIDPConstants::DEFAULT_CUSTOMER_KEY;
        $HZ = MoIDPConstants::DEFAULT_API_KEY;
        $Je = get_site_option("\x6d\x6f\137\151\x64\160\x5f\141\x64\x6d\151\156\x5f\x65\155\x61\151\x6c");
        $Qj = "\x48\145\154\x6c\157\x2c\x3c\x62\162\x3e\74\x62\x72\76\x59\157\165\x20\150\x61\166\x65\40\x70\165\x72\143\x68\141\163\x65\x64\40\154\x69\143\145\156\x73\145\x20\146\157\x72\40\127\157\162\144\x50\x72\x65\163\163\x20\123\x41\x4d\x4c\40\62\x2e\x30\40\111\104\120\40\120\154\165\147\151\156\x20\146\x6f\162\40\x3c\142\76" . $GR . "\x20\x75\163\x65\x72\163\74\57\142\x3e\x2e\x20\xa\x9\x9\x9\x9\11\11\x54\150\145\x20\x6e\x75\155\x62\x65\162\x20\157\x66\x20\165\x73\x65\x72\x73\x20\x6f\x6e\40\x79\157\x75\x72\x20\x73\x69\x74\x65\40\150\141\x76\x65\40\x67\162\x6f\167\x6e\x20\164\157\40\x6d\x6f\162\145\x20\164\150\x61\156\x20\x38\x30\45\40\50\x3c\142\x3e" . $B5 . "\40\165\x73\145\162\163\x3c\57\x62\76\x29\x20\157\x66\x20\164\x6f\164\141\x6c\40\x75\x73\x65\162\x73\40\156\157\x77\56\x20\12\x9\11\11\x9\x9\x9\131\x6f\x75\x20\x73\x68\x6f\165\x6c\144\x20\165\x70\x67\x72\x61\144\145\x20\x79\157\x75\162\x20\x6c\151\x63\x65\156\163\145\40\146\x6f\x72\x20\155\x69\x6e\151\x4f\x72\x61\x6e\x67\145\40\x57\x6f\162\144\120\x72\x65\x73\x73\40\123\101\115\x4c\x20\x32\x2e\x30\x20\x49\x44\120\40\x70\x6c\165\x67\151\x6e\x20\x6f\156\x20\x79\x6f\x75\x72\x20\x77\145\x62\x73\x69\x74\x65\40\x3c\x62\x3e" . get_bloginfo() . "\74\x2f\142\x3e\56\x3c\142\162\x3e\x3c\142\x72\x3e\12\x9\11\x9\11\x9\x9\120\154\145\141\x73\x65\x20\162\145\x61\x63\150\40\157\x75\164\40\x74\x6f\40\x75\163\x20\x61\x74\x20\74\x61\x20\150\x72\x65\x66\75\x27\x6d\141\x69\x6c\x74\x6f\72\151\156\x66\x6f\x40\x78\145\x63\165\162\x69\146\171\56\x63\157\155\47\x3e\151\156\x66\157\100\170\145\143\165\162\151\146\171\56\x63\x6f\155\74\x2f\141\76\x20\x6f\x72\40\x75\163\x65\x20\x74\150\x65\40\123\165\x70\x70\157\162\164\x20\x46\x6f\x72\155\x20\x69\x6e\x20\x74\x68\145\x20\x70\x6c\165\x67\151\156\x20\164\157\40\165\160\147\x72\x61\144\x65\x20\164\x68\x65\x20\x6c\x69\x63\x65\156\x73\x65\40\164\157\40\143\x6f\x6e\x74\151\x6e\x75\x65\40\165\x73\151\156\147\40\157\x75\x72\40\x70\154\165\147\x69\156\x2e\12\x9\11\11\x9\11\11\x3c\142\162\x3e\x3c\x62\x72\x3e\x54\150\x61\x6e\153\163\54\74\142\162\76\155\x69\156\x69\x4f\x72\141\x6e\147\x65";
        $AH = "\x52\145\x61\x63\x68\x65\x64\40\70\x30\45\40\114\151\x63\145\x6e\163\145\40\x4c\151\155\151\164\40\x46\x6f\x72\40\x4e\x6f\40\x4f\146\40\125\163\145\x72\x73\x20\55\40\127\157\x72\x64\x50\x72\x65\163\x73\x20\x53\x41\115\114\40\62\x2e\x30\x20\111\104\x50\x20\x50\x6c\165\147\151\156\40\174\40" . get_bloginfo();
        update_site_option("\x75\163\145\x72\137\165\x73\x65\x72\x5f\167\x61\162\x6e\x69\156\x67\137\x61\x6c\x65\x72\164\x5f\145\x6d\x61\151\154\x5f\163\x65\156\x74", 1);
        MoIDPcURL::notify($eF, $HZ, $Je, $Qj, $AH);
    }
    public static function cutol($user)
    {
        global $dbIDPQueries;
        if (!get_user_meta($user->ID, "\155\x6f\x5f\x69\x64\x70\x5f\x75\163\145\x72\137\x74\171\160\145", true)) {
            goto Tn;
        }
        if (!MSI_DEBUG) {
            goto R0;
        }
        MoIDPUtility::mo_debug("\122\x65\x70\x65\x61\164\40\x55\x73\x65\x72");
        R0:
        update_user_meta($user->ID, "\154\x61\163\x74\x5f\x6c\x6f\x67\147\145\144\137\x69\156", date("\155\55\171"));
        return;
        Tn:
        if (!MoIDPUtility::isBlank(get_site_option("\155\x6f\137\x69\x64\160\x5f\x75\163\162\x5f\x6c\x6d\164"))) {
            goto C6;
        }
        throw new InvalidOperationException();
        C6:
        if (!MSI_DEBUG) {
            goto o6;
        }
        MoIDPUtility::mo_debug("\x4e\145\x77\x20\123\123\117\40\x55\163\145\162");
        o6:
        $UV = get_site_option("\x6d\x6f\x5f\x69\x64\x70\x5f\143\x75\x73\x74\157\x6d\145\162\137\x74\x6f\x6b\x65\x6e");
        $Bk = \AESEncryption::decrypt_data(get_site_option("\155\x6f\x5f\x69\x64\160\x5f\165\x73\x72\137\154\x6d\x74"), $UV);
        $FY = $dbIDPQueries->get_users();
        $ql = get_site_option("\165\163\145\x72\137\x65\170\143\145\145\144\145\x64\x5f\x61\x6c\145\162\x74\137\145\x6d\x61\151\x6c\x5f\x73\145\156\164");
        $qX = get_site_option("\165\163\x65\162\x5f\x65\170\143\x65\x65\x64\x65\x64\137\144\145\x6c\141\x79\x65\144\x5f\141\154\x65\x72\164\x5f\145\155\x61\151\x6c\137\163\x65\x6e\x74");
        $wg = get_site_option("\144\x65\154\141\x79\137\x75\x73\145\x72\137\x72\x65\x73\164\x72\151\x63\x74\x69\x6f\156");
        if (!MSI_DEBUG) {
            goto Ur;
        }
        MoIDPUtility::mo_debug("\125\x73\145\x72\72\40" . $FY . "\x20\x41\154\x6c\157\167\x65\x64\x3a\40" . $Bk . "\x20\104\x65\154\x61\x79\145\x64\x20\105\x6d\141\x69\x6c\40\123\145\156\164\x3a\40" . $qX . "\40\x45\x78\x63\145\145\x64\x65\x64\40\105\x6d\141\x69\x6c\x20\x53\x65\156\164\x3a" . $ql);
        Ur:
        if (!MSI_DEBUG) {
            goto M1;
        }
        MoIDPUtility::mo_debug("\x44\145\154\141\x79\145\x64\x20\124\x69\154\154\x3a" . $wg . "\x20\103\x75\x72\x72\145\156\x74\x20\124\x69\155\x65\x3a" . time());
        M1:
        if (!(!MoIDPUtility::isBlank($wg) && $wg >= time())) {
            goto Bj;
        }
        update_user_meta($user->ID, "\155\157\x5f\x69\x64\x70\x5f\x75\x73\x65\162\x5f\164\171\x70\x65", "\163\163\157\x5f\165\x73\145\162");
        update_user_meta($user->ID, "\154\141\x73\x74\137\154\157\x67\147\145\x64\137\x69\156", date("\155\x2d\x79"));
        return;
        Bj:
        if ($FY > $Bk - 1 && !self::isValidNewSSOUser($Bk)) {
            goto Vh;
        }
        if (!(!empty($ql) || !empty($qX) || !empty($wg))) {
            goto JG;
        }
        delete_site_option("\165\163\145\x72\x5f\x65\x78\x63\x65\x65\x64\145\144\x5f\x61\154\145\x72\x74\137\x65\x6d\x61\151\154\137\x73\x65\156\x74");
        delete_site_option("\165\163\x65\162\x5f\145\170\143\x65\x65\144\145\x64\137\144\x65\154\141\171\x65\144\x5f\141\154\145\162\x74\x5f\x65\155\141\x69\x6c\137\x73\145\x6e\x74");
        delete_site_option("\144\x65\154\141\x79\137\x75\163\x65\162\137\x72\145\x73\164\x72\151\143\x74\x69\x6f\x6e");
        JG:
        $qX = get_site_option("\x75\x73\x65\x72\x5f\165\163\x65\x72\137\167\141\x72\156\151\x6e\x67\137\x61\154\145\162\x74\x5f\x65\155\x61\151\154\x5f\163\145\x6e\x74");
        $wg = get_site_option("\x64\x65\x6c\141\171\137\165\x73\145\162\137\x72\145\163\164\162\x69\143\164\x69\157\156");
        if (!($qX != 1)) {
            goto lX;
        }
        $yl = false;
        $oj = $FY + 1;
        if (!MSI_DEBUG) {
            goto vg;
        }
        MoIDPUtility::mo_debug("\x55\163\x65\x72\x3a\40" . $oj . "\x20\x41\x6c\154\157\167\145\x64\72\40" . $Bk . "\x20\127\x61\x72\x6e\x69\x6e\x67\40\105\155\x61\151\x6c\40\x53\145\x6e\164\x3a\40" . $qX);
        vg:
        if (!($Bk < 5 && $oj == $Bk - 1)) {
            goto wt;
        }
        $yl = true;
        wt:
        $VC = $oj * 100 / $Bk;
        if (!($VC >= 80 || $yl)) {
            goto Dy;
        }
        self::suwae($Bk, $oj);
        Dy:
        lX:
        goto f_;
        Vh:
        if (!($qX != 1)) {
            goto Dc;
        }
        self::suedae($Bk);
        update_user_meta($user->ID, "\155\x6f\x5f\151\144\160\x5f\165\x73\x65\x72\137\x74\x79\x70\x65", "\x73\x73\x6f\x5f\165\x73\x65\x72");
        update_user_meta($user->ID, "\x6c\x61\163\x74\137\x6c\x6f\147\147\x65\x64\137\x69\156", date("\155\x2d\x79"));
        return;
        Dc:
        if (!($qX == 1 && $ql != 1)) {
            goto X2;
        }
        self::sueae($Bk);
        X2:
        throw new InvalidSSOUserException();
        f_:
        update_user_meta($user->ID, "\x6d\x6f\137\151\x64\x70\137\165\x73\x65\162\x5f\x74\171\x70\x65", "\163\163\157\x5f\165\163\x65\x72");
        update_user_meta($user->ID, "\x6c\141\163\164\137\154\157\147\147\145\x64\x5f\151\156", date("\155\55\171"));
    }
    public static function isValidNewSSOUser($Bk)
    {
        if (!MSI_DEBUG) {
            goto JV;
        }
        MoIDPUtility::mo_debug("\x43\150\x65\x63\x6b\x69\x6e\x67\x20\x69\146\40\x63\x75\x73\164\157\155\x65\162\40\150\141\x73\x20\x75\160\147\162\x61\x64\x65\x64\40\x68\151\163\x20\x6c\x69\143\145\156\x73\x65");
        JV:
        $UV = get_site_option("\155\157\137\x69\144\160\x5f\143\165\163\164\x6f\155\145\162\x5f\164\x6f\x6b\x65\156");
        $ne = json_decode(MoIDPUtility::ccl(), true);
        $so = array_key_exists("\156\x6f\117\146\x55\163\145\162\163", $ne) ? $ne["\x6e\157\117\146\x55\163\x65\162\163"] : null;
        $nh = array_key_exists("\x6c\151\143\145\156\163\x65\105\170\160\151\x72\x79", $ne) ? strtotime($ne["\154\151\143\145\x6e\x73\145\x45\170\x70\x69\x72\x79"]) === false ? null : strtotime($ne["\154\x69\x63\145\x6e\163\145\x45\170\x70\x69\x72\171"]) : null;
        if (!(!MoIDPUtility::isBlank($so) && $Bk < $so)) {
            goto en;
        }
        if (!MSI_DEBUG) {
            goto mv;
        }
        MoIDPUtility::mo_debug("\x55\x70\x64\141\164\x69\x6e\x67\x20\x75\x73\x65\162\x20\154\x69\143\x65\x6e\x73\145");
        mv:
        update_site_option("\155\x6f\137\x69\144\x70\137\165\x73\162\x5f\x6c\x6d\x74", \AESEncryption::encrypt_data($so, $UV));
        delete_site_option("\165\163\145\x72\x5f\x65\x78\x63\145\x65\144\145\144\137\x61\154\145\162\x74\137\145\155\141\151\154\137\x73\145\x6e\164");
        delete_site_option("\x75\x73\145\x72\x5f\x65\170\143\145\x65\x64\145\x64\137\144\x65\x6c\x61\171\x65\x64\x5f\141\154\145\162\x74\137\x65\155\x61\151\154\137\x73\x65\x6e\164");
        delete_site_option("\144\145\154\141\171\137\x75\x73\145\162\x5f\x72\145\x73\x74\x72\151\143\x74\x69\157\156");
        return TRUE;
        en:
        return FALSE;
    }
    public static function sanitizeAssociativeArray($Rd)
    {
        $NI = array();
        foreach ($Rd as $UV => $Ev) {
            $UV = htmlspecialchars($UV);
            $Ev = htmlspecialchars($Ev);
            $NI[$UV] = $Ev;
            eO:
        }
        H2:
        return $NI;
    }
}
