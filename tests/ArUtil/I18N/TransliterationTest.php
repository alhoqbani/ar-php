<?php

namespace ArUtil\Tests\Arabic;

use ArUtil\Arabic;
use ArUtil\Transliteration;
use ArUtil\Tests\AbstractTestCase;

class TransliterationTest extends AbstractTestCase
{
    
    /**
     * @var Transliteration
     */
    protected $transliterator;
    
    protected function setUp()
    {
        parent::setUp();
        $this->transliterator = new Arabic('Transliteration');
    }
    
    /** @test */
    public function it_loads_normalise_class()
    {
        $this->assertInstanceOf(Transliteration::class, $this->transliterator->myObject);
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
    
    /** @test */
    public function it_renders_Arabic_numbers_as_html_entites()
    {
        $actualText = $this->transliterator->enNum(345 . ' Text in between ' . 34543 . 'مع نص عربي');
        $expectText = '&#x33;&#x34;&#x35; Text in between &#x33;&#x34;&#x35;&#x34;&#x33;مع نص عربي';
        
        $this->assertEquals($expectText, $actualText);
        
    }
    
    /** @test */
    public function it_renders_numbers_into_indian_digits_as_html_entities()
    {
        $actualText = $this->transliterator->arNum('323423' . ' Text in between ' . '23434' . 'ورقم ٢٣٤,٣٤ مع نص عربي');
        $expectText = '&#x0663;&#x0662;&#x0663;&#x0664;&#x0662;&#x0663; Text in between &#x0662;&#x0663;&#x0664;&#x0663;&#x0664;ورقم ٢٣٤,٣٤ مع نص عربي';

        $this->assertEquals($expectText, $actualText);
        
    }
    
}
