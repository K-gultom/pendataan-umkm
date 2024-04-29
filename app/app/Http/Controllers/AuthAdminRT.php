<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthAdminRT extends Controller
{
    public function index()
    {
        return view('auth.admin-rt.login-admin-rt');
    }

    
}
