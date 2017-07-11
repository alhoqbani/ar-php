<?php

namespace Tests\Arabic;

use I18N_Arabic_CharsetD;
use Tests\AbstractTestCase;

class CharsetDTest extends AbstractTestCase
{
    
    /**
     * @var I18N_Arabic_CharsetD
     */
    protected $charsetD;
    
    protected function setUp()
    {
        parent::setUp();
        $this->charsetD = new \I18N_Arabic('CharsetDTest');
    }
    
    /** @test */
    public function it_loads_charsetD_class()
    {
        $this->assertInstanceOf(I18N_Arabic_CharsetD::class, $this->charsetD->myObject);
    }
}
