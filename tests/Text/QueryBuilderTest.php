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
            'field'   => '`title`',
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
    public function it_defines_which_table_to_search()
    {
        $this->arQ->from('posts');
        $this->assertEquals('`posts`', $this->arQ->getTable());
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
    public function it_return_full_sol_statement()
    {
        $this->arQ->select(['id', 'title', 'body'])->from('posts')->whereReg('title', 'العالمين');
        $expectedStatement = "SELECT `id`, `title`, `body` FROM `posts` WHERE `title` REGEXP '((ا|أ|إ|آ)ل)?ع(ا|أ|إ|آ)لم(ين)?'";
        
        $this->assertEquals($expectedStatement, $this->arQ->toFullSql());
    }
    
    /** @test */
    public function it_return_full_sol_statement_with_multiple_wheres()
    {
        $this->arQ->select(['id', 'title', 'body'])->from('posts')->whereReg('title', 'book');
        $this->arQ->whereReg('text', 'paper');
        $expectedSql = "SELECT `id`, `title`, `body` FROM `posts` WHERE `title` REGEXP 'book' AND `text` REGEXP 'paper'";
        $this->assertEquals($expectedSql, $this->arQ->toFullSql());
    }
    
    /** @test */
    public function it_return_full_sol_statement_with_multiple_and_and_or_wheres()
    {
        $this->arQ->select(['id', 'title', 'body'])->from('posts')->whereReg('title', 'book');
        $this->arQ->whereReg('text', 'paper', 'OR');
        $this->arQ->whereReg('body', 'someBody');
        $expectedSql = "SELECT `id`, `title`, `body` FROM `posts` WHERE `title` REGEXP 'book' AND `body` REGEXP 'someBody' OR `text` REGEXP 'paper'";
        $this->assertEquals($expectedSql, $this->arQ->toFullSql());
    }
    
    /** @test */
    public function it_return_full_sol_statement_with_multiple_terms()
    {
        $this->arQ->select(['id', 'title', 'body'])->from('posts')->whereReg('title', 'book wa other book');
        $this->arQ->whereReg('text', 'paper plastic', 'OR');
        $this->arQ->whereReg('body', 'someBody');
        $expectedSql = "SELECT `id`, `title`, `body` FROM `posts` WHERE `title` REGEXP 'book' ";
        $expectedSql .= "AND `title` REGEXP 'wa' AND `title` REGEXP 'other' AND `title` REGEXP 'book' ";
        $expectedSql .= "OR `text` REGEXP 'paper' OR `text` REGEXP 'plastic' AND `body` REGEXP 'someBody'";
        $this->assertEquals($expectedSql, $this->arQ->toFullSql());
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
