<?php


namespace IDP\Handler;

use IDP\Helper\Traits\Instance;
use IDP\Helper\Constants\MoIDPMessages;
use IDP\Helper\Utilities\MoIDPUtility;
class RoleBasedSSOHandler extends BaseHandler
{
    use Instance;
    public function handle_role_based_sso($d1)
    {
        $this->checkIfValidPlugin();
        $bo = isset($d1["\x61\154\154\157\x77\145\x64\137\x72\157\x6c\x65\x73"]) ? explode("\x2c", $d1["\x61\x6c\154\x6f\167\x65\144\x5f\x72\157\x6c\145\163"]) : array();
        $bX = isset($d1["\155\157\x5f\x69\144\x70\x5f\x72\x6f\154\145\x5f\162\x65\x73\164\x72\151\x63\164\x69\157\156"]) ? TRUE : FALSE;
        foreach ($bo as $jv) {
            $RJ[$jv] = true;
            R7:
        }
        VK:
        $RJ = MoIDPUtility::sanitizeAssociativeArray($RJ);
        update_site_option("\155\x6f\x5f\151\144\x70\137\x73\x73\x6f\x5f\141\154\x6c\x6f\x77\x65\144\x5f\162\157\x6c\x65\x73", $RJ);
        update_site_option("\155\x6f\x5f\x69\144\x70\137\x72\x6f\154\145\x5f\x62\141\x73\x65\x64\x5f\162\145\x73\x74\162\151\x63\164\151\x6f\x6e", $bX);
        do_action("\x6d\x6f\137\x69\144\x70\137\x73\x68\157\x77\x5f\x6d\x65\x73\x73\x61\147\x65", MoIDPMessages::showMessage("\123\105\x54\x54\111\116\x47\123\x5f\123\101\x56\105\x44"), "\123\125\x43\103\x45\123\x53");
    }
}
