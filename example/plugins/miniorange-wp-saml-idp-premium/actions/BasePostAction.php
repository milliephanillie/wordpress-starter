<?php


namespace IDP\Actions;

use IDP\Helper\Traits\Instance;
abstract class BasePostAction
{
    use Instance;
    protected $_nonce;
    function __construct()
    {
        add_action("\x61\x64\155\151\x6e\137\x69\x6e\x69\164", array($this, "\x68\x61\156\144\154\x65\x5f\160\157\163\164\x5f\144\x61\x74\x61"), 1);
    }
    abstract function handle_post_data();
    abstract function route_post_data($Ig);
}
