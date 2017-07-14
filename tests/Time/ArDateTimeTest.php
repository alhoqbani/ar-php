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
    public function it_return_carbon_instance_from_hijri_string_date()
    {
        /** @var Carbon $arD */
        $arD = ArUtil::date()->arCreateFromDate(1405, 8, 10);
        $this->assertInstanceOf(Carbon::class, $arD);
        $this->assertArDateTime($arD, 1405, 8, 10);
        $this->assertEquals('1985-05-01', $arD->toDateString());
    }
    
    
}
