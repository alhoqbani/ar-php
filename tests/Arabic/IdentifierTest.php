<?php

namespace Tests\Arabic;

use I18N_Arabic_Identifier;
use Tests\AbstractTestCase;

class IdentifierTest extends AbstractTestCase
{
    
    /**
     * @var I18N_Arabic_Identifier
     */
    protected $identifier;
    
    protected function setUp()
    {
        parent::setUp();
        $this->identifier = new \I18N_Arabic('Identifier');
    }
    
    /** @test */
    public function it_loads_keySwap_class()
    {
        $this->assertInstanceOf(I18N_Arabic_Identifier::class, $this->identifier->myObject);
    }
}
