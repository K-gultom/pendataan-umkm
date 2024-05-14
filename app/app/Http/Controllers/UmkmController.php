<?php

namespace App\Http\Controllers;

use App\Models\jenis_umkm;
use App\Models\kategori_umkm;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    
    public function jenis_UMKM_view(){

        $data = jenis_umkm::all();
        return view('screens.umkm.jenisUmkm', compact('data'));
    }

    public function jenis_UMKM_store(Request $req){

        $req->validate([
            "Jenis_UMKM" => 'required|unique:jenis_umkms,jenis_umkm',
        ]);

        $new = new jenis_umkm();
        $new -> jenis_umkm = $req -> Jenis_UMKM;
        $new ->save();

        return redirect()->back()->with('message', 'Tambah jenis UMKM Berhasil!!!');
    }

    public function jenis_UMKM_del($id){
        $data = jenis_umkm::findOrFail($id);
        $data->delete();
        
        return redirect()->back()->with('DeleteSucces', 'Hapus jenis UMKM Berhasil!!!');
    }


// ========================================= SECTION ======================================================

    public function kategori_UMKM_view(Request $r){

        $search = $r->search;

        $data = kategori_umkm::where('nama_kategori','like', "%$search%")
        ->orderBy('nama_kategori', 'asc')
        ->paginate(5);
        return view('screens.umkm.kategoriUmkm', compact('data', ));

    }

    public function kategori_UMKM_store(Request $req){

        $req->validate([
            "nama_kategori" => 'required|unique:kategori_umkms,nama_kategori',
        ]);

        $new = new kategori_umkm();
        $new -> nama_kategori = $req -> nama_kategori;
        $new ->save();

        return redirect()->back()->with('message', 'Tambah Kategori UMKM Berhasil!!!');

    }

    public function kategori_UMKM_edit($id){
        
        $data = kategori_umkm::orderBy('nama_kategori', 'asc')->paginate(5);
        $getId = kategori_umkm::findOrFail($id);
        return view('screens.umkm.editKategoriUmkm', compact('data','getId'));

    }

    public function kategori_UMKM_edit_store(Request $req, $id){

        $req->validate([
            "nama_kategori" => 'required|unique:kategori_umkms,nama_kategori',
        ]);

        $new = kategori_umkm::findOrFail($id);
        $new -> nama_kategori = $req -> nama_kategori;
        $new ->save();

        return redirect('/umkm/kategori')->with('message', 'Edit Kategori UMKM Berhasil!!!');

    }

    public function kategori_UMKM_del($id){

        $data =  kategori_umkm::findOrFail($id);
        $data -> delete();

        return redirect('/umkm/kategori')->with('DeleteSucces', 'Hapus jenis UMKM Berhasil!!!');

    }


}
