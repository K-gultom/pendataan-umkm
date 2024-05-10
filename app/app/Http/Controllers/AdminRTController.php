<?php

namespace App\Http\Controllers;

use App\Models\umkm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

     public function dashboardRt() {

        // Get the logged-in RT ID
        $rtId = Auth::user()->id;
      
        // Count approved UMKM for the current RT
        $approvedCount = Umkm::where('status', 'Disetujui')
          ->where('rt_id', $rtId)
          ->count();
      
        // Count disapproved UMKM for the current RT
        $disapprovedCount = Umkm::where('status', 'Tidak Disetujui')
          ->where('rt_id', $rtId)
          ->count();
      
        // Pass the counts to the view
        return view('screens.rt.dashboardRt', compact('approvedCount', 'disapprovedCount'));
      }
      

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

        return redirect('/rt')->with('message', 'Tambah data RT berhasil');
    }

    public function dataUmkm(){

        $getApprove = umkm::where('rt_id', Auth::user()->id)
        ->with('getRT', 'getKategori')->paginate(10);
      
        // dd($getApprove);
        return view('screens.rt.cekUmkm.dataUmkm', compact('getApprove'));
        
    }

    public function dataUmkm_save(Request $req){

        $req->validate([
            "status" => 'required',
            "id" => 'required|integer',
        ]);

        $getId = $req->id;

        // dd($req);
        $new = umkm::findOrFail($getId);
        $new -> status = $req -> status;
        $new->save();

        return redirect('rt/umkm')->with('message', 'Status Berhasil Diubah!!!');

    }

    public function Disetujui(){

        $getApprove = umkm::where('status', 'Disetujui')
        ->where('rt_id', Auth::user()->id)
        ->with('getRT', 'getKategori')->paginate(10);
      
        // dd($getApprove);
        return view('screens.rt.cekUmkm.disetujui', compact('getApprove'));
        
    }



}
