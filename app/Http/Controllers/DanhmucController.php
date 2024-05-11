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

    public function destroy(Request $request)
    {
        $data = danhmuc::where('id', $request->id)->first();

        if ($data) {
            $data->delete();

            return response()->json([
                'status'    => 1,
                'message'   =>  'Xóa Danh Mục Thành Công'
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   =>  'Lỗi!!!!!!'
            ]);
        }
    }

    public function update(Request $request)
    {
        $data = danhmuc::where('id', $request->id)->first();

        if ($data) {
            $data->update([
                'ten_danh_muc' => $request->ten_danh_muc,
            ]);

            $data->save();

            return response()->json([
                'status'    => 1,
                'message'   =>  'Sửa Danh Mục Thành Công'
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   =>  'Lỗi!!!!!!'
            ]);
        }
    }
}
