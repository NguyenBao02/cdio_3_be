<?php

namespace App\Http\Controllers;

use App\Models\ChiTietDonHang;
use App\Models\SanPham;
use Exception;
use Illuminate\Http\Request;

class ChiTietDonHangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['themVaoGioHang', 'dataGioHang', 'updateGioHang', 'xoaGioHang']]);
    }

    public function themVaoGioHang(Request $request)
    {
        try {
            $check  = auth('khach_hang')->user();

            $san_pham = SanPham::where('id', $request->id_san_pham)->first();

            $so_luong = $request->so_luong;
            $gia_ban = $san_pham->gia_ban;

            $new_gia_ban = (float)$gia_ban;
            $new_so_luong = (int)$so_luong;

            $thanh_tien = $new_gia_ban * $new_so_luong;

            ChiTietDonHang::create([
                'id_khach_hang'     => $check->id,
                'id_san_pham'       => $san_pham->id,
                'so_luong'          => $new_so_luong,
                'don_gia'           => $new_gia_ban,
                'thanh_tien'        => $thanh_tien,
            ]);

            return response()->json([
                'status' => true,
                'message' => "Sản phẩm đã được thêm vào giỏ hàng thành công!"
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Có lỗi xảy ra!"
            ]);
        }
    }

    public function dataGioHang()
    {
        $check  = auth('khach_hang')->user();

        $data = ChiTietDonHang::where('id_khach_hang', $check->id)
            ->join('san_phams', 'chi_tiet_don_hangs.id_san_pham', 'san_phams.id')
            ->select('chi_tiet_don_hangs.*', 'san_phams.thumbnail', 'san_phams.tieu_de')
            ->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function updateGioHang(Request $request)
    {
        $khach_hang = auth('khach_hang')->user();

        $gio_hang = ChiTietDonHang::where('id', $request->id)->where('id_khach_hang', $khach_hang->id)->first();

        if ($gio_hang) {
            $gio_hang->so_luong     = $request->so_luong;
            $gio_hang->thanh_tien   = $request->so_luong * (float)$gio_hang->don_gia;
            $gio_hang->save();

            return response()->json([
                'status' => true,
                'message' => "Đã cập nhật giỏ hàng thành công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Có lỗi xảy ra!"
            ]);
        }
    }

    public function xoaGioHang(Request $request)
    {
        $khach_hang = auth('khach_hang')->user();

        $gio_hang = ChiTietDonHang::where('id', $request->id)->where('id_khach_hang', $khach_hang->id)->first();

        if ($gio_hang) {
            $gio_hang->delete();
            return response()->json([
                'status' => true,
                'message' => "Sản phẩm đã được xóa khỏi vào giỏ hàng thành công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Có lỗi xảy ra!"
            ]);
        }
    }
}
