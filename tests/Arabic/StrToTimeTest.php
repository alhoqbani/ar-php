<?php

namespace Tests\Arabic;

use Carbon\Carbon;
use I18N_Arabic_StrToTime;
use Tests\AbstractTestCase;

class StrToTimeTest extends AbstractTestCase
{
    
    /**
     * @var I18N_Arabic_StrToTime
     */
    protected $strToTime;
    protected $timezone;
    
    protected function setUp()
    {
        parent::setUp();
        $this->strToTime = new \I18N_Arabic('StrToTime');
        $this->timezone = date_default_timezone_get();
        date_default_timezone_set('America/Los_Angeles');
    }
    
    protected function tearDown()
    {
        parent::tearDown();
        date_default_timezone_set($this->timezone);
    }
    
    
    /** @test */
    public function it_loads_date_class()
    {
        $this->assertInstanceOf(I18N_Arabic_StrToTime::class, $this->strToTime->myObject);
    }
    
    /** @test */
    public function it_convert_next_occurrence_of_day_to_time()
    {
        $timestamp = Carbon::create()->next(Carbon::FRIDAY)->timestamp;
        $this->confirmTimestamp('الجمعة القادم', $timestamp);
    }
    
    /** @test */
    public function it_convert_last_occurrence_of_day_to_time()
    {
        $timestamp = Carbon::parse('last sunday')->timestamp;
        $this->confirmTimestamp('الأحد الماضي', $timestamp);
    }
    
    /** @test */
    public function it_convert_hijri_date_string_to_time()
    {
        $this->confirmTimestamp('1 ذو القعدة 1429', 1225350000);
    }
    
    protected function confirmTimestamp($string, $timestamp, $compareTo = null)
    {
        $compareTo = $compareTo ? $compareTo : time();
        $this->assertEquals($timestamp, $this->strToTime->strtotime($string, $compareTo));
    }
}
