<?php

namespace ArUtil\Tests\Arabic;

use ArUtil\Gender;
use ArUtil\Arabic;
use ArUtil\Tests\AbstractTestCase;

class GenderTest extends AbstractTestCase
{
    
    /**
     * @var Gender
     */
    protected $gender;
    
    protected function setUp()
    {
        parent::setUp();
        $this->gender = new Arabic('Gender');
    }
    
    /** @test */
    public function it_loads_keySwap_class()
    {
        $this->assertInstanceOf(Gender::class, $this->gender->myObject);
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
