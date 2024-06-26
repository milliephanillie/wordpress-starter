<?php


namespace IDP\Schedulers;

use IDP\Helper\Utilities\MoIDPUtility;
class BaseScheduler
{
    public $schedules = array("\x68\157\165\x72\x6c\171", "\167\145\x65\x6b\154\x79", "\171\145\141\x72\x6c\x79", "\x65\166\145\x72\x79\x5f\61\65\137\x64\x61\x79\x73", "\x65\166\145\162\x79\x5f\61\x30\137\144\141\171\163", "\155\157\x6e\164\x68\154\171", "\155\x69\x6e\165\164\x65\154\171", "\145\x76\x65\x72\171\x5f\x35\x5f\x6d\151\156\x75\x74\145\163", "\x65\166\145\162\x79\137\63\x5f\x6d\x69\x6e\x75\164\x65\x73");
    public $events = array("\x79\145\x61\x72\x6c\x79\154\x69\143\145\x6e\163\x65\x43\150\145\143\153", "\61\x35\104\141\171\122\145\x43\150\145\x63\x6b", "\65\104\141\171\122\x65\x43\150\145\x63\x6b", "\x66\x69\x6e\x61\154\x43\150\145\143\x6b");
    public $eventActionPair = array("\171\x65\141\162\x6c\171\x6c\x69\x63\145\156\x73\x65\x43\150\145\x63\153" => array("\111\104\120\134\101\143\164\x69\157\156\x73\134\x4c\113\110\141\156\x64\x6c\x65\x72", "\143\150\x65\143\x6b\114\106\157\162\122"), "\61\65\104\x61\171\x52\x65\x43\150\x65\143\153" => array("\111\104\120\134\x41\143\x74\151\157\156\x73\134\x4c\113\x48\141\x6e\x64\x6c\145\x72", "\x63\150\x65\x63\153\114\106\157\162\122"), "\x35\104\x61\171\x52\145\x43\150\x65\143\x6b" => array("\x49\104\x50\134\x41\143\164\151\157\156\x73\134\114\x4b\x48\x61\156\144\x6c\145\x72", "\x63\x68\145\143\x6b\x4c\106\157\162\122"), "\x66\x69\156\141\x6c\x43\150\145\143\x6b" => array("\111\104\x50\x5c\101\x63\x74\151\157\x6e\163\x5c\114\113\x48\141\156\144\x6c\x65\x72", "\103\150\x65\x63\153\x49\146\125\x73\x65\x72\x48\141\163\x52\x48\151\163\114"));
    public function unscheduleAllEvents()
    {
        if (!MSI_DEBUG) {
            goto x7;
        }
        MoIDPUtility::mo_debug("\125\156\x73\x63\x68\x65\x64\165\x6c\x69\156\x67\x20\x61\154\x6c\40\145\166\145\156\164\163");
        x7:
        foreach ($this->events as $UV => $Ev) {
            wp_unschedule_event(wp_next_scheduled($Ev), $Ev);
            Oc:
        }
        Re:
    }
}
