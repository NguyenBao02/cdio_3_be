<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DaiLyController;
use App\Http\Controllers\DanhmucController;
use App\Http\Controllers\KhachHangControllerController;
use App\Models\KhachHangController;
use App\Http\Controllers\NhapKhoSanPhamController;
use App\Http\Controllers\SanPhamController;
use App\Models\NhapKhoSanPham;
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
    Route::post('/khachhang/login', [KhachHangControllerController::class, 'login']);
    Route::post('/khachhang/register', [KhachHangControllerController::class, 'register']);
    Route::post('/khachhang/kich-hoat-tai-khoan', [KhachHangControllerController::class, 'kichHoatTaiKhoan']);
});

Route::post('/admin/kiem-tra-chia-khoa', [AdminController::class, 'kiemTraChiaKhoa']);
Route::post('/khach-hang/kiem-tra-chia-khoa', [KhachHangControllerController::class, 'kiemTraChiaKhoa']);

Route::get('/admin/danh-sach-flash-sale/data', [SanPhamController::class, 'dataFS']);
Route::get('/admin/danh-sach-best-selling/data', [SanPhamController::class, 'dataBS']);
Route::get('/admin/danh-sach/data', [SanPhamController::class, 'dataSanPham']);
