<?php

use App\Http\Controllers\AdminRTController;
use App\Http\Controllers\AuthUMKM;
use App\Http\Controllers\dashboard;
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
        
        // Add data
        Route::get('/admin/add', [AdminRTController::class, 'adminadd']);
        Route::post('/admin/add', [AdminRTController::class, 'adminadd_Store']);
        
        
    //SECTION RT ROUTING
        Route::get('/rt', [AdminRTController::class, 'rt']);

        Route::get('/rt/add', [AdminRTController::class, 'adminRT']);
        Route::post('/rt/add', [AdminRTController::class, 'adminRT_Store']);



});
