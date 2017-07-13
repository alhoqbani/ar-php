<?php

namespace ArUtil\Tests\Time;

use ArUtil\ArUtil;
use ArUtil\I18N\Date;

class GettersTest extends AbstractTimeTest
{
    
    /** @test */
    public function it_return_today_hijri_date()
    {
        list($arYear, $arMonth, $arDay) = (new Date())->hjConvert(date('Y'), date('m'), date('d'));
        $arD = ArUtil::date();
        $this->assertEquals($arDay, $arD->arDay);
    }
    
    /** @test */
    public function it_return_today_hijri_month()
    {
        list($arYear, $arMonth, $arDay) = (new Date())->hjConvert(date('Y'), date('m'), date('d'));
        $arD = ArUtil::date();
        $this->assertEquals($arMonth, $arD->arMonth);
    }
    
    /** @test */
    public function it_return_today_hijri_year()
    {
        list($arYear, $arMonth, $arDay) = (new Date())->hjConvert(date('Y'), date('m'), date('d'));
        $arD = ArUtil::date();
        $this->assertEquals($arYear, $arD->arYear);
    }
}
