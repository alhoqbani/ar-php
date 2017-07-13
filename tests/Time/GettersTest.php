<?php

namespace ArUtil\Tests\Time;

use ArUtil\ArUtil;

class GettersTest extends AbstractTimeTest
{
    
    /** @test */
    public function it_return_today_hijri_date()
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
}
