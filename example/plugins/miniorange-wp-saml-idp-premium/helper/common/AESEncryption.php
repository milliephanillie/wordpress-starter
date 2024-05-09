<?php


class AESEncryption
{
    public static function encrypt_data($Vk, $ur)
    {
        $ne = '';
        $Uy = 0;
        tN:
        if (!($Uy < strlen($Vk))) {
            goto KT;
        }
        $CV = substr($Vk, $Uy, 1);
        $KM = substr($ur, $Uy % strlen($ur) - 1, 1);
        $CV = chr(ord($CV) + ord($KM));
        $ne .= $CV;
        iX:
        $Uy++;
        goto tN;
        KT:
        return base64_encode($ne);
    }
    public static function decrypt_data($Vk, $ur)
    {
        $ne = '';
        $Vk = base64_decode($Vk);
        $Uy = 0;
        PO:
        if (!($Uy < strlen($Vk))) {
            goto HH;
        }
        $CV = substr($Vk, $Uy, 1);
        $KM = substr($ur, $Uy % strlen($ur) - 1, 1);
        $CV = chr(ord($CV) - ord($KM));
        $ne .= $CV;
        v7:
        $Uy++;
        goto PO;
        HH:
        return $ne;
    }
}
