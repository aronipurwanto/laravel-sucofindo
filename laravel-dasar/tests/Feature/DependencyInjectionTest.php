<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;

class DependencyInjectionTest extends TestCase
{
    public function testDI()
    {
        $foo = new Foo();
        $bar = new Bar($foo);

        self::assertNotNull($foo);
        self::assertNotNull($bar);
        assertEquals("foo and bar" , $bar->bar());
        assertEquals($foo, $bar->getFoo());
    }

}
