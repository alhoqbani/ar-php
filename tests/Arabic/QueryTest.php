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
    
}
