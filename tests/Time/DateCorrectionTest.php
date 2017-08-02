<?php

namespace ArUtil\Tests\Time;

use ArUtil\ArUtil;
use Carbon\Carbon;
use ArUtil\Time\ArDateTime;

class DateCorrectionTest extends AbstractTimeTest
{
	/** @test */
	public function it_set_the_default_correction_date()
	{
	    $arD = ArUtil::date()->arCreateFromDate(1430, 10, 15, null, -1);
	    
	    $this->assertArDateTime($arD, 1430, 10, 15);
	    $this->assertCarbon($arD, 2009, 10, 4);
	}
}
