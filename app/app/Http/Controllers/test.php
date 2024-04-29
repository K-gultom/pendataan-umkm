<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class test extends Controller
{
    function index(){
        // return view('auth.umkm.login-umkm');
        return view('auth.default-auth');
    }

    function test(){
        return view('screens.test');
    }
}
