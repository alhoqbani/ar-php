<?php

namespace ArUtil\Tests\Arabic;

use Query;
use ArUtil\Arabic;
use ArUtil\Tests\AbstractTestCase;

class QueryTest extends AbstractTestCase
{
    
    /**
     * @var Query
     */
    protected $Query;
    
    protected function setUp()
    {
        parent::setUp();
        $this->Query = new Arabic('Query');
    }
    
    /** @test */
    public function it_loads_Query_class()
    {
        $this->assertInstanceOf(Query::class, $this->Query->myObject);
    }
    
    /** @test */
    public function set_and_get_search_fields_from_string()
    {
        $this->assertEquals("name, title", $this->Query->setStrFields("name, title")->getStrFields());
    }
    
    /** @test */
    public function set_and_get_search_fields_from_array()
    {
        $fields = ["name, title"];
        $this->assertEquals($fields, $this->Query->setArrFields($fields)->getArrFields());
    }
    
    /** @test */
    public function set_and_get_search_mode()
    {
        $this->markTestSkipped('Conflict with Date::method should be fixed first, see #20');
        $this->assertEquals(0, $this->Query->setMode(0)->getMode());
        $this->assertEquals(1, $this->Query->setMode(1)->getMode());
    }
    
    /** @test */
    public function it_return_the_where_condition_based_on_single_search_term()
    {
        $this->assertEquals(
            "( REPLACE(, 'ـ', '') REGEXP 'فلسط(ين)?')",
            $this->Query->getWhereCondition('فلسطين')
        );
    }
    
    /** @test */
    public function it_return_the_where_condition_based_on_multiple_search_term()
    {
        
        $this->assertEquals("( REPLACE(, 'ـ', '') REGEXP 'فلسط(ين)?') OR ( REPLACE(, 'ـ', '') REGEXP 'حر(ة|(ا|أ|إ|آ)ت)?')",
            $this->Query->getWhereCondition('فلسطين حرة')
        );
    }
    
    /** @test */
    public function it_return_the_where_condition_based_on_multiple_search_term_with_phrase_term()
    {
        $this->assertEquals("( LIKE 'نص كامل\') OR ( REPLACE(, 'ـ', '') REGEXP 'فلسط(ين)?') OR ( REPLACE(, 'ـ', '') REGEXP '\') OR ( REPLACE(, 'ـ', '') REGEXP 'حر(ة|(ا|أ|إ|آ)ت)?')",
            $this->Query->getWhereCondition('فلسطين "نص كامل" حرة')
        );
    }
    
    /** @test */
    public function it_return_the_order_by_clause_based_on_search_term()
    {
        $this->assertEquals("(( LIKE 'عن مخرجات') + (CASE WHEN  REPLACE(, 'ـ', '') REGEXP '((ا|أ|إ|آ)ل)?بحث' THEN 1 ELSE 0 END) + (CASE WHEN  REPLACE(, 'ـ', '') REGEXP 'جيد(ة|(ا|أ|إ|آ)ت)?' THEN 1 ELSE 0 END)) DESC",
            $this->Query->getOrderBy('البحث "عن مخرجات" جيدة'));
    }
    
    /** @test */
    public function it_return_all_forms_of_search_term()
    {
        $this->assertEquals('البحث بحث "عن مخرجات" جيدة جيد جيده جيدت جيدات',
            $this->Query->allForms('البحث "عن مخرجات" جيدة'));
    }
    
}
