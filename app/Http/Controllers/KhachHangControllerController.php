<?php

namespace App\Http\Controllers;

use App\Models\KhachHangController;
use Illuminate\Http\Request;

class KhachHangControllerController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
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

            if($user->tinh_trang) {
                return response()->json([
                    'status'        => 1,
                    'message'       => 'Đăng Nhập Thành Công',
                    'access_token'  => $token,
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
}
