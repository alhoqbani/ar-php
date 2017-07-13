<?php

namespace ArUtil\Tests\Arabic;

use ArUtil\I18N\Arabic;
use ArUtil\I18N\CharsetD;
use ArUtil\Tests\AbstractTestCase;

class CharsetDTest extends AbstractTestCase
{
    
    /**
     * @var CharsetD
     */
    protected $charsetD;
    
    protected function setUp()
    {
        parent::setUp();
        $this->charsetD = new Arabic('CharsetD');
    }
    
    /** @test */
    public function it_loads_charsetD_class()
    {
        $this->assertInstanceOf(CharsetD::class, $this->charsetD->myObject);
    }
    
    /** @test */
    public function it_guess_given_text_charset()
    {
        $text = 'بسم الله الرحمن الرحيم';
        
        $expectedArray = [
            'windows-1256' => 0.0,
            'iso-8859-6'   => 0.0,
            'utf-8'        => 89.0,
        ];
        
        $actualArray = $this->charsetD->guess($text);
        $this->assertEquals($expectedArray, $actualArray);
    }
    
    /** @test */
    public function it_return_guessed_charset()
    {
        $text = 'بسم الله الرحمن الرحيم';
        $expected = 'utf-8';
        $actual = $this->charsetD->getCharset($text);
        
        $this->assertEquals($expected, $actual);
    }
    
    
}
