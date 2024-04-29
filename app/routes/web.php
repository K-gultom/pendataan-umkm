<?php

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
    
    Route::get('/dashboard', [dashboard::class, 'index']);

});
