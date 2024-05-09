<?php


namespace IDP\Schedulers;

interface IScheduler
{
    public function setYearlySchedule($mJ);
    public function unsetYearlySchedule();
    public function set15DaySchedule($mJ);
    public function unset15DaySchedule();
    public function set10DaySchedule($mJ);
    public function unset10DaySchedule();
    public function set5DaySchedule($mJ);
    public function unset5DaySchedule();
    public function setFinalCheckSchedule();
    public function unsetFinalCheckSchedule();
    public function unscheduleAllEvents();
}
