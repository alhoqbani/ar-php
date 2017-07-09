<?php

namespace Tests\Arabic;

use I18N_Arabic_Glyphs;
use Tests\AbstractTestCase;

class GlyphsTest extends AbstractTestCase
{
    
    
    /**
     * @var I18N_Arabic_Glyphs
     */
    protected $glyphs;
    
    protected function setUp()
    {
        parent::setUp();
        $this->glyphs = new \I18N_Arabic('Glyphs');
    }
    
    protected function tearDown()
    {
        parent::tearDown();
    }
    
    
    /** @test */
    public function it_loads_date_class()
    {
        $this->assertInstanceOf(I18N_Arabic_Glyphs::class, $this->glyphs->myObject);
    }
}
