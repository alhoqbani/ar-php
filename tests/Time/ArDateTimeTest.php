<?php

namespace ArUtil\Tests\Time;

use ArUtil\ArUtil;
use ArUtil\I18N\Date;
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
    
}
