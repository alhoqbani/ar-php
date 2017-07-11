<?php

namespace Tests\Arabic;

use I18N_Arabic_Numbers;
use Tests\AbstractTestCase;

class NumbersTest extends AbstractTestCase
{
    
    /**
     * @var I18N_Arabic_Numbers
     */
    protected $numbers;
    
    protected function setUp()
    {
        parent::setUp();
        $this->numbers = new \I18N_Arabic('Numbers');
    }
    
    /** @test */
    public function it_loads_numbers_class()
    {
        $this->assertInstanceOf(I18N_Arabic_Numbers::class, $this->numbers->myObject);
    }
    
    /** @test */
    public function it_can_convert_arabic_idiom_number_string_into_integer()
    {
        $arabic_idiom  = ' أربعة مليارات وخمسة وخمسون مليونًا وأربعة عشرة ألفًا ,تسعة وثلاثون ';
        $int = $this->numbers->str2int($arabic_idiom);
        
        $expected_int = 4055014039;
        
        $this->assertEquals(
            $expected_int,
            $int,
            "The arabic idiom:\n{$arabic_idiom}\n should be {$expected_int}, but got {$int}"
        );
    }
    
    /** @test */
    public function it_translate_integers_to_arabic_indic_digits()
    {
        $integer_to_convert = 12390;
        $expected_india_digits = '١٢٣٩٠';
        
        $indic_digits = $this->numbers->int2indic($integer_to_convert);
        
        $this->assertEquals(
            $expected_india_digits,
            $indic_digits,
            sprintf("The converted indic numbers should be: \n%s\nbut got: \n%s\n", $expected_india_digits, $indic_digits)
        );
        
        
    }
    
    /** @test */
    public function it_can_read_required_files()
    {
        $this->assertFileIsReadable(
            __DIR__ . '/../../Arabic/data/ArNumbers.xml',
            "Required file ArNumbers.xml is missing");
    }
    
    /** @test */
    public function it_can_convert_numbers_to_arabic_idiom()
    {
        $number = '2147483647';
        $this->numbers->setFeminine(1);
        $this->numbers->setFormat(1);
        $expected = 'ملياران و مئة و سبع و أربعون مليون و أربعمئة و ثلاث و ثمانون ألف و ستمئة و سبع و أربعون';
        $arabic_idiom = $this->numbers->int2str($number);
        $this->assertEquals(
            $expected,
            $arabic_idiom,
            "Converted number must be {$expected} , but got {$arabic_idiom}");
    }
    
    /** @test */
    public function it_can_spell_number_in_arabic_idiom_as_money()
    {
        $expected_text = 'ثلاثمئة ليرة';
        $converted_number = $this->numbers->money2str(300);
        
        $this->assertEquals(
            $expected_text,
            $converted_number,
            "The Expected text {$expected_text}, but it got {$converted_number}"
        );
        
    }
    
}
