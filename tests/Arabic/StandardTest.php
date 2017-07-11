<?php

namespace Tests\Arabic;

use I18N_Arabic_Standard;
use Tests\AbstractTestCase;

class StandardTest extends AbstractTestCase
{
    
    /**
     * @var I18N_Arabic_Standard
     */
    protected $standard;
    
    protected function setUp()
    {
        parent::setUp();
        $this->standard = new \I18N_Arabic('Standard');
    }
    
    /** @test */
    public function it_loads_normalise_class()
    {
        $this->assertInstanceOf(I18N_Arabic_Standard::class, $this->standard->myObject);
    }
    
    
}
