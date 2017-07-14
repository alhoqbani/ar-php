<?php

namespace ArUtil\Tests\Time;

use ArUtil\ArUtil;

class GettersTest extends AbstractTimeTest
{
    
    /** @test */
    public function it_return_today_hijri_day()
    {
        $arD = ArUtil::date();
        $this->assertEquals($this->arToday['arDay'], $arD->arDay);
    }
    
    /** @test */
    public function it_return_today_hijri_month()
    {
        $arD = ArUtil::date();
        $this->assertEquals($this->arToday['arMonth'], $arD->arMonth);
    }
    
    /** @test */
    public function it_return_today_hijri_year()
    {
        $arD = ArUtil::date();
        $this->assertEquals($this->arToday['arYear'], $arD->arYear);
    }
    
    /** @test */
    public function it_return_converted_hijri_day()
    {
        $arD = ArUtil::date()->arCreateFromDate('1405', '08','10');
        $this->assertEquals(10, $arD->arDay);
    }
    
    /** @test */
    public function it_return_converted_hijri_month()
    {
        $arD = ArUtil::date()->arCreateFromDate('1405', '08','10');
        $this->assertEquals(8, $arD->arMonth);
    }
    
    /** @test */
    public function it_return_converted_hijri_year()
    {
        $arD = ArUtil::date()->arCreateFromDate('1405', '08','10');
        $this->assertEquals(1405, $arD->arYear);
    }
}
