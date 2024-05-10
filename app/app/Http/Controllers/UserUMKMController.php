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
    
    public function myUmkm() {
        
        $getUmkm = umkm::with('getRT', 'getKategori')->where('user_id', Auth::user()->id)->get();
      
        if ($getUmkm->isEmpty()) {

          $noDataMessage = 'Maaf, Anda belum memiliki data UMKM apapun!!!';
          return view('screens.user.myUmkm', compact('noDataMessage', 'getUmkm'));

        } else {
            
          return view('screens.user.myUmkm', compact('getUmkm'));

        }

    }
      
    
    public function addData(){

        $getRt = User::where('level', 'rt')->get();
        $getKategori = kategori_umkm::get();
        $getJenis = jenis_umkm::get();

        return view('screens.user.addDataUmkm', compact('getRt', 'getKategori', 'getJenis' ));
        
    }

    public function addData_save(Request $req){

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
            // 'status' => 'nullable'
        ]);

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

        return redirect('/umkm/data')->with('message', 'Data Berhasil diSimpan!!!');

    }
    


    public function edit(){

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


    public function edit_save(Request $req, $id){

        $umkmData = Umkm::find($id);

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
        $new                    = umkm::findOrFail($id);
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
        // $new->status            = $req->status;
        
        if ($umkmData->status == 'Disetujui') {

            $umkmData->status = 'Disetujui';

        } else if($umkmData->status == 'Tidak Disetujui'){

            $umkmData->status = 'Tidak Disetujui';
            
        } else{
            $umkmData->status = 'Sedang Ditinjau';

        }

        $new->save();

        return redirect('/umkm/data')->with('message', 'Data Berhasil Diperbaharui!!!');

    }

    public function hapus($id){

        $data = umkm::find($id);
        $data -> delete();

        return redirect()->back()->with('message', 'Data Berhasil Dihapus!!!');
    }

}
