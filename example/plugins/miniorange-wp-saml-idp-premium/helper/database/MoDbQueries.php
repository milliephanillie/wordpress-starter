<?php


namespace IDP\Helper\Database;

use IDP\Helper\Traits\Instance;
require_once ABSPATH . "\167\x70\x2d\x61\x64\155\151\x6e\57\x69\x6e\143\154\x75\x64\145\163\57\x75\x70\147\x72\x61\x64\145\56\x70\150\x70";
class MoDbQueries
{
    use Instance;
    private $spDataTableName;
    private $spAttrTableName;
    private $userMetaTable;
    private function __construct()
    {
        global $wpdb;
        $this->spDataTableName = is_multisite() ? "\155\157\x5f\163\x70\137\x64\141\164\141" : $wpdb->prefix . "\x6d\157\x5f\163\x70\137\144\141\x74\x61";
        $this->spAttrTableName = is_multisite() ? "\x6d\157\x5f\163\160\137\x61\164\164\x72\x69\142\165\164\145\163" : $wpdb->prefix . "\155\x6f\137\x73\x70\137\141\x74\164\162\x69\142\165\x74\145\163";
        $this->userMetaTable = $wpdb->base_prefix . "\165\163\145\x72\155\145\x74\141";
    }
    function generate_tables()
    {
        global $wpdb;
        $oo = '';
        if (!$wpdb->has_cap("\x63\157\154\154\141\164\151\157\156")) {
            goto he;
        }
        if (empty($wpdb->charset)) {
            goto V4;
        }
        $oo .= "\104\x45\x46\101\125\x4c\124\x20\x43\110\x41\x52\x41\x43\x54\x45\122\x20\123\x45\124\40{$wpdb->charset}";
        V4:
        if (empty($wpdb->collate)) {
            goto l7;
        }
        $oo .= "\40\x43\117\114\114\x41\x54\105\x20{$wpdb->collate}";
        l7:
        he:
        $fs = "\103\x52\105\101\124\105\40\124\x41\102\114\x45\40" . $this->spDataTableName . "\40\50\xa\40\40\40\x20\x20\40\40\x20\40\x20\40\40\40\x20\40\x20\40\x20\x20\40\151\144\x20\x62\x69\147\151\x6e\164\50\62\60\x29\x20\116\x4f\124\40\x4e\125\x4c\114\x20\141\x75\164\x6f\137\x69\156\x63\x72\x65\155\145\156\x74\54\12\x20\x20\x20\x20\x20\x20\x20\x20\x20\40\40\40\x20\40\40\x20\40\40\x20\40\x6d\157\x5f\x69\x64\x70\137\163\160\x5f\x6e\141\x6d\145\40\164\x65\x78\164\x20\x4e\x4f\124\40\116\x55\x4c\114\x2c\xa\x20\40\40\x20\40\x20\40\40\40\40\x20\40\x20\x20\x20\40\40\40\x20\x20\x6d\x6f\x5f\151\144\x70\x5f\x73\x70\137\x69\163\x73\x75\x65\x72\40\154\157\x6e\147\164\145\x78\164\x20\x4e\x4f\124\x20\116\125\x4c\x4c\54\xa\40\x20\x20\40\x20\40\40\40\40\x20\40\x20\40\x20\40\x20\x20\40\x20\x20\155\x6f\x5f\151\x64\160\x5f\141\143\x73\137\165\162\154\x20\154\x6f\156\147\164\145\x78\164\x20\116\x4f\x54\40\116\x55\114\114\54\xa\x20\x20\x20\x20\40\40\x20\x20\x20\40\x20\40\x20\x20\x20\x20\40\x20\40\40\155\157\137\151\144\160\137\143\145\x72\164\x20\154\x6f\156\147\x74\x65\170\x74\x20\x4e\125\x4c\x4c\54\xa\40\40\x20\40\x20\40\x20\40\x20\40\x20\x20\40\x20\40\x20\x20\40\40\40\x6d\x6f\x5f\x69\144\160\137\143\x65\162\x74\x5f\145\x6e\x63\162\171\160\164\x20\154\157\156\147\x74\145\170\164\x20\x4e\x55\x4c\x4c\54\12\x20\x20\x20\40\x20\40\x20\40\x20\x20\x20\x20\40\x20\40\40\x20\40\40\40\155\157\x5f\151\x64\160\137\156\x61\x6d\145\x69\144\x5f\146\157\x72\155\141\164\40\154\x6f\156\147\x74\x65\x78\164\40\116\x4f\124\40\116\125\114\x4c\x2c\xa\40\40\40\x20\40\x20\x20\x20\40\40\40\x20\40\40\x20\40\x20\x20\40\x20\x6d\x6f\x5f\x69\x64\160\x5f\156\x61\x6d\145\x69\x64\x5f\141\164\164\x72\40\166\x61\x72\x63\150\141\162\50\65\x35\51\40\104\105\106\x41\125\114\124\40\47\x65\155\x61\151\154\x41\144\144\162\x65\163\x73\47\40\116\x4f\x54\x20\x4e\x55\x4c\114\54\xa\x20\x20\40\40\x20\x20\x20\x20\x20\40\x20\40\40\x20\40\40\x20\40\x20\40\155\157\x5f\151\144\x70\x5f\x72\145\163\x70\x6f\x6e\x73\x65\x5f\x73\151\147\156\x65\x64\x20\x73\155\x61\154\x6c\151\156\164\x20\116\125\x4c\x4c\54\xa\40\x20\40\40\x20\x20\40\40\x20\40\x20\40\40\x20\40\x20\40\x20\x20\40\155\x6f\137\151\144\160\137\141\x73\163\145\x72\x74\151\x6f\x6e\x5f\x73\151\147\x6e\145\144\x20\x73\155\x61\x6c\x6c\x69\x6e\x74\40\116\x55\114\x4c\x2c\xa\x20\x20\40\x20\x20\40\40\40\40\40\x20\x20\40\40\40\40\40\40\40\x20\x6d\x6f\x5f\151\x64\160\137\145\x6e\x63\x72\x79\x70\x74\x65\144\137\141\163\x73\145\x72\x74\x69\x6f\x6e\x20\163\x6d\141\x6c\x6c\x69\x6e\x74\40\116\125\114\114\54\xa\x20\40\40\x20\x20\x20\x20\40\40\x20\40\40\40\40\40\x20\40\40\x20\x20\155\x6f\x5f\151\144\160\137\145\156\141\142\x6c\145\x5f\x67\162\157\x75\x70\x5f\x6d\141\x70\160\151\156\x67\40\163\x6d\141\154\154\x69\x6e\x74\x20\x4e\x55\x4c\x4c\54\12\40\x20\x20\40\40\x20\x20\40\x20\40\x20\40\40\40\x20\x20\40\x20\x20\x20\x6d\157\137\151\x64\x70\137\144\x65\x66\141\165\154\x74\x5f\162\x65\154\141\x79\123\x74\141\164\x65\x20\154\157\x6e\147\164\x65\170\x74\40\x4e\x55\114\x4c\54\12\40\x20\40\40\40\x20\40\40\x20\40\x20\x20\x20\x20\40\x20\x20\x20\40\x20\x6d\157\137\151\144\160\137\x6c\x6f\x67\157\x75\x74\137\x75\162\x6c\40\154\x6f\156\147\164\x65\170\164\40\116\x55\x4c\x4c\x2c\12\x20\40\x20\x20\40\x20\x20\x20\x20\40\40\40\x20\x20\x20\x20\40\x20\40\40\155\x6f\x5f\x69\x64\160\x5f\x6c\x6f\147\157\x75\x74\137\142\x69\156\x64\151\x6e\x67\137\164\x79\160\145\x20\166\141\x72\x63\150\141\x72\50\x31\x35\51\40\104\105\106\101\x55\114\124\x20\x27\110\x74\164\160\122\145\x64\151\x72\x65\x63\164\x27\40\x4e\117\124\x20\x4e\x55\114\x4c\x2c\xa\40\x20\x20\40\x20\x20\40\x20\40\x20\x20\x20\40\x20\x20\x20\x20\40\40\40\155\157\x5f\x69\x64\160\137\x70\x72\x6f\x74\x6f\143\157\154\x5f\x74\x79\160\x65\x20\154\157\x6e\x67\164\x65\x78\x74\x20\x4e\x4f\124\x20\116\125\x4c\114\x2c\xa\40\x20\x20\40\x20\40\x20\x20\x20\40\x20\x20\40\40\40\40\40\x20\40\x20\120\x52\111\x4d\x41\x52\131\x20\x4b\x45\x59\40\40\x28\x69\144\x29\12\40\x20\x20\40\x20\x20\x20\x20\40\x20\40\x20\40\x20\x20\40\x29{$oo}\73";
        $RT = "\x43\122\x45\101\x54\x45\40\124\x41\102\x4c\x45\x20" . $this->spAttrTableName . "\40\50\xa\x20\x20\40\40\x20\x20\40\40\x20\40\x20\40\x20\x20\40\40\40\x20\40\40\151\x64\x20\x62\x69\x67\151\156\164\50\x32\60\51\x20\x4e\117\x54\40\x4e\x55\x4c\x4c\40\141\165\164\157\x5f\x69\156\143\x72\145\x6d\x65\x6e\164\x2c\12\40\40\40\x20\x20\x20\x20\40\x20\x20\40\x20\40\40\x20\40\40\x20\40\x20\155\157\137\x73\x70\x5f\x69\144\40\142\151\147\x69\x6e\x74\50\62\x30\51\54\12\x20\x20\x20\x20\40\x20\40\x20\40\40\x20\x20\40\40\x20\x20\40\40\40\40\155\157\137\163\160\137\141\164\164\162\137\x6e\x61\155\x65\40\154\x6f\156\x67\x74\x65\x78\x74\40\x4e\x4f\x54\x20\x4e\x55\114\114\54\xa\x20\40\x20\40\x20\x20\40\x20\x20\40\40\40\40\40\40\x20\40\40\40\x20\x6d\157\137\x73\160\137\141\x74\x74\x72\x5f\x76\141\154\x75\145\x20\154\x6f\156\x67\x74\x65\x78\x74\x20\x4e\x4f\124\x20\x4e\125\x4c\x4c\54\12\x20\40\x20\40\x20\x20\40\40\x20\40\x20\40\40\40\x20\x20\40\x20\x20\40\x6d\x6f\137\141\x74\x74\x72\x5f\x74\x79\x70\145\x20\163\155\x61\x6c\154\151\156\164\40\x44\x45\x46\101\x55\114\x54\x20\60\x20\x4e\x4f\124\x20\116\x55\114\x4c\x2c\12\40\x20\x20\x20\x20\40\x20\40\x20\40\x20\40\40\x20\40\40\40\40\40\40\x50\122\111\115\x41\122\x59\40\113\x45\x59\x20\x20\x28\151\x64\51\54\xa\x20\40\x20\40\x20\40\x20\x20\40\40\40\x20\x20\40\40\40\x20\x20\40\40\106\x4f\x52\105\111\x47\x4e\x20\x4b\105\x59\x20\40\x28\x6d\157\137\x73\x70\x5f\151\x64\51\40\122\x45\x46\x45\122\105\116\x43\x45\x53\x20{$this->spDataTableName}\x20\x28\151\x64\x29\xa\40\x20\40\x20\40\40\x20\40\40\x20\x20\40\40\x20\40\40\51{$oo}\73";
        dbDelta($fs);
        dbDelta($RT);
    }
    function checkTablesAndRunQueries()
    {
        $Aq = get_site_option("\155\157\137\x73\141\155\x6c\x5f\x69\x64\160\x5f\160\154\165\x67\x69\156\x5f\166\x65\x72\163\151\x6f\156");
        if (!$Aq) {
            goto vQ;
        }
        if (!($Aq < MSI_DB_VERSION)) {
            goto wo;
        }
        update_site_option("\x6d\x6f\x5f\x73\141\155\x6c\137\151\144\160\137\160\154\165\x67\x69\156\137\x76\145\162\163\x69\157\x6e", MSI_DB_VERSION);
        wo:
        $this->checkVersionAndUpdate($Aq);
        goto pj;
        vQ:
        update_site_option("\155\x6f\x5f\x73\x61\155\x6c\137\x69\144\x70\x5f\160\x6c\165\x67\x69\156\x5f\x76\145\x72\163\x69\x6f\x6e", MSI_DB_VERSION);
        $this->generate_tables();
        if (!ob_get_contents()) {
            goto eW;
        }
        ob_clean();
        eW:
        pj:
    }
    function checkVersionAndUpdate($Aq)
    {
        if (strcasecmp($Aq, "\61\x2e\60") == 0) {
            goto VA;
        }
        if (strcasecmp($Aq, "\x31\56\60\56\62") == 0) {
            goto LN;
        }
        if (strcasecmp($Aq, "\61\x2e\x30\x2e\64") == 0) {
            goto ao;
        }
        if (strcasecmp($Aq, "\61\x2e\62") == 0) {
            goto p6;
        }
        if (!(strcasecmp($Aq, "\x31\x2e\x33") == 0)) {
            goto xH;
        }
        $this->mo_update_protocol_type();
        xH:
        goto aK;
        p6:
        $this->mo_update_custom_attr();
        $this->mo_update_protocol_type();
        aK:
        goto TE;
        ao:
        $this->mo_update_logout();
        $this->mo_update_custom_attr();
        $this->mo_update_protocol_type();
        TE:
        goto D0;
        LN:
        $this->mo_update_logout();
        $this->mo_update_relay();
        $this->mo_update_custom_attr();
        $this->mo_update_protocol_type();
        D0:
        goto Wo;
        VA:
        $this->mo_update_logout();
        $this->mo_update_cert();
        $this->mo_update_relay();
        $this->mo_update_custom_attr();
        $this->mo_update_protocol_type();
        Wo:
    }
    function mo_update_protocol_type()
    {
        global $wpdb;
        $wpdb->query("\x41\x4c\124\105\122\40\124\x41\102\114\105\40" . $this->spDataTableName . "\x20\x41\x44\104\x20\x43\x4f\114\x55\x4d\x4e\40\155\x6f\x5f\151\x64\160\x5f\x70\162\157\x74\157\143\157\x6c\137\164\x79\x70\145\40\x6c\x6f\x6e\x67\164\x65\x78\164\40\116\117\x54\40\x4e\125\x4c\x4c");
        $wpdb->query("\x55\120\x44\x41\x54\x45\40" . $this->spDataTableName . "\40\123\x45\x54\x20\155\157\137\x69\x64\x70\x5f\x70\x72\x6f\x74\157\x63\157\154\137\164\171\x70\145\x20\75\x20\47\x53\101\x4d\x4c\x27");
    }
    function mo_update_logout()
    {
        global $wpdb;
        $wpdb->query("\101\114\124\105\x52\x20\x54\101\x42\114\x45\x20" . $this->spDataTableName . "\40\101\104\104\40\x43\x4f\x4c\x55\x4d\116\40\x6d\x6f\137\151\144\x70\137\x6c\157\x67\x6f\x75\x74\x5f\165\162\154\x20\154\157\156\147\x74\145\x78\x74\x20\x4e\125\114\114");
        $wpdb->query("\101\x4c\x54\105\122\40\x54\101\102\x4c\x45\40" . $this->spDataTableName . "\x20\101\x44\104\x20\x43\x4f\114\x55\115\x4e\x20\x6d\157\x5f\151\x64\x70\137\x6c\x6f\147\157\165\164\x5f\142\x69\156\x64\151\156\147\x5f\x74\171\160\145\x20\166\141\162\x63\x68\141\x72\50\x31\x35\x29\x20\x44\105\x46\x41\125\114\x54\40\x27\x48\x74\164\x70\x52\x65\144\151\162\x65\x63\164\x27\x20\x4e\117\124\x20\x4e\x55\x4c\x4c");
    }
    function mo_update_cert()
    {
        global $wpdb;
        $wpdb->query("\101\x4c\x54\105\x52\40\124\x41\102\114\105\x20" . $this->spDataTableName . "\x20\101\104\104\x20\x43\x4f\114\x55\x4d\116\x20\x6d\x6f\137\151\x64\x70\x5f\143\x65\162\164\x5f\145\x6e\143\162\x79\160\164\x20\x6c\x6f\156\x67\x74\x65\170\164\x20\116\125\x4c\114");
        $wpdb->query("\101\x4c\x54\105\x52\40\x54\101\x42\114\x45\40" . $this->spDataTableName . "\40\101\104\104\x20\103\x4f\x4c\125\x4d\x4e\40\x6d\157\137\x69\144\x70\x5f\145\156\x63\162\171\160\164\x65\144\137\141\163\x73\x65\x72\x74\x69\x6f\156\x20\x73\155\x61\154\154\151\x6e\x74\40\x4e\125\x4c\114");
    }
    function mo_update_relay()
    {
        global $wpdb;
        $wpdb->query("\x41\114\x54\x45\x52\40\124\101\x42\114\x45\x20" . $this->spDataTableName . "\40\x41\104\104\x20\103\117\x4c\125\x4d\x4e\x20\155\157\x5f\x69\144\x70\x5f\144\x65\x66\141\x75\154\164\137\x72\145\x6c\x61\x79\x53\x74\x61\x74\x65\x20\154\157\x6e\x67\164\145\170\x74\x20\x4e\x55\114\114");
    }
    function mo_update_custom_attr()
    {
        global $wpdb;
        $wpdb->query("\101\114\x54\105\x52\x20\124\101\102\x4c\105\40" . $this->spAttrTableName . "\40\x41\104\104\x20\103\x4f\x4c\x55\115\116\x20\155\157\x5f\141\164\x74\162\137\164\x79\x70\x65\40\163\155\x61\x6c\x6c\x69\x6e\164\40\104\105\106\x41\x55\x4c\124\x20\60\x20\x4e\x4f\124\40\x4e\125\114\114");
        $wpdb->update($this->spAttrTableName, array("\x6d\157\137\141\x74\x74\162\137\x74\x79\x70\x65" => "\61"), array("\155\157\137\163\160\137\141\164\164\x72\x5f\x6e\141\155\145" => "\x67\x72\x6f\165\x70\115\141\160\x4e\x61\155\145"));
    }
    function get_sp_list()
    {
        global $wpdb;
        return $wpdb->get_results("\x53\x45\x4c\x45\103\124\x20\52\40\106\x52\x4f\x4d\40" . $this->spDataTableName);
    }
    function get_sp_data($tW)
    {
        global $wpdb;
        return $wpdb->get_row("\123\x45\114\x45\103\124\x20\x2a\40\106\x52\x4f\x4d\x20" . $this->spDataTableName . "\40\127\110\105\x52\x45\40\151\144\75" . $tW);
    }
    function get_sp_count()
    {
        global $wpdb;
        $Qc = "\x53\105\x4c\x45\103\124\x20\x43\117\125\116\x54\x28\52\x29\x20\x46\122\117\x4d\40" . $this->spDataTableName;
        return $wpdb->get_var($Qc);
    }
    function get_sp_attributes($tW)
    {
        global $wpdb;
        return $wpdb->get_results("\x53\105\x4c\105\103\124\x20\x2a\40\x46\122\x4f\115\x20" . $this->spAttrTableName . "\x20\127\110\x45\122\105\x20\155\x6f\137\x73\x70\x5f\x69\144\40\75\40{$tW}\40\101\x4e\104\40\155\157\x5f\163\160\x5f\141\164\x74\x72\137\156\x61\x6d\145\40\x3c\x3e\40\47\x67\162\x6f\165\x70\x4d\141\160\116\141\155\145\x27\x20\x41\x4e\104\40\155\x6f\137\x61\x74\164\x72\137\164\171\160\x65\x20\75\40\x30");
    }
    function get_sp_role_attribute($tW)
    {
        global $wpdb;
        return $wpdb->get_row("\x53\105\x4c\105\x43\124\40\x2a\x20\x46\122\117\x4d\40" . $this->spAttrTableName . "\x20\127\110\x45\122\x45\x20\155\x6f\137\163\x70\137\151\x64\x20\75\x20{$tW}\x20\101\x4e\x44\x20\x6d\x6f\137\x73\x70\x5f\141\164\x74\162\137\156\141\155\145\40\x3d\40\x27\147\162\x6f\x75\x70\115\141\x70\116\141\155\x65\x27");
    }
    function get_all_sp_attributes($tW)
    {
        global $wpdb;
        return $wpdb->get_results("\x53\105\x4c\x45\103\124\x20\52\40\106\x52\117\115\40" . $this->spAttrTableName . "\x20\127\110\x45\122\105\x20\155\157\137\x73\160\137\151\x64\x20\75\x20{$tW}\40");
    }
    function get_sp_from_issuer($t3)
    {
        global $wpdb;
        return $wpdb->get_row("\x53\x45\114\105\x43\x54\x20\52\x20\106\122\117\115\x20" . $this->spDataTableName . "\40\x57\x48\x45\122\x45\40\x6d\157\137\151\144\x70\137\163\x70\137\x69\x73\x73\x75\x65\x72\40\75\x20\47{$t3}\x27");
    }
    function get_sp_from_name($Zp)
    {
        global $wpdb;
        return $wpdb->get_row("\x53\105\114\105\103\x54\x20\52\x20\106\122\117\115\x20" . $this->spDataTableName . "\x20\127\x48\x45\x52\105\40\x6d\157\x5f\x69\x64\x70\137\x73\160\x5f\x6e\x61\155\145\40\75\x20\x27{$Zp}\47");
    }
    function get_sp_from_acs($wA)
    {
        global $wpdb;
        return $wpdb->get_row("\x53\x45\114\x45\x43\124\x20\x2a\x20\x46\122\117\x4d\x20" . $this->spDataTableName . "\40\127\110\x45\x52\x45\40\155\x6f\137\x69\144\x70\x5f\x61\x63\163\137\x75\x72\154\x20\75\x20\x27{$wA}\47");
    }
    function insert_sp_data($jX)
    {
        global $wpdb;
        return $wpdb->insert($this->spDataTableName, $jX);
    }
    function update_sp_data($jX, $Xc)
    {
        global $wpdb;
        $wpdb->update($this->spDataTableName, $jX, $Xc);
    }
    function delete_sp($LI, $kc)
    {
        global $wpdb;
        $this->delete_sp_attributes($kc);
        $wpdb->delete($this->spDataTableName, $LI, $Hd = null);
    }
    function delete_sp_attributes($S1)
    {
        global $wpdb;
        $wpdb->delete($this->spAttrTableName, $S1, $Hd = null);
    }
    function insert_sp_attributes($s4)
    {
        global $wpdb;
        $wpdb->insert($this->spAttrTableName, $s4);
    }
    function get_custom_sp_attr($tW)
    {
        global $wpdb;
        return $wpdb->get_results("\x53\105\114\x45\103\x54\x20\52\40\x46\x52\x4f\115\40" . $this->spAttrTableName . "\40\x57\110\x45\x52\105\x20\x6d\x6f\x5f\x73\160\137\x69\144\40\x3d\40{$tW}\40\x41\x4e\104\40\x6d\x6f\x5f\x61\164\x74\x72\x5f\164\171\x70\145\40\75\40\62");
    }
    function get_users()
    {
        global $wpdb;
        return $wpdb->get_var("\x53\x45\x4c\105\x43\124\40\x43\x4f\x55\x4e\x54\x28\x2a\51\40\x46\122\117\x4d\40" . $this->userMetaTable . "\40\x57\110\105\122\105\x20\155\145\x74\141\137\x6b\145\171\x3d\47\155\x6f\137\x69\x64\160\137\165\163\145\x72\x5f\164\x79\x70\145\47");
    }
    function get_protocol()
    {
        global $wpdb;
        return $wpdb->get_results("\123\x45\x4c\x45\x43\x54\40\x6d\157\137\151\144\x70\137\160\x72\x6f\164\x6f\143\x6f\x6c\137\x74\x79\160\145\x20\x46\122\117\x4d\40" . $this->spDataTableName);
    }
    function getDistinctMetaAttributes()
    {
        global $wpdb;
        return $wpdb->get_results("\123\x45\x4c\x45\x43\124\40\x44\x49\x53\124\x49\116\x43\x54\x20\x6d\145\x74\141\x5f\153\x65\171\40\x46\122\117\115\40" . $this->userMetaTable);
    }
}
