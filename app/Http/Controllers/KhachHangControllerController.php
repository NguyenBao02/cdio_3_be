<?php

namespace App\Http\Controllers;

use App\Models\KhachHangController;
use Illuminate\Http\Request;

class KhachHangControllerController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'kiemTraChiaKhoa', 'checkLogin', 'thongTin', 'updateThongTin', 'updateMatKhau', 'getData']]);
    }

    public function register(Request $request)
    {
        KhachHangController::create([
            'ho_va_ten'         => $request->ho_va_ten,
            'email'             => $request->email,
            'so_dien_thoai'     => $request->so_dien_thoai,
            'password'          => bcrypt($request->password),
        ]);

        return response()->json([
            'status'    => 1,
            'message'   => 'Tạo tài khoản thành công'
        ]);
    }

    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth('khach_hang')->attempt($credentials)) {
            return response()->json(
                [
                    'message'    => 'Tài Khoản Hoặc Mật Khẩu Không Đúng',
                    'status'    => 0
                ],
            );
        } else {
            $user = KhachHangController::where('email', $request->email)->first();

            if ($user->tinh_trang) {
                return response()->json([
                    'status'        => 1,
                    'message'       => 'Đăng Nhập Thành Công',
                    'access_token'  => $token,
                    'ten_kh'        =>   $user->ho_va_ten,
                    'token_type'    => 'bearer',
                    'expires_in'    => auth('khach_hang')->factory()->getTTL() * 60
                ]);
            } else {
                return response()->json([
                    'status'        => 2,
                    'message'       => 'Tài Khoản Chưa Được Kích Hoạt!!!!',
                ]);
            }
        }
    }

    public function kiemTraChiaKhoa(Request $request)
    {
        $check  = $this->isUserKhachHang();
        if ($check) {
            return response()->json([
                'status'   =>   true,
                'message'  =>   'Đăng Nhập Thành Công!',
            ]);
        } else {
            return response()->json([
                'status'   =>   false,
                'message'  =>   'Bạn chưa đăng nhập tài khoản!',
            ]);
        }
        return response()->json($request->all());
    }

    public function checkLogin()
    {
        $khach_hang = auth('khach_hang')->user();

        if ($khach_hang) {
            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Vui lòng đăng nhập"
            ]);
        }
    }

    public function thongTin()
    {
        $check  = auth('khach_hang')->user();

        return response()->json([
            'data' => $check
        ]);
    }


    public function updateThongTin(Request $request)
    {
        $check  = auth('khach_hang')->user();

        if ($check) {
            KhachHangController::where('id', $check->id)->update([
                'email'             => $request->email,
                'so_dien_thoai'     => $request->so_dien_thoai,
                'ho_va_ten'         => $request->ho_va_ten,
            ]);

            return response()->json([
                'status' => true,
                'message' => "Bạn đã cập nhật thông tin thành công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Có lỗi xảy ra!"
            ]);
        }
    }

    public function updateMatKhau(Request $request)
    {
        $check  = auth('khach_hang')->user();

        // return response()->json($khach_hang);
        if ($check) {
            KhachHangController::where('id', $check->id)->update([
                'password'             => bcrypt($request->password),
            ]);

            return response()->json([
                'status' => true,
                'message' => "Bạn đã cập nhật mật khẩu thành công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Có lỗi xảy ra!"
            ]);
        }
    }

    public function getData()
    {
        $data = KhachHangController::get();

        if ($data) {
            return response()->json([
                'status' => true,
                'data' =>  $data
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Trang này chưa có dữ liệu!!!"
            ]);
        }
    }

    public function changeStatus(Request $request)
    {
        $khach_hang = KhachHangController::where('id', $request->id)->first();

        if ($khach_hang) {
            $khach_hang->tinh_trang = !$khach_hang->tinh_trang;

            $khach_hang->save();

            return response()->json([
                'status' => true,
                'message' => "Cập Nhật Thành Công"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Lỗi!!!!!!!!!"
            ]);
        }
    }
}
