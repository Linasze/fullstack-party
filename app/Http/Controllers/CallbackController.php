<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CallbackController extends Controller
{

    public function index(){
      session()->put('auth','signIn');
      return redirect('/list');
    }
}
