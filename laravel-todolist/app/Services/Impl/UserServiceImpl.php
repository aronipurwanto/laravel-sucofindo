<?php

namespace App\Services\Impl;

use App\Services\UserServices;

class UserServiceImpl implements UserServices
{
    private $users = [
        "roni" => "rahasia",
        "heri"=>"rahasia",
        "nana"=>"anonim"
    ];

    public function login(string $username, string $password): bool
    {
        if(!isset($username) || !isset($password)){
            return false;
        }

        if(empty($username) || empty($password)){
            return false;
        }

        if(!isset($this->users[$username])){
            return false;
        }

        $correctPassword = $this->users[$username];
        if($correctPassword == $password){
            return true;
        }else {
            return false;
        }
    }
}
