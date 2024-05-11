<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DanhmucController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//http://127.0.0.1:8000/api

//danh-muc
Route::post('/admin/danh-muc/them-moi', [DanhmucController::class, 'store']);
Route::get('/admin/danh-muc/get-data', [DanhmucController::class, 'getData']);
Route::post('/admin/danh-muc/delete-data', [DanhmucController::class, 'destroy']);
Route::post('/admin/danh-muc/update-data', [DanhmucController::class, 'update']);


//admin
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/admin/login', [AdminController::class, 'login']);
    Route::post('/admin/register', [AdminController::class, 'register']);
});

Route::post('/admin/kiem-tra-chia-khoa', [AdminController::class, 'kiemTraChiaKhoa']);
