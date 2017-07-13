<?php

namespace ArUtil\Tests\Time;

use ArUtil\ArUtil;
use Carbon\Carbon;
use ArUtil\Tests\AbstractTestCase;

class CreateFromDateTest extends AbstractTestCase
{
    
    /** @test */
    public function it_create_from_date()
    {
        $expected = Carbon::createFromDate(1985, 05, 01);
        $actual = ArUtil::date()->arCreateFromDate(1405, 8, 10);
        
        $this->assertEquals($expected, $actual);
    }
}
