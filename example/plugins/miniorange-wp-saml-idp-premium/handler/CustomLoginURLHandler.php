<?php


namespace IDP\Handler;

use IDP\Helper\Traits\Instance;
use IDP\Helper\Constants\MoIDPMessages;
class CustomLoginURLHandler extends BaseHandler
{
    use Instance;
    function handle_custom_login_url($d1)
    {
        $this->checkIfValidPlugin();
        $M0 = filter_var($d1["\143\x75\x73\164\x6f\x6d\137\154\x6f\x67\151\x6e\137\165\x72\154"], FILTER_SANITIZE_URL);
        $IH = filter_var($M0, FILTER_VALIDATE_URL);
        if ($d1["\143\x75\x73\x74\x6f\155\137\154\x6f\147\x69\x6e\137\x75\x72\154"] === '') {
            goto Es;
        }
        if ($IH) {
            goto D5;
        }
        do_action("\x6d\x6f\x5f\x69\144\160\x5f\163\150\x6f\167\137\155\145\x73\163\x61\x67\145", MoIDPMessages::showMessage("\x49\x4e\x56\x41\114\x49\104\137\111\116\120\125\x54"), "\x45\x52\x52\117\122");
        goto JJ;
        D5:
        update_site_option("\155\157\137\151\x64\x70\137\143\165\163\164\x6f\155\x5f\154\x6f\x67\151\156\x5f\165\162\x6c", $IH);
        do_action("\155\157\137\x69\x64\x70\x5f\x73\150\x6f\x77\x5f\155\x65\163\163\x61\147\x65", MoIDPMessages::showMessage("\x53\105\124\124\x49\116\x47\123\137\x53\x41\x56\105\x44"), "\123\x55\x43\103\105\123\x53");
        JJ:
        goto ee;
        Es:
        update_site_option("\155\x6f\137\151\x64\x70\x5f\143\x75\163\164\x6f\x6d\137\154\x6f\x67\x69\x6e\137\x75\x72\154", NULL);
        do_action("\155\157\x5f\x69\x64\x70\x5f\x73\150\157\x77\x5f\x6d\145\163\163\141\x67\145", MoIDPMessages::showMessage("\123\105\124\x54\x49\x4e\107\123\x5f\123\101\126\x45\x44"), "\123\125\x43\x43\x45\123\x53");
        ee:
    }
}
