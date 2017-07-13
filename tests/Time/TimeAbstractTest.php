<?php

namespace ArUtil\Tests\Time;

use ArUtil\I18N\Date;
use ArUtil\Tests\AbstractTestCase;
use Carbon\Carbon;

abstract class TimeAbstractTest extends AbstractTestCase
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
}
