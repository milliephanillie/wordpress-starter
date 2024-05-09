<?php


namespace IDP;

use IDP\Actions\ManageUserTableViewAction;
use IDP\Actions\RegistrationActions;
use IDP\Actions\SettingsActions;
use IDP\Actions\SSOActions;
use IDP\Actions\UpdateFrameworkActions;
use IDP\Handler\SupportHandler;
use IDP\Helper\Constants\MoIdPDisplayMessages;
use IDP\Helper\Database\MoDbQueries;
use IDP\Helper\Traits\Instance;
use IDP\Helper\Utilities\MenuItems;
use IDP\Helper\Utilities\MoIDPUtility;
use IDP\Helper\Utilities\RewriteRules;
use IDP\Helper\constants\MoIDPConstants;
final class MoIDP
{
    use Instance;
    private function __construct()
    {
        $this->initializeGlobalVariables();
        $this->initializeActions();
        $this->addHooks();
        $this->addSecondaryHooks();
        $this->addShortCodeHooks();
    }
    function initializeGlobalVariables()
    {
        global $dbIDPQueries;
        $dbIDPQueries = MoDbQueries::instance();
    }
    function addHooks()
    {
        add_action("\155\x6f\x5f\x69\144\160\x5f\163\x68\x6f\167\x5f\155\x65\x73\163\141\x67\x65", array($this, "\155\157\x5f\x73\x68\157\167\137\x6d\145\x73\163\141\147\x65"), 1, 2);
        add_action("\141\144\x6d\x69\x6e\137\x6d\145\156\165", array($this, "\155\x6f\137\151\x64\x70\x5f\x6d\145\x6e\x75"));
        add_action("\x61\144\x6d\151\x6e\137\145\156\x71\165\145\165\x65\x5f\x73\x63\x72\x69\160\164\x73", array($this, "\155\157\137\x69\x64\160\137\160\154\x75\x67\151\x6e\x5f\163\145\x74\164\151\156\147\x73\x5f\x73\164\x79\x6c\145"));
        add_action("\x61\x64\x6d\x69\x6e\137\145\156\161\165\x65\x75\x65\137\x73\x63\x72\x69\x70\x74\x73", array($this, "\155\x6f\x5f\151\144\x70\x5f\x70\154\x75\x67\x69\156\137\163\145\164\x74\x69\156\x67\163\x5f\x73\x63\x72\151\160\164"));
        add_action("\145\x6e\161\165\x65\x75\x65\x5f\x73\143\162\x69\x70\x74\x73", array($this, "\155\157\137\151\144\160\x5f\x70\x6c\x75\147\x69\156\137\163\145\x74\164\151\156\x67\163\x5f\x73\164\171\x6c\x65"));
        add_action("\x65\156\161\x75\x65\x75\145\137\x73\143\162\x69\x70\164\163", array($this, "\x6d\x6f\x5f\x69\144\x70\137\x70\x6c\165\x67\151\156\x5f\163\145\x74\164\x69\x6e\147\163\x5f\x73\143\162\x69\x70\164"));
        add_action("\141\144\155\x69\x6e\x5f\x66\157\x6f\x74\145\x72", array($this, "\146\x65\145\144\142\141\143\153\137\162\145\161\x75\145\163\x74"));
        add_filter("\x70\154\x75\x67\x69\x6e\137\x61\x63\x74\151\x6f\156\137\x6c\x69\156\x6b\163\x5f" . MSI_PLUGIN_NAME, array($this, "\155\157\137\x69\x64\x70\x5f\160\x6c\x75\x67\151\156\x5f\x61\156\143\x68\157\162\137\154\151\x6e\x6b\163"));
        register_activation_hook(MSI_PLUGIN_NAME, array($this, "\155\x6f\x5f\160\154\x75\x67\151\x6e\137\141\x63\x74\x69\x76\141\164\x65"));
    }
    function initializeActions()
    {
        RewriteRules::instance();
        SettingsActions::instance();
        RegistrationActions::instance();
        SSOActions::instance();
        ManageUserTableViewAction::instance();
        if (!(MoIDPUtility::micr() && MoIDPUtility::iclv())) {
            goto QM;
        }
        UpdateFrameworkActions::instance();
        QM:
    }
    function mo_idp_menu()
    {
        new MenuItems($this);
    }
    function mo_sp_settings()
    {
        require_once MoIDPConstants::SSO_MAIN_CONTROLLER;
    }
    function mo_idp_plugin_settings_style()
    {
        wp_enqueue_style("\x6d\157\137\x69\144\x70\137\x61\x64\x6d\151\x6e\x5f\x73\145\x74\x74\x69\156\x67\163\x5f\163\164\x79\x6c\145", MSI_CSS_URL);
        wp_enqueue_style("\167\160\x2d\x70\157\x69\x6e\x74\145\x72");
    }
    function mo_idp_plugin_settings_script()
    {
        wp_enqueue_script("\x6d\x6f\x5f\x69\x64\160\137\141\144\x6d\x69\x6e\137\x73\145\164\x74\x69\156\x67\163\137\163\x63\162\151\160\164", MSI_JS_URL, array("\x6a\x71\x75\145\162\171"));
    }
    function mo_plugin_activate()
    {
        global $dbIDPQueries;
        $dbIDPQueries->checkTablesAndRunQueries();
        if (!(get_site_option("\155\157\137\x69\144\x70\x5f\x6b\145\x65\160\137\x73\x65\164\x74\151\x6e\x67\163\137\151\156\164\141\143\x74", NULL) === NULL)) {
            goto zY;
        }
        update_site_option("\x6d\x6f\x5f\x69\x64\x70\137\x6b\145\x65\160\x5f\x73\x65\x74\x74\x69\156\x67\163\137\x69\156\x74\141\143\x74", TRUE);
        zY:
    }
    function mo_show_message($Qj, $p8)
    {
        new MoIdPDisplayMessages($Qj, $p8);
    }
    function feedback_request()
    {
        if (!(isset($_SERVER["\120\110\x50\137\123\x45\x4c\106"]) && "\x70\154\165\147\151\x6e\x73\x2e\160\x68\160" !== basename(sanitize_text_field(wp_unslash($_SERVER["\120\x48\x50\137\x53\105\x4c\106"]))))) {
            goto vP;
        }
        return;
        vP:
        require_once MoIDPConstants::FEEDBACK;
    }
    function addSecondaryHooks()
    {
        add_action("\x66\x6c\x75\x73\150\x5f\x63\141\x63\150\145", array($this, "\x66\x6c\165\x73\150\x5f\x63\141\x63\x68\145"), 1);
        add_action("\163\x74\141\x72\x74\144\x70\x72\157\143\x65\x73\163", array($this, "\x73\164\141\162\x74\144\x70\x72\157\143\145\163\x73"), 1);
        register_deactivation_hook(MSI_PLUGIN_NAME, array($this, "\155\x6f\137\151\144\160\x5f\x64\x65\x61\x63\164\151\x76\141\x74\x65"));
    }
    function addShortCodeHooks()
    {
        add_shortcode("\155\x6f\x5f\163\160\137\154\x69\x6e\x6b", array($this, "\x6d\157\x5f\x69\x64\160\137\x73\150\157\x72\164\x63\x6f\144\145"));
        add_shortcode("\x6d\x6f\137\152\167\x74\137\154\151\x6e\153", array($this, "\x6d\x6f\x5f\151\144\160\137\152\x77\x74\137\163\150\157\162\164\x63\x6f\144\145"));
    }
    function mo_idp_shortcode($Dm = null)
    {
        if (!(!MoIDPUtility::micr() || !MoIDPUtility::iclv())) {
            goto q5;
        }
        return "\x50\x6c\x75\x67\x69\x6e\x20\x6e\x6f\x74\40\x63\157\156\x66\151\147\x75\162\145\144\56\40\120\x6c\145\141\x73\x65\x20\x63\157\156\164\141\143\x74\x20\x79\157\x75\162\40\163\x69\164\x65\40\x61\144\x6d\x69\x6e\x69\x73\x74\162\141\164\x6f\162\56";
        q5:
        if (is_user_logged_in()) {
            goto Px;
        }
        $FZ = "\x3c\x61\40\150\162\x65\146\75" . wp_login_url(get_permalink()) . "\76\x4c\x6f\147\x20\x69\x6e\x3c\x2f\x61\76";
        goto ud;
        Px:
        if (!MoIDPUtility::isBlank($Dm)) {
            goto Vb;
        }
        $FZ = "\123\x68\157\x72\x74\x43\x6f\144\x65\40\110\x61\163\x6e\x27\x74\40\142\x65\145\156\40\x73\145\x74\x20\x70\x72\157\x70\x65\x72\154\171\56";
        goto ms;
        Vb:
        $FZ = "\74\141\40\150\x72\145\x66\x3d\42" . site_url() . "\57\77\x6f\x70\164\x69\157\x6e\75\x73\x61\155\x6c\137\165\x73\x65\x72\137\154\x6f\x67\151\156\46\163\x70\75" . $Dm["\x73\160"] . "\x26\x72\x65\x6c\141\x79\x53\x74\x61\x74\145\x3d" . $Dm["\162\x65\x6c\x61\x79\163\164\141\164\x65"] . "\42\76\12\40\x20\40\40\40\40\x20\x20\40\40\x20\x20\x20\40\40\40\40\40\x20\40\114\x6f\147\x69\x6e\x20\x74\x6f\x20" . $Dm["\x73\x70"] . "\74\57\141\x3e";
        ms:
        ud:
        return $FZ;
    }
    function mo_idp_jwt_shortcode($Dm = null)
    {
        if (!(!MoIDPUtility::micr() || !MoIDPUtility::iclv())) {
            goto bq;
        }
        return "\x50\154\165\147\x69\x6e\x20\156\157\x74\x20\x63\157\156\146\151\x67\165\x72\145\144\56\x20\x50\x6c\145\x61\163\x65\x20\x63\157\156\164\141\143\x74\x20\171\157\165\x72\40\163\151\x74\145\x20\x61\144\x6d\151\156\x69\x73\164\x72\141\x74\157\162\56";
        bq:
        if (is_user_logged_in()) {
            goto w0;
        }
        $FZ = "\74\141\40\x68\x72\145\146\x3d" . wp_login_url(get_permalink()) . "\x3e\114\157\x67\40\151\x6e\x3c\57\141\76";
        goto j5;
        w0:
        if (!MoIDPUtility::isBlank($Dm)) {
            goto Mv;
        }
        $FZ = "\x53\150\x6f\x72\x74\103\x6f\x64\x65\40\x48\141\163\x6e\x27\x74\x20\x62\x65\x65\156\x20\x73\145\x74\40\160\162\157\160\145\162\x6c\x79\56";
        goto ke;
        Mv:
        $FZ = "\74\x61\40\x68\162\x65\x66\x3d\42" . site_url() . "\x2f\77\x6f\x70\x74\151\157\x6e\75\x6a\x77\x74\x5f\x6c\157\147\x69\156\x26\163\x70\75" . $Dm["\x73\x70"] . "\46\x72\x65\154\x61\x79\123\x74\141\164\145\x3d" . $Dm["\162\145\154\x61\171\x73\x74\141\x74\x65"] . "\x22\76\xa\40\40\40\x20\40\40\x20\40\x20\40\x20\40\40\40\x20\40\x20\40\x20\x20\x4c\x6f\x67\x69\156\40\x74\157\x20" . $Dm["\163\160"] . "\74\57\141\x3e";
        ke:
        j5:
        return $FZ;
    }
    function flush_cache()
    {
        if (!(MoIDPUtility::micr() && MoIDPUtility::iclv())) {
            goto BN;
        }
        MoIDPUtility::mius();
        BN:
    }
    function startdprocess()
    {
        if (!MSI_DEBUG) {
            goto ld;
        }
        MoIDPUtility::mo_debug("\x44\x65\x61\x63\164\151\x76\x61\x74\151\x6e\x67\40\x74\x68\x65\x20\x50\154\165\x67\x69\x6e");
        ld:
        require_once MoIDPConstants::WP_ADMIN_PLUGIN;
        deactivate_plugins(MSI_PLUGIN_NAME);
        wp_die("\x3c\x73\x74\162\x6f\156\x67\76\x4c\x4b\137\x45\x52\x52\117\x52\72\x20\74\57\x73\x74\162\157\156\147\x3e\123\x53\x4f\x20\x46\x61\x69\154\x65\x64\56\40\120\x6c\145\x61\163\145\x20\x63\157\x6e\x74\141\x63\x74\40\171\157\x75\x72\40\141\144\155\x69\x6e\x73\x74\x72\141\164\157\162\56");
    }
    function mo_idp_deactivate()
    {
        do_action("\x66\x6c\165\x73\150\137\143\x61\x63\150\x65");
        wp_clear_scheduled_hook("\155\157\137\x69\x64\x70\x5f\166\x65\162\x73\x69\157\x6e\x5f\x63\150\145\x63\x6b");
        delete_site_option("\x6d\x6f\137\151\144\160\137\x74\x72\x61\x6e\x73\141\143\164\x69\157\x6e\x49\144");
        delete_site_option("\155\157\x5f\151\144\160\137\141\144\x6d\x69\156\137\x70\141\163\x73\x77\157\162\x64");
        delete_site_option("\x6d\x6f\x5f\151\x64\x70\x5f\x72\145\x67\151\x73\164\162\141\164\x69\x6f\156\x5f\163\164\141\x74\165\x73");
        delete_site_option("\155\x6f\x5f\151\144\x70\x5f\141\144\x6d\x69\x6e\137\x70\150\157\156\x65");
        delete_site_option("\x6d\157\137\151\144\x70\137\x6e\x65\167\137\x72\x65\147\151\x73\x74\162\141\x74\x69\x6f\156");
        delete_site_option("\155\x6f\137\x69\144\x70\x5f\141\144\155\151\156\x5f\x63\x75\x73\164\x6f\155\x65\x72\x5f\153\145\171");
        delete_site_option("\x6d\157\137\x69\x64\x70\137\x61\144\x6d\x69\156\x5f\141\160\x69\137\x6b\145\x79");
        delete_site_option("\x6d\x6f\x5f\x69\144\160\137\x76\x65\162\151\x66\171\137\x63\x75\163\164\157\x6d\145\x72");
        delete_site_option("\163\x6d\x6c\137\151\x64\160\x5f\154\145\x64");
        delete_site_option("\x69\144\160\x5f\166\x6c\137\143\x68\145\143\153\137\164");
        delete_site_option("\151\144\160\137\166\x6c\137\143\x68\145\143\153\137\163");
        wp_redirect(self_admin_url("\x70\x6c\x75\147\x69\x6e\163\56\160\x68\x70\x3f\144\145\141\x63\x74\151\166\141\x74\x65\75\x74\x72\165\x65"));
    }
    function mo_idp_plugin_anchor_links($qf)
    {
        if (!array_key_exists("\x64\145\141\143\164\151\x76\141\164\145", $qf)) {
            goto fx;
        }
        $XI = array();
        $jX = ["\123\145\164\164\151\156\147\163" => "\151\x64\160\137\143\x6f\156\x66\x69\147\165\162\x65\137\151\x64\x70"];
        foreach ($jX as $UV => $ak) {
            $mK = esc_url(add_query_arg("\x70\x61\147\145", $ak, get_admin_url() . "\141\144\155\151\156\x2e\160\x68\160\x3f"));
            $si = "\74\141\40\150\162\x65\x66\x3d\x27{$mK}\47\76" . __($UV) . "\x3c\57\141\x3e";
            array_push($XI, $si);
            k9:
        }
        Ed:
        $qf = $XI + $qf;
        fx:
        return $qf;
    }
}
