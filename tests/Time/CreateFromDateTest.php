<?php

namespace ArUtil\Tests\Time;

use ArUtil\ArUtil;
use Carbon\Carbon;

class CreateFromDateTest extends AbstractTimeTest
{
    
    /** @test */
    public function it_create_from_date()
    {
        $expected = Carbon::createFromDate(1985, 05, 01);
        $actual = ArUtil::date()->arCreateFromDate(1405, 8, 10);
        
        $this->assertEquals($expected, $actual);
    }
    
    /** @test */
    public function it_create_from_date_with_timezone()
    {
        $expected = Carbon::createFromDate(1985, 05, 01, 'Asia/Riyadh')->timezoneName;
        $actual = ArUtil::date()->arCreateFromDate(1405, 8, 10, 'Asia/Riyadh')->timezoneName;
        
        $this->assertEquals($expected, $actual);
    }
    
    /** @test */
    public function it_create_from_date_with_year()
    {
        $expected = ArUtil::date()->arCreateFromDate(1405, $this->arToday['arMonth'], $this->arToday['arDay']);
        $actual = ArUtil::date()->arCreateFromDate(1405);
        
        $this->assertEquals($expected, $actual);
    }
    
    /** @test */
    public function it_create_from_date_with_month()
    {
        $expected = ArUtil::date()->arCreateFromDate($this->arToday['arYear'], 9, $this->arToday['arDay']);
        $actual = ArUtil::date()->arCreateFromDate(null, 9, null);
        
        $this->assertEquals($expected, $actual);
    }
    
    /** @test */
    public function it_create_from_date_with_day()
    {
        $expected = ArUtil::date()->arCreateFromDate($this->arToday['arYear'], $this->arToday['arMonth'], 10);
        $actual = ArUtil::date()->arCreateFromDate(null, null, 10);
        
        $this->assertEquals($expected, $actual);
    }
    
    /** @test */
    public function it_adjust_the_date_based_on_provided_correction_factor()
    {
	    $arD = ArUtil::date()->arCreateFromDate(1430, 10, 15, null, -1);
	
	    $this->assertArDateTime($arD, 1430, 10, 15);
	    $this->assertCarbon($arD, 2009, 10, 4);
    }
}
