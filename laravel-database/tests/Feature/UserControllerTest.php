<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get('/login')
            ->assertSeeText("Login")
            ->assertSeeText("Password")
            ->assertSeeText("User");
    }

    public function testLoginFailed()
    {
        $this->post('/login',[])
            ->assertSeeText('Login')
            ->assertSeeText("Password")
            ->assertSeeText("User")
            ->assertSeeText('Username or password is empty');
    }

    public function testLoginPasswordEmpty()
    {
        $this->post('/login',['user'=>'ahmad'])
            ->assertSeeText('Login')
            ->assertSeeText("Password")
            ->assertSeeText("User")
            ->assertSeeText('Username or password is empty');

        $this->post('/login',['password'=>'ahmad'])
            ->assertSeeText('Login')
            ->assertSeeText("Password")
            ->assertSeeText("User")
            ->assertSeeText('Username or password is empty');
    }

    public function testLoginUserAndPasswordNotEmpty()
    {
        $this->post('/login',['user'=>'ahmad','password'=>'salah'])
            ->assertSeeText('Login')
            ->assertSeeText("Password")
            ->assertSeeText("User")
            ->assertSeeText('Username or password not valid');
    }

    public function testLoginSuccess()
    {
        $this->post('/login',['user'=>'heri','password'=>'rahasia'])
            ->assertRedirect('/');
    }
}
