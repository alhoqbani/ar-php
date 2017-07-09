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
    
    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->date = new \I18N_Arabic('Date');
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
}
