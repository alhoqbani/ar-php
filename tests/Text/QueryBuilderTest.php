<?php

namespace ArUtil\Tests\Text;

use ArUtil\ArUtil;
use ArUtil\I18N\Arabic;
use ArUtil\Tests\AbstractTestCase;

class QueryBuilderTest extends AbstractTestCase
{
    
    /**
     * @var \ArUtil\Text\QueryBuilder
     */
    protected $arQ;
    
    protected function setUp()
    {
        parent::setUp();
        new Arabic('Numbers');
        $this->arQ = ArUtil::query();
    }
    
    protected function tearDown()
    {
        unset($this->arQ);
        parent::tearDown();
    }
    
    /** @test */
    public function it_prepares_single_where_regexp_statement()
    {
        $expectedStatement = [
            'field'   => 'title',
            'value'   => 'book',
            'pattern' => 'book',
            'boolean' => 'and',
        ];
        $this->arQ->whereReg('title', 'book');
        $actualStatement = $this->arQ->getWheresReg()[0];
        
        $this->assertEquals($expectedStatement, $actualStatement);
        
    }
    
    /** @test */
    public function it_prepares_multiple_where_regexp_statements()
    {
        $this->arQ->whereReg('title', 'book');
        $this->arQ->whereReg('title', 'book');
        $this->arQ->whereReg('title', 'book');
        
        $this->assertCount(3, $this->arQ->getWheresReg());
    }
    
    /** @test */
    public function it_assigns_the_boolean_operator()
    {
        $this->arQ->whereReg('title', 'book');
        $this->assertEquals('and', $this->arQ->getWheresReg()[0]['boolean']);
        
        $this->arQ->whereReg('title', 'book', 'or');
        $this->assertEquals('or', $this->arQ->getWheresReg()[1]['boolean']);
    }
    
    /** @test */
    public function it_splits_sentences_into_multiple_clauses()
    {
        $this->arQ->whereReg('title', 'مؤتمر أبل للمطورين');
        $wheres = $this->arQ->getWheresReg();
        
        $this->assertCount(3, $wheres);
    }
    
    /** @test */
    public function it_defines_which_select_column_of_sql_statement()
    {
        $this->arQ->select(['id', 'body', 'text']);
        $this->assertEquals(' `id`, `body`, `text` ', $this->arQ->getColumns());
    }
    
    /** @test */
    public function it_regexpy_all_values_of_where_statement()
    {
        $expectedPattern = '(ا|أ|إ|آ)بل';
        
        $this->arQ->whereReg('title', 'أبل');
        $actualPattern = $this->arQ->getWheresReg()[0]['pattern'];
        
        $this->assertEquals($expectedPattern, $actualPattern);
        
    }
    
    /** @test */
    public function it_returns_regexp_pattern_for_single_word()
    {
        $expectedPattern = '(ا|أ|إ|آ)بل';
        $actualPattern = $this->arQ->regexpy('أبل');
        
        $this->assertEquals($expectedPattern, $actualPattern);
    }
    
    /** @test */
    public function it_returns_array_of_regexp_patterns_for_sentence()
    {
        $expectedRegex = [
            '(ا|أ|إ|آ)بل',
            'للح(ا|أ|إ|آ)سب(ة|(ا|أ|إ|آ)ت)?',
        ];
        $actualPattern = $this->arQ->regexpy('أبل للحاسبات');
        
        $this->assertEquals($expectedRegex, $actualPattern);
    }
    
    /** @test */
    public function it_returns_array_of_regexp_patterns_for_array_of_words()
    {
        $expectedRegex = [
            '(ا|أ|إ|آ)بل',
            'للح(ا|أ|إ|آ)سب(ة|(ا|أ|إ|آ)ت)?',
        ];
        $actualPattern = $this->arQ->regexpy(['أبل', 'للحاسبات']);
        
        $this->assertEquals($expectedRegex, $actualPattern);
    }
    
}
