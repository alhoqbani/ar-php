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
}
