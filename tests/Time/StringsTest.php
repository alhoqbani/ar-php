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
use ArUtil\Time\ArDateTime;

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
    public function it_rerun_hijri_according_to_outpu_mode()
    {
        $arD = ArUtil::date()->arCreate(1438, 10, 19, 2, 15, 30);
        
        $arD->setOutputMode(ArDateTime::ALGERIA_AND_TUNIS);
        $this->assertEquals('الجمعة 14 جويلية 2017 02:15:30 صباحاً', $arD->arFormat('l dS F Y h:i:s A'));
        
        $arD->setOutputMode(ArDateTime::ARABIC_AND_TRANSLITERATION);
        $this->assertEquals('الجمعة 14 تموز/يوليو 2017 02:15:30 صباحاً', $arD->arFormat('l dS F Y h:i:s A'));
        
        $arD->setOutputMode(ArDateTime::ARABIC_MONTH_NAMES);
        $this->assertEquals('الجمعة 14 تموز 2017 02:15:30 صباحاً', $arD->arFormat('l dS F Y h:i:s A'));
        
        $arD->setOutputMode(ArDateTime::HIJRI_FORMAT_IN_ENGLISH);
        $this->assertEquals('Friday 19 Shawwal 1438 02:15:30 AM', $arD->arFormat('l dS F Y h:i:s A'));
        
        $arD->setOutputMode(ArDateTime::LIBYA_STYLE);
        $this->assertEquals('الجمعة 14 ناصر 1385 02:15:30 صباحاً', $arD->arFormat('l dS F Y h:i:s A'));
        
        $arD->setOutputMode(ArDateTime::MOROCCO_STYLE);
        $this->assertEquals('الجمعة 14 يوليوز 2017 02:15:30 صباحاً', $arD->arFormat('l dS F Y h:i:s A'));
        
        $arD->setOutputMode(ArDateTime::ARABIC_TRANSLITERATION);
        $this->assertEquals('الجمعة 14 يوليو 2017 02:15:30 صباحاً', $arD->arFormat('l dS F Y h:i:s A'));
        
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
