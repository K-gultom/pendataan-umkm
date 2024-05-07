<?php

namespace App\Http\Controllers;

use App\Models\jenis_umkm;
use App\Models\kategori_umkm;
use App\Models\umkm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserUMKMController extends Controller
{
    public function index(){

        return view('screens.user.home');
    }

    // public function kelengkapan(){

    //     $getRt = User::where('level', 'rt')->get();
    //     $getKategori = kategori_umkm::get();
    //     $getJenis = jenis_umkm::get();
    //     return view('screens.user.kelengkapanUmkm', 
    //         compact('getRt', 
    //                     'getKategori',
    //                     'getJenis',
    //         )
    //     );
    // }
    public function kelengkapan(){

        $umkmData = umkm::where('user_id', auth()->id())->first();

        $getRt = User::where('level', 'rt')->get();
        $getKategori = kategori_umkm::get();
        $getJenis = jenis_umkm::get();

        if ($umkmData) {
            // Jika data umkm sudah diisi, kirim data ke view untuk ditampilkan dalam form
            return view('screens.user.updatekelengkapanUmkm', compact('umkmData', 'getRt', 'getKategori', 'getJenis', ));
        } else {
            // Jika belum diisi, kirim form kosong ke view
            return view('screens.user.kelengkapanUmkm', compact('getRt', 'getKategori', 'getJenis', ));
        }

    }


    public function kelengkapan_store(Request $req){

        $req->validate([
            'name' => 'required|min:3|max:50',
            'nik' => 'required|min:16|max:16',
            'alamat_pemilik' => 'required|min:5',
            'rt_id' => 'required|exists:users,id',
            'kategori_umkm_id'=> 'required|exists:kategori_umkms,id',
            'jenis_umkm_id'=> 'required|exists:jenis_umkms,id',
            'nama_usaha' => 'required|min:3|max:50',
            'alamat_usaha' => 'required|min:5|max:100',
            'telp' => 'required|max:15',
            'status' => 'nullable'
        ]);

        // dd($req->all());
        $new                    = new umkm();
        $new->user_id           = Auth::user()->id;
        $new->name              = $req->name;
        $new->nik               = $req->nik;
        $new->alamat_pemilik    = $req->alamat_pemilik;
        $new->rt_id             = $req->rt_id;
        $new->kategori_umkm_id  = $req->kategori_umkm_id;
        $new->jenis_umkm_id     = $req->jenis_umkm_id;
        $new->nama_usaha        = $req->nama_usaha;
        $new->alamat_usaha      = $req->alamat_usaha;
        $new->telp              = $req->telp;
        $new->status            = $req->status;
        $new->save();

        return redirect('/dashboard/umkm')->with('message', 'Data Berhasil diSimpan!!!');

    }

    public function update($id){

    }
    public function update_proses(Request $req, $id){

    }
}
