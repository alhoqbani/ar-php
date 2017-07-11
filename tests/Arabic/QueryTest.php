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
    
}
