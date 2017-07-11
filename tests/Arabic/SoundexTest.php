<?php

namespace Tests\Arabic;

use I18N_Arabic_Soundex;
use Tests\AbstractTestCase;

class SoundexTest extends AbstractTestCase
{
    
    /**
     * @var I18N_Arabic_Soundex
     */
    protected $soundex;
    
    protected function setUp()
    {
        parent::setUp();
        $this->soundex = new \I18N_Arabic('Soundex');
    }
    
    /** @test */
    public function it_loads_normalise_class()
    {
        $this->assertInstanceOf(I18N_Arabic_Soundex::class, $this->soundex->myObject);
    }
    
}
