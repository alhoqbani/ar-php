<?php

namespace Tests\Arabic;

use ArUtil\Arabic;
use Salat;
use Tests\AbstractTestCase;

class SalatTest extends AbstractTestCase
{
    
    /**
     * @var Salat
     */
    protected $salat;
    /**
     * @var string
     */
    protected $timezone;
    
    protected function setUp()
    {
        parent::setUp();
        $this->salat = new Arabic('Salat');
        $this->timezone = date_default_timezone_get();
        date_default_timezone_set('America/Los_Angeles');
    }
    
    protected function tearDown()
    {
        date_default_timezone_set($this->timezone);
        parent::tearDown();
    }
    
    
    /** @test */
    public function it_loads_salat_class()
    {
        $this->assertInstanceOf(Salat::class, $this->salat->myObject);
    }
    
    /** @test */
    public function it_returns_the_correct_prayers_time()
    {
        $this->salat->setConf('Shafi', -0.833333, -17.5, -19.5, 'Sunni');
        $this->salat->setLocation(33.52, 36.31, 3, 691);
        $this->salat->setDate(4, 21, 2017);
        
        $times = $this->salat->getPrayTime();
        $expected_times = [
            "4:21", "5:53", "12:34", "16:13", "19:16", "20:36", "19:14", "0:34", "4:11", [
                1492773660.0, 1492779180.0, 1492803240.0, 1492816380.0, 1492827360.0, 1492832160.0, 1492827240.0, 1492846440.0, 1492773060.0,
            ],
        ];
        
        $this->assertEquals(
            $expected_times,
            $times,
            'The return prayers times must match the expected prayers time for
                    date, location and configs defined by the user'
        );
    }
    
    /** @test */
    public function it_returns_prayers_time_for_user_defined_confiscation()
    {
        $this->salat->setConf('Shafi', -0.833333, -17.5, -19.5, 'Sunni');
        $times = $this->salat->getPrayTime();
        
        $expected_times = [
            "26:55", "28:44", "35:42", "39:29", "42:41", "44:15", "42:39", "23:42", "26:45", [
                176291700.0, 176298240.0, 176323320.0, 176336940.0, 176348460.0, 176354100.0, 176348340.0, 176280120.0, 176291100.0,
            ],
        ];
        
        $this->assertEquals(
            $expected_times,
            $times,
            'The return prayres times must match the expected prayers time for
                    according to the user defined configs'
        );
    }
    
    /** @test */
    public function it_returns_prayers_time_for_user_defined_location()
    {
        $this->salat->setLocation(33.52, 36.31, 3, 691);
        $times = $this->salat->getPrayTime();
        
        $expected_times = [
            "28:18", "29:48", "36:45", "40:28", "43:44", "45:12", "43:42", "24:45", "28:08", [
                176296680.0, 176302080.0, 176327100.0, 176340480.0, 176352240.0, 176357520.0, 176352120.0, 176283900.0, 176296080.0,
            ],
        ];
        
        $this->assertEquals(
            $expected_times,
            $times,
            'The return prayres times must match the expected pryers time for Location entedered by the user'
        );
    }
    
    /** @test */
    public function it_returns_prayers_time_for_user_defined_date()
    {
        $this->salat->setDate(4, 21, 2017);
        $times = $this->salat->getPrayTime();
        
        $expected_times = [
            "3:18", "4:51", "11:30", "15:13", "18:12", "19:42", "18:10", "11:30", "3:08", [
                1492769880.0, 1492775460.0, 1492799400.0, 1492812780.0, 1492823520.0, 1492828920.0, 1492823400.0, 1492799400.0, 1492769280.0,
            ],
        ];
        
        $this->assertEquals(
            $expected_times,
            $times,
            'The return prayers times must match the expected payers time for 04/21/2017'
        );
    }
    
    /** @test */
    public function it_get_the_qibla_from_user_defined_location()
    {
        $this->salat->setLocation(33.52, 36.31, 3, 691);
        $qibla_degree = $this->salat->getQibla();
        
        $expected_qibla = '164.70473621919';
        
        $this->assertEquals(
            $expected_qibla,
            $qibla_degree,
            "Qibla from defined location must be {$expected_qibla} , but got {$qibla_degree}");
    }
    
    /** @test */
    public function it_can_convert_coordinate_degrees_to_unit_scale()
    {
        $coordinate_degrees = "39°49'32\"E";
        $expectedDegree = "39.825555555556";
        
        $degree_unit_scale = $this->salat->coordinate2deg($coordinate_degrees);
        
        $this->assertEquals(
            $degree_unit_scale,
            $expectedDegree,
            "The coveted coordinate must be {$expectedDegree},
                    but got {$degree_unit_scale}"
        );
    }
    
}
