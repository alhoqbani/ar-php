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
    
}
