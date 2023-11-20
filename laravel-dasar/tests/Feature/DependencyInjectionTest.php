<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
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

    public function testBind()
    {
        $this->app->bind(Person::class, function ($app){
            return new Person("Ahmad","Roni");
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        assertEquals("Ahmad", $person1->getFirstName());
        assertEquals("Ahmad", $person2->getFirstName());
        assertEquals($person1->getFirstName(), $person2->getFirstName());

        self::assertNotSame($person1, $person2);
    }

    public function testSingleton()
    {
        $this->app->singleton(Person::class, function ($app){
            return new Person("Ahmad","Roni");
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);
        $person3 = $this->app->make(Person::class);

        assertEquals("Ahmad", $person1->getFirstName());
        assertEquals("Ahmad", $person2->getFirstName());
        assertEquals("Ahmad", $person3->getFirstName());

        assertEquals($person1->getFirstName(), $person2->getFirstName());

        self::assertSame($person1, $person2);
        self::assertSame($person2, $person3);
        self::assertSame($person1, $person3);
    }


}
