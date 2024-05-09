<?php


namespace IDP\Schedulers;

use IDP\Helper\Utilities\MoIDPUtility;
class TestScheduler extends BaseScheduler
{
    public function setYearlySchedule($mJ)
    {
        if (!MSI_DEBUG) {
            goto Cp;
        }
        MoIDPUtility::mo_debug("\123\x65\x74\164\x69\x6e\x67\x20\64\x35\x20\x4d\151\x6e\165\164\x65\40\x53\143\x68\x65\x64\165\x6c\145\x20\x66\x6f\162\40\114\151\143\145\x6e\163\x65\40\103\150\x65\143\153");
        Cp:
        wp_schedule_single_event(time() + 2700, $this->events[0], array($mJ));
    }
    public function unsetYearlySchedule()
    {
        if (!MSI_DEBUG) {
            goto NN;
        }
        MoIDPUtility::mo_debug("\125\156\x73\x63\150\x65\144\x75\154\x69\x6e\x67\40\64\x35\40\x4d\x69\x6e\165\164\x65\40\123\x63\x68\145\144\x75\x6c\x65\40\x66\x6f\162\40\x4c\151\x63\145\156\163\x65\x20\103\x68\145\143\153");
        NN:
        wp_unschedule_event(wp_next_scheduled($this->events[0]), $this->events[0]);
    }
    public function set15DaySchedule($mJ)
    {
        if (!MSI_DEBUG) {
            goto vd;
        }
        MoIDPUtility::mo_debug("\x53\x65\x74\x74\151\156\147\40\x35\40\115\x69\x6e\165\x74\x65\40\x53\143\150\x65\144\x75\x6c\x65\40\146\x6f\162\40\114\151\143\145\156\x73\x65\x20\103\x68\145\x63\153");
        vd:
        wp_schedule_single_event(time() + 300, $this->events[1], array($mJ));
    }
    public function unset15DaySchedule()
    {
        if (!MSI_DEBUG) {
            goto sK;
        }
        MoIDPUtility::mo_debug("\125\156\163\143\150\145\x64\165\x6c\x69\x6e\x67\40\x35\40\x4d\x69\156\x75\x74\x65\x20\x53\143\150\x65\144\x75\154\145");
        sK:
        wp_unschedule_event(wp_next_scheduled($this->events[1]), $this->events[1]);
    }
    public function set10DaySchedule($mJ)
    {
        if (!MSI_DEBUG) {
            goto ay;
        }
        MoIDPUtility::mo_debug("\x53\x65\164\164\151\x6e\147\40\63\40\115\x69\156\165\164\x65\x20\x53\143\x68\145\x64\x75\x6c\145\x20\x66\157\162\x20\x4c\x69\143\145\x6e\x73\145\x20\x43\x68\145\143\153");
        ay:
        wp_schedule_single_event(time() + 180, $this->events[2], array($mJ));
    }
    public function unset10DaySchedule()
    {
        if (!MSI_DEBUG) {
            goto r6;
        }
        MoIDPUtility::mo_debug("\125\x6e\x73\143\x68\x65\144\165\x6c\x69\x6e\147\x20\x33\x20\115\151\156\x75\x74\x65\x20\123\x63\150\145\x64\x75\x6c\145\40\146\x6f\162\x20\114\151\143\145\156\x73\145\40\x43\150\145\x63\153");
        r6:
        wp_unschedule_event(wp_next_scheduled($this->events[2]), $this->events[2]);
    }
    public function set5DaySchedule($mJ)
    {
        if (!MSI_DEBUG) {
            goto b6;
        }
        MoIDPUtility::mo_debug("\x53\145\164\164\x69\156\147\x20\x31\40\x4d\151\156\165\164\x65\40\x53\143\x68\x65\144\165\154\x65\40\x66\x6f\x72\40\114\x69\143\145\156\x73\x65\x20\103\x68\145\x63\x6b");
        b6:
        wp_schedule_single_event(time() + 60, $this->events[2], array($mJ));
    }
    public function unset5DaySchedule()
    {
        if (!MSI_DEBUG) {
            goto lN;
        }
        MoIDPUtility::mo_debug("\x55\156\x73\x63\x68\145\x64\x75\154\x69\156\147\40\61\x20\115\x69\x6e\x75\x74\145\40\x53\143\x68\x65\x64\x75\154\145\x20\x66\x6f\x72\x20\x4c\x69\x63\145\156\163\x65\x20\103\150\145\x63\153");
        lN:
        wp_unschedule_event(wp_next_scheduled($this->events[2]), $this->events[2]);
    }
    public function setFinalCheckSchedule()
    {
        if (!MSI_DEBUG) {
            goto T4;
        }
        MoIDPUtility::mo_debug("\x53\145\164\x74\151\x6e\x67\x20\63\40\x4d\x69\x6e\x75\164\145\40\x53\x63\150\145\x64\165\x6c\145\x20\146\157\162\40\x64\x65\141\143\x74\x69\x76\x61\164\151\x6e\147\x20\x74\150\x65\40\160\x6c\x75\x67\151\x6e");
        T4:
        wp_schedule_single_event(time() + 180, $this->events[3]);
    }
    public function unsetFinalCheckSchedule()
    {
        if (!MSI_DEBUG) {
            goto ct;
        }
        MoIDPUtility::mo_debug("\x55\x6e\163\x63\150\145\x64\165\154\151\156\x67\40\x33\40\115\x69\x6e\x75\164\145\40\x53\143\150\145\x64\x75\154\x65\x20\x66\x6f\x72\x20\x64\x65\141\143\x74\x69\166\141\164\x69\156\147\x20\x74\150\145\40\x70\154\x75\147\x69\156");
        ct:
        wp_unschedule_event(wp_next_scheduled($this->events[3]), $this->events[3]);
    }
}
