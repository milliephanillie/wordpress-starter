<?php


namespace IDP\Schedulers;

class SchedulerFactory
{
    private static $_instance;
    public static function getInstance()
    {
        if (!is_null(self::$_instance)) {
            goto s1;
        }
        if (MSI_DEBUG && MSI_LK_DEBUG) {
            goto Rh;
        }
        self::$_instance = new CustomSchedulers();
        goto FZ;
        Rh:
        self::$_instance = new TestScheduler();
        FZ:
        s1:
        return self::$_instance;
    }
}
