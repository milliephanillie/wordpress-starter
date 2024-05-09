<?php


use IDP\Handler\RegistrationHandler;
use IDP\Helper\Constants\MoIDPConstants;
$current_user = wp_get_current_user();
$q1 = get_site_option("\x6d\x6f\137\151\x64\160\137\141\144\155\151\x6e\x5f\x65\155\x61\x69\154");
$tN = get_site_option("\x6d\157\137\151\x64\160\x5f\x61\x64\x6d\x69\x6e\137\x63\165\163\164\x6f\x6d\145\162\137\x6b\x65\x79");
$HZ = get_site_option("\x6d\157\x5f\151\144\x70\x5f\x61\144\155\x69\x6e\x5f\141\160\151\x5f\x6b\145\171");
$ZY = get_site_option("\x6d\x6f\x5f\x69\144\160\137\x63\x75\163\164\157\x6d\x65\162\x5f\164\x6f\x6b\x65\156");
$tn = RegistrationHandler::instance()->_nonce;
require_once MoIDPConstants::VIEWS_USER_PROFILE;
