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
}
