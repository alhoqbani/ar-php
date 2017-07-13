<?php

namespace ArUtil\Tests\Time;

use ArUtil\Tests\AbstractTestCase;
use Carbon\Carbon;

abstract class TimeAbstractTest extends AbstractTestCase
{
    
    /**
     * @var \Carbon\Carbon
     */
    protected $now;
    
    /**
     * @var string Saved timezone before test
     */
    protected $saveTz;
    
    protected function setUp()
    {
        parent::setUp();
        $this->saveTz = date_default_timezone_get();
        
        date_default_timezone_set('America/Los_Angeles');
        
        Carbon::setTestNow($this->now = Carbon::now());
    }
    
    protected function tearDown()
    {
        date_default_timezone_set($this->saveTz);
        Carbon::setTestNow();
        parent::tearDown();
    }
}
