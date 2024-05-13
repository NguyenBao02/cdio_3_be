<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\NhapKhoSanPham;
use App\Models\SanPham;
use Exception;
use Illuminate\Http\Request;

class NhapKhoSanPhamController extends Controller
{
    public function getData()
    {
        $admin = auth()->user();

        $data = Admin::where('admins.id', $admin->id)
            ->join('nhap_kho_san_phams', 'admins.id', 'nhap_kho_san_phams.id_admin')
            ->get();

        return response()->json([
            'status'    => 1,
            'data'        => $data,
        ]);
    }
}
