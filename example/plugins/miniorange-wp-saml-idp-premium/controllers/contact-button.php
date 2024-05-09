<?php


use IDP\Helper\Constants\MoIDPConstants;
global $_wp_admin_css_colors;
$j6 = get_user_option("\141\144\x6d\x69\156\x5f\143\157\154\157\x72");
$g5 = $_wp_admin_css_colors[$j6]->colors;
$current_user = wp_get_current_user();
$q1 = get_site_option("\x6d\x6f\x5f\x69\x64\160\x5f\x61\144\x6d\151\x6e\x5f\145\155\x61\x69\x6c");
$z6 = get_site_option("\155\157\137\151\144\160\x5f\x61\144\155\x69\156\137\x70\x68\x6f\x6e\145");
$z6 = $z6 ? $z6 : '';
$VV = MoIDPConstants::FEEDBACK_EMAIL;
require_once MoIDPConstants::VIEWS_CONTACT_BUTTON;
