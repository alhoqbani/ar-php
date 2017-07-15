<?php

namespace ArUtil\Tests\Text;

use ArUtil\ArUtil;
use ArUtil\Tests\AbstractTestCase;

class QueryBuilderTest extends AbstractTestCase
{
    
    /** @test */
    public function it_prepares_single_where_regexp_statement()
    {
        $expectedStatement = [
            'field'   => 'title',
            'value'   => 'book',
            'pattern' => 'book',
            'boolean' => 'and',
        ];
        $query = ArUtil::query()->whereReg('title', 'book');
        $actualStatement = $query->getWheresReg()[0];
        
        $this->assertEquals($expectedStatement, $actualStatement);
        
    }
    
    /** @test */
    public function it_prepares_multiple_where_regexp_statements()
    {
        $query = ArUtil::query()->whereReg('title', 'book');
        $query->whereReg('title', 'book');
        $query->whereReg('title', 'book');
        
        $this->assertCount(3, $query->getWheresReg());
    }
    
    /** @test */
    public function it_assigns_the_boolean_operator()
    {
        $query = ArUtil::query()->whereReg('title', 'book');
        $this->assertEquals('and', $query->getWheresReg()[0]['boolean']);
        
        $query = ArUtil::query()->whereReg('title', 'book', 'or');
        $this->assertEquals('or', $query->getWheresReg()[0]['boolean']);
    }
    
    
    /** @test */
    public function it_regexpy_all_values_of_where_statement()
    {
        $expectedPattern = '(ا|أ|إ|آ)بل';
        
        $query = ArUtil::query()->whereReg('title', 'أبل');
        $actualPattern = $query->getWheresReg()[0]['pattern'];
        
        $this->assertEquals($expectedPattern, $actualPattern);
        
    }
    
    /** @test */
    public function it_returns_regexp_pattern_for_single_word()
    {
        $expectedPattern = '(ا|أ|إ|آ)بل';
        $actualPattern = ArUtil::query()->regexpy('أبل');
        
        $this->assertEquals($expectedPattern, $actualPattern);
    }
    
    /** @test */
    public function it_returns_array_of_regexp_patterns_for_sentence()
    {
        $expectedRegex = [
            '(ا|أ|إ|آ)بل',
            'للح(ا|أ|إ|آ)سب(ة|(ا|أ|إ|آ)ت)?',
        ];
        $actualPattern = ArUtil::query()->regexpy('أبل للحاسبات');
        
        $this->assertEquals($expectedRegex, $actualPattern);
    }
    
    /** @test */
    public function it_returns_array_of_regexp_patterns_for_array_of_words()
    {
        $expectedRegex = [
            '(ا|أ|إ|آ)بل',
            'للح(ا|أ|إ|آ)سب(ة|(ا|أ|إ|آ)ت)?',
        ];
        $actualPattern = ArUtil::query()->regexpy(['أبل', 'للحاسبات']);
        
        $this->assertEquals($expectedRegex, $actualPattern);
    }
    
}
