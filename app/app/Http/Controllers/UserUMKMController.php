<?php

namespace App\Http\Controllers;

use App\Models\jenis_umkm;
use App\Models\kategori_umkm;
use App\Models\umkm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserUMKMController extends Controller
{
    public function index(){

        $userId = Auth::user()->id;
        
        $disetujui = Umkm::where('status', 'Disetujui')->where('user_id', $userId)->count();
      
        $tidakDisetujui = Umkm::where('status', 'Tidak Disetujui')->where('user_id', $userId)->count();

        $sedangDitinjau = Umkm::where('status', 'Sedang Ditinjau')->where('user_id', $userId)->count();

        $tidakAktif = Umkm::where('status', 'Tidak Aktif')->where('user_id', $userId)->count();

        return view('screens.user.home',  
        compact(
            'disetujui', 
            'tidakDisetujui', 
            'sedangDitinjau',
            'tidakAktif',
            )
        );

    }
    
    public function myUmkm() {

        $getProfile = Auth::user();
        $getUmkm = umkm::with('getRT', 'getKategori')
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
        
        if ($getUmkm->isEmpty()) {

          $noDataMessage = 'Maaf, Anda belum memiliki data UMKM apapun!!!';
          return view('screens.user.myUmkm', compact('noDataMessage', 'getUmkm', 'getProfile'));

        } else {
          return view('screens.user.myUmkm', compact('getUmkm', 'getProfile'));

        }

    }

    public function viewData($id){
        $umkmData = umkm::where('user_id', auth()->id())->first();

        $getRt = User::where('level', 'rt')->get();
        $getKategori = kategori_umkm::get();
        $getJenis = jenis_umkm::get();

        return view('screens.user.lihatData', compact('umkmData', 'getRt', 'getKategori', 'getJenis', ));
    }

    public function view_modal($id) {
        $getUMKM = umkm::with('getRT', 'getKategori', 'getJenis')->find($id);

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $getUMKM
        ]);
    }
    
    public function addData(){

        $getProfile = Auth::user();
        $getRt = User::where('level', 'rt')->get();
        $getKategori = kategori_umkm::get();
        $getJenis = jenis_umkm::get();

        return view('screens.user.addDataUmkm', compact('getRt', 'getKategori', 'getJenis', 'getProfile' ));
        
    }

    public function addData_save(Request $req){

        $req->validate([
            'name' => 'required|min:3|max:50',
            'nik' => 'required|min:16|max:16',
            'alamat_pemilik' => 'required|min:5',
            'rt_id' => 'required|exists:users,id',
            'kategori_umkm_id' => 'required|exists:kategori_umkms,id',
            'jenis_umkm_id' => 'required|exists:jenis_umkms,id',
            'nama_usaha' => 'required|min:3|max:50',
            'alamat_usaha' => 'required|min:5|max:100',
            'telp' => 'required|max:15',
            'foto_umkm' => 'required|mimes:jpg,jpeg,png',
            // 'status' => 'nullable'
        ]);

        $foto_umkm = $req->file('foto_umkm');
        $new_photo_name_umkm = uniqid() . "." . $foto_umkm->getClientOriginalExtension();
        $foto_umkm->move('assets/images/umkm', $new_photo_name_umkm);

        $new = new umkm();
        $new->user_id = Auth::user()->id;
        $new->name = $req->name;
        $new->nik = $req->nik;
        $new->alamat_pemilik = $req->alamat_pemilik;
        $new->rt_id = $req->rt_id;
        $new->kategori_umkm_id = $req->kategori_umkm_id;
        $new->jenis_umkm_id = $req->jenis_umkm_id;
        $new->nama_usaha = $req->nama_usaha;
        $new->alamat_usaha = $req->alamat_usaha;
        $new->telp = $req->telp;
        $new->foto_umkm = $new_photo_name_umkm;
        $new->status = $req->status;
        $new->save();

        return redirect('/umkm/data')->with('message', 'Data Berhasil diSimpan!!!');
    }


    public function edit(){
        
        // $getProfile = Auth::user();

        $umkmData = umkm::where('user_id', auth()->id())->first();

        $getRt = User::where('level', 'rt')->get();
        $getKategori = kategori_umkm::get();
        $getJenis = jenis_umkm::get();

        if ($umkmData) {
            // Jika data umkm sudah diisi, kirim data ke view untuk ditampilkan dalam form
            return view('screens.user.editDataUmkm', compact('umkmData', 'getRt', 'getKategori', 'getJenis' ));
        } else {
            // Jika belum diisi, kirim form kosong ke view
            return view('screens.user.myUmkm', compact('getRt', 'getKategori', 'getJenis', ));
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
            'foto_umkm' => 'mimes:jpg,jpeg,png',
            // 'status' => 'nullable'
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

        
        // Periksa apakah ada foto KTP sebelumnya
        if ($req->hasFile('foto_umkm')) {
            $foto_umkm = $req->file('foto_umkm');
            $new_photo_name_umkm = uniqid().".".$foto_umkm->getClientOriginalExtension();
            $foto_umkm->move('assets/images/umkm', $new_photo_name_umkm);
    
            // Periksa apakah ada foto UMKM sebelumnya
            if ($new->foto_umkm) {
                $old_photo_path = 'assets/images/umkm/' . $new->foto_umkm;
    
                // Hapus foto UMKM sebelumnya jika file tersebut ada
                if (File::exists($old_photo_path)) {
                    File::delete($old_photo_path);
                }
            }

            // Save Data Foto
            $new->foto_umkm = $new_photo_name_umkm;
        }


        // Save Data Status
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
        $data = Umkm::find($id);
    
        if ($data) {
            // Path ke foto UMKM
            $photo_path = public_path('assets/images/umkm/' . $data->foto_umkm);
    
            // Hapus file foto jika ada
            if (File::exists($photo_path)) {
                File::delete($photo_path);
            }
    
            // Hapus data dari tabel
            $data->delete();
        }
    
        return redirect()->back()->with('message', 'Data Berhasil Dihapus!!!');
    }
    

    public function profile(){

        $getProfile = Auth::user();

        return view('screens.user.profileAll.profile', compact('getProfile'));
    }

    public function kelengkapan(){
        return view('screens.user.profileAll.lengkapiData');
    }

    public function kelengkapan_save(Request $req){

        $getIdUser = Auth::user()->id;

        $req->validate([
            "jenis_kelamin" => 'required',
            "alamat" => 'required|max:60',
            "telp" => 'required|max:15',
            'foto_ktp' => 'required|mimes:jpg,jpeg,png',
            'foto_kk' => 'required|mimes:jpg,jpeg,png',
        ]);

        $foto_ktp = $req -> file('foto_ktp');
        $new_photo_name_ktp = uniqid().".".$foto_ktp->getClientOriginalExtension();
        $foto_ktp -> move('assets/images/ktp',$new_photo_name_ktp);

        $foto_kk = $req -> file('foto_kk');
        $new_photo_name_kk = uniqid().".".$foto_ktp->getClientOriginalExtension();
        $foto_kk -> move('assets/images/kk',$new_photo_name_kk);

        $new = User::find($getIdUser);
        $new->jenis_kelamin = $req->jenis_kelamin;
        $new->alamat = $req->alamat;
        $new->telp = $req->telp;
        $new->foto_ktp = $new_photo_name_ktp;
        $new->foto_kk = $new_photo_name_kk;
        $new->save();

        return redirect('/umkm/profile')->with('message', 'Kelengkapan Data Diri Anda Berhasil diperbarui');
    }


    public function dataDiri(){

        $getProfile = Auth::user();

        return view('screens.user.profileAll.editData', compact('getProfile'));
    }
    public function dataDiri_save(Request $req){

        $getIdUser = Auth::user()->id;

        $req->validate([
            "alamat" => 'required|max:60',
            "telp" => 'required|max:15',
        ]);

        $new = User::find($getIdUser);
        $new->alamat = $req->alamat;
        $new->telp = $req->telp;
        $new->save();

        return redirect('/umkm/profile')->with('message', 'Data Diri berhasil diperbarui');
    }
    

    public function dataKtp(){

        $getProfile = Auth::user();

        return view('screens.user.profileAll.ubahKtp', compact('getProfile'));
    }
    public function dataKtp_save(Request $req){
        
        $getIdUser = Auth::user()->id;

        $req->validate([
            'foto_ktp' => 'required|mimes:jpg,jpeg,png',
        ]);
    
        $foto_ktp = $req->file('foto_ktp');
        $new_photo_name_ktp = uniqid().".".$foto_ktp->getClientOriginalExtension();
        $foto_ktp->move('assets/images/ktp', $new_photo_name_ktp);
    
        $user = User::find($getIdUser);
    
        // Periksa apakah ada foto KTP sebelumnya
        if ($user->foto_ktp) {
            $old_photo_path = 'assets/images/ktp/' . $user->foto_ktp;
    
            // Hapus foto KTP sebelumnya jika file tersebut ada
            if (File::exists($old_photo_path)) {
                File::delete($old_photo_path);
            }
        }
    
        // Simpan nama foto KTP yang baru ke database
        $user->foto_ktp = $new_photo_name_ktp;
        $user->save();
    
        return redirect('/umkm/profile')->with('message', 'Foto KTP berhasil diperbarui');
    }


    public function dataKk(){

        $getProfile = Auth::user();

        return view('screens.user.profileAll.ubahkk', compact('getProfile'));
    }
    public function dataKk_save(Request $req){

        $getIdUser = Auth::user()->id;

        $req->validate([
            'foto_kk' => 'required|mimes:jpg,jpeg,png',
        ]);
    
        $foto_kk = $req->file('foto_kk');
        $new_photo_name_kk = uniqid().".".$foto_kk->getClientOriginalExtension();
        $foto_kk->move('assets/images/kk', $new_photo_name_kk);
    
        $user = User::find($getIdUser);
    
        // Periksa apakah ada foto KTP sebelumnya
        if ($user->foto_kk) {
            $old_photo_path = 'assets/images/kk/' . $user->foto_kk;
    
            // Hapus foto KTP sebelumnya jika file tersebut ada
            if (File::exists($old_photo_path)) {
                File::delete($old_photo_path);
            }
        }
    
        // Simpan nama foto KTP yang baru ke database
        $user->foto_kk = $new_photo_name_kk;
        $user->save();
    
        return redirect('/umkm/profile')->with('message', 'Foto KK berhasil diperbarui');
    }

}
