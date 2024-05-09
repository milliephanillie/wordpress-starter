<?php


namespace IDP\Helper\Traits;

trait Instance
{
    private static $_instance = null;
    public static function instance()
    {
        if (!is_null(self::$_instance)) {
            goto Qm;
        }
        self::$_instance = new self();
        Qm:
        return self::$_instance;
    }
}
