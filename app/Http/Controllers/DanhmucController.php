<?php

namespace App\Http\Controllers;

use App\Models\danhmuc;
use Illuminate\Http\Request;

class DanhmucController extends Controller
{
    public function store(Request $request)
    {
        danhmuc::create([
            'ten_danh_muc' => $request->ten_danh_muc,
        ]);

        return response()->json([
            'status'    => 1,
            'message'   => 'Thêm Mới Danh Mục Thành Công'
        ]);
    }

    public function getData()
    {
        $data = danhmuc::get();

        return response()->json([
            'status'    => 1,
            'data'      =>  $data
        ]);
    }
}
