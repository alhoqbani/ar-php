<?php

namespace Tests\Arabic;

use I18N_Arabic_KeySwap;
use Tests\AbstractTestCase;

class KeySwapTest extends AbstractTestCase
{
    
    /**
     * @var I18N_Arabic_KeySwap
     */
    protected $keySwap;
    
    protected function setUp()
    {
        parent::setUp();
        $this->keySwap = new \I18N_Arabic('KeySwap');
    }
    
    /** @test */
    public function it_loads_keySwap_class()
    {
        $this->assertInstanceOf(I18N_Arabic_KeySwap::class, $this->keySwap->myObject);
    }
}
