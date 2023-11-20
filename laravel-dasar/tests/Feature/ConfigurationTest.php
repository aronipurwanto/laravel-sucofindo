<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
    public function testConfig()
    {
        $firstName = config("contoh.author.firstName");
        self::assertEquals("Ahmad", $firstName);

        $lastName = config("contoh.author.lastName");
        self::assertEquals("Roni", $lastName);

        $email = config("contoh.email");
        self::assertEquals("ahmadroni@gmail", $email);

        $country = config("contoh.country");
        self::assertEquals("Indonesia", $country);
    }

}
