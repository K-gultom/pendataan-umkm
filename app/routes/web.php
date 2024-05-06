<?php

use App\Http\Controllers\AdminRTController;
use App\Http\Controllers\AuthUMKM;
use App\Http\Controllers\dashboard;
use App\Http\Controllers\UmkmController;
use Illuminate\Support\Facades\Route;

// Route::get('/', [firstController::class, 'index']);

Route::get('/', [AuthUMKM::class, 'index'])->name('/');
Route::post('/', [AuthUMKM::class, 'login']);

Route::get('/register', [AuthUMKM::class, 'register']);
Route::post('/register', [AuthUMKM::class, 'register_store']);

// Route::get('/login-pegawai', [AuthAdminRT::class, 'index']);


Route::middleware(['auth:','ceklevel:admin,user,rt'])->group(function () {
    
    Route::get('/logout', [AuthUMKM::class, 'logout']);
    
    Route::get('/dashboard', [dashboard::class, 'index']);




    //SECTION ADMIN ROUTING
        Route::get('/admin', [AdminRTController::class, 'admin']);
        
        // Add Data
        Route::get('/admin/add', [AdminRTController::class, 'adminadd']);
        Route::post('/admin/add', [AdminRTController::class, 'adminadd_Store']);
        
        


    //SECTION RT ROUTING
        Route::get('/rt', [AdminRTController::class, 'rt']);

        //Add Data
        Route::get('/rt/add', [AdminRTController::class, 'adminRT']);
        Route::post('/rt/add', [AdminRTController::class, 'adminRT_Store']);

    //SECTION USER ROUTING



    //SECTION UMKM ROUTING
        //Jenis UMKM
        Route::get('/umkm/jenis', [UmkmController::class, 'jenis_UMKM_view']);

        Route::post('/umkm/jenis/add', [UmkmController::class, 'jenis_UMKM_store']);
        Route::get('/umkm/jenis/del/{id}', [UmkmController::class, 'jenis_UMKM_del']);


        //Kategori UMKM
        Route::get('/umkm/kategori', [UmkmController::class, 'kategori_UMKM_view']);

        Route::post('/umkm/kategori/add', [UmkmController::class, 'kategori_UMKM_store']);
        
        Route::get('/umkm/kategori/edit/{id}', [UmkmController::class, 'kategori_UMKM_edit']);
        Route::post('/umkm/kategori/edit/{id}', [UmkmController::class, 'kategori_UMKM_edit_store']);

        Route::get('/umkm/kategori/del/{id}', [UmkmController::class, 'kategori_UMKM_del']);
});
