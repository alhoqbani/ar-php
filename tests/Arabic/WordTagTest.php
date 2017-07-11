<?php

namespace Tests\Arabic;

use I18N_Arabic_WordTag;
use Tests\AbstractTestCase;

class WordTagTest extends AbstractTestCase
{

    /**
     * @var I18N_Arabic_WordTag
     */
    protected $wordTag;

    protected function setUp()
    {
        parent::setUp();
        $this->wordTag = new \I18N_Arabic('WordTag');
    }

    /** @test */
    public function it_loads_normalise_class()
    {
        $this->assertInstanceOf(I18N_Arabic_WordTag::class, $this->wordTag->myObject);
    }
    
    /** @test */
    public function it_detect_nouns()
    {
        $this->assertTrue($this->wordTag->isNoun('محمد', 'مع'));
        $this->assertFalse($this->wordTag->isNoun('يذهب', 'و'));
    }
    
}
