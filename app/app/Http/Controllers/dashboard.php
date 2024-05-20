<?php

namespace App\Http\Controllers;

use App\Models\umkm;
use App\Models\User;

class dashboard extends Controller
{
    public function index(){

        // GET DATA FROM MODEL USER
        $getAdmin = User::where('level', 'admin')->count();
        $getRT = User::where('level', 'rt')->count();
        $getUsersUmkm = User::where('level', 'user')->count();
        $getUsers = User::where('level', 'user')->get();

        $getUmkm = $getUsers->filter(function($user) {
            return !is_null($user->foto_ktp);
        })->count();

        $getAllUmkkm = umkm::all()->count();
        // dd($getUmkm);

        // GET DATA FROM MODEL UMKM
        $getStatusDisetujui = umkm::where('status', 'Disetujui')->count();
        $getStatusTidakDisetujui = umkm::where('status', 'Tidak Disetujui')->count();
        $getStatusSedangDitinjau = umkm::where('status', 'Sedang Ditinjau')->count();


        return view('screens.dashboard.dashboard',
            compact(
                'getAdmin',
                'getRT',
                'getUmkm',
                'getUsersUmkm',
                'getAllUmkkm',
                'getStatusDisetujui',
                'getStatusTidakDisetujui',
                'getStatusSedangDitinjau',
                )
        );
    }
}
