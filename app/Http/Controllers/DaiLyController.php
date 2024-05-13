<?php

namespace App\Http\Controllers;

use App\Models\DaiLy;
use Exception;
use Illuminate\Http\Request;

class DaiLyController extends Controller
{
    public function store(Request $request)
    {
        try {
            DaiLy::create([
                'ten_dai_ly'        => $request->ten_dai_ly,
                'email'             => $request->email,
                'so_dien_thoai'     => $request->so_dien_thoai,
                'dia_chi'           => $request->dia_chi,
            ]);

            return response()->json([
                'status'   =>   true,
                'message'  =>   'Thêm Mới Đại Lý Thành Công!',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status'   =>   true,
                'message'  =>   'Lỗiiiiiiii!',
            ]);
        }
    }

    public function getData()
    {
        $data = DaiLy::get();

        if ($data) {
            return response()->json([
                'status'    =>   true,
                'data'      =>   $data,
            ]);
        } else {
            return response()->json([
                'status'    =>   false,
                'message'   =>   'Trang Này Chưa Có Dữ Liệu',
            ]);
        }
    }

    public function update(Request $request)
    {
        $data = DaiLy::where('id', $request->id)->first();

        if ($data) {
            $data->update([
                'ten_dai_ly'        => $request->ten_dai_ly,
                'email'             => $request->email,
                'so_dien_thoai'     => $request->so_dien_thoai,
                'dia_chi'           => $request->dia_chi,
            ]);

            $data->save();

            return response()->json([
                'status'    =>   true,
                'message'   =>   'Chỉnh Sửa Thành Công',
            ]);
        } else {
            return response()->json([
                'status'    =>   false,
                'message'   =>   'Lỗiiiiiii',
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $data = DaiLy::where('id', $request->id)->first();

        if ($data) {
            $data->delete();

            return response()->json([
                'status'    =>   true,
                'message'   =>   'Xóa Đại Lý Thành Công',
            ]);
        } else {
            return response()->json([
                'status'    =>   false,
                'message'   =>   'Lỗiiiiiii',
            ]);
        }
    }
}
