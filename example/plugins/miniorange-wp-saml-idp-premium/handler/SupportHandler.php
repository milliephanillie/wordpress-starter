<?php


namespace IDP\Handler;

use IDP\Helper\Constants\MoIDPMessages;
use IDP\Helper\Traits\Instance;
use IDP\Helper\Utilities\MoIDPUtility;
final class SupportHandler extends BaseHandler
{
    use Instance;
    private function __construct()
    {
    }
    public function _mo_idp_support_query($d1)
    {
        $this->checkIfSupportQueryFieldsEmpty(array("\x6d\x6f\137\x69\x64\160\x5f\x63\157\156\164\x61\x63\164\x5f\x75\x73\x5f\145\x6d\141\151\x6c" => $d1, "\x6d\157\x5f\x69\x64\x70\x5f\143\157\x6e\164\x61\x63\164\x5f\165\x73\x5f\x71\x75\x65\x72\171" => $d1));
        $q1 = sanitize_text_field($d1["\x6d\157\x5f\151\144\x70\x5f\143\x6f\x6e\164\141\143\164\137\x75\163\x5f\x65\x6d\x61\x69\154"]);
        $z6 = sanitize_text_field($d1["\155\157\137\x69\144\x70\x5f\143\x6f\156\x74\x61\x63\x74\137\165\163\137\x70\x68\x6f\156\145"]);
        $PU = sanitize_text_field($d1["\155\x6f\x5f\151\144\160\x5f\143\x6f\x6e\x74\141\143\164\x5f\x75\163\137\x71\x75\x65\x72\171"]);
        $d3 = MoIDPUtility::submitContactUs($q1, $z6, $PU);
        if ($d3 == FALSE) {
            goto C2;
        }
        do_action("\155\157\x5f\151\x64\x70\x5f\163\x68\157\167\x5f\x6d\x65\163\163\x61\147\x65", MoIDPMessages::showMessage("\121\125\105\x52\131\137\x53\105\116\x54"), "\123\x55\103\103\x45\123\123");
        goto Bl;
        C2:
        do_action("\155\157\137\151\x64\160\137\x73\150\157\167\x5f\155\145\x73\x73\x61\147\145", MoIDPMessages::showMessage("\x45\122\122\x4f\122\x5f\121\125\x45\122\131"), "\105\122\122\117\x52");
        Bl:
    }
}
