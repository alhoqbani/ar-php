<?php

namespace Tests\Arabic;

use I18N_Arabic_Date;
use Tests\AbstractTestCase;

class DateTest extends AbstractTestCase
{
    
    /**
     * @var I18N_Arabic_Date
     */
    protected $date;
    protected $timezone;
    
    protected function setUp()
    {
        parent::setUp();
        $this->date = new \I18N_Arabic('Date');
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
        $this->assertInstanceOf(I18N_Arabic_Date::class, $this->date->myObject);
    }
    
    /** @test */
    public function it_set_mode_and_get_mode()
    {
        $this->assertEquals(4, $this->date->setMode(4)->getMode());
    }
    
    /** @test */
    public function it_converts_gregorian_year_to_hijri_year_year()
    {
        $actualYear = $this->date->date('Y', strtotime('2017'));
        $this->assertEquals(1438, $actualYear);
    }
    
    /** @test */
    public function it_returns_hijri_date_in_requested_format_when_given_timestamp()
    {
        $timestamp = 1499611163;
        $expectedString = 'الأحد 14 شوال 1438 07:39:23 صباحاً';
        $actualString = $this->date->date('l dS F Y h:i:s A', $timestamp);
        $this->assertEquals($expectedString, $actualString);
    }
}
