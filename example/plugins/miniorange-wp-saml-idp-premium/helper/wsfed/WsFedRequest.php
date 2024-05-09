<?php


namespace IDP\Helper\WSFED;

use IDP\Exception\MissingWaAttributeException;
use IDP\Exception\MissingWtRealmAttributeException;
use IDP\Helper\Constants\MoIDPConstants;
use IDP\Helper\Utilities\MoIDPUtility;
use IDP\Helper\Factory\RequestHandlerFactory;
class WsFedRequest implements RequestHandlerFactory
{
    private $clientRequestId;
    private $username;
    private $wreply;
    private $wres;
    private $wctx;
    private $wp;
    private $wct;
    private $wfed;
    private $wencoding;
    private $wfresh;
    private $wauth;
    private $wreq;
    private $whr;
    private $wreqptr;
    private $wa;
    private $wtrealm;
    private $requestType = MoIDPConstants::WS_FED;
    public function __construct($nr)
    {
        $this->clientRequestId = array_key_exists("\143\154\x69\x65\x6e\164\55\162\145\161\165\145\x73\164\55\x69\144", $nr) ? $nr["\143\154\151\x65\x6e\x74\x2d\162\145\161\165\x65\163\164\55\x69\144"] : NULL;
        $this->username = array_key_exists("\165\163\145\162\156\141\155\x65", $nr) ? $nr["\165\x73\145\162\x6e\x61\155\145"] : NULL;
        $this->wa = array_key_exists("\167\141", $nr) ? $nr["\167\x61"] : NULL;
        $this->wtrealm = array_key_exists("\167\x74\x72\x65\x61\x6c\x6d", $nr) ? $nr["\167\x74\x72\x65\141\154\155"] : NULL;
        $this->wctx = array_key_exists("\167\x63\x74\170", $nr) ? $nr["\167\143\x74\x78"] : NULL;
        $this->wct = array_key_exists("\x77\143\164\170", $nr) ? $nr["\x77\x63\x74\x78"] : NULL;
        if (!MoIDPUtility::isBlank($this->wa)) {
            goto PD;
        }
        throw new MissingWaAttributeException();
        PD:
        if (!MoIDPUtility::isBlank($this->wtrealm)) {
            goto P3;
        }
        throw new MissingWtRealmAttributeException();
        P3:
    }
    public function generateRequest()
    {
        return;
    }
    public function __toString()
    {
        $FZ = "\127\123\55\106\x45\104\x20\122\105\121\125\x45\123\124\40\x50\101\122\101\x4d\x53\x20\x5b";
        $FZ .= "\40\x77\141\x20\x3d\x20" . $this->wa;
        $FZ .= "\x2c\x20\167\x74\x72\x65\x61\154\155\x20\75\x20\x20" . $this->wtrealm;
        $FZ .= "\x2c\40\143\x6c\x69\145\156\164\122\x65\x71\165\x65\163\x74\111\x64\40\x3d\x20" . $this->clientRequestId;
        $FZ .= "\54\40\165\x73\x65\162\156\x61\155\x65\40\x3d\x20" . $this->username;
        $FZ .= "\x2c\x20\x77\x72\145\160\x6c\171\x20\x3d\x20" . $this->wreply;
        $FZ .= "\54\40\x77\162\145\x73\40\x3d\40" . $this->wres;
        $FZ .= "\x2c\x20\167\x63\164\170\x20\x3d\x20" . $this->wctx;
        $FZ .= "\54\x20\167\x70\40\x3d\x20" . $this->wp;
        $FZ .= "\54\x20\167\x63\164\40\x3d\40" . $this->wct;
        $FZ .= "\54\40\x77\146\x65\x64\40\x3d\40" . $this->wfed;
        $FZ .= "\54\x20\167\145\x6e\143\x6f\144\151\x6e\x67\40\x3d\40" . $this->wencoding;
        $FZ .= "\x2c\40\x77\146\162\145\x73\150\x20\x3d\x20" . $this->wfresh;
        $FZ .= "\54\x20\x77\141\165\x74\150\x20\x3d\40" . $this->wauth;
        $FZ .= "\x2c\40\167\162\145\x71\x20\75\40" . $this->wreq;
        $FZ .= "\x2c\x20\x77\150\162\x20\75\40" . $this->whr;
        $FZ .= "\54\x20\167\x72\x65\x71\160\164\162\40\75\40" . $this->wreqptr;
        $FZ .= "\x5d";
        return $FZ;
    }
    public function getClientRequestId()
    {
        return $this->clientRequestId;
    }
    public function setClientRequestId($aq)
    {
        $this->clientRequestId = $aq;
        return $this;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function setUsername($QQ)
    {
        $this->username = $QQ;
        return $this;
    }
    public function getWreply()
    {
        return $this->wreply;
    }
    public function setWreply($lc)
    {
        $this->wreply = $lc;
        return $this;
    }
    public function getWres()
    {
        return $this->wres;
    }
    public function setWres($TU)
    {
        $this->wres = $TU;
        return $this;
    }
    public function getWctx()
    {
        return $this->wctx;
    }
    public function setWctx($pZ)
    {
        $this->wctx = $pZ;
        return $this;
    }
    public function getWp()
    {
        return $this->wp;
    }
    public function setWp($wT)
    {
        $this->wp = $wT;
        return $this;
    }
    public function getWct()
    {
        return $this->wct;
    }
    public function setWct($Mv)
    {
        $this->wct = $Mv;
        return $this;
    }
    public function getWfed()
    {
        return $this->wfed;
    }
    public function setWfed($BB)
    {
        $this->wfed = $BB;
        return $this;
    }
    public function getWencoding()
    {
        return $this->wencoding;
    }
    public function setWencoding($VY)
    {
        $this->wencoding = $VY;
        return $this;
    }
    public function getWfresh()
    {
        return $this->wfresh;
    }
    public function setWfresh($ll)
    {
        $this->wfresh = $ll;
        return $this;
    }
    public function getWauth()
    {
        return $this->wauth;
    }
    public function setWauth($cz)
    {
        $this->wauth = $cz;
        return $this;
    }
    public function getWreq()
    {
        return $this->wreq;
    }
    public function setWreq($NZ)
    {
        $this->wreq = $NZ;
        return $this;
    }
    public function getWhr()
    {
        return $this->whr;
    }
    public function setWhr($Il)
    {
        $this->whr = $Il;
        return $this;
    }
    public function getWreqptr()
    {
        return $this->wreqptr;
    }
    public function setWreqptr($TH)
    {
        $this->wreqptr = $TH;
        return $this;
    }
    public function getWa()
    {
        return $this->wa;
    }
    public function setWa($G1)
    {
        $this->wa = $G1;
        return $this;
    }
    public function getWtrealm()
    {
        return $this->wtrealm;
    }
    public function setWtrealm($S_)
    {
        $this->wtrealm = $S_;
        return $this;
    }
    public function getRequestType()
    {
        return $this->requestType;
    }
    public function setRequestType($Ch)
    {
        $this->requestType = $Ch;
        return $this;
    }
}
