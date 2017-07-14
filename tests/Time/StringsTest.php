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

use ArUtil\ArUtil;

class StringsTest extends AbstractTimeTest
{
    
    /** @test */
    public function it_rerun_hijri_string_date()
    {
        $arD = ArUtil::date()->arCreate(1438, 10, 19, 02, 21, 39);
        $expectedText = 'الجمعة 19 شوال 1438 02:21:39 صباحاً';
        $actualText = $arD->arFormat('l dS F Y h:i:s A');
        $this->assertEquals($expectedText, $actualText);
    }
    
    /** @test */
    public function it_rerun_hijri_string_date_for_day_only()
    {
        $arD = ArUtil::date()->arCreate(1438, 10, 19);
        $this->assertEquals(19, $arD->arFormat('j'));
    }
    
    /** @test */
    public function it_rerun_hijri_in_date_time_string()
    {
        $arD = ArUtil::date()->arCreate(1438, 10, 19, 20, 21, 39);
        $this->assertEquals('1438-10-19 20:21:39', $arD->arToDateTimeString());
    }
    
    /** @test */
    public function it_rerun_hijri_in_day_date_time_string()
    {
        $arD = ArUtil::date()->arCreate(1438, 10, 19, 20, 21, 39);
        $this->assertEquals('الجمعة, شوال 19, 1438 8:21 مساءً', $arD->arToDayDateTimeString());
    }
    
    /** @test */
    public function it_rerun_hijri_in_date_string()
    {
        $arD = ArUtil::date()->arCreate(1438, 10, 19, 20, 21, 39);
        $this->assertEquals('1438-10-19', $arD->arToDateString());
    }
}
