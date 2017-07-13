<?php

namespace ArUtil\Time;

use ArUtil\I18N\Date;
use ArUtil\I18N\Mktime;
use Carbon\Carbon;
use InvalidArgumentException;

/**
 * @property integer arDay
 * @property integer arMonth
 * @property integer arYear
 */
class ArDateTime extends Carbon
{
    
    public static function arCreateFromDate($arYear = null, $arMonth = null, $arDay = null, $tz = null)
    {
        $instance = self::now($tz);
        $timestamp = $instance->hijriToTimestamp($arYear, $arMonth, $arDay);
        $instance->setTimestamp($timestamp);
        
        return $instance;
    }

    public function __construct($time = null, $tz = null)
    {
        $this->setTodayHijriDate();

        parent::__construct($time, $tz);
    }
    
    protected function hijriToTimestamp($arYear, $arMonth, $arDay)
    {
        return (new Mktime())->mktime(date('H'), date('i'), date('s'), $arMonth, $arDay, $arYear,
            $correction = 0);
    }
    
    private function convertTodayToHijri()
    {
        list($arYear, $arMonth, $arDay) = (new Date())->hjConvert(date('Y'), date('m'), date('d'));
        
        return [
            'arYear'  => $arYear,
            'arMonth' => $arMonth,
            'arDay'   => $arDay,
        ];
    }
    
    private function setTodayHijriDate()
    {
        $today = $this->convertTodayToHijri();
        $this->arYear = (int)$today['arYear'];
        $this->arMonth = (int)$today['arMonth'];
        $this->arDay = (int)$today['arDay'];
    }
    
    public function __get($name)
    {
        switch ($name) {
            case $name === 'arYear':
                return $this->arYear;
            case $name === 'arMonth':
                return $this->arMonth;
            case $name === 'arDay':
                return $this->arDay;
            default:
                break;
        }
        return parent::__get($name);
    }
    
    public function __set($name, $value)
    {
        try {
            parent::__set($name, $value);
        } catch (InvalidArgumentException $e) {
            switch ($name) {
                case 'arYear':
                case 'arMonth':
                case 'arDay':
                    $this->{$name} = $value;
                    break;
                default:
                    throw $e;
            }
        }
        
    }
    
    
}