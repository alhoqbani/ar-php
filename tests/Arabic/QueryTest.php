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
    
}
