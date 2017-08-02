<?php

namespace ArUtil\Tests\Arabic;

use ArUtil\I18N\Arabic;
use ArUtil\I18N\Mktime;
use ArUtil\Tests\AbstractTestCase;

class MktimeTest extends AbstractTestCase
{
    
    protected $timeStamp = 1499611163;
    
    /**
     * @var Mktime
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
        $this->assertInstanceOf(Mktime::class, $this->mktime->myObject);
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
	    $arr        = [
		    "1450-11-1" => "2029-3-16", // 0 Correction Day.
		    "1439-8-1"  => "2018-4-17", // 0 Correction Day.
		    "1438-1-1"  => "2016-10-2", // -1 Correction Day.
		    "1438-6-1"  => "2017-2-28", // 0 Correction Day.
		    "1437-9-15" => "2016-6-20", // -1 Correction Day.
		    "1435-4-15" => "2014-2-15", // -1 Correction Day.
		    "1434-9-15" => "2013-7-23", // 0 Correction Day.
		    "1433-6-12" => "2012-5-3", // -1 Correction Day.
		    "1430-2-25" => "2009-2-20", // -1 Correction Day.
		    "1420-8-1"  => "1999-11-9", // -1 Correction Day.
	    ];
	    $correction = $this->mktime->mktimeCorrection( 9, 1437 );
	    $time = $this->mktime->mktime( 0, 0, 0, 9, 15, 1437, $correction );
	    $this->assertEquals('2016-6-20', date( 'Y-n-d', $time));
	    $actualDiff = $this->mktime->mktimeCorrection( 10, 1430 );
        $this->assertEquals(-1, $actualDiff);
    }
    
    /** @test */
    public function it_returns_hijri_count_of_days_in_givin_hijri_month()
    {
        $this->assertEquals(29, $this->mktime->hijriMonthDays(7, 1438));
    }
}
