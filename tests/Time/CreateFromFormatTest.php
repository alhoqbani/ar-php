<?php

namespace ArUtil\Tests\Time;

use ArUtil\ArUtil;

class CreateFromFormatTest extends AbstractTimeTest
{
    
    /** @test */
    public function it_create_from_date_string()
    {
        $arD = ArUtil::date()->arCreateFromDateString('1438-10-19');
        $this->assertArDateTime($arD, 1438, 10, 19);
        $this->assertCarbon($arD, 2017, 7, 14);
    }
    
    /** @test */
    public function it_create_from_date_string_with_time_zone()
    {
        $arD = ArUtil::date()->arCreateFromDateString('1438-10-19', 'Asia/Riyadh');
        $this->assertEquals('Asia/Riyadh', $arD->timezoneName);
    }
    
    /** @test */
    public function it_create_from_date_time_string()
    {
        $arD = ArUtil::date()->arCreateFromDateTimeString('1438-10-19 4:30:45');
        $this->assertArDateTime($arD, 1438, 10, 19, 4, 30, 45);
        $this->assertCarbon($arD, 2017, 7, 14, 4, 30, 45);
    }
    
    /** @test */
    public function it_create_from_date_time_string_with_time_zone()
    {
        $arD = ArUtil::date()->arCreateFromDateTimeString('1438-10-19 4:30:45', 'Asia/Riyadh');
        $this->assertEquals('Asia/Riyadh', $arD->timezoneName);
    }
    
    /** @test */
    public function it_create_from_format()
    {
        $arD = ArUtil::date()->arCreateFromFormat('Y/m/d', '1430/10/01');
        $this->assertArDateTime($arD, 1430, 10, 1);
        $this->assertCarbon($arD, 2009, 9, 21);
    }
}
