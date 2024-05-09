<?php


namespace IDP\Handler;

use IDP\Exception\InvalidEncryptionCertException;
use IDP\Exception\IssuerValueAlreadyInUseException;
use IDP\Exception\NoServiceProviderConfiguredException;
use IDP\Exception\SPNameAlreadyInUseException;
use IDP\Helper\Database\MoDbQueries;
use IDP\Helper\Utilities\MoIDPUtility;
class SPSettingsUtility extends BaseHandler
{
    public function checkIfValidServiceProvider($Lm, $uw = FALSE, $UV = NULL)
    {
        if (!($uw && array_key_exists($UV, $Lm) && MoIDPUtility::isBlank($Lm[$UV]) || MoIDPUtility::isBlank($Lm))) {
            goto Lc;
        }
        throw new NoServiceProviderConfiguredException();
        Lc:
    }
    public function checkIssuerAlreadyInUse($t3, $tW, $Zp)
    {
        global $dbIDPQueries;
        $Lm = $dbIDPQueries->get_sp_from_issuer($t3);
        if (!(!MoIDPUtility::isBlank($Lm) && !MoIDPUtility::isBlank($tW) && $Lm->id != $tW)) {
            goto jd;
        }
        throw new IssuerValueAlreadyInUseException($Lm);
        jd:
        if (!(!MoIDPUtility::isBlank($Lm) && !MoIDPUtility::isBlank($Zp) && $Zp != $Lm->mo_idp_sp_name)) {
            goto Rn;
        }
        throw new IssuerValueAlreadyInUseException($Lm);
        Rn:
    }
    public function checkNameAlreaydInUse($Zp, $tW = NULL)
    {
        global $dbIDPQueries;
        $Lm = $dbIDPQueries->get_sp_from_name($Zp);
        if (!(!MoIDPUtility::isBlank($Lm) && !MoIDPUtility::isBlank($tW) && $Lm->id != $tW)) {
            goto MV;
        }
        throw new SPNameAlreadyInUseException($Lm);
        MV:
        if (!(!MoIDPUtility::isBlank($Lm) && MoIDPUtility::isBlank($tW))) {
            goto vW;
        }
        throw new SPNameAlreadyInUseException($Lm);
        vW:
    }
    public function checkIfValidEncryptionCertProvided($Ig, $lI)
    {
        if (!(!MoIDPUtility::isBlank($Ig) && MoIDPUtility::isBlank($lI))) {
            goto SP;
        }
        throw new InvalidEncryptionCertException();
        SP:
    }
}
