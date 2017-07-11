<?php

namespace Tests\Arabic;

use I18N_Arabic_KeySwap;
use Tests\AbstractTestCase;

class KeySwapTest extends AbstractTestCase
{
    
    /**
     * @var I18N_Arabic_KeySwap
     */
    protected $keySwap;
    
    protected function setUp()
    {
        parent::setUp();
        $this->keySwap = new \I18N_Arabic('KeySwap');
    }
    
    /** @test */
    public function it_loads_keySwap_class()
    {
        $this->assertInstanceOf(I18N_Arabic_KeySwap::class, $this->keySwap->myObject);
    }
    
    /** @test */
    public function it_swap_English_keyboards_strokes_with_Arabic()
    {
        $text = "Hpf lk hgkhs hglj'vtdkK Hpf hg`dk dldg,k f;gdjil Ygn ,p]hkdm hgHl,v tb drt,k ljv]]dk fdk krdqdk>";
        $expectedText = 'أحب من الناس المتطرفين، أحب الذين يميلون بكليتهم إلى وحدانية الأمور فلا يقفون مترددين بين نقيضين.';
        
        $actualText = $this->keySwap->swapEa($text);
        
        $this->assertEquals($expectedText, $actualText);
        
    }
    
    /** @test */
    public function it_swap_French_keyboard_strokes_with_Arabic()
    {
        $text = 'Hpf lk hgkhs hgljùvtdkK Hpf hg²dk dldg;k fmgdjil Ygn ;p$hkd, hgHl;v tb drt;k ljv$$dk fdk krdadk/';
        $expectedText = 'أحب من الناس المتطرفين، أحب الذين يميلون بكليتهم إلى وحدانية الأمور فلا يقفون مترددين بين نقيضين.';
        
        $actualText = $this->keySwap->swapFa($text);
        
        $this->assertEquals($expectedText, $actualText);
        
    }
    
    /** @test */
    public function it_swap_Arabic_keyboard_strokes_with_English()
    {
        $text = "ِىغ هىفثممهلثىف بخخم ؤشى ةشنث فاهىلس لاهللثق ةخقث ؤخةحمثء شىي ةخقث رهخمثىفز ÷ف فشنثس ش فخعؤا خب لثىهعس شىي ش مخف خب ؤخعقشلث فخ ةخرث هى فاث خححخسهفث يهقثؤفهخىز";
        $expectedText = 'Any intelligent fool can make things ghigger more complex and more violent. It takes a touch of genius and a lot of courage to move in the opposite direction.';
        
        $actualText = $this->keySwap->swapAe($text);
        
        $this->assertEquals($expectedText, $actualText);
    }
    
    /** @test */
    public function it_detects_the_language_of_content_supplied()
    {
        $this->assertEquals('ببطئ لكن بثبات', $this->keySwap->fixKeyboardLang("ff'z g;k fefhj"));
        $this->assertEquals('ببطئ لكن بثبات', $this->keySwap->fixKeyboardLang("FF'Z G;K FEFHJ"));
        $this->assertEquals('Slowly ghut surely', $this->keySwap->fixKeyboardLang("ٍمخصمغ لاعف سعقثمغ"));
        $this->assertEquals('Slowly but surely', $this->keySwap->fixKeyboardLang("sLOWLY BUT SURELY"));
    }
}
