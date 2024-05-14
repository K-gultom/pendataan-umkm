<?php

use App\Http\Controllers\AdminRTController;
use App\Http\Controllers\UserUMKMController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/view/{id}', [UserUMKMController::class, 'view_modal']);

Route::get('/view/umkm/{id}', [AdminRTController::class, 'view_modal_Rt']);
Route::post('/update/umkm', [AdminRTController::class, 'update_umkm']);

// Route::get('/view/form/{id}', [AdminRTController::class, 'view_form']);

