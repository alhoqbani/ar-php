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
    
    /** @test */
    public function it_compress()
    {
        $compressedText = $this->compressStr->compress('بسم الله الرحمن الرحيم');
        
        $this->assertEquals(16, strlen($compressedText));
    }
    
    /** @test */
    public function it_decompress()
    {
        $compressedText = $this->compressStr->compress('بسم الله الرحمن الرحيم');
        $this->assertEquals(16, strlen($compressedText));
    
        $decompressedText = $this->compressStr->decompress($compressedText);
        $this->assertEquals(41, strlen($decompressedText));
    }
    
    /** @test */
    public function it_can_search_compressed_text()
    {
        $compressedText = $this->compressStr->compress('بسم الله الرحمن الرحيم');
        $this->assertEquals(16, strlen($compressedText));
        
        $this->assertTrue($this->compressStr->search($compressedText, 'الرحمن'));
        $this->assertFalse($this->compressStr->search($compressedText, 'البحث'));
    }
    
    /** @test */
    public function it_retrieve_the_original_string_length()
    {
        $compressedText = $this->compressStr->compress('بسم الله الرحمن الرحيم');
        $this->assertEquals(16, strlen($compressedText));
        
        $this->assertEquals(22, $this->compressStr->length($compressedText));
    }
    
}
