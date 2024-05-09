<?php


namespace RobRichards\XMLSecLibs\Utils;

class XPath
{
    const ALPHANUMERIC = "\x5c\167\134\144";
    const NUMERIC = "\x5c\144";
    const LETTERS = "\x5c\167";
    const EXTENDED_ALPHANUMERIC = "\134\x77\x5c\144\134\163\x5c\x2d\x5f\x3a\x5c\x2e";
    const SINGLE_QUOTE = "\47";
    const DOUBLE_QUOTE = "\x22";
    const ALL_QUOTES = "\133\47\42\135";
    public static function filterAttrValue($Ev, $za = self::ALL_QUOTES)
    {
        return preg_replace("\x23" . $za . "\43", '', $Ev);
    }
    public static function filterAttrName($Zp, $dj = self::EXTENDED_ALPHANUMERIC)
    {
        return preg_replace("\43\133\x5e" . $dj . "\135\43", '', $Zp);
    }
}
