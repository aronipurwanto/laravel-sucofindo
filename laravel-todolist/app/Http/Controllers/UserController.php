<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private UserService $userServices;

    /**
     * @param UserService $userServices
     */
    public function __construct(UserService $userServices)
    {
        $this->userServices = $userServices;
    }

    public function login() : Response
    {
        return response()
            ->view('user.login',['title' => 'Login Page']);
    }

    public function doLogin(Request $request):Response | RedirectResponse
    {
        $username = $request->input('user');
        $password = $request->input('password');

        if(empty($username) || empty($password)){
            return response()
                ->view('user.login',[
                    'title'=>'Login Page',
                    'error' => 'Username or password is empty'
                ]);
        }

        if($this->userServices->login($username, $password)) {
            $request->session()->put('user',$username);
            return redirect('/');
        }

        return response()
            ->view('user.login',[
                'title'=>'Login Page',
                'error' => 'Username or password not valid'
            ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget('user');
        return redirect('/');
    }
}
