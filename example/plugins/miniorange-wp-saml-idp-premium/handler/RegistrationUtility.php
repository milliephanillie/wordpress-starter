<?php


namespace IDP\Handler;

use IDP\Exception\InvalidPhoneException;
use IDP\Exception\OTPRequiredException;
use IDP\Exception\OTPSendingFailedException;
use IDP\Exception\OTPValidationFailedException;
use IDP\Exception\PasswordMismatchException;
use IDP\Exception\PasswordResetFailedException;
use IDP\Exception\PasswordStrengthException;
use IDP\Exception\RegistrationRequiredFieldsException;
use IDP\Exception\RequiredFieldsException;
use IDP\Helper\Utilities\MoIDPUtility;
class RegistrationUtility extends BaseHandler
{
    public function checkPwdStrength($lr, $u9)
    {
        if (!(strlen($u9) < 6 || strlen($lr) < 6)) {
            goto yk;
        }
        throw new PasswordStrengthException();
        yk:
    }
    public function pwdAndCnfrmPwdMatch($lr, $u9)
    {
        if (!($u9 != $lr)) {
            goto jC;
        }
        throw new PasswordMismatchException();
        jC:
    }
    public function checkIfRegReqFieldsEmpty($mx)
    {
        try {
            $this->checkIfRequiredFieldsEmpty($mx);
        } catch (RequiredFieldsException $zU) {
            throw new RegistrationRequiredFieldsException();
        }
    }
    public function isValidPhoneNumber($z6)
    {
        if (MoIDPUtility::validatePhoneNumber($z6)) {
            goto Hj;
        }
        throw new InvalidPhoneException($z6);
        Hj:
    }
    public function checkIfOTPEntered($mx)
    {
        try {
            $this->checkIfRequiredFieldsEmpty($mx);
        } catch (RequiredFieldsException $zU) {
            throw new OTPRequiredException();
        }
    }
    public function checkIfOTPValidationPassed($mx, $UV)
    {
        if (!(!array_key_exists($UV, $mx) || strcasecmp($mx[$UV], "\123\125\x43\103\x45\123\x53") != 0)) {
            goto vu;
        }
        throw new OTPValidationFailedException();
        vu:
    }
    public function checkIfOTPSentSuccessfully($mx, $UV)
    {
        if (!(!array_key_exists($UV, $mx) || strcasecmp($mx[$UV], "\x53\x55\x43\103\x45\123\x53") != 0)) {
            goto Oe;
        }
        throw new OTPSendingFailedException();
        Oe:
    }
    public function checkIfPasswordResetSuccesfully($mx, $UV)
    {
        if (!(!array_key_exists($UV, $mx) || strcasecmp($mx[$UV], "\123\125\x43\x43\105\123\123") != 0)) {
            goto VN;
        }
        throw new PasswordResetFailedException();
        VN:
    }
}
