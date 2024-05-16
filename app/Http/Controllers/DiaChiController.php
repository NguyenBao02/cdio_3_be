<?php

namespace App\Http\Controllers;

use App\Models\DiaChi;
use Exception;
use Illuminate\Http\Request;

class DiaChiController extends Controller
{
    public function store(Request $request)
    {
        try {
            $check  = $this->isUserKhachHang();

            DiaChi::create([
                'id_khach_hang'     => $check->id,
                'ten_nguoi_nhan'    => $request->ten_nguoi_nhan,
                'so_dien_thoai'     => $request->so_dien_thoai,
                'dia_chi'           => $request->dia_chi,
            ]);

            return response()->json([
                'status' => true,
                'message' => "Bạn đã thêm mới địa chỉ thành công!"
            ]);
        } catch (Exception) {
            return response()->json([
                'status' => false,
                'message' => "Có lỗi xảy ra!"
            ]);
        }
    }

    public function data()
    {
        $check  = $this->isUserKhachHang();
        $data = DiaChi::where('id_khach_hang', $check->id)->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function update(Request $request)
    {
        $check  = $this->isUserKhachHang();

        $dia_chi    = DiaChi::where('id', $request->id)->where('id_khach_hang', $check->id)->first();
        if ($dia_chi) {
            try {
                $dia_chi->update([
                    'ten_nguoi_nhan'    => $request->ten_nguoi_nhan,
                    'so_dien_thoai'     => $request->so_dien_thoai,
                    'dia_chi'           => $request->dia_chi,
                ]);

                return response()->json([
                    'status' => true,
                    'message' => "Bạn đã cập nhật địa chỉ thành công!"
                ]);
            } catch (Exception) {
                return response()->json([
                    'status' => false,
                    'message' => "Có lỗi xảy ra!"
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => "Bạn không thuộc sở hữu địa chỉ này!"
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $check  = $this->isUserKhachHang();
        $dia_chi    = DiaChi::where('id', $request->id)->where('id_khach_hang', $check->id)->first();
        if ($dia_chi) {
            try {
                $dia_chi->delete();

                return response()->json([
                    'status' => true,
                    'message' => "Bạn đã xóa địa chỉ thành công!"
                ]);
            } catch (Exception) {
                return response()->json([
                    'status' => false,
                    'message' => "Có lỗi xảy ra!"
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => "Bạn không thuộc sở hữu địa chỉ này!"
            ]);
        }
    }
}
