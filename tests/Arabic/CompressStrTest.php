<?php

namespace Tests\Arabic;

use I18N_Arabic_CompressStr;
use Tests\AbstractTestCase;

class CompressStrTest extends AbstractTestCase
{
    
    /**
     * @var I18N_Arabic_CompressStr
     */
    protected $compressStr;
    
    protected function setUp()
    {
        parent::setUp();
        $this->compressStr = new \I18N_Arabic('CompressStr');
    }
    
    /** @test */
    public function it_loads_keySwap_class()
    {
        $this->assertInstanceOf(I18N_Arabic_CompressStr::class, $this->compressStr->myObject);
    }
    
}
