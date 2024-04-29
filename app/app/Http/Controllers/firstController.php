<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class firstController extends Controller
{
    function index(){
        
        return view('auth.default-auth');
    }
}
