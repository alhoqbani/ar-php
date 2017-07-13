<?php

namespace ArUtil\Tests\Arabic;

use ArUtil\Arabic;
use ArUtil\Identifier;
use ArUtil\Tests\AbstractTestCase;

class IdentifierTest extends AbstractTestCase
{
    
    /**
     * @var Identifier
     */
    protected $identifier;
    
    protected function setUp()
    {
        parent::setUp();
        $this->identifier = new Arabic('Identifier');
    }
    
    /** @test */
    public function it_loads_keySwap_class()
    {
        $this->assertInstanceOf(Identifier::class, $this->identifier->myObject);
    }
    
    /** @test */
    public function it_identify_Arabic_text_in_a_given_UTF8_multi_language_string()
    {
        $text = <<<END
كل شعوب العالم تفضل السلام علي الحرب The people of the world prefer peace to war
The Internet Internationalization
(I18N) community, which values diversity and human life everywhere
والتي تأخذ بعين
التقدير الاختلافات الثقافية والعادات الحياتية
מעדיפים את השלום על-פני המלחמה והם
مجموعة تدويل الإنترنت
END;
        $expectedArray = [0, 67, 212, 328, 391,];
        
        $actualArray = $this->identifier->identify($text);
        
        $this->assertEquals($expectedArray, $actualArray);
    }
    
    /** @test */
    public function it_detects_Arabic_text()
    {
        $this->assertTrue($this->identifier->isArabic('كل شعوب العالم تفضل السلام علي الحرب'));
        $this->assertFalse($this->identifier->isArabic('The people of the world prefer peace to war'));
        $this->assertFalse($this->identifier->isArabic('The people of the world كل شعوب العالم'));
    }
    
    
}
