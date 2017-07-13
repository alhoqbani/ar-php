<?php

namespace ArUtil\Tests\Time;

use ArUtil\ArUtil;
use Carbon\Carbon;

class CreateFromDateTest extends TimeAbstractTest
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
}
