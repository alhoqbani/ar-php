<?php

namespace ArUtil\Tests\Arabic;

use ArUtil\I18N\Arabic;
use ArUtil\I18N\Hiero;
use ArUtil\Tests\AbstractTestCase;
use FilesystemIterator;

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
        $image = $this->hiero->str2graph('Hamoud Alhoqbani');

        $this->assertTrue(is_resource($image));
        imagedestroy($image);
    }
    
    /** @test */
    public function it_return_image_resource_when_language_is_arabic()
    {
        /** @var resource $image */
        $image = $this->hiero->str2graph('خالد الشمعة', 'rtl', 'ar');

        $this->assertTrue(is_resource($image));
        imagedestroy($image);
    }
    
    /** @test */
    public function it_has_the_images_folder_available()
    {
        $hieroPath = __DIR__ . '/../../../src/ArUtil/I18N/images/hiero';
        $this->assertIsReadable($hieroPath);
        $numberOfFiles = iterator_count(new FilesystemIterator($hieroPath, FilesystemIterator::SKIP_DOTS));
        $this->assertEquals(58, $numberOfFiles);
        
        $phoenicianPath = __DIR__ . '/../../../src/ArUtil/I18N/images/phoenician';
        $this->assertIsReadable($phoenicianPath);
        $numberOfFiles = iterator_count(new FilesystemIterator($phoenicianPath, FilesystemIterator::SKIP_DOTS));
        $this->assertEquals(28, $numberOfFiles);
    }
    
    
}
