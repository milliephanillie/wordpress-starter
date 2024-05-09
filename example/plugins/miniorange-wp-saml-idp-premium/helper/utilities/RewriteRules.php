<?php


namespace IDP\Helper\Utilities;

use IDP\Helper\Traits\Instance;
final class RewriteRules
{
    use Instance;
    function __construct()
    {
        add_filter("\x6d\x6f\144\x5f\x72\145\167\162\151\x74\x65\137\162\x75\x6c\x65\x73", array($this, "\157\x75\164\x70\165\x74\137\x68\x74\x61\x63\143\145\x73\163"));
    }
    function output_htaccess($TF)
    {
        $CU = MSI_NAME;
        $xd = "\x49\156\x64\145\170\x49\x67\x6e\x6f\x72\145\x20{$CU}\52\40\x61\143\164\x69\157\x6e\163\x20\x63\157\156\x74\x72\157\154\x6c\x65\x72\163\40\x65\x78\x63\x65\x70\164\x69\157\156\40\150\145\x6c\160\145\x72\x20\x69\x6e\143\154\x75\144\x65\x73\40\163\x63\x68\x65\x64\x75\x6c\x65\162\163\40\166\151\x65\x77\163\x20\x2a\56\160\x68\160" . "\12" . "\74\106\x69\x6c\145\163\x4d\141\164\x63\x68\x20\x22\x5c\56\x28\153\145\171\x29\44\x22\x3e" . "\12" . "\x4f\162\144\145\162\x20\x61\154\154\157\x77\x2c\x64\x65\156\x79" . "\12" . "\x44\145\x6e\171\x20\146\x72\x6f\155\40\x61\154\x6c" . "\xa" . "\x3c\57\x46\x69\x6c\x65\163\115\141\x74\x63\x68\76";
        return $TF . $xd;
    }
}
