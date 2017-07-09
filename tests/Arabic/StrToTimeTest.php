<?php

namespace Tests\Arabic;

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
}
