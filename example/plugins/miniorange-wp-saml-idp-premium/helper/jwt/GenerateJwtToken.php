<?php


namespace IDP\Helper\JWT;

use IDP\Helper\Utilities\MoIDPUtility;
use IDP\Exception\InvalidSSOUserException;
use IDP\Helper\Factory\ResponseHandlerFactory;
class GenerateJwtToken implements ResponseHandlerFactory
{
    private $algo;
    private $sharedSecret;
    private $sp;
    private $sp_attr;
    function __construct($VI, $uj, $Lm, $LE, $km)
    {
        $this->algo = $VI;
        $this->sharedSecret = $uj;
        $this->sp = $Lm;
        $this->sp_attr = $LE;
        $this->current_user = is_null($km) ? wp_get_current_user() : get_user_by("\x6c\x6f\147\151\156", $km);
    }
    function generateResponse()
    {
        if (!MoIDPUtility::isBlank($this->current_user)) {
            goto xi;
        }
        throw new InvalidSSOUserException();
        xi:
        $ax = $this->getResponseParams();
        $DB = $this->createResponseElement($ax);
        $Zz = str_replace(["\x2b", "\x2f", "\x3d"], ["\55", "\137", ''], base64_encode(hash_hmac($this->algo, $DB, $this->sharedSecret, 1)));
        return $DB . "\56" . $Zz;
    }
    public function getResponseParams()
    {
        $ax = array();
        $Vs = time();
        $ax["\x63\x75\162\162\145\156\x74\x5f\164\x69\x6d\x65"] = str_replace("\x2b\x30\60\72\60\x30", "\132", gmdate("\x63", $Vs - 120));
        $ax["\151\141\x74"] = $Vs;
        $ax["\145\x78\160"] = $Vs + 300;
        $ax["\156\x62\146"] = $Vs;
        $ax["\152\x74\151"] = $ax["\x69\x61\164"] . $this->generateUniqueID(40);
        return $ax;
    }
    function generateUniqueID($B0)
    {
        return MoIDPUtility::generateRandomAlphanumericValue($B0);
    }
    function createResponseElement($ax)
    {
        $Oc = str_replace(["\x2b", "\57", "\x3d"], ["\x2d", "\137", ''], base64_encode($this->createHeader($ax)));
        $zK = str_replace(["\x2b", "\57", "\x3d"], ["\55", "\x5f", ''], base64_encode($this->createPayload($ax)));
        return $Oc . "\x2e" . $zK;
    }
    function createHeader()
    {
        $Oc = ["\164\171\160" => "\x4a\x57\x54", "\x61\154\147" => "\110\x53\62\65\66"];
        if (!MSI_DEBUG) {
            goto UA;
        }
        MoIDPUtility::mo_debug("\x48\145\141\x64\x65\162\x20\107\x65\x6e\145\162\x61\x74\x65\x64\40\x3a\40" . print_r($Oc, true));
        UA:
        return \json_encode($Oc);
    }
    public function createPayload($ax)
    {
        $zK = array("\151\x61\x74" => $ax["\151\141\164"], "\x6a\164\151" => $ax["\x6a\164\151"], "\145\x78\160" => $ax["\x65\170\x70"], "\x6e\x62\146" => $ax["\x6e\142\146"]);
        $Tq = array();
        foreach ($this->sp_attr as $uy) {
            $Tq = array_merge($Tq, $this->buildAttribute($ax, $uy->mo_sp_attr_name, $uy->mo_sp_attr_value, $uy->mo_attr_type));
            hr:
        }
        Q0:
        $zK = array_merge($zK, $Tq);
        if (!MSI_DEBUG) {
            goto Da;
        }
        MoIDPUtility::mo_debug("\120\x61\x79\x6c\157\x61\144\40\x47\145\x6e\145\x72\141\164\x65\144\72\40" . print_r($zK, true));
        Da:
        return \wp_json_encode($zK);
    }
    function buildAttribute($ax, $Nz, $oN, $p8)
    {
        if ($Nz === "\x67\x72\x6f\x75\160\x4d\141\x70\116\141\155\x65") {
            goto NL;
        }
        if ($p8 == 0) {
            goto lJ;
        }
        if (!($p8 == 2)) {
            goto SA;
        }
        $Ev = $oN;
        SA:
        goto eS;
        lJ:
        $Ev = $this->current_user->{$oN};
        eS:
        goto yU;
        NL:
        $Nz = $oN;
        $Ev = $this->current_user->roles;
        yU:
        if (!empty($Ev)) {
            goto EP;
        }
        $Ev = get_user_meta($this->current_user->ID, $oN, TRUE);
        EP:
        $Ev = apply_filters("\x67\145\156\145\x72\x61\164\x65\137\152\x77\164\137\x61\164\x74\x72\x69\142\x75\x74\145\x5f\x76\141\154\x75\145", $Ev, $this->current_user, $Nz, $oN);
        $gn = [$Nz => apply_filters("\x6d\x6f\x64\x69\146\x79\x5f\163\141\x6d\x6c\x5f\x61\164\164\162\x5f\166\x61\154\x75\x65", $Ev)];
        return $gn;
    }
}
