<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signup(){
        return view('auth.signup');
    }

    public function registr(Request $request){

    }
}
