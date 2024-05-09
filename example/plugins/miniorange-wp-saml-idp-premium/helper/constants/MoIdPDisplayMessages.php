<?php


namespace IDP\Helper\Constants;

class MoIdPDisplayMessages
{
    private $message;
    private $type;
    function __construct($aP, $p8)
    {
        $this->_message = $aP;
        $this->_type = $p8;
        add_action("\x61\x64\155\151\156\x5f\156\157\x74\x69\143\145\163", array($this, "\162\x65\x6e\x64\x65\x72"));
    }
    function render()
    {
        switch ($this->_type) {
            case "\103\125\123\124\117\x4d\x5f\115\x45\123\x53\x41\x47\x45":
                echo $this->_message;
                goto bd;
            case "\116\117\x54\x49\x43\105":
                echo "\x3c\x64\x69\166\40\163\x74\x79\x6c\x65\x3d\x22\x6d\x61\x72\147\151\x6e\55\164\x6f\x70\72\61\45\x3b\x22\40\143\154\x61\x73\163\75\42\x69\x73\x2d\x64\151\163\x6d\x69\163\163\151\x62\x6c\x65\40\x6e\x6f\164\x69\x63\x65\x20\x6e\157\x74\151\143\x65\55\x77\x61\162\x6e\x69\156\147\x22\x3e\40\74\160\76" . $this->_message . "\x3c\x2f\160\76\x20\x3c\x2f\144\151\x76\76";
                goto bd;
            case "\105\122\x52\117\122":
                echo "\74\x64\151\166\x20\40\x73\x74\171\x6c\145\75\42\155\x61\x72\x67\151\x6e\x2d\x74\x6f\x70\x3a\x31\x25\73\x22\x20\x63\x6c\141\x73\x73\x3d\42\156\x6f\164\151\143\x65\x20\x6e\157\x74\x69\143\x65\x2d\145\x72\162\x6f\162\40\x69\x73\x2d\144\151\x73\x6d\151\x73\x73\x69\142\154\x65\42\x3e\40\74\x70\76" . $this->_message . "\x3c\57\x70\x3e\40\74\57\144\x69\x76\76";
                goto bd;
            case "\x53\x55\x43\x43\x45\x53\123":
                echo "\x3c\144\x69\x76\x20\40\163\x74\171\x6c\145\x3d\x22\155\x61\x72\x67\x69\156\55\164\157\160\72\61\45\73\42\40\x63\x6c\141\x73\x73\x3d\42\x6e\157\164\x69\143\x65\40\156\x6f\x74\151\x63\x65\55\163\165\143\x63\145\163\x73\40\151\163\55\144\x69\163\x6d\x69\163\x73\151\x62\154\x65\42\76\40\74\160\76" . $this->_message . "\x3c\57\160\76\40\x3c\57\144\x69\166\x3e";
                goto bd;
        }
        gA:
        bd:
    }
}
