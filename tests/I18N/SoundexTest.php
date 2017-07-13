<?php

namespace ArUtil\Tests\Arabic;

use ArUtil\I18N\Arabic;
use ArUtil\I18N\Soundex;
use ArUtil\Tests\AbstractTestCase;

class SoundexTest extends AbstractTestCase
{
    
    /**
     * @var Soundex
     */
    protected $soundex;
    
    protected function setUp()
    {
        parent::setUp();
        $this->soundex = new Arabic('Soundex');
    }
    
    /** @test */
    public function it_loads_normalise_class()
    {
        $this->assertInstanceOf(Soundex::class, $this->soundex->myObject);
    }
    
    /** @test */
    public function it_returns_phonetically_alike_word_to_given_Arabic_word()
    {
        $actualText  = $this->soundex->soundex('كتاب');

        $this->assertEquals('K310' ,$actualText);
    }
}
