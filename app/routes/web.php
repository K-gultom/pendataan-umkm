<?php

use App\Http\Controllers\AuthAdminRT;
use App\Http\Controllers\AuthUMKM;
use App\Http\Controllers\firstController;
use Illuminate\Support\Facades\Route;

Route::get('/', [firstController::class, 'index']);

Route::get('/login', [AuthUMKM::class, 'index']);
Route::get('/register', [AuthUMKM::class, 'register']);

Route::get('/login-pegawai', [AuthAdminRT::class, 'index']);
