<?php

namespace ArUtil\Tests\Time;

use Carbon\Carbon;
use ArUtil\Time\ArDateTime;

class ArDateTimeTest extends TimeAbstractTest
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
}
