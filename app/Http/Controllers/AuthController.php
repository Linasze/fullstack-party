<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function __construct(){
        $this->client_id = env('CLIENT_ID', '');
        $this->secret = env('SECRET', '');
        $this->callback = "callback";
    }

     public function login(){
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $url = 'http://github.com/login/oauth/authorize?client_id='. $this->client_id . "&callback=" . $this->callback . "&scope=user";
            return redirect($url);
        }
     }


     public function logout(){
        session()->forget('auth');
    
        return redirect('/');
    }
}
