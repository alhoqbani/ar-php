<?php

namespace ArUtil\Tests\Time;

use ArUtil\ArUtil;
use ArUtil\Time\ArDateTime;
use Carbon\Carbon;

class ArDateTimeTest extends AbstractTimeTest
{
    
    /** @test */
    public function it_exists()
    {
        $this->assertTrue(
            class_exists(ArDateTime::class),
            'Class ArDateTime does not exist.');
    }
    
    /** @test */
    public function it_extends_carbon()
    {
        $this->assertInstanceOf(Carbon::class, new ArDateTime());
    }
    
    /** @test */
    public function it_works()
    {
        $arD = ArUtil::date()->arCreate(1405, 8, 10, 2, 10, 50);
        $this->assertArDateTime($arD, 1405, 8, 10, 2, 10, 50);
    }
    
    /** @test */
    public function it_return_carbon_instance_from_hijri_string_date()
    {
        $arD = ArUtil::date()->arCreateFromDate(1405, 8, 10);
        $this->assertInstanceOf(Carbon::class, $arD);
        $this->assertArDateTime($arD, 1405, 8, 10);
        $this->assertEquals('1985-05-01', $arD->toDateString());
    }
    
    /** @test */
    public function it_adjust_hijri_date_based_on_correction_factor()
    {
        $arD = ArUtil::date()->arCreateFromDate(1433, 6, 12 ,$tz = null, -1);
        $this->assertEquals('2012-05-03', $arD->toDateString());
    }
}
