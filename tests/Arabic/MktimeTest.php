<?php

namespace Tests\Arabic;

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
        $this->mktime = new \I18N_Arabic('Mktime');
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
    
    
}
