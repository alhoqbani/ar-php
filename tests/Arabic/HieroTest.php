<?php

namespace Tests\Arabic;

use I18N_Arabic_Hiero;
use Tests\AbstractTestCase;

class HieroTest extends AbstractTestCase
{
    
    /**
     * @var I18N_Arabic_Hiero
     */
    protected $hiero;
    
    protected function setUp()
    {
        parent::setUp();
        $this->hiero = new \I18N_Arabic('Hiero');
    }
    
    /** @test */
    public function it_loads_hiero_class()
    {
        $this->assertInstanceOf(I18N_Arabic_Hiero::class, $this->hiero->myObject);
    }
    
}
