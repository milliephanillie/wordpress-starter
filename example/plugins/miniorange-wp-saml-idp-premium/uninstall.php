<?php


if (defined("\x57\120\137\x55\x4e\111\x4e\x53\x54\x41\x4c\114\137\x50\x4c\x55\x47\111\116")) {
    goto AN;
}
exit;
AN:
wp_clear_scheduled_hook("\155\x6f\137\x69\x64\x70\137\166\x65\162\x73\151\157\x6e\137\143\x68\145\143\x6b");
delete_site_option("\155\157\137\151\x64\160\137\x68\x6f\163\164\137\156\x61\155\x65");
delete_site_option("\x6d\x6f\x5f\x69\144\160\x5f\164\162\x61\x6e\163\141\143\x74\151\x6f\156\x49\x64");
delete_site_option("\x6d\x6f\137\x69\x64\x70\137\141\x64\x6d\151\156\137\160\x61\163\x73\x77\157\x72\x64");
delete_site_option("\x6d\x6f\x5f\151\144\x70\137\x72\x65\x67\151\x73\164\x72\x61\x74\151\x6f\156\137\163\164\x61\x74\165\x73");
delete_site_option("\x6d\157\x5f\x69\144\x70\x5f\x61\144\x6d\x69\x6e\x5f\160\x68\157\x6e\x65");
delete_site_option("\155\157\137\x69\144\x70\137\x6e\145\x77\x5f\x72\145\147\x69\163\164\162\x61\164\151\157\156");
delete_site_option("\155\157\x5f\151\144\160\137\141\144\x6d\151\156\137\143\165\x73\164\157\x6d\145\x72\x5f\x6b\145\171");
delete_site_option("\x6d\157\x5f\x69\x64\x70\x5f\x61\144\x6d\151\156\x5f\x61\x70\151\137\x6b\x65\x79");
delete_site_option("\155\157\137\151\144\160\137\x63\165\163\164\157\x6d\x65\x72\x5f\x74\157\x6b\145\156");
delete_site_option("\155\x6f\137\151\x64\x70\137\x76\x65\162\151\146\x79\137\143\165\163\x74\157\x6d\145\x72");
delete_site_option("\155\x6f\137\151\144\160\x5f\155\x65\163\163\x61\147\x65");
delete_site_option("\155\x6f\137\151\x64\x70\x5f\x61\x64\155\151\156\x5f\x65\155\x61\151\x6c");
delete_site_option("\163\155\x6c\137\151\x64\x70\137\x6c\x6b");
delete_site_option("\163\155\x6c\137\151\144\x70\x5f\154\145\144");
delete_site_option("\x74\137\163\151\164\145\x5f\x73\x74\141\x74\165\163");
delete_site_option("\163\151\x74\145\137\x69\144\x70\x5f\143\x6b\154");
delete_site_option("\x6d\157\137\x69\x64\x70\137\165\163\x72\x5f\x6c\155\164");
delete_site_option("\x69\144\x70\137\x6c\151\143\x65\156\x73\145\137\x61\154\145\162\x74\x5f\x73\145\x6e\x74");
delete_site_option("\x69\x64\x70\137\166\154\x5f\143\150\x65\x63\153\137\164");
delete_site_option("\x69\144\x70\x5f\166\x6c\137\x63\x68\x65\143\x6b\x5f\x73");
if (get_site_option("\x6d\x6f\137\x69\x64\x70\x5f\x6b\x65\x65\160\x5f\163\x65\x74\164\151\156\x67\163\137\x69\156\x74\141\x63\x74")) {
    goto xa;
}
global $wpdb;
delete_site_option("\155\157\x5f\x73\x61\155\154\137\x69\144\x70\x5f\160\154\165\147\151\156\x5f\x76\x65\162\163\x69\x6f\156");
delete_site_option("\x6d\157\137\151\x64\x70\x5f\x65\156\x74\151\164\171\x5f\x69\x64");
delete_site_option("\x6d\x6f\x5f\151\x64\160\x5f\153\x65\x65\x70\137\x73\145\164\x74\x69\x6e\x67\x73\137\151\x6e\164\x61\x63\x74");
delete_site_option("\155\157\137\x69\x64\x70\x5f\143\x75\163\x74\157\x6d\137\154\x6f\147\151\156\x5f\165\x72\x6c");
delete_site_option("\155\157\x5f\x69\144\x70\x5f\162\x6f\154\x65\137\142\x61\x73\x65\x64\137\162\x65\x73\164\x72\x69\143\x74\151\x6f\156");
delete_site_option("\x6d\x6f\x5f\x69\144\x70\137\x73\163\x6f\137\x61\154\154\157\167\x65\144\x5f\162\x6f\x6c\145\x73");
$Qc = is_multisite() ? "\104\122\x4f\120\x20\x54\x41\102\114\105\40\155\157\x5f\x73\160\137\x61\x74\x74\162\151\x62\x75\x74\145\163" : "\104\122\x4f\x50\x20\124\101\x42\x4c\x45\40" . $wpdb->prefix . "\x6d\157\137\163\x70\137\x61\x74\x74\x72\x69\142\165\164\145\x73";
$wpdb->query($Qc);
$Qc = is_multisite() ? "\x44\x52\117\x50\x20\124\x41\102\114\x45\x20\155\x6f\x5f\x73\160\137\x64\x61\164\x61" : "\x44\122\117\120\40\x54\x41\102\114\105\x20" . $wpdb->prefix . "\155\x6f\x5f\163\x70\137\x64\x61\164\141";
$wpdb->query($Qc);
xa:
