<?php

namespace Tests\Arabic;

use I18N_Arabic_Transliteration;
use Tests\AbstractTestCase;

class Transliteration extends AbstractTestCase
{
    
    /**
     * @var I18N_Arabic_Transliteration
     */
    protected $transliterator;
    
    protected function setUp()
    {
        parent::setUp();
        $this->transliterator = new \I18N_Arabic('Transliteration');
    }
    
    /** @test */
    public function it_loads_normalise_class()
    {
        $this->assertInstanceOf(I18N_Arabic_Transliteration::class, $this->transliterator->myObject);
    }
    
    /** @test */
    public function it_transliterate_English_string_into_Arabic()
    {
        $text = 'This text will be converted into Arabic letters';
        $expectedText = ' ذيس تكست ويل ب كونفرتد انتو ارابيك لترس';
        $actualText = $this->transliterator->en2ar($text); // Extra space ?!
        
        $this->assertEquals($expectedText, $actualText);
    }
    
    /** @test */
    public function it_transliterate_Arabic_string_into_English()
    {
        $text = 'هذا النص سوف يكتب بأحرف إنجليزية';
        $expectedText = " Hdha An-Ns Swf Yktb B'ahrf Injlyzyh"; // Extra space ?!
        $actualText = $this->transliterator->ar2en($text);
    
        $this->assertEquals($expectedText, $actualText);
    
    }
    
}
