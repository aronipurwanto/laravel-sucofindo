<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelloTest extends TestCase
{
    public function testHello()
    {
        $number = 10;
        $result = $number * 2;
        $compare = $result == 30;

        self::assertEquals(20, $result);
        self::assertFalse($compare);
    }
}
