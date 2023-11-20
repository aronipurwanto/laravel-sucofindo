<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    public function testEnv()
    {
        $comApp = env("APP_COM");

        self::assertEquals("KSO SUCOFINDO", $comApp);
    }

    public function testEnvironment()
    {
        if(App::environment("testing")){
            echo "ENV Testing" . PHP_EOL;
            self::assertTrue(true);
        }
    }


}
