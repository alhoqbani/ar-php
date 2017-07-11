<?php

namespace Tests;

use ArUtil\Arabic;

class ExampleTest extends AbstractTestCase
{
    
    /** @test */
    public function class_I18N_Arabic_exists()
    {
        $this->assertTrue(class_exists(Arabic::class));
    }
}
