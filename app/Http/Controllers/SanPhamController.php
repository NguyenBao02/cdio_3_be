<?php

namespace App\Http\Controllers;

use App\Models\DaiLy;
use App\Models\NhapKhoSanPham;
use App\Models\SanPham;
use Exception;
use Illuminate\Http\Request;

class SanPhamController extends Controller
{
    public function store(Request $request)
    {
        $admin = auth()->user();

        try {
            SanPham::create([
                'tieu_de'           => $request->tieu_de,
                'thumbnail'         => $request->thumbnail,
                'slug_san_pham'     => $request->slug_san_pham,
                'gia_ban'           => $request->gia_ban,
                'gia_khuyen_mai'    => $request->gia_khuyen_mai,
                'mo_ta'             => $request->mo_ta,
                'id_dai_ly'         => $request->id_dai_ly,
                'id_danh_muc'       => $request->id_danh_muc,
            ]);

            NhapKhoSanPham::create([
                'ten_san_pham'      => $request->tieu_de,
                'id_admin'          => $admin->id,
            ]);

            return response()->json([
                'status'    => 1,
                'id'        => $admin->id,
                'message'   => 'Nhập Kho Thành Công'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status'    => 0,
                'message'   => 'Lỗi!!!!!!!!!'
            ]);
        }
    }

    public function dataSanPham()
    {
        $data = SanPham::get();

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

    public function dataFS()
    {
        $data = SanPham::select('san_phams.*')
            ->orderBy('gia_ban')
            ->LIMIT(6)
            ->get();

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

    public function dataBS()
    {
        $data = SanPham::select('san_phams.*')
            ->orderBy('gia_ban', 'desc')
            ->LIMIT(6)
            ->get();

        // $data = SanPham::get();

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

    public function dataChiTiet($id)
    {

        $data = SanPham::where('id', $id)->first();

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
}
