<?php

namespace ArUtil\Tests\Text;

use ArUtil\ArUtil;
use ArUtil\Tests\AbstractTestCase;

class QueryBuilderTest extends AbstractTestCase
{
    
    /** @test */
    public function it_prepares_single_where_regexp_statement()
    {
        $expectedStatement = "WHERE `title` REGEXP 'book'";
        $query = ArUtil::query()->whereReg('title', 'book');
        $actualStatement = $query->getWheresReg()[0];
        
        $this->assertEquals($expectedStatement, $actualStatement);
        
    }
}