<?php

namespace ArUtil\Tests\Arabic;

use ArUtil\Arabic;
use ArUtil\Hiero;
use ArUtil\Tests\AbstractTestCase;

class HieroTest extends AbstractTestCase
{
    
    /**
     * @var Hiero
     */
    protected $hiero;
    
    protected function setUp()
    {
        parent::setUp();
        $this->hiero = new Arabic('Hiero');
    }
    
    /** @test */
    public function it_loads_hiero_class()
    {
        $this->assertInstanceOf(Hiero::class, $this->hiero->myObject);
    }
    
    
    /** @test */
    public function set_and_get_the_language()
    {
        $this->assertEquals('Hiero', $this->hiero->setLanguage('Hiero')->getLanguage());
        $this->assertEquals('Phoenician', $this->hiero->setLanguage('Phoenician')->getLanguage());
    }
    
    /** @test */
    public function it_return_image_resource()
    {
        /** @var resource $image */
        $image = $this->hiero->str2graph('العربية');

        $this->assertTrue(is_resource($image));
        imagedestroy($image);
    }
}
