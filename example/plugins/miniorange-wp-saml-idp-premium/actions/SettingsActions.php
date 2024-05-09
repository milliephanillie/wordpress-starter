<?php


namespace IDP\Actions;

use IDP\Exception\InvalidEncryptionCertException;
use IDP\Exception\InvalidOperationException;
use IDP\Exception\IssuerValueAlreadyInUseException;
use IDP\Exception\InvalidMetaDataFileException;
use IDP\Exception\InvalidMetaDataUrlException;
use IDP\Exception\InvalidSPSSODescriptorException;
use IDP\Exception\JSErrorException;
use IDP\Exception\NoServiceProviderConfiguredException;
use IDP\Exception\NotRegisteredException;
use IDP\Exception\RequiredFieldsException;
use IDP\Exception\SPNameAlreadyInUseException;
use IDP\Handler\AttributeSettingsHandler;
use IDP\Handler\CustomLoginURLHandler;
use IDP\Handler\RoleBasedSSOHandler;
use IDP\Handler\FeedbackHandler;
use IDP\Handler\IDPSettingsHandler;
use IDP\Handler\SPSettingsHandler;
use IDP\Handler\SupportHandler;
use IDP\Handler\MetadataReaderHandler;
use IDP\Helper\Traits\Instance;
use IDP\Helper\Utilities\MoIDPUtility;
class SettingsActions extends BasePostAction
{
    use Instance;
    private $handler;
    private $supportHandler;
    private $idpSettingsHandler;
    private $feedbackHandler;
    private $attrSettingsHandler;
    private $metadataReaderHandler;
    private $customLoginURLHandler;
    private $roleBasedSSOHandler;
    public function __construct()
    {
        $this->handler = SPSettingsHandler::instance();
        $this->supportHandler = SupportHandler::instance();
        $this->idpSettingsHandler = IDPSettingsHandler::instance();
        $this->feedbackHandler = FeedbackHandler::instance();
        $this->attrSettingsHandler = AttributeSettingsHandler::instance();
        $this->metadataReaderHandler = MetadataReaderHandler::instance();
        $this->roleBasedSSOHandler = RoleBasedSSOHandler::instance();
        $this->customLoginURLHandler = CustomLoginURLHandler::instance();
        $this->_nonce = "\151\144\x70\137\x73\x65\x74\x74\151\x6e\147\x73";
        parent::__construct();
    }
    private $funcs = array("\x6d\157\137\x61\144\x64\137\151\144\160", "\155\x6f\137\x65\x64\x69\x74\x5f\x69\144\160", "\x6d\157\x5f\163\150\x6f\167\x5f\x73\x70\137\x73\x65\x74\x74\x69\x6e\147\x73", "\155\x6f\x5f\x69\144\x70\x5f\144\145\x6c\x65\164\x65\137\x73\160\x5f\x73\145\164\x74\151\156\147\x73", "\x6d\157\137\151\x64\160\x5f\145\156\x74\x69\164\171\137\151\144", "\x63\150\x61\156\x67\145\x5f\156\x61\x6d\145\x5f\151\x64", "\155\157\137\151\x64\x70\137\143\x6f\156\x74\141\x63\x74\137\165\163\137\x71\x75\145\162\171\x5f\x6f\160\x74\151\x6f\156", "\x6d\157\x5f\151\144\160\x5f\146\145\x65\144\142\x61\143\153\x5f\x6f\160\x74\151\157\x6e", "\155\x6f\x5f\151\x64\160\137\x61\x74\x74\162\x5f\x73\145\164\164\151\x6e\147\163", "\x6d\157\137\141\x64\x64\137\x72\157\x6c\x65\x5f\141\x74\x74\x72\x69\x62\165\164\x65", "\x6d\x6f\137\163\x61\166\145\137\x63\165\x73\x74\x6f\x6d\x5f\151\x64\x70\x5f\141\x74\x74\162", "\x6d\x6f\x5f\163\x68\157\167\x5f\163\163\157\137\x75\x73\x65\162\163", "\x6d\x6f\x5f\x69\x64\160\137\x75\x70\154\x6f\141\144\x5f\x6d\145\x74\x61\144\141\x74\x61", "\x6d\x6f\x5f\151\144\160\137\145\x64\151\x74\x5f\155\x65\x74\141\144\141\x74\x61", "\x6d\157\137\151\x64\160\137\x61\x64\x64\137\143\x75\x73\x74\157\x6d\x5f\x6c\157\147\x69\156\137\165\162\154", "\155\x6f\x5f\151\144\160\137\162\x65\x73\164\x72\151\x63\164\x5f\162\x6f\154\x65\x73");
    public function handle_post_data()
    {
        if (!(current_user_can("\155\x61\156\x61\147\145\137\157\160\x74\151\157\x6e\x73") and isset($_POST["\157\160\164\151\157\x6e"]))) {
            goto IV;
        }
        $Ig = trim($_POST["\157\160\x74\x69\157\x6e"]);
        try {
            $this->route_post_data($Ig);
            $this->changeSPInSession($_POST);
        } catch (NotRegisteredException $zU) {
            do_action("\155\x6f\x5f\x69\144\x70\x5f\x73\150\157\167\137\x6d\145\163\x73\141\x67\x65", $zU->getMessage(), "\105\122\122\x4f\122");
        } catch (NoServiceProviderConfiguredException $zU) {
            do_action("\155\x6f\x5f\151\x64\x70\137\x73\x68\x6f\167\x5f\x6d\x65\x73\163\x61\x67\145", $zU->getMessage(), "\105\122\122\x4f\122");
        } catch (JSErrorException $zU) {
            do_action("\155\157\x5f\151\144\160\137\x73\150\157\x77\137\x6d\x65\163\163\x61\147\x65", $zU->getMessage(), "\105\x52\122\x4f\x52");
        } catch (RequiredFieldsException $zU) {
            do_action("\x6d\157\137\x69\144\160\137\x73\x68\157\x77\137\x6d\x65\x73\x73\141\x67\145", $zU->getMessage(), "\x45\122\x52\117\x52");
        } catch (SPNameAlreadyInUseException $zU) {
            do_action("\x6d\157\137\x69\144\x70\x5f\x73\150\x6f\x77\x5f\x6d\145\x73\163\x61\147\x65", $zU->getMessage(), "\x45\122\x52\x4f\x52");
        } catch (IssuerValueAlreadyInUseException $zU) {
            do_action("\x6d\157\x5f\151\144\x70\137\x73\150\157\x77\137\x6d\145\163\163\x61\x67\145", $zU->getMessage(), "\105\122\x52\117\122");
        } catch (InvalidEncryptionCertException $zU) {
            do_action("\155\157\137\x69\x64\x70\137\163\150\157\167\137\155\x65\163\x73\x61\x67\145", $zU->getMessage(), "\x45\x52\122\x4f\x52");
        } catch (InvalidOperationException $zU) {
            do_action("\155\157\x5f\151\144\x70\x5f\x73\150\157\167\137\x6d\x65\x73\x73\141\x67\145", $zU->getMessage(), "\105\x52\x52\117\122");
        } catch (InvalidMetaDataUrlException $zU) {
            do_action("\x6d\157\137\151\144\x70\137\x73\150\x6f\167\137\x6d\x65\x73\163\141\x67\x65", $zU->getMessage(), "\x45\x52\122\117\x52");
        } catch (InvalidMetaDataFileException $zU) {
            do_action("\155\157\x5f\151\144\160\x5f\x73\150\157\x77\137\x6d\x65\163\x73\141\x67\x65", $zU->getMessage(), "\x45\122\x52\x4f\x52");
        } catch (InvalidSPSSODescriptorException $zU) {
            do_action("\155\157\137\x69\144\x70\x5f\163\x68\x6f\167\x5f\155\145\163\163\x61\147\x65", $zU->getMessage(), "\x45\122\122\117\122");
        } catch (\Exception $zU) {
            if (!MSI_DEBUG) {
                goto Kn;
            }
            MoIDPUtility::mo_debug("\105\170\x63\145\160\x74\151\x6f\156\40\117\x63\143\165\x72\162\145\144\40\x64\165\162\151\156\147\40\123\x53\x4f\x20" . $zU);
            Kn:
            wp_die($zU->getMessage());
        }
        IV:
    }
    public function route_post_data($Ig)
    {
        switch ($Ig) {
            case $this->funcs[0]:
                $this->handler->_mo_idp_save_new_sp($_POST);
                goto dr;
            case $this->funcs[1]:
                $this->handler->_mo_idp_edit_sp($_POST);
                goto dr;
            case $this->funcs[2]:
                $this->handler->_mo_sp_change_settings($_POST);
                goto dr;
            case $this->funcs[3]:
                $this->handler->mo_idp_delete_sp_settings($_POST);
                goto dr;
            case $this->funcs[4]:
                $this->idpSettingsHandler->mo_change_idp_entity_id($_POST);
                goto dr;
            case $this->funcs[5]:
                $this->handler->mo_idp_change_name_id($_POST);
                goto dr;
            case $this->funcs[6]:
                $this->supportHandler->_mo_idp_support_query($_POST);
                goto dr;
            case $this->funcs[7]:
                $this->feedbackHandler->_mo_send_feedback($_POST);
                goto dr;
            case $this->funcs[8]:
                $this->attrSettingsHandler->mo_idp_save_attr_settings($_POST);
                goto dr;
            case $this->funcs[9]:
                $this->attrSettingsHandler->mo_add_role_attribute($_POST);
                goto dr;
            case $this->funcs[10]:
                $this->attrSettingsHandler->mo_save_custom_idp_attr($_POST);
                goto dr;
            case $this->funcs[11]:
                $this->handler->show_sso_users($_POST);
                goto dr;
            case $this->funcs[12]:
                $this->metadataReaderHandler->handle_upload_metadata($_POST);
                goto dr;
            case $this->funcs[13]:
                $this->metadataReaderHandler->handle_edit_metadata($_POST);
                goto dr;
            case $this->funcs[14]:
                $this->customLoginURLHandler->handle_custom_login_url($_POST);
                goto dr;
            case $this->funcs[15]:
                $this->roleBasedSSOHandler->handle_role_based_sso($_POST);
                goto dr;
        }
        zJ:
        dr:
    }
    public function changeSPInSession($d1)
    {
        MoIDPUtility::startSession();
        global $dbIDPQueries;
        $LT = $dbIDPQueries->get_sp_list();
        $_SESSION["\123\120"] = array_key_exists("\163\145\162\x76\151\x63\145\137\x70\162\157\x76\151\x64\x65\162", $d1) && !MoIDPUtility::isBlank($d1["\x73\x65\162\166\151\x63\x65\x5f\x70\162\x6f\x76\x69\x64\145\x72"]) ? $d1["\163\145\x72\166\151\143\x65\x5f\x70\162\157\166\x69\144\x65\162"] : (empty($LT) ? 1 : $LT[0]->id);
    }
}
