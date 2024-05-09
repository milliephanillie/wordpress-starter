<?php


namespace IDP\Handler;

use IDP\Helper\Constants\MoIDPMessages;
use IDP\Helper\Traits\Instance;
use IDP\Helper\Utilities\MoIDPUtility;
final class IDPSettingsHandler extends BaseHandler
{
    use Instance;
    private function __construct()
    {
    }
    public function mo_change_idp_entity_id($d1)
    {
        global $dbIDPQueries;
        $this->checkIfValidPlugin();
        if (array_key_exists("\x6d\x6f\x5f\163\141\x6d\154\x5f\x69\x64\160\137\x65\x6e\164\151\164\x79\x5f\x69\x64", $d1) && !empty($d1["\x6d\157\137\163\x61\155\x6c\137\x69\x64\160\137\x65\156\164\151\164\171\x5f\x69\x64"])) {
            goto Zz;
        }
        do_action("\x6d\157\x5f\151\144\x70\x5f\163\x68\x6f\x77\137\155\x65\163\163\x61\x67\x65", MoIDPMessages::showMessage("\x49\104\120\x5f\105\116\124\x49\124\x59\x5f\111\104\137\x4e\x55\x4c\114"), "\105\x52\122\x4f\122");
        goto Kj;
        Zz:
        update_site_option("\155\x6f\137\x69\144\x70\x5f\145\156\x74\x69\164\x79\x5f\x69\x64", sanitize_text_field($d1["\x6d\x6f\x5f\x73\x61\155\154\137\151\144\160\x5f\x65\156\x74\x69\x74\171\x5f\151\144"]));
        MoIDPUtility::createMetadataFile();
        do_action("\155\157\x5f\x69\x64\160\137\x73\150\157\x77\137\x6d\x65\163\x73\141\147\x65", MoIDPMessages::showMessage("\x49\104\120\137\105\116\x54\111\124\131\x5f\111\104\137\x43\x48\x41\x4e\x47\105\104"), "\123\125\x43\x43\105\123\x53");
        Kj:
    }
}
