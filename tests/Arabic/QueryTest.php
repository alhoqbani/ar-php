<?php

namespace Tests\Arabic;

use I18N_Arabic_Query;
use Tests\AbstractTestCase;

class QueryTest extends AbstractTestCase
{
    
    /**
     * @var I18N_Arabic_Query
     */
    protected $query;
    
    protected function setUp()
    {
        parent::setUp();
        $this->query = new \I18N_Arabic('Query');
    }
    
    /** @test */
    public function it_loads_query_class()
    {
        $this->assertInstanceOf(I18N_Arabic_Query::class, $this->query->myObject);
    }
    
    /** @test */
    public function set_and_get_search_fields_from_string()
    {
        $this->assertEquals("name, title", $this->query->setStrFields("name, title")->getStrFields());
    }
    
    /** @test */
    public function set_and_get_search_fields_from_array()
    {
        $fields = ["name, title"];
        $this->assertEquals($fields, $this->query->setArrFields($fields)->getArrFields());
    }
    
    /** @test */
    public function set_and_get_search_mode()
    {
        $this->markTestSkipped('Conflict with Date::method should be fixed first, see #20');
        $this->assertEquals(0, $this->query->setMode(0)->getMode());
        $this->assertEquals(1, $this->query->setMode(1)->getMode());
    }
    
    /** @test */
    public function it_return_the_where_condition_based_on_single_search_term()
    {
        $this->assertEquals(
            "( REPLACE(, 'ـ', '') REGEXP 'فلسط(ين)?')",
            $this->query->getWhereCondition('فلسطين')
        );
    }
    
    /** @test */
    public function it_return_the_where_condition_based_on_multiple_search_term()
    {
        
        $this->assertEquals("( REPLACE(, 'ـ', '') REGEXP 'فلسط(ين)?') OR ( REPLACE(, 'ـ', '') REGEXP 'حر(ة|(ا|أ|إ|آ)ت)?')",
            $this->query->getWhereCondition('فلسطين حرة')
        );
    }
    
    /** @test */
    public function it_return_the_where_condition_based_on_multiple_search_term_with_phrase_term()
    {
        $this->assertEquals("( LIKE 'نص كامل\') OR ( REPLACE(, 'ـ', '') REGEXP 'فلسط(ين)?') OR ( REPLACE(, 'ـ', '') REGEXP '\') OR ( REPLACE(, 'ـ', '') REGEXP 'حر(ة|(ا|أ|إ|آ)ت)?')",
            $this->query->getWhereCondition('فلسطين "نص كامل" حرة')
        );
    }
    
    /** @test */
    public function it_return_the_order_by_clause_based_on_search_term()
    {
        $this->assertEquals("(( LIKE 'عن مخرجات') + (CASE WHEN  REPLACE(, 'ـ', '') REGEXP '((ا|أ|إ|آ)ل)?بحث' THEN 1 ELSE 0 END) + (CASE WHEN  REPLACE(, 'ـ', '') REGEXP 'جيد(ة|(ا|أ|إ|آ)ت)?' THEN 1 ELSE 0 END)) DESC",
            $this->query->getOrderBy('البحث "عن مخرجات" جيدة'));
    }
    
}
