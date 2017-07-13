<?php

namespace ArUtil\Tests\Arabic;

use ArUtil\Date;
use ArUtil\Arabic;
use ArUtil\Tests\AbstractTestCase;

class DateTest extends AbstractTestCase
{
    
    protected $timeStamp = 1499611163;
    
    /**
     * @var Date
     */
    protected $date;
    protected $timezone;
    
    protected function setUp()
    {
        parent::setUp();
        $this->date = new Arabic('Date');
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
        $this->assertInstanceOf(Date::class, $this->date->myObject);
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
    
    /** @test */
    public function it_returns_correct_format_with_mode_1()
    {
        $this->VerifyFormatWithMode(1, 'الأحد 14 شوال 1438 07:39:23 صباحاً');
    }
    
    /** @test */
    public function it_returns_correct_format_with_mode_2()
    {
        $this->VerifyFormatWithMode(2, 'الأحد 09 تموز 2017 07:39:23 صباحاً');
    }
    
    /** @test */
    public function it_returns_correct_format_with_mode_3()
    {
        $this->VerifyFormatWithMode(3, 'الأحد 09 يوليو 2017 07:39:23 صباحاً');
    }
    
    /** @test */
    public function it_returns_correct_format_with_mode_4()
    {
        $this->VerifyFormatWithMode(4, 'الأحد 09 تموز/يوليو 2017 07:39:23 صباحاً');
    }
    /** @test */
    public function it_returns_correct_format_with_mode_5()
    {
        $this->VerifyFormatWithMode(5, 'الأحد 09 ناصر 1385 07:39:23 صباحاً');
    }
    
    /** @test */
    public function it_returns_correct_format_with_mode_6()
    {
        $this->VerifyFormatWithMode(6, 'الأحد 09 جويلية 2017 07:39:23 صباحاً');
    }
    
    /** @test */
    public function it_returns_correct_format_with_mode_7()
    {
        $this->VerifyFormatWithMode(7, 'الأحد 09 يوليوز 2017 07:39:23 صباحاً');
    }
    
    /** @test */
    public function it_returns_correct_format_with_mode_8()
    {
        $this->VerifyFormatWithMode(8, 'Sunday 14 Shawwal 1438 07:39:23 AM');
    }
    
    protected function VerifyFormatWithMode($mode, $expectedString)
    {
        $this->date->setMode($mode);
        $actualString = $this->date->date('l dS F Y h:i:s A', $this->timeStamp);
        $this->assertEquals($expectedString, $actualString);
    }
    
    /** @test */
    public function it_calculate_correction_factor_for_Um_Alqura_calendar()
    {
        // Is this accurate?
        $this->assertEquals(0, $this->date->dateCorrection(1009843200));
    }
}
