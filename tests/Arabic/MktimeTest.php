<?php

namespace Tests\Arabic;

use ArUtil\Arabic;
use I18N_Arabic_Mktime;
use Tests\AbstractTestCase;

class MktimeTest extends AbstractTestCase
{
    
    protected $timeStamp = 1499611163;
    
    /**
     * @var I18N_Arabic_Mktime
     */
    protected $mktime;
    protected $timezone;
    
    protected function setUp()
    {
        parent::setUp();
        $this->mktime = new Arabic('Mktime');
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
        $this->assertInstanceOf(I18N_Arabic_Mktime::class, $this->mktime->myObject);
    }
    
    /** @test */
    public function it_returns_timestamp_from_hijri_date()
    {
        $actualTimestamp = $this->mktime->mktime(1, 30, 15, 10, 15, 1400, -1);
        $this->assertEquals(336126615, $actualTimestamp);
    }
    
    /** @test */
    public function it_makes_time_correction()
    {
        $actualDiff = $this->mktime->mktimeCorrection(10, 1430);
        $this->assertEquals(-1, $actualDiff);
    }
    
    /** @test */
    public function it_returns_hijri_count_of_days_in_givin_hijri_month()
    {
        $this->assertEquals(29, $this->mktime->hijriMonthDays(7, 1438));
    }
}
