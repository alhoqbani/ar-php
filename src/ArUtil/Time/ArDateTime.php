<?php

namespace ArUtil\Time;

use ArUtil\I18N\Mktime;
use Carbon\Carbon;

class ArDateTime extends Carbon
{
    
    public static function arCreateFromDate($year_h = null, $month_h = null, $day_h = null)
    {
        $instance = new self();
        $timestamp = $instance->hijriToTimestamp($year_h, $month_h, $day_h);
        $instance->setTimestamp($timestamp);
        
        return $instance;
    }
    
    protected function hijriToTimestamp($year_h, $month, $day_h)
    {
        return (new Mktime())->mktime($this->hour, $this->minute, $this->second, $month, $day_h, $year_h);
    }
    
}