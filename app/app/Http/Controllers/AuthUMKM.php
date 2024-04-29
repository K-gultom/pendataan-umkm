<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthUMKM extends Controller
{
    public function index()
    {
        return view('auth.umkm.login-umkm');
    }

    public function login(Request $request)
    {
        $request -> validate([
            "email" => 'required|max:50|email|exists:users,email',
            "password" => 'required|min:7',
        ]);

        $user = User::where('email',$request->email)->first();

        $infoLogin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infoLogin)) {
                return redirect('/dashboard');
        }else{
            
            return redirect()->back()->withErrors(['password' => 'Password is Invalid']);

        }
        // return view('auth.umkm.login-umkm');
    }

    // public function getdashboard()
    // {
    //     return view('screens.dashboard.dashboard');
    // }

    public function register()
    {
        return view('auth.umkm.register-umkm');
    }

    public function register_store(Request $request)
    {
        $request->validate([
            "name" => 'required|min:3|max:50',
            "email" => 'required|unique:users,email',
            "password" => 'required|min:7',
        ]);

        $new = new User();
        $new->name = $request->name;
        $new->email = $request->email;
        $new->password = Hash::make($request -> password);
        $new->level = $request->level;
        $new->save();

        return redirect('/');
    }
}
