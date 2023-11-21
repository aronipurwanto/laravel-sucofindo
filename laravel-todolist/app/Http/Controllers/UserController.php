<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function login() : Response
    {
        return response()
            ->view('user.login');
    }

    public function doLogin():Response | RedirectResponse
    {

    }

    public function logout(): RedirectResponse
    {

    }
}
