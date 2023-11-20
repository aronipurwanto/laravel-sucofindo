<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertSame;

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
        assertSame($foo, $bar->getFoo());
    }

    public function testCreateDependency()
    {
        $foo = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        assertNotNull($foo);
        assertNotNull($bar);

        self::assertNotSame($foo, $bar->getFoo());
        self::assertNotSame($foo, $foo2);
        self::assertNotSame($bar, $bar2);
    }


}
