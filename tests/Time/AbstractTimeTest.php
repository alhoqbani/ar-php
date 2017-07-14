<?php

namespace ArUtil\Tests\Time;

use ArUtil\I18N\Date;
use ArUtil\Tests\AbstractTestCase;
use ArUtil\Time\ArDateTime;
use Carbon\Carbon;

abstract class AbstractTimeTest extends AbstractTestCase
{
    
    /**
     * @var \Carbon\Carbon
     */
    protected $now;
    
    /**
     * @var string Saved timezone before test
     */
    protected $savedTz;
    /**
     * @var array Today Hijri Date to use in testing.
     */
    protected $arToday;
    
    protected function setUp()
    {
        parent::setUp();
        $this->savedTz = date_default_timezone_get();
        
        date_default_timezone_set('America/Los_Angeles');
        
        Carbon::setTestNow($this->now = Carbon::now());
        $this->setTodayHijriDate();
    }
    
    protected function tearDown()
    {
        date_default_timezone_set($this->savedTz);
        Carbon::setTestNow();
        unset($this->arToday, $this->savedTz, $this->now);
        parent::tearDown();
    }
    
    private function setTodayHijriDate()
    {
        list($arYear, $arMonth, $arDay) = (new Date())->hjConvert(date('Y'), date('m'), date('d'));
        
        $this->arToday = [
            'arYear'  => $arYear,
            'arMonth' => $arMonth,
            'arDay'   => $arDay,
        ];
    }
    
    protected function assertCarbon(Carbon $d, $year, $month, $day, $hour = null, $minute = null, $second = null)
    {
        $actual = [
            'years'  => $year,
            'months' => $month,
            'day'    => $day,
        ];
        
        $expected = [
            'years'  => $d->year,
            'months' => $d->month,
            'day'    => $d->day,
        ];
        
        if ($hour !== null) {
            $expected['hours'] = $d->hour;
            $actual['hours'] = $hour;
        }
        
        if ($minute !== null) {
            $expected['minutes'] = $d->minute;
            $actual['minutes'] = $minute;
        }
        
        if ($second !== null) {
            $expected['seconds'] = $d->second;
            $actual['seconds'] = $second;
        }
        
        $this->assertSame($expected, $actual);
    }
    
    protected function assertArDateTime(
        ArDateTime $arD, $arYear, $arMonth, $arDay, $hour = null, $minute = null, $second = null
    ) {
        $actual = [
            'years'  => $arYear,
            'months' => $arMonth,
            'day'    => $arDay,
        ];
        
        $expected = [
            'years'  => $arD->arYear,
            'months' => $arD->arMonth,
            'day'    => $arD->arDay,
        ];
        
        if ($hour !== null) {
            $expected['hours'] = $arD->hour;
            $actual['hours'] = $hour;
        }
        
        if ($minute !== null) {
            $expected['minutes'] = $arD->minute;
            $actual['minutes'] = $minute;
        }
        
        if ($second !== null) {
            $expected['seconds'] = $arD->second;
            $actual['seconds'] = $second;
        }
        
        $this->assertSame($expected, $actual);
    }
}
