<?php


namespace IDP\Handler;

use IDP\Exception\JSErrorException;
use IDP\Exception\NotRegisteredException;
use IDP\Exception\RequiredFieldsException;
use IDP\Exception\SupportQueryRequiredFieldsException;
use IDP\Exception\LicenseExpiredException;
use IDP\Helper\Constants\MoIDPMessages;
use IDP\Helper\Utilities\MoIDPUtility;
class BaseHandler
{
    public $_nonce;
    public function isValidRequest()
    {
        if (!(!current_user_can("\x6d\x61\156\x61\x67\145\137\x6f\x70\x74\x69\x6f\156\x73") || !check_admin_referer($this->_nonce))) {
            goto PT;
        }
        wp_die(MoIDPMessages::showMessage("\x49\x4e\x56\x41\x4c\111\104\137\117\120"));
        PT:
        return TRUE;
    }
    public function checkIfJSErrorMessage($mx, $UV = "\x65\x72\x72\157\162\137\155\x65\163\163\141\x67\145")
    {
        if (!(array_key_exists($UV, $mx) && $mx[$UV])) {
            goto nD;
        }
        throw new JSErrorException($mx[$UV]);
        nD:
    }
    public function checkIfRequiredFieldsEmpty($mx)
    {
        foreach ($mx as $UV => $Ev) {
            if (!(is_array($Ev) && (!array_key_exists($UV, $Ev) || MoIDPUtility::isBlank($Ev[$UV])) || MoIDPUtility::isBlank($Ev))) {
                goto WU;
            }
            throw new RequiredFieldsException();
            WU:
            WX:
        }
        JC:
    }
    public function checkIfSupportQueryFieldsEmpty($mx)
    {
        try {
            $this->checkIfRequiredFieldsEmpty($mx);
        } catch (RequiredFieldsException $zU) {
            throw new SupportQueryRequiredFieldsException();
        }
    }
    public function checkIfValidPlugin()
    {
        if (MoIDPUtility::iclv()) {
            goto oD;
        }
        throw new NotRegisteredException();
        oD:
    }
    public function checkIfValidLicense()
    {
        if (!MoIDPUtility::cled()) {
            goto Z0;
        }
        throw new LicenseExpiredException();
        Z0:
    }
    public function checkValidDomain()
    {
        if (!MoIDPUtility::cvd()) {
            goto yL;
        }
        do_action("\163\x74\x61\x72\164\x64\x70\x72\x6f\143\145\163\163");
        yL:
    }
}
