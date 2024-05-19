<?php

namespace App\Http\Controllers;

use App\Models\jenis_umkm;
use App\Models\kategori_umkm;
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

    
    public function allUMKM(Request $r){

        $dataUmkm = umkm::where('nama_usaha', 'like', "%{$r->search}%")
            ->orWhere('name', 'like', "%{$r->search}%")
            ->orWhere('nik', 'like', "%{$r->search}%")
            ->with('getRT', 'getKategori')->paginate(20);
        
        if ($dataUmkm->isEmpty()) {

          $noDataMessage = 'Maaf, Data UMKM Tidak Tersedia!!!';
          return view('screens.admin.umkmData', compact( 'dataUmkm', ));

        } else {
          return view('screens.admin.umkmData', compact('dataUmkm'));

        }
    }

    public function user_umkm(Request $r){
        
        $getData = umkm::where('nama_usaha', 'like', "%{$r->search}%")
            ->orWhere('name', 'like', "%{$r->search}%")
            ->orWhere('nik', 'like', "%{$r->search}%")
            ->with('getRT', 'getKategori', 'getUser')->paginate(20);
        // dd($getData);

        // dd($getData);
        return view('screens.admin.userData.allUser', compact('getData'));
    }


    // ================================================================================================

    /**
     * this is section rt
     * for logic all for rt
     */

     public function dashboardRt() {

        $rtId = Auth::user()->id;
        
        $disetujui = Umkm::where('status', 'Disetujui')
          ->where('rt_id', $rtId)
          ->count();
      
        $tidakDisetujui = Umkm::where('status', 'Tidak Disetujui')
          ->where('rt_id', $rtId)
          ->count();

        $sedangDitinjau = Umkm::where('status', 'Sedang Ditinjau')
          ->where('rt_id', $rtId)
          ->count();

        return view('screens.rt.dashboardRt', compact('disetujui', 'tidakDisetujui', 'sedangDitinjau'));
    }
      

    function rt(Request $r){
        
        $data = User::where('level', 'rt')
        ->where('name','like',"%$r->search%")
        ->orWhere('wilayah_rt','like',"%$r->search%")
        ->orderBy('wilayah_rt', 'asc')
        ->paginate(5);
        return view('screens.rt.rt', compact('data'));
    }

    function adminRT(){
        return view('screens.rt.addRT');
    }

    function adminRT_Store(Request $req){
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


    public function ditinjau(Request $r) {
       
        $getData = umkm::where('status', 'Sedang Ditinjau')
            ->where('rt_id', Auth::user()->id)
            ->where('name', 'like', "%{$r->search}%")
            ->with('getRT', 'getKategori')->paginate(10);

                // dd($getData);
    
        return view('screens.rt.cekUmkm.umkmDitinjau', compact( 'getData'));

    }

    public function disetujui(Request $r) {
       
        $getData = umkm::where('status', 'Disetujui')
            ->where('rt_id', Auth::user()->id)
            ->where('name', 'like', "%{$r->search}%")
            ->with('getRT', 'getKategori')->paginate(10);

        
                // dd($getData);
    
        return view('screens.rt.cekUmkm.umkmDisetujui', compact( 'getData'));

    }

    public function tidak_disetujui(Request $r) {
       
        $getData = umkm::where('status', 'Tidak Disetujui')
            ->where('rt_id', Auth::user()->id)
            ->where('name', 'like', "%{$r->search}%")
            ->with('getRT', 'getKategori')->paginate(10);

                // dd($getData);
    
        return view('screens.rt.cekUmkm.umkmTidakDisetujui', compact( 'getData'));

    }
    
    public function ubahStatus($id){

        // $umkmData = umkm::find($id)
        //     ->with('getRT', 'getKategori')
        //     ->get();

        $umkmData = Umkm::with(['getRT', 'getKategori', 'getUser'])->findOrFail($id);
        $getRT = User::where('level', 'rt')->get();
        $getKategori = kategori_umkm::get();
        $getJenis = jenis_umkm::get();
        // Mengambil semua data user yang berelasi dengan UMKM
        $userData = User::with('getUmkm')->get();
            // dd($getUser);
            
        return view('screens.rt.cekUmkm.ubahStatus', 
            compact( 
                'umkmData', 
                'userData',
                'getRT',
                'getKategori',
                'getJenis'
            ));
    }

    public function ubahStatus_Save(Request $req, $id){

        $getRequest = $req->status;

        $req->validate([
            'status' => 'required',
        ]);

        $new = umkm::find($id);
        $new->status = $req->status;
        $new->save();

        if ($getRequest == 'Sedang Ditinjau') {
            return redirect('/rt/ditinjau')->with('message', 'Status UMKM Berhasil Diperbaharui');
        } elseif ($getRequest == 'Disetujui') {
            return redirect('/rt/disetujui')->with('message', 'Status UMKM Berhasil Diperbaharui');
        } elseif($getRequest == 'Tidak Disetujui'){
            return redirect('/rt/tidak/disetujui')->with('message', 'Status UMKM Berhasil Diperbaharui');

        }
    }
      
    // API
    public function view_modal_Rt($id) {
        $getApproveStatus = umkm::with('getRT', 'getKategori', 'getJenis')
        ->find($id);

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $getApproveStatus
        ]);
    }

    // API Save
    public function update_umkm(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');

        $umkm = Umkm::find($id);
        if ($umkm) {
            $umkm->status = $status;
            $umkm->save();

            return response()->json([
                'status' => true,
                'message' => 'Status UMKM Berhasil Diperbaharui!!!'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'message' => 'UMKM not found'
            ]);
        }
    }

}
