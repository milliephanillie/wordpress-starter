<?php


namespace IDP\Handler;

use IDP\Helper\Constants\MoIDPConstants;
use IDP\Helper\Traits\Instance;
use IDP\Helper\Utilities\MoIDPcURL;
final class FeedbackHandler extends BaseHandler
{
    use Instance;
    private function __construct()
    {
        $this->_nonce = "\155\x6f\137\151\x64\160\x5f\146\x65\145\x64\x62\141\x63\x6b";
    }
    public function _mo_send_feedback($d1)
    {
        $this->isValidRequest();
        $yQ = $_POST["\x6d\151\x6e\151\157\x72\x61\x6e\147\145\x5f\146\x65\x65\144\142\x61\x63\x6b\137\163\x75\142\155\151\164"];
        $Z_ = sanitize_textarea_field($_POST["\x71\x75\x65\x72\x79\x5f\146\x65\x65\144\142\141\143\153"]);
        $Uv = array_key_exists("\155\x6f\137\151\x64\160\x5f\x6b\145\x65\x70\x5f\x73\145\x74\164\151\156\147\163\x5f\x69\156\x74\x61\x63\x74", $d1);
        if ($Uv) {
            goto vK;
        }
        update_site_option("\155\x6f\x5f\x69\144\160\137\153\145\x65\160\x5f\163\145\x74\x74\151\x6e\147\x73\x5f\x69\156\x74\141\x63\x74", FALSE);
        goto Xq;
        vK:
        update_site_option("\155\157\x5f\x69\144\160\x5f\x6b\145\x65\x70\137\x73\x65\x74\x74\x69\156\147\163\x5f\151\x6e\x74\x61\x63\x74", TRUE);
        Xq:
        if (!($yQ !== "\x53\153\x69\x70\40\x26\40\104\x65\141\143\x74\x69\x76\141\x74\145")) {
            goto EO;
        }
        $this->_sendEmail($this->_renderEmail($Z_));
        EO:
        deactivate_plugins([MSI_PLUGIN_NAME]);
    }
    private function _renderEmail($aP)
    {
        $Pm = file_get_contents(MSI_DIR . "\151\156\143\154\165\144\145\x73\x2f\x68\x74\x6d\x6c\x2f\146\x65\x65\144\142\x61\x63\x6b\x2e\155\x69\x6e\x2e\x68\164\155\154");
        $q1 = get_site_option("\x6d\x6f\x5f\x69\x64\x70\x5f\x61\x64\x6d\x69\x6e\137\145\x6d\x61\151\154");
        $Pm = str_replace("\x7b\x7b\x53\x45\x52\x56\x45\x52\175\175", $_SERVER["\x53\x45\x52\x56\105\122\137\116\x41\115\x45"], $Pm);
        $Pm = str_replace("\173\x7b\105\115\101\x49\114\175\175", $q1, $Pm);
        $Pm = str_replace("\x7b\173\x50\x4c\125\107\x49\x4e\x7d\x7d", MoIDPConstants::AREA_OF_INTEREST, $Pm);
        $Pm = str_replace("\x7b\173\126\x45\122\123\111\x4f\x4e\175\x7d", MSI_VERSION, $Pm);
        $Pm = str_replace("\173\x7b\x54\131\x50\x45\x7d\175", "\133\x50\154\165\147\151\156\x20\x44\145\141\x63\164\151\x76\141\164\145\144\x5d", $Pm);
        $Pm = str_replace("\x7b\173\x46\x45\105\104\102\101\103\113\175\x7d", $aP, $Pm);
        return $Pm;
    }
    private function _sendEmail($Qj)
    {
        $eF = MoIDPConstants::DEFAULT_CUSTOMER_KEY;
        $HZ = MoIDPConstants::DEFAULT_API_KEY;
        MoIDPcURL::notify($eF, $HZ, MoIDPConstants::FEEDBACK_EMAIL, $Qj, "\x57\157\162\144\120\162\x65\163\163\x20\111\104\x50\x20\x50\x6c\165\x67\x69\x6e\x20\x44\145\141\143\x74\151\166\141\x74\145\144");
    }
}
