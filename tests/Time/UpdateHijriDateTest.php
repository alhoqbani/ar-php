<?php

namespace ArUtil\Tests\Time;

use ArUtil\ArUtil;
use ArUtil\Time\ArDateTime;
use Carbon\Carbon;

class UpdateHijriDateTest extends AbstractTimeTest
{
    
    /** @test */
    public function it_updates_its_hijri_date_when_carbon_dates_changes()
    {
        $arD = ArUtil::date()->arCreateFromDate(1438, 10, 15);
        $this->assertCarbon($arD, 2017, 7, 10);
        
        $arD->addDays(10);

	    $this->assertArDateTime($arD, 1438, 10, 25);
    }
    
    /** @test */
    public function it_updates_its_hijri_date_when_timestamp_is_updated()
    {
        $arD = ArUtil::date()->arCreateFromDate(1438, 10, 15);
        $this->assertCarbon($arD, 2017, 7, 10);

        $arD->timestamp(1498822449); // - 10 Days

	    $this->assertArDateTime($arD, 1438, 10, 5);
    }
}
