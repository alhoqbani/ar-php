<?php

namespace Tests\Arabic;

use I18N_Arabic_Gender;
use Tests\AbstractTestCase;

class GenderTest extends AbstractTestCase
{
    
    /**
     * @var I18N_Arabic_Gender
     */
    protected $gender;
    
    protected function setUp()
    {
        parent::setUp();
        $this->gender = new \I18N_Arabic('Gender');
    }
    
    /** @test */
    public function it_loads_keySwap_class()
    {
        $this->assertInstanceOf(I18N_Arabic_Gender::class, $this->gender->myObject);
    }
    
    /** @test */
    public function it_detects_the_gender_of_given_name()
    {
        $this->assertTrue($this->gender->isFemale('خديجة بن قنة'));
        $this->assertTrue($this->gender->isFemale('لينا زهر الدين'));
        $this->assertTrue($this->gender->isFemale('ابتهال'));
        $this->assertTrue($this->gender->isFemale('فيروز زياني'));
        $this->assertTrue($this->gender->isFemale('جلنار موسى'));
        $this->assertFalse($this->gender->isFemale('فيصل القاسم'));
        $this->assertFalse($this->gender->isFemale('المعز بو لحية'));
        $this->assertFalse($this->gender->isFemale('خالد صالح'));
        $this->assertFalse($this->gender->isFemale('علي الظفيري'));
    }
    
}
