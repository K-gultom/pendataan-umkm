<?php

use App\Http\Controllers\AdminRTController;
use App\Http\Controllers\AuthUMKM;
use App\Http\Controllers\dashboard;
use App\Http\Controllers\printController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\UserUMKMController;
use Illuminate\Support\Facades\Route;

// Route::get('/', [firstController::class, 'index']);

Route::get('/', [AuthUMKM::class, 'index'])->name('/');
Route::post('/', [AuthUMKM::class, 'login']);

Route::get('/register', [AuthUMKM::class, 'register']);
Route::post('/register', [AuthUMKM::class, 'register_store']);


// Route::middleware(['auth:','ceklevel:admin,user,rt'])->group(function () {
   
// });


Route::middleware(['auth:','ceklevel:admin,user,rt'])->group(function () {
    Route::get('/logout', [AuthUMKM::class, 'logout']);
});


Route::middleware(['auth:','ceklevel:admin'])->group(function () {
    
    Route::get('/dashboard', [dashboard::class, 'index']);

    //SECTION ADMIN ROUTING
        Route::get('/admin', [AdminRTController::class, 'admin']);
            
        // Add Data
        Route::get('/admin/add', [AdminRTController::class, 'adminadd']);
        Route::post('/admin/add', [AdminRTController::class, 'adminadd_Store']);

        // Edit Data
        Route::get('/admin/edit/{id}', [AdminRTController::class, 'edit']);
        Route::post('/admin/edit/{id}', [AdminRTController::class, 'edit_save']);

        // LIHAT DATA ADMIN
        Route::get('/admin/{id}', [AdminRTController::class, 'lihat_Data']);

        Route::get('/admin/delete/{id}', [AdminRTController::class, 'delete_admin']);
        

    // SECTION DATA RT
        //  ADD DATA RT
        Route::get('/rt', [AdminRTController::class, 'rt']);
        

        //Add Data
        Route::get('/rt/add', [AdminRTController::class, 'adminRT']);
        Route::post('/rt/add', [AdminRTController::class, 'adminRT_Store']);

        //Edit Data
        Route::get('/rt/edit/{id}', [AdminRTController::class, 'rt_edit']);
        Route::post('/rt/edit/{id}', [AdminRTController::class, 'rt_edit_save']);

        // Lihat Data Rt
        Route::get('/rt/views/{id}', [AdminRTController::class, 'lihatDataRT']);

        //Hapus Data
        Route::get('/rt/delete/{id}', [AdminRTController::class, 'rt_delete']);



        // SECTION UMKM SETTING
        //Jenis UMKM
        Route::get('/umkm/jenis', [UmkmController::class, 'jenis_UMKM_view']);

        Route::post('/umkm/jenis/add', [UmkmController::class, 'jenis_UMKM_store']);
        Route::get('/umkm/jenis/del/{id}', [UmkmController::class, 'jenis_UMKM_del']);

        Route::get('/umkm/jenis/edit/{id}', [UmkmController::class, 'edit_jenis_UMKM']);
        Route::post('/umkm/jenis/edit/{id}', [UmkmController::class, 'edit_jenis_UMKM_save']);


        //Kategori UMKM
        Route::get('/umkm/kategori', [UmkmController::class, 'kategori_UMKM_view']);

        Route::post('/umkm/kategori/add', [UmkmController::class, 'kategori_UMKM_store']);
        
        Route::get('/umkm/kategori/edit/{id}', [UmkmController::class, 'kategori_UMKM_edit']);
        Route::post('/umkm/kategori/edit/{id}', [UmkmController::class, 'kategori_UMKM_edit_store']);

        Route::get('/umkm/kategori/del/{id}', [UmkmController::class, 'kategori_UMKM_del']);


        // get all umkm
        Route::get('/umkm/master', [AdminRTController::class, 'allUMKM']);
        //  UBAH STATUS UMKM MENJADI TIDAK AKTIF OLEH ADMIN
        Route::get('/umkm/master/{id}', [AdminRTController::class, 'ubah_Status_Tidak_Aktif']);
        Route::post('/umkm/master/{id}', [AdminRTController::class, 'ubah_Status_Tidak_Aktif_save']);

        // Menu Data User UMKM
        Route::get('/umkm', [AdminRTController::class, 'user_umkm']);
        
        //GANTI PASSWORD
        Route::get('/umkm/password/{id}', [AdminRTController::class, 'password_Ubah']);
        Route::post('/umkm/password/{id}', [AdminRTController::class, 'password_Ubah_save']);
        

        // Ubah Status UMKM TIdak Aktif
        // Route::get('/umkm', [AdminRTController::class, 'allUMKM']);

        Route::get('/surat-keterangan', [printController::class, 'surat_keterangan']); 

        Route::get('/cetak-domisili/{id}', [printController::class, 'domisili_umkm_print']); 
        Route::get('/cetak-pinjaman/{id}', [printController::class, 'pinjaman_umkm_print']); 

});


Route::middleware(['auth:','ceklevel:admin,rt'])->group(function () {
   
    //SECTION RT ROUTING
        Route::get('/dashboard/rt', [AdminRTController::class, 'dashboardRt']);
        
   // DATA UMKM ALL
        Route::get('/rt/ditinjau', [AdminRTController::class, 'Ditinjau']);

        Route::get('/rt/disetujui', [AdminRTController::class, 'disetujui']);

        Route::get('/rt/tidak/disetujui', [AdminRTController::class, 'tidak_disetujui']);

        Route::get('/rt/status/{id}', [AdminRTController::class, 'ubahStatus']);
        Route::post('/rt/status/{id}', [AdminRTController::class, 'ubahStatus_Save']);

        

});


Route::middleware(['auth:','ceklevel:user,admin'])->group(function () {
   
    //SECTION USER ROUTING
        Route::get('/dashboard/umkm', [UserUMKMController::class, 'index']);

        Route::get('/umkm/data', [UserUMKMController::class, 'myUmkm']);

        Route::get('/umkm/view/{id}', [UserUMKMController::class, 'viewData']);

        Route::get('/umkm/add', [UserUMKMController::class, 'addData']);
        Route::post('/umkm/add', [UserUMKMController::class, 'addData_save']);


        Route::get('/umkm/edit/{id}', [UserUMKMController::class, 'edit']);
        Route::post('/umkm/edit/{id}', [UserUMKMController::class, 'edit_save']);

        Route::get('/umkm/del/{id}', [UserUMKMController::class, 'hapus']);

        Route::get('/umkm/profile', [UserUMKMController::class, 'profile']);


        Route::get('/umkm/lengkapi', [UserUMKMController::class, 'kelengkapan']);
        Route::post('/umkm/lengkapi', [UserUMKMController::class, 'kelengkapan_save']);

        Route::get('/umkm/update', [UserUMKMController::class, 'dataDiri']);
        Route::post('/umkm/update', [UserUMKMController::class, 'dataDiri_save']);

        Route::get('/umkm/update/ktp', [UserUMKMController::class, 'dataKtp']);
        Route::post('/umkm/update/ktp', [UserUMKMController::class, 'dataKtp_save']);

        Route::get('/umkm/update/kk', [UserUMKMController::class, 'dataKk']);
        Route::post('/umkm/update/kk', [UserUMKMController::class, 'dataKk_save']);


});


 