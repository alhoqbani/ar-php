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
    
    /**
     * Create new instance of ArDateTime and set the hijri date to the date provided.
     *
     * @param int|null                  $arYear     Hijri year Ex: 1430
     * @param int|null                  $arMonth    Hijri month Ex: 10
     * @param int|null                  $arDay      Hijri Day date Ex: 01
     * @param int|null                  $hour
     * @param int|null                  $minute
     * @param int|null                  $second
     * @param \DateTimeZone|string|null $tz
     * @param int|null                  $correction Date conversion factor (+1, +2, -1, -2)
     *
     * @return \ArUtil\Time\ArDateTime
     */
    public static function arCreate(
        $arYear = null, $arMonth = null, $arDay = null, $hour = null, $minute = null, $second = null, $tz = null,
        $correction = null
    ) {
        $instance = self::createFromTime($hour, $minute, $second, $tz);
        $arYear = isset($arYear) ? $arYear : $instance->arYear;
        $arMonth = isset($arMonth) ? $arMonth : $instance->arMonth;
        $arDay = isset($arDay) ? $arDay : $instance->arDay;
        
        $timestamp = $instance->hijriToTimestamp(
            $arYear, $arMonth, $arDay, $instance->hour, $instance->minute, $instance->second, $correction
        );
        $instance->setDate(date('Y', $timestamp), date('m', $timestamp), date('d', $timestamp));
        
        $instance->updateHijriDate($arYear, $arMonth, $arDay);
        
        return $instance;
    }
    
    /**
     * Create new instance of ArDateTime and set the hijri date to the date provided.
     *
     * @param int|null                  $arYear     Hijri year Ex: 1430
     * @param int|null                  $arMonth    Hijri month Ex: 10
     * @param int|null                  $arDay      Hijri Day date Ex: 01
     * @param \DateTimeZone|string|null $tz
     * @param int|null                  $correction Date conversion factor (+1, +2, -1, -2)
     *
     * @return \ArUtil\Time\ArDateTime
     */
    public static function arCreateFromDate(
        $arYear = null, $arMonth = null, $arDay = null, $tz = null, $correction = null
    ) {
        $instance = self::arCreate($arYear, $arMonth, $arDay, null, null, null, $tz, $correction);
        
        return $instance;
    }
    
    /**
     * Create new instance from DateString format: 1438-10-15
     *
     * @param string                    $dateString Hijri date in Y-m-d format
     * @param \DateTimeZone|string|null $tz
     * @param int|null                  $correction Date conversion factor (+1, +2, -1, -2)
     *
     * @return \ArUtil\Time\ArDateTime
     */
    public static function arCreateFromDateString($dateString, $tz = null, $correction = null)
    {
        $arDate = date_parse($dateString);
        
        return self::arCreateFromDate($arDate['year'], $arDate['month'], $arDate['day'], $tz, $correction);
    }
    
    /**
     * Create new instance from DateTimeString format: 1438-10-19 4:30:45
     *
     * @param string                    $dateTimeString Hijri date in Y-m-d H:i:s format
     * @param \DateTimeZone|string|null $tz
     * @param int|null                  $correction     Date conversion factor (+1, +2, -1, -2)
     *
     * @return \ArUtil\Time\ArDateTime
     */
    public static function arCreateFromDateTimeString($dateTimeString, $tz = null, $correction = null)
    {
        $arDate = date_parse($dateTimeString);
        
        return self::arCreate(
            $arDate['year'], $arDate['month'], $arDate['day'], $arDate['hour'], $arDate['minute'], $arDate['second'],
            $tz, $correction
        );
    }
    
    /**
     * Create new instance from Hijri date in the format provided.
     *
     * @param string                    $format
     * @param string                   $date
     * @param \DateTimeZone|string|null $tz
     * @param int|null                  $correction Date conversion factor (+1, +2, -1, -2)
     *
     * @return \ArUtil\Time\ArDateTime
     */
    public static function arCreateFromFormat($format, $date, $tz = null, $correction = null)
    {
        $arDate = self::parseDateFormat($format, $date);
        
        return self::arCreate($arDate['arYear'], $arDate['arMonth'], $arDate['arDay'], $arDate['hour'],
            $arDate['minute'],
            $arDate['second'],
            $tz, $correction);
    }
    
    
    /**
     * ArDateTime constructor, Instantiate new instance and set Today's date in Hijri.
     *
     * @param string|null               $time
     * @param \DateTimeZone|string|null $tz
     */
    public function __construct($time = null, $tz = null)
    {
        $this->setTodayHijriDate();
        
        parent::__construct($time, $tz);
    }
    
    /**
     * Parse the Hijri date according to the format provided.
     * @param $format
     * @param $date
     *
     * @return array Parsed date
     */
    private static function parseDateFormat($format, $date)
    {
        $arDate = date_parse_from_format($format, $date);
        
        return [
            'arYear'  => ($arDate['year'] != false) ? $arDate['year'] : null,
            'arMonth' => ($arDate['month'] != false) ? $arDate['month'] : null,
            'arDay'   => ($arDate['day'] != false) ? $arDate['day'] : null,
            'hour'    => ($arDate['hour'] != false) ? $arDate['hour'] : null,
            'minute'  => ($arDate['minute'] != false) ? $arDate['minute'] : null,
            'second'  => ($arDate['second'] != false) ? $arDate['second'] : null,
        ];
    }
    
    public function arFormat($format)
    {
        $d = new Date();
        
        return $d->date($format, $this->timestamp);
    }
    
    public function arToDateTimeString()
    {
        return $this->arFormat('Y-m-d H:i:s');
    }
    
    public function arToDayDateTimeString()
    {
        return $this->arFormat('D, M j, Y g:i A');
    }
    
    public function arToDateString()
    {
        return $this->arFormat('Y-m-d');
    }
    
    /**
     * Set the instance Hijri date for today.
     */
    private function setTodayHijriDate()
    {
        $today = $this->convertTodayToHijri();
        $this->arYear = (int)$today['arYear'];
        $this->arMonth = (int)$today['arMonth'];
        $this->arDay = (int)$today['arDay'];
    }
    
    /**
     * Convert given Hijri date to Gregorian Date in timestamp
     *
     * @param int|null $arYear     Hijri year Ex: 1430
     * @param int|null $arMonth    Hijri month Ex: 10
     * @param int|null $arDay      Hijri Day date Ex: 01
     * @param int|null $hour
     * @param int|null $minute
     * @param int|null $second
     * @param int|null $correction Date conversion factor (+1, +2, -1, -2)
     *
     * @return int Timestamp for Converted date
     */
    protected function hijriToTimestamp(
        $arYear, $arMonth, $arDay, $hour = null, $minute = null, $second = null, $correction = 0
    ) {
        $hour = isset($hour) ? $hour : date('H');
        $minute = isset($minute) ? $minute : date('i');
        $second = isset($second) ? $second : date('s');
        
        return (new Mktime())->mktime($hour, $minute, $second, $arMonth, $arDay, $arYear,
            $correction);
    }
    
    /**
     * Convert Toady's Gregorian date to Hijri date.
     *
     * @return array The hijri date.
     */
    private function convertTodayToHijri()
    {
        list($arYear, $arMonth, $arDay) = (new Date())->hjConvert(date('Y'), date('m'), date('d'));
        
        return [
            'arYear'  => $arYear,
            'arMonth' => $arMonth,
            'arDay'   => $arDay,
        ];
    }
    
    /**
     * Update the instance Hijri Date, used by static create methods.
     *
     * @param int|null $arYear  Hijri year
     * @param int|null $arMonth Hijri month
     * @param int|null $arDay   Hijri Day date
     */
    private function updateHijriDate($arYear, $arMonth, $arDay)
    {
        $this->arYear = $arYear;
        $this->arMonth = $arMonth;
        $this->arDay = $arDay;
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
}
