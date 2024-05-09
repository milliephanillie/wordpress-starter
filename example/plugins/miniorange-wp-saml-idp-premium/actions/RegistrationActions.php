<?php


namespace IDP\Actions;

use IDP\Exception\InvalidPhoneException;
use IDP\Exception\OTPRequiredException;
use IDP\Exception\OTPSendingFailedException;
use IDP\Exception\OTPValidationFailedException;
use IDP\Exception\PasswordMismatchException;
use IDP\Exception\PasswordResetFailedException;
use IDP\Exception\PasswordStrengthException;
use IDP\Exception\RegistrationRequiredFieldsException;
use IDP\Handler\LKHandler;
use IDP\Handler\RegistrationHandler;
use IDP\Helper\Traits\Instance;
use IDP\Helper\Utilities\MoIDPUtility;
class RegistrationActions extends BasePostAction
{
    use Instance;
    private $handler;
    private $lkHandler;
    private $funcs = array("\x6d\157\x5f\151\x64\x70\x5f\x72\145\147\x69\x73\x74\x65\162\137\143\165\163\164\157\x6d\x65\162", "\155\x6f\137\x69\144\160\x5f\x76\x61\154\151\144\141\x74\145\x5f\157\x74\160", "\155\x6f\x5f\151\x64\160\x5f\x70\x68\x6f\156\145\x5f\166\x65\x72\x69\146\x69\x63\x61\164\x69\157\x6e", "\x6d\157\137\x69\144\160\x5f\143\x6f\156\x6e\x65\x63\164\137\166\x65\162\x69\146\x79\137\x63\x75\163\x74\157\x6d\145\162", "\155\157\137\x69\144\160\x5f\146\x6f\x72\x67\157\x74\x5f\x70\141\163\163\x77\157\x72\144", "\155\157\137\x69\x64\160\x5f\x67\x6f\x5f\x62\141\x63\153", "\x6d\157\x5f\151\144\x70\137\162\x65\163\145\156\144\137\x6f\x74\x70", "\x72\145\155\x6f\x76\x65\x5f\x69\144\160\x5f\141\143\x63\x6f\165\156\164", "\155\x6f\x5f\151\x64\160\137\166\x65\x72\x69\146\x79\137\x6c\x69\143\x65\156\x73\x65", "\x72\x65\146\x72\145\x73\150\x5f\163\160\x5f\165\163\145\162\x73");
    public function __construct()
    {
        $this->handler = RegistrationHandler::instance();
        $this->lkHandler = LKHandler::instance();
        parent::__construct();
    }
    public function handle_post_data()
    {
        if (!(current_user_can("\155\x61\156\x61\147\x65\x5f\x6f\x70\x74\151\x6f\156\163") and isset($_POST["\157\160\164\151\157\156"]))) {
            goto eH;
        }
        $Ig = trim($_POST["\x6f\160\x74\151\x6f\x6e"]);
        try {
            $this->route_post_data($Ig);
        } catch (RegistrationRequiredFieldsException $zU) {
            do_action("\155\x6f\x5f\151\x64\160\137\x73\150\157\x77\x5f\155\x65\x73\163\x61\147\x65", $zU->getMessage(), "\105\x52\122\117\122");
        } catch (PasswordStrengthException $zU) {
            do_action("\155\x6f\x5f\x69\144\160\x5f\163\150\157\167\x5f\155\x65\163\x73\141\x67\145", $zU->getMessage(), "\x45\122\122\117\x52");
        } catch (PasswordMismatchException $zU) {
            do_action("\155\x6f\x5f\151\144\160\137\163\150\x6f\x77\137\x6d\145\163\163\141\147\145", $zU->getMessage(), "\105\x52\122\x4f\x52");
        } catch (InvalidPhoneException $zU) {
            update_site_option("\155\x6f\x5f\x69\x64\160\137\162\145\x67\x69\163\164\x72\x61\x74\x69\x6f\156\137\163\164\x61\x74\165\x73", "\115\x4f\137\x4f\x54\120\x5f\x44\105\x4c\x49\x56\105\122\105\104\137\x46\101\111\114\125\x52\x45");
            do_action("\x6d\157\137\x69\144\x70\x5f\163\x68\x6f\167\137\x6d\145\x73\x73\x61\x67\x65", $zU->getMessage(), "\105\x52\x52\x4f\122");
        } catch (OTPRequiredException $zU) {
            update_site_option("\155\x6f\137\x69\144\160\x5f\162\x65\147\151\x73\x74\x72\x61\x74\151\x6f\156\x5f\x73\164\141\x74\165\x73", "\115\x4f\x5f\x4f\124\x50\x5f\126\x41\114\111\x44\x41\x54\111\x4f\x4e\x5f\x46\101\111\x4c\x55\122\105");
            do_action("\x6d\157\x5f\x69\x64\160\x5f\163\150\x6f\x77\x5f\155\145\x73\x73\x61\x67\x65", $zU->getMessage(), "\x45\x52\122\117\x52");
        } catch (OTPValidationFailedException $zU) {
            update_site_option("\x6d\157\x5f\x69\x64\160\x5f\162\x65\x67\151\163\164\162\x61\x74\151\157\156\137\x73\x74\x61\164\x75\163", "\115\117\137\117\124\x50\137\126\x41\114\111\104\101\124\x49\117\116\137\x46\101\x49\114\x55\122\x45");
            do_action("\x6d\157\137\151\144\x70\137\x73\150\x6f\167\x5f\x6d\x65\x73\163\x61\147\145", $zU->getMessage(), "\105\122\x52\x4f\122");
        } catch (OTPSendingFailedException $zU) {
            update_site_option("\155\157\x5f\151\x64\x70\x5f\162\x65\147\x69\x73\x74\x72\141\164\x69\157\156\137\163\x74\141\164\165\163", "\115\x4f\137\117\124\120\x5f\x44\105\114\111\x56\x45\122\105\104\137\106\x41\111\114\125\x52\105");
            do_action("\x6d\x6f\x5f\x69\144\x70\137\163\150\157\167\x5f\155\145\163\x73\141\147\x65", $zU->getMessage(), "\105\122\122\x4f\x52");
        } catch (PasswordResetFailedException $zU) {
            do_action("\x6d\157\x5f\151\x64\160\x5f\163\150\157\x77\x5f\155\145\163\163\141\147\145", $zU->getMessage(), "\105\122\122\x4f\122");
        } catch (\Exception $zU) {
            if (!MSI_DEBUG) {
                goto K9;
            }
            MoIDPUtility::mo_debug("\x45\x78\143\145\160\x74\x69\x6f\156\40\117\143\143\165\162\162\x65\x64\40\x64\x75\x72\151\x6e\x67\40\123\123\x4f\40" . $zU);
            K9:
            wp_die($zU->getMessage());
        }
        eH:
    }
    public function route_post_data($Ig)
    {
        switch ($Ig) {
            case $this->funcs[0]:
                $this->handler->_idp_register_customer($_POST);
                goto rR;
            case $this->funcs[1]:
                $this->handler->_idp_validate_otp($_POST);
                goto rR;
            case $this->funcs[2]:
                $this->handler->_mo_idp_phone_verification($_POST);
                goto rR;
            case $this->funcs[3]:
                $this->handler->_mo_idp_verify_customer($_POST);
                goto rR;
            case $this->funcs[4]:
                $this->handler->_mo_idp_forgot_password();
                goto rR;
            case $this->funcs[5]:
            case $this->funcs[7]:
                $this->handler->_mo_idp_go_back();
                goto rR;
            case $this->funcs[6]:
                $this->handler->_send_otp_token(get_site_option("\x6d\157\137\x69\144\160\x5f\x61\144\x6d\x69\x6e\137\x65\155\141\x69\154"), '', "\105\x4d\x41\111\x4c");
                goto rR;
            case $this->funcs[8]:
                $this->lkHandler->_mo_verify_license($_POST);
                goto rR;
            case $this->funcs[9]:
                $this->lkHandler->refresh_sp_users_count();
                goto rR;
        }
        Ql:
        rR:
    }
}
