<?php

use App\Http\Controllers\DanhmucController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/admin/danh-muc/them-moi', [DanhmucController::class, 'store']);
Route::get('/admin/danh-muc/get-data', [DanhmucController::class, 'getData']);
