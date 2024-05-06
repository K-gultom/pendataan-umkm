<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminRTController extends Controller
{
    /**
     * this is section admin
     * for logic all for admin
     */
    function admin()
    {

        $data = User::where('level', 'admin')->paginate(5);
        return view('screens.admin.admin', compact('data'));
    }

    function adminadd()
    {
        return view('screens.admin.addAdmin');
    }

    function adminadd_Store(Request $req)
    {
        $req->validate([
            "name"  => 'required|max:50',
            "jenis_kelamin" => 'required',
            "alamat" => 'required|max:60',
            "telp" => 'required|max:15',
            "email" => 'required|unique:users,email',
            "password" => 'required|min:7',
        ]);
        $new                = new User();
        $new->name          = $req->name;
        $new->jenis_kelamin = $req->jenis_kelamin;
        $new->alamat        = $req->alamat;
        $new->telp          = $req->telp;
        $new->email         = $req->email;
        $new->password      = Hash::make($req->password);
        $new->level         = $req->level;
        $new->save();

        return redirect('/admin')->with('message', 'Tambah data admin berhasil');
    }





    /**
     * this is section rt
     * for logic all for rt
     */
    function rt(Request $r)
    {
        
        $data = User::where('level', 'rt')
        ->where('name','like',"%$r->search%")
        ->orWhere('wilayah_rt','like',"%$r->search%")
        ->orderBy('wilayah_rt', 'asc')
        ->paginate(5);
        return view('screens.rt.rt', compact('data'));
    }
    function adminRT()
    {
        return view('screens.rt.addRT');
    }
    function adminRT_Store(Request $req)
    {
        $req->validate([
            "name"  => 'required|max:50',
            "wilayah_rt" => 'required|max:4|numeric|unique:users,wilayah_rt',
            "jenis_kelamin" => 'required',
            "alamat" => 'required|max:60',
            "telp" => 'required|max:15',
            "email" => 'required|unique:users,email',
            "password" => 'required|min:7',
        ]);

        $new                = new User();
        $new->name          = $req->name;
        $new->wilayah_rt    = $req->wilayah_rt;
        $new->jenis_kelamin = $req->jenis_kelamin;
        $new->alamat        = $req->alamat;
        $new->telp          = $req->telp;
        $new->email         = $req->email;
        $new->password      = Hash::make($req->password);
        $new->level         = $req->level;
        $new->save();

        return redirect('/rt')->with('message', 'Tambah data admin berhasil');
    }
}
