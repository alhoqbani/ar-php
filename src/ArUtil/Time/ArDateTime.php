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
    
    /**
     * @var boolean The instance date is modified.
     */
    private $isDirty;
    
    public static function arCreate(
        $arYear = null,
        $arMonth = null,
        $arDay = null,
        $hour = null,
        $minute = null,
        $second = null,
        $tz = null,
        $correction = null
    ) {
        $instance = self::createFromTime($hour, $minute, $second, $tz);
        $arYear = isset($arYear) ? $arYear : $instance->arYear;
        $arMonth = isset($arMonth) ? $arMonth : $instance->arMonth;
        $arDay = isset($arDay) ? $arDay : $instance->arDay;
    
        if ($hour === null) {
            $hour = date('G');
            $minute = $minute === null ? date('i') : $minute;
            $second = $second === null ? date('s') : $second;
        } else {
            $minute = $minute === null ? 0 : $minute;
            $second = $second === null ? 0 : $second;
        }
        $timestamp = $instance->hijriToTimestamp($arYear, $arMonth, $arDay, $hour, $minute, $second, $correction);
        $instance->setDate(date('Y', $timestamp), date('m', $timestamp), date('d', $timestamp));
//        dd($hour, $instance->hour, date('G', $timestamp));
//        dd($instance->toDateString());
//        dd(date('G', $timestamp), date('i', $timestamp), date('s', $timestamp));
        $instance->updateHijriDate($arYear, $arMonth, $arDay);
        return $instance;
    }
    
    public static function arCreateFromDate($arYear = null, $arMonth = null, $arDay = null, $tz = null)
    {
        $instance = self::now($tz);
        
        $arYear = isset($arYear) ? $arYear : $instance->arYear;
        $arMonth = isset($arMonth) ? $arMonth : $instance->arMonth;
        $arDay = isset($arDay) ? $arDay : $instance->arDay;
        
        $timestamp = $instance->hijriToTimestamp($arYear, $arMonth, $arDay);
        $instance->setTimestamp($timestamp);
        $instance->updateHijriDate($arYear, $arMonth, $arDay);
        
        return $instance;
    }
    
    public function __construct($time = null, $tz = null)
    {
        $this->setTodayHijriDate();
        
        parent::__construct($time, $tz);
    }
    
    protected function hijriToTimestamp(
        $arYear, $arMonth, $arDay, $hour = null, $minute = null, $second = null, $correction = 0
    ) {
        
        $hour = isset($hour) ? $hour : date('H');
        $minute = isset($minute) ? $minute : date('i');
        $second = isset($second) ? $second : date('s');
        
        return (new Mktime())->mktime($hour, $minute, $second, $arMonth, $arDay, $arYear,
            $correction);
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
//        switch ($name) {
//            case $name === 'arYear':
//                return $this->arYear;
//            case $name === 'arMonth':
//                return $this->arMonth;
//            case $name === 'arDay':
//                return $this->arDay;
//            default:
//                break;
//        }
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
    
    private function updateHijriDate($arYear, $arMonth, $arDay)
    {
        $this->arYear = $arYear;
        $this->arMonth = $arMonth;
        $this->arDay = $arDay;
    }
    
    
}