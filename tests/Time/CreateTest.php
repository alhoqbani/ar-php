<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ArUtil\Tests\Time;

use ArUtil\Time\ArDateTime;
use Carbon\Carbon;
use DateTimeZone;

class CreateTest extends AbstractTimeTest
{
    
    public function testCreateReturnsDatingInstance()
    {
        $arD = ArDateTime::arCreate();
        $this->assertInstanceOf(Carbon::class, $arD);
    }
    
    public function testCreateWithDefaults()
    {
        $arD = ArDateTime::arCreate();
        $this->assertSame($arD->getTimestamp(), Carbon::now()->getTimestamp());
    }
    
    public function testCreateWithYear()
    {
        $arD = ArDateTime::arCreate(1430);
        $this->assertSame(1430, $arD->arYear);
    }
    
    public function testCreateWithMonth()
    {
        $d = ArDateTime::arCreate(null, 3);
        $this->assertSame(3, $d->arMonth);
    }
    
    public function testCreateWithDay()
    {
        $d = ArDateTime::arCreate(null, null, 21);
        $this->assertSame(21, $d->arDay);
    }
    
    public function testCreateWithHourAndDefaultMinSecToZero()
    {
        $d = ArDateTime::arCreate(null, null, null, 14);
        $this->assertSame(14, $d->hour);
        $this->assertSame(0, $d->minute);
        $this->assertSame(0, $d->second);
    }
    
    public function testCreateWithMinute()
    {
        $d = ArDateTime::arCreate(null, null, null, null, 58);
        $this->assertSame(58, $d->minute);
    }
    
    public function testCreateWithSecond()
    {
        $d = ArDateTime::arCreate(null, null, null, null, null, 59);
        $this->assertSame(59, $d->second);
    }
    
    public function testCreateWithDateTimeZone()
    {
        $d = ArDateTime::arCreate(1405, 8, 10, 0, 0, 0, new DateTimeZone('Europe/London'));
        $this->assertCarbon($d, 1985, 5, 1, 0, 0, 0);
        $this->assertSame('Europe/London', $d->tzName);
    }
    
    public function testCreateWithTimeZoneString()
    {
        $d = ArDateTime::arCreate(1405, 8, 10, 0, 0, 0, 'Europe/London');
        $this->assertCarbon($d, 1985, 5, 1, 0, 0, 0);
        $this->assertSame('Europe/London', $d->tzName);
    }
	
	/** @test */
	public function testCreateWithDateCorrectionFactor()
	{
		$arD = ArDateTime::arCreate(1430, 10, 15, null, null, null, null, -1);
		$this->assertCarbon($arD, 2009, 10, 4);
	}
	
}
