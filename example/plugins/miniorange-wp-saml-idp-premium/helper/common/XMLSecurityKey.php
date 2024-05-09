<?php


namespace RobRichards\XMLSecLibs;

use DOMElement;
use Exception;
class XMLSecurityKey
{
    const TRIPLEDES_CBC = "\x68\164\x74\x70\72\57\57\167\x77\x77\x2e\x77\63\56\157\162\147\x2f\x32\x30\60\x31\x2f\x30\64\x2f\x78\x6d\154\145\x6e\143\43\164\162\x69\x70\154\145\144\145\163\55\143\x62\143";
    const AES128_CBC = "\150\x74\164\x70\x3a\57\x2f\x77\x77\167\56\x77\x33\56\157\x72\x67\x2f\x32\x30\60\61\x2f\60\x34\57\170\x6d\154\145\156\x63\43\x61\x65\x73\61\x32\70\55\143\142\143";
    const AES192_CBC = "\150\164\164\x70\72\x2f\x2f\167\x77\x77\x2e\167\63\56\157\x72\147\x2f\62\x30\60\x31\x2f\60\64\x2f\x78\x6d\x6c\145\x6e\x63\x23\x61\x65\x73\61\71\62\x2d\x63\142\143";
    const AES256_CBC = "\150\x74\x74\160\x3a\57\x2f\167\167\167\56\x77\63\x2e\x6f\x72\147\x2f\x32\x30\x30\x31\57\60\x34\x2f\170\x6d\x6c\x65\156\x63\43\141\x65\x73\62\x35\66\x2d\x63\142\143";
    const AES128_GCM = "\150\164\164\160\x3a\57\57\167\x77\167\x2e\x77\x33\x2e\157\x72\x67\57\x32\x30\60\71\57\170\155\154\x65\156\143\x31\61\x23\141\x65\163\61\62\70\55\x67\x63\155";
    const AES192_GCM = "\150\x74\x74\x70\72\57\57\x77\x77\x77\x2e\167\x33\56\x6f\162\x67\x2f\62\60\60\x39\x2f\x78\155\154\145\156\x63\61\x31\x23\x61\x65\163\61\71\x32\x2d\147\x63\x6d";
    const AES256_GCM = "\x68\x74\x74\x70\x3a\57\x2f\167\167\x77\x2e\167\63\56\x6f\x72\x67\57\x32\60\x30\x39\x2f\170\x6d\154\145\156\143\x31\x31\43\141\145\163\x32\65\66\55\x67\143\x6d";
    const RSA_1_5 = "\150\x74\164\160\72\57\x2f\167\167\x77\x2e\x77\x33\x2e\x6f\x72\147\57\x32\60\x30\x31\57\x30\x34\x2f\x78\155\154\x65\156\x63\43\162\163\x61\x2d\61\x5f\65";
    const RSA_OAEP_MGF1P = "\x68\x74\164\160\x3a\57\x2f\x77\x77\167\56\x77\63\56\157\x72\x67\x2f\x32\x30\60\x31\57\60\64\57\x78\155\154\x65\x6e\143\43\x72\x73\x61\55\x6f\x61\x65\x70\x2d\155\147\146\x31\160";
    const RSA_OAEP = "\x68\164\x74\x70\72\57\57\167\167\x77\56\x77\63\56\x6f\162\x67\57\x32\x30\60\71\57\170\155\x6c\x65\x6e\x63\61\x31\43\162\x73\x61\x2d\157\141\x65\160";
    const DSA_SHA1 = "\x68\x74\164\x70\72\57\57\167\x77\x77\56\x77\63\56\157\162\x67\x2f\62\x30\60\x30\57\x30\x39\x2f\x78\x6d\154\x64\x73\x69\x67\43\x64\x73\x61\55\x73\x68\141\x31";
    const RSA_SHA1 = "\x68\x74\x74\x70\72\57\x2f\167\x77\167\x2e\167\x33\56\157\162\147\x2f\x32\60\60\x30\57\x30\x39\x2f\170\x6d\x6c\144\x73\x69\x67\x23\x72\x73\x61\x2d\163\x68\x61\61";
    const RSA_SHA256 = "\150\x74\x74\x70\72\57\57\x77\167\x77\56\167\63\x2e\x6f\162\147\57\62\x30\60\x31\x2f\x30\x34\57\x78\x6d\x6c\144\x73\x69\x67\55\x6d\157\162\145\x23\162\x73\141\x2d\x73\150\141\62\65\x36";
    const RSA_SHA384 = "\150\164\x74\x70\72\57\x2f\x77\x77\x77\x2e\x77\x33\56\157\x72\x67\x2f\62\x30\x30\61\x2f\x30\64\57\170\x6d\154\x64\163\x69\x67\55\x6d\x6f\162\x65\x23\x72\163\x61\55\163\x68\x61\63\70\64";
    const RSA_SHA512 = "\x68\x74\164\160\x3a\x2f\57\x77\x77\167\x2e\167\x33\x2e\157\162\147\x2f\62\60\60\x31\57\60\64\57\170\155\154\x64\x73\151\147\55\x6d\157\162\x65\43\162\163\x61\x2d\x73\x68\141\x35\x31\x32";
    const HMAC_SHA1 = "\150\164\x74\160\72\x2f\57\x77\x77\x77\56\167\63\56\157\162\147\57\62\x30\60\60\x2f\x30\x39\57\x78\x6d\x6c\144\163\x69\x67\x23\x68\x6d\x61\143\55\x73\150\141\x31";
    const AUTHTAG_LENGTH = 16;
    private $cryptParams = array();
    public $type = 0;
    public $key = null;
    public $passphrase = '';
    public $iv = null;
    public $name = null;
    public $keyChain = null;
    public $isEncrypted = false;
    public $encryptedCtx = null;
    public $guid = null;
    private $x509Certificate = null;
    private $X509Thumbprint = null;
    public function __construct($p8, $S3 = null)
    {
        switch ($p8) {
            case self::TRIPLEDES_CBC:
                $this->cryptParams["\154\151\142\162\141\x72\x79"] = "\157\x70\145\156\x73\163\x6c";
                $this->cryptParams["\x63\x69\x70\150\x65\x72"] = "\144\x65\163\x2d\145\x64\x65\x33\55\143\x62\x63";
                $this->cryptParams["\164\171\x70\145"] = "\163\x79\x6d\155\x65\x74\x72\x69\x63";
                $this->cryptParams["\155\x65\164\150\x6f\x64"] = "\150\164\x74\160\x3a\x2f\57\167\x77\167\x2e\x77\63\x2e\x6f\162\x67\57\62\x30\x30\61\57\60\x34\57\170\x6d\154\145\x6e\x63\x23\164\162\x69\x70\154\x65\144\x65\x73\55\x63\142\x63";
                $this->cryptParams["\x6b\145\x79\x73\x69\x7a\x65"] = 24;
                $this->cryptParams["\x62\154\157\143\x6b\x73\x69\x7a\x65"] = 8;
                goto yv;
            case self::AES128_CBC:
                $this->cryptParams["\154\x69\142\x72\141\162\171"] = "\157\160\145\x6e\163\x73\154";
                $this->cryptParams["\x63\x69\x70\x68\145\x72"] = "\141\145\163\x2d\x31\62\x38\55\x63\142\143";
                $this->cryptParams["\x74\x79\x70\145"] = "\x73\171\155\155\145\x74\162\x69\143";
                $this->cryptParams["\x6d\145\164\150\157\x64"] = "\x68\164\x74\160\x3a\57\x2f\x77\167\x77\56\x77\x33\x2e\157\162\x67\x2f\x32\60\x30\61\57\x30\64\57\x78\x6d\154\x65\156\x63\x23\x61\x65\163\x31\62\70\55\143\x62\x63";
                $this->cryptParams["\153\x65\x79\x73\151\x7a\x65"] = 16;
                $this->cryptParams["\142\x6c\157\143\x6b\x73\151\172\145"] = 16;
                goto yv;
            case self::AES192_CBC:
                $this->cryptParams["\x6c\151\x62\162\141\x72\x79"] = "\x6f\x70\145\156\163\x73\154";
                $this->cryptParams["\143\151\160\x68\145\x72"] = "\x61\145\163\55\61\x39\x32\55\143\x62\143";
                $this->cryptParams["\x74\x79\160\x65"] = "\163\171\155\x6d\x65\164\x72\x69\143";
                $this->cryptParams["\155\x65\x74\150\x6f\x64"] = "\150\x74\164\160\x3a\x2f\57\x77\167\x77\x2e\x77\63\x2e\157\162\x67\x2f\62\x30\60\x31\x2f\60\x34\57\x78\x6d\154\145\156\x63\43\141\145\x73\x31\x39\62\55\143\142\143";
                $this->cryptParams["\153\x65\x79\x73\151\x7a\145"] = 24;
                $this->cryptParams["\x62\x6c\157\x63\x6b\x73\x69\172\145"] = 16;
                goto yv;
            case self::AES256_CBC:
                $this->cryptParams["\154\x69\142\x72\141\x72\171"] = "\x6f\160\x65\x6e\x73\x73\154";
                $this->cryptParams["\143\x69\160\150\145\162"] = "\141\x65\163\x2d\62\x35\66\x2d\143\142\143";
                $this->cryptParams["\164\x79\160\x65"] = "\163\x79\x6d\x6d\145\x74\x72\x69\143";
                $this->cryptParams["\x6d\145\x74\x68\157\x64"] = "\x68\164\164\x70\x3a\57\57\x77\167\167\x2e\167\x33\x2e\157\162\x67\x2f\62\x30\x30\61\57\x30\x34\x2f\170\x6d\x6c\145\156\x63\x23\141\145\x73\62\x35\66\55\143\142\143";
                $this->cryptParams["\x6b\x65\x79\163\x69\172\145"] = 32;
                $this->cryptParams["\142\154\x6f\x63\x6b\163\151\x7a\145"] = 16;
                goto yv;
            case self::AES128_GCM:
                $this->cryptParams["\x6c\x69\142\x72\x61\x72\x79"] = "\x6f\160\145\156\x73\163\154";
                $this->cryptParams["\x63\151\x70\x68\145\162"] = "\141\x65\163\55\61\62\70\55\147\x63\155";
                $this->cryptParams["\164\171\160\x65"] = "\x73\x79\x6d\x6d\145\164\162\x69\x63";
                $this->cryptParams["\155\145\164\150\157\x64"] = "\150\x74\164\x70\72\57\57\x77\167\167\56\167\63\x2e\x6f\x72\147\x2f\62\x30\60\71\57\170\155\x6c\x65\x6e\143\61\61\x23\x61\x65\x73\61\62\x38\x2d\147\143\155";
                $this->cryptParams["\153\x65\171\163\151\172\x65"] = 16;
                $this->cryptParams["\142\x6c\x6f\143\x6b\163\x69\172\145"] = 16;
                goto yv;
            case self::AES192_GCM:
                $this->cryptParams["\154\x69\142\x72\141\x72\171"] = "\x6f\160\145\x6e\163\163\154";
                $this->cryptParams["\x63\x69\160\x68\145\x72"] = "\141\x65\x73\x2d\x31\71\62\x2d\x67\143\155";
                $this->cryptParams["\164\x79\160\145"] = "\x73\171\155\x6d\145\x74\162\151\143";
                $this->cryptParams["\x6d\145\164\x68\x6f\144"] = "\150\164\164\160\x3a\x2f\57\167\x77\167\56\167\63\56\157\162\147\x2f\62\x30\60\x39\57\170\x6d\x6c\145\x6e\x63\61\61\x23\x61\145\x73\x31\x39\x32\55\147\143\155";
                $this->cryptParams["\x6b\145\x79\163\151\x7a\145"] = 24;
                $this->cryptParams["\x62\x6c\x6f\x63\153\163\x69\172\145"] = 16;
                goto yv;
            case self::AES256_GCM:
                $this->cryptParams["\x6c\x69\142\x72\x61\162\x79"] = "\157\x70\145\x6e\x73\163\154";
                $this->cryptParams["\143\151\x70\x68\x65\162"] = "\x61\145\x73\55\62\65\x36\55\147\143\155";
                $this->cryptParams["\164\x79\160\145"] = "\163\x79\x6d\155\x65\164\x72\x69\143";
                $this->cryptParams["\155\145\164\x68\157\144"] = "\x68\x74\x74\x70\x3a\57\x2f\x77\167\x77\x2e\x77\x33\56\x6f\162\147\x2f\62\x30\x30\71\x2f\170\155\x6c\x65\x6e\x63\61\61\43\x61\145\163\62\x35\x36\55\147\143\155";
                $this->cryptParams["\x6b\x65\171\x73\151\172\x65"] = 32;
                $this->cryptParams["\x62\154\x6f\x63\153\x73\151\x7a\x65"] = 16;
                goto yv;
            case self::RSA_1_5:
                $this->cryptParams["\x6c\151\142\162\141\x72\x79"] = "\157\x70\x65\x6e\x73\163\154";
                $this->cryptParams["\x70\x61\x64\144\x69\156\x67"] = OPENSSL_PKCS1_PADDING;
                $this->cryptParams["\155\x65\164\150\157\144"] = "\150\164\x74\160\72\57\x2f\x77\x77\x77\56\x77\63\x2e\x6f\162\147\57\x32\x30\60\x31\57\60\x34\x2f\x78\x6d\154\145\156\143\43\x72\163\141\x2d\x31\x5f\65";
                if (!(is_array($S3) && !empty($S3["\x74\171\160\x65"]))) {
                    goto SS;
                }
                if (!($S3["\164\171\160\x65"] == "\x70\x75\142\x6c\151\x63" || $S3["\x74\171\x70\145"] == "\160\162\151\166\141\x74\145")) {
                    goto qN;
                }
                $this->cryptParams["\x74\171\160\x65"] = $S3["\164\x79\x70\x65"];
                goto yv;
                qN:
                SS:
                throw new Exception("\x43\x65\162\164\x69\146\x69\143\141\x74\x65\x20\42\164\x79\160\145\x22\x20\50\160\x72\151\x76\x61\x74\145\x2f\160\165\x62\154\151\x63\51\40\x6d\165\163\x74\x20\x62\145\40\x70\x61\x73\163\145\x64\x20\x76\x69\141\40\160\141\162\141\x6d\145\x74\x65\x72\x73");
            case self::RSA_OAEP_MGF1P:
                $this->cryptParams["\154\x69\x62\x72\x61\162\x79"] = "\157\x70\145\x6e\163\x73\x6c";
                $this->cryptParams["\x70\141\x64\144\x69\x6e\147"] = OPENSSL_PKCS1_OAEP_PADDING;
                $this->cryptParams["\x6d\x65\x74\150\157\144"] = "\x68\164\x74\x70\72\x2f\57\167\167\167\x2e\167\x33\x2e\157\x72\147\x2f\x32\x30\x30\61\x2f\x30\x34\x2f\170\155\154\145\x6e\143\x23\x72\163\x61\55\x6f\141\x65\160\x2d\155\x67\146\x31\160";
                $this->cryptParams["\x68\141\x73\150"] = null;
                if (!(is_array($S3) && !empty($S3["\x74\171\160\145"]))) {
                    goto M3;
                }
                if (!($S3["\x74\171\160\x65"] == "\x70\x75\x62\x6c\x69\x63" || $S3["\x74\x79\160\145"] == "\160\162\151\x76\x61\164\x65")) {
                    goto Jp;
                }
                $this->cryptParams["\164\171\x70\x65"] = $S3["\164\171\160\145"];
                goto yv;
                Jp:
                M3:
                throw new Exception("\x43\x65\162\x74\x69\x66\x69\143\141\x74\145\40\42\x74\x79\160\x65\42\40\50\160\162\151\166\x61\x74\x65\57\x70\165\142\x6c\151\x63\x29\40\x6d\x75\x73\164\x20\x62\145\40\x70\141\x73\163\x65\144\40\166\151\x61\x20\x70\x61\x72\141\155\x65\x74\x65\162\x73");
            case self::RSA_OAEP:
                $this->cryptParams["\154\151\142\162\141\162\171"] = "\x6f\x70\145\x6e\163\x73\x6c";
                $this->cryptParams["\160\141\x64\x64\151\156\147"] = OPENSSL_PKCS1_OAEP_PADDING;
                $this->cryptParams["\x6d\x65\164\x68\157\144"] = "\x68\x74\x74\160\x3a\57\x2f\167\167\167\56\167\x33\x2e\x6f\162\x67\57\x32\x30\x30\x39\57\170\155\154\145\156\x63\x31\x31\x23\162\163\141\x2d\x6f\141\x65\x70";
                $this->cryptParams["\150\141\x73\x68"] = "\150\164\x74\160\x3a\57\57\x77\167\167\x2e\167\x33\56\x6f\162\147\x2f\x32\x30\60\71\57\170\155\x6c\x65\156\x63\x31\61\x23\155\147\x66\x31\163\x68\141\61";
                if (!(is_array($S3) && !empty($S3["\164\x79\160\145"]))) {
                    goto v5;
                }
                if (!($S3["\x74\171\x70\x65"] == "\160\x75\x62\154\x69\143" || $S3["\x74\171\160\x65"] == "\160\x72\x69\166\141\164\145")) {
                    goto bt;
                }
                $this->cryptParams["\x74\x79\160\x65"] = $S3["\164\171\160\x65"];
                goto yv;
                bt:
                v5:
                throw new Exception("\103\x65\x72\x74\151\146\x69\x63\x61\x74\145\x20\42\164\171\x70\145\42\40\x28\160\162\151\x76\141\164\x65\57\160\165\142\154\151\x63\51\40\x6d\x75\163\x74\40\142\x65\40\160\x61\163\x73\145\144\40\166\x69\141\x20\x70\x61\x72\x61\155\x65\164\145\162\x73");
            case self::RSA_SHA1:
                $this->cryptParams["\x6c\x69\x62\x72\x61\162\x79"] = "\157\160\x65\156\163\163\154";
                $this->cryptParams["\155\145\x74\x68\x6f\144"] = "\150\x74\164\x70\72\57\57\x77\x77\x77\x2e\x77\63\56\157\x72\147\x2f\x32\60\x30\x30\x2f\x30\71\57\x78\155\154\144\163\x69\x67\x23\162\x73\141\55\163\150\141\61";
                $this->cryptParams["\160\141\144\x64\x69\x6e\147"] = OPENSSL_PKCS1_PADDING;
                if (!(is_array($S3) && !empty($S3["\164\171\160\x65"]))) {
                    goto OV;
                }
                if (!($S3["\164\171\160\x65"] == "\x70\x75\x62\x6c\151\x63" || $S3["\164\171\160\x65"] == "\x70\162\151\x76\x61\164\x65")) {
                    goto bh;
                }
                $this->cryptParams["\164\171\160\x65"] = $S3["\164\171\x70\x65"];
                goto yv;
                bh:
                OV:
                throw new Exception("\103\145\162\164\x69\x66\151\143\141\164\145\x20\x22\x74\x79\x70\x65\42\x20\x28\160\162\x69\166\141\164\145\x2f\160\165\142\x6c\x69\143\x29\x20\155\x75\x73\x74\x20\x62\x65\40\x70\141\163\163\145\x64\40\x76\151\141\40\160\x61\162\141\155\145\x74\145\162\163");
            case self::RSA_SHA256:
                $this->cryptParams["\154\151\142\162\x61\x72\x79"] = "\x6f\160\x65\x6e\163\x73\154";
                $this->cryptParams["\x6d\145\x74\x68\x6f\144"] = "\150\164\164\x70\x3a\57\x2f\x77\167\x77\56\167\x33\x2e\x6f\162\147\x2f\62\60\x30\x31\x2f\60\64\57\170\155\x6c\x64\x73\151\147\55\x6d\x6f\x72\x65\x23\x72\x73\141\x2d\x73\x68\141\62\x35\66";
                $this->cryptParams["\160\141\144\144\151\x6e\147"] = OPENSSL_PKCS1_PADDING;
                $this->cryptParams["\x64\151\x67\145\163\164"] = "\123\x48\101\62\65\66";
                if (!(is_array($S3) && !empty($S3["\x74\x79\160\145"]))) {
                    goto A9;
                }
                if (!($S3["\x74\x79\160\x65"] == "\x70\165\142\154\x69\143" || $S3["\x74\x79\x70\x65"] == "\160\x72\x69\166\x61\164\x65")) {
                    goto oG;
                }
                $this->cryptParams["\x74\171\160\x65"] = $S3["\164\x79\160\145"];
                goto yv;
                oG:
                A9:
                throw new Exception("\x43\x65\162\x74\x69\x66\x69\143\x61\164\145\x20\42\164\x79\x70\145\x22\x20\x28\x70\x72\x69\x76\x61\164\x65\57\x70\165\x62\x6c\151\x63\x29\x20\155\x75\163\x74\40\142\x65\x20\x70\141\163\163\x65\x64\40\166\x69\x61\x20\160\x61\162\141\x6d\145\164\x65\x72\x73");
            case self::RSA_SHA384:
                $this->cryptParams["\x6c\151\x62\x72\141\x72\171"] = "\157\x70\145\x6e\x73\163\x6c";
                $this->cryptParams["\x6d\x65\164\x68\157\x64"] = "\x68\164\x74\x70\72\57\x2f\167\167\x77\x2e\x77\63\56\x6f\162\x67\x2f\x32\60\x30\x31\57\x30\64\x2f\170\x6d\x6c\144\x73\x69\x67\x2d\155\157\162\145\x23\162\x73\141\55\x73\150\x61\63\70\x34";
                $this->cryptParams["\160\141\x64\144\x69\156\x67"] = OPENSSL_PKCS1_PADDING;
                $this->cryptParams["\x64\151\x67\145\x73\x74"] = "\123\x48\101\63\70\64";
                if (!(is_array($S3) && !empty($S3["\164\171\x70\145"]))) {
                    goto ln;
                }
                if (!($S3["\x74\x79\x70\145"] == "\160\165\x62\154\151\x63" || $S3["\164\x79\160\x65"] == "\160\162\151\x76\x61\x74\145")) {
                    goto Va;
                }
                $this->cryptParams["\x74\x79\x70\145"] = $S3["\x74\171\x70\145"];
                goto yv;
                Va:
                ln:
                throw new Exception("\103\x65\162\164\151\146\151\x63\141\x74\x65\x20\x22\x74\171\160\x65\42\40\50\x70\162\151\166\141\x74\x65\x2f\x70\x75\x62\x6c\151\143\x29\40\155\165\163\164\40\142\x65\x20\160\x61\163\x73\x65\x64\40\x76\x69\141\x20\160\x61\x72\141\155\145\164\x65\x72\163");
            case self::RSA_SHA512:
                $this->cryptParams["\x6c\x69\x62\x72\x61\162\x79"] = "\x6f\x70\145\x6e\x73\163\154";
                $this->cryptParams["\x6d\x65\x74\x68\157\144"] = "\150\164\164\x70\x3a\57\x2f\167\x77\167\x2e\167\x33\x2e\x6f\x72\x67\57\x32\60\x30\x31\x2f\x30\x34\57\x78\x6d\154\144\x73\151\147\x2d\x6d\157\162\145\x23\x72\163\141\55\163\x68\x61\65\x31\62";
                $this->cryptParams["\160\141\x64\144\x69\x6e\147"] = OPENSSL_PKCS1_PADDING;
                $this->cryptParams["\x64\x69\147\x65\163\x74"] = "\123\x48\x41\x35\x31\62";
                if (!(is_array($S3) && !empty($S3["\x74\x79\x70\145"]))) {
                    goto Qn;
                }
                if (!($S3["\x74\x79\160\145"] == "\x70\165\x62\154\x69\x63" || $S3["\164\171\160\145"] == "\x70\x72\x69\166\141\x74\145")) {
                    goto Sj;
                }
                $this->cryptParams["\164\x79\160\145"] = $S3["\x74\x79\160\145"];
                goto yv;
                Sj:
                Qn:
                throw new Exception("\x43\x65\162\164\x69\146\151\x63\x61\x74\145\40\42\164\171\x70\x65\42\40\x28\x70\162\151\x76\x61\x74\145\57\160\165\142\154\x69\x63\51\40\155\x75\163\x74\x20\142\x65\40\x70\141\x73\x73\145\144\40\166\151\x61\40\x70\141\162\141\x6d\x65\x74\145\x72\163");
            case self::HMAC_SHA1:
                $this->cryptParams["\x6c\x69\142\x72\x61\x72\171"] = $p8;
                $this->cryptParams["\155\145\x74\x68\157\144"] = "\150\x74\164\160\72\57\57\x77\x77\167\56\x77\63\56\157\x72\147\57\x32\x30\60\60\x2f\60\71\57\x78\x6d\x6c\144\x73\x69\147\x23\150\155\x61\143\x2d\x73\x68\141\61";
                goto yv;
            default:
                throw new Exception("\x49\x6e\166\141\x6c\151\144\40\x4b\x65\171\x20\x54\x79\x70\145");
        }
        oj:
        yv:
        $this->type = $p8;
    }
    public function getSymmetricKeySize()
    {
        if (isset($this->cryptParams["\x6b\145\171\x73\151\x7a\145"])) {
            goto yC;
        }
        return null;
        yC:
        return $this->cryptParams["\153\x65\171\x73\x69\172\x65"];
    }
    public function generateSessionKey()
    {
        if (isset($this->cryptParams["\x6b\145\171\x73\151\x7a\145"])) {
            goto D3;
        }
        throw new Exception("\125\x6e\x6b\156\x6f\167\x6e\40\x6b\x65\171\x20\x73\x69\x7a\x65\x20\146\x6f\x72\x20\x74\171\x70\145\40\x22" . $this->type . "\42\x2e");
        D3:
        $zV = $this->cryptParams["\153\x65\x79\163\151\x7a\145"];
        $UV = openssl_random_pseudo_bytes($zV);
        if (!($this->type === self::TRIPLEDES_CBC)) {
            goto b8;
        }
        $Uy = 0;
        ib:
        if (!($Uy < strlen($UV))) {
            goto ZB;
        }
        $Ms = ord($UV[$Uy]) & 0xfe;
        $lB = 1;
        $Lb = 1;
        pZ:
        if (!($Lb < 8)) {
            goto dQ;
        }
        $lB ^= $Ms >> $Lb & 1;
        IG:
        $Lb++;
        goto pZ;
        dQ:
        $Ms |= $lB;
        $UV[$Uy] = chr($Ms);
        yW:
        $Uy++;
        goto ib;
        ZB:
        b8:
        $this->key = $UV;
        return $UV;
    }
    public static function getRawThumbprint($lI)
    {
        $mr = explode("\xa", $lI);
        $jX = '';
        $yA = false;
        foreach ($mr as $m2) {
            if (!$yA) {
                goto wh;
            }
            if (!(strncmp($m2, "\x2d\55\x2d\x2d\x2d\x45\116\x44\40\103\105\122\124\111\106\111\x43\101\x54\105", 20) == 0)) {
                goto xt;
            }
            goto kn;
            xt:
            $jX .= trim($m2);
            goto uQ;
            wh:
            if (!(strncmp($m2, "\55\x2d\55\x2d\55\102\x45\x47\x49\116\x20\x43\105\122\124\x49\x46\x49\103\x41\x54\105", 22) == 0)) {
                goto nb;
            }
            $yA = true;
            nb:
            uQ:
            kw:
        }
        kn:
        if (empty($jX)) {
            goto aZ;
        }
        return strtolower(sha1(base64_decode($jX)));
        aZ:
        return null;
    }
    public function loadKey($UV, $wI = false, $zP = false)
    {
        if ($wI) {
            goto Lp;
        }
        $this->key = $UV;
        goto fW;
        Lp:
        $this->key = file_get_contents($UV);
        fW:
        if ($zP) {
            goto Cu;
        }
        $this->x509Certificate = null;
        goto xL;
        Cu:
        $this->key = openssl_x509_read($this->key);
        openssl_x509_export($this->key, $St);
        $this->x509Certificate = $St;
        $this->key = $St;
        xL:
        if (!($this->cryptParams["\x6c\151\142\162\x61\x72\x79"] == "\157\160\x65\156\x73\x73\x6c")) {
            goto du;
        }
        switch ($this->cryptParams["\x74\x79\x70\145"]) {
            case "\160\x75\142\154\151\x63":
                if (!$zP) {
                    goto Dl;
                }
                $this->X509Thumbprint = self::getRawThumbprint($this->key);
                Dl:
                $this->key = openssl_get_publickey($this->key);
                if ($this->key) {
                    goto Yx;
                }
                throw new Exception("\125\156\141\x62\x6c\x65\40\164\x6f\x20\145\170\x74\162\141\x63\164\x20\x70\x75\x62\x6c\x69\143\x20\153\x65\171");
                Yx:
                goto s8;
            case "\160\x72\151\x76\x61\164\x65":
                $this->key = openssl_get_privatekey($this->key, $this->passphrase);
                goto s8;
            case "\x73\171\x6d\155\145\x74\x72\x69\x63":
                if (!(strlen($this->key) < $this->cryptParams["\153\145\x79\163\x69\x7a\x65"])) {
                    goto Um;
                }
                throw new Exception("\x4b\145\x79\x20\x6d\x75\163\x74\40\143\x6f\156\164\x61\151\156\40\x61\164\40\x6c\x65\x61\163\164\x20" . $this->cryptParams["\153\145\x79\x73\151\x7a\145"] . "\40\143\150\141\x72\x61\143\164\145\x72\163\x20\146\x6f\162\40\x74\150\x69\x73\x20\143\x69\x70\x68\145\x72\54\40\143\157\156\164\141\x69\156\x73\x20" . strlen($this->key));
                Um:
                goto s8;
            default:
                throw new Exception("\x55\x6e\153\156\x6f\x77\156\x20\x74\x79\x70\x65");
        }
        J6:
        s8:
        du:
    }
    private function padISO10126($jX, $B4)
    {
        if (!($B4 > 256)) {
            goto Qf;
        }
        throw new Exception("\x42\x6c\x6f\x63\153\40\x73\151\x7a\x65\x20\150\x69\x67\150\145\x72\40\x74\x68\x61\156\40\x32\x35\x36\x20\x6e\157\x74\x20\x61\x6c\154\157\167\x65\144");
        Qf:
        $wO = $B4 - strlen($jX) % $B4;
        $lW = chr($wO);
        return $jX . str_repeat($lW, $wO);
    }
    private function unpadISO10126($jX)
    {
        $wO = substr($jX, -1);
        $Zw = ord($wO);
        return substr($jX, 0, -$Zw);
    }
    private function encryptSymmetric($jX)
    {
        $this->iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->cryptParams["\x63\x69\x70\150\145\162"]));
        $ID = null;
        if (in_array($this->cryptParams["\x63\151\x70\150\145\162"], ["\x61\145\x73\55\61\x32\70\55\x67\143\155", "\141\x65\x73\55\61\71\62\55\x67\x63\x6d", "\x61\145\163\55\62\65\x36\x2d\x67\x63\155"])) {
            goto Xn;
        }
        $jX = $this->padISO10126($jX, $this->cryptParams["\x62\x6c\x6f\143\x6b\x73\x69\x7a\x65"]);
        $tP = openssl_encrypt($jX, $this->cryptParams["\x63\x69\x70\x68\145\162"], $this->key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, $this->iv);
        goto CP;
        Xn:
        if (!(version_compare(PHP_VERSION, "\x37\x2e\x31\56\x30") < 0)) {
            goto d3;
        }
        throw new Exception("\x50\110\120\40\x37\x2e\61\56\60\40\151\163\x20\x72\x65\161\165\x69\162\x65\x64\40\164\157\x20\x75\163\x65\40\x41\x45\123\x20\107\103\x4d\x20\141\154\147\157\162\x69\x74\x68\155\163");
        d3:
        $ID = openssl_random_pseudo_bytes(self::AUTHTAG_LENGTH);
        $tP = openssl_encrypt($jX, $this->cryptParams["\x63\x69\160\x68\145\x72"], $this->key, OPENSSL_RAW_DATA, $this->iv, $ID);
        CP:
        if (!(false === $tP)) {
            goto uF;
        }
        throw new Exception("\106\x61\x69\x6c\x75\162\145\40\x65\x6e\x63\162\x79\160\x74\151\156\147\40\104\141\x74\x61\40\50\x6f\160\145\156\x73\163\154\x20\x73\171\x6d\155\145\x74\x72\x69\143\x29\40\x2d\40" . openssl_error_string());
        uF:
        return $this->iv . $tP . $ID;
    }
    private function decryptSymmetric($jX)
    {
        $Vg = openssl_cipher_iv_length($this->cryptParams["\143\151\160\150\x65\162"]);
        $this->iv = substr($jX, 0, $Vg);
        $jX = substr($jX, $Vg);
        $ID = null;
        if (in_array($this->cryptParams["\143\x69\160\x68\145\x72"], ["\x61\x65\163\55\x31\x32\70\x2d\x67\143\x6d", "\x61\145\x73\55\x31\x39\62\x2d\147\x63\155", "\x61\x65\x73\x2d\x32\x35\x36\55\x67\143\155"])) {
            goto QI;
        }
        $bL = openssl_decrypt($jX, $this->cryptParams["\143\151\x70\x68\145\162"], $this->key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, $this->iv);
        goto OB;
        QI:
        if (!(version_compare(PHP_VERSION, "\x37\56\x31\x2e\60") < 0)) {
            goto PA;
        }
        throw new Exception("\x50\x48\x50\x20\x37\56\x31\56\x30\x20\x69\163\40\x72\145\161\x75\x69\x72\145\144\x20\164\157\x20\x75\163\x65\x20\x41\x45\123\x20\x47\x43\x4d\40\x61\154\x67\157\162\151\x74\x68\155\x73");
        PA:
        $g2 = 0 - self::AUTHTAG_LENGTH;
        $ID = substr($jX, $g2);
        $jX = substr($jX, 0, $g2);
        $bL = openssl_decrypt($jX, $this->cryptParams["\143\151\160\150\x65\x72"], $this->key, OPENSSL_RAW_DATA, $this->iv, $ID);
        OB:
        if (!(false === $bL)) {
            goto u4;
        }
        throw new Exception("\106\141\x69\154\165\162\x65\x20\x64\x65\x63\162\171\x70\164\151\x6e\147\x20\x44\141\x74\x61\40\50\x6f\x70\x65\156\163\163\x6c\40\163\171\155\155\x65\x74\162\x69\143\51\40\55\40" . openssl_error_string());
        u4:
        return null !== $ID ? $bL : $this->unpadISO10126($bL);
    }
    private function encryptPublic($jX)
    {
        if (openssl_public_encrypt($jX, $tP, $this->key, $this->cryptParams["\x70\x61\x64\144\151\x6e\147"])) {
            goto EL;
        }
        throw new Exception("\x46\x61\151\154\x75\x72\145\x20\145\156\143\x72\x79\x70\164\151\156\147\40\104\x61\x74\x61\40\x28\157\160\145\156\163\x73\x6c\x20\x70\x75\142\154\x69\143\51\x20\55\x20" . openssl_error_string());
        EL:
        return $tP;
    }
    private function decryptPublic($jX)
    {
        if (openssl_public_decrypt($jX, $bL, $this->key, $this->cryptParams["\160\x61\x64\x64\x69\156\x67"])) {
            goto jq;
        }
        throw new Exception("\x46\x61\151\x6c\165\x72\x65\x20\x64\145\143\162\171\160\164\151\x6e\x67\40\104\x61\164\x61\x20\x28\157\x70\145\156\163\163\x6c\x20\x70\165\x62\x6c\151\x63\51\x20\x2d\x20" . openssl_error_string());
        jq:
        return $bL;
    }
    private function encryptPrivate($jX)
    {
        if (openssl_private_encrypt($jX, $tP, $this->key, $this->cryptParams["\160\x61\144\x64\151\x6e\x67"])) {
            goto qe;
        }
        throw new Exception("\106\141\x69\154\165\x72\145\40\x65\x6e\x63\x72\171\x70\164\151\x6e\147\x20\104\x61\x74\x61\40\50\x6f\x70\x65\x6e\163\x73\154\40\x70\162\151\166\x61\164\145\x29\40\x2d\x20" . openssl_error_string());
        qe:
        return $tP;
    }
    private function decryptPrivate($jX)
    {
        if (openssl_private_decrypt($jX, $bL, $this->key, $this->cryptParams["\160\141\144\x64\x69\x6e\x67"])) {
            goto NC;
        }
        throw new Exception("\x46\141\x69\x6c\x75\x72\145\40\x64\x65\x63\162\171\x70\164\x69\x6e\147\40\x44\x61\164\141\x20\x28\x6f\160\x65\x6e\x73\x73\154\x20\160\162\151\x76\x61\x74\x65\51\x20\x2d\40" . openssl_error_string());
        NC:
        return $bL;
    }
    private function signOpenSSL($jX)
    {
        $VI = OPENSSL_ALGO_SHA1;
        if (empty($this->cryptParams["\x64\x69\147\x65\x73\x74"])) {
            goto BR;
        }
        $VI = $this->cryptParams["\x64\151\147\145\163\164"];
        BR:
        if (openssl_sign($jX, $N1, $this->key, $VI)) {
            goto Xo;
        }
        throw new Exception("\106\141\x69\154\x75\162\x65\x20\x53\x69\x67\156\151\x6e\x67\x20\104\x61\x74\x61\x3a\40" . openssl_error_string() . "\x20\55\x20" . $VI);
        Xo:
        return $N1;
    }
    private function verifyOpenSSL($jX, $N1)
    {
        $VI = OPENSSL_ALGO_SHA1;
        if (empty($this->cryptParams["\144\151\147\x65\163\x74"])) {
            goto fG;
        }
        $VI = $this->cryptParams["\x64\151\147\145\x73\164"];
        fG:
        return openssl_verify($jX, $N1, $this->key, $VI);
    }
    public function encryptData($jX)
    {
        if (!($this->cryptParams["\x6c\151\x62\162\141\162\x79"] === "\x6f\160\145\156\163\163\x6c")) {
            goto Mk;
        }
        switch ($this->cryptParams["\x74\x79\x70\145"]) {
            case "\163\x79\155\155\145\164\x72\151\143":
                return $this->encryptSymmetric($jX);
            case "\x70\165\x62\154\151\143":
                return $this->encryptPublic($jX);
            case "\x70\x72\x69\166\x61\164\145":
                return $this->encryptPrivate($jX);
        }
        Lg:
        So:
        Mk:
    }
    public function decryptData($jX)
    {
        if (!($this->cryptParams["\154\151\142\162\141\x72\171"] === "\157\160\x65\x6e\x73\x73\x6c")) {
            goto lB;
        }
        switch ($this->cryptParams["\x74\x79\160\x65"]) {
            case "\x73\171\x6d\x6d\x65\x74\162\151\143":
                return $this->decryptSymmetric($jX);
            case "\160\165\142\154\x69\x63":
                return $this->decryptPublic($jX);
            case "\x70\162\151\x76\141\x74\x65":
                return $this->decryptPrivate($jX);
        }
        Ms:
        x_:
        lB:
    }
    public function signData($jX)
    {
        switch ($this->cryptParams["\x6c\151\x62\162\141\x72\171"]) {
            case "\x6f\x70\145\156\163\x73\154":
                return $this->signOpenSSL($jX);
            case self::HMAC_SHA1:
                return hash_hmac("\163\x68\141\x31", $jX, $this->key, true);
        }
        oH:
        vl:
    }
    public function verifySignature($jX, $N1)
    {
        switch ($this->cryptParams["\154\x69\x62\162\x61\x72\171"]) {
            case "\x6f\160\x65\156\163\163\154":
                return $this->verifyOpenSSL($jX, $N1);
            case self::HMAC_SHA1:
                $pi = hash_hmac("\x73\x68\141\61", $jX, $this->key, true);
                return strcmp($N1, $pi) == 0;
        }
        MR:
        nu:
    }
    public function getAlgorith()
    {
        return $this->getAlgorithm();
    }
    public function getAlgorithm()
    {
        return $this->cryptParams["\155\x65\164\x68\157\x64"];
    }
    public static function makeAsnSegment($p8, $Vk)
    {
        switch ($p8) {
            case 0x2:
                if (!(ord($Vk) > 0x7f)) {
                    goto oK;
                }
                $Vk = chr(0) . $Vk;
                oK:
                goto Ww;
            case 0x3:
                $Vk = chr(0) . $Vk;
                goto Ww;
        }
        cJ:
        Ww:
        $B0 = strlen($Vk);
        if ($B0 < 128) {
            goto pt;
        }
        if ($B0 < 0x100) {
            goto PF;
        }
        if ($B0 < 0x10000) {
            goto dU;
        }
        $Pc = null;
        goto B7;
        dU:
        $Pc = sprintf("\45\143\x25\x63\45\x63\45\x63\45\163", $p8, 0x82, $B0 / 0x100, $B0 % 0x100, $Vk);
        B7:
        goto A4;
        PF:
        $Pc = sprintf("\45\x63\x25\143\45\143\x25\163", $p8, 0x81, $B0, $Vk);
        A4:
        goto uC;
        pt:
        $Pc = sprintf("\x25\x63\x25\143\45\x73", $p8, $B0, $Vk);
        uC:
        return $Pc;
    }
    public static function convertRSA($P7, $Ab)
    {
        $IM = self::makeAsnSegment(0x2, $Ab);
        $xw = self::makeAsnSegment(0x2, $P7);
        $Op = self::makeAsnSegment(0x30, $xw . $IM);
        $IK = self::makeAsnSegment(0x3, $Op);
        $Jh = pack("\110\52", "\x33\60\60\x44\x30\66\60\x39\62\x41\x38\x36\x34\x38\70\66\106\67\x30\x44\60\61\x30\61\60\x31\x30\x35\x30\x30");
        $uA = self::makeAsnSegment(0x30, $Jh . $IK);
        $hL = base64_encode($uA);
        $WC = "\55\55\55\55\x2d\102\x45\x47\111\116\x20\x50\x55\x42\x4c\x49\103\40\113\105\x59\x2d\55\x2d\55\x2d\xa";
        $g2 = 0;
        QC:
        if (!($RW = substr($hL, $g2, 64))) {
            goto cH;
        }
        $WC = $WC . $RW . "\12";
        $g2 += 64;
        goto QC;
        cH:
        return $WC . "\x2d\55\55\55\55\105\x4e\x44\40\x50\125\x42\114\x49\103\40\113\105\x59\x2d\55\55\55\x2d\12";
    }
    public function serializeKey($IY)
    {
    }
    public function getX509Certificate()
    {
        return $this->x509Certificate;
    }
    public function getX509Thumbprint()
    {
        return $this->X509Thumbprint;
    }
    public static function fromEncryptedKeyElement(DOMElement $dx)
    {
        $u8 = new XMLSecEnc();
        $u8->setNode($dx);
        if ($fF = $u8->locateKey()) {
            goto lq;
        }
        throw new Exception("\125\156\141\x62\x6c\x65\x20\x74\x6f\40\x6c\x6f\143\x61\164\x65\40\141\154\147\157\162\x69\164\x68\155\x20\146\x6f\x72\40\164\150\x69\163\40\x45\156\x63\x72\x79\x70\x74\145\x64\40\113\145\171");
        lq:
        $fF->isEncrypted = true;
        $fF->encryptedCtx = $u8;
        XMLSecEnc::staticLocateKeyInfo($fF, $dx);
        return $fF;
    }
}
