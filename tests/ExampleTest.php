<?php

namespace Tests;

class ExampleTest extends AbstractTestCase
{
    
    /** @test */
    public function class_I18N_Arabic_exists()
    {
        $this->assertTrue(class_exists(\I18N_Arabic::class));
    }
}
